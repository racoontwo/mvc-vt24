<?php

namespace App\BlackJack;

use App\Card\CardHand;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;

class BlackJack
{
    /**
     * @var DeckOfCards
     */
    private $deck;
    /**
     * @var CardHand
     */
    private $playerHand;
    /**
     * @var CardHand
     */
    private $dealerHand;

    public function __construct(DeckOfCards $deck, CardHand $playerHand, CardHand $dealerHand)
    {
        $this->deck = $deck;
        $this->playerHand = $playerHand;
        $this->dealerHand = $dealerHand;
    }

    public function hitMe(): CardGraphic
    {
        $card = $this->deck->drawCard();
        $this->playerHand->add($card);

        return $card;
    }

    public function shuffleDeck(): void
    {
        $this->deck->shuffle();
    }

    public function getDeck(): DeckOfCards
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

    public function busted()
    {
        if ($this->dealerHand->getHandSum() > 21 || $this->playerHand->getHandSum() > 21) {
            return true;
        }
        return null;
    }


    public function getPlayerResult()
    {
        if ($this->playerHand->getHandSum() > 21) {
            return "You lost ...";
        };

        if ($this->playerHand->getHandSum() == 21) {
            return "Black Jack!";
        };

        return null;
    }

    public function drawDealerCards()
    {
        while ($this->dealerHand->getHandSum() <= 17) {
            $card = $this->deck->drawCard();
            $this->dealerHand->add($card);
        }
        return $this->dealerHand;
    }

    public function getWinner()
    {
        if ($this->dealerHand->getHandSum() > 21) {
            return "Player wins";
        }
        if ($this->playerHand->getHandSum() > $this->dealerHand->getHandSum()) {
            return "Player wins";
        }
        return "House wins";
    }


    public static function createFromJson(array $jsonData): BlackJack
    {
        $deck = DeckOfCards::createFromJson($jsonData['deck']);
        $playerHand = CardHand::createFromJson($jsonData['player_hand']);
        $dealerHand = CardHand::createFromJson($jsonData['dealer_hand']);
        return new self($deck, $playerHand, $dealerHand);
    }

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
