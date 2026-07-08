<?php

$json = file_get_contents(__DIR__ . '/../data/professions.json');
$data = json_decode($json, true);

foreach ($data as $p) {
    if ($p['slug'] === 'elektriker') {
        echo "Slug: " . $p['slug'] . "\n";
        echo "Related Professions: \n";
        echo json_encode($p['related_professions'] ?? 'None', JSON_PRETTY_PRINT);
        echo "\nDescription Extended excerpt: \n";
        echo substr($p['description_extended'] ?? '', 0, 200) . "\n";
        break;
    }
}
