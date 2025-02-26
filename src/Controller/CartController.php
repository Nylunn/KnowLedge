<?php

namespace App\Controller;


use Stripe\Stripe;
use Stripe\Checkout\Session;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Lesson;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;


final class CartController extends AbstractController
{
  //Storage a lesson in cart with the session

  #[Route('/cart', name: 'app_cart')]
public function index(SessionInterface $session, EntityManagerInterface $em, ManagerRegistry $manager)
{
    $lesson = $manager->getRepository(Lesson::class)->findAll();
    $cart = $session->get('cart', []);
    $cartWithData = [];
    $totalPrice = 0;

    foreach ($cart as $id => $details) {
        $lesson = $em->getRepository(Lesson::class)->find($id);
        
        if ($lesson) {
            // Vérification si la clé 'type' existe avant d'y accéder
            $type = isset($details['type']) ? $details['type'] : 'default_type';  // Valeur par défaut si 'type' n'existe pas

            $cartWithData[] = [
                'lesson' => $lesson,
                'type' => $type,  // Utilisation de $type
                'total' => $lesson->getPrice(),
            ];

            $totalPrice += $lesson->getPrice();
        }
    }

    return $this->render('cart/index.html.twig', [
        'cart' => $cartWithData,
        'totalPrice' => $totalPrice,
        'lesson' => $lesson
    ]);
}



//add a lesson to the cart

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
public function add($id, Request $request, SessionInterface $session, EntityManagerInterface $em)
{
    $lesson = $em->getRepository(Lesson::class)->find($id);
    
    if (!$lesson) {
        throw $this->createNotFoundException("La leçon n'existe pas");
    }

    $cart = $session->get('cart', []);
//get type of lesson
    $type = $request->query->get('type'); 

    if (!isset($cart[$id])) {
        $cart[$id] = [
            'quantity' => 1,
            'type' => $type
        ];
    } else {
        $cart[$id]['quantity']++;
    }

    $session->set('cart', $cart);

    return $this->redirectToRoute('app_cart');
}

//Delete a lesson

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

#[Route("/create-checkout-session", name:"checkout")]
public function checkout(UrlGeneratorInterface $urlGenerator) 
{
    Stripe::setApiKey('sk_test_51Q2uEVCybVMxBZRKcLqfHUFnQvjOueAwU2yWdvq14b5MXbdDXem9DIQdbc8sZQLIx7Oo79oJvuoyzN3siUTYzJnE000UFP1lK7');

    // Creation of the checkout session
    $session = Session::create([
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Formation',
                    ],
                    'unit_amount' => 2000, 
                ],
                'quantity' => 1,
            ],
        ],
        'mode' => 'payment',
        'success_url' => $urlGenerator->generate('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
        'cancel_url' => $urlGenerator->generate('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
    ]);
    return new JsonResponse(['id' => $session->id]);
}

}