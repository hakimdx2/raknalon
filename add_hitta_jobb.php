<?php
/**
 * Add Hitta Jobb sections to all professions
 * Links to Indeed, Arbetsförmedlingen, LinkedIn
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);

$updatedCount = 0;

foreach ($data as &$profession) {
    $title = $profession['title'] ?? 'jobb';
    $keyword = $profession['keyword'] ?? $title;
    
    // Extract the job title for search (remove "lön" from keyword)
    $searchTerm = str_replace(' lön', '', $keyword);
    $searchTerm = trim($searchTerm);
    
    // URL encode the search term
    $encodedTerm = urlencode($searchTerm);
    
    // Add hitta_jobb structure
    $profession['hitta_jobb'] = [
        'enabled' => true,
        'search_term' => $searchTerm,
        'links' => [
            [
                'platform' => 'Indeed',
                'url' => "https://se.indeed.com/jobb?q={$encodedTerm}&l=Sverige",
                'icon' => '/img/icons/indeed.svg'
            ],
            [
                'platform' => 'Arbetsförmedlingen',
                'url' => "https://arbetsformedlingen.se/platsbanken/annonser?q={$encodedTerm}",
                'icon' => '/img/icons/af.svg'
            ],
            [
                'platform' => 'LinkedIn',
                'url' => "https://www.linkedin.com/jobs/search/?keywords={$encodedTerm}&location=Sweden",
                'icon' => '/img/icons/linkedin.svg'
            ]
        ]
    ];
    
    echo "✅ {$title}: '{$searchTerm}'\n";
    $updatedCount++;
}

// Save updated JSON
file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n" . str_repeat("=", 60) . "\n";
echo "✅ HITTA JOBB SECTIONS ADDED!\n";
echo "📊 Professions updated: $updatedCount\n";
echo "💾 Saved to: $jsonFile\n";

// Show example
echo "\n=== EXAMPLE ===\n";
echo json_encode($data[0]['hitta_jobb'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
