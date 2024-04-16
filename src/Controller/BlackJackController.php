<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

use App\BlackJack\BlackJack;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlackJackController extends AbstractController
{
    #[Route("/game/black_jack", name: "black_jack")]
    public function home(): Response
    {
        session_start();

        return $this->render('blackjack/home.html.twig');
    }

    #[Route("/game/play_blackjack", name: "play_blackjack")]
    public function init(): Response
    {
        $cardHand = new CardHand();
        $dealerHand = new CardHand();
        $deck = new DeckOfCards();
        $deck->shuffle();

        $game = new BlackJack($deck, $cardHand, $dealerHand);

        $game->hitMe();
        $game->hitMe();
        $game->hitMe();
        $game->hitMe();

        
        $playerHand = $game->getPlayerHand();
        $sumCards = $playerHand->getHandSum();

        $data = [
            "playerHand" => $playerHand->getHand(),
            "sumCards" => $sumCards,
        ];

        return $this->render('blackjack/blackjack_play.html.twig', $data);
    }

    #[Route("/game/hit_me", name: "hit_me")]
    public function hit_me(): Response
    {

        return $this->redirectToRoute('play_blackjack');
    }

    #[Route("/game/documentation", name: "documentation")]
    public function documentation(): Response
    {
        return $this->render('blackjack/documentation.html.twig');
    }

    #[Route("/game/blackjack/api", name: "blackjack_api", methods: ['GET'])]
    public function api(): Response
    {
        $card = new CardGraphic(12, "diamonds");
        // $card = $card-drawCard();

        $data = [
            'card' => $card->getAsString(),
            'value' => $card->getValue(),
            'suit' => $card->getSuit(),
            'stringcard' => $card->getValue() . ' of ' . $card->getSuit()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
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
