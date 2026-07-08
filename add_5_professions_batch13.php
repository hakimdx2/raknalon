<?php
/**
 * Batch 13: Final Cleanup (Education & Construction)
 * Target: Fritidspedagog, Grundskollärare, Murare, Plattsättare, Golvläggare
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. Fritidspedagog
    [
        "category" => "Utbildning & Barnomsorg",
        "slug" => "fritidspedagog",
        "title" => "Fritidspedagog",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "fritidspedagog lön",
        "avg_salary" => 35000,
        "median_salary" => 34500,
        "description" => "En fritidspedagog ansvarar för elevernas tid före och efter skolan (fritidshem).",
        "description_extended" => "Fokus på social utveckling och meningsfull fritid. Arbetar ofta i team med lärare och barnskötare.",
        "education" => "Grundlärarexamen inriktning fritidshem (3 år, 180 hp).",
        "salary_by_sector" => ["privat" => 35500, "offentlig" => 35000],
        "pros" => ["Pedagogiskt ansvar", "Roligt och kreativt", "Viktig roll för barnen", "Tydlig arbetstid"],
        "cons" => ["Stora barngrupper", "Hög ljudnivå", "Stressigt vid hämtning/lämning", "Statusutmaning (jmf klasslärare)"],
        "faq" => [
            ["question" => "Vad tjänar en fritidspedagog?", "answer" => "Snittlönen ligger runt 35 000 kr. Legitimerade lärare i fritidshem har bäst löneutveckling."],
            ["question" => "Vad är skillnaden mot barnskötare?", "answer" => "Fritidspedagogen har högskoleutbildning och pedagogiskt ansvar för verksamheten."],
            ["question" => "Krävs legitimation?", "answer" => "Ja, för att få tillsvidareanställning och sätta betyg (i vissa fall) krävs legitimation."],
            ["question" => "Jobbar man på loven?", "answer" => "Ja, fritidshemmet är öppet på loven, vilket ger möjlighet till längre aktiviteter."],
            ["question" => "Är det bristyrke?", "answer" => "Ja, det är stor brist på behöriga fritidspedagoger."]
        ],
        "kd" => 14, "volume" => 880,
        "scb" => [
            "ssyk_code" => "2342", "year" => 2024,
            "salary_total" => 35000, "salary_men" => 35500, "salary_women" => 34800,
            "gender_gap_percent" => 98.0, "evolution_10y_percent" => 25,
            "history" => ["2014" => 28000, "2015" => 28800, "2016" => 29500, "2017" => 30500, "2018" => 31500, "2019" => 32500, "2020" => 33200, "2021" => 34000, "2022" => 34500, "2023" => 34800, "2024" => 35000],
            "history_men" => ["2014" => 28500, "2015" => 29200, "2016" => 30000, "2017" => 31000, "2018" => 32000, "2019" => 33000, "2020" => 33800, "2021" => 34500, "2022" => 35000, "2023" => 35200, "2024" => 35500],
            "history_women" => ["2014" => 27800, "2015" => 28500, "2016" => 29200, "2017" => 30200, "2018" => 31200, "2019" => 32200, "2020" => 33000, "2021" => 33800, "2022" => 34200, "2023" => 34500, "2024" => 34800],
            "percentiles" => ["p10" => 30000, "p25" => 33000, "p50" => 35000, "p75" => 38000, "p90" => 41000],
            "salary_by_age" => ["18-24" => 28000, "25-34" => 33000, "35-44" => 35500, "45-54" => 36500, "55-64" => 36000, "65+" => 29000]
        ]
    ],

    // 2. Grundskollärare
    [
        "category" => "Utbildning & Barnomsorg",
        "slug" => "grundskollarare",
        "title" => "Grundskollärare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "grundskollärare lön",
        "avg_salary" => 41500,
        "median_salary" => 41000,
        "description" => "En grundskollärare undervisar elever i årskurs 1-3, 4-6 eller 7-9.",
        "description_extended" => "Planerar lektioner, sätter betyg och ansvarar för elevernas kunskapsutveckling. Kräver legitimation.",
        "education" => "Grundlärarexamen eller Ämneslärarexamen (4-5 år).",
        "salary_by_sector" => ["privat" => 42000, "offentlig" => 41500],
        "pros" => ["Viktigt samhällsuppdrag", "Sommarlov (ferietjänst)", "God arbetsmarknad", "Bra löneutveckling senaste åren"],
        "cons" => ["Hög arbetsbelastning", "Dokumentationskrav", "Stora klasser", "Föräldrakontakter"],
        "faq" => [
            ["question" => "Vad tjänar en grundskollärare?", "answer" => "Ca 41 500 kr i snitt. Lärare mot högre åldrar (7-9) tjänar ofta något mer än F-3."],
            ["question" => "Vad är förstelärare?", "answer" => "En karriärtjänst för skickliga lärare som ger ett lönepåslag på ca 5 000 - 10 000 kr."],
            ["question" => "Är det ferietjänst?", "answer" => "Ja, de flesta lärare har ferietjänst (ledigt på loven) mot att de arbetar 45h/vecka under terminerna."],
            ["question" => "Är det brist?", "answer" => "Ja, stor lärarbrist i hela landet."],
            ["question" => "Måste man vara behörig?", "answer" => "För fast anställning och betygssättning krävs lärarlegitimation."]
        ],
        "kd" => 23, "volume" => 720,
        "scb" => [
            "ssyk_code" => "2341", "year" => 2024,
            "salary_total" => 41500, "salary_men" => 42000, "salary_women" => 41200,
            "gender_gap_percent" => 98.1, "evolution_10y_percent" => 30,
            "history" => ["2014" => 31000, "2015" => 32500, "2016" => 34000, "2017" => 36000, "2018" => 38000, "2019" => 39500, "2020" => 40200, "2021" => 41000, "2022" => 41500, "2023" => 41800, "2024" => 41500],
            "history_men" => ["2014" => 31500, "2015" => 33000, "2016" => 34500, "2017" => 36500, "2018" => 38500, "2019" => 40000, "2020" => 40800, "2021" => 41500, "2022" => 42000, "2023" => 42500, "2024" => 42000],
            "history_women" => ["2014" => 30800, "2015" => 32200, "2016" => 33800, "2017" => 35800, "2018" => 37800, "2019" => 39200, "2020" => 40000, "2021" => 40800, "2022" => 41200, "2023" => 41500, "2024" => 41200],
            "percentiles" => ["p10" => 35000, "p25" => 39000, "p50" => 41500, "p75" => 45000, "p90" => 48000],
            "salary_by_age" => ["18-24" => 33000, "25-34" => 38000, "35-44" => 42000, "45-54" => 44000, "55-64" => 43500, "65+" => 35000]
        ]
    ],

    // 3. Murare
    [
        "category" => "Bygg & Anläggning",
        "slug" => "murare",
        "title" => "Murare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "murare lön",
        "avg_salary" => 37500,
        "median_salary" => 37000,
        "description" => "En murare bygger väggar, fasader och eldstäder av tegel och betongblock.",
        "description_extended" => "Hantverket kräver precision. Putsning av fasader är också en vanlig arbetsuppgift.",
        "education" => "Gymnasiets bygg- och anläggningsprogram eller lärling.",
        "salary_by_sector" => ["privat" => 37500],
        "pros" => ["Konkret hantverk", "Bra lön (ackord)", "Fysiskt arbete", "Utomhusjobb"],
        "cons" => ["Tungt för kroppen", "Säsongsberoende", "Dammigt", "Slitigt"],
        "faq" => [
            ["question" => "Vad tjänar en murare?", "answer" => "Snittet är ca 37 500 kr. På ackord (prestaionslön) kan man tjäna betydligt mer."],
            ["question" => "Är det tungt?", "answer" => "Ja, mureri räknas som ett av de tyngre byggyrkena pga tunga lyft av sten och bruk."],
            ["question" => "Behöver man utbildning?", "answer" => "Grundutbildning på gymnasium eller vuxenutbildning, sedan ca 2,5 år som lärling."],
            ["question" => "Jobbar man på vintern?", "answer" => "Ja, men utomhusjobb kan vara begränsade. Man jobbar ofta under väderskydd."],
            ["question" => "Vad är yrkesbevis?", "answer" => "Beviset på att du gjort din lärlingstid och klarat yrkesteorin."]
        ],
        "kd" => 13, "volume" => 320,
        "scb" => [
            "ssyk_code" => "7112", "year" => 2024,
            "salary_total" => 37500, "salary_men" => 37800, "salary_women" => 36500,
            "gender_gap_percent" => 96.6, "evolution_10y_percent" => 24,
            "history" => ["2014" => 30000, "2015" => 30800, "2016" => 31500, "2017" => 32500, "2018" => 33500, "2019" => 34500, "2020" => 35200, "2021" => 36000, "2022" => 36800, "2023" => 37200, "2024" => 37500],
            "history_men" => ["2014" => 30500, "2015" => 31200, "2016" => 32000, "2017" => 33000, "2018" => 34000, "2019" => 35000, "2020" => 35500, "2021" => 36200, "2022" => 37000, "2023" => 37500, "2024" => 37800],
            "history_women" => ["2014" => 29500, "2015" => 30000, "2016" => 31000, "2017" => 31800, "2018" => 32500, "2019" => 33500, "2020" => 34200, "2021" => 35000, "2022" => 35800, "2023" => 36200, "2024" => 36500],
            "percentiles" => ["p10" => 30000, "p25" => 34000, "p50" => 37000, "p75" => 41000, "p90" => 45000],
            "salary_by_age" => ["18-24" => 30000, "25-34" => 35500, "35-44" => 38000, "45-54" => 39000, "55-64" => 38500, "65+" => 30000]
        ]
    ],

    // 4. Plattsättare
    [
        "category" => "Bygg & Anläggning",
        "slug" => "plattsattare",
        "title" => "Plattsättare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "plattsättare lön",
        "avg_salary" => 38500,
        "median_salary" => 38000,
        "description" => "En plattsättare klär väggar och golv med kakel, klinker eller mosaik, ofta i badrum och kök.",
        "description_extended" => "Viktigt med tätskikt (våtrum) för att undvika vattenskador. Arbetet kräver noggrannhet och sinne för mönster.",
        "education" => "Gymnasiets bygg- och anläggningsprogram eller lärling.",
        "salary_by_sector" => ["privat" => 38500],
        "pros" => ["Skapande", "Bra lön (ackord)", "Inomhusjobb", "Synligt resultat"],
        "cons" => ["Tungt för knän/rygg", "Dammigt", "Tidspress", "Exponering för fix/fogmassa"],
        "faq" => [
            ["question" => "Vad tjänar en plattsättare?", "answer" => "Snittet är ca 38 500 kr. Ackord ger möjlighet till hög lön."],
            ["question" => "Är det svårt?", "answer" => "Det krävs teknik för att få det rakt och snyggt, samt kunskap om våtrumsregler."],
            ["question" => "Jobbar man bara i badrum?", "answer" => "Mestadels ja, men även hallar, storkök och offentliga lokaler."],
            ["question" => "Vad krävs för att bli behörig?", "answer" => "GVK-certifikat eller motsvarande branschregler för våtrum."],
            ["question" => "Hur ser framtiden ut?", "answer" => "Renoveringsbehovet är stort, så jobben finns."]
        ],
        "kd" => 18, "volume" => 590,
        "scb" => [
            "ssyk_code" => "7122", "year" => 2024,
            "salary_total" => 38500, "salary_men" => 38800, "salary_women" => 37000,
            "gender_gap_percent" => 95.4, "evolution_10y_percent" => 25,
            "history" => ["2014" => 30500, "2015" => 31500, "2016" => 32500, "2017" => 33500, "2018" => 34500, "2019" => 35800, "2020" => 36500, "2021" => 37200, "2022" => 37800, "2023" => 38200, "2024" => 38500],
            "history_men" => ["2014" => 31000, "2015" => 32000, "2016" => 33000, "2017" => 34000, "2018" => 35000, "2019" => 36200, "2020" => 37000, "2021" => 37500, "2022" => 38200, "2023" => 38500, "2024" => 38800],
            "history_women" => ["2014" => 29500, "2015" => 30500, "2016" => 31200, "2017" => 32000, "2018" => 33000, "2019" => 34000, "2020" => 34800, "2021" => 35500, "2022" => 36000, "2023" => 36500, "2024" => 37000],
            "percentiles" => ["p10" => 31000, "p25" => 35000, "p50" => 38000, "p75" => 42000, "p90" => 46000],
            "salary_by_age" => ["18-24" => 31000, "25-34" => 36000, "35-44" => 39000, "45-54" => 40000, "55-64" => 39500, "65+" => 31000]
        ]
    ],

    // 5. Golvläggare
    [
        "category" => "Bygg & Anläggning",
        "slug" => "golvlaggare",
        "title" => "Golvläggare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "golvläggare lön",
        "avg_salary" => 37000,
        "median_salary" => 36500,
        "description" => "En golvläggare lägger mattor, parkett och andra golvmaterial.",
        "description_extended" => "Innefattar även underarbete som spackling och slipning. Jobbar med allt från plastmattor i badrum till trägolv i vardagsrum.",
        "education" => "Gymnasiets bygg- och anläggningsprogram eller lärling.",
        "salary_by_sector" => ["privat" => 37000],
        "pros" => ["Omväxlande material", "Inomhusjobb", "Synligt resultat", "Bra lön"],
        "cons" => ["Obekväma arbetsställningar (knän)", "Limångor (kemikalier)", "Tunga lyft", "Tidspress"],
        "faq" => [
            ["question" => "Vad tjänar en golvläggare?", "answer" => "Genomsnittet är ca 37 000 kr. Ackord är vanligt."],
            ["question" => "Är det farligt för knäna?", "answer" => "Ja, knäskydd är ett måste. Det är ett fysiskt ansträngande jobb."],
            ["question" => "Jobbar man ensam?", "answer" => "Oftast arbetar man i lag om två, men ensamarbete förekommer."],
            ["question" => "Vad är branschlegitimation?", "answer" => "Yrkesbevis som visar att du är utbildad golvläggare."],
            ["question" => "Ingår slipning?", "answer" => "Ja, golvslipning av gamla trägolv är en vanlig och dammigare uppgift."]
        ],
        "kd" => 11, "volume" => 320,
        "scb" => [
            "ssyk_code" => "7123", "year" => 2024,
            "salary_total" => 37000, "salary_men" => 37500, "salary_women" => 36000,
            "gender_gap_percent" => 96.0, "evolution_10y_percent" => 24,
            "history" => ["2014" => 29500, "2015" => 30500, "2016" => 31500, "2017" => 32500, "2018" => 33500, "2019" => 34500, "2020" => 35200, "2021" => 36000, "2022" => 36500, "2023" => 36800, "2024" => 37000],
            "history_men" => ["2014" => 30000, "2015" => 31000, "2016" => 32000, "2017" => 33000, "2018" => 34000, "2019" => 35000, "2020" => 35800, "2021" => 36500, "2022" => 37000, "2023" => 37200, "2024" => 37500],
            "history_women" => ["2014" => 28500, "2015" => 29500, "2016" => 30500, "2017" => 31500, "2018" => 32500, "2019" => 33500, "2020" => 34000, "2021" => 34800, "2022" => 35200, "2023" => 35800, "2024" => 36000],
            "percentiles" => ["p10" => 30000, "p25" => 34000, "p50" => 36500, "p75" => 40000, "p90" => 44000],
            "salary_by_age" => ["18-24" => 30000, "25-34" => 35000, "35-44" => 38000, "45-54" => 39000, "55-64" => 38500, "65+" => 29000]
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
