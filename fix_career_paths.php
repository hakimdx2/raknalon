<?php
$data = json_decode(file_get_contents('data/professions.json'), true);

// Find läkare entry and fix career_paths
foreach ($data as $i => &$entry) {
    if (isset($entry['slug']) && $entry['slug'] === 'lakare') {
        echo "Found läkare at index $i\n";
        
        // Update career_paths to match template format
        if (isset($entry['career_paths'])) {
            $fixedPaths = [];
            foreach ($entry['career_paths'] as $path) {
                $fixedPaths[] = [
                    "path" => $path['title'] ?? '',
                    "salary" => isset($path['new_salary']) ? number_format($path['new_salary'], 0, ',', ' ') . " kr/mån" : '',
                    "desc" => $path['description'] ?? ''
                ];
            }
            $entry['career_paths'] = $fixedPaths;
            echo "Fixed " . count($fixedPaths) . " career paths\n";
        }
        break;
    }
}

// Find psykolog entry and fix career_paths
foreach ($data as $i => &$entry) {
    if (isset($entry['slug']) && $entry['slug'] === 'psykolog') {
        echo "Found psykolog at index $i\n";
        
        if (isset($entry['career_paths'])) {
            $fixedPaths = [];
            foreach ($entry['career_paths'] as $path) {
                $fixedPaths[] = [
                    "path" => $path['title'] ?? '',
                    "salary" => isset($path['new_salary']) ? number_format($path['new_salary'], 0, ',', ' ') . " kr/mån" : '',
                    "desc" => $path['description'] ?? ''
                ];
            }
            $entry['career_paths'] = $fixedPaths;
            echo "Fixed " . count($fixedPaths) . " career paths\n";
        }
        break;
    }
}

// Find cnc-operator entry and fix career_paths
foreach ($data as $i => &$entry) {
    if (isset($entry['slug']) && $entry['slug'] === 'cnc-operator') {
        echo "Found cnc-operator at index $i\n";
        
        if (isset($entry['career_paths'])) {
            $fixedPaths = [];
            foreach ($entry['career_paths'] as $path) {
                $fixedPaths[] = [
                    "path" => $path['title'] ?? '',
                    "salary" => isset($path['new_salary']) ? number_format($path['new_salary'], 0, ',', ' ') . " kr/mån" : '',
                    "desc" => $path['description'] ?? ''
                ];
            }
            $entry['career_paths'] = $fixedPaths;
            echo "Fixed " . count($fixedPaths) . " career paths\n";
        }
        break;
    }
}

// Save
$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('data/professions.json', $json);

echo "✅ All career_paths fixed!\n";
