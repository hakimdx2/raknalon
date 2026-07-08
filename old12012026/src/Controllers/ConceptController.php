<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class ConceptController
{
    private $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function bruttoNetto(Request $request, Response $response)
    {
        return $this->view->render($response, 'concepts/brutto-netto.twig', [
            'title' => 'Brutto vs Netto - Vad är skillnaden? | Raknalon.se'
        ]);
    }

    public function jobbskatteavdrag(Request $request, Response $response)
    {
        return $this->view->render($response, 'concepts/jobbskatteavdrag.twig', [
            'title' => 'Jobbskatteavdrag 2026 - Så mycket sänks din skatt',
            'year' => 2026
        ]);
    }

    public function statligSkatt(Request $request, Response $response)
    {
        return $this->view->render($response, 'concepts/statlig-skatt.twig', [
            'title' => 'Statlig Inkomstskatt 2026 - Gräns och Belopp',
            'threshold' => 615300 // Skiktgräns approx
        ]);
    }
}
