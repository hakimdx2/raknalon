<?php
/**
 * Batch 6 Supplement: Add 1 more profession because Controller existed
 * Target: HR-specialist
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. HR-specialist
    [
        "category" => "Administration",
        "slug" => "hr-specialist",
        "title" => "HR-specialist",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "hr specialist lön",
        "avg_salary" => 44000,
        "median_salary" => 43500,
        "description" => "En HR-specialist arbetar med personalfrågor som rekrytering, arbetsmiljö, kompetensutveckling och arbetsrätt.",
        "description_extended" => "HR-specialister stöttar chefer och medarbetare. Rollen kan vara bred (generalist) eller smal (t.ex. inriktad på rehabilitering eller förhandling).",
        "education" => "Personalvetarprogrammet (3 år) eller liknande högskoleutbildning.",
        "salary_by_sector" => ["privat" => 45000, "offentlig" => 43000],
        "pros" => ["Arbeta med människor", "Strategiskt viktigt", "Varierande arbetsuppgifter", "Möjlighet att påverka"],
        "cons" => ["Svåra samtal", "Kan vara administrativt tungt", "Fungera som buffert", "Tydlig lagstyrning"],
        "faq" => [
            ["question" => "Vad tjänar en HR-specialist?", "answer" => "Genomsnittslönen är ca 44 000 kr per månad."],
            ["question" => "Vad gör en HR-specialist?", "answer" => "Hanterar rekrytering, anställningsavtal, arbetsmiljöfrågor och fackliga förhandlingar."],
            ["question" => "Vilken utbildning krävs?", "answer" => "Treårig högskoleutbildning inom personal och arbetsliv (PA-programmet)."],
            ["question" => "Är det svårt att få jobb?", "answer" => "Konkurrensen kan vara hård om juniora tjänster, men erfarna specialister efterfrågas."],
            ["question" => "Vad är skillnaden på HR-specialist och HR-administratör?", "answer" => "Specialisten arbetar mer konsultativt och strategiskt, administratören mer operativt med löpande uppgifter."]
        ],
        "kd" => 16, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "2423", "year" => 2024,
            "salary_total" => 44000, "salary_men" => 46000, "salary_women" => 43500,
            "gender_gap_percent" => 94.6, "evolution_10y_percent" => 30,
            "history" => ["2014" => 33800, "2015" => 34800, "2016" => 36000, "2017" => 37500, "2018" => 38800, "2019" => 40000, "2020" => 41000, "2021" => 42000, "2022" => 43000, "2023" => 43600, "2024" => 44000],
            "history_men" => ["2014" => 36000, "2015" => 37000, "2016" => 38000, "2017" => 39500, "2018" => 41000, "2019" => 42000, "2020" => 43000, "2021" => 44000, "2022" => 45000, "2023" => 45500, "2024" => 46000],
            "history_women" => ["2014" => 33000, "2015" => 34000, "2016" => 35200, "2017" => 36800, "2018" => 38000, "2019" => 39200, "2020" => 40200, "2021" => 41200, "2022" => 42200, "2023" => 42800, "2024" => 43500],
            "percentiles" => ["p10" => 35000, "p25" => 39000, "p50" => 44000, "p75" => 49000, "p90" => 55000],
            "salary_by_age" => ["18-24" => 32000, "25-34" => 39000, "35-44" => 45000, "45-54" => 47000, "55-64" => 46000, "65+" => 42000]
        ]
    ]
];

$addedCount = 0;
foreach ($newProfessions as $profession) {
    if (!in_array($profession['slug'], $existingSlugs)) {
        $data[] = $profession;
        $addedCount++;
        echo "Added: {$profession['title']}\n";
    } else {
        echo "Skipped (exists): {$profession['title']}\n";
    }
}

if ($addedCount > 0) {
    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    echo "\n✅ Added $addedCount new professions. Total now: " . count($data) . "\n";
} else {
    echo "\n⚠️ No new professions added.\n";
}
