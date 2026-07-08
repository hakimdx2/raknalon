<?php

$jsonFile = __DIR__ . '/data/professions.json';
$mdFile = __DIR__ . '/ressources/metiers_analyse.md';

if (!file_exists($jsonFile)) {
    die("Error: professions.json not found.\n");
}
if (!file_exists($mdFile)) {
    die("Error: metiers_analyse.md not found.\n");
}

// 1. Load Professions
$jsonData = json_decode(file_get_contents($jsonFile), true);
$existingProfessions = [];
foreach ($jsonData as $item) {
    if (isset($item['title'])) {
        $cleanTitle = mb_strtolower(trim($item['title']));
        $existingProfessions[$cleanTitle] = true;
    }
}
$totalJsonCount = count($existingProfessions);
echo "Loaded " . $totalJsonCount . " professions from JSON.\n";

// 2. Read MD File
$mdContent = file_get_contents($mdFile);
$lines = explode("\n", $mdContent);
$newLines = [];
$updatedCount = 0;

$mappings = [
    'civilingenjör' => 'civilingenjörsyrken',
    'it tekniker' => 'it-tekniker',
    'account manager' => 'account manager',
    'hr specialist' => 'hr-specialist',
    'mäklare' => 'fastighetsmäklare',
    'ux designer' => 'ux-designer',
    'servitris' => 'servitor',
    // Add exact matches if needed.
];

function isProfessionExists($name, $existingProfessions, $mappings) {
    if (empty($name)) return false;
    
    // Cleanup name for check (remove strikethrough if checking existing lines)
    $name = str_replace('~~', '', $name);
    
    $cleanName = mb_strtolower(trim($name));
    
    // Check mappings
    if (isset($mappings[$cleanName])) {
        $checkThis = $mappings[$cleanName];
    } else {
        $checkThis = $cleanName;
    }

    if (isset($existingProfessions[$checkThis])) {
        return true;
    }
    
    // Heuristic check
    foreach (array_keys($existingProfessions) as $pParams) {
        if ($pParams === $checkThis || strpos($pParams, $checkThis) === 0) {
            return true;
        }
    }
    return false;
}

foreach ($lines as $line) {
    $newLine = $line;

    // Type 1: Main analysis table | [ ] | ... | Name | ...
    if (preg_match('/^\|\s*(\[ \]|✅)\s*\|(?:\s*(?:\d+)?\s*\|)?\s*([^|]+)\s*\|/', $line, $matches)) {
        $currentStatus = trim($matches[1]);
        $rawName = trim($matches[2]);
        
        // Extract name before parenthesis
        $nameParts = explode('(', $rawName);
        $nameToCheck = trim($nameParts[0]);

        if (isProfessionExists($nameToCheck, $existingProfessions, $mappings)) {
            if ($currentStatus === '[ ]') {
                $newLine = preg_replace('/^(\|\s*)\[ \]/', '$1✅', $newLine, 1);
            }
        }
    }
    
    // Type 2: Priority tables | Name | ... | Status |
    // Regex: | Name | Volume | KD | ...
    // Verify it's a table row but NOT the header (contains ----)
    elseif (strpos($line, '|') !== false && strpos($line, '---') === false && !preg_match('/^\|\s*(\[ \]|✅)/', $line)) {
        // Try to parse generic table row
        $cols = array_map('trim', explode('|', trim($line, '|')));
        if (count($cols) >= 3) {
            $nameCol = $cols[0];
            // Check if already struck through
            $isStruck = (strpos($nameCol, '~~') === 0);
            $cleanName = str_replace('~~', '', $nameCol);
            
            if (isProfessionExists($cleanName, $existingProfessions, $mappings)) {
                if (!$isStruck) {
                    // Strikethrough the name
                    $newLine = str_replace($cleanName, "~~$cleanName~~", $newLine);
                    
                    // Update the Status/Priority column to "✅ Ajouté"
                    // Assuming Status is last column or we just replace the content
                    // Let's replace the last column content if it matches typical status
                    $newLine = preg_replace('/\|\s*(🔴 Haute|🟠 Moyenne|À ajouter)\s*\|$/', '| ✅ Ajouté |', $newLine);
                    $updatedCount++;
                }
            }
        }
    }

    $newLines[] = $newLine;
}

// Rebuild content
$newContent = implode("\n", $newLines);

// Update global stats
// - **Métiers sur le site**: 38 ✅
$newContent = preg_replace_callback('/\- \*\*Métiers sur le site\*\*: \d+ ✅?/', function($m) use ($totalJsonCount) {
    return "- **Métiers sur le site**: $totalJsonCount ✅";
}, $newContent);

file_put_contents($mdFile, $newContent);
echo "Analysis updated. Total professions on site: $totalJsonCount.\n";

?>
