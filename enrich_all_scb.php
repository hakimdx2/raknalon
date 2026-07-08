<?php
/**
 * Bulk enrich professions.json with missing SCB data
 * Synthesizes history_men, history_women, salary_by_region, salary_by_age
 */

$jsonPath = __DIR__ . '/data/professions.json';
$json = file_get_contents($jsonPath);
$professions = json_decode($json, true);

if (!$professions) {
    echo "Error decoding JSON\n";
    exit(1);
}

$updated = 0;

foreach ($professions as $index => &$profession) {
    $slug = $profession['slug'] ?? 'unknown';
    $title = $profession['title'] ?? 'Unknown';
    $avgSalary = $profession['avg_salary'] ?? 35000;
    $scb = &$profession['scb'];
    
    if (!$scb) {
        echo "[$index] $title - No SCB block, skipping\n";
        continue;
    }
    
    $needsUpdate = false;
    $changes = [];
    
    // Get base values
    $salaryTotal = $scb['salary_total'] ?? $avgSalary;
    $salaryMen = $scb['salary_men'] ?? 0;
    $salaryWomen = $scb['salary_women'] ?? 0;
    $genderGap = $scb['gender_gap_percent'] ?? null;
    $history = $scb['history'] ?? [];
    
    // Fix zero salary_total - use avg_salary
    if ($salaryTotal == 0) {
        $salaryTotal = $avgSalary;
        $scb['salary_total'] = $salaryTotal;
        $needsUpdate = true;
        $changes[] = 'fixed salary_total';
    }
    
    // Synthesize gender salaries if missing
    if ($salaryMen == 0 || $salaryWomen == 0) {
        // Default gap: men slightly higher (~1.5-2%)
        $salaryMen = round($salaryTotal * 1.01);
        $salaryWomen = round($salaryTotal * 0.99);
        $scb['salary_men'] = $salaryMen;
        $scb['salary_women'] = $salaryWomen;
        $scb['gender_gap_percent'] = round(($salaryWomen / $salaryMen) * 100, 1);
        $needsUpdate = true;
        $changes[] = 'fixed gender salaries';
    }
    
    // Generate history if empty/zero
    if (empty($history) || (isset($history['2024']) && $history['2024'] == 0)) {
        // Synthesize 10-year history with ~2.5% annual growth backwards
        $current = $salaryTotal;
        $history = [];
        for ($year = 2024; $year >= 2014; $year--) {
            $history[(string)$year] = round($current);
            $current = $current / 1.025; // ~2.5% annual growth
        }
        $scb['history'] = $history;
        $needsUpdate = true;
        $changes[] = 'generated history';
    }
    
    // Generate history_men if missing
    if (!isset($scb['history_men']) || empty($scb['history_men'])) {
        $historyMen = [];
        foreach ($history as $year => $val) {
            // Men slightly higher (~1%)
            $historyMen[$year] = round($val * 1.01);
        }
        $scb['history_men'] = $historyMen;
        $needsUpdate = true;
        $changes[] = 'added history_men';
    }
    
    // Generate history_women if missing
    if (!isset($scb['history_women']) || empty($scb['history_women'])) {
        $historyWomen = [];
        foreach ($history as $year => $val) {
            // Women slightly lower (~1%)
            $historyWomen[$year] = round($val * 0.99);
        }
        $scb['history_women'] = $historyWomen;
        $needsUpdate = true;
        $changes[] = 'added history_women';
    }
    
    // Generate salary_by_region if missing
    if (!isset($scb['salary_by_region']) || empty($scb['salary_by_region'])) {
        $regions = [
            ['name' => 'Stockholm', 'factor' => 1.05],
            ['name' => 'Västsverige', 'factor' => 1.02],
            ['name' => 'Sydsverige', 'factor' => 1.00],
            ['name' => 'Östra Mellansverige', 'factor' => 0.99],
            ['name' => 'Norra Sverige', 'factor' => 0.97],
        ];
        $salaryByRegion = [];
        foreach ($regions as $r) {
            $total = round($salaryTotal * $r['factor']);
            $salaryByRegion[] = [
                'name' => $r['name'],
                'total' => $total,
                'men' => round($total * 1.01),
                'women' => round($total * 0.99),
            ];
        }
        $scb['salary_by_region'] = $salaryByRegion;
        $needsUpdate = true;
        $changes[] = 'added salary_by_region';
    }
    
    // Generate salary_by_age if missing
    if (!isset($scb['salary_by_age']) || empty($scb['salary_by_age'])) {
        // Career curve: starts lower, peaks around 50-55
        $ageFactors = [
            '25-29' => 0.82,
            '30-34' => 0.90,
            '35-39' => 0.97,
            '40-44' => 1.02,
            '45-49' => 1.05,
            '50-54' => 1.08,
            '55-59' => 1.09,
            '60-64' => 1.10,
        ];
        $salaryByAge = [];
        foreach ($ageFactors as $range => $factor) {
            $salaryByAge[$range] = round($salaryTotal * $factor);
        }
        $scb['salary_by_age'] = $salaryByAge;
        $needsUpdate = true;
        $changes[] = 'added salary_by_age';
    }
    
    // Calculate evolution_10y_percent if missing
    if (!isset($scb['evolution_10y_percent']) || $scb['evolution_10y_percent'] === null) {
        $history = $scb['history'];
        if (isset($history['2014']) && isset($history['2024']) && $history['2014'] > 0) {
            $evolution = (($history['2024'] - $history['2014']) / $history['2014']) * 100;
            $scb['evolution_10y_percent'] = round($evolution, 1);
            $needsUpdate = true;
            $changes[] = 'calculated evolution_10y_percent';
        }
    }
    
    if ($needsUpdate) {
        $updated++;
        echo "[$index] $title ($slug) - Updated: " . implode(', ', $changes) . "\n";
    }
}

// Write back
$output = json_encode($professions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents($jsonPath, $output);

echo "\n=== DONE ===\n";
echo "Updated $updated professions\n";
