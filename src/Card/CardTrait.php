<?php

namespace App\Card;

/**
 * A trait implementing deck of cards.
 */
trait CardTrait
{
    protected $suits = ['clubs', 'diamonds', 'hearts', 'spades'];

    public function jsonFormatContainer($container): string
    {
        $jsonDeck = [];

        foreach ($container as $card) {
            $jsonDeck[] = $card->getValue() . ' of ' . $card->getSuit();
        }

        return json_encode($jsonDeck);
    }

}
