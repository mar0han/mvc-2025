<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'session_home')]
    public function index(SessionInterface $session): Response
    {
        // get everything stored in session
        $sessionData = $session->all();

        return $this->render('session.html.twig', [
            'session' => $sessionData,
        ]);
    }

    #[Route('/session/delete', name: 'session_delete')]
    public function delete(SessionInterface $session): Response
    {
        // remove all session data
        $session->clear();

        // add flash message
        $this->addFlash('notice', ' Sessionen raderad!');

        return $this->redirectToRoute('session_home');
    }
}
