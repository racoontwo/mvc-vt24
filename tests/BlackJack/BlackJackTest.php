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
    public function testCreateBlackJack()
    {
        $game = new BlackJack();
        $this->assertInstanceOf("\App\BlackJack\BlackJack", $game);
    }
    public function testCreateBlackJackWithArgument()
    {
        $deck = new DeckOfCards();
        $player = new CardHand();
        $house = new CardHand();
        $game = new BlackJack($deck, $player, $house);
        $this->assertNotNull($game, "Game object should not be null");
    }
    public function testHitMe()
    {
        $game = new BlackJack();
        $card = $game->hitMe();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);
    }
    // public function testShuffle()
    // {
    //     $game = new BlackJack();
    //     $game->shuffleDeck();
    //     $card = $game->hitMe();
    //     $this->assertNotEqual("Ace of clubs", $card->getAsText());
    // }
}
