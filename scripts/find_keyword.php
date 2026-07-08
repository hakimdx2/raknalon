<?php

$json = file_get_contents(__DIR__ . '/../data/professions.json');
$data = json_decode($json, true);

$keyword = 'industrielektriker';
$found = false;

foreach ($data as $p) {
    $content = json_encode($p);
    if (stripos($content, $keyword) !== false) {
        $found = true;
        file_put_contents('keyword_results.txt', "Found '$keyword' in profession: " . $p['slug'] . "\n", FILE_APPEND);
        // Find specifically where
        array_walk_recursive($p, function($value, $key) use ($keyword, $p) {
            if (is_string($value) && stripos($value, $keyword) !== false) {
                file_put_contents('keyword_results.txt', "  Key '$key' contains match: ... " . substr($value, max(0, stripos($value, $keyword) - 20), 50) . " ...\n", FILE_APPEND);
            }
        });
    }
}

if (!$found) {
    file_put_contents('keyword_results.txt', "Keyword '$keyword' not found in any profession data.\n", FILE_APPEND);
}
