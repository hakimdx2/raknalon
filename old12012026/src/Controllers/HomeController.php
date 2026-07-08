<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use App\Services\TaxService;
use App\Services\ProfessionService;

class HomeController
{
    private $view;
    private $taxService;
    private $professionService;

    public function __construct(Twig $view, TaxService $taxService, ProfessionService $professionService)
    {
        $this->view = $view;
        $this->taxService = $taxService;
        $this->professionService = $professionService;
    }

    public function index(Request $request, Response $response)
    {
        $municipalities = $this->taxService->getAllMunicipalities();
        $professions = $this->professionService->getAll();
        
        // Sort by volume DESC to get popular ones
        usort($professions, function ($a, $b) {
            return ($b['volume'] ?? 0) <=> ($a['volume'] ?? 0);
        });
        $popularProfessions = array_slice($professions, 0, 12);
        
        return $this->view->render($response, 'home.twig', [
            'title' => 'Räkna ut din lön efter skatt 2026 - Raknalon.se',
            'municipalities' => $municipalities,
            'popular_professions' => $popularProfessions
        ]);
    }

    public function yrken(Request $request, Response $response)
    {
        $professions = $this->professionService->getAll();
        
        // Group by Category
        $groupedProfessions = [];
        $order = ['Vård & Hälsa', 'Teknik & Industri', 'Utbildning & Samhälle', 'Transport', 'Ekonomi & Ledning', 'Service', 'Övrigt'];
        
        foreach ($professions as $p) {
            $cat = $p['category'] ?? 'Övrigt';
            $groupedProfessions[$cat][] = $p;
        }

        // Sort within groups
        foreach ($groupedProfessions as &$group) {
            usort($group, function ($a, $b) {
                return ($b['volume'] ?? 0) <=> ($a['volume'] ?? 0);
            });
        }
        
        return $this->view->render($response, 'yrken.twig', [
            'title' => 'Lönestatistik för alla yrken i Sverige 2026 - Raknalon.se',
            'description' => 'Komplett lista över lönestatistik för ' . count($professions) . ' yrken i Sverige. Se medianlön, snittlön och räkna ut nettolön.',
            'current_path' => '/yrken',
            'professions' => $professions, // Keep flat list for JS search if needed/stats
            'grouped_professions' => $groupedProfessions,
            'category_order' => $order
        ]);
    }
}
