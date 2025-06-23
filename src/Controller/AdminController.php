<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Formation;
use App\Entity\Lesson;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use App\Service\StripeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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


      #[Route('/users', name: 'admin_users')]
    public function listUsers(UserRepository $userRepository): Response
    {
        return $this->render('admin/user.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


    #[Route('/user/edit/{id}', name: 'admin_user_edit')]
    public function editUser(User $user, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Utilisateur mis à jour avec succès');
            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/edit_user.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/user/delete/{id}', name: 'admin_user_delete', methods: ['POST'])]
    public function deleteUser(User $user, EntityManagerInterface $em): Response
    {
        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'Utilisateur supprimé avec succès');
        return $this->redirectToRoute('admin_users');
    }


    


}


 