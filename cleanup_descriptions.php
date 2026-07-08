<?php
/**
 * Cleanup Descriptions
 * Removes bureaucratic terms like "m.fl." and improves generic descriptions.
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$updatedCount = 0;

$genericStart = "Detaljerad lönestatistik för";

foreach ($data as &$p) {
    if (isset($p['description'])) {
        $original = $p['description'];
        
        // REMOVE "m.fl." from DESCRIPTION
        $p['description'] = str_replace(' m.fl.', '', $p['description']);
        $p['description'] = str_replace(' m.fl', '', $p['description']);
        
        // REMOVE "m.fl." from TITLE
        if (isset($p['title'])) {
            $p['title'] = str_replace(' m.fl.', '', $p['title']);
            $p['title'] = str_replace(' m.fl', '', $p['title']);
            
            // Clean up any double spaces generated
            $p['title'] = trim(preg_replace('/\s+/', ' ', $p['title']));
        }
        
        // REMOVE "m.fl." from DESCRIPTION_EXTENDED
        if (isset($p['description_extended'])) {
            $p['description_extended'] = str_replace(' m.fl.', '', $p['description_extended']);
            $p['description_extended'] = str_replace(' m.fl', '', $p['description_extended']);
        }

        // REMOVE "m.fl." from KEYWORD
        if (isset($p['keyword'])) {
             $p['keyword'] = str_replace(' m.fl.', '', $p['keyword']);
             $p['keyword'] = str_replace(' m.fl', '', $p['keyword']);
        }

        // REMOVE "m.fl." from FAQ
        if (isset($p['faq']) && is_array($p['faq'])) {
            foreach ($p['faq'] as &$qa) {
                if (isset($qa['question'])) {
                    $qa['question'] = str_replace(' m.fl.', '', $qa['question']);
                }
                if (isset($qa['answer'])) {
                    $qa['answer'] = str_replace(' m.fl.', '', $qa['answer']);
                }
            }
        }
        
        // Re-generate description if it still looks generic and relies on title
        // Ensure we sanitize the title in the description too if it was there before
        if (strpos($p['description'], 'Detaljerad lönestatistik för') === 0 || strpos($p['description'], 'Information om lön och karriärmöjligheter för') === 0) {
             $p['description'] = "Här hittar du aktuell lönestatistik för " . $p['title'] . ". Se medellön, lönespridning och räkna ut din nettolön.";
        }

        // Also clean up "Detaljerad lönestatistik för..." in description_extended if it's there
        if (isset($p['description_extended']) && strpos($p['description_extended'], 'Detaljerad lönestatistik för') === 0) {
             $p['description_extended'] = "Vi har sammanställt lönedata från SCB för att ge dig en tydlig bild av löneläget för " . $p['title'] . ". Statistiken omfattar både privat och offentlig sektor.";
        }
        
        if ($original !== $p['description']) {
            $updatedCount++;
            echo "Cleaned: {$p['title']}\n";
        }
    }
}

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "\n✅ Cleaned $updatedCount descriptions.\n";
