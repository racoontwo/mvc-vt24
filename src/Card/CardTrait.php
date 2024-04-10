<?php

namespace App\Card;

/**
 * A trait implementing deck of cards.
 */
trait CardTrait
{
    protected $suits = ['clubs', 'diamonds', 'hearts', 'spades'];

    public function printHistogram()
    {
        $histogram = '';

        foreach ($this->suits as $suit) {
            $count = 0;
            foreach ($this->cards as $card) {
                if ($card->getSuit() === $suit) {
                    $count++;
                }
            }
            $histogram .= ucfirst($suit) . ": " . str_repeat('* ', $count) . "\n";
        }

        return $histogram;
    }

}
