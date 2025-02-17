<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InformationsController extends AbstractController
{
    #[Route('/info', name: 'app_informations')]
    public function index(): Response
    {
        return $this->render('informations/index.html.twig', [
            'controller_name' => 'InformationsController',
        ]);
    }
}
