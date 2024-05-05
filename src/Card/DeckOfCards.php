<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardGraphic;

use InvalidArgumentException;

class DeckOfCards
{
    use CardTrait;

    /**
     * @var array
     */
    private $deck;

    public function __construct(array $cardArray = [])
    {

        if (!empty($cardArray)) {
            foreach ($cardArray as $cards) {
                $cardData = explode(" of ", $cards);
                $value = intval($cardData[0]);
                $suit = $cardData[1];
                $card = new CardGraphic($value, $suit);
                $this->deck[] = $card;
            }
        } else {
            foreach ($this->suits as $suit) {
                for ($value = 1; $value <= 13; $value++) {
                    $card = new CardGraphic($value, $suit);
                    $this->deck[] = $card;
                }
            }
        }
    }

    // public function __construct($cardArray = [])
    // {
    //     if (!empty($cardArray) && is_array($cardArray)) {
    //         foreach ($cardArray as $cards) {
    //             $cardData = explode(" of ", $cards);
    //             $value = intval($cardData[0]);
    //             $suit = $cardData[1];
    //             $card = new CardGraphic($value, $suit);
    //             $this->deck[] = $card;
    //         }
    //     }
    //     foreach ($this->suits as $suit) {
    //         for ($value = 1; $value <= 13; $value++) {
    //             $card = new CardGraphic($value, $suit);
    //             $this->deck[] = $card;
    //         }
    //     }
    // }

    public function add(CardGraphic $card): void
    {
        $this->deck[] = $card;
    }

    public function drawCard(): ?CardGraphic
    {
        $drawnCard = !empty($this->deck) ? array_shift($this->deck) : null;
        return $drawnCard;
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

    public function sortDeck(): integer
    {
        usort($this->deck, function ($cardA, $cardB) {
            $suitOrder = array_search($cardA->getSuit(), $this->suits) - array_search($cardB->getSuit(), $this->suits);
            if ($suitOrder != 0) {
                return $suitOrder;
            }

            return $cardA->getValue() - $cardB->getValue();
        });
    }

    public function jsonSortedDeck(): string|false
    {
        $sortedDeck = [];


        foreach ($this->suits as $suit) {
            $sortedDeck[$suit] = [];
        }

        usort($this->deck, function ($cardA, $cardB) {
            $suitOrder = array_search($cardA->getSuit(), $this->suits) - array_search($cardB->getSuit(), $this->suits);
            if ($suitOrder != 0) {
                return $suitOrder;
            }
            return $cardA->getValue() - $cardB->getValue();
        });

        foreach ($this->deck as $card) {
            $suit = $card->getSuit();
            $sortedDeck[$suit][] = $card->getValue();
        }

        return json_encode($sortedDeck);
    }
    public function jsonDeckRaw(): string|false
    {
        $jsonDeck = [];

        foreach ($this->deck as $card) {
            $jsonDeck[] = $card->getValue() . ' of ' . $card->getSuit();
        }

        return json_encode($jsonDeck);
    }
    public function jsonDeckPretty(): string|false
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

    public static function createFromJson(string $json): DeckOfCards
    {
        $deckArray = json_decode($json, true);
        if (!is_array($deckArray)) {
            throw new InvalidArgumentException("Invalid JSON format.");
        }

        //this is probably what you have to change
        $deck = new DeckOfCards($deckArray);
        return $deck;
    }
}
