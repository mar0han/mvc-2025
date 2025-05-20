<?php

namespace App\Card;

class Deck
{
    private array $cards = [];

    public function __construct()
    {
        if (!empty($cards)) {
            $this->cards = $cards;
            return;
        }
        // list of suits
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        // list of values
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

        // loop over all suits and values
        foreach ($suits as $suit) {
            foreach ($values as $value) {
                // makes new card and adds card to deck list
                $this->cards[] = new CardGraphic($suit, $value);
            }
        }
    }

    // shuffle cards in hand (using php-method, randomly mixes elements in array)
    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    public function draw(int $count = 1): array
    {
        // drawn cards
        $drawn = [];
        // how many cards left in deck
        $cardsCount = count($this->cards);
        // how many cards to draw
        $toDraw = $count;

        // gets first $toDraw cards from deck
        for ($i = 0; $i < $toDraw; $i++) {
            $drawn[] = $this->cards[$i];
        }

        // new array for cards that were not drawn
        $newCards = [];
        for ($i = $toDraw; $i < $cardsCount; $i++) {
            $newCards[] = $this->cards[$i];
        }

        // replace old deck with the remaining cards
        $this->cards = $newCards;

        return $drawn;
    }

    // return how many cards are left in deck
    public function count(): int
    {
        return count($this->cards);
    }

    // return all cards in deck at the moment
    public function getCards(): array
    {
        return $this->cards;
    }
}
