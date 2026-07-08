<?php
$data = json_decode(file_get_contents('data/professions.json'), true);

// Find and remove the old psykolog entry without author
$removed = false;
foreach ($data as $index => $entry) {
    if (isset($entry['slug']) && $entry['slug'] === 'psykolog' && !isset($entry['author'])) {
        echo "Removing old psykolog entry at index $index (avg_salary: {$entry['avg_salary']})\n";
        unset($data[$index]);
        $removed = true;
        break;
    }
}

if ($removed) {
    // Reindex array
    $data = array_values($data);
    
    // Save back
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    file_put_contents('data/professions.json', $json);
    echo "✅ Done! Removed old entry. New total: " . count($data) . " entries.\n";
} else {
    echo "❌ Old entry not found.\n";
}
