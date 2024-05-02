<?php

namespace App\BlackJack;

use App\Card\CardHand;
use App\Card\CardGraphic;
use App\Card\DeckOfCards;

class BlackJack
{
    /**
     * @var DeckOfCards
     */
    private $deck;
    /**
     * @var CardHand
     */
    private $playerHand;
    /**
     * @var CardHand
     */
    private $dealerHand;

    // public function __construct(DeckOfCards $deck, CardHand $playerHand, CardHand $dealerHand)
    // {
    //     $this->deck = $deck;
    //     $this->playerHand = $playerHand;
    //     $this->dealerHand = $dealerHand;
    // }
    public function __construct(DeckOfCards $deck = null, CardHand $playerHand = null, CardHand $dealerHand = null)
    {
        $this->deck = $deck ?? new DeckOfCards();
        $this->playerHand = $playerHand ?? new CardHand();
        $this->dealerHand = $dealerHand ?? new CardHand();
    }
    /**
     * Draws a card from the deck and adds it to the player's hand.
     *
     * @return CardGraphic The card drawn from the deck and added to the player's hand.
     */
    public function hitMe(): CardGraphic
    {
        $card = $this->deck->drawCard();
        $this->playerHand->add($card);

        return $card;
    }



    /**
     * Shuffles the deck of cards.
     * It rearranges the order of cards randomly, making it ready for the next round of the game.
     *
     * @return void
     */
    public function shuffleDeck(): void
    {
        $this->deck->shuffle();
    }

    /**
     * Returns the current deck of cards
     *
     * @return DeckOfCards
     */
    public function getDeck(): DeckOfCards
    {
        return $this->deck;
    }

    /**
     * Returns the current player hand of cards
     *
     * @return CardHand
     */
    public function getPlayerHand(): CardHand
    {
        return $this->playerHand;
    }
    /**
     * Returns the current dealer/house hand of cards
     *
     * @return CardHand
     */
    public function getDealerHand(): CardHand
    {
        return $this->dealerHand;
    }

    /**
     * Checks if either the player or the dealer has busted (gone over 21).
     *
     * @return bool|null Returns true if either the player or the dealer has busted,
     *                  otherwise returns null if neither has busted.
     */
    public function busted(): null|true
    {
        if ($this->dealerHand->getHandSum() > 21 || $this->playerHand->getHandSum() > 21) {
            return true;
        }
        return null;
    }

    /**
     * Determines the result of the player's hand in the game and returns it.
     *
     * @return string|null Returns a string indicating the result of the player's hand. Or null.
     */
    public function getPlayerResult()
    {
        if ($this->playerHand->getHandSum() > 21) {
            return "You lost ...";
        };

        if ($this->playerHand->getHandSum() == 21) {
            return "Black Jack!";
        };

        return null;
    }

    /**
     * After the player has drawn his/her cards, this function draws the cards for the dealer
     *
     * @return CardHand The dealer's hand after drawing cards.
     */
    public function drawDealerCards()
    {
        while ($this->dealerHand->getHandSum() <= 17) {
            $card = $this->deck->drawCard();
            $this->dealerHand->add($card);
        }
        return $this->dealerHand;
    }

    /**
     * Returns whoever is the winner, either player or house.
     *
     * @return string The string saying who won.
     */
    public function getWinner()
    {
        if ($this->dealerHand->getHandSum() > 21) {
            return "Player wins";
        }
        if ($this->playerHand->getHandSum() > $this->dealerHand->getHandSum()) {
            return "Player wins";
        }
        return "House wins";
    }

    /**
     * Creates a new instance of the Blackjack game from JSON data.
     *
     * @param array $jsonData An array containing JSON data representing the Blackjack game.
     *                        It should have keys 'deck', 'player_hand', and 'dealer_hand'.
     * @return BlackJack A new instance of the Blackjack game initialized with the provided JSON data.
     */
    public static function createFromJson(array $jsonData): BlackJack
    {
        $blackjack = new self();

        $blackjack->deck = DeckOfCards::createFromJson($jsonData['deck']);
        $blackjack->playerHand = CardHand::createFromJson($jsonData['player_hand']);
        $blackjack->dealerHand = CardHand::createFromJson($jsonData['dealer_hand']);

        return $blackjack;
    }

    /**
     * Converts the current state of the Blackjack game to a JSON representation to be used for session storage.
     *
     * @return array An array representing the current state of the Blackjack game in JSON format.
     */
    public function exportToJson(): array
    {
        $gameData = [
            'deck' => $this->deck->jsonDeckRaw(),
            'player_hand' => $this->playerHand->getHandAsJson(),
            'dealer_hand' => $this->dealerHand->getHandAsJson(),
        ];
        return $gameData;
    }
}
