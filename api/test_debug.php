<?php
// Mock environment for CLI testing
$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

// Mock input data
$mockData = json_encode([
    'email' => 'test_cli@raknalon.se',
    'variant_id' => 'cli_test',
    'url' => '/cli-test'
]);

// Override file_get_contents to return mock data when reading php://input
// Note: This is tricky in plain PHP. Instead, we can modify subscribe.php to accept input from a variable or just test the logic directly here.

// Let's just reproduce the logic 1:1 to see if it fails.

$dataFile = __DIR__ . '/../protected/subscribers.json';
echo "Target File: " . $dataFile . "\n";
echo "Exists? " . (file_exists($dataFile) ? 'Yes' : 'No') . "\n";
echo "Writable? " . (is_writable($dataFile) ? 'Yes' : 'No') . "\n";
echo "Dir Writable? " . (is_writable(dirname($dataFile)) ? 'Yes' : 'No') . "\n";

$data = json_decode($mockData, true);

$entry = [
    'id' => uniqid('sub_', true),
    'email' => htmlspecialchars($data['email']),
    'variant_id' => $data['variant_id'],
    'url' => $data['url'],
    'date' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR']
];

$currentData = [];
if (file_exists($dataFile)) {
    $content = file_get_contents($dataFile);
    if (!empty($content)) {
        $currentData = json_decode($content, true);
        if ($currentData === null) {
            echo "JSON Decode Error: " . json_last_error_msg() . "\n";
        }
    }
}

$currentData[] = $entry;

$result = file_put_contents($dataFile, json_encode($currentData, JSON_PRETTY_PRINT));

if ($result === false) {
    echo "ERROR: file_put_contents failed!\n";
    print_r(error_get_last());
} else {
    echo "SUCCESS: Wrote $result bytes.\n";
}
