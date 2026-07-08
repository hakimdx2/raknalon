<?php
/**
 * Analyze all available SSYK data sources and generate maximum professions
 */

$draftPath = __DIR__ . '/../draft/salaire-se/';
$dataPath = $draftPath . 'data/';

// Load all data sources
$sources = [];

// 1. SSYK profession list (baseline)
$ssykList = json_decode(file_get_contents($draftPath . 'ssyk_professions.json'), true);
echo "SSYK profession list: " . count($ssykList) . " codes\n";

// 2. Private sector data
$privat = json_decode(file_get_contents($dataPath . '01_privat_tjansteman_2024.json'), true);
echo "Private sector data: " . count($privat) . " entries\n";
$privatIndex = [];
foreach ($privat as $p) {
    if (($p['salary_total'] ?? 0) > 0) {
        $privatIndex[$p['ssyk_code']] = $p;
    }
}
echo "  - With valid salary: " . count($privatIndex) . "\n";

// 3. Kommune data
$kommun = json_decode(file_get_contents($dataPath . '05_kommuner_2024.json'), true);
echo "Kommune data: " . count($kommun) . " entries\n";
$kommunIndex = [];
foreach ($kommun as $k) {
    if (($k['salary_total'] ?? 0) > 0) {
        $kommunIndex[$k['ssyk_code'] ?? $k['kommun_code'] ?? ''] = $k;
    }
}
echo "  - With valid salary: " . count($kommunIndex) . "\n";

// 4. Historical data
$history = json_decode(file_get_contents($dataPath . '07_historique_2014_2024.json'), true);
echo "Historical data: " . count($history) . " entries\n";
$historyIndex = [];
foreach ($history as $h) {
    if (isset($h['ssyk_code'])) {
        $historyIndex[$h['ssyk_code']] = $h;
    }
}

// 5. Percentile data
$percentiles = json_decode(file_get_contents($dataPath . '06_percentiles_2024.json'), true);
echo "Percentile data: " . count($percentiles) . " entries\n";
$percentileIndex = [];
foreach ($percentiles as $p) {
    if (isset($p['ssyk_code'])) {
        $percentileIndex[$p['ssyk_code']] = $p;
    }
}

// Collect all unique SSYK codes with data
$allCodes = [];

foreach ($ssykList as $s) {
    $code = $s['ssyk_code'];
    if (!isset($allCodes[$code])) {
        $allCodes[$code] = ['name' => $s['name'], 'sources' => []];
    }
}

foreach ($privatIndex as $code => $data) {
    if (!isset($allCodes[$code])) {
        $allCodes[$code] = ['name' => $data['profession'] ?? '', 'sources' => []];
    }
    $allCodes[$code]['sources'][] = 'privat';
    $allCodes[$code]['salary'] = $data['salary_total'];
}

foreach ($historyIndex as $code => $data) {
    if (!isset($allCodes[$code])) {
        $allCodes[$code] = ['name' => $data['profession'] ?? '', 'sources' => []];
    }
    $allCodes[$code]['sources'][] = 'history';
}

foreach ($percentileIndex as $code => $data) {
    if (!isset($allCodes[$code])) {
        $allCodes[$code] = ['name' => $data['profession'] ?? '', 'sources' => []];
    }
    $allCodes[$code]['sources'][] = 'percentiles';
}

echo "\n=== SUMMARY ===\n";
echo "Total unique SSYK codes with data: " . count($allCodes) . "\n";

// Count by number of sources
$bySourceCount = [];
foreach ($allCodes as $code => $info) {
    $count = count($info['sources']);
    if (!isset($bySourceCount[$count])) $bySourceCount[$count] = 0;
    $bySourceCount[$count]++;
}

ksort($bySourceCount);
echo "\nBy number of data sources:\n";
foreach ($bySourceCount as $count => $num) {
    echo "  $count sources: $num professions\n";
}

// List codes with salary data (usable)
$usable = [];
foreach ($allCodes as $code => $info) {
    if (isset($info['salary']) && $info['salary'] > 0) {
        $usable[$code] = $info;
    }
}

echo "\nCodes with usable salary data: " . count($usable) . "\n";

// Check existing professions
$existing = json_decode(file_get_contents(__DIR__ . '/data/professions.json'), true);
$existingSSYK = [];
foreach ($existing as $p) {
    if (isset($p['scb']['ssyk_code'])) {
        $existingSSYK[$p['scb']['ssyk_code']] = $p['slug'];
    }
}

echo "Already in professions.json: " . count($existingSSYK) . " SSYK codes\n";

// Find missing
$missing = [];
foreach ($usable as $code => $info) {
    if (!isset($existingSSYK[$code])) {
        $missing[$code] = $info;
    }
}

echo "Missing (can be added): " . count($missing) . "\n\n";

if (count($missing) > 0) {
    echo "=== MISSING PROFESSIONS ===\n";
    foreach ($missing as $code => $info) {
        echo "  [$code] {$info['name']} - {$info['salary']} kr\n";
    }
}
