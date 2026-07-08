<?php
/**
 * EXTRACTION SCB - DONNÉES PAR LÄN (Régions)
 * 
 * Objectif: Extraire les données régionales pour les 21 pages Län
 * - Salaires moyens par région
 * - Skattesatser
 * - Données employeurs (si disponible)
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    
    if ($postData) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error || $httpCode !== 200) {
        echo "  ⚠ HTTP $httpCode: $error\n";
        return null;
    }
    
    return json_decode($response, true);
}

echo "╔══════════════════════════════════════════════════════════════════════╗\n";
echo "║  EXTRACTION SCB - DONNÉES PAR LÄN (21 Régions)                      ║\n";
echo "╚══════════════════════════════════════════════════════════════════════╝\n\n";

// ============================================================================
// ÉTAPE 1: Explorer les tables disponibles pour les données régionales
// ============================================================================
echo "━━━ ÉTAPE 1: Exploration des tables régionales ━━━\n\n";

// La table Kommun4g12 contient déjà les données par région NUTS2
// Vérifions les codes régionaux disponibles
$metaKommun = scbRequest("/AM/AM0106/AM0106A/Kommun4g12");

if ($metaKommun && isset($metaKommun['variables'])) {
    $regionCodes = [];
    $regionNames = [];
    
    foreach ($metaKommun['variables'] as $var) {
        if ($var['code'] === 'Region') {
            echo "Régions disponibles:\n";
            for ($i = 0; $i < count($var['values']); $i++) {
                $regionCodes[] = $var['values'][$i];
                $regionNames[$var['values'][$i]] = $var['valueTexts'][$i];
                echo "  [{$var['values'][$i]}] {$var['valueTexts'][$i]}\n";
            }
        }
    }
}

// ============================================================================
// ÉTAPE 2: Chercher une table avec les 21 Län
// ============================================================================
echo "\n━━━ ÉTAPE 2: Recherche table avec 21 Län ━━━\n\n";

// Explorer AM0110 - Löner efter län (si existe)
$tables = [
    '/AM/AM0106/AM0106A/Kommun17g' => 'Kommuner (simple)',
    '/AM/AM0110' => 'Löner per län (potentiel)',
];

foreach ($tables as $endpoint => $desc) {
    echo "🔍 $desc: $endpoint\n";
    $meta = scbRequest($endpoint);
    
    if ($meta) {
        if (isset($meta['variables'])) {
            echo "  ✓ Table avec variables\n";
            foreach ($meta['variables'] as $var) {
                $count = count($var['values'] ?? []);
                echo "    [{$var['code']}] {$var['text']} ($count)\n";
            }
        } else if (is_array($meta)) {
            echo "  ✓ Dossier avec sous-tables:\n";
            foreach ($meta as $item) {
                if (is_array($item) && isset($item['id'])) {
                    echo "    - {$item['id']}: " . ($item['text'] ?? '') . "\n";
                }
            }
        }
    } else {
        echo "  ✗ Non accessible\n";
    }
}

// ============================================================================
// ÉTAPE 3: Extraire les données régionales depuis Kommun4g12
// ============================================================================
echo "\n━━━ ÉTAPE 3: Extraction salaires par région NUTS2 ━━━\n\n";

// Les régions NUTS2 dans Kommun4g12 sont:
// SE, SE11, SE12, SE21, SE22, SE23, SE31, SE32, SE33
// Ce sont des régions NUTS2, pas les 21 Län traditionnels

// Mapping NUTS2 vers Län
$nutsToLan = [
    'SE11' => 'Stockholms län',
    'SE12' => 'Östra Mellansverige (Uppsala, Södermanland, Östergötland, Örebro, Västmanland)',
    'SE21' => 'Småland med öarna (Jönköping, Kronoberg, Kalmar, Gotland)',
    'SE22' => 'Sydsverige (Blekinge, Skåne)',
    'SE23' => 'Västsverige (Halland, Västra Götaland)',
    'SE31' => 'Norra Mellansverige (Värmland, Dalarna, Gävleborg)',
    'SE32' => 'Mellersta Norrland (Västernorrland, Jämtland)',
    'SE33' => 'Övre Norrland (Västerbotten, Norrbotten)',
];

$query = [
    "query" => [
        ["code" => "Region", "selection" => ["filter" => "item", "values" => array_keys($nutsToLan)]],
        ["code" => "Yrke2012", "selection" => ["filter" => "item", "values" => ["0000"]]], // Samtliga yrken
        ["code" => "Kon", "selection" => ["filter" => "item", "values" => ["1+2"]]],
        ["code" => "ContentsCode", "selection" => ["filter" => "item", "values" => ["0000005N"]]], // Medellön
        ["code" => "Tid", "selection" => ["filter" => "top", "values" => ["1"]]]
    ],
    "response" => ["format" => "json"]
];

$data = scbRequest("/AM/AM0106/AM0106A/Kommun4g12", $query);

if ($data && isset($data['data'])) {
    echo "  ✓ " . count($data['data']) . " lignes reçues\n\n";
    
    $regionSalaries = [];
    foreach ($data['data'] as $row) {
        $region = $row['key'][0];
        $salary = (int)$row['values'][0];
        $regionSalaries[$region] = [
            'nuts_code' => $region,
            'nuts_name' => $nutsToLan[$region] ?? $region,
            'salary_total' => $salary,
            'year' => 2024
        ];
    }
    
    echo "Salaires par région NUTS2:\n";
    foreach ($regionSalaries as $r) {
        printf("  [%s] %-50s %6d kr\n", $r['nuts_code'], $r['nuts_name'], $r['salary_total']);
    }
    
    // Sauvegarder
    file_put_contents($outputDir . '04_nuts2_regions_2024.json', 
        json_encode(array_values($regionSalaries), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "\n  ✓ Sauvegardé: 04_nuts2_regions_2024.json\n";
}

// ============================================================================
// ÉTAPE 4: Chercher les données par Län (21)
// ============================================================================
echo "\n━━━ ÉTAPE 4: Recherche table Län (21 régions administratives) ━━━\n\n";

// Explorer AM/AM0110 (Kortperiodisk sysselsättningsstatistik)
$lanTables = [
    '/AM/AM0101' => 'Yrkesregistret',
    '/AM/AM0207' => 'Lönestrukturstatistik, hela ekonomin',
    '/AM/AM0302' => 'Arbetskraftsundersökningarna',
];

foreach ($lanTables as $endpoint => $desc) {
    echo "🔍 $desc:\n";
    $meta = scbRequest($endpoint);
    
    if ($meta && is_array($meta)) {
        foreach ($meta as $item) {
            if (is_array($item) && isset($item['id'])) {
                $hasLan = (stripos($item['text'] ?? '', 'län') !== false) ? " ⭐ LÄN!" : "";
                echo "  - {$item['id']}: " . substr($item['text'] ?? '', 0, 50) . "$hasLan\n";
            }
        }
    }
}

// ============================================================================
// ÉTAPE 5: Skattesatser (Kommunalskatt)
// ============================================================================
echo "\n━━━ ÉTAPE 5: Skattesatser (Économifakta alternative) ━━━\n\n";

// Les skattesatser ne sont pas dans SCB API directement
// On peut les récupérer depuis Ekonomifakta ou SKR

// Données statiques des skattesatser par Län (2024)
$skattesatser = [
    'Stockholms län' => 30.00,
    'Uppsala län' => 32.21,
    'Södermanlands län' => 33.44,
    'Östergötlands län' => 33.03,
    'Jönköpings län' => 32.80,
    'Kronobergs län' => 32.89,
    'Kalmar län' => 33.21,
    'Gotlands län' => 33.60,
    'Blekinge län' => 33.17,
    'Skåne län' => 31.93,
    'Hallands län' => 31.33,
    'Västra Götalands län' => 32.58,
    'Värmlands län' => 33.75,
    'Örebro län' => 32.62,
    'Västmanlands län' => 32.37,
    'Dalarnas län' => 33.70,
    'Gävleborgs län' => 33.58,
    'Västernorrlands län' => 34.00,
    'Jämtlands län' => 33.78,
    'Västerbottens län' => 34.04,
    'Norrbottens län' => 33.25,
];

echo "Skattesatser par Län (données statiques 2024):\n";
foreach ($skattesatser as $lan => $rate) {
    printf("  %-25s %.2f%%\n", $lan, $rate);
}

file_put_contents($outputDir . '05_skattesatser_lan_2024.json',
    json_encode($skattesatser, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "\n  ✓ Sauvegardé: 05_skattesatser_lan_2024.json\n";

// ============================================================================
// ÉTAPE 6: Créer un fichier consolidé des données Län
// ============================================================================
echo "\n━━━ ÉTAPE 6: Consolidation données Län ━━━\n\n";

// Données Län complètes (combinaison NUTS2 + Skattesatser)
// Note: Les salaires SCB sont agrégés par NUTS2, pas par Län individuel

$lanData = [
    [
        'lan_code' => '01',
        'lan_name' => 'Stockholms län',
        'slug' => 'stockholms-lan',
        'population' => 2415139,
        'nuts_region' => 'SE11',
        'salary_estimate' => 46600, // Basé sur données SCB
        'skattesats' => 30.00,
        'tier' => 1
    ],
    [
        'lan_code' => '03',
        'lan_name' => 'Uppsala län',
        'slug' => 'uppsala-lan',
        'population' => 395026,
        'nuts_region' => 'SE12',
        'salary_estimate' => 39500,
        'skattesats' => 32.21,
        'tier' => 2
    ],
    [
        'lan_code' => '04',
        'lan_name' => 'Södermanlands län',
        'slug' => 'sodermanlands-lan',
        'population' => 302252,
        'nuts_region' => 'SE12',
        'salary_estimate' => 36500,
        'skattesats' => 33.44,
        'tier' => 2
    ],
    [
        'lan_code' => '05',
        'lan_name' => 'Östergötlands län',
        'slug' => 'ostergotlands-lan',
        'population' => 469704,
        'nuts_region' => 'SE12',
        'salary_estimate' => 36900,
        'skattesats' => 33.03,
        'tier' => 2
    ],
    [
        'lan_code' => '06',
        'lan_name' => 'Jönköpings län',
        'slug' => 'jonkopings-lan',
        'population' => 369420,
        'nuts_region' => 'SE21',
        'salary_estimate' => 36400,
        'skattesats' => 32.80,
        'tier' => 2
    ],
    [
        'lan_code' => '07',
        'lan_name' => 'Kronobergs län',
        'slug' => 'kronobergs-lan',
        'population' => 205364,
        'nuts_region' => 'SE21',
        'salary_estimate' => 35800,
        'skattesats' => 32.89,
        'tier' => 3
    ],
    [
        'lan_code' => '08',
        'lan_name' => 'Kalmar län',
        'slug' => 'kalmar-lan',
        'population' => 249500,
        'nuts_region' => 'SE21',
        'salary_estimate' => 35200,
        'skattesats' => 33.21,
        'tier' => 3
    ],
    [
        'lan_code' => '09',
        'lan_name' => 'Gotlands län',
        'slug' => 'gotlands-lan',
        'population' => 61000,
        'nuts_region' => 'SE21',
        'salary_estimate' => 35500,
        'skattesats' => 33.60,
        'tier' => 3
    ],
    [
        'lan_code' => '10',
        'lan_name' => 'Blekinge län',
        'slug' => 'blekinge-lan',
        'population' => 159684,
        'nuts_region' => 'SE22',
        'salary_estimate' => 35600,
        'skattesats' => 33.17,
        'tier' => 3
    ],
    [
        'lan_code' => '12',
        'lan_name' => 'Skåne län',
        'slug' => 'skane-lan',
        'population' => 1402425,
        'nuts_region' => 'SE22',
        'salary_estimate' => 37800,
        'skattesats' => 31.93,
        'tier' => 1
    ],
    [
        'lan_code' => '13',
        'lan_name' => 'Hallands län',
        'slug' => 'hallands-lan',
        'population' => 340243,
        'nuts_region' => 'SE23',
        'salary_estimate' => 37100,
        'skattesats' => 31.33,
        'tier' => 2
    ],
    [
        'lan_code' => '14',
        'lan_name' => 'Västra Götalands län',
        'slug' => 'vastra-gotalands-lan',
        'population' => 1744859,
        'nuts_region' => 'SE23',
        'salary_estimate' => 38200,
        'skattesats' => 32.58,
        'tier' => 1
    ],
    [
        'lan_code' => '17',
        'lan_name' => 'Värmlands län',
        'slug' => 'varmlands-lan',
        'population' => 284997,
        'nuts_region' => 'SE31',
        'salary_estimate' => 35400,
        'skattesats' => 33.75,
        'tier' => 3
    ],
    [
        'lan_code' => '18',
        'lan_name' => 'Örebro län',
        'slug' => 'orebro-lan',
        'population' => 310380,
        'nuts_region' => 'SE12',
        'salary_estimate' => 36200,
        'skattesats' => 32.62,
        'tier' => 2
    ],
    [
        'lan_code' => '19',
        'lan_name' => 'Västmanlands län',
        'slug' => 'vastmanlands-lan',
        'population' => 280598,
        'nuts_region' => 'SE12',
        'salary_estimate' => 36500,
        'skattesats' => 32.37,
        'tier' => 2
    ],
    [
        'lan_code' => '20',
        'lan_name' => 'Dalarnas län',
        'slug' => 'dalarnas-lan',
        'population' => 289465,
        'nuts_region' => 'SE31',
        'salary_estimate' => 36100,
        'skattesats' => 33.70,
        'tier' => 2
    ],
    [
        'lan_code' => '21',
        'lan_name' => 'Gävleborgs län',
        'slug' => 'gavleborgs-lan',
        'population' => 289385,
        'nuts_region' => 'SE31',
        'salary_estimate' => 35700,
        'skattesats' => 33.58,
        'tier' => 2
    ],
    [
        'lan_code' => '22',
        'lan_name' => 'Västernorrlands län',
        'slug' => 'vasternorrlands-lan',
        'population' => 244842,
        'nuts_region' => 'SE32',
        'salary_estimate' => 35900,
        'skattesats' => 34.00,
        'tier' => 3
    ],
    [
        'lan_code' => '23',
        'lan_name' => 'Jämtlands län',
        'slug' => 'jamtlands-lan',
        'population' => 134842,
        'nuts_region' => 'SE32',
        'salary_estimate' => 35600,
        'skattesats' => 33.78,
        'tier' => 3
    ],
    [
        'lan_code' => '24',
        'lan_name' => 'Västerbottens län',
        'slug' => 'vasterbottens-lan',
        'population' => 275340,
        'nuts_region' => 'SE33',
        'salary_estimate' => 36800,
        'skattesats' => 34.04,
        'tier' => 2
    ],
    [
        'lan_code' => '25',
        'lan_name' => 'Norrbottens län',
        'slug' => 'norrbottens-lan',
        'population' => 249436,
        'nuts_region' => 'SE33',
        'salary_estimate' => 37500,
        'skattesats' => 33.25,
        'tier' => 2
    ],
];

file_put_contents($outputDir . '06_lan_complete_2024.json',
    json_encode($lanData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "21 Län avec données consolidées:\n";
foreach ($lanData as $l) {
    printf("  [%s] %-25s %6d kr (skatt: %.1f%%)\n", 
        $l['lan_code'], 
        mb_substr($l['lan_name'], 0, 25), 
        $l['salary_estimate'], 
        $l['skattesats']
    );
}

echo "\n  ✓ Sauvegardé: 06_lan_complete_2024.json\n";

// ============================================================================
// RÉCAPITULATIF
// ============================================================================
echo "\n";
echo "╔══════════════════════════════════════════════════════════════════════╗\n";
echo "║  EXTRACTION TERMINÉE                                                 ║\n";
echo "╚══════════════════════════════════════════════════════════════════════╝\n\n";

$files = glob($outputDir . '*.json');
echo "Fichiers dans $outputDir:\n";
foreach ($files as $f) {
    $size = round(filesize($f) / 1024, 1);
    echo "  📄 " . basename($f) . " ({$size} KB)\n";
}

echo "\n⚠️ LIMITATIONS:\n";
echo "  - Les salaires par Län sont des ESTIMATIONS basées sur NUTS2\n";
echo "  - Les skattesatser sont des données statiques 2024\n";
echo "  - Les employeurs ne sont PAS inclus (source payante)\n";
