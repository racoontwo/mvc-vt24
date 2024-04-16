<?php

namespace App\Blackjack;

use App\Card\CardHand;
use App\Card\DeckOfCards;

class Blackjack
{

    public function __constructor(CardHand $playerHand, CardHand $dealerHand)
    {
        $this->deck = new DeckOfCards;
        $this->playerHand = $playerHand;
        $this->dealerHand = $dealerHand;
    }
    
    public function hitMe()
    {
        echo("Hey there");
    }
}