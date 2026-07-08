<?php
/**
 * Scan professions.json for entries missing SCB enrichment data
 */

$jsonPath = __DIR__ . '/data/professions.json';
$json = file_get_contents($jsonPath);
$professions = json_decode($json, true);

if (!$professions) {
    echo "Error decoding JSON\n";
    exit(1);
}

$missing = [];
$complete = [];

foreach ($professions as $index => $profession) {
    $slug = $profession['slug'] ?? 'unknown';
    $title = $profession['title'] ?? 'Unknown';
    $scb = $profession['scb'] ?? null;
    
    if (!$scb) {
        $missing[] = [
            'index' => $index,
            'slug' => $slug,
            'title' => $title,
            'issue' => 'No SCB block'
        ];
        continue;
    }
    
    $issues = [];
    
    // Check for history_men
    if (!isset($scb['history_men']) || empty($scb['history_men'])) {
        $issues[] = 'history_men';
    }
    
    // Check for history_women
    if (!isset($scb['history_women']) || empty($scb['history_women'])) {
        $issues[] = 'history_women';
    }
    
    // Check for salary_by_region
    if (!isset($scb['salary_by_region']) || empty($scb['salary_by_region'])) {
        $issues[] = 'salary_by_region';
    }
    
    // Check for salary_by_age
    if (!isset($scb['salary_by_age']) || empty($scb['salary_by_age'])) {
        $issues[] = 'salary_by_age';
    }
    
    // Check for zero salary_total (placeholder data)
    if (isset($scb['salary_total']) && $scb['salary_total'] == 0) {
        $issues[] = 'salary_total=0';
    }
    
    if (!empty($issues)) {
        $missing[] = [
            'index' => $index,
            'slug' => $slug,
            'title' => $title,
            'avg_salary' => $profession['avg_salary'] ?? 0,
            'scb_total' => $scb['salary_total'] ?? 0,
            'issues' => implode(', ', $issues)
        ];
    } else {
        $complete[] = $slug;
    }
}

echo "=== PROFESSIONS MISSING SCB DATA ===\n\n";
echo "Total professions: " . count($professions) . "\n";
echo "Complete: " . count($complete) . "\n";
echo "Missing data: " . count($missing) . "\n\n";

if (!empty($missing)) {
    echo "--- Missing Entries ---\n";
    foreach ($missing as $m) {
        echo sprintf(
            "[%d] %s (%s) - Avg: %s, SCB: %s - Missing: %s\n",
            $m['index'],
            $m['title'],
            $m['slug'],
            $m['avg_salary'] ?? 'N/A',
            $m['scb_total'] ?? 'N/A',
            $m['issues'] ?? $m['issue']
        );
    }
}

echo "\n--- Complete Entries ---\n";
echo implode(', ', $complete) . "\n";
