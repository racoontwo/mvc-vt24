<?php

namespace App\Card;

class CardGraphic extends Card
{
    use CardTrait;

    /**
     * @var array
     */
    private $diamonds = [
        '🃁',
        '🃂',
        '🃃',
        '🃄',
        '🃅',
        '🃆',
        '🃇',
        '🃈',
        '🃉',
        '🃊',
        '🃋',
        '🃍',
        '🃎',
    ];
    /**
     * @var array
     */
    private $clubs = [
        '🃑',
        '🃒',
        '🃓',
        '🃔',
        '🃕',
        '🃖',
        '🃗',
        '🃘',
        '🃙',
        '🃚',
        '🃛',
        '🃝',
        '🃞',
    ];
    /**
     * @var array
     */
    private $hearts = [
        '🂱',
        '🂲',
        '🂳',
        '🂴',
        '🂵',
        '🂶',
        '🂷',
        '🂸',
        '🂹',
        '🂺',
        '🂻',
        '🂽',
        '🂾',
    ];
    /**
     * @var array
     */
    private $spades = [
        '🂡',
        '🂢',
        '🂣',
        '🂤',
        '🂥',
        '🂦',
        '🂧',
        '🂨',
        '🂩',
        '🂪',
        '🂫',
        '🂭',
        '🂮',
    ];

    private $joker = '🃟';

    public function __construct($value = null, $suit = null)
    {
        parent::__construct($value, $suit);
    }


    public function getAsRaw(): string
    {
        return "[{$this->value} of {$this->suit}]";
    }

    public function getAsString(): string
    {
        switch ($this->suit) {
            case 'diamonds':
                return $this->diamonds[$this->value - 1];
            case 'clubs':
                return $this->clubs[$this->value - 1];
            case 'hearts':
                return $this->hearts[$this->value - 1];
            case 'spades':
                return $this->spades[$this->value - 1];
            default:
                return $this->joker; // Return joker for invalid suit
        }
    }


    public function getAsText(): string
    {
        switch ($this->suit) {
            case 'diamonds':
                $suitText = 'Diamonds';
                break;
            case 'clubs':
                $suitText = 'Clubs';
                break;
            case 'hearts':
                $suitText = 'Hearts';
                break;
            case 'spades':
                $suitText = 'Spades';
                break;
            default:
                $suitText = 'Unknown';
                break;
        }

        switch ($this->value) {
            case 1:
                $valueText = 'Ace';
                break;
            case 11:
                $valueText = 'Jack';
                break;
            case 12:
                $valueText = 'Queen';
                break;
            case 13:
                $valueText = 'King';
                break;
            default:
                $valueText = (string)$this->value;
                break;
        }
        return "$valueText of $suitText";
    }
}
