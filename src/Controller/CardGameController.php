<?php

namespace App\Controller;

use App\Card\Deck;
use App\Card\CardHand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardGameController extends AbstractController
{
    #[Route("/card", name: "card_home")]
    public function home(): Response
    {
        return $this->render('card/home.html.twig');
    }

    #[Route("/card/deck", name: "card_deck")]
    public function showDeck(): Response
    {
        // makes new full deck
        $deck = new Deck();

        return $this->render('card/deck.html.twig', [
            'cards' => $deck->getCards(),
        ]);
    }

    // shuffle deck and save it in session
    #[Route("/card/deck/shuffle", name: "card_shuffle")]
    public function shuffleDeck(SessionInterface $session): Response
    {
        $deck = new Deck();
        $deck->shuffle();

        // save deck to session
        $session->set("card_deck", $deck);

        return $this->render('card/deck.html.twig', [
            // show shuffled cards
            'cards' => $deck->getCards(),
            'shuffled' => true,
        ]);
    }

    #[Route("/card/deck/draw", name: "card_draw_post", methods: ['POST'])]
    public function drawPost(
        Request $request,
        SessionInterface $session
    ): Response {
        // get how many cards to draw
        $number = (int) $request->request->get('number', 1);
        $deck = $session->get("card_deck");

        // if no deck in session, create and shuffle one
        if (!$deck) {
            $deck = new Deck();
            $deck->shuffle();
        }

        // draw cards and put them in a CardHand
        $drawnCards = $deck->draw($number);
        $drawnHand = new CardHand($drawnCards);

        // save new deck and hand to session
        $session->set("card_deck", $deck);
        $session->set("drawn_hand", $drawnHand);

        // go to page that shows drawn cards
        return $this->redirectToRoute('card_draw_number', ['number' => $number]);
    }

    #[Route("/card/deck/draw", name: "card_draw_get", methods: ['GET'])]
    public function drawForm(
        SessionInterface $session
    ): Response {
        // get deck from session
        $deck = $session->get("card_deck");

        // if no deck in session, create and shuffle one
        if (!$deck) {
            $deck = new Deck();
            $deck->shuffle();
            $session->set("card_deck", $deck);
        }

        // show draw form
        return $this->render('card/draw.html.twig', [
            'cards' => [],
            'drawNumber' => 0,
            'remaining' => $deck->count(),
        ]);
    }

    // show cards that were drawn
    #[Route("/card/deck/draw/{number<\d+>}", name: "card_draw_number", methods: ['GET'])]
    public function drawGet(
        int $number,
        SessionInterface $session
    ): Response {
        // get drawn cards and current deck from session
        $drawnHand = $session->get("drawn_hand");
        $deck = $session->get("card_deck");

        // show drawn cards and how many are left
        return $this->render('card/draw.html.twig', [
            'cards' => $drawnHand?->getCards() ?? [],
            'drawNumber' => $number,
            'remaining' => $deck ? $deck->count() : 0,
        ]);
    }
}
