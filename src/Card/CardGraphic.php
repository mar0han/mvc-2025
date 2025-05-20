<?php

namespace App\Card;

class CardGraphic extends Card
{
    // array with suits keys, each with a list of card values and symbols
    private array $cardGraphics = [
        'Hearts' => [
            'A' => '🂱', '2' => '🂲', '3' => '🂳', '4' => '🂴', '5' => '🂵',
            '6' => '🂶', '7' => '🂷', '8' => '🂸', '9' => '🂹', '10' => '🂺',
            'J' => '🂻', 'Q' => '🂽', 'K' => '🂾',
        ],
         'Spades' => [
            'A' => '🂡', '2' => '🂢', '3' => '🂣', '4' => '🂤', '5' => '🂥',
            '6' => '🂦', '7' => '🂧', '8' => '🂨', '9' => '🂩', '10' => '🂪',
            'J' => '🂫', 'Q' => '🂭', 'K' => '🂮',
        ],
        'Diamonds' => [
            'A' => '🃁', '2' => '🃂', '3' => '🃃', '4' => '🃄', '5' => '🃅',
            '6' => '🃆', '7' => '🃇', '8' => '🃈', '9' => '🃉', '10' => '🃊',
            'J' => '🃋', 'Q' => '🃍', 'K' => '🃎',
        ],
        'Clubs' => [
            'A' => '🃑', '2' => '🃒', '3' => '🃓', '4' => '🃔', '5' => '🃕',
            '6' => '🃖', '7' => '🃗', '8' => '🃘', '9' => '🃙', '10' => '🃚',
            'J' => '🃛', 'Q' => '🃝', 'K' => '🃞',
        ],
    ];

    // card as a string symbol
    public function getAsString(): string
    {
        // find symbol for cards suit and value
        $symbol = $this->cardGraphics[$this->suit][$this->value];
        return "{$symbol}";
    }
}
