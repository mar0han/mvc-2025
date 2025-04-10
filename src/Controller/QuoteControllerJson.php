<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class QuoteControllerJson extends AbstractController
{
    #[Route('/api/quote', name: 'api_quote')]
    public function quote(): JsonResponse
    {
        $quotes = [
            "Keep coding, keep dreaming.",
            "Simplicity is the soul of efficiency.",
            "Bugs are just features in disguise.",
            "Don’t fear mistakes, fear not learning from them.",
        ];

        $selectedQuote = $quotes[array_rand($quotes)];

        return $this->json([
            'quote' => $selectedQuote,
            'date' => date('Y-m-d'),
            'timestamp' => time(),
        ]);
    }
}