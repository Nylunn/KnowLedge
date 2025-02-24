<?php

namespace App\Controller;

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
public function index(SessionInterface $session, EntityManagerInterface $em)
{
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
                'total' => $product->getPrice() * $details['quantity']
            ];

            // Ajoute au prix total
            $totalPrice += $product->getPrice() * $details['quantity'];
        }
    }

    return $this->render('cart/index.html.twig', [
        'cart' => $cartWithData,
        'totalPrice' => $totalPrice,
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


}