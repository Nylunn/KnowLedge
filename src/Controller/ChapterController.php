<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Entity\User;
use App\Repository\ChapterRepository;
use App\Repository\FormationRepository;
use App\Repository\LessonRepository;
use App\Repository\ProgressionRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ChapterAccessService
{
    private ProgressionRepository $progressionRepository;

    public function __construct(ProgressionRepository $progressionRepository)
    {
        $this->progressionRepository = $progressionRepository;
    }

    public function getAvailableChapters(User $user, array $allChapters): array
    {
        $availableChapters = [];

        // Vérifie si les deux premiers chapitres sont terminés
        $firstTwoCompleted = $this->progressionRepository->userHasCompletedFirstChapters($user, 2);

        foreach ($allChapters as $chapter) {
            if ($chapter->getOrder() <= 2) {
                $availableChapters[] = $chapter;
            } elseif ($firstTwoCompleted) {
                if (!$chapter->isFinal()) {
                    $availableChapters[] = $chapter;
                } elseif (in_array("ROLE_CERTIFIABLE", $user->getRoles())) {
                    $availableChapters[] = $chapter;
                }
            }
        }

        return $availableChapters;
    }
}

final class ChapterController extends AbstractController
{
    #[Route('/chapter', name: 'app_chapter')]
    public function index(ChapterRepository $chapterRepo,
    ChapterAccessService $chapterAccessService,
    Security $security
): Response {
    $user = $security->getUser();
    $allChapters = $chapterRepo->findBy([], ['order' => 'ASC']);
    $availableChapters = $chapterAccessService->getAvailableChapters($user, $allChapters);

    return $this->render('chapter/index.html.twig', [
        'chapters' => $availableChapters,
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
        $user->setRoles($roles); //Gave role

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Vous avez obtenu votre diplôme !');
    }

    return $this->redirectToRoute('app_student'); 
}



}
