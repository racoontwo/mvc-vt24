<?php

namespace App\BlackJack;

use PHPUnit\Framework\TestCase;
use App\Card\DeckOfCards;
use App\Card\CardHand;
use App\Card\CardGraphic;

/**
 * Test cases for class BlackJack.
 */
class BlackJackTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateBlackJack(): void
    {
        $game = new BlackJack();
        $this->assertInstanceOf("\App\BlackJack\BlackJack", $game);

        $deck = new DeckOfCards();
        $player = new CardHand();
        $house = new CardHand();
        $game = new BlackJack($deck, $player, $house);
        $this->assertNotNull($game, "Game object should not be null");
    }

    public function testHitMe(): void
    {
        $game = new BlackJack();
        $card = $game->hitMe();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);
    }
    public function testShuffle(): void
    {
        $game = new BlackJack();
        $countNotAceOfClubs = 0;
        $totalTests = 10; // Number of times to run the test

        for ($i = 0; $i < $totalTests; $i++) {
            $game->shuffleDeck();
            $card = $game->hitMe();
            if ($card->getAsText() !== "Ace of clubs") {
                $countNotAceOfClubs++;
            }
        }

        $this->assertTrue($countNotAceOfClubs > $totalTests / 2);
    }

    // public function testGetDeck(): void
    // {
    //     $game = new BlackJack();
    //     $deck = $game->getDeck();
    //     $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);
    //     $card = $deck->drawCard();
    //     $this->assertInstanceOf("\App\Card\Card", $card);
    // }

    public function testGetPlayerHand(): void
    {
        $game = new BlackJack();
        $game->hitMe();
        $cardHand = $game->getPlayerHand();
        $this->assertInstanceOf("\App\Card\CardHand", $cardHand);
        $card = $cardHand->draw();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $cardHand = $game->getDealerHand();
        $this->assertInstanceOf("\App\Card\CardHand", $cardHand);
    }

    public function testPlayerResult(): void
    {
        $deck = new DeckOfCards();
        $playerStub = $this->createMock(CardHand::class);
        $houseStub = new CardHand();
        $game = new BlackJack($deck, $playerStub, $houseStub);

        $playerStub->method('getHandSum')
            ->willReturn(22);

        $res = $game->getPlayerResult();
        $exp = "You lost ...";
        $this->assertEquals($exp, $res);

        $deck = new DeckOfCards();
        $playerStub = $this->createMock(CardHand::class);
        $houseStub = new CardHand();
        $game = new BlackJack($deck, $playerStub, $houseStub);

        $playerStub->method('getHandSum')
        ->willReturn(21);

        $res = $game->getPlayerResult();
        $exp = "Black Jack!";
        $this->assertEquals($exp, $res);
    }

    public function testBusted(): void
    {
        $deck = new DeckOfCards();
        $playerStub = $this->createMock(CardHand::class);
        $houseStub = $this->createMock(CardHand::class);
        $game = new BlackJack($deck, $playerStub, $houseStub);

        $playerStub->method('getHandSum')
            ->willReturn(10);

        $houseStub->method('getHandSum')
            ->willReturn(18);

        $res = $game->busted();
        $exp = null;
        $this->assertEquals($exp, $res);
    }

    public function testDrawDealerCards(): void
    {
        $game = new BlackJack();
        $cards = $game->drawDealerCards();
        $this->assertIsArray($cards->getHand());
    }

    public function testGetWinner(): void
    {

        $deck = new DeckOfCards();
        $playerStub = $this->createMock(CardHand::class);
        $houseStub = $this->createMock(CardHand::class);
        $game = new BlackJack($deck, $playerStub, $houseStub);

        $playerStub->method('getHandSum')
            ->willReturn(10);

        $houseStub->method('getHandSum')
            ->willReturn(18);

        $res = $game->getWinner();
        $exp = "House wins";
        $this->assertEquals($exp, $res);

        $deck = new DeckOfCards();
        $playerStub = $this->createMock(CardHand::class);
        $houseStub = $this->createMock(CardHand::class);
        $game = new BlackJack($deck, $playerStub, $houseStub);

        $playerStub->method('getHandSum')
            ->willReturn(18);

        $houseStub->method('getHandSum')
            ->willReturn(10);

        $res = $game->getWinner();
        $exp = "Player wins";
        $this->assertEquals($exp, $res);
    }

    public function testCreateFromJson(): void
    {
        $jsonString = '{
            "deck": "[\"9 of hearts\",\"6 of hearts\",\"11 of spades\",\"13 of clubs\",\"8 of diamonds\",\"12 of hearts\",\"4 of hearts\",\"7 of spades\",\"8 of hearts\",\"3 of hearts\",\"12 of spades\",\"11 of clubs\",\"9 of spades\",\"9 of clubs\",\"5 of diamonds\",\"2 of diamonds\",\"5 of spades\",\"2 of clubs\",\"13 of spades\",\"1 of spades\",\"1 of clubs\",\"10 of hearts\",\"3 of diamonds\",\"9 of diamonds\",\"2 of hearts\",\"3 of clubs\",\"7 of diamonds\",\"4 of diamonds\",\"13 of diamonds\",\"10 of diamonds\",\"11 of hearts\",\"10 of clubs\",\"6 of clubs\",\"7 of hearts\",\"6 of spades\",\"10 of spades\",\"6 of diamonds\",\"12 of clubs\",\"8 of clubs\",\"5 of clubs\",\"12 of diamonds\",\"11 of diamonds\",\"4 of spades\",\"7 of clubs\",\"13 of hearts\",\"5 of hearts\",\"2 of spades\",\"4 of clubs\",\"3 of spades\",\"8 of spades\"]",
            "player_hand": "[\"1 of hearts\",\"1 of diamonds\"]",
            "dealer_hand": "[]"
        }';

        $jsonArray = json_decode($jsonString, true);
        $game = BlackJack::createFromJson($jsonArray);
        $this->assertInstanceOf("\App\BlackJack\BlackJack", $game);
    }
    public function testExportToJson(): void
    {
        $game = new BlackJack();
        $jsonData = $game->exportToJson();
        // Asserting return type
        $this->assertIsArray($jsonData);
    }
}
