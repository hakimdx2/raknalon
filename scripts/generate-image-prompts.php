<?php
/**
 * Generate CSV files with image prompts for Nano Banana
 * Creates batches of 50 prompts per file
 * Style: Scandinavian minimalist workplace environment
 */

$jsonPath = 'C:/laragon/www/hkmweb/projets/raknalon/data/professions.json';
$outputDir = 'C:/laragon/www/hkmweb/projets/raknalon/ressources/image-prompts';

// Create output directory
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

// Load professions
$professions = json_decode(file_get_contents($jsonPath), true);

echo "📊 " . count($professions) . " professions trouvées\n\n";

// Image variations for each profession
$imageTypes = [
    1 => 'workspace with typical tools and equipment',
    2 => 'environment or location where they work',
    3 => 'abstract representation of daily tasks and responsibilities'
];

// Generate prompts (3 per profession)
$prompts = [];
foreach ($professions as $p) {
    $title = $p['title'];
    $slug = $p['slug'];
    
    foreach ($imageTypes as $num => $variation) {
        $prompt = "Modern Swedish workplace environment for {$title}. " .
                  "Clean, bright setting with soft natural lighting. " .
                  "Abstract representation of {$variation}. " .
                  "Scandinavian minimalist design aesthetic. " .
                  "Blue and white color palette. No people, no faces. " .
                  "Professional atmosphere. High quality, suitable for career website illustration.";
        
        $prompts[] = [
            'slug' => $slug,
            'title' => $title,
            'image_num' => $num,
            'filename' => "{$slug}-{$num}.webp",
            'prompt' => $prompt
        ];
    }
}

// Split into batches of 50
$batches = array_chunk($prompts, 50);

echo "📁 Création de " . count($batches) . " fichiers CSV (" . count($prompts) . " prompts total)...\n\n";

foreach ($batches as $i => $batch) {
    $batchNum = $i + 1;
    $filename = "{$outputDir}/prompts-batch-{$batchNum}.csv";
    
    $fp = fopen($filename, 'w');
    
    // CSV Header
    fputcsv($fp, ['slug', 'title', 'image_num', 'filename', 'prompt']);
    
    // Data rows
    foreach ($batch as $row) {
        fputcsv($fp, $row);
    }
    
    fclose($fp);
    
    $start = ($i * 50) + 1;
    $end = min(($i + 1) * 50, count($prompts));
    echo "✅ Batch {$batchNum}: prompts {$start}-{$end}\n";
}

echo "\n🎉 Terminé! " . count($prompts) . " prompts générés (3 par profession)\n";
echo "📂 Fichiers dans: {$outputDir}\n";
