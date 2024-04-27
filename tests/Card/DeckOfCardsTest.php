<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

/**
 * Test cases for class DeckOfCards
 */
class DeckOfCardsTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDeck(): void
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);
    }

    public function testCreateDeckWithArgument(): void
    {
        $array = ["2 of hearts","8 of diamonds","11 of clubs"];

        $deck = new DeckOfCards($array);

        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);
    }

    public function testAddCard(): void
    {
        $array = ["2 of hearts","8 of diamonds","11 of clubs"];

        $deck = new DeckOfCards($array);

        $card = new CardGraphic(7, "hearts");
        $deck->add($card);
        $drawnCard = $deck->drawCard();
        $drawnCard = $deck->drawCard();
        $drawnCard = $deck->drawCard();
        $drawnCard = $deck->drawCard();

        $this->assertEquals($card, $drawnCard);

        $drawnCard = $deck->drawCard();

        $this->assertEquals(null, $drawnCard);
    }

    public function testCardsLeft(): void
    {
        $array = ["2 of hearts","8 of diamonds","11 of clubs"];

        $deck = new DeckOfCards($array);

        $left = $deck->cardsLeft();
        $this->assertEquals($left, 3);
    }

    public function testRemainingCards(): void
    {
        $array = ["2 of hearts", "8 of diamonds", "6 of clubs"];
        $cardContainer = [];

        foreach ($array as $card) {
            list($rank, $suit) = explode(" of ", $card);
            $rank = (int)$rank;

            $card = new CardGraphic($rank, $suit);
            $cardContainer[] = $card->getAsText();
        }

        $deck = new DeckOfCards($array);
        $remainingCards = $deck->getRemainingCards();

        $remAsArray = [];
        foreach ($remainingCards as $card) {
            $remAsArray[] = $card->getAsText();
        }

        if (is_array($remAsArray)) {
            $this->assertEquals($remAsArray, $cardContainer);
        }
    }

    public function testSortedAndShuffled(): void
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf(DeckOfCards::class, $deck);

        $shuffled = $deck->shuffle();
        $this->assertNotEquals($deck, $shuffled);

        $deck->sortDeck();
        $this->assertInstanceOf(DeckOfCards::class, $deck);

        $drawCard = $deck->drawCard();
        $this->assertNotNull($drawCard);

        $this->assertInstanceOf(Card::class, $drawCard);

        $comparison = "Ace of Clubs";
        $this->assertEquals($comparison, $drawCard->getAsText());

        $drawCard = $deck->drawCard();
        $this->assertNotNull($drawCard);

        $this->assertInstanceOf(Card::class, $drawCard);

        $comparison = "2 of Clubs";
        $this->assertEquals($comparison, $drawCard->getAsText());
    }

    public function testJsonShuffledDeck(): void
    {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $jsonDeck = $deck->jsonSortedDeck();
        $expectedJson = '{"clubs":[1,2,3,4,5,6,7,8,9,10,11,12,13],"diamonds":[1,2,3,4,5,6,7,8,9,10,11,12,13],"hearts":[1,2,3,4,5,6,7,8,9,10,11,12,13],"spades":[1,2,3,4,5,6,7,8,9,10,11,12,13]}';
        $this->assertEquals($expectedJson, $jsonDeck);
    }
    public function testJsonRaw(): void
    {
        $deck = new DeckOfCards();
        $jsonDeck = $deck->jsonDeckRaw();
        $expectedJson = '["1 of clubs","2 of clubs","3 of clubs","4 of clubs","5 of clubs","6 of clubs","7 of clubs","8 of clubs","9 of clubs","10 of clubs","11 of clubs","12 of clubs","13 of clubs","1 of diamonds","2 of diamonds","3 of diamonds","4 of diamonds","5 of diamonds","6 of diamonds","7 of diamonds","8 of diamonds","9 of diamonds","10 of diamonds","11 of diamonds","12 of diamonds","13 of diamonds","1 of hearts","2 of hearts","3 of hearts","4 of hearts","5 of hearts","6 of hearts","7 of hearts","8 of hearts","9 of hearts","10 of hearts","11 of hearts","12 of hearts","13 of hearts","1 of spades","2 of spades","3 of spades","4 of spades","5 of spades","6 of spades","7 of spades","8 of spades","9 of spades","10 of spades","11 of spades","12 of spades","13 of spades"]';
        $this->assertEquals($expectedJson, $jsonDeck);
    }
    public function testJsonDeckPretty(): void
    {
        $deck = new DeckOfCards();
        $jsonDeck = $deck->jsonDeckPretty();
        if (is_string($jsonDeck) && !empty($jsonDeck)) {
            $array = json_decode($jsonDeck, true);
            if (is_array($array)) {
                $this->assertEquals(52, count($array));
                $this->assertEquals("Ace of Clubs", $array[0]);
                $this->assertEquals("7 of Clubs", $array[6]);
            }
        }
    }
    public function testCreateFromJson(): void
    {
        $json = '["2 of hearts","8 of diamonds","11 of clubs"]';

        $deck = DeckOfCards::createFromJson($json);

        $expectedHand = [
            new CardGraphic(2, "hearts"),
            new CardGraphic(8, "diamonds"),
            new CardGraphic(11, "clubs")
        ];

        $this->assertEquals($expectedHand, $deck->getRemainingCards());
        
        $invalidJson = '["2 of hearts","8 of diamonds",';

        $this->expectException(InvalidArgumentException::class);
        DeckOfCards::createFromJson($invalidJson);
    }
}
