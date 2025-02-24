<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class ChapterController extends AbstractController
{
    #[Route('/chapter', name: 'app_chapter')]
    public function index(): Response
    {
        return $this->render('chapter/index.html.twig', [
            'controller_name' => 'ChapterController',
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
