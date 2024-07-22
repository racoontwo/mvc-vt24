<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route('/project', name: 'project')]
    public function index(): Response
    {
        return $this->render('project/home.html.twig', [
            'controller_name' => 'ProjectController',
        ]);
    }
}
