<?php
/**
 * Batch 5: Add 5 more professions
 * Target: Fastighetsförvaltare, Lärare, Gymnasielärare, Stödpedagog, Snickare
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_column($data, 'slug');

$newProfessions = [
    // 1. Fastighetsförvaltare
    [
        "category" => "Fastighet & Bygg",
        "slug" => "fastighetsforvaltare",
        "title" => "Fastighetsförvaltare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "fastighetsförvaltare lön",
        "avg_salary" => 46000,
        "median_salary" => 45000,
        "description" => "En fastighetsförvaltare ansvarar för drift, ekonomi och utveckling av fastigheter.",
        "description_extended" => "Rollen innebär ansvar för hyresgäster, ekonomi och tekniskt underhåll. Fastighetsförvaltare kan arbeta på kommunala bostadsbolag eller privata fastighetsbolag.",
        "education" => "Högskoleutbildning (Fastighetsföretagande 3 år) eller YH-utbildning.",
        "salary_by_sector" => ["privat" => 47000, "kommunal" => 44000],
        "pros" => ["Varierat arbete", "Bra lön", "Kombination av teknik och ekonomi", "Social roll"],
        "cons" => ["Ansvar dygnet runt ibland", "Konflikthantering med hyresgäster", "Stressigt", "Administrativt tungt"],
        "faq" => [
            ["question" => "Vad tjänar en fastighetsförvaltare?", "answer" => "En fastighetsförvaltare tjänar i genomsnitt 46 000 kr per månad."],
            ["question" => "Vad gör en fastighetsförvaltare?", "answer" => "Ansvarar för fastigheters ekonomi, skötsel och hyresgästkontakter."],
            ["question" => "Vilken utbildning krävs?", "answer" => "Ofta högskola (180 hp) eller YH-utbildning (2 år)."],
            ["question" => "Är det brist på fastighetsförvaltare?", "answer" => "Ja, det är ett bristyrke med goda jobbchanser."],
            ["question" => "Vad är skillnaden mot fastighetsskötare?", "answer" => "Förvaltaren har ekonomiskt/administrativt ansvar, skötaren gör praktiskt underhåll."]
        ],
        "kd" => 26, "volume" => 2400,
        "scb" => [
            "ssyk_code" => "2412", "year" => 2024,
            "salary_total" => 46000, "salary_men" => 48000, "salary_women" => 44500,
            "gender_gap_percent" => 92.7, "evolution_10y_percent" => 28,
            "history" => ["2014" => 35900, "2015" => 37000, "2016" => 38200, "2017" => 39500, "2018" => 41000, "2019" => 42500, "2020" => 43500, "2021" => 44500, "2022" => 45200, "2023" => 45800, "2024" => 46000],
            "history_men" => ["2014" => 37500, "2015" => 38800, "2016" => 40000, "2017" => 41500, "2018" => 43000, "2019" => 44500, "2020" => 45500, "2021" => 46500, "2022" => 47200, "2023" => 47800, "2024" => 48000],
            "history_women" => ["2014" => 34000, "2015" => 35000, "2016" => 36000, "2017" => 37200, "2018" => 38500, "2019" => 39800, "2020" => 40800, "2021" => 41800, "2022" => 42500, "2023" => 43500, "2024" => 44500],
            "percentiles" => ["p10" => 35000, "p25" => 40000, "p50" => 45000, "p75" => 52000, "p90" => 60000],
            "salary_by_age" => ["18-24" => 32000, "25-34" => 40000, "35-44" => 46000, "45-54" => 49000, "55-64" => 48000, "65+" => 42000]
        ]
    ],

    // 2. Lärare (Grundskollärare/Allmänt)
    [
        "category" => "Pedagogik",
        "slug" => "larare",
        "title" => "Lärare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "lärare lön",
        "avg_salary" => 40500,
        "median_salary" => 39800,
        "description" => "En lärare undervisar elever i grundskolan och ansvarar för deras lärande och utveckling.",
        "description_extended" => "Lärare arbetar i kommunala eller fristående skolor. Arbetet kräver legitimation. Lönen har ökat kraftigt de senaste åren tack vare lärarlyftet.",
        "education" => "Ämneslärar- eller grundlärarprogrammet (4-5,5 år) + legitimation.",
        "salary_by_sector" => ["kommunal" => 40500, "privat" => 41500],
        "pros" => ["Viktigt samhällsuppdrag", "Lång semester (ferietjänst)", "Goda jobbchanser", "Kreativt"],
        "cons" => ["Hög arbetsbelastning", "Stressig miljö", "Administrativt tungt", "Svåra elevärenden"],
        "faq" => [
            ["question" => "Vad tjänar en lärare?", "answer" => "Genomsnittslönen för en grundskollärare är 40 500 kr."],
            ["question" => "Hur lång semester har en lärare?", "answer" => "Lärare med ferietjänst har ca 13 veckors ledighet, men arbetar 45h/vecka under terminerna."],
            ["question" => "Krävs legitimation?", "answer" => "Ja, för att få sätta betyg och få fast anställning krävs lärarlegitimation."],
            ["question" => "Är det brist på lärare?", "answer" => "Ja, det är stor brist på behöriga lärare."],
            ["question" => "Vad påverkar lönen?", "answer" => "Erfarenhet, ämneskombination och om man är förstelärare höjer lönen."]
        ],
        "kd" => 23, "volume" => 2900,
        "scb" => [
            "ssyk_code" => "2341", "year" => 2024,
            "salary_total" => 40500, "salary_men" => 41000, "salary_women" => 40200,
            "gender_gap_percent" => 98.0, "evolution_10y_percent" => 35,
            "history" => ["2014" => 29800, "2015" => 31000, "2016" => 32500, "2017" => 34000, "2018" => 35500, "2019" => 37000, "2020" => 38000, "2021" => 39000, "2022" => 39800, "2023" => 40200, "2024" => 40500],
            "history_men" => ["2014" => 30200, "2015" => 31400, "2016" => 32800, "2017" => 34400, "2018" => 35900, "2019" => 37400, "2020" => 38400, "2021" => 39400, "2022" => 40200, "2023" => 40600, "2024" => 41000],
            "history_women" => ["2014" => 29400, "2015" => 30600, "2016" => 32200, "2017" => 33600, "2018" => 35100, "2019" => 36600, "2020" => 37600, "2021" => 38600, "2022" => 39400, "2023" => 39800, "2024" => 40200],
            "percentiles" => ["p10" => 33000, "p25" => 37000, "p50" => 40000, "p75" => 44000, "p90" => 48000],
            "salary_by_age" => ["18-24" => 32000, "25-34" => 37000, "35-44" => 41000, "45-54" => 43000, "55-64" => 42000, "65+" => 38000]
        ]
    ],

    // 3. Gymnasielärare
    [
        "category" => "Pedagogik",
        "slug" => "gymnasielarare",
        "title" => "Gymnasielärare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "gymnasielärare lön",
        "avg_salary" => 43500,
        "median_salary" => 43000,
        "description" => "En gymnasielärare undervisar ungdomar på gymnasiet i specifika ämnen som man är behörig i.",
        "description_extended" => "Gymnasielärare har djupare ämneskunskaper än grundskollärare. De arbetar med ungdomar i åldern 16-19 år. Förstelärare kan tjäna betydligt mer.",
        "education" => "Ämneslärarprogrammet mot gymnasiet (5-5,5 år) + legitimation.",
        "salary_by_sector" => ["kommunal" => 43500, "privat" => 44500],
        "pros" => ["Avancerad nivå", "Arbeta med ungdomar", "God lön", "Ferietjänst"],
        "cons" => ["Stora klasser", "Rättningsbörda", "Tonårsproblematik", "Hög stress"],
        "faq" => [
            ["question" => "Vad tjänar en gymnasielärare?", "answer" => "Snittlönen ligger på 43 500 kr/månad."],
            ["question" => "Hur blir man gymnasielärare?", "answer" => "Genom ämneslärarprogrammet på universitetet, 300-330 hp."],
            ["question" => "Vilka ämnen ger högst lön?", "answer" => "Matematik, NO-ämnen och moderna språk är ofta bristyrken med chans till högre lön."],
            ["question" => "Kan man jobba utan legitimation?", "answer" => "Ja, men bara tidsbegränsat och man får inte sätta betyg."],
            ["question" => "Vad är skillnaden mot grundskollärare?", "answer" => "Djupare ämneskunskaper och äldre elever."]
        ],
        "kd" => 23, "volume" => 1900,
        "scb" => [
            "ssyk_code" => "2330", "year" => 2024,
            "salary_total" => 43500, "salary_men" => 44500, "salary_women" => 43000,
            "gender_gap_percent" => 96.6, "evolution_10y_percent" => 33,
            "history" => ["2014" => 32500, "2015" => 33800, "2016" => 35200, "2017" => 36800, "2018" => 38500, "2019" => 40000, "2020" => 41000, "2021" => 42000, "2022" => 43000, "2023" => 43400, "2024" => 43500],
            "history_men" => ["2014" => 33000, "2015" => 34400, "2016" => 35900, "2017" => 37500, "2018" => 39200, "2019" => 40800, "2020" => 41800, "2021" => 42800, "2022" => 43800, "2023" => 44200, "2024" => 44500],
            "history_women" => ["2014" => 32000, "2015" => 33200, "2016" => 34500, "2017" => 36100, "2018" => 37800, "2019" => 39200, "2020" => 40200, "2021" => 41200, "2022" => 42200, "2023" => 42600, "2024" => 43000],
            "percentiles" => ["p10" => 36000, "p25" => 40000, "p50" => 43000, "p75" => 47000, "p90" => 52000],
            "salary_by_age" => ["18-24" => 34000, "25-34" => 39000, "35-44" => 44000, "45-54" => 46000, "55-64" => 45000, "65+" => 40000]
        ]
    ],

    // 4. Stödpedagog
    [
        "category" => "Vård & Omsorg",
        "slug" => "stodpedagog",
        "title" => "Stödpedagog",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "stödpedagog lön",
        "avg_salary" => 33000,
        "median_salary" => 32500,
        "description" => "En stödpedagog arbetar med personer med funktionsnedsättning för att skapa en meningsfull vardag och främja självständighet.",
        "description_extended" => "Arbetar ofta inom LSS-verksamhet, daglig verksamhet eller gruppbostäder. Stödpedagogen har en mer avancerad roll än stödassistenten och ansvarar för pedagogiska metoder.",
        "education" => "YH-utbildning till stödpedagog (1-2 år).",
        "salary_by_sector" => ["kommunal" => 33000],
        "pros" => ["Gör skillnad", "Mer ansvar än assistent", "Pedagogiskt fokus", "Hög efterfrågan"],
        "cons" => ["Kan vara psykiskt krävande", "Obekväma arbetstider", "Relativt låg lön", "Tung arbetsbelastning"],
        "faq" => [
            ["question" => "Vad tjänar en stödpedagog?", "answer" => "En stödpedagog tjänar ca 33 000 kr/månad."],
            ["question" => "Vad är skillnaden mot stödassistent?", "answer" => "Stödpedagogen har högre utbildning och ansvar för det pedagogiska arbetet och dokumentation."],
            ["question" => "Vilken utbildning krävs?", "answer" => "Yrkeshögskoleutbildning (YH) på ca 200 poäng."],
            ["question" => "Var arbetar man?", "answer" => "Inom LSS, gruppbostäder, daglig verksamhet eller psykiatri."],
            ["question" => "Behövs legitimation?", "answer" => "Nej, ingen legitimation krävs."]
        ],
        "kd" => 13, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "2359", "year" => 2024,
            "salary_total" => 33000, "salary_men" => 33500, "salary_women" => 32800,
            "gender_gap_percent" => 97.9, "evolution_10y_percent" => 25,
            "history" => ["2014" => 26400, "2015" => 27000, "2016" => 27800, "2017" => 28500, "2018" => 29200, "2019" => 30000, "2020" => 30800, "2021" => 31500, "2022" => 32200, "2023" => 32600, "2024" => 33000],
            "history_men" => ["2014" => 26800, "2015" => 27400, "2016" => 28200, "2017" => 29000, "2018" => 29800, "2019" => 30500, "2020" => 31300, "2021" => 32000, "2022" => 32800, "2023" => 33200, "2024" => 33500],
            "history_women" => ["2014" => 26300, "2015" => 26900, "2016" => 27600, "2017" => 28400, "2018" => 29000, "2019" => 29800, "2020" => 30600, "2021" => 31300, "2022" => 32000, "2023" => 32400, "2024" => 32800],
            "percentiles" => ["p10" => 28000, "p25" => 30500, "p50" => 32500, "p75" => 35000, "p90" => 38000],
            "salary_by_age" => ["18-24" => 27000, "25-34" => 31000, "35-44" => 33500, "45-54" => 34500, "55-64" => 33500, "65+" => 31000]
        ]
    ],

    // 5. Snickare (Träarbetare)
    [
        "category" => "Fastighet & Bygg",
        "slug" => "snickare",
        "title" => "Snickare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "snickare lön",
        "avg_salary" => 36500,
        "median_salary" => 36000,
        "description" => "En snickare (träarbetare) bygger och reparerar hus, inredning och träkonstruktioner.",
        "description_extended" => "Snickare arbetar på byggarbetsplatser med allt från stomresning till finsnickeri. Yrket är fysiskt och kräver händighet. Lönen stiger med yrkesbevis och erfarenhet.",
        "education" => "Bygg- och anläggningsprogrammet på gymnasiet + lärlingstid (ca 2,5 år) för yrkesbevis.",
        "salary_by_sector" => ["privat" => 36500],
        "pros" => ["Praktiskt arbete", "Ser resultat direkt", "Bra lön efter lärlingstid", "Kamratskap"],
        "cons" => ["Tungt arbete", "Slitigt för kroppen", "Väderberoende", "Risk för skador"],
        "faq" => [
            ["question" => "Vad tjänar en snickare?", "answer" => "En färdigutbildad snickare tjänar i snitt 36 500 kr. Ackordsarbete kan ge högre lön."],
            ["question" => "Hur blir man snickare?", "answer" => "Gymnasieutbildning följt av lärlingstid, eller vuxenutbildning."],
            ["question" => "Vad är yrkesbevis?", "answer" => "Ett bevis på att du genomfört utbildning och lärlingstid och är fullbetald hantverkare."],
            ["question" => "Finns det jobb?", "answer" => "Ja, byggbranschen behöver ofta folk, men det kan variera med konjunkturen."],
            ["question" => "Vad gör en inredningssnickare?", "answer" => "Fokuserar på möbler och detaljer inomhus, till skillnad från byggsnickare."]
        ],
        "kd" => 23, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "7111", "year" => 2024,
            "salary_total" => 36500, "salary_men" => 36700, "salary_women" => 34000,
            "gender_gap_percent" => 92.6, "evolution_10y_percent" => 26,
            "history" => ["2014" => 28900, "2015" => 29600, "2016" => 30500, "2017" => 31400, "2018" => 32300, "2019" => 33200, "2020" => 34000, "2021" => 34800, "2022" => 35600, "2023" => 36000, "2024" => 36500],
            "history_men" => ["2014" => 29000, "2015" => 29800, "2016" => 30700, "2017" => 31600, "2018" => 32500, "2019" => 33400, "2020" => 34200, "2021" => 35000, "2022" => 35800, "2023" => 36200, "2024" => 36700],
            "history_women" => ["2014" => 27000, "2015" => 27800, "2016" => 28500, "2017" => 29200, "2018" => 30000, "2019" => 31000, "2020" => 31800, "2021" => 32500, "2022" => 33200, "2023" => 33600, "2024" => 34000],
            "percentiles" => ["p10" => 30000, "p25" => 33500, "p50" => 36000, "p75" => 39500, "p90" => 44000],
            "salary_by_age" => ["18-24" => 29000, "25-34" => 35000, "35-44" => 37000, "45-54" => 38000, "55-64" => 37000, "65+" => 34000]
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
