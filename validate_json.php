<?php
$file = 'c:/laragon/www/hkmweb/projets/raknalon/data/professions.json';
if (!file_exists($file)) {
    die("File not found: $file");
}
$json = file_get_contents($file);
$data = json_decode($json, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON Error: " . json_last_error_msg() . "\n";
    // Try to find the position
    echo "Error code: " . json_last_error() . "\n";
} else {
    echo "JSON is Valid.\n";
    $found = false;
    foreach ($data as $p) {
        if ($p['slug'] === 'psykolog') {
             $found = true;
             echo "Found Psykolog.\n";
             if (isset($p['scb']['history_men'])) {
                 echo "history_men found. Count: " . count($p['scb']['history_men']) . "\n";
                 print_r($p['scb']['history_men']);
             } else {
                 echo "history_men MISSING in Psykolog scb.\n";
             }
             
             echo "SCB Keys: " . implode(', ', array_keys($p['scb'])) . "\n";
        }
    }
    if (!$found) echo "Psykolog not found in JSON.\n";
}
?>
