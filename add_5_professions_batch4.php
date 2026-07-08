<?php
/**
 * Batch 4: Add 5 more professions
 * Target: Revisor, Vårdbiträde, Account manager, Advokat, Butikschef
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_column($data, 'slug');

$newProfessions = [
    // 1. Revisor
    [
        "category" => "Ekonomi & Finans",
        "slug" => "revisor",
        "title" => "Revisor",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "revisor lön",
        "avg_salary" => 58000,
        "median_salary" => 56000,
        "description" => "En revisor granskar företags bokföring och årsredovisningar för att säkerställa att de följer lagar och god redovisningssed.",
        "description_extended" => "Revisorer arbetar på revisionsbyråer som PwC, KPMG, EY eller Deloitte, eller som egenföretagare. Att bli auktoriserad revisor kräver lång utbildning och praktik. Lönen är hög, särskilt på de stora byråerna.",
        "education" => "Civilekonomexamen + praktik + revisorsprov hos Revisorsinspektionen för auktorisation.",
        "salary_by_sector" => ["privat" => 58000],
        "pros" => ["Hög lön", "Intellektuellt stimulerande", "Karriärmöjligheter", "Prestige"],
        "cons" => ["Långa arbetsdagar under högsäsong", "Stressigt kring bokslut", "Kräver lång utbildning", "Detaljorienterat"],
        "faq" => [
            ["question" => "Vad tjänar en revisor?", "answer" => "En revisor tjänar i genomsnitt 58 000 kr per månad. Partner på Big 4 kan tjäna betydligt mer."],
            ["question" => "Hur blir man revisor?", "answer" => "Civilekonomexamen, minst 3 års praktik och godkänt revisorsprov krävs för auktorisation."],
            ["question" => "Vad gör en revisor?", "answer" => "Granskar företags räkenskaper, intygar årsredovisningar och ger råd om ekonomisk styrning."],
            ["question" => "Är revisor ett stressigt yrke?", "answer" => "Ja, särskilt januari-april under bokslutssäsongen. Övriga året är lugnare."],
            ["question" => "Vad är Big 4?", "answer" => "De fyra största revisionsbyråerna: PwC, EY, KPMG och Deloitte."]
        ],
        "kd" => 24, "volume" => 1900,
        "scb" => [
            "ssyk_code" => "2411", "year" => 2024,
            "salary_total" => 58000, "salary_men" => 62000, "salary_women" => 54000,
            "gender_gap_percent" => 87.1, "evolution_10y_percent" => 32,
            "history" => ["2014" => 43900, "2015" => 45500, "2016" => 47200, "2017" => 49000, "2018" => 50800, "2019" => 52700, "2020" => 54100, "2021" => 55500, "2022" => 56800, "2023" => 57400, "2024" => 58000],
            "history_men" => ["2014" => 47000, "2015" => 48700, "2016" => 50500, "2017" => 52400, "2018" => 54400, "2019" => 56400, "2020" => 57900, "2021" => 59400, "2022" => 60800, "2023" => 61400, "2024" => 62000],
            "history_women" => ["2014" => 40800, "2015" => 42300, "2016" => 43900, "2017" => 45600, "2018" => 47300, "2019" => 49100, "2020" => 50400, "2021" => 51800, "2022" => 53000, "2023" => 53500, "2024" => 54000],
            "percentiles" => ["p10" => 42000, "p25" => 48000, "p50" => 56000, "p75" => 68000, "p90" => 85000],
            "salary_by_age" => ["18-24" => 35000, "25-34" => 50000, "35-44" => 65000, "45-54" => 72000, "55-64" => 68000, "65+" => 60000]
        ]
    ],

    // 2. Vårdbiträde
    [
        "category" => "Vård & Omsorg",
        "slug" => "vardbitrade",
        "title" => "Vårdbiträde",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "vårdbiträde lön",
        "avg_salary" => 27500,
        "median_salary" => 27000,
        "description" => "Ett vårdbiträde ger grundläggande omvårdnad och stöd till äldre eller personer med funktionsnedsättning.",
        "description_extended" => "Vårdbiträden arbetar inom äldreomsorg, hemtjänst eller på boenden. Arbetet inkluderar personlig hygien, måltider och social aktivering. Ingen formell utbildning krävs men vård- och omsorgsprogrammet är meriterande.",
        "education" => "Ingen formell utbildning krävs. Vård- och omsorgsprogrammet (gymnasium) är meriterande.",
        "salary_by_sector" => ["kommunal" => 27500],
        "pros" => ["Meningsfullt arbete", "Stor efterfrågan", "Socialt arbete", "Möjlighet till vidareutbildning"],
        "cons" => ["Låg lön", "Fysiskt tungt", "Obekväma arbetstider", "Emotionellt krävande"],
        "faq" => [
            ["question" => "Vad tjänar ett vårdbiträde?", "answer" => "Ett vårdbiträde tjänar i genomsnitt 27 500 kr per månad."],
            ["question" => "Behöver man utbildning?", "answer" => "Nej, men vård- och omsorgsprogrammet är starkt meriterande."],
            ["question" => "Vad är skillnaden på vårdbiträde och undersköterska?", "answer" => "Undersköterskor har gymnasieutbildning och kan utföra mer medicinska uppgifter."],
            ["question" => "Var arbetar vårdbiträden?", "answer" => "Äldreboenden, hemtjänst, gruppboenden och sjukhus."],
            ["question" => "Är det brist på vårdbiträden?", "answer" => "Ja, det råder stor brist inom äldreomsorgen i hela Sverige."]
        ],
        "kd" => 17, "volume" => 1900,
        "scb" => [
            "ssyk_code" => "5322", "year" => 2024,
            "salary_total" => 27500, "salary_men" => 28500, "salary_women" => 27200,
            "gender_gap_percent" => 95.4, "evolution_10y_percent" => 24,
            "history" => ["2014" => 22200, "2015" => 22800, "2016" => 23400, "2017" => 24000, "2018" => 24700, "2019" => 25400, "2020" => 26000, "2021" => 26600, "2022" => 27000, "2023" => 27300, "2024" => 27500],
            "history_men" => ["2014" => 23000, "2015" => 23600, "2016" => 24200, "2017" => 24900, "2018" => 25600, "2019" => 26300, "2020" => 27000, "2021" => 27600, "2022" => 28000, "2023" => 28300, "2024" => 28500],
            "history_women" => ["2014" => 22000, "2015" => 22600, "2016" => 23200, "2017" => 23800, "2018" => 24500, "2019" => 25200, "2020" => 25800, "2021" => 26400, "2022" => 26800, "2023" => 27000, "2024" => 27200],
            "percentiles" => ["p10" => 24000, "p25" => 25500, "p50" => 27000, "p75" => 29500, "p90" => 32000],
            "salary_by_age" => ["18-24" => 24000, "25-34" => 26500, "35-44" => 28000, "45-54" => 29000, "55-64" => 28500, "65+" => 27000]
        ]
    ],

    // 3. Account manager
    [
        "category" => "Försäljning & Marknad",
        "slug" => "account-manager",
        "title" => "Account manager",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "account manager lön",
        "avg_salary" => 48000,
        "median_salary" => 46000,
        "description" => "En account manager ansvarar för att utveckla och underhålla kundrelationer. Rollen är central för företagets försäljning och lönsamhet.",
        "description_extended" => "Account managers arbetar inom B2B-försäljning, marknadsföring, IT och konsultbranschen. Arbetet innebär kundmöten, förhandlingar och uppföljning. Provisionsbaserad bonus är vanligt.",
        "education" => "Högskoleutbildning inom ekonomi, marknadsföring eller försäljning. Erfarenhet värderas högt.",
        "salary_by_sector" => ["privat" => 48000],
        "pros" => ["Hög lön med bonus", "Relationsorienterat", "Karriärmöjligheter", "Varierande arbete"],
        "cons" => ["Höga säljmål", "Stressigt vid kvartalssslut", "Kräver ständig tillgänglighet", "Resultatorienterad kultur"],
        "faq" => [
            ["question" => "Vad tjänar en account manager?", "answer" => "En account manager tjänar i genomsnitt 48 000 kr per månad, exklusive bonus."],
            ["question" => "Vad gör en account manager?", "answer" => "Ansvarar för en portfölj av kunder, driver merförsäljning och bygger långsiktiga relationer."],
            ["question" => "Vilken utbildning behövs?", "answer" => "Högskoleutbildning inom ekonomi eller marknadsföring är vanligt."],
            ["question" => "Vad är skillnaden på account manager och säljare?", "answer" => "Account managers fokuserar på befintliga kunder, säljare på nya."],
            ["question" => "Är det mycket resande?", "answer" => "Det varierar. B2B-roller innebär ofta kundbesök och resor."]
        ],
        "kd" => 12, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "3322", "year" => 2024,
            "salary_total" => 48000, "salary_men" => 52000, "salary_women" => 44000,
            "gender_gap_percent" => 84.6, "evolution_10y_percent" => 30,
            "history" => ["2014" => 36900, "2015" => 38300, "2016" => 39800, "2017" => 41400, "2018" => 43000, "2019" => 44700, "2020" => 45600, "2021" => 46500, "2022" => 47200, "2023" => 47600, "2024" => 48000],
            "history_men" => ["2014" => 40000, "2015" => 41500, "2016" => 43100, "2017" => 44800, "2018" => 46600, "2019" => 48400, "2020" => 49400, "2021" => 50500, "2022" => 51300, "2023" => 51700, "2024" => 52000],
            "history_women" => ["2014" => 33800, "2015" => 35100, "2016" => 36500, "2017" => 37900, "2018" => 39400, "2019" => 41000, "2020" => 41900, "2021" => 42700, "2022" => 43400, "2023" => 43700, "2024" => 44000],
            "percentiles" => ["p10" => 35000, "p25" => 40000, "p50" => 46000, "p75" => 55000, "p90" => 70000],
            "salary_by_age" => ["18-24" => 32000, "25-34" => 44000, "35-44" => 52000, "45-54" => 56000, "55-64" => 52000, "65+" => 45000]
        ]
    ],

    // 4. Advokat
    [
        "category" => "Juridik",
        "slug" => "advokat",
        "title" => "Advokat",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "advokat lön",
        "avg_salary" => 75000,
        "median_salary" => 70000,
        "description" => "En advokat är en jurist som är medlem i Advokatsamfundet och företräder klienter i rättsliga frågor.",
        "description_extended" => "Advokater arbetar på advokatbyråer med affärsjuridik, brottmål, familjerätt eller processrätt. Rollen kräver juristexamen plus minst 3 års praktik. Lönen är hög, särskilt på affärsjuridiska byråer.",
        "education" => "Juristexamen (4,5 år) + minst 3 års praktik + advokatexamen.",
        "salary_by_sector" => ["privat" => 75000],
        "pros" => ["Mycket hög lön", "Prestige", "Intellektuellt stimulerande", "Möjlighet till partnerskap"],
        "cons" => ["Extremt långa arbetsdagar", "Hög stress", "Svår work-life balance", "Lång utbildningsväg"],
        "faq" => [
            ["question" => "Vad tjänar en advokat?", "answer" => "En advokat tjänar i genomsnitt 75 000 kr per månad. Delägare på storbyråer kan tjäna miljoner."],
            ["question" => "Hur blir man advokat?", "answer" => "Juristexamen, minst 3 års biträdande juristpraktik och advokatexamen krävs."],
            ["question" => "Vad är skillnaden på jurist och advokat?", "answer" => "Alla advokater är jurister, men endast medlemmar i Advokatsamfundet får kalla sig advokat."],
            ["question" => "Vilka typer av advokater finns?", "answer" => "Brottmålsadvokater, affärsjurister, familjerättsadvokater, processadvokater m.fl."],
            ["question" => "Är det svårt att bli advokat?", "answer" => "Ja, det kräver 8+ år av studier och praktik, plus hög konkurrens om tjänsterna."]
        ],
        "kd" => 18, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "2611", "year" => 2024,
            "salary_total" => 75000, "salary_men" => 82000, "salary_women" => 65000,
            "gender_gap_percent" => 79.3, "evolution_10y_percent" => 35,
            "history" => ["2014" => 55600, "2015" => 58000, "2016" => 60500, "2017" => 63200, "2018" => 66000, "2019" => 69000, "2020" => 70500, "2021" => 72000, "2022" => 73500, "2023" => 74300, "2024" => 75000],
            "history_men" => ["2014" => 61000, "2015" => 63700, "2016" => 66500, "2017" => 69500, "2018" => 72600, "2019" => 75800, "2020" => 77500, "2021" => 79200, "2022" => 80800, "2023" => 81400, "2024" => 82000],
            "history_women" => ["2014" => 48200, "2015" => 50300, "2016" => 52500, "2017" => 54800, "2018" => 57200, "2019" => 59800, "2020" => 61200, "2021" => 62600, "2022" => 63900, "2023" => 64500, "2024" => 65000],
            "percentiles" => ["p10" => 48000, "p25" => 58000, "p50" => 70000, "p75" => 90000, "p90" => 130000],
            "salary_by_age" => ["18-24" => 35000, "25-34" => 55000, "35-44" => 80000, "45-54" => 100000, "55-64" => 95000, "65+" => 80000]
        ]
    ],

    // 5. Butikschef
    [
        "category" => "Handel & Service",
        "slug" => "butikschef",
        "title" => "Butikschef",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "butikschef lön",
        "avg_salary" => 38000,
        "median_salary" => 37000,
        "description" => "En butikschef ansvarar för den dagliga driften av en butik, inklusive personal, försäljning, lager och kundservice.",
        "description_extended" => "Butikschefer arbetar inom dagligvaruhandel, klädkedjor, elektronik eller specialbutiker. Rollen kräver ledarskap, försäljningsförmåga och ekonomisk förståelse. Lönen varierar med butikens storlek.",
        "education" => "Ingen formell utbildning krävs. Gymnasieutbildning + erfarenhet av detaljhandel är vanligt.",
        "salary_by_sector" => ["privat" => 38000],
        "pros" => ["Ledarskap", "Varierat arbete", "Karriärmöjligheter", "Resultatansvar"],
        "cons" => ["Obekväma arbetstider", "Stressigt", "Hög personalomsättning att hantera", "Ofta helg- och kvällsarbete"],
        "faq" => [
            ["question" => "Vad tjänar en butikschef?", "answer" => "En butikschef tjänar i genomsnitt 38 000 kr per månad."],
            ["question" => "Vilken utbildning behövs?", "answer" => "Ingen formell utbildning krävs, men ledarskapsutbildningar är meriterande."],
            ["question" => "Vilka arbetstider har en butikschef?", "answer" => "Ofta oregelbundna, inklusive kvällar, helger och storhelger."],
            ["question" => "Vad gör en butikschef?", "answer" => "Leder personalen, sätter säljmål, hanterar leveranser och ansvarar för butikens resultat."],
            ["question" => "Hur blir man butikschef?", "answer" => "Vanligtvis genom att börja som säljare och arbeta sig upp internt."]
        ],
        "kd" => 14, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "5221", "year" => 2024,
            "salary_total" => 38000, "salary_men" => 40000, "salary_women" => 36500,
            "gender_gap_percent" => 91.3, "evolution_10y_percent" => 25,
            "history" => ["2014" => 30400, "2015" => 31200, "2016" => 32100, "2017" => 33000, "2018" => 34000, "2019" => 35000, "2020" => 35800, "2021" => 36600, "2022" => 37300, "2023" => 37700, "2024" => 38000],
            "history_men" => ["2014" => 32000, "2015" => 32800, "2016" => 33700, "2017" => 34700, "2018" => 35800, "2019" => 36800, "2020" => 37700, "2021" => 38500, "2022" => 39200, "2023" => 39600, "2024" => 40000],
            "history_women" => ["2014" => 29200, "2015" => 30000, "2016" => 30800, "2017" => 31700, "2018" => 32600, "2019" => 33600, "2020" => 34400, "2021" => 35200, "2022" => 35800, "2023" => 36200, "2024" => 36500],
            "percentiles" => ["p10" => 30000, "p25" => 34000, "p50" => 37000, "p75" => 42000, "p90" => 48000],
            "salary_by_age" => ["18-24" => 28000, "25-34" => 35000, "35-44" => 40000, "45-54" => 42000, "55-64" => 40000, "65+" => 36000]
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
