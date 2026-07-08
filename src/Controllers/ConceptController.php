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

    public function lonEfterSkatt(Request $request, Response $response)
    {
        return $this->view->render($response, 'concepts/lon-efter-skatt.twig', [
            'title' => 'Lön efter skatt 2026 - Räkna ut din nettolön | Räkna Lön',
            'description' => 'Räkna ut din lön efter skatt 2026. Gratis lönekalkylator visar exakt nettolön, skatt & jobbskatteavdrag. Uppdaterad med 2026 års skatteregler.',
            'year' => 2026,
            'current_path' => '/lon-efter-skatt'
        ]);
    }

    public function nala(Request $request, Response $response)
    {
        return $this->view->render($response, 'concepts/nala.twig', [
            'title' => 'Nala - Löneexpert & Guide | Raknalon.se',
            'description' => 'Möt Nala, din guide i lönedjungeln. Hon hjälper dig förstå din lön, skatter och karriärmöjligheter på ett enkelt sätt.',
            'current_path' => '/om-oss/nala'
        ]);
    }
}

