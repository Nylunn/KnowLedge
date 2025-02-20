<?php

namespace App\Controller;
 
use App\Entity\Sweatshirt;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
/*#[Route('/products/:id', name: 'app_products:id')]
     public function show($id, $repo){
          $products = $repo->find($id);
        return $this->render('products/show.html.twig',[
        'products' =>$products    
        ]);
    }*/
}
