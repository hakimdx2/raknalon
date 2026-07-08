<?php
$file = 'c:/laragon/www/hkmweb/projets/raknalon/data/professions.json';

// Read JSON
$json = file_get_contents($file);
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON Error: " . json_last_error_msg());
}

$start_count = count($data);
$new_data = [];
$removed_count = 0;

foreach ($data as $entry) {
    // Check if it is Psykolog
    if (($entry['slug'] ?? '') === 'psykolog') {
        // Check criteria: Must have history_men in scb
        if (isset($entry['scb']['history_men'])) {
            $new_data[] = $entry;
        } else {
            echo "Removing Psykolog entry without history_men.\n";
            $removed_count++;
        }
    } else {
        $new_data[] = $entry;
    }
}

echo "Start count: $start_count. Removed: $removed_count. End count: " . count($new_data) . ".\n";

if ($removed_count > 0) {
    // Re-encode
    // Use JSON_PRETTY_PRINT and unescaped unicode/slashes to match typical format
    $new_json = json_encode($new_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
    // Backup original
    copy($file, $file . '.bak_fix');
    
    // Write new content
    file_put_contents($file, $new_json);
    echo "File updated successfully.\n";
} else {
    echo "No entries removed. File untouched.\n";
}
?>
