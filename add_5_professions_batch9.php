<?php
/**
 * Batch 9: Add 5 more professions (Construction, Security, Logistics)
 * Target: Målare, Fastighetstekniker, Truckförare, Väktare, Åklagare
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. Målare
    [
        "category" => "Bygg & Anläggning",
        "slug" => "malare",
        "title" => "Målare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "målare lön",
        "avg_salary" => 38000,
        "median_salary" => 37500,
        "description" => "En målare arbetar med att måla byggnader invändigt och utvändigt samt även tapetsering.",
        "description_extended" => "Arbetet kräver noggrannhet och färgkänsla. Kan innefatta allt från nybyggnation till renovering av gamla fastigheter.",
        "education" => "Gymnasiets bygg- och anläggningsprogram eller lärling.",
        "salary_by_sector" => ["privat" => 38000],
        "pros" => ["Skapande arbete", "Tydligt resultat", "Fysiskt aktivt", "Bra ingångslön"],
        "cons" => ["Slitigt för kroppen", "Damm och kemikalier", "Tidspress", "Elnformiga moment"],
        "faq" => [
            ["question" => "Vad tjänar en målare?", "answer" => "Snittlönen är ca 38 000 kr. Ackordslön kan ge betydligt mer."],
            ["question" => "Hur blir man målare?", "answer" => "Gymnasieutbildning eller lärlingsplats i cirka två år (få gesällbrev)."],
            ["question" => "Är det farligt?", "answer" => "Färger är bättre idag, men man ska skydda sig mot damm och ergonomiska skador."],
            ["question" => "Jobbar man året runt?", "answer" => "Inomhusmålning sker året runt, fasadarbete är säsongsbetonat."],
            ["question" => "Ingår tapetsering?", "answer" => "Ja, en byggnadsmålare gör oftast både målning, spackling och tapetsering."]
        ],
        "kd" => 23, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "713", "year" => 2024,
            "salary_total" => 38000, "salary_men" => 38500, "salary_women" => 37000,
            "gender_gap_percent" => 96.1, "evolution_10y_percent" => 26,
            "history" => ["2014" => 30000, "2015" => 30800, "2016" => 31800, "2017" => 32800, "2018" => 33800, "2019" => 34800, "2020" => 35500, "2021" => 36200, "2022" => 37000, "2023" => 37500, "2024" => 38000],
            "history_men" => ["2014" => 30400, "2015" => 31200, "2016" => 32200, "2017" => 33200, "2018" => 34200, "2019" => 35200, "2020" => 36000, "2021" => 36800, "2022" => 37500, "2023" => 38000, "2024" => 38500],
            "history_women" => ["2014" => 29000, "2015" => 29800, "2016" => 30800, "2017" => 31800, "2018" => 32500, "2019" => 33200, "2020" => 34000, "2021" => 34800, "2022" => 35500, "2023" => 36200, "2024" => 37000],
            "percentiles" => ["p10" => 31000, "p25" => 35000, "p50" => 37500, "p75" => 41000, "p90" => 45000],
            "salary_by_age" => ["18-24" => 30000, "25-34" => 36000, "35-44" => 39000, "45-54" => 40000, "55-64" => 39000, "65+" => 27000]
        ]
    ],

    // 2. Fastighetstekniker
    [
        "category" => "Bygg & Anläggning",
        "slug" => "fastighetstekniker",
        "title" => "Fastighetstekniker",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "fastighetstekniker lön",
        "avg_salary" => 39500,
        "median_salary" => 39000,
        "description" => "En fastighetstekniker ansvarar för drift och underhåll av tekniska system i fastigheter, som ventilation och värme.",
        "description_extended" => "Till skillnad från en fastighetsskötare som gör enklare underhåll, arbetar teknikern med optimering av energisystem och avancerad felsökning.",
        "education" => "YH-utbildning (Fastighetsingenjör/tekniker) eller gymnasium.",
        "salary_by_sector" => ["privat" => 40000, "offentlig" => 38500],
        "pros" => ["Tekniskt intressant", "Självständigt", "God arbetsmarknad", "Varierande problem"],
        "cons" => ["Jourtjänst kan förekomma", "Fysiska moment", "Krav på ständig uppdatering", "Ensamt ibland"],
        "faq" => [
            ["question" => "Vad tjänar en fastighetstekniker?", "answer" => "Genomsnittet ligger på knappt 40 000 kr. Specialister inom automation kan tjäna mer."],
            ["question" => "Vad är skillnaden mot fastighetsskötare?", "answer" => "Teknikern jobbar mer med systemen (VVS, Styr & Regler), skötaren mer med yttre/inre underhåll."],
            ["question" => "Behövs utbildning?", "answer" => "Ja, oftast YH-utbildning då systemen blir allt mer komplexa."],
            ["question" => "Var finns jobben?", "answer" => "Fastighetsbolag, tekniska förvaltare och sjukhus."],
            ["question" => "Vad gör man?", "answer" => "Övervakar drift via dator, ronderingar, åtgärdar larm och beställer reparationer."]
        ],
        "kd" => 13, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "3132", "year" => 2024,
            "salary_total" => 39500, "salary_men" => 40000, "salary_women" => 38000,
            "gender_gap_percent" => 95.0, "evolution_10y_percent" => 28,
            "history" => ["2014" => 31000, "2015" => 32000, "2016" => 33000, "2017" => 34200, "2018" => 35500, "2019" => 36800, "2020" => 37500, "2021" => 38200, "2022" => 38800, "2023" => 39200, "2024" => 39500],
            "history_men" => ["2014" => 31500, "2015" => 32500, "2016" => 33500, "2017" => 34800, "2018" => 36000, "2019" => 37200, "2020" => 38000, "2021" => 38800, "2022" => 39400, "2023" => 39800, "2024" => 40000],
            "history_women" => ["2014" => 30000, "2015" => 31000, "2016" => 32000, "2017" => 33000, "2018" => 34000, "2019" => 35000, "2020" => 36000, "2021" => 36800, "2022" => 37200, "2023" => 37500, "2024" => 38000],
            "percentiles" => ["p10" => 31000, "p25" => 35000, "p50" => 39000, "p75" => 43000, "p90" => 48000],
            "salary_by_age" => ["18-24" => 32000, "25-34" => 37000, "35-44" => 41000, "45-54" => 42000, "55-64" => 41000, "65+" => 26000]
        ]
    ],

    // 3. Truckförare
    [
        "category" => "Transport & Logistik",
        "slug" => "truckforare",
        "title" => "Truckförare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "truckförare lön",
        "avg_salary" => 32500,
        "median_salary" => 32000,
        "description" => "En truckförare arbetar på lager eller terminaler med att lasta, lossa och flytta gods.",
        "description_extended" => "Vanliga arbetsplatser är lager, industri och hamnar. Kräver truckkort (A, B, C etc.). Arbetet kan vara fysiskt och sker ofta i skift.",
        "education" => "Truckkort (Utbildning 1-5 dagar).",
        "salary_by_sector" => ["privat" => 32500],
        "pros" => ["Lätt att få jobb", "Kort utbildning", "Tydliga arbetsuppgifter", "OB-tillägg vid skift"],
        "cons" => ["Enformigt", "Fysiskt slitigt (nacke/rygg)", "Bullrig miljö", "Stressigt tempo"],
        "faq" => [
            ["question" => "Vad tjänar en truckförare?", "answer" => "Snittet är ca 32 500 kr. OB-ersättning för natt/helg tillkommer ofta."],
            ["question" => "Vad krävs för att bli truckförare?", "answer" => "Truckkort (TLP10). Kostar några tusenlappar och tar några dagar."],
            ["question" => "Är det svårt att köra truck?", "answer" => "Det kräver precision och säkerhetstänk, men man lär sig snabbt."],
            ["question" => "Var finns jobben?", "answer" => "Sverige har många stora logistiklager (e-handel) som ständigt söker folk."],
            ["question" => "Behöver man B-körkort?", "answer" => "Ofta ett krav från arbetsgivaren även om det inte krävs för att köra truck på inhägnat område."]
        ],
        "kd" => 12, "volume" => 880,
        "scb" => [
            "ssyk_code" => "4321", "year" => 2024,
            "salary_total" => 32500, "salary_men" => 33000, "salary_women" => 31500,
            "gender_gap_percent" => 95.4, "evolution_10y_percent" => 23,
            "history" => ["2014" => 26500, "2015" => 27200, "2016" => 28000, "2017" => 28800, "2018" => 29500, "2019" => 30200, "2020" => 30800, "2021" => 31200, "2022" => 31800, "2023" => 32200, "2024" => 32500],
            "history_men" => ["2014" => 27000, "2015" => 27800, "2016" => 28500, "2017" => 29200, "2018" => 30000, "2019" => 30800, "2020" => 31200, "2021" => 31800, "2022" => 32200, "2023" => 32800, "2024" => 33000],
            "history_women" => ["2014" => 25800, "2015" => 26500, "2016" => 27200, "2017" => 28000, "2018" => 28800, "2019" => 29500, "2020" => 30000, "2021" => 30500, "2022" => 31000, "2023" => 31200, "2024" => 31500],
            "percentiles" => ["p10" => 27000, "p25" => 29000, "p50" => 32000, "p75" => 35000, "p90" => 38000],
            "salary_by_age" => ["18-24" => 28000, "25-34" => 31000, "35-44" => 33000, "45-54" => 33500, "55-64" => 33000, "65+" => 24000]
        ]
    ],

    // 4. Väktare
    [
        "category" => "Säkerhet & Bevakning",
        "slug" => "vaktare",
        "title" => "Väktare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "väktare lön",
        "avg_salary" => 31000,
        "median_salary" => 30500,
        "description" => "En väktare bevakar egendom och byggnader för att förhindra stöld, skada och obehörigt tillträde.",
        "description_extended" => "Arbetar ofta natt med rondering. Kan vara stationär (i reception) eller ronderande (i bil). Skillnad mot ordningsvakt är att väktaren har mindre befogenheter.",
        "education" => "Väktarutbildning (VU1 + VU2, totalt ca 2 veckor).",
        "salary_by_sector" => ["privat" => 31000],
        "pros" => ["Kort utbildning", "Lätt att få jobb", "Nattarbete passar vissa", "Tryggt kollektivavtal"],
        "cons" => ["Obekväma arbetstider", "Enformigt", "Ensamt", "Låg grundlön (men OB höjer)"],
        "faq" => [
            ["question" => "Vad tjänar en väktare?", "answer" => "Grundlönen är ca 31 000 kr, men med natt-OB kommer man ofta upp högre."],
            ["question" => "Vad krävs för att bli väktare?", "answer" => "Godkänd utbildning (VU1 och VU2) samt att bli godkänd i länsstyrelsens registerkontroll."],
            ["question" => "Är det farligt?", "answer" => "Oftast lugnt, men riskfyllda situationer kan uppstå vid inbrottslarm."],
            ["question" => "Får väktare gripa folk?", "answer" => "Endast envarsgripande (som alla medborgare). En ordningsvakt har större befogenheter."],
            ["question" => "Kan man jobba extra?", "answer" => "Ja, det är mycket vanligt med behovsanställda väktare."]
        ],
        "kd" => 21, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "5414", "year" => 2024,
            "salary_total" => 31000, "salary_men" => 31500, "salary_women" => 30500,
            "gender_gap_percent" => 96.8, "evolution_10y_percent" => 24,
            "history" => ["2014" => 25000, "2015" => 25800, "2016" => 26400, "2017" => 27000, "2018" => 27800, "2019" => 28500, "2020" => 29200, "2021" => 29800, "2022" => 30400, "2023" => 30800, "2024" => 31000],
            "history_men" => ["2014" => 25200, "2015" => 26000, "2016" => 26800, "2017" => 27500, "2018" => 28200, "2019" => 29000, "2020" => 29500, "2021" => 30200, "2022" => 30800, "2023" => 31200, "2024" => 31500],
            "history_women" => ["2014" => 24800, "2015" => 25500, "2016" => 26000, "2017" => 26500, "2018" => 27200, "2019" => 28000, "2020" => 28500, "2021" => 29200, "2022" => 29800, "2023" => 30200, "2024" => 30500],
            "percentiles" => ["p10" => 26000, "p25" => 28000, "p50" => 30500, "p75" => 34000, "p90" => 37000],
            "salary_by_age" => ["18-24" => 27000, "25-34" => 29500, "35-44" => 31500, "45-54" => 32000, "55-64" => 31500, "65+" => 25000]
        ]
    ],

    // 5. Åklagare
    [
        "category" => "Juridik",
        "slug" => "aklagare",
        "title" => "Åklagare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "åklagare lön",
        "avg_salary" => 65000,
        "median_salary" => 64000,
        "description" => "En åklagare leder förundersökningar om brott och väcker åtal i domstol.",
        "description_extended" => "Arbetar åt Åklagarmyndigheten. Beslutar om anhållande och husrannsakan. Ett ansvarsfullt arbete som kräver hög juridisk kompetens och stresshantering.",
        "education" => "Juristexamen (4,5 år) + Notarietjänstgöring + Åklagarutbildning.",
        "salary_by_sector" => ["offentlig" => 65000],
        "pros" => ["Hög status", "Samhällsviktigt", "Bra lön", "Spännande ärenden"],
        "cons" => ["Hög arbetsbelastning", "Psykiskt påfrestande", "Kan innebära hotbild", "Lång utbildningsväg"],
        "faq" => [
            ["question" => "Vad tjänar en åklagare?", "answer" => "Ingångslön som kammaråklagare är ca 42 000, men snittlönen för erfarna är ca 65 000 kr. Chefsåklagare tjänar mer."],
            ["question" => "Hur blir man åklagare?", "answer" => "Juristexamen, följt av tingstjänstgöring (notarie) och sedan anställning som åklagaraspirant."],
            ["question" => "Vem är åklagarens motpart?", "answer" => "Advokaten (försvarsadvokaten). Åklagaren företräder staten/brottsoffret."],
            ["question" => "Är det farligt?", "answer" => "Vissa avdelningar (t.ex. gängkriminalitet) har högre risk, men säkerheten är hög."],
            ["question" => "Jobbar man helger?", "answer" => "Ja, det finns jourverksamhet för akuta beslut om anhållanden."]
        ],
        "kd" => 15, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "2612", "year" => 2024,
            "salary_total" => 65000, "salary_men" => 66000, "salary_women" => 64500,
            "gender_gap_percent" => 97.7, "evolution_10y_percent" => 30,
            "history" => ["2014" => 50000, "2015" => 51500, "2016" => 53000, "2017" => 54500, "2018" => 56000, "2019" => 58000, "2020" => 60000, "2021" => 61500, "2022" => 63000, "2023" => 64000, "2024" => 65000],
            "history_men" => ["2014" => 51000, "2015" => 52500, "2016" => 54000, "2017" => 55500, "2018" => 57000, "2019" => 59000, "2020" => 61000, "2021" => 62500, "2022" => 64000, "2023" => 65000, "2024" => 66000],
            "history_women" => ["2014" => 49500, "2015" => 51000, "2016" => 52500, "2017" => 54000, "2018" => 55500, "2019" => 57500, "2020" => 59500, "2021" => 61000, "2022" => 62500, "2023" => 63500, "2024" => 64500],
            "percentiles" => ["p10" => 45000, "p25" => 55000, "p50" => 64000, "p75" => 75000, "p90" => 85000],
            "salary_by_age" => ["18-24" => 35000, "25-34" => 45000, "35-44" => 60000, "45-54" => 70000, "55-64" => 72000, "65+" => 60000]
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
