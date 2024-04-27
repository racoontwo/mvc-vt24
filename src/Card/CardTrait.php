<?php

namespace App\Card;

/**
 * A trait implementing deck of cards.
 */
trait CardTrait
{
    protected array $suits = ['clubs', 'diamonds', 'hearts', 'spades'];

    public function jsonFormatContainer(array $container): string
    {
        $jsonDeck = [];
        foreach ($container as $card) {
            $jsonDeck[] = $card->getValue() . ' of ' . $card->getSuit();
        }
        return (string)json_encode($jsonDeck);
    }
}
