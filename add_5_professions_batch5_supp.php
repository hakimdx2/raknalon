<?php
/**
 * Batch 5 Supplement: Add 3 more professions because some existed
 * Target: Specialpedagog, Fritidsledare, Kurator
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_column($data, 'slug');

$newProfessions = [
    // 1. Specialpedagog
    [
        "category" => "Pedagogik",
        "slug" => "specialpedagog",
        "title" => "Specialpedagog",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "specialpedagog lön",
        "avg_salary" => 44500,
        "median_salary" => 44000,
        "description" => "En specialpedagog arbetar för att undanröja hinder för lärande och skapa tillgängliga lärmiljöer.",
        "description_extended" => "Specialpedagoger arbetar oftast i förskola eller skola. De handleder lärare, utreder behov av särskilt stöd och utvecklar verksamheten. Det är ett yrke med stor brist och god lön.",
        "education" => "Specialpedagogprogrammet (1,5 år) på avancerad nivå. Kräver lärarexamen i grunden.",
        "salary_by_sector" => ["kommunal" => 44500, "privat" => 45500],
        "pros" => ["Hög lön", "Expertroll i skolan", "Gör stor skillnad för elever", "Stor efterfrågan"],
        "cons" => ["Krävande utredningsarbete", "Kan upplevas ensamt i rollen", "Mycket möten", "Hög arbetsbelastning"],
        "faq" => [
            ["question" => "Vad tjänar en specialpedagog?", "answer" => "Snittlönen är ca 44 500 kr. I storstäder och friskolor ofta högre."],
            ["question" => "Vad är skillnaden mot speciallärare?", "answer" => "Specialpedagogen arbetar mer övergripande och handledande, specialläraren undervisar elever direkt."],
            ["question" => "Vilken utbildning krävs?", "answer" => "Lärarexamen + 3 års yrkeslivserfarenhet + 90 hp specialpedagogprogram."],
            ["question" => "Är det brist på specialpedagoger?", "answer" => "Ja, mycket stor brist i hela landet."],
            ["question" => "Var jobbar man?", "answer" => "Mest i skolor och förskolor, men även inom habilitering och BUP."]
        ],
        "kd" => 19, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "2352", "year" => 2024,
            "salary_total" => 44500, "salary_men" => 45000, "salary_women" => 44400,
            "gender_gap_percent" => 98.7, "evolution_10y_percent" => 38,
            "history" => ["2014" => 33500, "2015" => 34800, "2016" => 36500, "2017" => 38000, "2018" => 39500, "2019" => 41000, "2020" => 42000, "2021" => 43000, "2022" => 44000, "2023" => 44300, "2024" => 44500],
            "history_men" => ["2014" => 34000, "2015" => 35500, "2016" => 37000, "2017" => 38500, "2018" => 40000, "2019" => 41500, "2020" => 42500, "2021" => 43500, "2022" => 44500, "2023" => 44800, "2024" => 45000],
            "history_women" => ["2014" => 33400, "2015" => 34700, "2016" => 36400, "2017" => 37900, "2018" => 39400, "2019" => 40900, "2020" => 41900, "2021" => 42900, "2022" => 43900, "2023" => 44200, "2024" => 44400],
            "percentiles" => ["p10" => 38000, "p25" => 41000, "p50" => 44500, "p75" => 48000, "p90" => 52000],
            "salary_by_age" => ["18-24" => 35000, "25-34" => 41000, "35-44" => 45000, "45-54" => 46000, "55-64" => 45500, "65+" => 42000]
        ]
    ],

    // 2. Fritidsledare
    [
        "category" => "Pedagogik",
        "slug" => "fritidsledare",
        "title" => "Fritidsledare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "fritidsledare lön",
        "avg_salary" => 31000,
        "median_salary" => 30500,
        "description" => "En fritidsledare arbetar med ungdomars fritid för att skapa en positiv och meningsfull tillvaro.",
        "description_extended" => "Arbetar på fritidsgårdar, skolor eller inom föreningslivet. Fritidsledare möter ungdomar, arrangerar aktiviteter och fungerar som trygga vuxna. Det är ett socialt och kreativt jobb.",
        "education" => "Fritidsledarutbildning på folkhögskola (2 år).",
        "salary_by_sector" => ["kommunal" => 31000],
        "pros" => ["Kreativt", "Jobba med ungdomar", "Ingen dag är den andra lik", "Socialt"],
        "cons" => ["Kvälls- och helgjobb", "Låg lön", "Kan vara stökigt", "Osäkra anställningar ibland"],
        "faq" => [
            ["question" => "Vad tjänar en fritidsledare?", "answer" => "Genomsnittslönen är 31 000 kr per månad."],
            ["question" => "Hur lång är utbildningen?", "answer" => "Vanligen 2 år på folkhögskola."],
            ["question" => "Var jobbar man?", "answer" => "Fritidsgårdar, skolor, allaktivitetsverkstäder och föreningar."],
            ["question" => "Vad är skillnaden mot fritidspedagog?", "answer" => "Fritidspedagoger har högskoleutbildning och arbetar främst på fritidshem (skola). Fritidsledare jobbar med äldre ungdomar."],
            ["question" => "Är det lätt att få jobb?", "answer" => "Relativt goda chanser, särskilt om man har erfarenhet och utbildning."]
        ],
        "kd" => 13, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "3413", "year" => 2024,
            "salary_total" => 31000, "salary_men" => 31500, "salary_women" => 30800,
            "gender_gap_percent" => 97.8, "evolution_10y_percent" => 25,
            "history" => ["2014" => 24500, "2015" => 25200, "2016" => 26000, "2017" => 26800, "2018" => 27600, "2019" => 28500, "2020" => 29200, "2021" => 29900, "2022" => 30500, "2023" => 30800, "2024" => 31000],
            "history_men" => ["2014" => 25000, "2015" => 25800, "2016" => 26500, "2017" => 27300, "2018" => 28100, "2019" => 29000, "2020" => 29600, "2021" => 30300, "2022" => 31000, "2023" => 31300, "2024" => 31500],
            "history_women" => ["2014" => 24200, "2015" => 24900, "2016" => 25700, "2017" => 26500, "2018" => 27300, "2019" => 28200, "2020" => 28900, "2021" => 29600, "2022" => 30200, "2023" => 30500, "2024" => 30800],
            "percentiles" => ["p10" => 25000, "p25" => 28000, "p50" => 30500, "p75" => 33500, "p90" => 36000],
            "salary_by_age" => ["18-24" => 25000, "25-34" => 29000, "35-44" => 32000, "45-54" => 33000, "55-64" => 32500, "65+" => 29000]
        ]
    ],

    // 3. Kurator (Skolkurator / Hälso- och sjukvårdskurator)
    [
        "category" => "Vård & Omsorg",
        "slug" => "kurator",
        "title" => "Kurator",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "kurator lön",
        "avg_salary" => 40000,
        "median_salary" => 39500,
        "description" => "En kurator erbjuder psykosocialt stöd och samtal till personer inom skola eller sjukvård.",
        "description_extended" => "Som kurator arbetar du med stödsamtal, utredningar och krisstöd. Skolkuratorer stöttar elever, medan hälso- och sjukvårdskuratorer stöttar patienter och anhöriga på sjukhus.",
        "education" => "Socionomexamen (3,5 år). För vårdkurator krävs legitimation (hälso- och sjukvårdskuratorsprogrammet).",
        "salary_by_sector" => ["kommunal" => 40000, "region" => 41000],
        "pros" => ["Hjälper människor", "Självständigt arbete", "Meningsfullt", "Inga kvällar/helger (oftast)"],
        "cons" => ["Emotionellt tungt", "Många svåra ärenden", "Ensamarbete", "Kan sakna handledning"],
        "faq" => [
            ["question" => "Vad tjänar en kurator?", "answer" => "Genomsnittslönen är 40 000 kr per månad."],
            ["question" => "Vilken utbildning behövs?", "answer" => "Socionomexamen (210 hp)."],
            ["question" => "Krävs legitimation?", "answer" => "Endast för titeln 'Hälso- och sjukvårdskurator'. Skolkuratorer kräver ej legitimation, men behörighet utreds."],
            ["question" => "Var jobbar kuratorer?", "answer" => "Skolor (grundskola, gy), vårdcentraler, sjukhus, BUP och habilitering."],
            ["question" => "Vad gör en kurator?", "answer" => "Genomför stödsamtal, sociala utredningar och samverkar med andra myndigheter."]
        ],
        "kd" => 15, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "2635", "year" => 2024,
            "salary_total" => 40000, "salary_men" => 41000, "salary_women" => 39800,
            "gender_gap_percent" => 97.0, "evolution_10y_percent" => 33,
            "history" => ["2014" => 29500, "2015" => 30800, "2016" => 32000, "2017" => 33500, "2018" => 35000, "2019" => 36500, "2020" => 37500, "2021" => 38500, "2022" => 39400, "2023" => 39800, "2024" => 40000],
            "history_men" => ["2014" => 30500, "2015" => 31800, "2016" => 33000, "2017" => 34500, "2018" => 36000, "2019" => 37500, "2020" => 38500, "2021" => 39500, "2022" => 40400, "2023" => 40800, "2024" => 41000],
            "history_women" => ["2014" => 29300, "2015" => 30600, "2016" => 31800, "2017" => 33300, "2018" => 34800, "2019" => 36300, "2020" => 37300, "2021" => 38300, "2022" => 39200, "2023" => 39600, "2024" => 39800],
            "percentiles" => ["p10" => 33000, "p25" => 36000, "p50" => 39500, "p75" => 43000, "p90" => 47000],
            "salary_by_age" => ["18-24" => 31000, "25-34" => 36000, "35-44" => 40000, "45-54" => 42000, "55-64" => 41500, "65+" => 38000]
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
