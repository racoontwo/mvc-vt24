<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardTrait
 */
class CardTraitTest extends TestCase
{
    use CardTrait;

    // Test the jsonFormatContainer method
    public function testJsonFormatContainer()
    {
        $cards = [
            new CardGraphic(9, 'hearts'),
            new CardGraphic(4, 'diamonds'),
            new CardGraphic(7, 'clubs')
        ];

        $jsonString = $this->jsonFormatContainer($cards);

        $expectedJson = '["9 of hearts","4 of diamonds","7 of clubs"]';

        $this->assertEquals($expectedJson, $jsonString);
    }
}
