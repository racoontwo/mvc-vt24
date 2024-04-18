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

    public function shuffleDeck()
    {
        $this->deck->shuffle();
    }

    public function getDeck()
    {
        return $this->deck;
    }

    public function getPlayerHand()
    {
        return $this->playerHand;
    }

    public function getDealerHand()
    {
        return $this->dealerHand;
    }

    public static function createFromJson(array $jsonData): BlackJack
    {
        $deck = DeckOfCards::createFromJson($jsonData['deck']);
        $playerHand = CardHand::createFromJson($jsonData['player_hand']);
        $dealerHand = CardHand::createFromJson($jsonData['dealer_hand']);
        return new self($deck, $playerHand, $dealerHand);
    }

    // public static function createFromJson(array $jsonData): BlackJack
    // {
    //     $deck = new DeckOfCards();
    //     $deck->createFromJson($jsonData['deck']);
    
    //     $playerHand = new CardHand();
    //     $playerHand->createFromJson($jsonData['player_hand']);

    //     $dealerHand = new CardHand();
    //     $dealerHand->createFromJson($jsonData['dealer_hand']);

    //     return new self($deck, $playerHand, $dealerHand);
    // }

    public function exportToJson(): array
    {
        $gameData = [
            'deck' => $this->deck->jsonDeckRaw(),
            'player_hand' => $this->playerHand->getHandAsJson(),
            'dealer_hand' => $this->dealerHand->getHandAsJson(),
        ];

        return $gameData;
    }



}