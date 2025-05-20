<?php

namespace App\Card;

class CardHand
{
    // holds all cards in hand
    private array $cards = [];

    public function __construct(array $cards = [])
    {
        $this->cards = $cards;
    }

    // add card to hand
    public function addCard(CardGraphic $card): void
    {
        $this->cards[] = $card;
    }

    // get all cards in hand as an array
    public function getCards(): array
    {
        return $this->cards;
    }

    // count how many cards are in hand
    public function count(): int
    {
        return count($this->cards);
    }


}
