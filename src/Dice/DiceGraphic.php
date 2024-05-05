<?php

namespace App\Dice;

use App\Dice\Dice;

class DiceGraphic extends Dice
{
    /**
     * @var string[] Array containing string representing the dice graphic
     */
    private $representation = [
        '⚀',
        '⚁',
        '⚂',
        '⚃',
        '⚄',
        '⚅',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getAsString(): string
    {
        return $this->representation[$this->value - 1];
    }
}
