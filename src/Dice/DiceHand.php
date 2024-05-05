<?php

namespace App\Dice;

use App\Dice\Dice;

class DiceHand
{
    /**
     * @var Dice[] Array containing Die objects representing the dice in the hand.
     */
    private $hand = [];

    public function add(Dice $die): void
    {
        $this->hand[] = $die;
    }

    public function roll(): void
    {
        foreach ($this->hand as $die) {
            $die->roll();
        }
    }

    public function getNumberDices(): int
    {
        return count($this->hand);
    }
    /**
     * Get the values of the dice in the hand.
     * 
     * @return int[] Returns an array of integers representing the values of the dice.
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getValue();
        }
        return $values;
    }

    /**
     * Get the values of the dice in the hand as strings.
     * 
     * @return string[] Returns an array of strings representing the values of the dice.
     */
    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getAsString();
        }
        return $values;
    }
    public function sum(): int
    {
        $sum = 0;
        foreach ($this->hand as $die) {
            $sum += $die->getValue();
        }
        return $sum;
    }
}
