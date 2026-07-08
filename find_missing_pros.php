<?php
/**
 * Find all professions missing pros/cons sections
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);

$missing = [];
$hasPros = 0;

foreach ($data as $profession) {
    $slug = $profession['slug'] ?? 'unknown';
    $title = $profession['title'] ?? 'Unknown';
    
    if (!isset($profession['pros']) || empty($profession['pros'])) {
        $missing[] = ['slug' => $slug, 'title' => $title];
    } else {
        $hasPros++;
    }
}

echo "=== PROFESSION ANALYSIS ===\n";
echo "Total professions: " . count($data) . "\n";
echo "With pros/cons: $hasPros\n";
echo "Missing pros/cons: " . count($missing) . "\n\n";

echo "=== MISSING PROFESSIONS ===\n";
foreach ($missing as $p) {
    echo "- {$p['title']} ({$p['slug']})\n";
}
