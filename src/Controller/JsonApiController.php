<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JsonApiController extends AbstractController
{
    #[Route("/api", name: "api")]
    public function home(): Response
    {

        //Här skriver jag lite om vad för metoder jag har valt att använda samt skickar en knapp som läser in spelet som ska börja, en init
        return $this->render('json_api/home.html.twig');
    }

    #[Route("/game/card/api/deck", name: "api_deck", methods: ['GET'])]
    public function apiDeck(
        SessionInterface $session
    ): Response {

        $deck = new DeckOfCards();
        $data = $deck->jsonDeckPretty();
        $jsonResponse = json_encode($data, JSON_UNESCAPED_UNICODE);

        return new JsonResponse($jsonResponse, Response::HTTP_OK, [], true);
    }

    #[Route("/game/card/api/deck/shuffle", name: "api_deck_shuffle", methods: ['POST'])]
    public function apiDeckShuffle(
        Request $request,
        SessionInterface $session
    ): Response {
        $remainingCards = $request->request->get('remaining_cards');

        $deck = new DeckOfCards();
        $deck->shuffle();
        $data = $deck->jsonDeckPretty();
        $jsonResponse = json_encode($data, JSON_UNESCAPED_UNICODE);

        $session->set("api_shuffled", $data);

        return new JsonResponse($jsonResponse, Response::HTTP_OK, [], true);
        // return $this->redirectToRoute('api_deck', $jsonData);
    }

    #[Route("/game/card/api/deck/draw", name: "api_draw", methods: ['POST'])]
    public function apiDrawCard(
        SessionInterface $session
    ): Response {

        // if ($num > 52) {
        //     throw new \Exception("Can not draw more than 52 cards!");
        // }

        if ($session->has("remaining_cards")) {
            $sessionData = json_decode($session->get("remaining_cards", true));
            $deck = new DeckOfCards($sessionData);
            // $deck = new DeckOfCards($session->get("remaining_cards"));
        } else {
            $deck = new DeckOfCards();
        }

        $card = $deck->drawCard();

        $session->set("remaining_cards", $deck->jsonDeckRaw());

        $data = [
            "cardText" => $card->getAsText(),
            "cardsLeft" => $deck->cardsLeft(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/game/card/api/deck/draw/{num<\d+>}", name: "api_draw_many", methods: ['GET'])]
    public function drawMany(
        int $num,
        SessionInterface $session
    ): Response {

        if ($num > 52) {
            throw new \Exception("Can not draw more than 52 cards!");
        }

        if ($session->has("remaining_cards")) {
            $sessionData = json_decode($session->get("remaining_cards", true));
            $deck = new DeckOfCards($sessionData);
            // $deck = new DeckOfCards($session->get("remaining_cards"));
        } else {
            $deck = new DeckOfCards();
            $deck->shuffle();
        }

        $deck->shuffle();

        $cardHand = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = $deck->drawCard();
            $cardHand[] = $card->getAsText();
        }

        $session->set("remaining_cards", $deck->jsonDeckRaw());

        $data = [
            "num_cards" => count($cardHand),
            "cardHand" => $cardHand,
            "cardsLeft" => $deck->cardsLeft(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }



    #[Route("/game/card/api/test_deck", name: "test_api_deck", methods: ['GET'])]
    public function testApiDeck(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        $remainder = $deck->getRemainingCards();
        $card = $remainder[13];


        $data = [
            'card' => $card->getAsString(),
            'value' => $card->getValue(),
            'suit' => $card->getSuit(),
            'message' => "Hello there",
            'stringcard' => $card->getValue() . ' of ' . $card->getSuit()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    // $data = [
    //     'lucky-number' => $number,
    //     'todays quote' => $randomQuote,
    //     'todays date' => $date->format('Y-m-d'),
    //     'printed time' => $date->format('H:i:s'),
    // ];

    // // return new JsonResponse($data);

    // $response = new JsonResponse($data);
    // $response->setEncodingOptions(
    //     $response->getEncodingOptions() | JSON_PRETTY_PRINT
    // );
    // return $response;
}