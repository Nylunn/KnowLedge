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
use App\Entity\Sweatshirt;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;


final class CartController extends AbstractController
{
  //Stocker dans le panier grâce a la session 

   #[Route('/cart', name: 'app_cart')]
public function index(SessionInterface $session, EntityManagerInterface $em, ManagerRegistry $manager)
{
   $products = $manager->getRepository(Sweatshirt::class)->findAll();
    $cart = $session->get('cart', []);
    $cartWithData = [];
    $totalPrice = 0;

    foreach ($cart as $id => $details) {
        $product = $em->getRepository(Sweatshirt::class)->find($id);
        
        if ($product) {
            $cartWithData[] = [
                'product' => $product,
                'quantity' => $details['quantity'],
                'size' => $details['size'],
                'total' => $product->getPrice() * $details['quantity'],
               
            ];

            // Ajoute au prix total
            $totalPrice += $product->getPrice() * $details['quantity'];
        }
    }

    return $this->render('cart/index.html.twig', [
        'cart' => $cartWithData,
        'totalPrice' => $totalPrice,
        'products' => $products
    ]);
}


//Ajouter un article au panier

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
public function add($id, Request $request, SessionInterface $session, EntityManagerInterface $em)
{
    $product = $em->getRepository(Sweatshirt::class)->find($id);
    
    if (!$product) {
        throw $this->createNotFoundException("Le produit n'existe pas");
    }

    $cart = $session->get('cart', []);

    // Récupération des options (taille, etc.)
    $size = $request->query->get('size', 'M'); // Taille par défaut : M

    if (!isset($cart[$id])) {
        $cart[$id] = [
            'quantity' => 1,
            'size' => $size
        ];
    } else {
        $cart[$id]['quantity']++;
    }

    $session->set('cart', $cart);

    return $this->redirectToRoute('app_cart');
}

//Supprimer un poroduit 

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

    // Créer la session checkout
    $session = Session::create([
        'line_items' => [
            [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'sweatshirt',
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