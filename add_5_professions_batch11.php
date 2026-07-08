<?php
/**
 * Batch 11: High Volume Remaining (Health, Law, Construction, IT)
 * Target: Röntgensjuksköterska, ST-läkare, Paralegal, Byggingenjör, Front end utvecklare
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. Röntgensjuksköterska
    [
        "category" => "Sjukvård & Hälsa",
        "slug" => "rontgensjukskoterska",
        "title" => "Röntgensjuksköterska",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "röntgensjuksköterska lön",
        "avg_salary" => 36500,
        "median_salary" => 36000,
        "description" => "En röntgensjuksköterska utför röntgenundersökningar med avancerad medicinteknisk utrustning.",
        "description_extended" => "Kombinerar omvårdnad med teknik. Utför allt från slätröntgen till MR (magnetkamera) och DT (datortomografi).",
        "education" => "Röntgensjuksköterskeprogrammet (3 år, 180 hp).",
        "salary_by_sector" => ["privat" => 37500, "offentlig" => 36000],
        "pros" => ["Tekniskt och omvårdande", "God arbetsmarknad", "Tydliga arbetstider (oftast)", "Legitimeratyrke"],
        "cons" => ["Strålningsmiljö (kräver säkerhet)", "Tunga lyft kan förekomma", "Stressigt flöde", "Nattarbete på akutsjukhus"],
        "faq" => [
            ["question" => "Vad tjänar en röntgensjuksköterska?", "answer" => "Genomsnittslönen är ca 36 500 kr. Kan vara högre inom bemanning."],
            ["question" => "Är det farligt med strålning?", "answer" => "Nej, säkerheten är rigorös och man arbetar bakom skyddsskärmar."],
            ["question" => "Vad är skillnaden mot vanlig sjuksköterska?", "answer" => "Utbildningen är specifik för radiografi och teknik, inte generell omvårdnad."],
            ["question" => "Kan man jobba utomlands?", "answer" => "Ja, svensk legitimation är gångbar i många länder (t.ex. Norge)."],
            ["question" => "Finns det vidareutbildning?", "answer" => "Ja, man kan specialisera sig inom MR, ultraljud eller intervention."]
        ],
        "kd" => 13, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "2191", "year" => 2024,
            "salary_total" => 36500, "salary_men" => 37000, "salary_women" => 36200,
            "gender_gap_percent" => 97.8, "evolution_10y_percent" => 25,
            "history" => ["2014" => 29000, "2015" => 29800, "2016" => 30500, "2017" => 31500, "2018" => 32500, "2019" => 33500, "2020" => 34200, "2021" => 35000, "2022" => 35800, "2023" => 36200, "2024" => 36500],
            "history_men" => ["2014" => 29500, "2015" => 30200, "2016" => 31000, "2017" => 32000, "2018" => 33000, "2019" => 34000, "2020" => 34800, "2021" => 35500, "2022" => 36200, "2023" => 36800, "2024" => 37000],
            "history_women" => ["2014" => 28800, "2015" => 29500, "2016" => 30200, "2017" => 31200, "2018" => 32200, "2019" => 33200, "2020" => 34000, "2021" => 34800, "2022" => 35500, "2023" => 36000, "2024" => 36200],
            "percentiles" => ["p10" => 31000, "p25" => 33500, "p50" => 36000, "p75" => 39500, "p90" => 43000],
            "salary_by_age" => ["18-24" => 31000, "25-34" => 34000, "35-44" => 37000, "45-54" => 38500, "55-64" => 38000, "65+" => 29000]
        ]
    ],

    // 2. ST-läkare
    [
        "category" => "Sjukvård & Hälsa",
        "slug" => "st-lakare",
        "title" => "ST-läkare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "st läkare lön",
        "avg_salary" => 54000,
        "median_salary" => 53000,
        "description" => "En ST-läkare (Specialiseringstjänstgöring) är under utbildning till specialistläkare.",
        "description_extended" => "Tjänstgöringen pågår i minst fem år. Man arbetar kliniskt under handledning samtidigt som man går kurser.",
        "education" => "Läkarexamen + Legitimation (via AT eller BT).",
        "salary_by_sector" => ["privat" => 56000, "offentlig" => 53500],
        "pros" => ["Lärande i arbetet", "God löneutveckling", "Vägen till specialist", "Variation"],
        "cons" => ["Hög arbetsbelastning", "Ansvar utan att vara 'färdig'", "Långa pass (jour)", "Konkurrens om populära ST-tjänster"],
        "faq" => [
            ["question" => "Vad tjänar en ST-läkare?", "answer" => "Lönen ökar under ST-tiden, men snittet ligger runt 54 000 kr."],
            ["question" => "Hur länge är man ST-läkare?", "answer" => "Minst 5 år, ofta längre om man forskar eller är föräldraledig."],
            ["question" => "Vad händer sedan?", "answer" => "När man är klar blir man Specialistläkare och lönen höjs rejält (ofta till 75 000+)."],
            ["question" => "Är det svårt att få ST?", "answer" => "Beror på specialitet (t.ex. kirurgi eller barnmedicin är populärt) och ort."],
            ["question" => "Kan man byta specialitet?", "answer" => "Ja, men då får man ofta tillgodoräkna sig viss tid men inte allt."]
        ],
        "kd" => 13, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "2212", "year" => 2024,
            "salary_total" => 54000, "salary_men" => 55000, "salary_women" => 53000,
            "gender_gap_percent" => 96.4, "evolution_10y_percent" => 22,
            "history" => ["2014" => 44000, "2015" => 45000, "2016" => 46500, "2017" => 47500, "2018" => 48500, "2019" => 49500, "2020" => 50500, "2021" => 51500, "2022" => 52500, "2023" => 53200, "2024" => 54000],
            "history_men" => ["2014" => 45000, "2015" => 46000, "2016" => 47500, "2017" => 48500, "2018" => 49500, "2019" => 50500, "2020" => 51500, "2021" => 52500, "2022" => 53500, "2023" => 54000, "2024" => 55000],
            "history_women" => ["2014" => 43000, "2015" => 44000, "2016" => 45500, "2017" => 46500, "2018" => 47500, "2019" => 48500, "2020" => 49500, "2021" => 50500, "2022" => 51500, "2023" => 52500, "2024" => 53000],
            "percentiles" => ["p10" => 45000, "p25" => 49000, "p50" => 53000, "p75" => 58000, "p90" => 62000],
            "salary_by_age" => ["18-24" => 0, "25-34" => 48000, "35-44" => 56000, "45-54" => 60000, "55-64" => 62000, "65+" => 50000]
        ]
    ],

    // 3. Paralegal
    [
        "category" => "Juridik",
        "slug" => "paralegal",
        "title" => "Paralegal",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "paralegal lön",
        "avg_salary" => 34500,
        "median_salary" => 34000,
        "description" => "En paralegal (juridisk handläggare) assisterar jurister och advokater med rättsutredningar och administration.",
        "description_extended" => "Arbetar på advokatbyråer, domstolar eller juridiska avdelningar. Sköter kontakt med myndigheter, upprättar utkast till avtal m.m.",
        "education" => "YH-utbildning (Paralegal, 2 år).",
        "salary_by_sector" => ["privat" => 35000, "offentlig" => 33500],
        "pros" => ["Juridiskt arbete utan juristexamen", "Kort utbildning", "Central roll", "Varierande arbetsplatser"],
        "cons" => ["Begränsade karriärvägar (jmf jurist)", "Assisterande roll", "Lönestagnation", "Byråkrati"],
        "faq" => [
            ["question" => "Vad tjänar en Paralegal?", "answer" => "Snittet ligger runt 34 500 kr. Kan vara högre på stora affärsjuridiska byråer."],
            ["question" => "Måste man vara jurist?", "answer" => "Nej, rollen är till för att avlasta jurister. YH-utbildning räcker."],
            ["question" => "Är det samma som juridisk sekreterare?", "answer" => "Nej, paralegal är mer kvalificerat och innefattar mer juridiskt sakarbete."],
            ["question" => "Var finns jobben?", "answer" => "Advokatbyråer, kommuner, fastighetsbolag och inkassobolag."],
            ["question" => "Bra ingångslön?", "answer" => "Helt okej för en 2-årig utbildning, ofta start runt 30-32 000 kr."]
        ],
        "kd" => 17, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "3411", "year" => 2024,
            "salary_total" => 34500, "salary_men" => 35500, "salary_women" => 34000,
            "gender_gap_percent" => 95.8, "evolution_10y_percent" => 20,
            "history" => ["2014" => 28500, "2015" => 29200, "2016" => 30000, "2017" => 30800, "2018" => 31500, "2019" => 32200, "2020" => 32800, "2021" => 33400, "2022" => 33800, "2023" => 34200, "2024" => 34500],
            "history_men" => ["2014" => 29000, "2015" => 29800, "2016" => 30600, "2017" => 31500, "2018" => 32200, "2019" => 33000, "2020" => 33800, "2021" => 34500, "2022" => 34800, "2023" => 35200, "2024" => 35500],
            "history_women" => ["2014" => 28000, "2015" => 28800, "2016" => 29500, "2017" => 30200, "2018" => 31000, "2019" => 31800, "2020" => 32200, "2021" => 32800, "2022" => 33200, "2023" => 33800, "2024" => 34000],
            "percentiles" => ["p10" => 28000, "p25" => 31000, "p50" => 34000, "p75" => 37000, "p90" => 40000],
            "salary_by_age" => ["18-24" => 28000, "25-34" => 32000, "35-44" => 35000, "45-54" => 36000, "55-64" => 36500, "65+" => 29000]
        ]
    ],

    // 4. Byggingenjör
    [
        "category" => "Teknik & IT",
        "slug" => "byggingenjor",
        "title" => "Byggingenjör",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "byggingenjör lön",
        "avg_salary" => 42000,
        "median_salary" => 41500,
        "description" => "En byggingenjör planerar och leder byggprojekt, från ritning till färdig byggnad.",
        "description_extended" => "Kan arbeta som konstruktör, produktionsledare eller kontrollant. Ser till att byggregler följs och kalkylen håller.",
        "education" => "Högskoleingenjör (3 år) eller Civilingenjör (5 år).",
        "salary_by_sector" => ["privat" => 43000, "offentlig" => 40500],
        "pros" => ["Skapande", "Konkret resultat", "Stor arbetsmarknad", "Bra lön"],
        "cons" => ["Stress vid deadlines", "Ansvar för säkerhet", "Konjunkturkänsligt", "Resor kan förekomma"],
        "faq" => [
            ["question" => "Vad tjänar en byggingenjör?", "answer" => "Genomsnittet är 42 000 kr, men det skiljer sig mellan konstruktörer och chefer."],
            ["question" => "Måste man vara bra på matte?", "answer" => "Ja, särskilt för konstruktionsberäkningar. För arbetsledning är organisation viktigare."],
            ["question" => "Är det kontorsjobb?", "answer" => "Både och. Mycket tid framför datorn (CAD), men också besök på byggarbetsplatser."],
            ["question" => "Vad är skillnaden mot arkitekt?", "answer" => "Arkitekten står för designen, ingenjören ser till att det håller och går att bygga."],
            ["question" => "Framtidsutsikter?", "answer" => "Goda, det byggs alltid (även om det går i vågor)."]
        ],
        "kd" => 15, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "2142", "year" => 2024,
            "salary_total" => 42000, "salary_men" => 43000, "salary_women" => 40500,
            "gender_gap_percent" => 94.2, "evolution_10y_percent" => 26,
            "history" => ["2014" => 33000, "2015" => 34000, "2016" => 35000, "2017" => 36000, "2018" => 37000, "2019" => 38000, "2020" => 39000, "2021" => 40000, "2022" => 41000, "2023" => 41500, "2024" => 42000],
            "history_men" => ["2014" => 33500, "2015" => 34500, "2016" => 35500, "2017" => 36500, "2018" => 37500, "2019" => 38500, "2020" => 39500, "2021" => 40500, "2022" => 41500, "2023" => 42500, "2024" => 43000],
            "history_women" => ["2014" => 32000, "2015" => 33000, "2016" => 34000, "2017" => 35000, "2018" => 36000, "2019" => 37000, "2020" => 38000, "2021" => 39000, "2022" => 39500, "2023" => 40000, "2024" => 40500],
            "percentiles" => ["p10" => 32000, "p25" => 37000, "p50" => 41500, "p75" => 47000, "p90" => 54000],
            "salary_by_age" => ["18-24" => 31000, "25-34" => 38000, "35-44" => 44000, "45-54" => 46000, "55-64" => 45000, "65+" => 38000]
        ]
    ],

    // 5. Front-end utvecklare
    [
        "category" => "Teknik & IT",
        "slug" => "front-end-utvecklare",
        "title" => "Front-end utvecklare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "front end utvecklare lön",
        "avg_salary" => 43000,
        "median_salary" => 42000,
        "description" => "En front-end utvecklare skapar det användaren ser och interagerar med på en webbplats eller app.",
        "description_extended" => "Fokus på användarvänlighet (UX/UI), prestanda och design. Koda HTML, CSS, JavaScript och ramverk som React eller Vue.",
        "education" => "YH-utbildning (2 år) eller Universitet.",
        "salary_by_sector" => ["privat" => 44000, "offentlig" => 41500],
        "pros" => ["Kreativt och logiskt", "Hög efterfrågan", "Bra lön", "Möjlighet till distansjobb"],
        "cons" => ["Tekniken ändras snabbt", "Kan vara stressigt", "Krav på pixel-perfektion", "Mycket skärmtid"],
        "faq" => [
            ["question" => "Vad tjänar en Front-end utvecklare?", "answer" => "Allt från 35 000 (junior) till 60 000+ (senior). Snittet är 43 000 kr."],
            ["question" => "Vad måste man kunna?", "answer" => "JavaScript är viktigast. Även HTML, CSS och ramverk som React."],
            ["question" => "Skillnad mot back-end?", "answer" => "Back-end hanterar servern och databasen. Front-end hanterar det visuella."],
            ["question" => "Behöver man kunna design?", "answer" => "Det är en fördel att ha öga för design, men ofta jobbar man utifrån en designers skisser."],
            ["question" => "Är det svårt att lära sig?", "answer" => "Lätt att komma igång, men svårt att bemästra fullt ut (djupt)."]
        ],
        "kd" => 12, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "2512", // Same as Webbprogrammerare/Systemutvecklare approx
            "year" => 2024,
            "salary_total" => 43000, "salary_men" => 44000, "salary_women" => 41500,
            "gender_gap_percent" => 94.3, "evolution_10y_percent" => 27,
            "history" => ["2014" => 33500, "2015" => 34500, "2016" => 35500, "2017" => 37000, "2018" => 38500, "2019" => 40000, "2020" => 41000, "2021" => 42000, "2022" => 42500, "2023" => 42800, "2024" => 43000],
            "history_men" => ["2014" => 34000, "2015" => 35000, "2016" => 36000, "2017" => 37500, "2018" => 39000, "2019" => 40500, "2020" => 41500, "2021" => 42500, "2022" => 43500, "2023" => 43800, "2024" => 44000],
            "history_women" => ["2014" => 32500, "2015" => 33500, "2016" => 34500, "2017" => 36000, "2018" => 37000, "2019" => 38500, "2020" => 39500, "2021" => 40500, "2022" => 41000, "2023" => 41200, "2024" => 41500],
            "percentiles" => ["p10" => 31000, "p25" => 37000, "p50" => 42000, "p75" => 49000, "p90" => 58000],
            "salary_by_age" => ["18-24" => 33000, "25-34" => 40000, "35-44" => 46000, "45-54" => 47000, "55-64" => 46000, "65+" => 41000]
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
