<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use App\Repository\LessonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index( ManagerRegistry $manager, LessonRepository $lessonRepository, FormationRepository $formationRepository,): Response
    {
        $formation = $manager->getRepository(Formation::class)->findAll();

         if (!$formation) {
        throw $this->createNotFoundException('Cette formation n\'existe pas.');
    }
    
    $lessons = $lessonRepository->findBy(['formation' => $formation]);

        return $this->render('student/index.html.twig', [   'formation' => $formation,
        'lessons' => $lessons ]);


    }
    #[Route('/student/{id}', name: 'formation_type')]
    public function LearningPage(int $id, ManagerRegistry $manager, LessonRepository $lessonRepository, FormationRepository $formationRepository): Response
    {
        $formation = $formationRepository->find($id);
        $formation = $manager->getRepository(Formation::class)->findAll();

        $lessons = $lessonRepository->findBy(['formation' => $formation]);


         if (!$formation) {
        throw $this->createNotFoundException('Cette formation n\'existe pas.');
    }
    
    $lessons = $lessonRepository->findBy(['formation' => $formation]);

        return $this->render('student/show.html.twig', [   'formation' => $formationRepository->find($id),
        
        'lessons' => $lessons ]);


    }
}
