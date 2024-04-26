<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardGraphic.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use arguments.
     */
    public function testCreateCardGraphic()
    {
        $card = new CardGraphic(4, "spades");
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $res = $card->getAsString();
        $this->assertNotEmpty($res);
    }

    public function testGetRaw()
    {
        $card = new CardGraphic(4, "spades");
        $res = $card->getAsRaw();

        $this->assertStringContainsString("4", $res);
        $this->assertStringContainsString("spades", $res);
    }

    public function testSuits()
    {
        $suits = ["spades", "diamonds", "hearts", "clubs", "joker"];
        $cardContainer = [];

        foreach ($suits as $suit) {
            $card = new CardGraphic(4, $suit);
            $cardContainer[] = $card;
        }

        foreach ($cardContainer as $card) {
            $res = $card->getAsString();
            $this->assertNotEmpty($res);
        }
    }

    public function testGetAsText()
    {
        $suits = ["spades", "diamonds", "hearts", "clubs"];
        $dress = ["Jack", "Queen", "King", "Ace"];
        $cardContainer = [];
        $i = 0;
        $j = 11;

        foreach ($suits as $suit) {
            if ($j > 13) {
                $j = 1;
            }
            $card = new CardGraphic($j, $suit);
            $cardContainer[] = $card;
            $j += 1;
        }

        foreach ($cardContainer as $card) {
            $res = $card->getAsText();
            $this->assertNotEmpty($res);
            $this->assertStringContainsString(ucfirst($suits[$i]), $res);
            $this->assertStringContainsString(ucfirst($dress[$i]), $res);
            $i += 1;
        }

        $unknownCard = new CardGraphic(4, "Peter");
        $unRes = $unknownCard->getAsText();
        $this->assertStringContainsString("Unknown", $unRes);

    }

}