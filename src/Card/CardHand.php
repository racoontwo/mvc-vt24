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

    public function __construct(array $remaining_cards = [])
    {
        if (!empty($remaining_cards)) {
            $this->hand = [];
        }

        $this->hand = $remaining_cards;
    }

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

    public function loadFromJson(string $json): void
    {
        $handArray = json_decode($json, true);

        if (!is_array($handArray)) {
            throw new \InvalidArgumentException("Invalid JSON format.");
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
            throw new \InvalidArgumentException("Invalid JSON format.");
        }

        $cardHand = new CardHand();

        foreach ($handArray as $cardString) {
            list($value, $suit) = explode(" of ", $cardString);
            $cardHand->add(new CardGraphic($value, $suit));
        }

        return $cardHand;
    }


}
