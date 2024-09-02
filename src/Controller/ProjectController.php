<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Forest;
use App\Repository\ForestryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Redlisted;
use App\Repository\RedlistedRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProjectController extends AbstractController
{
    #[Route("/proj", name: "proj")]
    public function project(
        ForestryRepository $ForestryRepository
    ): Response {
        $forestryData = $ForestryRepository
            ->findAll();
        $data = array();
        $data['forestryData'] = $forestryData;
        
        return $this->render('project/home.html.twig', $data);
    }

    #[Route("/forestry", name: "forestry")]
    public function forestry(
        ForestryRepository $ForestryRepository
    ): Response {
        $forestryData = $ForestryRepository
            ->findAll();
        $data = array();
        $data['forestryData'] = $forestryData;
        
        return $this->render('project/forestry.html.twig', $data);
    }

    #[Route("/project/red_listed", name: "red_listed")]
    public function redListed(
        RedlistedRepository $RedlistedRepository
    ): Response {
        $redlistedData = $RedlistedRepository
            ->findAll();
        $data = array();
        $data['redlistedData'] = $redlistedData;
        
        return $this->render('project/redlisted.html.twig');
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

    #[Route('/project/show_redlisted', name: 'show_redlisted')]
    public function showRedlisted(
        RedlistedRepository $RedlistedRepository
    ): Response {
        $redlistedData = $RedlistedRepository
            ->findAll();

        $response = $this->json($redlistedData);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    } 
}
