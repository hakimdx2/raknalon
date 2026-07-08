<?php
/**
 * Generate CTR-Optimized Meta Descriptions for all professions
 * Pattern: [Yrke] lön 2026: [SALARY] kr ✓ | Nettolön X, ingångslön & Stockholm. Se statistik →
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);

// Calculate net salary (approximate Swedish tax ~32%)
function calculateNet($gross) {
    if ($gross <= 0) return 0;
    $tax = $gross * 0.32;
    if ($gross > 45000) {
        $tax += ($gross - 45000) * 0.20;
    }
    return round($gross - $tax);
}

// Format number with space separator
function formatSalary($n) {
    return number_format($n, 0, ',', ' ');
}

$updatedCount = 0;

foreach ($data as &$profession) {
    $title = $profession['title'] ?? 'Okänt yrke';
    $avgSalary = $profession['avg_salary'] ?? 35000;
    $netSalary = calculateNet($avgSalary);
    $entrySalary = round($avgSalary * 0.75);
    $stockholmSalary = round($avgSalary * 1.07);
    
    // Get category for variety
    $category = $profession['category'] ?? '';
    
    // Generate different meta description patterns based on salary level
    if ($avgSalary >= 60000) {
        // High salary professions - emphasize high earnings
        $meta = "{$title} lön 2026: " . formatSalary($avgSalary) . " kr ✓ | Högavlönat yrke! Nettolön " . formatSalary($netSalary) . " kr. Se lönestatistik & karriärvägar →";
    } elseif ($avgSalary >= 45000) {
        // Medium-high salary
        $meta = "{$title} lön 2026: " . formatSalary($avgSalary) . " kr ✓ | Nettolön " . formatSalary($netSalary) . " kr, erfaren upp till " . formatSalary(round($avgSalary * 1.25)) . " kr. Jämför löner →";
    } elseif ($avgSalary >= 35000) {
        // Medium salary
        $meta = "{$title} lön 2026: " . formatSalary($avgSalary) . " kr ✓ | Nettolön " . formatSalary($netSalary) . " kr. Ingångslön, Stockholm & mer. Se statistik →";
    } else {
        // Entry-level salary
        $meta = "{$title} lön 2026: " . formatSalary($avgSalary) . " kr ✓ | Nettolön " . formatSalary($netSalary) . " kr efter skatt. Karriärtips & löneförhandling →";
    }
    
    // Ensure max 160 characters
    if (strlen($meta) > 160) {
        $meta = substr($meta, 0, 157) . "...";
    }
    
    // Add/update meta_description field
    $profession['meta_description'] = $meta;
    
    echo "✅ {$title}: " . strlen($meta) . " chars\n";
    $updatedCount++;
}

// Save updated JSON
file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n" . str_repeat("=", 60) . "\n";
echo "✅ META DESCRIPTIONS GENERATED!\n";
echo "📊 Total professions updated: $updatedCount\n";
echo "💾 Saved to: $jsonFile\n";

// Show some examples
echo "\n=== EXAMPLES ===\n";
$examples = array_slice($data, 0, 5);
foreach ($examples as $p) {
    echo "\n🏷️ {$p['title']}:\n";
    echo "   {$p['meta_description']}\n";
}
