<?php

namespace App\Controller;
 
use App\Entity\Formation;
use App\Entity\Lesson;
use App\Repository\FormationRepository;
use App\Repository\LessonRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;


final class ProductsController extends AbstractController
{
    #[Route('/formation', name: 'app_formation')]
    public function index(ManagerRegistry $manager,   FormationRepository $formation): Response
 {



        $formation = $manager->getRepository(Formation::class)->findAll();

   
        return $this->render('products/index.html.twig', ['formation' => $formation]);
    }


#[Route('/formation/{id}', name: 'formation_show')]
public function show(int $id, EntityManagerInterface $entityManager,  LessonRepository $lesson, FormationRepository $formation, EntityManagerInterface $Entitymanager): Response
{
    $lessonInformatique = $formation->findOneBy(['title' => 'informatique']);
    $informatique = $lesson->findOneBy(['type' => 'technology']);
    $informatique->setFormation($lessonInformatique);

    $Entitymanager->flush();


    $lesson = $entityManager->getRepository(Lesson::class)->find($id);
    $formation = $entityManager->getRepository(Formation::class)->find($id);

    if (!$formation) {
        throw $this->createNotFoundException('Cette formation n\'existe pas.');
    }
    if (!$lesson) {
        throw $this->createNotFoundException('Cette leçon n\'existe pas.');
    }


    return $this->render('products/show.html.twig', [
        'formation' => $formation, ]);
}

}
