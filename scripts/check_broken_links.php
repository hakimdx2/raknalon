<?php

$json = file_get_contents(__DIR__ . '/../data/professions.json');
$professions = json_decode($json, true);
$slugs = array_column($professions, 'slug');
$slugMap = array_flip($slugs);

$brokenLinks = [];

foreach ($professions as $p) {
    // Check related_professions
    if (isset($p['related_professions']['items']) && is_array($p['related_professions']['items'])) {
        foreach ($p['related_professions']['items'] as $related) {
            if (isset($related['slug']) && !isset($slugMap[$related['slug']])) {
                $brokenLinks[] = [
                    'source' => $p['slug'],
                    'target' => $related['slug'],
                    'type' => 'related_professions'
                ];
            }
        }
    } elseif (isset($p['related_professions']) && is_array($p['related_professions']) && isset($p['related_professions'][0]['slug'])) {
         // Handle simple array case just in case
        foreach ($p['related_professions'] as $related) {
             if (isset($related['slug']) && !isset($slugMap[$related['slug']])) {
                $brokenLinks[] = [
                    'source' => $p['slug'],
                    'target' => $related['slug'],
                    'type' => 'related_professions (simple list)'
                ];
            }
        }
    }
}

if (empty($brokenLinks)) {
    echo "No broken internal links found in related_professions.\n";
} else {
    echo "Found " . count($brokenLinks) . " broken links:\n";
    foreach ($brokenLinks as $link) {
        echo "Source: {$link['source']} -> Target: {$link['target']} ({$link['type']})\n";
    }
}
