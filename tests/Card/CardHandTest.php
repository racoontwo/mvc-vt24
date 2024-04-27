<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateCardHandWithArgument(): void
    {
        $card = new Card();
        $array = [];
        $pickedCard = $card->pick(); // Store the picked card
        $array[] = $pickedCard; // Add it to the array
        $cardHand = new CardHand($array);
        $this->assertInstanceOf("\App\Card\CardHand", $cardHand);
    }

    public function testAddCard(): void
    {
        $card = new CardGraphic(4, "clubs");
        $cardComparison = $card->getAsString();
        $cardHand = new CardHand();
        $cardHand->add($card);

        $drawnCard = $cardHand->draw();
        $drawnCard = $drawnCard->getAsString();

        $this->assertEquals($cardComparison, $drawnCard);
    }
    public function testDrawCard(): void
    {
        $card = new CardGraphic(4, "clubs");
        $cardComparison = $card->getAsString();
        $cardHand = new CardHand();
        $cardHand->add($card);

        $drawnCard = $cardHand->draw();
        $drawnCard = $drawnCard->getAsString();

        $this->assertEquals($cardComparison, $drawnCard);

        $drawnCard = $cardHand->draw();

        $this->assertEquals(null, $drawnCard);
    }

    public function testGetNumberCards(): void
    {
        $number = 9;
        $cardHand = new CardHand();

        for ($i = 1; $i < $number; $i++) {
            $card = new CardGraphic($i, "clubs");
            $cardHand->add($card);
        }

        $totalNumber = $cardHand->getNumberCards();
        $this->assertEquals($number - 1, $totalNumber);
    }

    public function testGetHand(): void
    {
        $cardHand = new CardHand();

        $hand = $cardHand->getHand();

        $this->assertIsArray($hand);
    }

    public function testGetHandSum(): void
    {
        $number = 9;
        $cardHand = new CardHand();

        for ($i = 1; $i <= $number; $i++) {
            $card = new CardGraphic($i, "clubs");
            $cardHand->add($card);
        }

        $ariPro = 45;

        $totalSum = $cardHand->getHandSum();
        $this->assertEquals($ariPro, $totalSum);
    }

    public function testGetHandAsJsonWithCards(): void
    {
        $cardHand = new CardHand();
        $cardHand->add(new CardGraphic(2, "hearts"));
        $cardHand->add(new CardGraphic(8, "diamonds"));
        $cardHand->add(new CardGraphic(11, "clubs"));
        $expectedJson = '["2 of hearts","8 of diamonds","11 of clubs"]';
        $this->assertEquals($expectedJson, $cardHand->getHandAsJson());
    }

    public function testGetHandAsJsonWithEmptyHand(): void
    {
        $cardHand = new CardHand();
        $this->assertEquals("[]", $cardHand->getHandAsJson());
    }

    public function testLoadFromJson(): void
    {
        $cardHand = new CardHand();

        $json = '["7 of hearts","3 of diamonds","2 of spades"]';

        $cardHand->loadFromJson($json);

        $expectedHand = [
            new CardGraphic(7, "hearts"),
            new CardGraphic(3, "diamonds"),
            new CardGraphic(2, "spades")
        ];

        $this->assertEquals($expectedHand, $cardHand->getHand());

        $cardHand = new CardHand();

        $invalidJson = '["2 of hearts","8 of diamonds",';

        $this->expectException(InvalidArgumentException::class);
        $cardHand->loadFromJson($invalidJson);
    }

    public function testCreateFromJson(): void
    {
        $json = '["2 of hearts","8 of diamonds","11 of clubs"]';

        $cardHand = CardHand::createFromJson($json);

        $expectedHand = [
            new CardGraphic(2, "hearts"),
            new CardGraphic(8, "diamonds"),
            new CardGraphic(11, "clubs")
        ];

        $this->assertEquals($expectedHand, $cardHand->getHand());

        $invalidJson = '["2 of hearts","8 of diamonds",';

        $this->expectException(InvalidArgumentException::class);
        CardHand::createFromJson($invalidJson);
    }
}
