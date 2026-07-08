<?php

$json = file_get_contents(__DIR__ . '/../data/professions.json');
$data = json_decode($json, true);

if (!$data) {
    echo "Error decoding JSON\n";
    exit(1);
}

echo "Total professions: " . count($data) . "\n";

$slugs = [];
$duplicates = [];

foreach ($data as $p) {
    if (!isset($p['slug'])) {
        echo "Missing slug for: " . ($p['title'] ?? 'Unknown') . "\n";
        continue;
    }
    
    $slug = $p['slug'];
    if (in_array($slug, $slugs)) {
        $duplicates[] = $slug;
    }
    $slugs[] = $slug;
    
    if ($slug === 'st-lakare' || $slug === 'specialistsjukskoterska') {
        file_put_contents('results.txt', "FOUND BROKEN SLUG: $slug\n", FILE_APPEND);
    }
}

if (count($duplicates) > 0) {
    file_put_contents('results.txt', "Duplicate slugs found: " . implode(', ', array_unique($duplicates)) . "\n", FILE_APPEND);
} else {
    file_put_contents('results.txt', "No duplicate slugs found.\n", FILE_APPEND);
}

// Check if these specific broken ones are NOT in the list
if (!in_array('st-lakare', $slugs)) {
    file_put_contents('results.txt', "st-lakare NOT found (Good if it was broken)\n", FILE_APPEND);
}
if (!in_array('specialistsjukskoterska', $slugs)) {
    file_put_contents('results.txt', "specialistsjukskoterska NOT found (Good if it was broken)\n", FILE_APPEND);
}

// Also check for Kommunal sector page generation logic simulation
// We probably can't easily simulate the Service calls without dependencies, 
// but we can check if there are any other professions that might generate broken links
