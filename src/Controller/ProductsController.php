<?php

namespace App\Controller;
 
use App\Entity\Sweatshirt;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;


final class ProductsController extends AbstractController
{
    #[Route('/products', name: 'app_products')]
    public function index(ManagerRegistry $manager, ): Response
    {
        $products = $manager->getRepository(Sweatshirt::class)->findAll();

        return $this->render('products/index.html.twig', ['products' => $products ]);

        $om = $manager->getManager();

        for ($i=1;$i < 11; $i++) {
            $products = new Sweatshirt();

            $products->setName("Sweatshirt $i");

            $om->persist($products);
        }
    }

#[Route('/products/{id}', name: 'product_show')]
public function show(int $id, EntityManagerInterface $entityManager): Response
{
    $product = $entityManager->getRepository(Sweatshirt::class)->find($id);

    if (!$product) {
        throw $this->createNotFoundException('Ce produit n\'existe pas.');
    }

    return $this->render('products/show.html.twig', [
        'product' => $product, ]);
}

}
