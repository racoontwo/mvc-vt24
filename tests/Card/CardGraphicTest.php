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
    public function testCreateCardGraphic(): void
    {
        $card = new CardGraphic(4, "spades");
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $res = $card->getAsString();
        $this->assertNotEmpty($res);
    }

    public function testGetRaw(): void
    {
        $card = new CardGraphic(4, "spades");
        $res = $card->getAsRaw();

        $this->assertStringContainsString("4", $res);
        $this->assertStringContainsString("spades", $res);
    }

    public function testSuits(): void
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

    public function testGetAsText(): void
    {
        $suits = ["spades", "diamonds", "hearts", "clubs"];
        $dress = ["Jack", "Queen", "King", "Ace"];
        $cardContainer = [];
        $index = 0;
        $startNumber = 11;

        foreach ($suits as $suit) {
            if ($startNumber > 13) {
                $startNumber = 1;
            }
            $card = new CardGraphic($startNumber, $suit);
            $cardContainer[] = $card;
            $startNumber += 1;
        }

        foreach ($cardContainer as $card) {
            $res = $card->getAsText();
            $this->assertNotEmpty($res);
            $this->assertStringContainsString(ucfirst($suits[$index]), $res);
            $this->assertStringContainsString(ucfirst($dress[$index]), $res);
            $index += 1;
        }

        $unknownCard = new CardGraphic(4, "Peter");
        $unRes = $unknownCard->getAsText();
        $this->assertStringContainsString("Unknown", $unRes);
    }
}
