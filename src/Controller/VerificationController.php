<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VerificationController extends AbstractController
{
    #[Route('/verification', name: 'app_verification')]
    public function index(): Response
    {
        return $this->render('verification/index.html.twig', [
            'controller_name' => 'VerificationController',
        ]);
    }
}
