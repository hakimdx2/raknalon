<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Exception\HttpNotFoundException;
use App\Services\KommunalService;
use App\Services\ProfessionService;

/**
 * KommunalController - Contrôleur pour les pages du secteur kommunal
 * 
 * Gère:
 * - Page pilier /kommunal-lon
 * - Pages Län /lon/region/{slug}
 */
class KommunalController
{
    private $view;
    private $kommunalService;
    private $professionService;

    public function __construct(Twig $view, KommunalService $kommunalService, ProfessionService $professionService)
    {
        $this->view = $view;
        $this->kommunalService = $kommunalService;
        $this->professionService = $professionService;
    }

    /**
     * Page pilier /kommunal-lon
     */
    public function index(Request $request, Response $response): Response
    {
        $stats = $this->kommunalService->getStats();
        $topSalaries = $this->kommunalService->getTopSalaries(10);
        $lanData = $this->kommunalService->getLanSorted();
        $nationalAvg = $this->kommunalService->getNationalAverage();
        
        // Séparer les Län par tier
        $tier1Lan = array_filter($lanData, fn($l) => $l['tier'] === 1);
        $tier2Lan = array_filter($lanData, fn($l) => $l['tier'] === 2);
        $tier3Lan = array_filter($lanData, fn($l) => $l['tier'] === 3);
        
        // FAQs pour Schema.org
        $faqs = [
            [
                'question' => 'Vad är medellönen i kommunal sektor?',
                'answer' => 'Genomsnittslönen inom kommunal sektor i Sverige är ' . number_format($nationalAvg, 0, ',', ' ') . ' kr per månad (2024). Detta inkluderar alla yrkeskategorier från undersköterskor till kommundirektörer.'
            ],
            [
                'question' => 'Vilka yrken inom kommun har högst lön?',
                'answer' => 'De högst betalda yrkena inom kommunal sektor är kommundirektörer (ca 110 000 kr), specialistläkare (ca 99 000 kr) och förvaltningschefer (ca 86 000 kr).'
            ],
            [
                'question' => 'Är lönen högre i kommun eller privat sektor?',
                'answer' => 'Generellt sett är lönerna något lägre inom kommunal sektor jämfört med privat sektor, men det varierar stort beroende på yrke. Vissa yrkesgrupper som sjuksköterskor och lärare kan ha konkurrenskraftiga löner i kommunal sektor.'
            ],
            [
                'question' => 'Hur många anställda finns i kommunal sektor?',
                'answer' => 'Sveriges 290 kommuner har tillsammans cirka 900 000 anställda, vilket gör kommunerna till en av landets största arbetsgivare.'
            ]
        ];
        
        return $this->view->render($response, 'kommunal_index.twig', [
            'title' => 'Kommunal lön 2024 – Lönestatistik för offentlig sektor | Räkna Lön',
            'description' => 'Utforska löner inom kommunal sektor i Sverige. Medellön ' . number_format($nationalAvg, 0, ',', ' ') . ' kr. Se statistik per yrke, jämför med privat sektor och beräkna din nettolön.',
            'stats' => $stats,
            'topSalaries' => $topSalaries,
            'lanData' => $lanData,
            'tier1Lan' => $tier1Lan,
            'tier2Lan' => $tier2Lan,
            'tier3Lan' => $tier3Lan,
            'nationalAvg' => $nationalAvg,
            'faqs' => $faqs,
            'current_path' => '/kommunal-lon',
            'canonical' => '/kommunal-lon' // Keep for backward compat with view specific blocks
        ]);
    }

    /**
     * Page Län /lon/region/{slug}
     */
    public function showLan(Request $request, Response $response, $args): Response
    {
        $slug = $args['slug'];
        $lan = $this->kommunalService->getLanBySlug($slug);
        
        if (!$lan) {
            throw new HttpNotFoundException($request);
        }
        
        $nationalAvg = $this->kommunalService->getNationalAverage();
        $allLan = $this->kommunalService->getAllLan();
        
        // Calculer le rang du Län
        $sortedLan = $this->kommunalService->getLanSorted();
        $rank = 1;
        foreach ($sortedLan as $l) {
            if ($l['slug'] === $slug) break;
            $rank++;
        }
        
        // Différence avec la moyenne nationale
        $diffNational = round((($lan['salary_estimate'] - $nationalAvg) / $nationalAvg) * 100, 1);
        
        // Trouver les Län voisins (par code)
        $neighbors = [];
        // TODO: Ajouter la logique des Län voisins
        
        // Calculer nettolön
        $nettoInfo = $this->kommunalService->calculateNetSalary($lan['salary_estimate'], $lan['lan_name']);
        
        // Top yrken dans ce Län (basé sur données kommunal générales)
        $topYrken = $this->kommunalService->getTopSalaries(10);
        
        // FAQs spécifiques au Län
        $faqs = [
            [
                'question' => 'Vad är medellönen i ' . $lan['lan_name'] . '?',
                'answer' => 'Genomsnittslönen i ' . $lan['lan_name'] . ' är ' . number_format($lan['salary_estimate'], 0, ',', ' ') . ' kr per månad. Detta är ' . ($diffNational >= 0 ? '+' : '') . $diffNational . '% jämfört med riksgenomsnittet (' . number_format($nationalAvg, 0, ',', ' ') . ' kr).'
            ],
            [
                'question' => 'Hur hög är skatten i ' . $lan['lan_name'] . '?',
                'answer' => 'Den genomsnittliga kommunalskatten i ' . $lan['lan_name'] . ' är ' . number_format($lan['skattesats'], 2, ',', ' ') . '%. Med en bruttolön på ' . number_format($lan['salary_estimate'], 0, ',', ' ') . ' kr blir nettolönen cirka ' . number_format($nettoInfo['netto'], 0, ',', ' ') . ' kr.'
            ],
            [
                'question' => 'Hur rankas ' . $lan['lan_name'] . ' i lönestatistiken?',
                'answer' => $lan['lan_name'] . ' rankas som nummer ' . $rank . ' av 21 län i Sverige när det gäller medellön.'
            ]
        ];
        
        return $this->view->render($response, 'lan.twig', [
            'title' => 'Medellön i ' . $lan['lan_name'] . ' 2024 – Lönestatistik | Räkna Lön',
            'description' => 'Medellönen i ' . $lan['lan_name'] . ' är ' . number_format($lan['salary_estimate'], 0, ',', ' ') . ' kr/månad. Skattesats ' . number_format($lan['skattesats'], 1, ',', ' ') . '%. Se lönestatistik, jämförelser och beräkna din nettolön.',
            'lan' => $lan,
            'rank' => $rank,
            'totalLan' => count($allLan),
            'nationalAvg' => $nationalAvg,
            'diffNational' => $diffNational,
            'nettoInfo' => $nettoInfo,
            'topYrken' => $topYrken,
            'allLan' => $allLan,
            'faqs' => $faqs,
            'current_path' => '/lon/region/' . $slug,
            'canonical' => '/lon/region/' . $slug
        ]);
    }
}
