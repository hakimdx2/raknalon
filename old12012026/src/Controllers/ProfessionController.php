<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Exception\HttpNotFoundException;
use App\Services\ProfessionService;
use App\Services\TaxService;

class ProfessionController
{
    private $view;
    private $professionService;
    private $taxService;

    public function __construct(Twig $view, ProfessionService $professionService, TaxService $taxService)
    {
        $this->view = $view;
        $this->professionService = $professionService;
        $this->taxService = $taxService;
    }

    public function show(Request $request, Response $response, $args)
    {
        $slug = $args['slug'];
        $profession = $this->professionService->getBySlug($slug);

        if (!$profession) {
            throw new HttpNotFoundException($request);
        }

        $municipalities = $this->taxService->getAllMunicipalities();
        
        // Get Related Professions (Closest salary)
        $allProfessions = $this->professionService->getAll();
        $relatedProfessions = array_filter($allProfessions, function($p) use ($slug) {
            return $p['slug'] !== $slug;
        });

        // Initial sort by Category then Salary difference
        $currentCategory = $profession['category'] ?? null;
        $targetSalary = $profession['median_salary'];
        
        usort($relatedProfessions, function($a, $b) use ($currentCategory, $targetSalary) {
            // Priority 1: Category Match (if category exists)
            $catA = isset($a['category']) && $a['category'] === $currentCategory;
            $catB = isset($b['category']) && $b['category'] === $currentCategory;
            
            if ($catA !== $catB) {
                return $catB <=> $catA; // True first
            }
            
            // Priority 2: Salary Proximity
            $diffA = abs(($a['median_salary'] ?? 0) - $targetSalary);
            $diffB = abs(($b['median_salary'] ?? 0) - $targetSalary);
            
            return $diffA <=> $diffB;
        });

        $relatedProfessions = array_slice($relatedProfessions, 0, 6);

        // Auto-linking Logic
        $replacements = [
            '/\b(nettolön)\b/iu' => '<a href="/brutto-netto" class="text-indigo-600 hover:underline">$0</a>',
            '/\b(bruttolön)\b/iu' => '<a href="/brutto-netto" class="text-indigo-600 hover:underline">$0</a>',
            '/\b(jobbskatteavdrag)\b/iu' => '<a href="/jobbskatteavdrag" class="text-indigo-600 hover:underline">$0</a>',
            '/\b(statlig skatt)\b/iu' => '<a href="/statlig-skatt" class="text-indigo-600 hover:underline">$0</a>',
        ];

        // Link to other professions (simple matching of titles)
        // Optimization: Only link if the text is present to avoid regex overhead? 
        // 31 items is negligible.
        foreach ($allProfessions as $p) {
            if ($p['slug'] === $slug) continue;
            // Match Title (case insensitive)
            $pattern = '/\b(' . preg_quote($p['title'], '/') . ')\b/iu';
            $replacements[$pattern] = '<a href="/lon/' . $p['slug'] . '" class="text-indigo-600 hover:underline">$0</a>';
        }

        // Apply replacements to description and description_extended
        $profession['description'] = preg_replace(array_keys($replacements), array_values($replacements), $profession['description']);
        if (!empty($profession['description_extended'])) {
            $profession['description_extended'] = preg_replace(array_keys($replacements), array_values($replacements), $profession['description_extended']);
        }

        return $this->view->render($response, 'profession.twig', [
            'title' => "Hur mycket tjänar en {$profession['title']}? Lönestatistik 2026",
            'description' => "Se vad en " . strtolower($profession['title']) . " tjänar 2026. Medellön: " . number_format($profession['avg_salary'], 0, ',', ' ') . " kr. Räkna ut nettolön efter skatt.",
            'current_path' => "/lon/{$slug}",
            'profession' => $profession,
            'municipalities' => $municipalities,
            'related_professions' => $relatedProfessions
        ]);
    }
}
