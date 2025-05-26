<?php

namespace App\Controller;

use App\Entity\Formation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
   #[Route('/', name: 'app_home')]
       public function index(ManagerRegistry $manager, Formation $formation): Response
    {

        $formation = $manager->getRepository(Formation::class)->findAll();
        return $this->render('home/index.html.twig', ['formation' => $formation]);


    }
}
