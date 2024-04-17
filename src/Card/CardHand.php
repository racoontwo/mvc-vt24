<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardGraphic;

class CardHand
{
    use CardTrait;
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

    public function getHand(): array
    {
    return $this->hand;
    }

    public function getHandSum(): int
    {
        $sum = 0;
        
        foreach ($this->hand as $card) {
            $sum += $card->getValue();
        }
        
        return $sum;
    }

    public function getHandAsJson(): string
    {
        $handArray = [];
        
        if ($this->hand !== null) {

            foreach ($this->hand as $card) {
                $handArray[] = $card->getValue() . ' of ' . $card->getSuit();
            }
    
            return json_encode($handArray);
        } else {
            return "";
        }
    }
}
