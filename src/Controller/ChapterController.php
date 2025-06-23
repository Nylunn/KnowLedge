<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use App\Repository\LessonRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;



final class ChapterController extends AbstractController
{
    #[Route('/chapter', name: 'app_chapter')]
    public function index(EntityManagerInterface $manager): Response
    {
 $formations = $manager->getRepository(Formation::class)->findAll();
 

    return $this->render('chapter/index.html.twig', [
        'formations' => $formations,
    ]);
    }


    
 #[Route('/chapter/{id}', name: 'chapter_formation')]
    public function chapterById(int $id, ManagerRegistry $manager, LessonRepository $lessonRepository, FormationRepository $formationRepository,): Response
{
    //get the formation by the id
    $formation = $formationRepository->find($id);


    //get the lesson corresponding with the formation
    $lessons = $lessonRepository->findBy(['formation' => $formation]);

    return $this->render('chapter/index.html.twig', [
        'formation' => $formation, // formation actual
        'lessons' => $lessons, // lesson of this formation
    ]);
}


// Path to gave the certification
    #[Route('/finalchapter', name: 'final_chapter')]
    public function final(): Response
    {
        $user = $this->getUser(); 


        return $this->render('chapter/finalchapter.html.twig', ['user' => $user ]);
    }

#[Route('/student/certificate', name: 'student_certification')]
public function addRole(EntityManagerInterface $entityManager): RedirectResponse
{
    $user = $this->getUser(); // localize the connected user

    if (!$user) {
        $this->addFlash('error', 'Vous devez être connecté pour obtenir la certification.');
        return $this->redirectToRoute('app_login');
    }

    if (!in_array('ROLE_CERTIFICATE', $user->getRoles())) {
        $roles = $user->getRoles();
        $roles[] = 'ROLE_CERTIFICATE'; 
        $user->setRoles($roles); 

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Vous avez obtenu votre diplôme !');
    }

    return $this->redirectToRoute('app_student'); 
}



}
