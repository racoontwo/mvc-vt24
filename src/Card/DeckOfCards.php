<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardGraphic;

class DeckOfCards
{
    use CardTrait;

    /**
     * @var CardGraphic
     */
    private $deck;
    private $cards;
    private $values;

    public function __construct(array $remaining_cards = [])
    {

        if (!empty($remaining_cards)) {
            foreach ($remaining_cards as $cards) {
                $cardData = explode(" of ", $cards);
                $value = intval($cardData[0]);
                $suit = $cardData[1];
                $card = new CardGraphic($value, $suit);
                $this->deck[] = $card;
            }
        } else {
            // Create deck as before if no cards are provided
            foreach ($this->suits as $suit) {
                for ($value = 1; $value <= 13; $value++) {
                    $card = new CardGraphic($value, $suit);
                    $this->deck[] = $card;
                }
            }
        }
    }

    public function drawCard(): ?CardGraphic
    {
        if (!empty($this->deck)) {
            return array_shift($this->deck);
        } else {
            return null;
        }
    }

    public function cardsLeft(): int
    {
        return count($this->deck);
    }

    public function getRemainingCards(): array
    {
        return $this->deck;
    }

    public function shuffle()
    {
        shuffle($this->deck);
    }

    public function sortDeck()
    {
        usort($this->deck, function ($a, $b) {
            $suitOrder = array_search($a->getSuit(), $this->suits) - array_search($b->getSuit(), $this->suits);
            if ($suitOrder != 0) {
                return $suitOrder;
            }

            return $a->getValue() - $b->getValue();
        });
    }

    public function jsonSortedDeck(): string
    {
        $sortedDeck = [];

        // Initialize the sortedDeck with empty arrays for each suit
        foreach ($this->suits as $suit) {
            $sortedDeck[$suit] = [];
        }

        // Sort the deck by suit and value
        usort($this->deck, function ($a, $b) {
            $suitOrder = array_search($a->getSuit(), $this->suits) - array_search($b->getSuit(), $this->suits);
            if ($suitOrder != 0) {
                return $suitOrder;
            }
            return $a->getValue() - $b->getValue();
        });

        // Organize sorted cards into each suit
        foreach ($this->deck as $card) {
            $suit = $card->getSuit();
            $sortedDeck[$suit][] = $card->getValue();
        }

        return json_encode($sortedDeck);
    }
    public function jsonDeckRaw(): string
    {
        $jsonDeck = [];

        foreach ($this->deck as $card) {
            $jsonDeck[] = $card->getValue() . ' of ' . $card->getSuit();
        }

        return json_encode($jsonDeck);
    }
    public function jsonDeckPretty(): string
    {
        $jsonDeck = [];

        foreach ($this->deck as $card) {
            $value = $card->getValue();
            if ($value == 11) {
                $value = "Jack";
            } elseif ($value == 12) {
                $value = "Queen";
            } elseif ($value == 13) {
                $value = "King";
            } elseif ($value == 1) {
                $value = "Ace";
            }
            $jsonDeck[] = $value . ' of ' . ucfirst($card->getSuit());
        }

        return json_encode($jsonDeck);
    }





}
