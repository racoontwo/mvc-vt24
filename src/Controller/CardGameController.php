<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;

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
        //Här skriver jag lite om vad för metoder jag har valt att använda samt skickar en knapp som läser in spelet som ska börja, en init
        return $this->render('card/home.html.twig');
    }

    #[Route("/game/card_init", name: "card_init")]
    public function cardInit(): Response
    {
        //Här initierar jag kortspelet, kanske lägger till ngn session, ser till att kortlecken finns osv.
        return $this->render('card/home.html.twig');
    }

    #[Route("/game/card/test/pick_card", name: "test_pick_card")]
    public function testPickCard(): Response
    {
        // $card = new Card();
        $card = new CardGraphic();

        $data = [
            "card" => $card->pick(),
            "cardString" => $card->getAsString(),
            "cardText" => $card->getAsText(),
        ];

        return $this->render('card/test/pick.html.twig', $data);
    }

    #[Route("/game/card/test/pick_card/{num<\d+>}", name: "test_many_cards")]
    public function testPickCardGraphic(int $num): Response
    {
        if ($num > 52) {
            throw new \Exception("Can not roll more than 52 Cards!");
        }

        $cardList = [];
        for ($i = 1; $i <= $num; $i++) {
            // $card = new Card();
            $card = new CardGraphic();
            $card->pick();
            $cardList[] = $card->getAsString();
        }

        $data = [
            "num_cards" => count($cardList),
            "cardList" => $cardList,
        ];

        return $this->render('card/test/many_cards.html.twig', $data);
    }

    #[Route("/game/card/session_display", name: "session_display")]
    public function sessionDisplay(SessionInterface $session): Response
    {
        $sessionData = $session->all();
        return $this->render('card/session_display.html.twig', [
            'sessionData' => $sessionData
        ]);
    }

    #[Route("/game/card/session_delete", name: "session_delete")]
    public function sessionDelete(SessionInterface $session): Response
    {
        // Invalidate the current session
        $session->invalidate();

        // Clear the session cookie
        $response = new Response();
        $response->headers->clearCookie($session->getName());

        $this->addFlash(
            'notice',
            'Your session has been deleted!'
        );

        return $this->redirectToRoute('session_display');
    }

}
