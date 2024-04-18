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
    public function home(
        SessionInterface $session): Response
    {
        session_start();

        return $this->render('black_jack/home.html.twig');
    }

    #[Route("/game/black_jack_init", name: "black_jack_init")]
    public function init(
        SessionInterface $session): Response
    {
        $gameData = $session->get('black_jack_game');

        if (!$gameData) {

            $playerHand = new CardHand();
            $dealerHand = new CardHand();
            $deck = new DeckOfCards();
            $deck->shuffle();
            $playerHand->add($deck->drawCard());
            $playerHand->add($deck->drawCard());

            $gameData = [
                'deck' => $deck->jsonDeckRaw(),
                'player_hand' => $playerHand->getHandAsJson(),
                'dealer_hand' => $dealerHand->getHandAsJson(),
            ];

            $session->set('black_jack_game', $gameData);
        }

        return $this->redirectToRoute('play_black_jack');
    }

    #[Route("/game/play_black_jack", name: "play_black_jack")]
    public function play(
    SessionInterface $session): Response
    {
        $gameData = $session->get('black_jack_game');

        if (!$gameData) {
            return $this->redirectToRoute('black_jack');
        };

        $game = BlackJack::createFromJson($gameData);
        $playerHand = $game->getPlayerHand();
        var_dump($playerHand->getHandAsJson());
        $gameData = $game->exportToJson();
        var_dump($gameData);
        $session->set('black_jack_game', $gameData);


        $data = [
            "playerHand" => $playerHand->getHand(),
            "sumCards" => $playerHand->getHandSum(),
            "cardsLeft" => $game->getDeck()->cardsLeft(),
        ];

        return $this->render('black_jack/black_jack_play.html.twig', $data);
    }

    #[Route("/game/hit_me", name: "hit_me")]
    public function hit_me(
        SessionInterface $session): Response
    {
        $gameData = $session->get('black_jack_game');

        if (!$gameData) {
            return $this->redirectToRoute('black_jack');
        };

        $game = BlackJack::createFromJson($gameData);
        $game->hitMe();
        $gameData = $game->exportToJson();
        $session->set('black_jack_game', $gameData);


        return $this->redirectToRoute('play_black_jack');
    }

    #[Route("/game/documentation", name: "documentation")]
    public function documentation(): Response
    {
        return $this->render('black_jack/documentation.html.twig');
    }

    #[Route("/game/black_jack/api", name: "black_jack_api", methods: ['GET'])]
    public function api(
        SessionInterface $session): Response
    {

        $gameData = $session->get('black_jack_game');

        if (!$gameData) {

            $cardHand = new CardHand();
            $dealerHand = new CardHand();
            $deck = new DeckOfCards();
            $deck->shuffle();
            $cardHand->add($deck->drawCard());
    
            $gameData = [
                'deck' => $deck->jsonDeckRaw(),
                'player_hand' => $cardHand->getHandAsJson(),
                'dealer_hand' => $dealerHand->getHandAsJson(),
            ];
    

            $session->set('black_jack_game', $gameData);
        }

        $jsonResponse = json_encode($gameData, JSON_UNESCAPED_UNICODE);

        return new JsonResponse($jsonResponse, Response::HTTP_OK, [], true);
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
