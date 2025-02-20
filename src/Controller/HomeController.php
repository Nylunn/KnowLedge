<?php

namespace App\Controller;

use App\Entity\Sweatshirt;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
   #[Route('/', name: 'app_home')]
       public function index(ManagerRegistry $manager): Response
    {
        $products = $manager->getRepository(Sweatshirt::class)->findAll();

        return $this->render('home/index.html.twig', ['products' => $products ]);


    }
}
