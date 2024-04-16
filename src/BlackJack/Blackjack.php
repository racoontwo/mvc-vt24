<?php

namespace App\BlackJack;

use App\Card\CardHand;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;

class BlackJack

{
    private $deck;
    private $playerHand;
    private $dealerHand;

    public function __construct(DeckOfCards $deck, CardHand $playerHand, CardHand $dealerHand)
    {
        $this->deck = $deck;
        $this->playerHand = $playerHand;
        $this->dealerHand = $dealerHand;

    }

    public function hitMe()
    {
        $card = $this->deck->drawCard();
        echo($card->getAsText());
        $this->playerHand->add($card);
        return $card;
    }

    public function getPlayerHand()
    {
        return $this->playerHand;
    }

    public function getDealerHand()
    {
        return $this->dealerHand;
    }


}