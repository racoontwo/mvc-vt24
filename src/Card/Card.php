<?php

namespace App\Card;

class Card
{
    protected $value;
    protected $suit;

    public function __construct()
    {
        $this->value = null;
        $this->suit = null;
    }

    public function pick(): void
    {
        $this->value = random_int(1, 13);
        $suits = ['clubs', 'diamonds', 'hearts', 'spades'];
        $this->suit = $suits[array_rand($suits)];
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getAsString(): string
    {
        return "[{$this->value} of {$this->suit}]";
    }
}
