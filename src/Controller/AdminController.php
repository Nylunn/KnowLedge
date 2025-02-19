<?php

namespace App\Controller;

use App\Entity\Sweatshirt;
use App\Repository\SweatshirtRepository;
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


    }
}


 