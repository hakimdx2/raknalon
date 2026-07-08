<?php
/**
 * EXTRACTION SCB - SECTEUR KOMMUNAL PAR SSYK
 * 
 * Table: AM0106A/Kommun4g12
 * Variables: Yrke2012 (432 professions SSYK)
 */

$baseUrl = "https://api.scb.se/OV0104/v1/doris/sv/ssd";
$outputDir = __DIR__ . '/../data/scb/';

@mkdir($outputDir, 0755, true);

function scbRequest($endpoint, $postData = null) {
    global $baseUrl;
    $url = $baseUrl . $endpoint;
    
    echo "  → $url\n";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 300);
    
    if ($postData) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error || $httpCode !== 200) {
        echo "  ⚠ Erreur: HTTP $httpCode - $error\n";
        if ($httpCode == 400) {
            echo "  Response: " . substr($response, 0, 500) . "\n";
        }
        return null;
    }
    
    return json_decode($response, true);
}

echo "╔══════════════════════════════════════════════════════════════════════╗\n";
echo "║  EXTRACTION SCB - KOMMUNAL PAR SSYK (Table Kommun4g12)              ║\n";
echo "╚══════════════════════════════════════════════════════════════════════╝\n\n";

// ============================================================================
// ÉTAPE 1: Récupérer les métadonnées
// ============================================================================
echo "━━━ ÉTAPE 1: Métadonnées ━━━\n";
$endpoint = "/AM/AM0106/AM0106A/Kommun4g12";
$meta = scbRequest($endpoint);

if (!$meta || !isset($meta['variables'])) {
    die("Erreur: Impossible de récupérer les métadonnées\n");
}

$regionCodes = [];
$regionNames = [];
$ssykCodes = [];
$ssykNames = [];
$contentCodes = [];
$contentNames = [];
$timeCodes = [];

foreach ($meta['variables'] as $var) {
    echo "  [{$var['code']}] " . count($var['values'] ?? []) . " valeurs\n";
    
    if ($var['code'] === 'Region') {
        for ($i = 0; $i < count($var['values']); $i++) {
            $regionCodes[] = $var['values'][$i];
            $regionNames[$var['values'][$i]] = $var['valueTexts'][$i];
        }
        echo "    Régions: " . implode(", ", array_slice($regionCodes, 0, 5)) . "...\n";
    }
    
    if ($var['code'] === 'Yrke2012') {
        // Prendre TOUTES les professions
        for ($i = 0; $i < count($var['values']); $i++) {
            $ssykCodes[] = $var['values'][$i];
            $ssykNames[$var['values'][$i]] = $var['valueTexts'][$i];
        }
    }
    
    if ($var['code'] === 'ContentsCode') {
        for ($i = 0; $i < count($var['values']); $i++) {
            $contentCodes[] = $var['values'][$i];
            $contentNames[$var['values'][$i]] = $var['valueTexts'][$i];
        }
    }
    
    if ($var['code'] === 'Tid') {
        for ($i = 0; $i < count($var['values']); $i++) {
            $timeCodes[] = $var['values'][$i];
        }
        echo "    Années: " . implode(", ", $timeCodes) . "\n";
    }
}

echo "\n  ✓ Régions: " . implode(", ", $regionCodes) . "\n";
echo "  ✓ " . count($ssykCodes) . " professions SSYK (échantillon)\n";

// ============================================================================
// ÉTAPE 2: Extraction des données par région (utiliser "00" si dispo, sinon première région)
// ============================================================================
echo "\n━━━ ÉTAPE 2: Extraction des salaires ━━━\n";

// Utiliser la première région disponible (souvent "00" = Riket ou une région NUTS)
$targetRegion = $regionCodes[0];
echo "  Région cible: $targetRegion ({$regionNames[$targetRegion]})\n";

// Prendre seulement le salaire moyen mensuel
$salaryCode = $contentCodes[0]; // 0000005N = Genomsnittlig månadslön

$query = [
    "query" => [
        ["code" => "Region", "selection" => ["filter" => "item", "values" => [$targetRegion]]],
        ["code" => "Yrke2012", "selection" => ["filter" => "item", "values" => $ssykCodes]],
        ["code" => "Kon", "selection" => ["filter" => "item", "values" => ["1", "2", "1+2"]]],
        ["code" => "ContentsCode", "selection" => ["filter" => "item", "values" => [$salaryCode]]],
        ["code" => "Tid", "selection" => ["filter" => "top", "values" => ["1"]]]
    ],
    "response" => ["format" => "json"]
];

echo "  Requête API (50 professions test)...\n";
$data = scbRequest($endpoint, $query);

if (!$data || !isset($data['data'])) {
    echo "\n  ⚠ Essai avec toutes les régions et filtre top...\n";
    
    // Essayer sans filter Region (toutes les régions agrégées)
    $query = [
        "query" => [
            ["code" => "Region", "selection" => ["filter" => "all", "values" => ["*"]]],
            ["code" => "Yrke2012", "selection" => ["filter" => "item", "values" => array_slice($ssykCodes, 0, 20)]],
            ["code" => "Kon", "selection" => ["filter" => "item", "values" => ["1+2"]]],
            ["code" => "ContentsCode", "selection" => ["filter" => "item", "values" => [$salaryCode]]],
            ["code" => "Tid", "selection" => ["filter" => "top", "values" => ["1"]]]
        ],
        "response" => ["format" => "json"]
    ];
    
    $data = scbRequest($endpoint, $query);
}

if (!$data || !isset($data['data'])) {
    die("Erreur: Pas de données reçues. Vérifier la structure de la requête.\n");
}

echo "  ✓ " . count($data['data']) . " lignes reçues\n";

// Debug: afficher quelques lignes
echo "\n━━━ DEBUG: Premières lignes ━━━\n";
foreach (array_slice($data['data'], 0, 5) as $row) {
    print_r($row);
}

// ============================================================================
// ÉTAPE 3: Parser les données
// ============================================================================
echo "\n━━━ ÉTAPE 3: Parsing des données ━━━\n";

$result = [];

foreach ($data['data'] as $row) {
    // La structure des keys dépend de la requête
    // [Region, Yrke2012, Kon, Tid] typiquement
    $ssyk = $row['key'][1] ?? $row['key'][0];  // Yrke2012
    $gender = $row['key'][2] ?? '1+2';          // Kon
    $year = $row['key'][3] ?? end($timeCodes);  // Tid
    
    $salary = (int)($row['values'][0] ?? 0);
    
    if ($salary == 0) continue;
    
    // Normaliser le code SSYK (enlever les lettres du début si présentes)
    $ssykClean = preg_replace('/^[A-Z]+/', '', $ssyk);
    
    if (!isset($result[$ssykClean])) {
        $result[$ssykClean] = [
            'ssyk_code' => $ssykClean,
            'profession' => $ssykNames[$ssyk] ?? $ssyk,
            'sector' => 'kommunal',
            'year' => (int)$year,
            'salary_total' => 0,
            'salary_men' => 0,
            'salary_women' => 0
        ];
    }
    
    switch ($gender) {
        case '1':
            $result[$ssykClean]['salary_men'] = $salary;
            break;
        case '2':
            $result[$ssykClean]['salary_women'] = $salary;
            break;
        default:
            $result[$ssykClean]['salary_total'] = $salary;
    }
}

// Calculer le gender gap
foreach ($result as &$r) {
    if ($r['salary_men'] > 0 && $r['salary_women'] > 0) {
        $r['gender_gap_percent'] = round(($r['salary_women'] / $r['salary_men']) * 100, 1);
    }
}

// Filtrer les résultats sans salaire
$output = array_filter(array_values($result), function($r) {
    return $r['salary_total'] > 0;
});

echo "  ✓ " . count($output) . " professions avec données\n";

// ============================================================================
// ÉTAPE 4: Sauvegarder
// ============================================================================
if (count($output) > 0) {
    echo "\n━━━ ÉTAPE 4: Sauvegarde ━━━\n";
    
    $filename = $outputDir . '03_kommunal_sektor_2024.json';
    file_put_contents($filename, json_encode(array_values($output), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "  ✓ Sauvegardé: $filename\n";
    
    // Afficher un échantillon
    echo "\n━━━ ÉCHANTILLON ━━━\n";
    foreach (array_slice($output, 0, 10) as $s) {
        $name = mb_substr($s['profession'], 0, 35);
        printf("  [%s] %-35s %6d kr\n", $s['ssyk_code'], $name, $s['salary_total']);
    }
    
    echo "\n✓ EXTRACTION TERMINÉE\n";
} else {
    echo "\n⚠ Aucune donnée valide à sauvegarder\n";
}
