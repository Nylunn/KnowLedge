<?php

namespace App\Controller;
 
use App\Entity\Formation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;


final class ProductsController extends AbstractController
{
    #[Route('/formation', name: 'app_formation')]
    public function index(ManagerRegistry $manager): Response
 {


        $formation = $manager->getRepository(Formation::class)->findAll();

   
        return $this->render('products/index.html.twig', ['formation' => $formation]);
    }


#[Route('/formation/{id}', name: 'formation_show')]
public function show(int $id, EntityManagerInterface $entityManager): Response
{
    $formation = $entityManager->getRepository(Formation::class)->find($id);

    if (!$formation) {
        throw $this->createNotFoundException('Cette formation n\'existe pas.');
    }

    return $this->render('products/show.html.twig', [
        'formation' => $formation, ]);
}

}
