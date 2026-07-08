<?php

$json = file_get_contents(__DIR__ . '/../data/professions.json');
$data = json_decode($json, true);

if (!$data) {
    echo "JSON decode failed\n";
    exit;
}

$targets = ['st-lakare', 'specialistsjukskoterska', 'industrielektriker'];
$found = [];
$counts = [];

foreach ($data as $p) {
    $slug = $p['slug'];
    if (in_array($slug, $targets)) {
        $found[$slug] = $p;
        $counts[$slug] = ($counts[$slug] ?? 0) + 1;
    }
}

$output = "Verification Results:\n";
foreach ($targets as $t) {
    if (isset($found[$t])) {
        $output .= "Slug '$t' FOUND. Count: " . ($counts[$t] ?? 0) . "\n";
        $p = $found[$t];
        $output .= "  Title: " . $p['title'] . "\n";
        $output .= "  SCB Data present: " . (isset($p['scb']) ? 'YES' : 'NO') . "\n";
        if (isset($p['scb'])) {
             $output .= "    SSYK: " . ($p['scb']['ssyk_code'] ?? 'N/A') . "\n";
             $output .= "    Salary: " . ($p['scb']['salary_total'] ?? 'N/A') . "\n";
        }
    } else {
        $output .= "Slug '$t' NOT FOUND in professions.json\n";
    }
}

file_put_contents('verification_results.txt', $output);
