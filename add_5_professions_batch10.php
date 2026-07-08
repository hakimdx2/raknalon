<?php
/**
 * Batch 10: Add 5 more professions (Restoration, Beauty, IT, Finance)
 * Target: Kock, Frisör, Webbprogrammerare, Business Controller, Servitör
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. Kock
    [
        "category" => "Restaurang & Hotell",
        "slug" => "kock",
        "title" => "Kock",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "kock lön",
        "avg_salary" => 30500,
        "median_salary" => 30000,
        "description" => "En kock lagar mat på restaurang, i storkök eller på hotell.",
        "description_extended" => "Allt från lunchservering till fine dining. Arbetet är kreativt men tempot är högt och arbetstiderna oftast kvällar och helger.",
        "education" => "Restaurang- och livsmedelsprogrammet eller vuxenutbildning.",
        "salary_by_sector" => ["privat" => 31000, "offentlig" => 29500],
        "pros" => ["Kreativt", "Lätt att få jobb", "Internationella möjligheter", "Laganda i köket"],
        "cons" => ["Stressigt", "Obekväma arbetstider", "Fysiskt tungt", "Varm och bullrig miljö"],
        "faq" => [
            ["question" => "Vad tjänar en kock?", "answer" => "Genomsnittet är ca 30 500 kr. Köksmästare tjänar mer."],
            ["question" => "Krävs utbildning?", "answer" => "Ofta ja, men många börjar som diskare/köksbiträde och lär sig på plats."],
            ["question" => "Är det brist på kockar?", "answer" => "Ja, det är stor brist på utbildade kockar i hela landet."],
            ["question" => "Vad är skillnaden på kock och kallskänka?", "answer" => "Kocken lagar varm mat, kallskänkan ansvarar för sallader, förrätter och desserter."],
            ["question" => "Hur ser drickssystemet ut?", "answer" => "Dricks (dricks) delas ofta mellan servis och kök, vilket ger ett tillskott på lönen."]
        ],
        "kd" => 26, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "5120", "year" => 2024,
            "salary_total" => 30500, "salary_men" => 31000, "salary_women" => 30000,
            "gender_gap_percent" => 96.8, "evolution_10y_percent" => 22,
            "history" => ["2014" => 24800, "2015" => 25500, "2016" => 26200, "2017" => 27000, "2018" => 27800, "2019" => 28500, "2020" => 29000, "2021" => 29500, "2022" => 30000, "2023" => 30200, "2024" => 30500],
            "history_men" => ["2014" => 25200, "2015" => 26000, "2016" => 26800, "2017" => 27500, "2018" => 28200, "2019" => 29000, "2020" => 29500, "2021" => 30000, "2022" => 30500, "2023" => 30800, "2024" => 31000],
            "history_women" => ["2014" => 24500, "2015" => 25000, "2016" => 25800, "2017" => 26500, "2018" => 27200, "2019" => 28000, "2020" => 28500, "2021" => 29000, "2022" => 29500, "2023" => 29800, "2024" => 30000],
            "percentiles" => ["p10" => 25000, "p25" => 27500, "p50" => 30000, "p75" => 33000, "p90" => 36000],
            "salary_by_age" => ["18-24" => 24000, "25-34" => 29000, "35-44" => 31000, "45-54" => 31500, "55-64" => 31000, "65+" => 26000]
        ]
    ],

    // 2. Frisör
    [
        "category" => "Hantverk & Service",
        "slug" => "frisor",
        "title" => "Frisör",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "frisör lön",
        "avg_salary" => 29000,
        "median_salary" => 28500,
        "description" => "En frisör klipper, färgar och stylar hår. Många arbetar som egna företagare.",
        "description_extended" => "Yrket kräver kreativitet, servicekänsla och hantverksskicklighet. Gesällbrev är beviset på yrkesskicklighet.",
        "education" => "Hantverksprogrammet (Gymnasium) eller privatskola + färdigutbildning (trainee).",
        "salary_by_sector" => ["privat" => 29000],
        "pros" => ["Kreativt", "Socialt", "Möjlighet till eget företag", "Ser resultat direkt"],
        "cons" => ["Belastningsskador (axlar/rygg)", "Kemikalier", "Helgarbete", "Låg ingångslön"],
        "faq" => [
            ["question" => "Vad tjänar en frisör?", "answer" => "En anställd frisör tjänar ca 29 000 kr. Egenföretagare kan tjäna mer men tar också större risk."],
            ["question" => "Vad är gesällbrev?", "answer" => "Ett bevis på att du klarat branschens prov. Ger ofta rätt till högre lön."],
            ["question" => "Hur blir man frisör?", "answer" => "Gymnasium eller privatskola (ca 1 år), därefter ca 3000 timmar som trainee."],
            ["question" => "Är det svårt att få jobb?", "answer" => "Konkurrensen är stor i storstäder, men duktiga frisörer behövs alltid."],
            ["question" => "Får man provision?", "answer" => "Ja, det är vanligt med en grundlön plus provision på behandlingar och produktförsäljning."]
        ],
        "kd" => 15, "volume" => 880,
        "scb" => [
            "ssyk_code" => "5141", "year" => 2024,
            "salary_total" => 29000, "salary_men" => 27000, "salary_women" => 29500,
            "gender_gap_percent" => 109.2, "evolution_10y_percent" => 20,
            "history" => ["2014" => 24000, "2015" => 24500, "2016" => 25000, "2017" => 25500, "2018" => 26200, "2019" => 27000, "2020" => 27500, "2021" => 28000, "2022" => 28500, "2023" => 28800, "2024" => 29000],
            "history_men" => ["2014" => 22000, "2015" => 22500, "2016" => 23000, "2017" => 23500, "2018" => 24200, "2019" => 25000, "2020" => 25500, "2021" => 26000, "2022" => 26500, "2023" => 26800, "2024" => 27000],
            "history_women" => ["2014" => 24200, "2015" => 24800, "2016" => 25400, "2017" => 26000, "2018" => 26800, "2019" => 27500, "2020" => 28000, "2021" => 28500, "2022" => 29000, "2023" => 29200, "2024" => 29500],
            "percentiles" => ["p10" => 23000, "p25" => 25000, "p50" => 28500, "p75" => 32000, "p90" => 36000],
            "salary_by_age" => ["18-24" => 22000, "25-34" => 27000, "35-44" => 30000, "45-54" => 30500, "55-64" => 29500, "65+" => 25000]
        ]
    ],

    // 3. Webbprogrammerare
    [
        "category" => "Teknik & IT",
        "slug" => "webbprogrammerare",
        "title" => "Webbprogrammerare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "webbprogrammerare lön",
        "avg_salary" => 42500,
        "median_salary" => 41500,
        "description" => "En webbprogrammerare (webbutvecklare) bygger hemsidor och webbapplikationer.",
        "description_extended" => "Jobbar med kod som HTML, CSS, JavaScript och PHP. Kan vara frontend (visuellt) eller backend (logik). Stor efterfrågan men också krav på att ständigt lära nytt.",
        "education" => "YH-utbildning (2 år) eller Universitet.",
        "salary_by_sector" => ["privat" => 43000, "offentlig" => 41000],
        "pros" => ["Hög lön", "Flexibelt (distansjobb)", "Kreativt", "Stor efterfrågan"],
        "cons" => ["Stillasittande", "Teknikstress", "Ögonbelastning", "Deadlines"],
        "faq" => [
            ["question" => "Vad tjänar en webbprogrammerare?", "answer" => "Ingångslön ca 32 000 kr, snittlön 42 500 kr. Seniora utvecklare tjänar 55 000+."],
            ["question" => "Vilka språk är viktigast?", "answer" => "JavaScript, React, PHP, Python och C# är vanliga."],
            ["question" => "Måste man vara högutbildad?", "answer" => "Nej, många är självlärda eller har gått YH. Portfoliot (vad du kan visa upp) är viktigast."],
            ["question" => "Är det svårt?", "answer" => "Det kräver logiskt tänkande och tålamod vid felsökning."],
            ["question" => "Vad är fullstack?", "answer" => "Att man behärskar både frontend (utseende) och backend (databas/server)."]
        ],
        "kd" => 11, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "2512", "year" => 2024,
            "salary_total" => 42500, "salary_men" => 43500, "salary_women" => 41000,
            "gender_gap_percent" => 94.2, "evolution_10y_percent" => 28,
            "history" => ["2014" => 33000, "2015" => 34000, "2016" => 35000, "2017" => 36500, "2018" => 38000, "2019" => 39500, "2020" => 40500, "2021" => 41500, "2022" => 42000, "2023" => 42200, "2024" => 42500],
            "history_men" => ["2014" => 34000, "2015" => 35000, "2016" => 36000, "2017" => 37500, "2018" => 39000, "2019" => 40500, "2020" => 41500, "2021" => 42500, "2022" => 43000, "2023" => 43200, "2024" => 43500],
            "history_women" => ["2014" => 32000, "2015" => 33000, "2016" => 34000, "2017" => 35500, "2018" => 36500, "2019" => 38000, "2020" => 39000, "2021" => 40000, "2022" => 40500, "2023" => 40800, "2024" => 41000],
            "percentiles" => ["p10" => 30000, "p25" => 36000, "p50" => 41500, "p75" => 48000, "p90" => 55000],
            "salary_by_age" => ["18-24" => 32000, "25-34" => 39000, "35-44" => 45000, "45-54" => 46000, "55-64" => 45000, "65+" => 40000]
        ]
    ],

    // 4. Business Controller
    [
        "category" => "Ekonomi & Finans",
        "slug" => "business-controller",
        "title" => "Business Controller",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "business controller lön",
        "avg_salary" => 60000,
        "median_salary" => 59000,
        "description" => "En Business Controller analyserar företagets siffror för att styra verksamheten mot lönsamhet.",
        "description_extended" => "Till skillnad från en redovisningsekonom som tittar bakåt, blickar controllern framåt med budget och prognos. Jobbar nära ledningen.",
        "education" => "Civilekonom eller motsvarande högskoleutbildning.",
        "salary_by_sector" => ["privat" => 62000, "offentlig" => 55000],
        "pros" => ["Hög lön", "Strategiskt inflytande", "Bred insyn i företaget", "Karriärväg till CFO"],
        "cons" => ["Hög press", "Övertid vid bokslut/budget", "Kräver analytisk skärpa", "Mycket Excel"],
        "faq" => [
            ["question" => "Vad tjänar en Business Controller?", "answer" => "Snittet är 60 000 kr. Seniora Business Controllers kan tjäna 70-80 000 kr."],
            ["question" => "Vad är skillnaden mot Financial Controller?", "answer" => "Financial fokuserar på att siffrorna är rätt (redovisning), Business fokuserar på affärsnyttan."],
            ["question" => "Vilka verktyg använder man?", "answer" => "Excel är viktigast, men även BI-system som PowerBI och QlikView."],
            ["question" => "Är det svårt?", "answer" => "Det kräver att man förstår både ekonomi och verksamhetens affärsmodell."],
            ["question" => "Krävs erfarenhet?", "answer" => "Ja, oftast börjar man som controller eller ekonom innan man blir Business Controller."]
        ],
        "kd" => 8, "volume" => 880,
        "scb" => [
            "ssyk_code" => "2413", "year" => 2024,
            "salary_total" => 60000, "salary_men" => 63000, "salary_women" => 57000,
            "gender_gap_percent" => 90.5, "evolution_10y_percent" => 29,
            "history" => ["2014" => 46000, "2015" => 47500, "2016" => 49000, "2017" => 51000, "2018" => 53000, "2019" => 55000, "2020" => 56500, "2021" => 58000, "2022" => 59000, "2023" => 59500, "2024" => 60000],
            "history_men" => ["2014" => 48000, "2015" => 49500, "2016" => 51000, "2017" => 53000, "2018" => 55000, "2019" => 57000, "2020" => 59000, "2021" => 61000, "2022" => 62000, "2023" => 62500, "2024" => 63000],
            "history_women" => ["2014" => 44000, "2015" => 45500, "2016" => 47000, "2017" => 49000, "2018" => 51000, "2019" => 53000, "2020" => 54000, "2021" => 55000, "2022" => 56000, "2023" => 56500, "2024" => 57000],
            "percentiles" => ["p10" => 45000, "p25" => 52000, "p50" => 59000, "p75" => 68000, "p90" => 80000],
            "salary_by_age" => ["18-24" => 38000, "25-34" => 50000, "35-44" => 62000, "45-54" => 65000, "55-64" => 63000, "65+" => 55000]
        ]
    ],

    // 5. Servitör
    [
        "category" => "Restaurang & Hotell",
        "slug" => "servitor",
        "title" => "Servitör",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "servitör lön",
        "avg_salary" => 27500,
        "median_salary" => 27000,
        "description" => "En servitör (eller servitris) serverar mat och dryck till gäster på restaurang.",
        "description_extended" => "Ger service, tar beställningar och rekommenderar rätter. Lönen kompletteras ofta med dricks. Arbetstempot är högt.",
        "education" => "Ingen formell krav, men restaurangskola är meriterande.",
        "salary_by_sector" => ["privat" => 27500],
        "pros" => ["Socialt", "Dricks", "Roligt team", "Flexibelt extrajobb"],
        "cons" => ["Låg grundlön", "Slitigt", "Sena kvällar", "Stressiga perioder"],
        "faq" => [
            ["question" => "Vad tjänar en servitör?", "answer" => "Grundlönen är ca 27 500 kr, men dricks kan ge flera tusenlappar extra i månaden."],
            ["question" => "Vad gör man?", "answer" => "Dukar, tar beställning, serverar, plockar av och tar betalt."],
            ["question" => "Måste man kunna viner?", "answer" => "På finare restauranger ja, men oftast räcker grundläggande kunskap. En rsommelier är vinexpert."],
            ["question" => "Är det heltid?", "answer" => "Många tjänster är deltid eller timanställning, men heltid finns."],
            ["question" => "Vad är 'springnota'?", "answer" => "När en gäst smiter från notan. Det är servitörens ansvar att ha uppsikt, men man ska inte betala själv."]
        ],
        "kd" => 15, "volume" => 590,
        "scb" => [
            "ssyk_code" => "5131", "year" => 2024,
            "salary_total" => 27500, "salary_men" => 28000, "salary_women" => 27000,
            "gender_gap_percent" => 96.4, "evolution_10y_percent" => 20,
            "history" => ["2014" => 22500, "2015" => 23000, "2016" => 23500, "2017" => 24200, "2018" => 24800, "2019" => 25500, "2020" => 26000, "2021" => 26500, "2022" => 27000, "2023" => 27200, "2024" => 27500],
            "history_men" => ["2014" => 23000, "2015" => 23500, "2016" => 24000, "2017" => 24800, "2018" => 25500, "2019" => 26000, "2020" => 26500, "2021" => 27000, "2022" => 27500, "2023" => 27800, "2024" => 28000],
            "history_women" => ["2014" => 22000, "2015" => 22500, "2016" => 23000, "2017" => 23600, "2018" => 24200, "2019" => 25000, "2020" => 25500, "2021" => 26000, "2022" => 26500, "2023" => 26800, "2024" => 27000],
            "percentiles" => ["p10" => 23000, "p25" => 25000, "p50" => 27000, "p75" => 29000, "p90" => 32000],
            "salary_by_age" => ["18-24" => 24500, "25-34" => 27000, "35-44" => 28500, "45-54" => 29000, "55-64" => 28500, "65+" => 24000]
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
