<?php
// Check for duplicate professions
$data = json_decode(file_get_contents(__DIR__ . '/data/professions.json'), true);
$slugs = [];
$dupes = [];
foreach ($data as $p) {
    $s = $p['slug'];
    if (in_array($s, $slugs)) {
        $dupes[] = $s;
    } else {
        $slugs[] = $s;
    }
}
echo "Total: " . count($data) . ", Unique: " . count($slugs) . ", Doublons: " . count($dupes) . "\n";
foreach ($dupes as $d) {
    echo "- $d\n";
}
