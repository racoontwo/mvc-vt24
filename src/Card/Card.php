<?php

namespace App\Card;

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
    

    public function pick(): Card
    {
        $this->value = random_int(1, 13);
        $this->suit = $this->suits[array_rand($this->suits)];
        return new Card($this->value, $this->suit);
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
