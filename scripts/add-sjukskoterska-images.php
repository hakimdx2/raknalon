<?php
$json = file_get_contents('data/professions.json');
$data = json_decode($json, true);

foreach($data as $i => $p) {
    if(isset($p['slug']) && $p['slug'] === 'sjukskoterska') {
        echo "Index: $i\n";
        echo "Title: " . $p['title'] . "\n";
        echo "Category: " . ($p['category'] ?? 'N/A') . "\n";
        
        // Add content_images
        $data[$i]['content_images'] = [
            [
                'src' => '/img/professions/sjukskoterska/sjukskoterska-1.png',
                'alt' => 'Sjuksköterska arbetsplats med medicinsk utrustning',
                'caption' => 'Typisk arbetsstation för sjuksköterskor'
            ],
            [
                'src' => '/img/professions/sjukskoterska/sjukskoterska-2.png',
                'alt' => 'Modern sjukhusmiljö i Sverige',
                'caption' => 'Sjukhusmiljö med vårdstation'
            ],
            [
                'src' => '/img/professions/sjukskoterska/sjukskoterska-3.png',
                'alt' => 'Sjuksköterska dagliga uppgifter och ansvar',
                'caption' => 'Dagliga arbetsuppgifter'
            ]
        ];
        
        break;
    }
}

// Save updated JSON
file_put_contents('data/professions.json', json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n✅ content_images ajouté pour sjukskoterska!\n";
