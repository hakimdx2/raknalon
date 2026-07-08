<?php

require 'vendor/autoload.php';

echo "Testing JobTech API for 'CNC-operatör'...\n";

$query = urlencode("CNC-operatör");
$url = "https://jobsearch.api.jobtechdev.se/search?q={$query}&limit=3&offset=0";

// Curl options
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'accept: application/json',
    // 'api-key: YOUR_API_KEY_HERE' // Testing if it works without key or with default access
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Status: $httpCode\n";

if ($error) {
    echo "Curl Error: $error\n";
    exit;
}

if ($httpCode === 200) {
    $data = json_decode($response, true);
    echo "Success! Found " . $data['total']['value'] . " jobs.\n\n";

    foreach ($data['hits'] as $hit) {
        echo "--------------------------------------------------\n";
        echo "FULL JOB OBJECT:\n";
        print_r($hit);
        break; // Just check the first one
    }
} else {
    echo "Failed to fetch jobs.\n";
    echo "Response: $response\n";
    echo "\nIf 401/403: You need a valid API key from https://jobtechdev.se/\n";
}
