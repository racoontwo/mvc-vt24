<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateCard()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getAsString();
        $this->assertNotEmpty($res);
    }

    public function testCreateCardWithArgument()
    {
        $card = new Card(1, "clubs");
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->getAsString();
        $this->assertNotEmpty($res);
    }

    public function testPickCard()
    {
        $card = new Card();
        $card->pick();

        $value = $card->getValue();
        $suit = $card->getSuit();

        $this->assertNotEmpty($value);
        $this->assertNotEmpty($suit);

        $this->assertGreaterThanOrEqual(1, $value);
        $this->assertLessThanOrEqual(13, $value);
    
        $this->assertContains($suit, ['clubs', 'diamonds', 'hearts', 'spades']);

    }
}