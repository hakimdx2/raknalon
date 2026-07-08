<?php
$data = json_decode(file_get_contents('data/professions.json'), true);
$lakare_entries = [];

foreach ($data as $index => $entry) {
    if (isset($entry['slug']) && $entry['slug'] === 'lakare') {
        $lakare_entries[] = [
            'index' => $index,
            'title' => $entry['title'] ?? 'N/A',
            'avg_salary' => $entry['avg_salary'] ?? 'N/A',
            'has_author' => isset($entry['author']) ? 'YES' : 'NO',
            'has_faq' => isset($entry['faq']) ? count($entry['faq']) . ' FAQs' : 'NO',
            'has_forecast' => isset($entry['forecast']) ? 'YES' : 'NO'
        ];
    }
}

echo "Entrées principales 'lakare' trouvées: " . count($lakare_entries) . "\n\n";
foreach ($lakare_entries as $entry) {
    echo "Index: " . $entry['index'] . "\n";
    echo "  Title: " . $entry['title'] . "\n";
    echo "  Avg Salary: " . $entry['avg_salary'] . "\n";
    echo "  Has Author: " . $entry['has_author'] . "\n";
    echo "  Has FAQ: " . $entry['has_faq'] . "\n";
    echo "  Has Forecast: " . $entry['has_forecast'] . "\n";
    echo "\n";
}
