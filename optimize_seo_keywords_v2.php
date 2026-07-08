<?php
/**
 * SEO Keyword Optimization Script V2
 * Generates and adds long-tail FAQ keywords to ALL professions
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);

$updatedCount = 0;
$addedFaqCount = 0;

foreach ($data as &$profession) {
    $title = $profession['title'] ?? '';
    $slug = $profession['slug'] ?? '';
    $avgSalary = $profession['avg_salary'] ?? 0;
    $medianSalary = $profession['median_salary'] ?? $avgSalary;
    $nyexSalary = $profession['nyexaminerad_salary'] ?? round($avgSalary * 0.75);
    $seniorSalary = $profession['senior_salary'] ?? round($avgSalary * 1.25);
    
    if (empty($title) || $avgSalary == 0) continue;
    
    // Calculate net salary estimate (rough: 70-75% of gross)
    $netSalaryLow = round($avgSalary * 0.70 / 100) * 100;
    $netSalaryHigh = round($avgSalary * 0.76 / 100) * 100;
    
    // Initialize FAQ array if not exists
    if (!isset($profession['faq']) || !is_array($profession['faq'])) {
        $profession['faq'] = [];
    }
    
    // Get existing questions to avoid duplicates
    $existingQuestions = [];
    foreach ($profession['faq'] as $qa) {
        $existingQuestions[] = mb_strtolower(trim($qa['question']));
    }
    
    // Generate long-tail FAQs dynamically
    $generatedFaqs = [
        [
            'question' => "Vad tjänar en $title efter skatt?",
            'answer' => "Med en bruttolön på " . number_format($avgSalary, 0, ',', ' ') . " kr får en $title ungefär " . number_format($netSalaryLow, 0, ',', ' ') . "-" . number_format($netSalaryHigh, 0, ',', ' ') . " kr netto efter skatt, beroende på kommun och eventuella avdrag."
        ],
        [
            'question' => "Vad är ingångslön för $title?",
            'answer' => "Nyutexaminerade eller nya inom yrket startar vanligtvis på cirka " . number_format($nyexSalary, 0, ',', ' ') . " kr/mån. Lönen ökar med erfarenhet och specialisering."
        ],
        [
            'question' => "Hur mycket kan en erfaren $title tjäna?",
            'answer' => "Erfarna yrkesutövare med 10+ års erfarenhet kan tjäna upp till " . number_format($seniorSalary, 0, ',', ' ') . " kr/mån eller mer, beroende på arbetsgivare och region."
        ],
        [
            'question' => "Vilken lön har $title i Stockholm?",
            'answer' => "I Stockholm ligger lönerna ofta 5-10% högre än rikssnittet. En $title i Stockholm tjänar i snitt " . number_format(round($avgSalary * 1.07), 0, ',', ' ') . " kr/mån."
        ]
    ];
    
    $faqsAdded = 0;
    foreach ($generatedFaqs as $newFaq) {
        $questionLower = mb_strtolower(trim($newFaq['question']));
        
        // Check for similar questions (avoid duplicates)
        $isDuplicate = false;
        foreach ($existingQuestions as $existing) {
            similar_text($questionLower, $existing, $percent);
            if ($percent > 65) { // Increased sensitivity
                $isDuplicate = true;
                break;
            }
        }
        
        if (!$isDuplicate) {
            $profession['faq'][] = $newFaq;
            $existingQuestions[] = $questionLower;
            $faqsAdded++;
            $addedFaqCount++;
        }
    }
    
    if ($faqsAdded > 0) {
        $updatedCount++;
        echo "✓ $title: +$faqsAdded FAQs\n";
    }
    
    // Enrich description_extended with SEO keywords
    if (isset($profession['description_extended'])) {
        $desc = $profession['description_extended'];
        
        // Add "lön efter skatt" mention if not present
        if (stripos($desc, 'efter skatt') === false && stripos($desc, 'nettolön') === false) {
            $desc = rtrim($desc, '.');
            $desc .= ". Räkna ut din nettolön med vår lönekalkylator.";
            $profession['description_extended'] = $desc;
        }
    }
}

// Save updated JSON
file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n" . str_repeat("=", 50) . "\n";
echo "✅ SEO OPTIMIZATION COMPLETE!\n";
echo "📊 Updated: $updatedCount professions\n";
echo "❓ Added: $addedFaqCount new FAQ entries\n";
echo "💾 Saved to: $jsonFile\n";
