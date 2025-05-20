<?php

namespace App\Card;

class Card
{
    // what suit the card has
    protected string $suit;
    // what value the card has
    protected string $value;

    // sets suit and value when creating new card
    public function __construct(string $suit, string $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    // get suit of card
    public function getSuit(): string
    {
        return $this->suit;
    }

    // get value of card
    public function getValue(): string
    {
        return $this->value;
    }
}
