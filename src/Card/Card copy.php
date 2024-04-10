<?php

namespace App\Card;

class Card
{
    use CardTrait;

    protected $value;
    protected $suit;

    public function __construct()
    {
        $this->value = null;
    }

    public static function create($value, $suit)
    {
        return new Card($value, $suit);
    }

    public function pick(): void
    {
        $this->value = random_int(1, 13);
        $this->suit = $this->suits[array_rand($this->suits)];
    }

    public function setCard(int $number, string $suit): void
    {
        if ($number < 1 || $number > 13) {
            throw new \InvalidArgumentException("Invalid card number: $number");
        }

        if (!in_array($suit, $this->suits)) {
            throw new \InvalidArgumentException("Invalid card suit: $suit");
        }

        $this->suit = $suit;
        $this->value = $number;
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
