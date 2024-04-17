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

    // public static function createFromJson(array $jsonData): BlackJack
    // {
    //     // Reconstruct DeckOfCards from JSON
    //     $deck = new DeckOfCards();
    //     $deck->loadFromJson($jsonData['deck']);
    
    //     // Reconstruct player hand from JSON
    //     $playerHand = new CardHand();
    //     $playerHand->loadFromJson($jsonData['player_hand']);
    
    //     // Reconstruct dealer hand from JSON
    //     $dealerHand = new CardHand();
    //     $dealerHand->loadFromJson($jsonData['dealer_hand']);
    
    //     // Create and return a new BlackJack object
    //     return new self($deck, $playerHand, $dealerHand);
    // }
    


}