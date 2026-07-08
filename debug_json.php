<?php
// Debug: Test if we can write to the JSON file

$jsonFile = __DIR__ . '/data/professions.json';
$content = file_get_contents($jsonFile);
$data = json_decode($content, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON decode error: " . json_last_error_msg());
}

echo "Read " . count($data) . " professions\n";
echo "First profession: " . $data[0]['title'] . "\n";

// Add meta_description to first profession
$data[0]['meta_description'] = "IT-arkitekt lön 2026: 62 000 kr ✓ | Högavlönat yrke! Nettolön 43 400 kr. Se lönestatistik & karriärvägar →";

echo "Added meta_description to first profession\n";

// Try to encode back
$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON encode error: " . json_last_error_msg());
}

echo "JSON encoded successfully, size: " . strlen($json) . " bytes\n";

// Write to file
$written = file_put_contents($jsonFile, $json);

if ($written === false) {
    die("Failed to write to file!");
}

echo "Written $written bytes to file\n";
echo "SUCCESS!\n";

// Verify
$verify = json_decode(file_get_contents($jsonFile), true);
echo "Verify meta_description: " . ($verify[0]['meta_description'] ?? 'NOT FOUND') . "\n";
