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
            'title' => 'Brutto vs Netto - Vad är skillnaden? | Raknalon.se',
            'description' => 'Lär dig skillnaden mellan bruttolön och nettolön. Förstå hur skatter dras och vad du faktiskt får in på kontot varje månad.',
            'current_path' => '/brutto-netto'
        ]);
    }

    public function jobbskatteavdrag(Request $request, Response $response)
    {
        return $this->view->render($response, 'concepts/jobbskatteavdrag.twig', [
            'title' => 'Jobbskatteavdrag 2026 - Så mycket sänks din skatt',
            'description' => 'Allt du behöver veta om jobbskatteavdraget 2026. Se tabeller för olika inkomstnivåer och förstå hur det sänker din skatt.',
            'year' => 2026,
            'current_path' => '/jobbskatteavdrag'
        ]);
    }

    public function statligSkatt(Request $request, Response $response)
    {
        return $this->view->render($response, 'concepts/statlig-skatt.twig', [
            'title' => 'Statlig Inkomstskatt 2026 - Gräns och Belopp',
            'description' => 'När börjar man betala statlig skatt? Vi förklarar brytpunkten för 2026 och hur mycket extra skatt du betalar på höga inkomster.',
            'threshold' => 615300, // Skiktgräns approx
            'current_path' => '/statlig-skatt'
        ]);
    }
}
