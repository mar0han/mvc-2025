<?php

namespace App\Controller;

use App\Card\Deck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardControllerJson extends AbstractController
{
    #[Route('/api/deck', name: 'deck_api', methods: ['GET'])]
    public function sortedDeck(): JsonResponse
    {
        // make a full deck
        $deck = new Deck();

        // return deck as JSON response
        return $this->json([
            'deck' => $deck->getCards(),
        ]);
    }

    #[Route('/api/deck/shuffle', name: 'shuffle_api', methods: ['GET'])]
    public function shuffleDeck(
        SessionInterface $session
    ): JsonResponse {
        // make a full deck
        $deck = new Deck();
        // shuffle cards
        $deck->shuffle();
        // save shuffled deck to session
        $session->set('card_deck', $deck);

        // return shuffled deck as JSON
        return $this->json([
            'deck' => $deck->getCards(),
        ]);
    }

    #[Route('/api/deck/draw', name: 'draw_one_api', methods: ['GET'])]
    public function drawOne(
        SessionInterface $session
    ): JsonResponse {
        // use drawNumber function to draw 1 card
        return $this->drawNumber($session, 1);
    }

    #[Route('/api/deck/draw/{number<\d+>}', name: 'draw_number_api', methods: ['GET'])]
    public function drawNumber(
        SessionInterface $session,
        int $number
    ): JsonResponse {
        // get deck from session
        $deck = $session->get('card_deck');

        // if there is no deck, create and shuffle new one
        if (!$deck) {
            $deck = new Deck();
            $deck->shuffle();
        }

        // draw cards from deck
        $drawn = $deck->draw($number);
        // save updated deck back to session
        $session->set('card_deck', $deck);

        // return drawn cards and how many cards are left
        return $this->json([
            'drawn' => $drawn,
            'remaining' => $deck->count(),
        ]);
    }
}
