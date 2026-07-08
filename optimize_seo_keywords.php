<?php
/**
 * SEO Keyword Optimization Script
 * Enriches profession FAQs with long-tail keywords from CSV analysis
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);

// Long-tail FAQ templates by profession slug
$longTailFAQs = [
    'sjukskoterska' => [
        [
            'question' => 'Vad tjänar en sjuksköterska efter skatt?',
            'answer' => 'En sjuksköterska med medellön på 41 500 kr får ungefär 31 000-33 000 kr netto efter skatt, beroende på kommun. Använd vår lönekalkylator för exakt beräkning.'
        ],
        [
            'question' => 'Hur mycket tjänar en bemanningssjuksköterska?',
            'answer' => 'Bemanningssjuksköterskor tjänar ofta 20-40% mer än fast anställda, med löner på 50 000-70 000 kr/mån beroende på uppdrag och region.'
        ],
        [
            'question' => 'Vad tjänar en sjuksköterska i Norge?',
            'answer' => 'I Norge ligger sjuksköterskelönen på 50 000-60 000 NOK/mån (ca 50 000-60 000 SEK), vilket är betydligt högre än i Sverige.'
        ],
        [
            'question' => 'Vad är ingångslön för nyexaminerad sjuksköterska?',
            'answer' => 'Nyexaminerade sjuksköterskor startar vanligtvis på 32 000-35 000 kr/mån. Lönen ökar snabbt under de första åren.'
        ],
        [
            'question' => 'Vad är sjuksköterska lön 2024?',
            'answer' => 'Medellönen för sjuksköterskor 2024 ligger på cirka 41 500 kr/mån enligt SCB. Specialistsjuksköterskor tjänar i snitt 46 000-50 000 kr.'
        ]
    ],
    'underskoterska' => [
        [
            'question' => 'Vad är undersköterska lön 2024?',
            'answer' => 'Medellönen för undersköterskor 2024 är cirka 31 500 kr/mån. Specialistundersköterskor kan tjäna 34 000-36 000 kr.'
        ],
        [
            'question' => 'Hur mycket tjänar en specialistundersköterska?',
            'answer' => 'En specialistundersköterska med vidareutbildning tjänar ofta 2 000-4 000 kr mer per månad, alltså 33 000-35 000 kr.'
        ],
        [
            'question' => 'Vad är lön för undersköterska på äldreboende?',
            'answer' => 'Undersköterskor på äldreboende tjänar i snitt 30 500-32 000 kr/mån. Kommunalt anställda har ofta något lägre lön än privata.'
        ],
        [
            'question' => 'Vad tjänar en undersköterska efter skatt?',
            'answer' => 'Med en bruttolön på 31 500 kr får en undersköterska ungefär 24 000-25 500 kr netto efter skatt.'
        ],
        [
            'question' => 'Kan man jobba som undersköterska i Norge?',
            'answer' => 'Ja, i Norge kallas yrket helsefagarbeider och lönen ligger ofta 30-40% högre än i Sverige, runt 35 000-42 000 NOK/mån.'
        ]
    ],
    'elektriker' => [
        [
            'question' => 'Vad tjänar en elektriker efter skatt?',
            'answer' => 'En elektriker med medellön på 39 000 kr får ca 29 000-30 500 kr netto efter skatt beroende på kommun.'
        ],
        [
            'question' => 'Vad är lärlingslön för elektriker?',
            'answer' => 'Elektriker lärlingar tjänar ofta 60-80% av fullbetald lön, vilket blir ungefär 23 000-31 000 kr/mån.'
        ],
        [
            'question' => 'Vad tjänar en fullbetald elektriker?',
            'answer' => 'En fullbetald elektriker med gesällbrev tjänar i snitt 38 000-42 000 kr/mån. Erfarna elektriker kan nå 45 000-50 000 kr.'
        ],
        [
            'question' => 'Hur mycket tjänar en elektriker i Stockholm?',
            'answer' => 'I Stockholm ligger elektrikerlönerna 5-10% högre än rikssnittet, ofta 41 000-45 000 kr/mån för erfarna.'
        ]
    ],
    'polis' => [
        [
            'question' => 'Vad är polis lön 2024?',
            'answer' => 'Polislönen 2024 ligger på ca 38 000-42 000 kr/mån för erfarna poliser. Ingångslönen är cirka 32 000 kr.'
        ],
        [
            'question' => 'Vad är ingångslön för polis?',
            'answer' => 'Nyutexaminerade poliser startar på cirka 31 500-33 000 kr/mån. Lönen ökar snabbt efter några års erfarenhet.'
        ],
        [
            'question' => 'Vad tjänar en polis efter 10 år?',
            'answer' => 'Efter 10 års erfarenhet tjänar de flesta poliser 42 000-48 000 kr/mån, beroende på specialisering och region.'
        ]
    ],
    'lakare' => [
        [
            'question' => 'Vad tjänar en läkare efter skatt?',
            'answer' => 'Med en medellön på 79 300 kr får en läkare ungefär 50 000-55 000 kr netto efter skatt.'
        ],
        [
            'question' => 'Vad är ingångslön för läkare?',
            'answer' => 'AT-läkare startar på cirka 42 000-45 000 kr/mån. ST-läkare tjänar 48 000-55 000 kr.'
        ],
        [
            'question' => 'Hur mycket tjänar en överläkare?',
            'answer' => 'Överläkare är bland de bäst betalda inom vården med löner på 85 000-120 000 kr/mån.'
        ]
    ],
    'lokforare' => [
        [
            'question' => 'Vad tjänar en lokförare efter skatt?',
            'answer' => 'Med medellön på 43 500 kr får en lokförare ca 32 000-34 000 kr netto efter skatt.'
        ],
        [
            'question' => 'Hur blir man lokförare?',
            'answer' => 'Lokförarutbildningen är ca 44 veckor och ges av trafikbolagen. Krav: Körkort B, god hälsa och syntest.'
        ]
    ],
    'forskollarare' => [
        [
            'question' => 'Vad är förskollärare lön 2024?',
            'answer' => 'Medellönen för förskollärare 2024 är cirka 37 500 kr/mån. Erfarna förskollärare når 40 000-42 000 kr.'
        ],
        [
            'question' => 'Hur mycket tjänar en förskollärare efter skatt?',
            'answer' => 'Med bruttolön på 37 500 kr får en förskollärare ca 28 000-29 500 kr netto efter skatt.'
        ]
    ],
    'socionom' => [
        [
            'question' => 'Vad är socionom lön 2024?',
            'answer' => 'Medellönen för socionomer 2024 ligger på cirka 40 000-43 000 kr/mån. Handläggare inom socialtjänsten kan tjäna mer.'
        ],
        [
            'question' => 'Vad jobbar en socionom med?',
            'answer' => 'Socionomer arbetar med socialt arbete på kommuner, myndigheter, behandlingshem eller inom HR. Vanliga titlar är socialsekreterare, kurator och behandlingsassistent.'
        ]
    ],
    'lastbilschauffor' => [
        [
            'question' => 'Vad är lastbilschaufför lön 2024?',
            'answer' => 'Medellönen för lastbilschaufförer 2024 är cirka 33 500 kr/mån. Långtradarchaufförer tjänar ofta 36 000-40 000 kr.'
        ],
        [
            'question' => 'Hur mycket tjänar en lastbilschaufför som kör internationellt?',
            'answer' => 'Internationella lastbilschaufförer kan tjäna 40 000-50 000 kr/mån med traktamenten och OB-tillägg.'
        ]
    ],
    'psykolog' => [
        [
            'question' => 'Vad tjänar en psykolog efter skatt?',
            'answer' => 'Med medellön på 48 000 kr får en psykolog ca 35 000-37 000 kr netto efter skatt.'
        ],
        [
            'question' => 'Vad är ingångslön för psykolog?',
            'answer' => 'Nylegitimerade psykologer startar på cirka 38 000-42 000 kr/mån. PTP-psykologer tjänar något mindre.'
        ]
    ]
];

$updatedCount = 0;

foreach ($data as &$profession) {
    $slug = $profession['slug'] ?? '';
    
    if (isset($longTailFAQs[$slug])) {
        $existingQuestions = [];
        if (isset($profession['faq']) && is_array($profession['faq'])) {
            foreach ($profession['faq'] as $qa) {
                $existingQuestions[] = mb_strtolower(trim($qa['question']));
            }
        } else {
            $profession['faq'] = [];
        }
        
        foreach ($longTailFAQs[$slug] as $newFaq) {
            $questionLower = mb_strtolower(trim($newFaq['question']));
            // Check for similar questions (avoid duplicates)
            $isDuplicate = false;
            foreach ($existingQuestions as $existing) {
                similar_text($questionLower, $existing, $percent);
                if ($percent > 70) {
                    $isDuplicate = true;
                    break;
                }
            }
            
            if (!$isDuplicate) {
                $profession['faq'][] = $newFaq;
                echo "Added FAQ to {$profession['title']}: {$newFaq['question']}\n";
            }
        }
        $updatedCount++;
    }
    
    // Enrich description_extended with SEO keywords if generic
    if (isset($profession['description_extended'])) {
        $desc = $profession['description_extended'];
        $title = $profession['title'];
        
        // Add "lön efter skatt" mention if not present
        if (stripos($desc, 'efter skatt') === false && stripos($desc, 'nettolön') === false) {
            $desc = rtrim($desc, '.');
            $desc .= ". Använd vår lönekalkylator för att räkna ut din lön efter skatt.";
            $profession['description_extended'] = $desc;
        }
    }
}

// Save updated JSON
file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n✅ SEO Optimization Complete!\n";
echo "Updated FAQs for $updatedCount professions.\n";
echo "JSON saved to: $jsonFile\n";
