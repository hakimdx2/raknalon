<?php
/**
 * Batch 6: Add 5 more professions
 * Target: Löneadministratör, Controller, Drifttekniker, Ingenjör, IT-tekniker
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
// Normalize existing slugs for comparison
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. Löneadministratör
    [
        "category" => "Administration",
        "slug" => "loneadministrator",
        "title" => "Löneadministratör",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "löneadministratör lön",
        "avg_salary" => 38500,
        "median_salary" => 38000,
        "description" => "En löneadministratör ansvarar för hela löneprocessen på ett företag, från tidrapportering till utbetalning och skatter.",
        "description_extended" => "Arbetet kräver noggrannhet och kunskap om lagar och avtal. Man arbetar ofta i lönesystem som Visma eller Hogia. Rollen är central för att alla anställda ska få rätt lön i tid.",
        "education" => "YH-utbildning till lönespecialist (1,5-2 år).",
        "salary_by_sector" => ["privat" => 39000, "offentlig" => 37500],
        "pros" => ["Efterfrågat yrke", "Tydliga arbetsuppgifter", "Möjlighet till distansarbete", "Bra lön för kort utbildning"],
        "cons" => ["Stressigt vid lönekörning", "Sårbar vid sjukdom (om ensam)", "Ständiga lagändringar", "Deadlines"],
        "faq" => [
            ["question" => "Vad tjänar en löneadministratör?", "answer" => "Genomsnittslönen är ca 38 500 kr. Som lönespecialist kan du tjäna mer."],
            ["question" => "Vilken utbildning behövs?", "answer" => "Yrkeshögskoleutbildning (YH) är den vanligaste vägen."],
            ["question" => "Är det svårt att få jobb?", "answer" => "Nej, det är stor efterfrågan på kompetenta löneadministratörer."],
            ["question" => "Vad gör man?", "answer" => "Hanterar löner, semester, sjukfrånvaro, pensioner och skatter."],
            ["question" => "Vad är skillnaden på administratör och speciallist?", "answer" => "Specialisten har ofta djupare kunskap och hanterar mer komplexa lönefrågor."]
        ],
        "kd" => 15, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "4314", "year" => 2024,
            "salary_total" => 38500, "salary_men" => 39500, "salary_women" => 38200,
            "gender_gap_percent" => 96.7, "evolution_10y_percent" => 28,
            "history" => ["2014" => 29800, "2015" => 30600, "2016" => 31500, "2017" => 32400, "2018" => 33200, "2019" => 34100, "2020" => 35000, "2021" => 36000, "2022" => 37000, "2023" => 37800, "2024" => 38500],
            "history_men" => ["2014" => 30500, "2015" => 31400, "2016" => 32400, "2017" => 33400, "2018" => 34400, "2019" => 35300, "2020" => 36200, "2021" => 37200, "2022" => 38200, "2023" => 39000, "2024" => 39500],
            "history_women" => ["2014" => 29500, "2015" => 30300, "2016" => 31200, "2017" => 32100, "2018" => 32900, "2019" => 33800, "2020" => 34700, "2021" => 35600, "2022" => 36600, "2023" => 37400, "2024" => 38200],
            "percentiles" => ["p10" => 32000, "p25" => 35000, "p50" => 38000, "p75" => 42000, "p90" => 46000],
            "salary_by_age" => ["18-24" => 30000, "25-34" => 36000, "35-44" => 39000, "45-54" => 40500, "55-64" => 40000, "65+" => 37000]
        ]
    ],

    // 2. Controller
    [
        "category" => "Ekonomi & Finans",
        "slug" => "controller",
        "title" => "Controller",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "controller lön",
        "avg_salary" => 62000,
        "median_salary" => 60000,
        "description" => "En controller analyserar och styr ett företags ekonomi för att nå uppsatta mål. Rollen är mer framåtblickande än redovisning.",
        "description_extended" => "Controllers delas ofta upp i Business Controllers (affärsinriktade) och Financial Controllers (redovisningsinriktade). De arbetar nära ledningen med budget, prognos och uppföljning.",
        "education" => "Civilekonom eller annan akademisk examen inom ekonomi (3-4 år).",
        "salary_by_sector" => ["privat" => 64000, "offentlig" => 58000],
        "pros" => ["Hög lön", "Strategiskt inflytande", "Karriärmöjligheter (CFO)", "Analytiskt"],
        "cons" => ["Hög stressnivå", "Mycket övertid", "Krävande ansvar", "Sittande arbete"],
        "faq" => [
            ["question" => "Vad tjänar en controller?", "answer" => "Genomsnittslönen är ca 62 000 kr. Business Controllers tjänar ofta mer än Financial Controllers."],
            ["question" => "Vad gör en controller?", "answer" => "Analyserar siffror, skapar budgetar, identifierar besparingar och stöttar beslutsfattare."],
            ["question" => "Vilken utbildning krävs?", "answer" => "Högskoleutbildning i ekonomi, gärna med inriktning mot ekonomistyrning."],
            ["question" => "Vad är skillnaden mot redovisningsekonom?", "answer" => "Redovisning handlar om att bokföra det som hänt (dåtid), controlling om att styra framtiden."],
            ["question" => "Är det svårt att bli controller?", "answer" => "Det är konkurrens om juniora tjänster, men stor brist på erfarna controllers."]
        ],
        "kd" => 20, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "2413", "year" => 2024,
            "salary_total" => 62000, "salary_men" => 65000, "salary_women" => 59000,
            "gender_gap_percent" => 90.8, "evolution_10y_percent" => 35,
            "history" => ["2014" => 46000, "2015" => 47500, "2016" => 49000, "2017" => 51000, "2018" => 53000, "2019" => 55000, "2020" => 57000, "2021" => 58500, "2022" => 60000, "2023" => 61000, "2024" => 62000],
            "history_men" => ["2014" => 49000, "2015" => 50500, "2016" => 52000, "2017" => 54000, "2018" => 56000, "2019" => 58000, "2020" => 60000, "2021" => 61500, "2022" => 63000, "2023" => 64000, "2024" => 65000],
            "history_women" => ["2014" => 43000, "2015" => 44500, "2016" => 46000, "2017" => 48000, "2018" => 50000, "2019" => 52000, "2020" => 54000, "2021" => 55500, "2022" => 57000, "2023" => 58000, "2024" => 59000],
            "percentiles" => ["p10" => 45000, "p25" => 52000, "p50" => 60000, "p75" => 72000, "p90" => 85000],
            "salary_by_age" => ["18-24" => 38000, "25-34" => 52000, "35-44" => 65000, "45-54" => 68000, "55-64" => 66000, "65+" => 58000]
        ]
    ],

    // 3. Drifttekniker
    [
        "category" => "Teknik & IT",
        "slug" => "drifttekniker",
        "title" => "Drifttekniker",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "drifttekniker lön",
        "avg_salary" => 36000,
        "median_salary" => 35500,
        "description" => "En drifttekniker övervakar och underhåller tekniska system inom fastighet, IT, energi eller industri.",
        "description_extended" => "Arbetet handlar om att förebygga fel och snabbt lösa problem när de uppstår. Det kan gälla värmesystem, servrar eller produktionslinjer. Beredskapstjänstgöring är vanligt.",
        "education" => "YH-utbildning (1-2 år) eller gymnasial teknisk utbildning.",
        "salary_by_sector" => ["privat" => 37000, "offentlig" => 35000],
        "pros" => ["Tekniskt intressant", "Problemlösning", "Bra ingångslön", "Varierande vardag"],
        "cons" => ["Beredskap/Jourtid", "Kan bli stressigt vid driftstopp", "Fysiska moment (ibland)", "Oregelbundna tider"],
        "faq" => [
            ["question" => "Vad tjänar en drifttekniker?", "answer" => "Genomsnittslönen är ca 36 000 kr per månad, ofta plus OB-tillägg för beredskap."],
            ["question" => "Vilken utbildning behöver man?", "answer" => "YH-utbildning inom driftteknik, fastighet eller systemteknik är vanligt."],
            ["question" => "Var jobbar man?", "answer" => "Värmeverk, fastighetsbolag, datacenter, industrier och reningsverk."],
            ["question" => "Vad gör en drifttekniker dagligen?", "answer" => "Rondering, övervakning av system, felsökning och planerat underhåll."],
            ["question" => "Är det brist på drifttekniker?", "answer" => "Ja, det är god efterfrågan inom både energi, fastighet och IT."]
        ],
        "kd" => 16, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "3132", "year" => 2024,
            "salary_total" => 36000, "salary_men" => 36500, "salary_women" => 35000,
            "gender_gap_percent" => 95.9, "evolution_10y_percent" => 27,
            "history" => ["2014" => 28400, "2015" => 29100, "2016" => 30000, "2017" => 30900, "2018" => 31800, "2019" => 32800, "2020" => 33500, "2021" => 34300, "2022" => 35100, "2023" => 35600, "2024" => 36000],
            "history_men" => ["2014" => 28800, "2015" => 29500, "2016" => 30400, "2017" => 31300, "2018" => 32200, "2019" => 33200, "2020" => 34000, "2021" => 34800, "2022" => 35600, "2023" => 36100, "2024" => 36500],
            "history_women" => ["2014" => 27500, "2015" => 28200, "2016" => 29000, "2017" => 29800, "2018" => 30600, "2019" => 31500, "2020" => 32200, "2021" => 33000, "2022" => 33800, "2023" => 34300, "2024" => 35000],
            "percentiles" => ["p10" => 29500, "p25" => 32500, "p50" => 35500, "p75" => 39000, "p90" => 43000],
            "salary_by_age" => ["18-24" => 29000, "25-34" => 34000, "35-44" => 37000, "45-54" => 38000, "55-64" => 37000, "65+" => 34000]
        ]
    ],

    // 4. Ingenjör (Högskoleingenjör)
    [
        "category" => "Teknik & Ingénierie",
        "slug" => "ingenjor",
        "title" => "Ingenjör",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "ingenjör lön",
        "avg_salary" => 48500,
        "median_salary" => 47000,
        "description" => "En ingenjör löser tekniska problem och utvecklar produkter eller system. Titeln är bred och täcker många branscher.",
        "description_extended" => "Här avses ofta högskoleingenjörer (3 års utbildning). De arbetar mer praktiskt än civilingenjörer med konstruktion, produktion eller drift. Det finns en mängd inriktningar som maskin, bygg, data eller kemi.",
        "education" => "Högskoleingenjörsexamen (180 hp, 3 år).",
        "salary_by_sector" => ["privat" => 49500, "offentlig" => 46000],
        "pros" => ["Mycket god arbetsmarknad", "Bra lön", "Internationella möjligheter", "Kreativt tekniskt arbete"],
        "cons" => ["Kan kräva övertid i projekt", "Krav på ständig fortbildning", "Stillasittande (beroende på roll)", "Prestationskrav"],
        "faq" => [
            ["question" => "Vad tjänar en ingenjör?", "answer" => "En högskoleingenjör tjänar i snitt 48 500 kr. En civilingenjör tjänar mer (ca 58 000+)."],
            ["question" => "Vad är skillnaden på högskole- och civilingenjör?", "answer" => "Högskoleingenjör är 3 år och mer praktisk. Civilingenjör är 5 år och mer teoretisk/analytisk."],
            ["question" => "Vilken ingenjör tjänar mest?", "answer" => "Ofta de inom IT, finans eller ledarskap. Även energi och gruvindustri betalar bra."],
            ["question" => "Är det brist på ingenjörer?", "answer" => "Ja, mycket stor brist på ingenjörer i Sverige, särskilt inom teknik, el och IT."],
            ["question" => "Var kan man jobba?", "answer" => "Industriföretag, konsultbolag, kommuner, energibolag och Tech-startups."]
        ],
        "kd" => 28, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "214", "year" => 2024,
            "salary_total" => 48500, "salary_men" => 50000, "salary_women" => 46000,
            "gender_gap_percent" => 92.0, "evolution_10y_percent" => 30,
            "history" => ["2014" => 37300, "2015" => 38500, "2016" => 39800, "2017" => 41200, "2018" => 42500, "2019" => 44000, "2020" => 45000, "2021" => 46200, "2022" => 47500, "2023" => 48100, "2024" => 48500],
            "history_men" => ["2014" => 38500, "2015" => 39800, "2016" => 41000, "2017" => 42500, "2018" => 44000, "2019" => 45500, "2020" => 46500, "2021" => 47800, "2022" => 49000, "2023" => 49600, "2024" => 50000],
            "history_women" => ["2014" => 35500, "2015" => 36500, "2016" => 37800, "2017" => 39000, "2018" => 40200, "2019" => 41500, "2020" => 42500, "2021" => 43500, "2022" => 44800, "2023" => 45400, "2024" => 46000],
            "percentiles" => ["p10" => 36000, "p25" => 41000, "p50" => 47000, "p75" => 55000, "p90" => 65000],
            "salary_by_age" => ["18-24" => 34000, "25-34" => 42000, "35-44" => 50000, "45-54" => 54000, "55-64" => 52000, "65+" => 48000]
        ]
    ],

    // 5. IT-tekniker
    [
        "category" => "Teknik & IT",
        "slug" => "it-tekniker",
        "title" => "IT-tekniker",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "it tekniker lön",
        "avg_salary" => 34500,
        "median_salary" => 34000,
        "description" => "En IT-tekniker (supporttekniker) hjälper användare med datorproblem, installerar hårdvara och sköter drift av enklare system.",
        "description_extended" => "Vanliga titlar är 1st line support, helpdesk eller onsite-tekniker. Det är ofta en ingångsroll till IT-branschen. Arbetet är serviceinriktat och kräver tålamod.",
        "education" => "Gymnasial IT-utbildning eller YH-utbildning (1-2 år).",
        "salary_by_sector" => ["privat" => 35000, "offentlig" => 33500],
        "pros" => ["Bra väg in i IT", "Socialt arbete", "Lär dig mycket om teknik", "Goda jobbchanser"],
        "cons" => ["Enformig telefonsupport (ibland)", "Stressigt", "Låg löneutveckling i supportroller", "Kan vara otacksamt"],
        "faq" => [
            ["question" => "Vad tjänar en IT-tekniker?", "answer" => "Genomsnittslönen är 34 500 kr. Lönerna varierar beroende på om det är 1st, 2nd eller 3rd line support."],
            ["question" => "Behöver man utbildning?", "answer" => "Ofta krävs gymnasium eller YH, men intresse och kunskap väger tungt."],
            ["question" => "Hur ser karriären ut?", "answer" => "Många börjar i support och går vidare till systemadministratör, drifttekniker eller utvecklare."],
            ["question" => "Vad gör man?", "answer" => "Svarar på samtal, återställer lösenord, installerar datorer och felsöker mjukvara."],
            ["question" => "Är det brist på IT-tekniker?", "answer" => "Ja, det behövs alltid folk till servicedesk och support."]
        ],
        "kd" => 13, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "3511", "year" => 2024,
            "salary_total" => 34500, "salary_men" => 35000, "salary_women" => 33500,
            "gender_gap_percent" => 95.7, "evolution_10y_percent" => 22,
            "history" => ["2014" => 28200, "2015" => 28800, "2016" => 29400, "2017" => 30100, "2018" => 30800, "2019" => 31500, "2020" => 32200, "2021" => 33000, "2022" => 33800, "2023" => 34200, "2024" => 34500],
            "history_men" => ["2014" => 28500, "2015" => 29100, "2016" => 29800, "2017" => 30500, "2018" => 31200, "2019" => 32000, "2020" => 32700, "2021" => 33500, "2022" => 34300, "2023" => 34700, "2024" => 35000],
            "history_women" => ["2014" => 27500, "2015" => 28000, "2016" => 28600, "2017" => 29200, "2018" => 29800, "2019" => 30500, "2020" => 31200, "2021" => 31900, "2022" => 32600, "2023" => 33000, "2024" => 33500],
            "percentiles" => ["p10" => 27000, "p25" => 30000, "p50" => 34000, "p75" => 38000, "p90" => 42000],
            "salary_by_age" => ["18-24" => 28000, "25-34" => 33000, "35-44" => 36000, "45-54" => 36500, "55-64" => 35500, "65+" => 32000]
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
