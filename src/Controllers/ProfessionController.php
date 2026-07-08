<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Exception\HttpNotFoundException;
use App\Services\ProfessionService;
use App\Services\TaxService;
use App\Services\CommentService;

class ProfessionController
{
    private $view;
    private $professionService;
    private $taxService;
    private $blogService;
    private $widgetService;
    private $commentService;
    private $jobService;

    public function __construct(Twig $view, ProfessionService $professionService, TaxService $taxService, \App\Services\BlogService $blogService, CommentService $commentService, \App\Services\JobService $jobService)
    {
        $this->view = $view;
        $this->professionService = $professionService;
        $this->taxService = $taxService;
        $this->blogService = $blogService;
        $this->widgetService = new \App\Services\WidgetService();
        $this->commentService = $commentService;
        $this->jobService = $jobService;
    }

    public function show(Request $request, Response $response, $args)
    {
        $slug = $args['slug'];
        $profession = $this->professionService->getBySlug($slug);

        if (!$profession) {
            throw new HttpNotFoundException($request);
        }

        $municipalities = $this->taxService->getAllMunicipalities();

        // Initialize allProfessions for use in fallback and auto-linking
        $allProfessions = $this->professionService->getAll();

        // Get Related Professions
        if (isset($profession['related_professions']) && !empty($profession['related_professions'])) {
            // Use manual clusters from JSON
            $relatedProfessions = $profession['related_professions'];
        } else {
            // Fallback: Calculate based on Salary/Category
            $filteredProfessions = array_filter($allProfessions, function ($p) use ($slug) {
                return $p['slug'] !== $slug;
            });

            // Initial sort by Category then Salary difference
            $currentCategory = $profession['category'] ?? null;
            $targetSalary = $profession['median_salary'];

            usort($filteredProfessions, function ($a, $b) use ($currentCategory, $targetSalary) {
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

            $items = array_slice($filteredProfessions, 0, 6);

            // Structure to match the new template format
            $relatedProfessions = [
                'title' => 'Liknande yrken',
                'items' => $items
            ];
        }

        // Get Related Blog Posts
        $allPosts = $this->blogService->getAllPosts();
        $relatedPosts = [];
        $professionTitleLower = mb_strtolower($profession['title']);

        foreach ($allPosts as $post) {
            // Check if profession title exists in post title (simple matching)
            if (mb_stripos($post['title'], $professionTitleLower) !== false) {
                $relatedPosts[] = $post;
            }
        }

        // Limit to 3 posts
        $relatedPosts = array_slice($relatedPosts, 0, 3);

        // Auto-linking Logic
        $replacements = [
            '/\b(nettolön)\b/iu' => '<a href="/brutto-netto" class="text-indigo-600 hover:underline">$0</a>',
            '/\b(bruttolön)\b/iu' => '<a href="/brutto-netto" class="text-indigo-600 hover:underline">$0</a>',
            '/\b(jobbskatteavdrag)\b/iu' => '<a href="/jobbskatteavdrag" class="text-indigo-600 hover:underline">$0</a>',
            '/\b(statlig skatt)\b/iu' => '<a href="/statlig-skatt" class="text-indigo-600 hover:underline">$0</a>',
            '/\b(lön efter skatt)\b/iu' => '<a href="/" class="text-indigo-600 hover:underline">$0</a>',
            '/\b(sjuksköterskor)\b/iu' => '<a href="/lon/sjukskoterska" class="text-indigo-600 hover:underline">$0</a>',
            '/\b(undersköterskor)\b/iu' => '<a href="/lon/underskoterska" class="text-indigo-600 hover:underline">$0</a>',
        ];

        // Link to other professions (simple matching of titles)
        // Optimization: Only link if the text is present to avoid regex overhead? 
        // 31 items is negligible.
        foreach ($allProfessions as $p) {
            if ($p['slug'] === $slug)
                continue;
            // Match Title (case insensitive)
            $pattern = '/\b(' . preg_quote($p['title'], '/') . ')\b/iu';
            $replacements[$pattern] = '<a href="/lon/' . $p['slug'] . '" class="text-indigo-600 hover:underline">$0</a>';
        }

        // Apply replacements to description and description_extended
        $profession['description'] = preg_replace(array_keys($replacements), array_values($replacements), $profession['description']);
        if (!empty($profession['description_extended'])) {
            $profession['description_extended'] = preg_replace(array_keys($replacements), array_values($replacements), $profession['description_extended']);
        }

        // Build optimized title and description with SCB data
        $salary = isset($profession['scb']['salary_total']) && $profession['scb']['salary_total'] > 0
            ? $profession['scb']['salary_total']
            : $profession['avg_salary'];

        $formattedSalary = number_format($salary, 0, ',', ' ');
        $year = isset($profession['scb']['year']) ? $profession['scb']['year'] : 2026;

        // 10/10 SEO Title - Optimized for CTR (55-60 chars optimal)
        // Format: [Yrke] Lön 2026 ▷ [Salary] kr/mån | Statistik & Kalkylator
        $title = "{$profession['title']} Lön 2026 ▷ {$formattedSalary} kr/mån | Aktuell Statistik";

        // 10/10 Meta Description - Optimized for CTR (150-160 chars)
        // Power words: Aktuell, Jämför, Gratis, Räkna ut
        $description = "✓ {$profession['title']} lön 2026: {$formattedSalary} kr/mån (SCB)";
        if (isset($profession['scb']['gender_gap_percent'])) {
            $genderInfo = $profession['scb']['gender_gap_percent'] < 100
                ? "Lönegap: " . (100 - $profession['scb']['gender_gap_percent']) . "%"
                : "";
            if ($genderInfo) {
                $description .= ". {$genderInfo}";
            }
        }
        $description .= ". Räkna ut din nettolön gratis → Jämför regioner & sektorer!";

        // Check if Kommunal data exists for this profession
        $kommunalService = new \App\Services\KommunalService();
        $hasKommunalData = false;

        // Check 1: SSYK code match
        if (isset($profession['scb']['ssyk_code'])) {
            $kData = $kommunalService->getKommunalBySsyk($profession['scb']['ssyk_code']);
            if ($kData) {
                $hasKommunalData = true;
            }
        }

        // Check 2: Name match (if not found by SSYK)
        if (!$hasKommunalData) {
            $allKommunal = $kommunalService->getAllKommunal();
            $professionLower = mb_strtolower($profession['title']);
            foreach ($allKommunal as $k) {
                if (mb_stripos($k['profession'], $professionLower) !== false) {
                    $hasKommunalData = true;
                    break;
                }
            }
        }

        // Check 3: Fallback salary_by_sector.kommunal
        if (!$hasKommunalData && isset($profession['salary_by_sector']['kommunal']) && $profession['salary_by_sector']['kommunal'] > 0) {
            $hasKommunalData = true;
        }

        // Fetch comments
        $comments = $this->commentService->getCommentsByPage($slug);

        // Fetch jobs (limit 6)
        // Detect municipality from cookie or user selection? For now, national or generic.
        // Ideally we should get it from a cookie set by the calculator.
        // Let's try to get it from query param or just default to null (national) for now.
        $jobs = $this->jobService->getJobs($profession['title'], null, 6);

        // SEO: Last-Modified header (Google freshness signal)
        $response = $response->withHeader('Last-Modified', gmdate('D, d M Y H:i:s \G\M\T'));

        return $this->view->render($response, 'profession.twig', [
            'title' => $title,
            'description' => $description,
            'current_path' => "/lon/{$slug}",
            'profession' => $profession,
            'municipalities' => $municipalities,
            'related_professions' => $relatedProfessions,
            'related_posts' => $relatedPosts,
            'has_kommunal_data' => $hasKommunalData,
            'related_posts' => $relatedPosts,
            'has_kommunal_data' => $hasKommunalData,
            'widgets' => $this->widgetService->getAll(),
            'comments' => $comments,
            'jobs' => $jobs
        ]);
    }

    /**
     * Show profession×kommunal page
     */
    public function showKommunal(Request $request, Response $response, $args)
    {
        $slug = $args['slug'];
        $profession = $this->professionService->getBySlug($slug);

        if (!$profession) {
            throw new HttpNotFoundException($request);
        }

        // Load KommunalService data
        $kommunalService = new \App\Services\KommunalService();

        // Try to find matching SSYK code from profession
        $ssykCode = $profession['scb']['ssyk_code'] ?? null;
        $kommunalData = null;
        $privatData = null;

        if ($ssykCode) {
            $kommunalData = $kommunalService->getKommunalBySsyk($ssykCode);
            $comparison = $kommunalService->compareKommunalPrivat($ssykCode);
            $privatData = $comparison['privat'];
        }

        // If no SSYK match, try searching by profession name
        if (!$kommunalData) {
            $allKommunal = $kommunalService->getAllKommunal();
            $professionLower = mb_strtolower($profession['title']);

            foreach ($allKommunal as $k) {
                if (stripos(mb_strtolower($k['profession']), $professionLower) !== false) {
                    $kommunalData = $k;
                    $comparison = $kommunalService->compareKommunalPrivat($k['ssyk_code']);
                    $privatData = $comparison['privat'];
                    break;
                }
            }
        }

        // If still no data, use fallback with sector salary from profession
        if (!$kommunalData && isset($profession['salary_by_sector']['kommunal'])) {
            $kommunalData = [
                'salary_total' => $profession['salary_by_sector']['kommunal'],
                'salary_men' => 0,
                'salary_women' => 0,
                'gender_gap_percent' => 0
            ];
        }

        // If absolutely no data, 404
        if (!$kommunalData) {
            throw new HttpNotFoundException($request);
        }

        // Calculate difference percentage
        $diffPercent = 0;
        if ($privatData && $privatData['salary_total'] > 0) {
            $diffPercent = round((($kommunalData['salary_total'] - $privatData['salary_total']) / $privatData['salary_total']) * 100, 1);
        }

        // Generate FAQs
        $faqs = [
            [
                'question' => "Vad är medellönen för {$profession['title']} i kommunal sektor?",
                'answer' => "Genomsnittslönen för en {$profession['title']} inom kommunal sektor är " .
                    number_format($kommunalData['salary_total'], 0, ',', ' ') . " kr per månad enligt SCB (2024)."
            ],
            [
                'question' => "Tjänar en {$profession['title']} mer i kommun eller privat sektor?",
                'answer' => $privatData && $privatData['salary_total'] > 0
                    ? ($diffPercent >= 0
                        ? "Inom kommunal sektor tjänar en {$profession['title']} " . number_format($kommunalData['salary_total'], 0, ',', ' ') .
                        " kr, vilket är {$diffPercent}% mer än privat sektor (" . number_format($privatData['salary_total'], 0, ',', ' ') . " kr)."
                        : "Inom kommunal sektor tjänar en {$profession['title']} " . number_format($kommunalData['salary_total'], 0, ',', ' ') .
                        " kr, vilket är " . abs($diffPercent) . "% mindre än privat sektor (" . number_format($privatData['salary_total'], 0, ',', ' ') . " kr).")
                    : "Data för jämförelse med privat sektor saknas för detta yrke."
            ],
            [
                'question' => "Hur får jag en nettolön som {$profession['title']} i kommun?",
                'answer' => "Med en bruttolön på " . number_format($kommunalData['salary_total'], 0, ',', ' ') .
                    " kr och genomsnittlig kommunalskatt (32,37%) blir nettolönen cirka " .
                    number_format($kommunalData['salary_total'] * 0.6763, 0, ',', ' ') . " kr. Använd vår kalkylator för exakt beräkning."
            ]
        ];

        // Add gender gap FAQ if data exists
        if ($kommunalData['salary_men'] > 0 && $kommunalData['salary_women'] > 0) {
            $faqs[] = [
                'question' => "Finns det löneskillnad mellan män och kvinnor som {$profession['title']} i kommun?",
                'answer' => "Ja, män tjänar i genomsnitt " . number_format($kommunalData['salary_men'], 0, ',', ' ') .
                    " kr och kvinnor " . number_format($kommunalData['salary_women'], 0, ',', ' ') .
                    " kr. Kvinnor tjänar alltså " . $kommunalData['gender_gap_percent'] . "% av männens lön."
            ];
        }

        $title = "{$profession['title']} lön kommunal sektor 2024: " . number_format($kommunalData['salary_total'], 0, ',', ' ') . " kr";
        $metaDesc = "Vad tjänar en {$profession['title']} i kommunal sektor? Medellön " .
            number_format($kommunalData['salary_total'], 0, ',', ' ') . " kr/mån. Jämför med privat, se löneskillnader och räkna ut nettolön.";

        return $this->view->render($response, 'profession_kommunal.twig', [
            'title' => $title,
            'meta_description' => $metaDesc,
            'canonical' => "/lon/{$slug}/kommunal",
            'current_path' => "/lon/{$slug}/kommunal",
            'profession' => $profession,
            'kommunal' => $kommunalData,
            'privat' => $privatData,
            'diffPercent' => $diffPercent,
            'faqs' => $faqs
        ]);
    }
}
