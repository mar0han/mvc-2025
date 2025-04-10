<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    #[Route('/lucky', name: 'lucky')]
    public function lucky(): Response
    {
        $number = random_int(1, 100);

        $messages = [
            'Luck is on your side!',
            'You are destined for greatness!',
            'Prepare for awesome things!',
            'Your lucky number for today is here! Let it guide you through the day!',
            'Embrace the energy of your lucky number—it’s your sign to take action!',
            'This number holds a special significance for you today. Use it wisely!',
            'Today’s lucky number is your key to unlocking new opportunities!',
            'Feel the power of today’s number and watch how it influences your path!',
            'Your lucky number is a reminder that fortune favors the bold—go after your goals!',
            'This number brings positivity and chance your way—pay attention to the signs!',
            'Your lucky number is not just a number, but a cosmic guide for today’s journey!',

        ];

        $message = $messages[array_rand($messages)];

        $data = [
            'lucky-number' => $number,
            'lucky-message' => $message,
            ];
        
        return $this->render('lucky.html.twig', [
            'number' => $number,
            'message' => $message,
        ]);
    }
}
