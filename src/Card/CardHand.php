<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardGraphic;

use InvalidArgumentException;

class CardHand
{
    use CardTrait;
    /**
     * @var CardGraphic
     */
    private $hand;

    public function __construct(array $cardArray = [])
    {
        if (!empty($cardArray)) {
            $this->hand = [];
        }
        $this->hand = $cardArray;
    }

    public function add(CardGraphic $card): void
    {
        $this->hand[] = $card;
    }

    public function draw()
    {
        return !empty($this->hand) ? array_shift($this->hand) : null;
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
        return ($this->hand !== null) ? json_encode(array_map(function ($card) {
            return $card->getValue() . ' of ' . $card->getSuit();
        }, $this->hand)) : "";
    }
    

    public function loadFromJson(string $json): void
    {
        $handArray = json_decode($json, true);

        if (!is_array($handArray)) {
            throw new InvalidArgumentException("Invalid JSON format.");
        }

        foreach ($handArray as $cardString) {
            list($value, $suit) = explode(" of ", $cardString);
            $this->add(new CardGraphic($value, $suit));
        }
    }

    public static function createFromJson(string $json): CardHand
    {
        $handArray = json_decode($json, true);

        if (!is_array($handArray)) {
            throw new InvalidArgumentException("Invalid JSON format.");
        }

        $cardHand = new CardHand();

        foreach ($handArray as $cardString) {
            list($value, $suit) = explode(" of ", $cardString);
            $cardHand->add(new CardGraphic($value, $suit));
        }
        return $cardHand;
    }
}
