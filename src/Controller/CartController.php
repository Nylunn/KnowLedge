<?php

namespace App\Controller;

use App\Entity\Formation;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Cursus;
use App\Entity\Lesson;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Webhook;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Attribute\Route;


final class CartController extends AbstractController
{
  //Storage a lesson in cart with the session

  #[Route('/cart', name: 'app_cart')]
  public function index(SessionInterface $session, EntityManagerInterface $em)
  {
      $cart = $session->get('cart', []);
      $cartWithData = [];
      $totalPrice = 0;
  
      foreach ($cart as $id => $details) {
          $lesson = $em->getRepository(Lesson::class)->find($id);
  
          if ($lesson) {
              $cartWithData[] = [
                  'lesson' => $lesson,
                  'quantity' => $details['quantity'],
                  'total' => $lesson->getPrice() * $details['quantity'],
              ];
              $totalPrice += $lesson->getPrice() * $details['quantity'];
          }
      }
  
      return $this->render('cart/index.html.twig', [
          'cart' => $cartWithData,
          'total' => $totalPrice
      ]);
  }
  


// add a formation to the cart

    #[Route('/cart/add/formation/{id}', name: 'app_cart_add_formation')]
public function addFormation($id, Request $request, SessionInterface $session, EntityManagerInterface $em)
{
    $formation = $em->getRepository(Formation::class)->find($id);
    if (!$formation) {
        throw $this->createNotFoundException("La formation n'existe pas");
    }

    $cart = $session->get('cart', []);

    if (!isset($cart[$id])) {
        $cart[$id] = [
            'quantity' => 1
        ];
    } else {
        $cart[$id]['quantity']++;
    }

    $session->set('cart', $cart);

    return $this->redirectToRoute('app_cart');
}


// add a cursus to the cart

    #[Route('/cart/add/cursus/{id}', name: 'app_cart_add_cursus')]
public function addCursus($id, Request $request, SessionInterface $session, EntityManagerInterface $em)
{
    $cursus = $em->getRepository(Cursus::class)->find($id);
    if (!$cursus) {
        throw $this->createNotFoundException("Le cursus n'existe pas");
    }

    $cart = $session->get('cart', []);

    if (!isset($cart[$id])) {
        $cart[$id] = [
            'quantity' => 1
        ];
    } else {
        $cart[$id]['quantity']++;
    }

    $session->set('cart', $cart);

    return $this->redirectToRoute('app_cart');
}

//add a lesson to the cart

    #[Route('/cart/add/lesson/{id}', name: 'app_cart_add_lesson')]
public function addLesson($id, Request $request, SessionInterface $session, EntityManagerInterface $em)
{
    $lesson = $em->getRepository(Lesson::class)->find($id);
    if (!$lesson) {
        throw $this->createNotFoundException("La leçon n'existe pas");
    }

    $cart = $session->get('cart', []);

    if (!isset($cart[$id])) {
        $cart[$id] = [
            'quantity' => 1
        ];
    } else {
        $cart[$id]['quantity']++;
    }

    $session->set('cart', $cart);

    return $this->redirectToRoute('app_cart');
}

// Redirecting for the index product page.
#[Route('/cart/add/{id}', name: 'app_cart_add')]
public function add($id, Request $request, SessionInterface $session, EntityManagerInterface $em)
{
    $formation = $em->getRepository(Formation::class)->find($id);
    if (!$formation) {
        throw $this->createNotFoundException("La formation n'existe pas");
    }
    $lesson = $em->getRepository(Lesson::class)->find($id);
    if (!$lesson) {
        throw $this->createNotFoundException("La leçon n'existe pas");
    }
    $cursus = $em->getRepository(Cursus::class)->find($id);
    if (!$formation) {
        throw $this->createNotFoundException("Le cursus n'existe pas");
    }


    $cart = $session->get('cart', []);

    if (!isset($cart[$id])) {
        $cart[$id] = [
            'quantity' => 1
        ];
    } else {
        $cart[$id]['quantity']++;
    }

    $session->set('cart', $cart);

    return $this->redirectToRoute('app_cart');
}


//Delete an object

#[Route('/cart/remove/{id}', name: 'app_cart_remove')]
public function remove($id, SessionInterface $session)
{
    $cart = $session->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
    }

    $session->set('cart', $cart);

    return $this->redirectToRoute('app_cart');
}
    #[Route("/success", name:"success")]
public function success()
{
    return $this->render('cart/success.html.twig',[]);
}

#[Route("/error", name:"error")]
public function error()
{
    return $this->render('cart/error.html.twig',[]);
}


//Bought a product


#[Route('/create-checkout-session', name: 'create_checkout_session')]
public function createCheckoutSession(Request $request, EntityManagerInterface $em): JsonResponse
{
    $cart = $request->getSession()->get('cart', []);
    
    if (empty($cart)) {
        return new JsonResponse(['error' => 'Le panier est vide'], 400);
    }

    Stripe::setApiKey('sk_test_51Q2uEVCybVMxBZRKcLqfHUFnQvjOueAwU2yWdvq14b5MXbdDXem9DIQdbc8sZQLIx7Oo79oJvuoyzN3siUTYzJnE000UFP1lK7');
    
    $lineItems = [];
    $totalPrice = 0;

    foreach ($cart as $id => $details) {
        $lesson = $em->getRepository(Lesson::class)->find($id);
        
        if ($lesson) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $lesson->getTitle(),
                    ],
                    'unit_amount' => $lesson->getPrice() * 100, 
                ],
                'quantity' => $details['quantity'],
            ];
            $totalPrice += $lesson->getPrice() * $details['quantity'];
        }
    }

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $lineItems,
        'mode' => 'payment',
        'success_url' => $this->generateUrl('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
        'cancel_url' => $this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
    ]);

    return new JsonResponse(['id' => $session->id]);
}


#[Route('/checkout/{id}', name: 'checkout')]
public function checkoutid(UrlGeneratorInterface $urlGenerator, Formation $formation, Security $security): JsonResponse
{
    $user = $security->getUser(); 

    if (!$user) {
        return new JsonResponse(['error' => 'Utilisateur non connecté'], 403);
    }

    Stripe::setApiKey('sk_test_51Q2uEVCybVMxBZRKcLqfHUFnQvjOueAwU2yWdvq14b5MXbdDXem9DIQdbc8sZQLIx7Oo79oJvuoyzN3siUTYzJnE000UFP1lK7');

    $role = $formation->getRoleForUser();

    $session = Session::create([
        'payment_method_types' => ['card'],
        'customer_email' => $user->getEmail(),
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $formation->getTitle(),
                ],
                'unit_amount' => $formation->getPrice() * 100, 
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => $urlGenerator->generate('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
        'cancel_url' => $urlGenerator->generate('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
        'metadata' => [
            'formation_id' => $formation->getId(),
            'role' => $role,  
        ],
    ]);

    return new JsonResponse(['id' => $session->id]);
}



#[Route('/webhook/stripe', name: 'stripe_webhook', methods: ['POST'])]
public function stripeWebhook(Request $request, EntityManagerInterface $em): JsonResponse
{
    $endpoint_secret = 'whsec_5c7c7a78f13b4dd2c9f562c8d73763d47fa23628b363dda5b66e56ddcd03c094'; 

    $payload = $request->getContent();
    $sig_header = $request->headers->get('stripe-signature');

    try {
        $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
    } catch (\UnexpectedValueException $e) {
        return new JsonResponse(['error' => 'Invalid payload'], 400);
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        return new JsonResponse(['error' => 'Invalid signature'], 400);
    }

    if ($event->type === 'checkout.session.completed') {
        $session = $event->data->object;

        $customer_email = $session->customer_email;
        $formationId = $session->metadata->formation_id;
        $role = $session->metadata->role; 

        $user = $em->getRepository(User::class)->findOneBy(['email' => $customer_email]);
        $formation = $em->getRepository(Formation::class)->find($formationId);

        if ($user && $formation) {
            $user->addFormation($formation); 
            $user->setRoles([$role]); 
            $em->persist($user);
            $em->flush();
        }
    }

    return new JsonResponse(['message' => 'Webhook reçu !']);
}



}