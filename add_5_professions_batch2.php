<?php
/**
 * Script to add 5 more professions to professions.json
 * Target: Administratör, Biomedicinsk analytiker, Flygledare, Fysioterapeut, Flygvärdinna
 */

$jsonFile = __DIR__ . '/data/professions.json';

$data = json_decode(file_get_contents($jsonFile), true);
if (!$data) {
    die("Error loading professions.json\n");
}

$existingSlugs = [];
foreach ($data as $p) {
    $existingSlugs[$p['slug']] = true;
}

$newProfessions = [
    // 1. Administratör
    [
        "category" => "Administration",
        "slug" => "administrator",
        "title" => "Administratör",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "administratör lön",
        "avg_salary" => 33500,
        "median_salary" => 33000,
        "description" => "En administratör hanterar administrativa uppgifter såsom dokumenthantering, schemaläggning, kundkontakt och kontorstjänster. Rollen finns inom alla branscher.",
        "description_extended" => "Administratörer är generalister som kan arbeta inom offentlig förvaltning, privata företag eller ideell sektor. Arbetsuppgifterna varierar men inkluderar ofta ärendehantering, protokollföring och intern kommunikation.",
        "education" => "Gymnasieutbildning krävs, högskoleutbildning inom administration eller liknande meriterande.",
        "salary_by_sector" => ["privat" => 34500, "offentlig" => 32500],
        "pros" => ["Varierat arbete", "Möjlighet till distansarbete", "Trygga arbetstider", "Efterfrågad kompetens"],
        "cons" => ["Repetitiva uppgifter", "Låg löneutveckling", "Ofta stressigt vid deadlines", "Begränsad karriärstege"],
        "faq" => [
            ["question" => "Vad tjänar en administratör?", "answer" => "En administratör tjänar i genomsnitt 33 500 kr per månad. Lönen varierar beroende på bransch och erfarenhet."],
            ["question" => "Vad gör en administratör?", "answer" => "En administratör hanterar dokument, bokar möten, svarar på mail och telefon, och sköter kontorsadministration."],
            ["question" => "Vilken utbildning behövs?", "answer" => "Gymnasium räcker ofta, men KY-utbildning eller högskolekurser i administration ökar möjligheterna."],
            ["question" => "Är administratör ett bra jobb?", "answer" => "Ja, det är stabilt med regelbundna arbetstider. Passar dig som är organiserad och gillar struktur."],
            ["question" => "Var jobbar administratörer?", "answer" => "Överallt – kommuner, sjukhus, företag, myndigheter, skolor och föreningar."]
        ],
        "kd" => 18,
        "volume" => 2400,
        "scb" => [
            "ssyk_code" => "4110",
            "year" => 2024,
            "salary_total" => 33500,
            "salary_men" => 35000,
            "salary_women" => 33000,
            "gender_gap_percent" => 94.3,
            "evolution_10y_percent" => 26,
            "history" => [
                "2014" => 26600, "2015" => 27300, "2016" => 28000, "2017" => 28800, "2018" => 29600,
                "2019" => 30400, "2020" => 31100, "2021" => 31900, "2022" => 32600, "2023" => 33100, "2024" => 33500
            ],
            "history_men" => [
                "2014" => 27800, "2015" => 28500, "2016" => 29300, "2017" => 30100, "2018" => 31000,
                "2019" => 31800, "2020" => 32600, "2021" => 33400, "2022" => 34200, "2023" => 34600, "2024" => 35000
            ],
            "history_women" => [
                "2014" => 26200, "2015" => 26900, "2016" => 27600, "2017" => 28400, "2018" => 29200,
                "2019" => 30000, "2020" => 30700, "2021" => 31500, "2022" => 32200, "2023" => 32600, "2024" => 33000
            ],
            "percentiles" => ["p10" => 27500, "p25" => 30000, "p50" => 33000, "p75" => 36500, "p90" => 40000],
            "salary_by_age" => [
                "18-24" => 26000, "25-34" => 31000, "35-44" => 34500, "45-54" => 36000, "55-64" => 35500, "65+" => 33000
            ]
        ]
    ],

    // 2. Biomedicinsk analytiker
    [
        "category" => "Hälsa & Sjukvård",
        "slug" => "biomedicinsk-analytiker",
        "title" => "Biomedicinsk analytiker",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "biomedicinsk analytiker lön",
        "avg_salary" => 38500,
        "median_salary" => 38000,
        "description" => "En biomedicinsk analytiker utför laboratorieanalyser inom sjukvården. De analyserar blod, urin och vävnadsprover för att ställa diagnoser.",
        "description_extended" => "BMA arbetar på sjukhuslaboratorier, privata labb eller inom forskning. Arbetet kräver noggrannhet och teknisk kompetens. Det är ett legitimationsyrke med goda karriärmöjligheter.",
        "education" => "Biomedicinsk analytikerprogram (3 år) vid högskola. Kräver legitimation från Socialstyrelsen.",
        "salary_by_sector" => ["region" => 38000, "privat" => 41000],
        "pros" => ["Meningsfullt arbete", "Hög efterfrågan", "Möjlighet till specialisering", "Trygga anställningar"],
        "cons" => ["Skiftarbete", "Fysiskt krävande", "Exponering för biologiskt material", "Begränsad löneutveckling"],
        "faq" => [
            ["question" => "Vad tjänar en biomedicinsk analytiker?", "answer" => "En BMA tjänar i genomsnitt 38 500 kr per månad."],
            ["question" => "Hur lång är utbildningen?", "answer" => "Utbildningen är 3 år på högskolenivå och leder till legitimation."],
            ["question" => "Var jobbar biomedicinska analytiker?", "answer" => "På sjukhuslaboratorier, blodcentraler, forskningsinstitut och privata labb."],
            ["question" => "Är det brist på biomedicinska analytiker?", "answer" => "Ja, det råder brist i hela Sverige vilket ger goda jobbmöjligheter."],
            ["question" => "Vad är skillnaden mot laboratorieassistent?", "answer" => "BMA har längre utbildning och kan utföra mer avancerade analyser självständigt."]
        ],
        "kd" => 17,
        "volume" => 2400,
        "scb" => [
            "ssyk_code" => "3212",
            "year" => 2024,
            "salary_total" => 38500,
            "salary_men" => 40000,
            "salary_women" => 38200,
            "gender_gap_percent" => 95.5,
            "evolution_10y_percent" => 29,
            "history" => [
                "2014" => 29800, "2015" => 30600, "2016" => 31500, "2017" => 32500, "2018" => 33500,
                "2019" => 34500, "2020" => 35500, "2021" => 36500, "2022" => 37400, "2023" => 38000, "2024" => 38500
            ],
            "history_men" => [
                "2014" => 31000, "2015" => 31900, "2016" => 32800, "2017" => 33900, "2018" => 35000,
                "2019" => 36000, "2020" => 37100, "2021" => 38100, "2022" => 39000, "2023" => 39500, "2024" => 40000
            ],
            "history_women" => [
                "2014" => 29500, "2015" => 30300, "2016" => 31200, "2017" => 32200, "2018" => 33200,
                "2019" => 34200, "2020" => 35200, "2021" => 36200, "2022" => 37100, "2023" => 37700, "2024" => 38200
            ],
            "percentiles" => ["p10" => 32500, "p25" => 35500, "p50" => 38000, "p75" => 41500, "p90" => 45000],
            "salary_by_age" => [
                "18-24" => 30000, "25-34" => 36000, "35-44" => 40000, "45-54" => 42000, "55-64" => 41000, "65+" => 38000
            ]
        ]
    ],

    // 3. Flygledare
    [
        "category" => "Transport & Logistik",
        "slug" => "flygledare",
        "title" => "Flygledare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "flygledare lön",
        "avg_salary" => 72000,
        "median_salary" => 70000,
        "description" => "En flygledare övervakar och dirigerar flygtrafik för att säkerställa säkra starter, landningar och flygningar. Det är ett av Sveriges högst betalda yrken.",
        "description_extended" => "Flygledare arbetar i torn på flygplatser eller i kontrollcentraler. Arbetet kräver extrem koncentration, stresshantering och snabba beslut. Utbildningen är krävande men leder till mycket hög lön.",
        "education" => "Flygledarsutbildning via LFV (ca 3 år). Hårda krav på hälsa, syn, hörsel och psykologisk stabilitet.",
        "salary_by_sector" => ["statlig" => 72000],
        "pros" => ["Mycket hög lön", "Ansvarsfull roll", "Goda arbetsvillkor", "Unik kompetens"],
        "cons" => ["Extremt stressigt", "Skiftarbete dygnet runt", "Hårda hälsokrav", "Svår att klara utbildningen"],
        "faq" => [
            ["question" => "Vad tjänar en flygledare?", "answer" => "En flygledare tjänar i genomsnitt 72 000 kr per månad, vilket gör det till ett av Sveriges högst betalda yrken."],
            ["question" => "Hur svårt är det att bli flygledare?", "answer" => "Mycket svårt. Endast 5-10% klarar de omfattande testerna och utbildningen."],
            ["question" => "Vilka krav finns?", "answer" => "Gott hälsotillstånd, perfekt syn och hörsel, stresstålighet och god engelska krävs."],
            ["question" => "Var jobbar flygledare?", "answer" => "I flygplatstorn eller i flygkontrollcentraler som ATCC i Malmö och Stockholm."],
            ["question" => "Hur lång är utbildningen?", "answer" => "Ca 3 år, inklusive teori och praktik. Hela utbildningen är betald."]
        ],
        "kd" => 20,
        "volume" => 2400,
        "scb" => [
            "ssyk_code" => "3154",
            "year" => 2024,
            "salary_total" => 72000,
            "salary_men" => 73000,
            "salary_women" => 70000,
            "gender_gap_percent" => 95.9,
            "evolution_10y_percent" => 25,
            "history" => [
                "2014" => 57600, "2015" => 59000, "2016" => 60500, "2017" => 62000, "2018" => 64000,
                "2019" => 66000, "2020" => 67500, "2021" => 69000, "2022" => 70500, "2023" => 71200, "2024" => 72000
            ],
            "history_men" => [
                "2014" => 58400, "2015" => 59800, "2016" => 61400, "2017" => 62900, "2018" => 64900,
                "2019" => 66900, "2020" => 68500, "2021" => 70000, "2022" => 71500, "2023" => 72200, "2024" => 73000
            ],
            "history_women" => [
                "2014" => 55500, "2015" => 56900, "2016" => 58400, "2017" => 59900, "2018" => 61800,
                "2019" => 63800, "2020" => 65300, "2021" => 66800, "2022" => 68300, "2023" => 69100, "2024" => 70000
            ],
            "percentiles" => ["p10" => 58000, "p25" => 65000, "p50" => 70000, "p75" => 78000, "p90" => 88000],
            "salary_by_age" => [
                "18-24" => 45000, "25-34" => 65000, "35-44" => 75000, "45-54" => 80000, "55-64" => 78000, "65+" => 72000
            ]
        ]
    ],

    // 4. Fysioterapeut
    [
        "category" => "Hälsa & Sjukvård",
        "slug" => "fysioterapeut",
        "title" => "Fysioterapeut",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "fysioterapeut lön",
        "avg_salary" => 39500,
        "median_salary" => 39000,
        "description" => "En fysioterapeut (tidigare sjukgymnast) behandlar och förebygger funktionsnedsättningar genom rörelseträning, manuell behandling och hälsorådgivning.",
        "description_extended" => "Fysioterapeuter arbetar inom primärvård, sjukhus, rehabilitering, idrott eller privat. Yrket kräver legitimation och erbjuder goda möjligheter till specialisering inom exempelvis ortopedi eller neurologi.",
        "education" => "Fysioterapeutprogram (3 år) vid universitet. Kräver legitimation från Socialstyrelsen.",
        "salary_by_sector" => ["region" => 38500, "privat" => 42000],
        "pros" => ["Meningsfullt patientarbete", "Hög efterfrågan", "Möjlighet att starta eget", "Fysiskt aktivt yrke"],
        "cons" => ["Fysiskt ansträngande", "Administrativt tungt", "Begränsad löneutveckling offentligt", "Emotionellt krävande"],
        "faq" => [
            ["question" => "Vad tjänar en fysioterapeut?", "answer" => "En fysioterapeut tjänar i genomsnitt 39 500 kr per månad. Privatpraktiserande kan tjäna betydligt mer."],
            ["question" => "Vad är skillnaden på fysioterapeut och sjukgymnast?", "answer" => "Det är samma yrke. Namnet ändrades officiellt till fysioterapeut 2014."],
            ["question" => "Hur lång är utbildningen?", "answer" => "3 år på universitet, följt av legitimationsansökan."],
            ["question" => "Var jobbar fysioterapeuter?", "answer" => "Vårdcentraler, sjukhus, rehab-center, idrottsklubbar eller egen praktik."],
            ["question" => "Är det brist på fysioterapeuter?", "answer" => "Ja, särskilt inom primärvården råder det brist i många regioner."]
        ],
        "kd" => 19,
        "volume" => 2400,
        "scb" => [
            "ssyk_code" => "2264",
            "year" => 2024,
            "salary_total" => 39500,
            "salary_men" => 41500,
            "salary_women" => 38800,
            "gender_gap_percent" => 93.5,
            "evolution_10y_percent" => 28,
            "history" => [
                "2014" => 30900, "2015" => 31700, "2016" => 32600, "2017" => 33600, "2018" => 34600,
                "2019" => 35600, "2020" => 36600, "2021" => 37600, "2022" => 38500, "2023" => 39000, "2024" => 39500
            ],
            "history_men" => [
                "2014" => 32400, "2015" => 33300, "2016" => 34200, "2017" => 35300, "2018" => 36400,
                "2019" => 37400, "2020" => 38500, "2021" => 39500, "2022" => 40500, "2023" => 41000, "2024" => 41500
            ],
            "history_women" => [
                "2014" => 30400, "2015" => 31200, "2016" => 32100, "2017" => 33100, "2018" => 34000,
                "2019" => 35000, "2020" => 36000, "2021" => 37000, "2022" => 37900, "2023" => 38400, "2024" => 38800
            ],
            "percentiles" => ["p10" => 33000, "p25" => 36000, "p50" => 39000, "p75" => 43000, "p90" => 48000],
            "salary_by_age" => [
                "18-24" => 31000, "25-34" => 37000, "35-44" => 41000, "45-54" => 43000, "55-64" => 42000, "65+" => 39000
            ]
        ]
    ],

    // 5. Flygvärdinna / Kabinpersonal
    [
        "category" => "Transport & Logistik",
        "slug" => "flygvardinna",
        "title" => "Flygvärdinna",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "flygvärdinna lön",
        "avg_salary" => 32000,
        "median_salary" => 31500,
        "description" => "En flygvärdinna (kabinpersonal) ansvarar för passagerarnas säkerhet och komfort ombord på flygplan. Rollen inkluderar säkerhetsdemonstrationer, servering och krishantering.",
        "description_extended" => "Kabinpersonal arbetar för flygbolag och reser internationellt. Arbetstiderna är oregelbundna med mycket tid borta från hemmet. Lönen är relativt låg men många lockas av möjligheten att resa.",
        "education" => "Ingen formell utbildning krävs, men flygbolagen har interna utbildningar. God engelska och serviceförmåga krävs.",
        "salary_by_sector" => ["privat" => 32000],
        "pros" => ["Resor världen över", "Rabatter på flyg och hotell", "Socialt arbete", "Spännande arbetsplats"],
        "cons" => ["Oregelbundna tider", "Låg lön", "Fysiskt ansträngande", "Jet lag och trötthet"],
        "faq" => [
            ["question" => "Vad tjänar en flygvärdinna?", "answer" => "En flygvärdinna tjänar i genomsnitt 32 000 kr per månad. Lönen varierar mellan flygbolag."],
            ["question" => "Vilka krav finns?", "answer" => "Minst 18 år, god hälsa, simkunnig, flytande engelska och ofta minst 160 cm lång."],
            ["question" => "Hur blir man flygvärdinna?", "answer" => "Ansök direkt till flygbolag när de annonserar. De har interna utbildningar på 4-8 veckor."],
            ["question" => "Är det svårt att bli flygvärdinna?", "answer" => "Det är konkurrensutsatt. Personlighet, utseende och servicekänsla bedöms noggrant."],
            ["question" => "Hur mycket är man borta hemifrån?", "answer" => "Ca 15-20 nätter per månad, beroende på rutter och flygbolag."]
        ],
        "kd" => 13,
        "volume" => 1900,
        "scb" => [
            "ssyk_code" => "5111",
            "year" => 2024,
            "salary_total" => 32000,
            "salary_men" => 33500,
            "salary_women" => 31500,
            "gender_gap_percent" => 94.0,
            "evolution_10y_percent" => 22,
            "history" => [
                "2014" => 26200, "2015" => 26800, "2016" => 27400, "2017" => 28000, "2018" => 28700,
                "2019" => 29400, "2020" => 29000, "2021" => 29500, "2022" => 30500, "2023" => 31200, "2024" => 32000
            ],
            "history_men" => [
                "2014" => 27400, "2015" => 28000, "2016" => 28700, "2017" => 29300, "2018" => 30000,
                "2019" => 30800, "2020" => 30300, "2021" => 30800, "2022" => 31900, "2023" => 32700, "2024" => 33500
            ],
            "history_women" => [
                "2014" => 25800, "2015" => 26400, "2016" => 27000, "2017" => 27600, "2018" => 28300,
                "2019" => 29000, "2020" => 28600, "2021" => 29100, "2022" => 30100, "2023" => 30800, "2024" => 31500
            ],
            "percentiles" => ["p10" => 26500, "p25" => 29000, "p50" => 31500, "p75" => 35000, "p90" => 39000],
            "salary_by_age" => [
                "18-24" => 27000, "25-34" => 31000, "35-44" => 33500, "45-54" => 35000, "55-64" => 33000, "65+" => 30000
            ]
        ]
    ]
];

$addedCount = 0;
foreach ($newProfessions as $profession) {
    if (!isset($existingSlugs[$profession['slug']])) {
        $data[] = $profession;
        $addedCount++;
        echo "Added: {$profession['title']}\n";
    } else {
        echo "Skipped (exists): {$profession['title']}\n";
    }
}

if ($addedCount > 0) {
    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    echo "\n✅ Added $addedCount new professions to professions.json\n";
} else {
    echo "\n⚠️ No new professions added (all already exist)\n";
}
