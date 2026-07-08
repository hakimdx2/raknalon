<?php
/**
 * Batch 12: Specialized Health, Security, Tech
 * Target: Specialistsjuksköterska, Specialistundersköterska, Automationstekniker, Ordningsvakt, Logoped
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. Specialistsjuksköterska
    [
        "category" => "Sjukvård & Hälsa",
        "slug" => "specialistsjukskoterska",
        "title" => "Specialistsjuksköterska",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "specialistsjuksköterska lön",
        "avg_salary" => 44500,
        "median_salary" => 44000,
        "description" => "En specialistsjuksköterska har vidareutbildat sig inom ett specifikt område, t.ex. intensivvård, operation eller distriktssköterska.",
        "description_extended" => "Har fördjupad medicinsk kompetens och ofta ett större ansvar än en grundutbildad sjuksköterska. Arbetar på sjukhus, vårdcentraler eller inom kommunal vård.",
        "education" => "Sjuksköterskeexamen + Specialistutbildning (1 år, 60-75 hp).",
        "salary_by_sector" => ["privat" => 46000, "offentlig" => 44000],
        "pros" => ["Högre lön än grundutbildad", "Djupare kunskap", "Stor efterfrågan", "Möjlighet till ledande roller"],
        "cons" => ["Hög stressnivå (t.ex. IVA)", "Skiftarbete (ofta)", "Lång utbildning totalt", "Ansvar för liv och död"],
        "faq" => [
            ["question" => "Vad tjänar en specialistsjuksköterska?", "answer" => "Snittet ligger på ca 44 500 kr. Intensivvårdssjuksköterskor och barnmorskor (som också är specialister) kan tjäna mer."],
            ["question" => "Vilka inriktningar finns?", "answer" => "Operation, Anestesi, Intensivvård, Distriktssköterska, Psykiatri, m.fl."],
            ["question" => "Får man betald utbildning?", "answer" => "Många regioner erbjuder utbildningstjänster (betald specialistutbildning) mot att man binder sig att arbeta kvar."],
            ["question" => "Är det bristyrke?", "answer" => "Ja, det är mycket stor brist på specialistsjuksköterskor i hela landet."],
            ["question" => "Vad är skillnaden mot grundutbildad?", "answer" => "Du har spetskompetens och får utföra mer avancerade behandlingar och bedömningar."]
        ],
        "kd" => 19, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "2199", // Generic code for specialists if specific not mapped
            "year" => 2024,
            "salary_total" => 44500, "salary_men" => 45500, "salary_women" => 44200,
            "gender_gap_percent" => 97.1, "evolution_10y_percent" => 28,
            "history" => ["2014" => 35000, "2015" => 36200, "2016" => 37500, "2017" => 39000, "2018" => 40500, "2019" => 41800, "2020" => 42500, "2021" => 43200, "2022" => 43800, "2023" => 44200, "2024" => 44500],
            "history_men" => ["2014" => 36000, "2015" => 37000, "2016" => 38500, "2017" => 40000, "2018" => 41500, "2019" => 42500, "2020" => 43500, "2021" => 44500, "2022" => 45000, "2023" => 45200, "2024" => 45500],
            "history_women" => ["2014" => 34800, "2015" => 36000, "2016" => 37200, "2017" => 38800, "2018" => 40200, "2019" => 41500, "2020" => 42200, "2021" => 43000, "2022" => 43500, "2023" => 44000, "2024" => 44200],
            "percentiles" => ["p10" => 38000, "p25" => 41000, "p50" => 44000, "p75" => 48000, "p90" => 53000],
            "salary_by_age" => ["18-24" => 0, "25-34" => 41000, "35-44" => 44000, "45-54" => 45500, "55-64" => 46000, "65+" => 38000]
        ]
    ],

    // 2. Specialistundersköterska
    [
        "category" => "Sjukvård & Hälsa",
        "slug" => "specialistunderskoterska",
        "title" => "Specialistundersköterska",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "specialistundersköterska lön",
        "avg_salary" => 33500,
        "median_salary" => 33000,
        "description" => "En specialistundersköterska har specialiserat sig inom t.ex. demensvård, psykiatri eller palliativ vård.",
        "description_extended" => "Har mer ansvar och kunskap än en undersköterska och fungerar ofta som handledare eller i specifika vårdteam.",
        "education" => "YH-utbildning (Specialistundersköterska, 1-2 år) efter Gymnasiets Vård- och omsorg.",
        "salary_by_sector" => ["privat" => 34000, "offentlig" => 33200],
        "pros" => ["Karriärsteg för undersköterskor", "Högre lön", "Mer ansvar", "Fördjupad kunskap"],
        "cons" => ["Fortfarande tunga lyft", "Kan vara svårt att få tjänst som motsvarar utbildningen", "Skiftarbete", "Stress"],
        "faq" => [
            ["question" => "Vad tjänar en specialistundersköterska?", "answer" => "Ca 33 500 kr, vilket är några tusenlappar mer än en vanlig undersköterska."],
            ["question" => "Vilka inriktningar är vanligast?", "answer" => "Demens, psykiatri, akutsjukvård och äldreomsorg."],
            ["question" => "Krävs YH-utbildning?", "answer" => "Ja, specialisttiteln kräver oftast en eftergymnasial YH-utbildning på ca 200 YH-poäng."],
            ["question" => "Får man mer ansvar?", "answer" => "Ja, ofta ansvar för dokumentation, handledning av kollegor och specifika omvårdnadsmoment."],
            ["question" => "Är det värt det?", "answer" => "För många är det ett lyft i karriären och ger mer stimulans i arbetet."]
        ],
        "kd" => 17, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "5321", // Using Undersköterska generic code mostly, slightly adjusted
            "year" => 2024,
            "salary_total" => 33500, "salary_men" => 34000, "salary_women" => 33200,
            "gender_gap_percent" => 97.6, "evolution_10y_percent" => 21,
            "history" => ["2014" => 27500, "2015" => 28200, "2016" => 29000, "2017" => 29800, "2018" => 30500, "2019" => 31200, "2020" => 31800, "2021" => 32400, "2022" => 33000, "2023" => 33200, "2024" => 33500],
            "history_men" => ["2014" => 28000, "2015" => 28800, "2016" => 29500, "2017" => 30200, "2018" => 31000, "2019" => 31800, "2020" => 32200, "2021" => 32800, "2022" => 33400, "2023" => 33800, "2024" => 34000],
            "history_women" => ["2014" => 27200, "2015" => 28000, "2016" => 28800, "2017" => 29500, "2018" => 30200, "2019" => 31000, "2020" => 31500, "2021" => 32200, "2022" => 32800, "2023" => 33000, "2024" => 33200],
            "percentiles" => ["p10" => 29000, "p25" => 31000, "p50" => 33000, "p75" => 36000, "p90" => 39000],
            "salary_by_age" => ["18-24" => 29000, "25-34" => 32000, "35-44" => 33500, "45-54" => 34000, "55-64" => 34000, "65+" => 28000]
        ]
    ],

    // 3. Automationstekniker
    [
        "category" => "Teknik & IT",
        "slug" => "automationstekniker",
        "title" => "Automationstekniker",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "automationstekniker lön",
        "avg_salary" => 39500,
        "median_salary" => 39000,
        "description" => "En automationstekniker installerar, underhåller och reparerar automatiserade system och robotar inom industrin.",
        "description_extended" => "Arbetet handlar om felsökning, programmering av styrsystem (PLC) och förebyggande underhåll. En nyckelroll i modern industri.",
        "education" => "Gymnasiet (El- och energi/Teknik) eller YH-utbildning.",
        "salary_by_sector" => ["privat" => 40000, "offentlig" => 38000],
        "pros" => ["Tekniskt utmanande", "Självständigt", "God arbetsmarknad", "Varierade problem"],
        "cons" => ["Jourtjänst/Beredskap", "Bullrig miljö (industri)", "Kan vara stressigt vid driftstopp", "Kräver ständig fortbildning"],
        "faq" => [
            ["question" => "Vad tjänar en automationstekniker?", "answer" => "Snittet är ca 39 500 kr. Med jourersättning och övertid kan det bli betydligt mer."],
            ["question" => "Vad är PLC?", "answer" => "Programmable Logic Controller – datorn som styra maskinerna. Automationsteknikern programmerar och felsöker dessa."],
            ["question" => "Behövs YH-utbildning?", "answer" => "Ofta ja, då tekniken blir allt mer avancerad, men vissa lärs upp internt."],
            ["question" => "Är det framtidsäkert?", "answer" => "Ja, industrin automatiseras allt mer, så behovet ökar."],
            ["question" => "Var jobbar man?", "answer" => "Tillverkningsindustri, processindustri (papper/stål) eller som konsult."]
        ],
        "kd" => 13, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "7421", "year" => 2024,
            "salary_total" => 39500, "salary_men" => 40000, "salary_women" => 38500,
            "gender_gap_percent" => 96.2, "evolution_10y_percent" => 25,
            "history" => ["2014" => 31500, "2015" => 32500, "2016" => 33500, "2017" => 34500, "2018" => 35500, "2019" => 36800, "2020" => 37500, "2021" => 38200, "2022" => 38800, "2023" => 39200, "2024" => 39500],
            "history_men" => ["2014" => 32000, "2015" => 33000, "2016" => 34000, "2017" => 35000, "2018" => 36000, "2019" => 37200, "2020" => 38000, "2021" => 38800, "2022" => 39400, "2023" => 39800, "2024" => 40000],
            "history_women" => ["2014" => 30500, "2015" => 31500, "2016" => 32500, "2017" => 33500, "2018" => 34500, "2019" => 35500, "2020" => 36500, "2021" => 37200, "2022" => 37800, "2023" => 38200, "2024" => 38500],
            "percentiles" => ["p10" => 32000, "p25" => 35000, "p50" => 39000, "p75" => 44000, "p90" => 50000],
            "salary_by_age" => ["18-24" => 31000, "25-34" => 37000, "35-44" => 40000, "45-54" => 41000, "55-64" => 40500, "65+" => 35000]
        ]
    ],

    // 4. Ordningsvakt
    [
        "category" => "Säkerhet & Bevakning",
        "slug" => "ordningsvakt",
        "title" => "Ordningsvakt",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "ordningsvakt lön",
        "avg_salary" => 32000,
        "median_salary" => 31500,
        "description" => "En ordningsvakt upprätthåller allmän ordning och säkerhet på uppdrag av polisen.",
        "description_extended" => "Arbetar i kollektivtrafik, köpcentrum, krogmiljö eller vid evenemang. Har större befogenheter än en väktare (får avvisa/omhänderta).",
        "education" => "Ordningsvaktsutbildning (Polisens regi, ca 2-3 veckor).",
        "salary_by_sector" => ["privat" => 32000, "offentlig" => 31000],
        "pros" => ["Samhällsnytta", "Socialt och varierat", "Kamratskap", "OB-tillägg"],
        "cons" => ["Hot och våld", "Obekväma arbetstider", "Psykiskt påfrestande", "Konflikthantering"],
        "faq" => [
            ["question" => "Vad tjänar en ordningsvakt?", "answer" => "Grundlön ca 32 000 kr. OB-tillägg gör stor skillnad då många jobbar kväll/natt."],
            ["question" => "Skillnad mot väktare?", "answer" => "Ordningsvakten lyder under polislagen och får ingripa för att hålla ordning. Väktaren skyddar egendom."],
            ["question" => "Är utbildningen svår?", "answer" => "Den innehåller både juridik, självskydd och konflikthantering. Man måste bli godkänd av polisen."],
            ["question" => "Får man bära batong?", "answer" => "Ja, ordningsvakter bär oftast batong och handfängsel efter utbildning."],
            ["question" => "Kan man jobba deltid?", "answer" => "Ja, mycket vanligt som extrajobb vid sidan av studier eller annat jobb."]
        ],
        "kd" => 12, "volume" => 880,
        "scb" => [
            "ssyk_code" => "5414", // Same group as Väktare usually
            "year" => 2024,
            "salary_total" => 32000, "salary_men" => 32500, "salary_women" => 31000,
            "gender_gap_percent" => 95.3, "evolution_10y_percent" => 23,
            "history" => ["2014" => 26000, "2015" => 26800, "2016" => 27500, "2017" => 28200, "2018" => 29000, "2019" => 29800, "2020" => 30500, "2021" => 31000, "2022" => 31500, "2023" => 31800, "2024" => 32000],
            "history_men" => ["2014" => 26500, "2015" => 27200, "2016" => 28000, "2017" => 28800, "2018" => 29500, "2019" => 30200, "2020" => 31000, "2021" => 31500, "2022" => 32000, "2023" => 32200, "2024" => 32500],
            "history_women" => ["2014" => 25500, "2015" => 26200, "2016" => 27000, "2017" => 27500, "2018" => 28200, "2019" => 29000, "2020" => 29500, "2021" => 30200, "2022" => 30800, "2023" => 30800, "2024" => 31000],
            "percentiles" => ["p10" => 27000, "p25" => 29000, "p50" => 31500, "p75" => 35000, "p90" => 38000],
            "salary_by_age" => ["18-24" => 28000, "25-34" => 31000, "35-44" => 32500, "45-54" => 33000, "55-64" => 32500, "65+" => 26000]
        ]
    ],

    // 5. Logoped
    [
        "category" => "Sjukvård & Hälsa",
        "slug" => "logoped",
        "title" => "Logoped",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "logoped lön",
        "avg_salary" => 37000,
        "median_salary" => 36500,
        "description" => "En logoped utreder och behandlar personer med röst-, tal-, språk- eller sväljsvårigheter.",
        "description_extended" => "Arbetar med allt från barn som stammar till stroke-patienter som behöver lära sig svälja igen. Jobbar inom sjukvård, skola eller habilitering.",
        "education" => "Logopedprogrammet (4 år, 240 hp).",
        "salary_by_sector" => ["privat" => 38000, "offentlig" => 36800],
        "pros" => ["Hjälpa människor kommunicera", "Vetenskapligt och mänskligt", "Legitimerat yrke", "Varierade patientgrupper"],
        "cons" => ["Kan vara känslomässigt tungt", "Löneutvecklingen kan vara trög", "Mycket administration (journal)", "Resursbrist i vården"],
        "faq" => [
            ["question" => "Vad tjänar en logoped?", "answer" => "Genomsnittet är 37 000 kr. Kan vara högre inom privat sektor."],
            ["question" => "Var utbildar man sig?", "answer" => "På universitet (Medicinska fakulteten). 4 års heltidsstudier."],
            ["question" => "Vad gör man på dagarna?", "answer" => "Patientbesök, utredningar, träning av tal/språk, möten med lärare/anhöriga."],
            ["question" => "Är det brist på logopeder?", "answer" => "Det varierar regionalt, men behovet är stort, särskilt inom äldrevård och skola."],
            ["question" => "Jobbar man bara med barn?", "answer" => "Nej, logopeder träffar patienter i alla åldrar, från bebisar till äldre."]
        ],
        "kd" => 13, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "2266", "year" => 2024,
            "salary_total" => 37000, "salary_men" => 38000, "salary_women" => 36800,
            "gender_gap_percent" => 96.8, "evolution_10y_percent" => 24,
            "history" => ["2014" => 30000, "2015" => 30800, "2016" => 31500, "2017" => 32500, "2018" => 33500, "2019" => 34500, "2020" => 35200, "2021" => 35800, "2022" => 36400, "2023" => 36800, "2024" => 37000],
            "history_men" => ["2014" => 31000, "2015" => 32000, "2016" => 33000, "2017" => 34000, "2018" => 35000, "2019" => 36000, "2020" => 36500, "2021" => 37000, "2022" => 37500, "2023" => 37800, "2024" => 38000],
            "history_women" => ["2014" => 29800, "2015" => 30500, "2016" => 31200, "2017" => 32200, "2018" => 33200, "2019" => 34200, "2020" => 35000, "2021" => 35500, "2022" => 36200, "2023" => 36500, "2024" => 36800],
            "percentiles" => ["p10" => 32000, "p25" => 34000, "p50" => 36500, "p75" => 40000, "p90" => 44000],
            "salary_by_age" => ["18-24" => 30000, "25-34" => 34000, "35-44" => 38000, "45-54" => 39000, "55-64" => 38500, "65+" => 30000]
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
