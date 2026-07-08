<?php
$data = json_decode(file_get_contents('data/professions.json'), true);
$slugs = array_column($data, 'slug');
$counts = array_count_values($slugs);
$dups = array_filter($counts, fn($c) => $c > 1);

if (empty($dups)) {
    echo "✅ Aucun doublon trouvé parmi " . count($slugs) . " entrées!\n";
} else {
    echo "⚠️ Doublons trouvés:\n";
    foreach ($dups as $slug => $count) {
        echo "  - $slug: $count fois\n";
    }
}

echo "\nTotal entrées: " . count($data) . "\n";
echo "Slugs uniques: " . count(array_unique($slugs)) . "\n";
