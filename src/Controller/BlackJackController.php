<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlackJackController extends AbstractController
{
    #[Route("/game/blackjack", name: "black_jack")]
    public function home(): Response
    {
        session_start();

        return $this->render('blackjack/home.html.twig');
    }

    #[Route("/game/blackjack_init", name: "init")]
    public function init(): Response
    {

        return $this->render('blackjack/home.html.twig');
    }

    #[Route("/game/documentation", name: "documentation")]
    public function documentation(): Response
    {
        return $this->render('blackjack/documentation.html.twig');
    }


    //Here is the session routes
    #[Route("/game/card/session_display", name: "session_display")]
    public function sessionDisplay(SessionInterface $session, Request $request): Response
    {
        $sessionName = $session->getName();
        $sessionId = $session->getId();
        $sessionCookie = $request->cookies->all(); // Accessing cookies directly from the Request object

        return $this->render('card/session_display.html.twig', [
            'sessionName' => $sessionName,
            'sessionId' => $sessionId,
            'sessionCookie' => $sessionCookie,
            'sessionData' => $session->all(),
        ]);
    }

    #[Route("/game/card/session_delete", name: "session_delete")]
    public function sessionDelete(SessionInterface $session): Response
    {

        // Finally, destroy the session.
        $session->clear();


        $this->addFlash(
            'notice',
            'Your session has been deleted!'
        );

        return $this->redirectToRoute('session_display');
    }


}
