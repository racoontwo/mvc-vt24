<?php

namespace App\Card;

/**
* This class is for the playing card.
*/
class Card
{
    use CardTrait;

    /**
     * @var integer
     */
    protected $value;
    /**
     * @var string
     */
    protected $suit;

    public function __construct(?int $value = null, ?string $suit = null)
    {
        $this->value = $value ?? null;
        $this->suit = $suit ?? null;
    }

    /**
    * This method is to pick a card with a random value.
    */
    public function pick(): Card
    {
        $this->value = random_int(1, 13);
        $this->suit = $this->suits[array_rand($this->suits)];
        return new Card($this->value, $this->suit);
    }
    /**
    * This method is to get the value of the card.
    */
    public function getValue(): int
    {
        return $this->value;
    }
    /**
    * This method is to get the suit of the card.
    */
    public function getSuit(): string
    {
        return $this->suit;
    }
    /**
    * This method is to get the information about the card in a string.
    */
    public function getAsString(): string
    {
        return "[{$this->value} of {$this->suit}]";
    }
}
