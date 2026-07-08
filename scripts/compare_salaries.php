<?php
/**
 * Comparaison des salaires existants vs données SCB
 */

$data = json_decode(file_get_contents('data/professions.json'), true);

echo "COMPARAISON SALAIRES EXISTANTS vs SCB\n";
echo "=====================================\n\n";

$results = [];

foreach ($data as $p) {
    if (!isset($p['scb']) || $p['scb']['salary_total'] == 0) {
        continue;
    }
    
    $scbTotal = $p['scb']['salary_total'];
    $oldAvg = $p['avg_salary'];
    $diffPercent = round((($scbTotal - $oldAvg) / $oldAvg) * 100);
    
    $results[] = [
        'title' => $p['title'],
        'old' => $oldAvg,
        'scb' => $scbTotal,
        'diff' => $diffPercent
    ];
}

// Trier par différence
usort($results, function($a, $b) {
    return abs($b['diff']) <=> abs($a['diff']);
});

echo "GRANDES DIFFERENCES (>15%):\n";
echo "----------------------------\n";
foreach ($results as $r) {
    if (abs($r['diff']) > 15) {
        $sign = $r['diff'] > 0 ? '+' : '';
        echo sprintf("%-25s : %6d -> %6d SCB (%s%d%%)\n", 
            mb_substr($r['title'], 0, 25), 
            $r['old'], 
            $r['scb'], 
            $sign, 
            $r['diff']
        );
    }
}

echo "\nCOHERENTS (<15%):\n";
echo "-----------------\n";
$coherentCount = 0;
foreach ($results as $r) {
    if (abs($r['diff']) <= 15) {
        $coherentCount++;
    }
}
echo "$coherentCount/" . count($results) . " professions\n";

echo "\nEXPLICATION:\n";
echo "Les données SCB sont pour le SECTEUR PRIVE (tjänstemän)\n";
echo "Les anciennes données incluaient probablement tous les secteurs\n";
echo "-> SCB montre souvent des salaires plus élevés\n";
