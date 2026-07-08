<?php
/**
 * Analyse des données kommunal extraites pour le plan
 */

$kommunalData = json_decode(file_get_contents('data/scb/03_kommunal_sektor_2024.json'), true);
$privatData = json_decode(file_get_contents('data/scb/01_privat_tjansteman_2024.json'), true);

echo "═══════════════════════════════════════════════════════════════\n";
echo "  ANALYSE DES DONNÉES KOMMUNAL POUR LE PLAN V4\n";
echo "═══════════════════════════════════════════════════════════════\n\n";

echo "Total professions kommunal: " . count($kommunalData) . "\n";
echo "Total professions privat: " . count($privatData) . "\n\n";

// Créer un index des salaires privat par SSYK
$privatIndex = [];
foreach ($privatData as $p) {
    $privatIndex[$p['ssyk_code']] = $p['salary_total'] ?? 0;
}

// Mots-clés Semrush prioritaires (volume élevé)
$priorityKeywords = [
    'undersköterska' => ['ssyk' => '532', 'volume' => 260],
    'enhetschef' => ['ssyk' => '1522', 'volume' => 590],
    'barnskötare' => ['ssyk' => '5311', 'volume' => 320],
    'samordnare' => ['ssyk' => '3359', 'volume' => 210],
    'administratör' => ['ssyk' => '4110', 'volume' => 110],
    'fastighetsskötare' => ['ssyk' => '5153', 'volume' => 480],
    'lokalvårdare' => ['ssyk' => '9112', 'volume' => 320],
    'biståndshandläggare' => ['ssyk' => '2641', 'volume' => 590],
    'kock' => ['ssyk' => '5120', 'volume' => 140],
    'socialsekreterare' => ['ssyk' => '2641', 'volume' => 90],
    'förskollärare' => ['ssyk' => '2342', 'volume' => 140],
    'fritidsledare' => ['ssyk' => '3412', 'volume' => 170],
    'vårdbiträde' => ['ssyk' => '5321', 'volume' => 320],
    'vaktmästare' => ['ssyk' => '5151', 'volume' => 90],
    'skolsköterska' => ['ssyk' => '2234', 'volume' => 390],
];

echo "━━━ PROFESSIONS PRIORITAIRES (Avec données Semrush) ━━━\n\n";
printf("%-25s %8s %8s %8s %6s\n", "PROFESSION", "KOMMUNAL", "PRIVAT", "DIFF", "VOL");
echo str_repeat("-", 70) . "\n";

$found = [];
foreach ($kommunalData as $k) {
    // Chercher les correspondances par nom
    foreach ($priorityKeywords as $keyword => $info) {
        $profName = mb_strtolower($k['profession']);
        if (strpos($profName, $keyword) !== false || $k['ssyk_code'] === $info['ssyk']) {
            $privatSalary = $privatIndex[$k['ssyk_code']] ?? 0;
            $diff = $privatSalary > 0 ? round((($k['salary_total'] - $privatSalary) / $privatSalary) * 100, 1) : 0;
            $diffStr = ($diff >= 0 ? '+' : '') . $diff . '%';
            
            printf("%-25s %8d %8d %8s %6d\n", 
                mb_substr($keyword, 0, 25), 
                $k['salary_total'], 
                $privatSalary,
                $diffStr,
                $info['volume']
            );
            $found[$keyword] = [
                'ssyk' => $k['ssyk_code'],
                'name' => $k['profession'],
                'salary_kommunal' => $k['salary_total'],
                'salary_privat' => $privatSalary,
                'diff_percent' => $diff,
                'volume' => $info['volume']
            ];
            break;
        }
    }
}

echo "\n━━━ TOP 10 SALAIRES KOMMUNAL ━━━\n\n";
usort($kommunalData, fn($a, $b) => $b['salary_total'] <=> $a['salary_total']);
foreach (array_slice($kommunalData, 0, 10) as $k) {
    printf("[%4s] %-45s %6d kr\n", $k['ssyk_code'], mb_substr($k['profession'], 0, 45), $k['salary_total']);
}

echo "\n━━━ STATISTIQUES KOMMUNAL ━━━\n\n";
$salaries = array_filter(array_column($kommunalData, 'salary_total'), fn($s) => $s > 0);
$avg = round(array_sum($salaries) / count($salaries));
$min = min($salaries);
$max = max($salaries);

echo "Moyenne: $avg kr\n";
echo "Min: $min kr | Max: $max kr\n";
echo "Professions avec données: " . count($salaries) . "\n";

// Exporter pour le plan
echo "\n━━━ EXPORT POUR LE PLAN ━━━\n";
file_put_contents('data/scb/kommunal_priority_analysis.json', json_encode($found, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Sauvegardé: data/scb/kommunal_priority_analysis.json\n";
