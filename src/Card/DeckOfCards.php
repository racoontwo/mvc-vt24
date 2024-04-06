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

    public function __construct(int $cards = 52)
    {
        foreach ($this->suits as $suit) {
            for ($value = 1; $value <= 13; $value++) {
                $card = new CardGraphic($value, $suit);
                $this->deck[] = $card;
            }
        }

        // $value = 10;
        // $suit = "hearts";
        // $card = new CardGraphic($value, $suit);
        // $this->deck[] = $card;

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

}
