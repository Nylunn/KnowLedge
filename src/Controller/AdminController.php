<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Formation;
use App\Entity\Lesson;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use App\Service\StripeService;

use Symfony\Component\Routing\Annotation\Route;

final class AdminController extends AbstractController
{
    private $stripeService;
    
    
    
        public function __construct(StripeService $stripeService)
        {
            $this->stripeService = $stripeService;
        }
    
    #[Route('/admin', name: 'app_admin')]    
    public function index(ManagerRegistry $manager): Response
    {
        $formations = $manager->getRepository(Formation::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();
        $lessons = $manager->getRepository(Lesson::class)->findAll();
        $payments = $this->stripeService->getPaymentIntents();


        return $this->render('admin/index.html.twig', ['users' => $users,
    'formations' => $formations, 'lessons' => $lessons,    'payments' => $payments,]);    


    }

    


}


 