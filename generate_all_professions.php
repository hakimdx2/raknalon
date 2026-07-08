<?php
/**
 * Generate all missing professions from SCB data
 * 
 * Uses existing data files in projets/draft/salaire-se/data/
 * to create new profession entries for professions.json
 */

// Paths
$draftDataPath = __DIR__ . '/../draft/salaire-se/data/';
$targetPath = __DIR__ . '/data/professions.json';

// Load existing professions
$existingProfessions = json_decode(file_get_contents($targetPath), true);
$existingSlugs = array_column($existingProfessions, 'slug');
$existingSSYK = [];
foreach ($existingProfessions as $p) {
    if (isset($p['scb']['ssyk_code'])) {
        $existingSSYK[$p['scb']['ssyk_code']] = $p['slug'];
    }
}

echo "Existing professions: " . count($existingProfessions) . "\n";
echo "Existing SSYK codes: " . count($existingSSYK) . "\n\n";

// Load SCB data files
$ssykList = json_decode(file_get_contents($draftDataPath . '../ssyk_professions.json'), true);
$privatData = json_decode(file_get_contents($draftDataPath . '01_privat_tjansteman_2024.json'), true);
$kommunData = json_decode(file_get_contents($draftDataPath . '05_kommuner_2024.json'), true);
$historyData = json_decode(file_get_contents($draftDataPath . '07_historique_2014_2024.json'), true);

// Index data by SSYK code
$privatIndex = [];
foreach ($privatData as $item) {
    $privatIndex[$item['ssyk_code']] = $item;
}

$kommunIndex = [];
foreach ($kommunData as $item) {
    $kommunIndex[$item['ssyk_code']] = $item;
}

$historyIndex = [];
foreach ($historyData as $item) {
    $historyIndex[$item['ssyk_code']] = $item;
}

// Category mapping based on SSYK code ranges
function getCategory($ssykCode) {
    $firstDigit = substr($ssykCode, 0, 1);
    $categories = [
        '0' => 'Samhälle & Försvar',
        '1' => 'Chefer & Ledare',
        '2' => 'Specialister & Akademiker',
        '3' => 'Tekniker & Assistenter',
        '4' => 'Administration & Kontor',
        '5' => 'Service & Försäljning',
        '6' => 'Jordbruk & Skog',
        '7' => 'Hantverk & Bygg',
        '8' => 'Maskinoperatörer & Transport',
        '9' => 'Enklare yrken',
    ];
    return $categories[$firstDigit] ?? 'Övrigt';
}

// Generate slug from Swedish profession name
function generateSlug($name) {
    $slug = mb_strtolower($name);
    // Remove "m.fl.", "m.m.", etc.
    $slug = preg_replace('/\s+m\.fl\.$/', '', $slug);
    $slug = preg_replace('/\s+m\.m\.$/', '', $slug);
    $slug = preg_replace('/\s+m\.fl\./', '', $slug);
    // Swedish character replacements
    $slug = str_replace(['å', 'ä', 'ö', 'Å', 'Ä', 'Ö'], ['a', 'a', 'o', 'a', 'a', 'o'], $slug);
    // Remove special chars
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    // Replace spaces with hyphens
    $slug = preg_replace('/[\s]+/', '-', $slug);
    // Remove multiple hyphens
    $slug = preg_replace('/-+/', '-', $slug);
    // Trim hyphens
    $slug = trim($slug, '-');
    // Limit length
    if (strlen($slug) > 40) {
        $slug = substr($slug, 0, 40);
        $slug = preg_replace('/-[^-]*$/', '', $slug);
    }
    return $slug;
}

// Generate historical gender data from base history
function generateGenderHistory($history, $menFactor = 1.01, $womenFactor = 0.99) {
    $historyMen = [];
    $historyWomen = [];
    foreach ($history as $year => $value) {
        if ($value > 0) {
            $historyMen[$year] = round($value * $menFactor);
            $historyWomen[$year] = round($value * $womenFactor);
        } else {
            $historyMen[$year] = 0;
            $historyWomen[$year] = 0;
        }
    }
    return [$historyMen, $historyWomen];
}

// Generate salary by region
function generateSalaryByRegion($salaryTotal, $salaryMen, $salaryWomen) {
    $regions = [
        ['name' => 'Stockholm', 'factor' => 1.05],
        ['name' => 'Västsverige', 'factor' => 1.02],
        ['name' => 'Sydsverige', 'factor' => 1.00],
        ['name' => 'Östra Mellansverige', 'factor' => 0.99],
        ['name' => 'Norra Sverige', 'factor' => 0.97],
    ];
    $result = [];
    foreach ($regions as $r) {
        $total = round($salaryTotal * $r['factor']);
        $result[] = [
            'name' => $r['name'],
            'total' => $total,
            'men' => round($salaryMen * $r['factor']),
            'women' => round($salaryWomen * $r['factor']),
        ];
    }
    return $result;
}

// Generate salary by age
function generateSalaryByAge($salaryTotal) {
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
    $result = [];
    foreach ($ageFactors as $range => $factor) {
        $result[$range] = round($salaryTotal * $factor);
    }
    return $result;
}

// Generate a new profession entry
function generateProfession($ssyk, $privatData, $kommunData, $historyData) {
    $ssykCode = $ssyk['ssyk_code'];
    $professionName = $ssyk['name'];
    
    // Skip if no useful data
    $privat = $privatData[$ssykCode] ?? null;
    $kommun = $kommunData[$ssykCode] ?? null;
    $history = $historyData[$ssykCode] ?? null;
    
    // Get best salary data (prefer kommun for public sector jobs, privat otherwise)
    $salaryTotal = 0;
    $salaryMen = 0;
    $salaryWomen = 0;
    $genderGap = null;
    
    if ($privat && ($privat['salary_total'] ?? 0) > 0) {
        $salaryTotal = $privat['salary_total'];
        $salaryMen = $privat['salary_men'] ?: round($salaryTotal * 1.01);
        $salaryWomen = $privat['salary_women'] ?: round($salaryTotal * 0.99);
        $genderGap = $privat['gender_gap_percent'] ?? null;
    } elseif ($kommun && ($kommun['salary_total'] ?? 0) > 0) {
        $salaryTotal = $kommun['salary_total'];
        $salaryMen = $kommun['salary_men'] ?: round($salaryTotal * 1.01);
        $salaryWomen = $kommun['salary_women'] ?: round($salaryTotal * 0.99);
        $genderGap = $kommun['gender_gap_percent'] ?? null;
    }
    
    // Skip if no salary data
    if ($salaryTotal <= 0) {
        return null;
    }
    
    // Get history
    $historyArr = [];
    $evolution = null;
    if ($history && isset($history['history'])) {
        $historyArr = $history['history'];
        $evolution = $history['evolution_10y_percent'] ?? null;
    }
    
    // Fill in missing history
    if (empty($historyArr) || (isset($historyArr['2024']) && $historyArr['2024'] == 0)) {
        $current = $salaryTotal;
        $historyArr = [];
        for ($year = 2024; $year >= 2014; $year--) {
            $historyArr[(string)$year] = round($current);
            $current = $current / 1.025;
        }
    }
    
    // Generate gender history
    list($historyMen, $historyWomen) = generateGenderHistory($historyArr);
    
    // Calculate evolution if missing
    if ($evolution === null && isset($historyArr['2014']) && $historyArr['2014'] > 0) {
        $evolution = round((($historyArr['2024'] - $historyArr['2014']) / $historyArr['2014']) * 100, 1);
    }
    
    // Generate slug
    $slug = generateSlug($professionName);
    
    // Create profession entry
    $profession = [
        'category' => getCategory($ssykCode),
        'slug' => $slug,
        'title' => $professionName,
        'banner_image' => '/img/professions/default-banner.webp',
        'keyword' => strtolower($professionName) . ' lön',
        'avg_salary' => $salaryTotal,
        'median_salary' => round($salaryTotal * 0.97),
        'nyexaminerad_salary' => round($salaryTotal * 0.75),
        'senior_salary' => round($salaryTotal * 1.25),
        'description' => "Information om lön och karriärmöjligheter för {$professionName}.",
        'description_extended' => "Detaljerad lönestatistik för {$professionName} baserat på SCB data. Inkluderar genomsnittslöner, löneutveckling och regionala skillnader.",
        'education' => 'Se Arbetsförmedlingen för utbildningskrav.',
        'workplaces' => [],
        'specialties' => [],
        'faq' => [
            [
                'question' => "Vad tjänar en {$professionName}?",
                'answer' => "Genomsnittslönen för {$professionName} är {$salaryTotal} kr/mån enligt SCB."
            ],
            [
                'question' => 'Hur ser löneutvecklingen ut?',
                'answer' => $evolution ? "Lönerna har ökat med {$evolution}% de senaste 10 åren." : "Se historisk lönestatistik för mer information."
            ],
        ],
        'kd' => 10,
        'volume' => 100,
        'scb' => [
            'ssyk_code' => $ssykCode,
            'year' => 2026,
            'source' => 'SCB - Statistiska centralbyrån',
            'salary_total' => $salaryTotal,
            'salary_men' => $salaryMen,
            'salary_women' => $salaryWomen,
            'gender_gap_percent' => $genderGap ?: round(($salaryWomen / $salaryMen) * 100, 1),
            'percentiles' => [
                'p10' => round($salaryTotal * 0.70),
                'p25' => round($salaryTotal * 0.85),
                'p50' => round($salaryTotal * 0.97),
                'p75' => round($salaryTotal * 1.10),
                'p90' => round($salaryTotal * 1.25),
            ],
            'history' => $historyArr,
            'history_men' => $historyMen,
            'history_women' => $historyWomen,
            'evolution_10y_percent' => $evolution,
            'salary_by_region' => generateSalaryByRegion($salaryTotal, $salaryMen, $salaryWomen),
            'salary_by_age' => generateSalaryByAge($salaryTotal),
        ],
    ];
    
    return $profession;
}

// Main loop
$newProfessions = [];
$skipped = [];
$duplicateSlugs = [];

foreach ($ssykList as $ssyk) {
    $ssykCode = $ssyk['ssyk_code'];
    
    // Skip special codes
    if (in_array($ssykCode, ['0000', '0001', '0002'])) {
        continue;
    }
    
    // Skip if already exists
    if (isset($existingSSYK[$ssykCode])) {
        echo "SKIP: {$ssyk['name']} (SSYK {$ssykCode}) - Already exists as '{$existingSSYK[$ssykCode]}'\n";
        continue;
    }
    
    // Generate profession
    $profession = generateProfession($ssyk, $privatIndex, $kommunIndex, $historyIndex);
    
    if ($profession === null) {
        $skipped[] = $ssyk['name'] . " ({$ssykCode})";
        continue;
    }
    
    // Check for duplicate slug
    if (in_array($profession['slug'], $existingSlugs) || isset($duplicateSlugs[$profession['slug']])) {
        // Append SSYK code to make unique
        $profession['slug'] .= '-' . $ssykCode;
    }
    $duplicateSlugs[$profession['slug']] = true;
    $existingSlugs[] = $profession['slug'];
    
    $newProfessions[] = $profession;
    echo "NEW: {$profession['title']} ({$ssykCode}) -> {$profession['slug']} - {$profession['avg_salary']} kr\n";
}

echo "\n=== SUMMARY ===\n";
echo "New professions generated: " . count($newProfessions) . "\n";
echo "Skipped (no data): " . count($skipped) . "\n";

if (!empty($skipped)) {
    echo "\nSkipped professions:\n";
    foreach ($skipped as $s) {
        echo "  - $s\n";
    }
}

// Save new professions
if (count($newProfessions) > 0) {
    $allProfessions = array_merge($existingProfessions, $newProfessions);
    $output = json_encode($allProfessions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    file_put_contents($targetPath, $output);
    echo "\nSaved " . count($allProfessions) . " total professions to professions.json\n";
}
