<?php

$json = file_get_contents(__DIR__ . '/../data/professions.json');
$data = json_decode($json, true);

foreach ($data as $p) {
    if ($p['slug'] === 'st-lakare') {
        echo "Slug: " . json_encode($p['slug']) . "\n";
        echo "Title: " . $p['title'] . "\n";
        break;
    }
    // Also check for similar
    if (strpos($p['slug'], 'lakare') !== false) {
         echo "Match found: " . json_encode($p['slug']) . "\n";
    }
}
