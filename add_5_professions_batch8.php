<?php
/**
 * Batch 8: Add 5 more professions (High Volume Missed)
 * Target: Jurist, Key Account Manager, Redovisningskonsult, Ekonom, Rekryterare
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. Jurist
    [
        "category" => "Juridik",
        "slug" => "jurist",
        "title" => "Jurist",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "jurist lön",
        "avg_salary" => 46000,
        "median_salary" => 45000,
        "description" => "En jurist är expert på lagar och avtal och hjälper företag, myndigheter eller privatpersoner med juridiska frågor.",
        "description_extended" => "Jurister kan arbeta som bolagsjurister, myndighetsjurister eller på byrå. Skillnaden mot advokat är att 'jurist' inte är en skyddad titel, men utbildningen är densamma.",
        "education" => "Juristexamen (4,5 år, 270 hp).",
        "salary_by_sector" => ["privat" => 49000, "offentlig" => 43000],
        "pros" => ["Hög lönepotential", "Intellektuellt utmanande", "Bred arbetsmarknad", "Samhällsviktigt"],
        "cons" => ["Lång utbildning", "Hög konkurrens i populära sektorer", "Ofta högt arbetstempo", "Detaljstyrt"],
        "faq" => [
            ["question" => "Vad tjänar en jurist?", "answer" => "Snittlönen är ca 46 000 kr. Bolagsjurister i privat sektor tjänar ofta mer (60 000+)."],
            ["question" => "Vad är skillnaden på jurist och advokat?", "answer" => "En advokat är ledamot i Advokatsamfundet, vilket kräver extra praktik och examen. Jurist är grundtiteln."],
            ["question" => "Var kan man jobba?", "answer" => "Kommuner, statliga verk, banker, försäkringsbolag och juridiska byråer."],
            ["question" => "Vad gör en jurist?", "answer" => "Upprättar avtal, tolkar lagar, ger rådgivning och förhandlar."],
            ["question" => "Är det svårt att bli jurist?", "answer" => "Juristprogrammet har höga antagningspoäng och utbildningen är krävande."]
        ],
        "kd" => 15, "volume" => 1900,
        "scb" => [
            "ssyk_code" => "2611", "year" => 2024,
            "salary_total" => 46000, "salary_men" => 48000, "salary_women" => 44500,
            "gender_gap_percent" => 92.7, "evolution_10y_percent" => 25,
            "history" => ["2014" => 36500, "2015" => 37500, "2016" => 38500, "2017" => 40000, "2018" => 41500, "2019" => 43000, "2020" => 44000, "2021" => 44800, "2022" => 45500, "2023" => 45800, "2024" => 46000],
            "history_men" => ["2014" => 38000, "2015" => 39000, "2016" => 40500, "2017" => 42000, "2018" => 43500, "2019" => 45000, "2020" => 46000, "2021" => 47000, "2022" => 47500, "2023" => 47800, "2024" => 48000],
            "history_women" => ["2014" => 35000, "2015" => 36000, "2016" => 37000, "2017" => 38500, "2018" => 39500, "2019" => 41000, "2020" => 42000, "2021" => 43000, "2022" => 44000, "2023" => 44200, "2024" => 44500],
            "percentiles" => ["p10" => 34000, "p25" => 39000, "p50" => 45000, "p75" => 54000, "p90" => 65000],
            "salary_by_age" => ["18-24" => 32000, "25-34" => 41000, "35-44" => 50000, "45-54" => 55000, "55-64" => 54000, "65+" => 48000]
        ]
    ],

    // 2. Key Account Manager (KAM)
    [
        "category" => "Försäljning & Marknad",
        "slug" => "key-account-manager",
        "title" => "Key Account Manager",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "key account manager lön",
        "avg_salary" => 58000,
        "median_salary" => 56000,
        "description" => "En Key Account Manager (KAM) ansvarar för företagets viktigaste nyckelkunder och strategiska samarbeten.",
        "description_extended" => "Detta är en senior säljroll. En KAM bygger långsiktiga relationer, förhandlar stora avtal och säkerställer kundnöjdhet. Lönen har ofta en stor rörlig del.",
        "education" => "Högskola (Ekonomi/Marknad) eller IHM Business School.",
        "salary_by_sector" => ["privat" => 58000],
        "pros" => ["Hög lön och bonus", "Stort ansvar", "Resor och nätverkande", "Strategiskt arbete"],
        "cons" => ["Hög prestationspress", "Långa säljcykler", "Resande kan vara slitigt", "Resultatbaserad trygghet"],
        "faq" => [
            ["question" => "Vad tjänar en Key Account Manager?", "answer" => "Genomsnittet är 58 000 kr, men toppresterare kan tjäna över 80 000 kr inklusive bonus."],
            ["question" => "Vad är skillnaden mot Account Manager?", "answer" => "KAM arbetar med färre men viktigare kunder (Nyckelkunder) på en mer strategisk nivå."],
            ["question" => "Vilka egenskaper krävs?", "answer" => "Affärsmannaskap, relationsbyggande, förhandlingsteknik och tålamod."],
            ["question" => "Var jobbar man?", "answer" => "Inom B2B (Business to Business), IT, industri, läkemedel och media."],
            ["question" => "Krävs utbildning?", "answer" => "Både ja och nej. Erfarenhet väger ofta tyngre än utbildning i säljroller."]
        ],
        "kd" => 10, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "3322", "year" => 2024,
            "salary_total" => 58000, "salary_men" => 62000, "salary_women" => 54000,
            "gender_gap_percent" => 87.1, "evolution_10y_percent" => 33,
            "history" => ["2014" => 43500, "2015" => 45000, "2016" => 47000, "2017" => 49000, "2018" => 51000, "2019" => 53000, "2020" => 54500, "2021" => 56000, "2022" => 57000, "2023" => 57500, "2024" => 58000],
            "history_men" => ["2014" => 46000, "2015" => 47500, "2016" => 50000, "2017" => 52000, "2018" => 54000, "2019" => 56000, "2020" => 58000, "2021" => 60000, "2022" => 61000, "2023" => 61500, "2024" => 62000],
            "history_women" => ["2014" => 40000, "2015" => 41500, "2016" => 43000, "2017" => 45000, "2018" => 47000, "2019" => 49000, "2020" => 50500, "2021" => 52000, "2022" => 53000, "2023" => 53500, "2024" => 54000],
            "percentiles" => ["p10" => 42000, "p25" => 48000, "p50" => 56000, "p75" => 68000, "p90" => 85000],
            "salary_by_age" => ["18-24" => 35000, "25-34" => 48000, "35-44" => 60000, "45-54" => 65000, "55-64" => 62000, "65+" => 55000]
        ]
    ],

    // 3. Redovisningskonsult
    [
        "category" => "Ekonomi & Finans",
        "slug" => "redovisningskonsult",
        "title" => "Redovisningskonsult",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "redovisningskonsult lön",
        "avg_salary" => 39500,
        "median_salary" => 38500,
        "description" => "En redovisningskonsult hjälper företag med bokföring, bokslut och deklarationer på uppdrag.",
        "description_extended" => "Arbetar på redovisningsbyrå mot flera kunder. Rollen kräver konsultmässighet och koll på skatteregler. Auktoriserad redovisningskonsult är en kvalitetsstämpel.",
        "education" => "YH-utbildning (2 år) eller högskola.",
        "salary_by_sector" => ["privat" => 39500],
        "pros" => ["Varierande kunder", "Tydlig karriärväg (Auktorisation)", "Stabil arbetsmarknad", "Flexibelt"],
        "cons" => ["Stress vid moms/deklaration", "Tidrapportering", "Mycket skärmtid", "Krav på debiteringsgrad"],
        "faq" => [
            ["question" => "Vad tjänar en redovisningskonsult?", "answer" => "Snittlönen är ca 39 500 kr. Auktoriserade konsulter tjänar mer (ca 45-50 000 kr)."],
            ["question" => "Vad är skillnaden mot en anställd ekonom?", "answer" => "Konsulten jobbar mot flera externa kunder och måste sälja sin tid."],
            ["question" => "Hur blir man auktoriserad?", "answer" => "Genom SRF eller FAR. Kräver utbildning och flera års praktik samt prov."],
            ["question" => "Behövs högskola?", "answer" => "Inte nödvändigtvis, YH-utbildningar är mycket uppskattade i branschen."],
            ["question" => "Är yrket hotat av AI?", "answer" => "Enklare bokföring automatiseras, men rådgivning och analys blir viktigare."]
        ],
        "kd" => 17, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "2411", "year" => 2024,
            "salary_total" => 39500, "salary_men" => 41000, "salary_women" => 38500,
            "gender_gap_percent" => 93.9, "evolution_10y_percent" => 27,
            "history" => ["2014" => 31000, "2015" => 31800, "2016" => 32800, "2017" => 33800, "2018" => 34800, "2019" => 35800, "2020" => 36500, "2021" => 37500, "2022" => 38500, "2023" => 39000, "2024" => 39500],
            "history_men" => ["2014" => 32000, "2015" => 33000, "2016" => 34000, "2017" => 35500, "2018" => 36500, "2019" => 37500, "2020" => 38500, "2021" => 39500, "2022" => 40500, "2023" => 40800, "2024" => 41000],
            "history_women" => ["2014" => 30500, "2015" => 31200, "2016" => 32000, "2017" => 33000, "2018" => 34000, "2019" => 35000, "2020" => 35800, "2021" => 36800, "2022" => 37600, "2023" => 38200, "2024" => 38500],
            "percentiles" => ["p10" => 30000, "p25" => 34000, "p50" => 38500, "p75" => 43000, "p90" => 48000],
            "salary_by_age" => ["18-24" => 29000, "25-34" => 35000, "35-44" => 41000, "45-54" => 43000, "55-64" => 42000, "65+" => 36000]
        ]
    ],

    // 4. Ekonom
    [
        "category" => "Ekonomi & Finans",
        "slug" => "ekonom",
        "title" => "Ekonom",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "ekonom lön",
        "avg_salary" => 43500,
        "median_salary" => 42000,
        "description" => "Ekonom är en bred yrkestitel för personer som arbetar med ekonomisk administration, analys eller bokföring.",
        "description_extended" => "Arbetsuppgifterna varierar från enkelt bokföringsarbete till avancerad rapportering. Titeln används ofta brett innan man specialiserar sig.",
        "education" => "Gymnasium (Ekonomi) eller Högskola.",
        "salary_by_sector" => ["privat" => 44000, "offentlig" => 41500],
        "pros" => ["Bred arbetsmarknad", "Finns i alla branscher", "Möjlighet att specialisera sig", "Kontorstider"],
        "cons" => ["Otydlig titel", "Varierande lön", "Kan vara monotont", "Stillassittande"],
        "faq" => [
            ["question" => "Vad tjänar en ekonom?", "answer" => "Snittet är 43 500 kr, men spannet är stort beroende på utbildning och ansvar."],
            ["question" => "Vad gör en ekonom?", "answer" => "Hanterar fakturor, betalningar, bokföring och ekonomiska rapporter."],
            ["question" => "Måste man vara bra på matte?", "answer" => "Mest plus och minus samt procent. Logiskt tänkande och noggrannhet är viktigare."],
            ["question" => "Var hittar man jobb?", "answer" => "Överallt. Alla företag behöver någon form av ekonomihantering."],
            ["question" => "Vad är skillnaden mot civilekonom?", "answer" => "Civilekonom är en specifik 4-årig examen. 'Ekonom' kan man kalla sig med kortare utbildning."]
        ],
        "kd" => 17, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "241", "year" => 2024,
            "salary_total" => 43500, "salary_men" => 45000, "salary_women" => 42000,
            "gender_gap_percent" => 93.3, "evolution_10y_percent" => 26,
            "history" => ["2014" => 34500, "2015" => 35500, "2016" => 36500, "2017" => 37800, "2018" => 39000, "2019" => 40200, "2020" => 41000, "2021" => 42000, "2022" => 42800, "2023" => 43200, "2024" => 43500],
            "history_men" => ["2014" => 36000, "2015" => 37000, "2016" => 38500, "2017" => 39500, "2018" => 41000, "2019" => 42000, "2020" => 43000, "2021" => 44000, "2022" => 44800, "2023" => 45000, "2024" => 45000],
            "history_women" => ["2014" => 33500, "2015" => 34500, "2016" => 35500, "2017" => 36500, "2018" => 37800, "2019" => 39000, "2020" => 39800, "2021" => 40800, "2022" => 41500, "2023" => 41800, "2024" => 42000],
            "percentiles" => ["p10" => 31000, "p25" => 36000, "p50" => 42000, "p75" => 49000, "p90" => 58000],
            "salary_by_age" => ["18-24" => 29000, "25-34" => 36000, "35-44" => 44000, "45-54" => 46000, "55-64" => 45000, "65+" => 38000]
        ]
    ],

    // 5. Rekryterare
    [
        "category" => "Administration",
        "slug" => "rekryterare",
        "title" => "Rekryterare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "rekryterare lön",
        "avg_salary" => 39000,
        "median_salary" => 38000,
        "description" => "En rekryterare söker, kontaktar och intervjuar kandidater för att hitta rätt person till rätt jobb.",
        "description_extended" => "Kan arbeta internt på HR eller som konsult på rekryteringsföretag. Rollen kräver social förmåga och säljdriv (om konsult). Arbetar mycket med LinkedIn och CV-granskning.",
        "education" => "PA-programmet (3 år) eller erfarenhet.",
        "salary_by_sector" => ["privat" => 39000],
        "pros" => ["Socialt", "Hjälper folk till jobb", "Snabbt tempo", "Nätverkande"],
        "cons" => ["Tidsödande admin", "Pressade deadlines", "Kan vara säljigt", "Svåra besked till kandidater"],
        "faq" => [
            ["question" => "Vad tjänar en rekryterare?", "answer" => "Snittlönen är ca 39 000 kr. På bemanningsbolag kan provision förekomma."],
            ["question" => "Hur blir man rekryterare?", "answer" => "Många har pluggat personalvetenskap eller beteendevetenskap."],
            ["question" => "Vad gör man?", "answer" => "Skriver annonser, letar kandidater (sourcing), intervjuar och tar referenser."],
            ["question" => "Vad är Researcher?", "answer" => "En junior roll där man fokuserar på att hitta kandidater, innan man blir fullvärdig rekryterare."],
            ["question" => "Är det stressigt?", "answer" => "Det kan det vara när många tjänster ska tillsättas samtidigt."]
        ],
        "kd" => 14, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "2424", "year" => 2024,
            "salary_total" => 39000, "salary_men" => 40000, "salary_women" => 38500,
            "gender_gap_percent" => 96.2, "evolution_10y_percent" => 25,
            "history" => ["2014" => 31000, "2015" => 32000, "2016" => 33000, "2017" => 34000, "2018" => 35000, "2019" => 36000, "2020" => 36800, "2021" => 37500, "2022" => 38200, "2023" => 38800, "2024" => 39000],
            "history_men" => ["2014" => 32000, "2015" => 33000, "2016" => 34000, "2017" => 35000, "2018" => 36000, "2019" => 37000, "2020" => 38000, "2021" => 38800, "2022" => 39500, "2023" => 39800, "2024" => 40000],
            "history_women" => ["2014" => 30500, "2015" => 31500, "2016" => 32500, "2017" => 33500, "2018" => 34500, "2019" => 35500, "2020" => 36200, "2021" => 37000, "2022" => 37800, "2023" => 38400, "2024" => 38500],
            "percentiles" => ["p10" => 31000, "p25" => 35000, "p50" => 38000, "p75" => 42000, "p90" => 48000],
            "salary_by_age" => ["18-24" => 30000, "25-34" => 36000, "35-44" => 40000, "45-54" => 41000, "55-64" => 40000, "65+" => 35000]
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
