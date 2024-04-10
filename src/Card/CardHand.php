<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardGraphic;

class CardHand
{
    /**
     * @var CardGraphic
     */
    private $hand;

    public function add(CardGraphic $card): void
    {
        $this->hand[] = $card;
    }

    public function draw()
    {
        if (!empty($this->hand)) {
            return array_shift($this->hand);
        } else {
            return null;
        }
    }

    public function getNumberCards(): int
    {
        return count($this->hand);
    }

    }
