<?php

namespace App\Controller;

use App\Entity\Formation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(ManagerRegistry $manager): Response
    {
        $formation = $manager->getRepository(Formation::class)->findAll();

        return $this->render('student/index.html.twig', ['formation' => $formation]);


    }
}
