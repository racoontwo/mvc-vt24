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
        return $this->render('black_jack/home.html.twig');
    }

    #[Route("/game/black_jack_init", name: "black_jack_init")]
    public function init(
        SessionInterface $session
    ): Response {
        $gameData = $session->get('black_jack_game');
        if (!$gameData) {
            $playerHand = new CardHand();
            $dealerHand = new CardHand();
            $deck = new DeckOfCards();
            $deck->shuffle();
            $playerHand->add($deck->drawCard() ?? new CardGraphic());


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
    public function playBlackJack(
        SessionInterface $session
    ): Response {
        $gameData = $session->get('black_jack_game');

        if (!$gameData) {
            return $this->redirectToRoute('black_jack');
        };

        $game = BlackJack::createFromJson(is_array($gameData) ? $gameData : []);

        $data = [
            "game" => $game,
        ];

        $session->set('black_jack_game', $game->exportToJson());

        return $this->render('black_jack/black_jack_play.html.twig', $data);
    }

    #[Route("/game/hit_me", name: "hit_me")]
    public function hitMe(
        SessionInterface $session
    ): Response {
        $gameData = $session->get('black_jack_game');

        if (!$gameData) {
            return $this->redirectToRoute('black_jack');
        };

        $game = BlackJack::createFromJson($gameData);
        $game->hitMe();
        $message = $game->getPlayerResult();

        if ($message) {
            $this->addFlash(
                'notice',
                $message
            );
        }

        $gameData = $game->exportToJson();
        $session->set('black_jack_game', $gameData);

        return $this->redirectToRoute('play_black_jack');
    }

    #[Route("/game/stay", name: "stay", methods: ['POST'])]
    public function stay(
        Request $request,
        SessionInterface $session
    ): Response {

        $handSum = $request->request->get('handSum');
        $session->set('stayed', $handSum);

        return $this->redirectToRoute('dealer_turn');
    }

    #[Route("/game/dealer_turn", name: "dealer_turn")]
    public function dealer(
        SessionInterface $session
    ): Response {
        $gameData = $session->get('black_jack_game');
        $game = BlackJack::createFromJson($gameData);
        $game->drawDealerCards();

        $data = [
            "game" => $game
        ];

        return $this->render('black_jack/dealer_turn.html.twig', $data);
    }


    #[Route("/game/documentation", name: "documentation")]
    public function documentation(): Response
    {
        return $this->render('black_jack/documentation.html.twig');
    }

    #[Route("/game/black_jack/api", name: "black_jack_api", methods: ['GET'])]
    public function api(
        SessionInterface $session
    ): Response {

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

    #[Route("/game/card/restart", name: "restart")]
    public function restart(
        SessionInterface $session
    ): Response {
        $session->clear();

        $this->addFlash(
            'notice',
            'You restarted the game. Another chance ... Good luck!!'
        );
        return $this->redirectToRoute('play_black_jack');
    }
}
