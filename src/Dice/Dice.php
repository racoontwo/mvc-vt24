<?php

namespace App\Dice;

class Dice
{
    /**
     * @var integer
     */
    protected $value;

    public function __construct()
    {
    }

    public function roll(): int
    {
        $this->value = random_int(1, 6);
        return $this->value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getAsString(): string
    {
        return "[{$this->value}]";
    }
}
