<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerJson
{

    /**
     * @Route("/api/lucky/number")
     */
    public function number(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'lucky-number' => $number
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Route("/api/lucky/number2")
     */
    public function number2(): Response
    {
        $number = random_int(0, 100);

        $data = [
            'message' => 'Welcome to the lucky number API',
            'lucky-number' => $number
        ];

        //return new JsonResponse($data);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }



    /**
     * @Route("/api/lucky/number/{min}/{max}")
     */
    public function number3(int $min, int $max): Response
    {
        $number = random_int($min, $max);

        $data = [
            'message' => 'Welcome to the lucky number API',
            'min number' => $min,
            'max number' => $max,
            'lucky-number' => $number
        ];

        return new JsonResponse($data);
    }
}
