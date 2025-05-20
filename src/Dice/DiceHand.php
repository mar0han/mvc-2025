<?php

namespace App\Dice;

use App\Dice\Dice;

class DiceHand
{
    private $hand = [];

    // adds die to hand
    public function add(Dice $die): void
    {
        $this->hand[] = $die;
    }

    // roll all die in hand
    public function roll(): void
    {
        foreach ($this->hand as $die) {
            $die->roll();
        }
    }

    // how many die in hand
    public function getNumberDices(): int
    {
        return count($this->hand);
    }

    // get value of die in hand
    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getValue();
        }
        return $values;
    }

    // get value of die in hand as string
    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $die) {
            $values[] = $die->getAsString();
        }
        return $values;
    }
}
