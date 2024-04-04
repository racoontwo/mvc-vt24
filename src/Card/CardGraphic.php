<?php

namespace App\Card;

class CardGraphic extends Card
{
    private $representation = [
        '⚀',
        '⚁',
        '⚂',
        '⚃',
        '⚄',
        '⚅',
    ];

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
        '🃌',
        '🃍',
        '🃎',
    ];

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
        '🃜',
        '🃝',
        '🃞',
    ];

    private $joker = '🃟';
    private $joker2 = '🃏';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAsString(): string
    {
        return $this->clubs[$this->value - 1];
    }
}