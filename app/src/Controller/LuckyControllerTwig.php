<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerTwig extends AbstractController
{
    #[Route("/", name: "main")]
    public function main(): Response
    {
        return $this->render('me.html.twig');
    }
    
    #[Route("/lucky/number/twig", name: "lucky_number")]
    public function number(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'number' => $number
        ];

        return $this->render('lucky_number.html.twig', $data);
    }

        #[Route("/home", name: "home")]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        return $this->render('about.html.twig');
    }

    #[Route("/api/quote", name: "quote")]
    public function jsonQuote(): Response
    {
        $number = random_int(0, 100);
        $quotes = [
            "Its funny how day by day, nothing changes. But when you look back everything is different. -Kalle och Hobbe",
            "The happiness of your life depends upon the quality of your thoughts. -Marcus Aurelius",
            "No pressure, no diamonds. -Thomas Carlyle"
        ];

        $randomIndex = array_rand($quotes);
        $randomQuote = $quotes[$randomIndex];

        $date = new \DateTime();
    
        $data = [
            'lucky-number' => $number,
            'todays quote' => $randomQuote,
            'todays date' => $date->format('Y-m-d'),
            'printed time' => $date->format('H:i:s'),
        ];

        // return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
