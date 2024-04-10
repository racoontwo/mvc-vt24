<?php

namespace App\Card;

use App\Card\Card;
use App\Card\CardGraphic;

class CardHand
{
    /**
     * @var CardGraphic
     */
    private $deck;
    private $cards;

    public function __construct(int $cards = 52)
    {

    }

}

// class DiceHand
// {
//     /**
//      * @var Dice $dices   Array consisting of dices.
//      * @var int  $values  Array consisting of last roll of the dices.
//      */
//     private $dices;
//     private $values;

//     /**
//      * Constructor to initiate the dicehand with a number of dices.
//      *
//      * @param int $dices Number of dices to create, defaults to five.
//      */
//     public function __construct(int $dices = 5)
//     {
//         $this->dices  = [];
//         $this->values = [];

//         for ($i = 0; $i < $dices; $i++) {
//             $this->dices[]  = new Dice();
//             $this->values[] = null;
//         }
//     }
