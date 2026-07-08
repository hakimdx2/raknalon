<?php
/**
 * ============================================================================
 * SCRIPT D'INTÉGRATION DES DONNÉES SCB DANS PROFESSIONS.JSON
 * ============================================================================
 * 
 * Ce script enrichit professions.json avec les données officielles SCB :
 * - Salaires par genre (gender pay gap)
 * - Percentiles (P10, P25, P50, P75, P90)
 * - Historique 10 ans (2014-2024)
 * 
 * USAGE : php scripts/integrate_scb_data.php
 * 
 * ⚠️ ATTENTION : Crée automatiquement un backup avant modification
 * ============================================================================
 */

echo "╔══════════════════════════════════════════════════════════════════════╗\n";
echo "║  INTÉGRATION DES DONNÉES SCB DANS RAKNALON.SE                       ║\n";
echo "╚══════════════════════════════════════════════════════════════════════╝\n\n";

// ============================================================================
// CHEMINS DES FICHIERS
// ============================================================================
$baseDir = dirname(__DIR__);
$professionsFile = $baseDir . '/data/professions.json';
$mappingFile = $baseDir . '/data/scb/ssyk_mapping.json';
$scbSalaryFile = $baseDir . '/data/scb/01_privat_tjansteman_2024.json';
$scbPercentilesFile = $baseDir . '/data/scb/06_percentiles_2024.json';
$scbHistoryFile = $baseDir . '/data/scb/07_historique_2014_2024.json';

// ============================================================================
// VÉRIFICATION DES FICHIERS
// ============================================================================
echo "1. Vérification des fichiers...\n";

$files = [
    'professions.json' => $professionsFile,
    'ssyk_mapping.json' => $mappingFile,
    'SCB salaires' => $scbSalaryFile,
    'SCB percentiles' => $scbPercentilesFile,
    'SCB historique' => $scbHistoryFile
];

foreach ($files as $name => $path) {
    if (!file_exists($path)) {
        die("   ❌ ERREUR : $name non trouvé à $path\n");
    }
    echo "   ✓ $name trouvé\n";
}

// ============================================================================
// CHARGEMENT DES DONNÉES
// ============================================================================
echo "\n2. Chargement des données...\n";

$professions = json_decode(file_get_contents($professionsFile), true);
$mapping = json_decode(file_get_contents($mappingFile), true);
$scbSalary = json_decode(file_get_contents($scbSalaryFile), true);
$scbPercentiles = json_decode(file_get_contents($scbPercentilesFile), true);
$scbHistory = json_decode(file_get_contents($scbHistoryFile), true);

echo "   ✓ " . count($professions) . " professions chargées\n";
echo "   ✓ " . count($mapping) . " mappings SSYK chargés\n";
echo "   ✓ " . count($scbSalary) . " entrées SCB salaires\n";
echo "   ✓ " . count($scbPercentiles) . " entrées SCB percentiles\n";
echo "   ✓ " . count($scbHistory) . " entrées SCB historique\n";

// ============================================================================
// INDEXER LES DONNÉES SCB PAR CODE SSYK
// ============================================================================
echo "\n3. Indexation des données SCB...\n";

$salaryByCode = [];
foreach ($scbSalary as $item) {
    $salaryByCode[$item['ssyk_code']] = $item;
}

$percentilesByCode = [];
foreach ($scbPercentiles as $item) {
    $percentilesByCode[$item['ssyk_code']] = $item;
}

$historyByCode = [];
foreach ($scbHistory as $item) {
    $historyByCode[$item['ssyk_code']] = $item;
}

echo "   ✓ Données indexées par code SSYK\n";

// ============================================================================
// BACKUP DU FICHIER ORIGINAL
// ============================================================================
echo "\n4. Création du backup...\n";

$backupFile = $professionsFile . '.backup_' . date('Y-m-d_His');
copy($professionsFile, $backupFile);
echo "   ✓ Backup créé : " . basename($backupFile) . "\n";

// ============================================================================
// ENRICHISSEMENT DES PROFESSIONS
// ============================================================================
echo "\n5. Enrichissement des professions...\n";

$updated = 0;
$skipped = 0;
$errors = [];

foreach ($professions as &$profession) {
    $slug = $profession['slug'];
    
    // Vérifier si on a un mapping pour cette profession
    if (!isset($mapping[$slug])) {
        $errors[] = "Pas de mapping SSYK pour '$slug'";
        $skipped++;
        continue;
    }
    
    $ssykCode = $mapping[$slug];
    
    // Initialiser l'objet SCB
    $profession['scb'] = [
        'ssyk_code' => $ssykCode,
        'year' => 2024,
        'source' => 'SCB - Statistiska centralbyrån'
    ];
    
    // Ajouter les données de salaire + gender gap
    if (isset($salaryByCode[$ssykCode])) {
        $sal = $salaryByCode[$ssykCode];
        $profession['scb']['salary_total'] = $sal['salary_total'] ?? 0;
        $profession['scb']['salary_men'] = $sal['salary_men'] ?? 0;
        $profession['scb']['salary_women'] = $sal['salary_women'] ?? 0;
        $profession['scb']['gender_gap_percent'] = $sal['gender_gap_percent'] ?? null;
    }
    
    // Ajouter les percentiles
    if (isset($percentilesByCode[$ssykCode])) {
        $perc = $percentilesByCode[$ssykCode];
        $profession['scb']['percentiles'] = [
            'p10' => $perc['p10'] ?? 0,
            'p25' => $perc['p25'] ?? 0,
            'p50' => $perc['median'] ?? 0,
            'p75' => $perc['p75'] ?? 0,
            'p90' => $perc['p90'] ?? 0
        ];
    }
    
    // Ajouter l'historique
    if (isset($historyByCode[$ssykCode])) {
        $hist = $historyByCode[$ssykCode];
        $profession['scb']['history'] = $hist['history'] ?? [];
        $profession['scb']['evolution_10y_percent'] = $hist['evolution_10y_percent'] ?? null;
    }
    
    $updated++;
}

echo "   ✓ $updated professions enrichies\n";
echo "   ⚠ $skipped professions ignorées (pas de mapping)\n";

// ============================================================================
// SAUVEGARDE
// ============================================================================
echo "\n6. Sauvegarde du fichier enrichi...\n";

$jsonOptions = JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
file_put_contents($professionsFile, json_encode($professions, $jsonOptions));

$newSize = round(filesize($professionsFile) / 1024, 1);
echo "   ✓ professions.json mis à jour ($newSize KB)\n";

// ============================================================================
// RAPPORT
// ============================================================================
echo "\n";
echo "╔══════════════════════════════════════════════════════════════════════╗\n";
echo "║  RAPPORT D'INTÉGRATION                                              ║\n";
echo "╚══════════════════════════════════════════════════════════════════════╝\n\n";

echo "Professions mises à jour : $updated / " . count($professions) . "\n";
echo "Backup créé : " . basename($backupFile) . "\n\n";

if (count($errors) > 0) {
    echo "⚠ Avertissements :\n";
    foreach ($errors as $error) {
        echo "   - $error\n";
    }
}

// Afficher un exemple
echo "\n📋 Exemple de données ajoutées (psykolog) :\n";
foreach ($professions as $p) {
    if ($p['slug'] === 'psykolog' && isset($p['scb'])) {
        echo json_encode($p['scb'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
        break;
    }
}

echo "\n✅ Intégration terminée avec succès !\n";
