<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/game/card", name: "card_start")]
    public function home(): Response
    {
        session_start();


        //Här skriver jag lite om vad för metoder jag har valt att använda samt skickar en knapp som läser in spelet som ska börja, en init
        return $this->render('card/home.html.twig');
    }

    #[Route("/game/card/test/pick_card/{num<\d+>}", name: "test_many_cards")]
    public function testPickCardGraphic(int $num): Response
    {
        if ($num > 52) {
            throw new \Exception("Can not pick more than 52 Cards!");
        }

        $cardHand = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = new CardGraphic();
            $card->pick();
            $cardHand[] = $card->getAsString();
        }

        $data = [
            "num_cards" => count($cardHand),
            "cardHand" => $cardHand,
        ];

        return $this->render('card/test/many_cards.html.twig', $data);
    }

    #[Route("/game/card/test/pick_card", name: "test_pick_card")]
    public function testPickCard(): Response
    {
        $card = new CardGraphic();

        $data = [
            "card" => $card->pick(),
            "cardString" => $card->getAsString(),
            "cardText" => $card->getAsText(),
        ];

        return $this->render('card/test/pick.html.twig', $data);
    }


    #[Route("/game/card/test/card_deck", name: "test_deck")]
    public function testCardDeck(SessionInterface $session): Response
    {
        // Check if the "deck" is already in the session
        if ($session->has("deck")) {
            $deck = $session->get("deck");
            // $deck = new DeckOfCards();
            // $deck->shuffle();
        } else {
            // Create a new deck if it's not in the session
            $deck = new DeckOfCards();
            $deck->shuffle();
        }
    
        $card = $deck->drawCard();
        $remainingCards = $deck->getRemainingCards();
    
        // Prepare data to pass to the template
        $data = [
            "cardString" => $card->getAsString(),
            "cardText" => $card->getAsText(),
            "cardsLeft" => $deck->cardsLeft(),
        ];



        $session->set("deck", $deck);
    
        return $this->render('card/test/pick.html.twig', $data);
    }

    #[Route("/game/card/deck", name: "deck")]
    public function displayDeck(): Response
    {

        $deck = new DeckOfCards();
        // $deck->shuffle();
        $deck->sortDeck();
        $remainingCards = $deck->getRemainingCards();

        $data = [
            "remainingCards" => $remainingCards,
            "cardsLeft" => $deck->cardsLeft(),
        ];
    
        return $this->render('card/card_deck.html.twig', $data);
    }

    #[Route("/game/card/shuffle", name: "shuffle")]
    public function shuffleDisplay(): Response
    {

        $deck = new DeckOfCards();
        $deck->shuffle();
        // $deck->sortDeck();
        $remainingCards = $deck->getRemainingCards();

        $data = [
            "remainingCards" => $remainingCards,
            "cardsLeft" => $deck->cardsLeft(),
        ];
    
        return $this->render('card/card_deck.html.twig', $data);
    }

    #[Route("/game/card/draw", name: "draw")]
    public function drawDisplay(): Response
    {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $card = $deck->drawCard();
        $remainingCards = $deck->getRemainingCards();

        $data = [
            "cardString" => $card->getAsString(),
            "cardText" => $card->getAsText(),
            "cardsLeft" => $deck->cardsLeft(),
        ];
    
        return $this->render('card/draw.html.twig', $data);
    }

    #[Route("/game/card/draw/{num<\d+>}", name: "draw_many")]
    public function drawMany(int $num): Response
    {

        if ($num > 52) {
            throw new \Exception("Can not draw more than 52 cards!");
        }

        $deck = new DeckOfCards();
        $deck->shuffle();

        $cardHand = [];
        for ($i = 1; $i <= $num; $i++) {
            $card = $deck->drawCard();
            $cardHand[] = $card->getAsString();
        }

        $data = [
            "num_cards" => count($cardHand),
            "cardHand" => $cardHand,
            "cardsLeft" => $deck->cardsLeft(),
        ];

        return $this->render('card/draw_many.html.twig', $data);
    }

    //JSON API
    #[Route("/game/card/api", name: "json_api")]
    public function jsonApi(): Response
    {
        return $this->render('card/draw_many.html.twig', $data);
    }



    //Here is the session routes
    #[Route("/game/card/session_display", name: "session_display")]
    public function sessionDisplay(SessionInterface $session, Request $request): Response
    {
        $sessionName = $session->getName();
        $sessionId = $session->getId();
        $sessionCookie = $request->cookies->all(); // Accessing cookies directly from the Request object

        return $this->render('card/session_display.html.twig', [
            'sessionName' => $sessionName,
            'sessionId' => $sessionId,
            'sessionCookie' => $sessionCookie,
            'sessionData' => $session->all(),
        ]);
    }

    #[Route("/game/card/session_delete", name: "session_delete")]
    public function sessionDelete(SessionInterface $session): Response
    {

        // Finally, destroy the session.
        $session->clear();


        $this->addFlash(
            'notice',
            'Your session has been deleted!'
        );
    
        return $this->redirectToRoute('session_display');
    }


}
