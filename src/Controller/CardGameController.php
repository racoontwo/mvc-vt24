<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;

// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/game/card", name: "card_start")]
    public function home(): Response
    {

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
            "num_Cards" => count($cardList),
            "cardList" => $cardList,
        ];

        return $this->render('card/test/many_cards.html.twig', $data);
    }
}
