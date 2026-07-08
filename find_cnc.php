<?php
$data = json_decode(file_get_contents('data/professions.json'), true);
foreach ($data as $i => $e) {
    if (isset($e['slug']) && strpos($e['slug'], 'cnc') !== false) {
        echo "Index $i: {$e['slug']} - {$e['title']}\n";
    }
}
echo "Total entries: " . count($data) . "\n";
