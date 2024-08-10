<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Forest;
use App\Repository\ForestryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route("/project", name: "project")]
    public function table(
        ForestryRepository $ForestryRepository
    ): Response {
        $forestryData = $ForestryRepository
            ->findAll();
        $data = array();
        $data['forestryData'] = $forestryData;
        
        return $this->render('project/forestrytable.html.twig', $data);
    }

    #[Route("/project/about", name: "project_about")]
    public function about(): Response
    {
        return $this->render('project/about.html.twig');
    }

    #[Route('/project/show_forestry', name: 'show_forestry')]
    public function showForestry(
        ForestryRepository $ForestryRepository
    ): Response {
        $forestData = $ForestryRepository
            ->findAll();

        $response = $this->json($forestData);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }    
}
