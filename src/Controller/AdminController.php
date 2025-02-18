<?php

namespace App\Controller;

use App\Entity\Sweatshirt;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ManagerRegistry $manager): Response
    {
        $products = $manager->getRepository(Sweatshirt::class)->findAll();

        return $this->render('admin/index.html.twig', ['products' => $products ]);

        $om = $manager->getManager();

        for ($i=1;$i <4; $i++) {
            $products = new Sweatshirt();

            $products->setName("Sweatshirt $i");

            $om->persist($products);
        }
    }
}


 