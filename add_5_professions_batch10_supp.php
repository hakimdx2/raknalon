<?php
/**
 * Batch 10 Supplement: Add Bagare to reach 165
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. Bagare
    [
        "category" => "Restaurang & Hotell",
        "slug" => "bagare",
        "title" => "Bagare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "bagare lön",
        "avg_salary" => 29500,
        "median_salary" => 29000,
        "description" => "En bagare bakar bröd, bullar och kaffebröd på bageri, konditori eller i industribageri.",
        "description_extended" => "Arbetet startar ofta tidigt på morgonen (eller natt). Kräver känsla för råvaror och fysisk uthållighet.",
        "education" => "Restaurang- och livsmedelsprogrammet (Inriktning bageri).",
        "salary_by_sector" => ["privat" => 29500],
        "pros" => ["Skapande", "Doft av nybakat", "Tidiga dagar (slutar tidigt)", "Hantverk"],
        "cons" => ["Mycket tidiga morgnar", "Fysiskt tungt (lyft)", "Helgjobb", "Mjöldamm"],
        "faq" => [
            ["question" => "Vad tjänar en bagare?", "answer" => "Snittlönen är ca 29 500 kr. OB-tillägg för nattarbete tillkommer ofta."],
            ["question" => "Vad är skillnaden mot konditor?", "answer" => "Bagaren gör matbröd och vetebröd, konditorn gör tårtor, bakelser och praliner."],
            ["question" => "Måste man gå upp tidigt?", "answer" => "Ja, oftast börjar man 03:00 eller 04:00 för att brödet ska vara färskt till öppning."],
            ["question" => "Är det svårt att få jobb?", "answer" => "Det finns ett konstant behov av duktiga bagare."],
            ["question" => "Kan man starta eget?", "answer" => "Ja, många drömmer om att öppna eget surdegsbageri."]
        ],
        "kd" => 13, "volume" => 320,
        "scb" => [
            "ssyk_code" => "7511", "year" => 2024,
            "salary_total" => 29500, "salary_men" => 30000, "salary_women" => 29000,
            "gender_gap_percent" => 96.6, "evolution_10y_percent" => 21,
            "history" => ["2014" => 24000, "2015" => 24800, "2016" => 25500, "2017" => 26200, "2018" => 27000, "2019" => 27800, "2020" => 28200, "2021" => 28800, "2022" => 29200, "2023" => 29400, "2024" => 29500],
            "history_men" => ["2014" => 24500, "2015" => 25200, "2016" => 26000, "2017" => 26800, "2018" => 27500, "2019" => 28200, "2020" => 28800, "2021" => 29200, "2022" => 29800, "2023" => 30000, "2024" => 30000],
            "history_women" => ["2014" => 23500, "2015" => 24200, "2016" => 25000, "2017" => 25800, "2018" => 26500, "2019" => 27200, "2020" => 27800, "2021" => 28200, "2022" => 28800, "2023" => 29000, "2024" => 29000],
            "percentiles" => ["p10" => 24000, "p25" => 26000, "p50" => 29000, "p75" => 32000, "p90" => 35000],
            "salary_by_age" => ["18-24" => 23000, "25-34" => 28000, "35-44" => 30000, "45-54" => 30500, "55-64" => 30000, "65+" => 25000]
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
