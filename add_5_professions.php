<?php
/**
 * Script to add 5 new professions to professions.json
 * Target: Brandman, Personlig assistent, Projektledare, Systemutvecklare, Apotekare
 */

$jsonFile = __DIR__ . '/data/professions.json';

// Load existing data
$data = json_decode(file_get_contents($jsonFile), true);
if (!$data) {
    die("Error loading professions.json\n");
}

// Check existing slugs to avoid duplicates
$existingSlugs = [];
foreach ($data as $p) {
    $existingSlugs[$p['slug']] = true;
}

// Define new professions
$newProfessions = [
    // 1. Brandman (Pompier)
    [
        "category" => "Säkerhet & Räddning",
        "slug" => "brandman",
        "title" => "Brandman",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "brandman lön",
        "avg_salary" => 35500,
        "median_salary" => 34800,
        "description" => "En brandman arbetar med att släcka bränder, utföra räddningsinsatser och förebygga olyckor. Yrket kräver god fysik, stresshantering och förmåga att arbeta i team under pressade situationer.",
        "description_extended" => "Brandmän har skiftarbete och arbetar inom kommunal räddningstjänst. Utöver brandsläckning ingår internationell hjälp, trafikolyckor, drunkning och kemiska utsläpp. Lönen varierar beroende på erfarenhet och tilläggsuppdrag.",
        "education" => "Räddningstjänstutbildning (Skydd mot olyckor, SMO) vid MSB. Krav på god fysik, B-körkort och ofta C-körkort.",
        "salary_by_sector" => [
            "kommunal" => 35500,
            "statlig" => 38000
        ],
        "pros" => [
            "Meningsfullt arbete som räddar liv",
            "Varierat arbete med fysisk aktivitet",
            "Stark sammanhållning i arbetsgruppen",
            "Trygga anställningsvillkor"
        ],
        "cons" => [
            "Psykiskt krävande med traumatiska upplevelser",
            "Skiftarbete inklusive nätter och helger",
            "Fysiskt ansträngande",
            "Relativt låg ingångslön"
        ],
        "faq" => [
            ["question" => "Vad tjänar en brandman i månaden?", "answer" => "En brandman tjänar i genomsnitt 35 500 kr per månad. Med erfarenhet och specialistroller kan lönen öka till ca 42 000 kr."],
            ["question" => "Hur blir man brandman?", "answer" => "Du måste genomgå räddningstjänstutbildningen SMO (Skydd mot olyckor) vid MSB. Krav är B-körkort, god fysik och simkunnighet."],
            ["question" => "Hur många timmar jobbar en brandman?", "answer" => "Brandmän arbetar ofta i skift med 24-timmarspass följt av lediga dagar. Arbetstiden är cirka 42 timmar per vecka."],
            ["question" => "Är det svårt att bli brandman?", "answer" => "Ja, konkurrensen är hård. Ca 5 000 söker årligen men endast ca 150 platser finns. Fysiska tester och psykologisk utvärdering ingår."],
            ["question" => "Vad gör en brandman när det inte brinner?", "answer" => "Brandmän tränar, underhåller utrustning, utbildar allmänheten i brandsäkerhet och genomför tillsynsbesök."]
        ],
        "kd" => 14,
        "volume" => 2900,
        "scb" => [
            "ssyk_code" => "5411",
            "year" => 2024,
            "salary_total" => 35500,
            "salary_men" => 35800,
            "salary_women" => 34200,
            "gender_gap_percent" => 95.5,
            "evolution_10y_percent" => 28,
            "history" => [
                "2014" => 27700,
                "2015" => 28300,
                "2016" => 29000,
                "2017" => 29800,
                "2018" => 30500,
                "2019" => 31200,
                "2020" => 32100,
                "2021" => 33000,
                "2022" => 34000,
                "2023" => 34800,
                "2024" => 35500
            ],
            "history_men" => [
                "2014" => 27900, "2015" => 28500, "2016" => 29200, "2017" => 30000, "2018" => 30700,
                "2019" => 31400, "2020" => 32300, "2021" => 33200, "2022" => 34200, "2023" => 35000, "2024" => 35800
            ],
            "history_women" => [
                "2014" => 26800, "2015" => 27400, "2016" => 28100, "2017" => 28900, "2018" => 29600,
                "2019" => 30300, "2020" => 31200, "2021" => 32100, "2022" => 33100, "2023" => 33900, "2024" => 34200
            ],
            "percentiles" => ["p10" => 30200, "p25" => 32500, "p50" => 35000, "p75" => 38500, "p90" => 42000],
            "salary_by_region" => [
                "Stockholm" => 37500, "Göteborg" => 36000, "Malmö" => 35200, "Uppsala" => 35000,
                "Norrbotten" => 36500, "Övriga Sverige" => 34500
            ],
            "salary_by_age" => [
                "18-24" => 28500, "25-34" => 33000, "35-44" => 36500, "45-54" => 38500,
                "55-64" => 39000, "65+" => 38000
            ]
        ]
    ],

    // 2. Personlig assistent
    [
        "category" => "Vård & Omsorg",
        "slug" => "personlig-assistent",
        "title" => "Personlig assistent",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "personlig assistent lön",
        "avg_salary" => 28500,
        "median_salary" => 28000,
        "description" => "En personlig assistent ger stöd till personer med funktionsnedsättning i deras vardag. Arbetet kan innefatta personlig hygien, matlagning, social aktivitet och transport.",
        "description_extended" => "Personliga assistenter arbetar dels inom kommunal omsorg, dels privat via assistansbolag. Arbetstiderna varierar stort och kan inkludera obekväma tider. Lönen är relativt låg men arbetet är meningsfullt och personligt.",
        "education" => "Ingen formell utbildning krävs, men kurser inom vård och omsorg är meriterande. Körkort är ofta krav.",
        "salary_by_sector" => [
            "kommunal" => 27800,
            "privat" => 29200
        ],
        "pros" => [
            "Meningsfullt arbete med nära relationer",
            "Flexibla arbetstider i vissa fall",
            "Möjlighet att påverka arbetsdagen",
            "Stor efterfrågan på arbetsmarknaden"
        ],
        "cons" => [
            "Fysiskt och psykiskt krävande",
            "Ofta låg lön",
            "Obekväma arbetstider",
            "Risk för ensamarbete"
        ],
        "faq" => [
            ["question" => "Vad tjänar en personlig assistent?", "answer" => "En personlig assistent tjänar i genomsnitt 28 500 kr per månad. Lönen varierar mellan kommunal och privat sektor."],
            ["question" => "Behöver man utbildning för att bli personlig assistent?", "answer" => "Nej, ingen formell utbildning krävs. Men erfarenhet av vård och körkort är meriterande."],
            ["question" => "Hur många timmar jobbar en personlig assistent?", "answer" => "Det varierar stort. Vissa har deltid, andra heltid med obekväma arbetstider inklusive nätter."],
            ["question" => "Vad är skillnaden på personlig assistent och undersköterska?", "answer" => "Personliga assistenter arbetar enligt LSS med en specifik brukare, medan undersköterskor arbetar inom äldrevård eller sjukvård."],
            ["question" => "Är personlig assistent ett bra jobb?", "answer" => "Det är ett meningsfullt jobb men kan vara krävande. Passar den som trivs med nära relationer och omvårdnad."]
        ],
        "kd" => 18,
        "volume" => 2900,
        "scb" => [
            "ssyk_code" => "5321",
            "year" => 2024,
            "salary_total" => 28500,
            "salary_men" => 29200,
            "salary_women" => 28100,
            "gender_gap_percent" => 96.2,
            "evolution_10y_percent" => 25,
            "history" => [
                "2014" => 22800, "2015" => 23400, "2016" => 24000, "2017" => 24700, "2018" => 25400,
                "2019" => 26100, "2020" => 26800, "2021" => 27400, "2022" => 27900, "2023" => 28200, "2024" => 28500
            ],
            "history_men" => [
                "2014" => 23200, "2015" => 23800, "2016" => 24400, "2017" => 25100, "2018" => 25800,
                "2019" => 26500, "2020" => 27200, "2021" => 27800, "2022" => 28300, "2023" => 28800, "2024" => 29200
            ],
            "history_women" => [
                "2014" => 22600, "2015" => 23200, "2016" => 23800, "2017" => 24500, "2018" => 25200,
                "2019" => 25900, "2020" => 26600, "2021" => 27200, "2022" => 27700, "2023" => 27900, "2024" => 28100
            ],
            "percentiles" => ["p10" => 24500, "p25" => 26200, "p50" => 28000, "p75" => 30500, "p90" => 32800],
            "salary_by_region" => [
                "Stockholm" => 30000, "Göteborg" => 29000, "Malmö" => 28500, "Uppsala" => 28200,
                "Norrbotten" => 27500, "Övriga Sverige" => 27000
            ],
            "salary_by_age" => [
                "18-24" => 25000, "25-34" => 27500, "35-44" => 29000, "45-54" => 30000,
                "55-64" => 29500, "65+" => 28000
            ]
        ]
    ],

    // 3. Projektledare
    [
        "category" => "IT & Teknik",
        "slug" => "projektledare",
        "title" => "Projektledare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "projektledare lön",
        "avg_salary" => 52000,
        "median_salary" => 50500,
        "description" => "En projektledare ansvarar för att planera, koordinera och genomföra projekt inom tidsram och budget. Rollen kräver ledarskap, kommunikationsförmåga och strukturerat arbetssätt.",
        "description_extended" => "Projektledare finns inom många branscher: IT, bygg, marknadsföring, industri med mera. Lönen varierar kraftigt beroende på bransch och projektstorlek. IT-projektledare har ofta högst löner.",
        "education" => "Högskoleutbildning inom relevant område samt certifieringar som PMP, PRINCE2 eller liknande är meriterande.",
        "salary_by_sector" => [
            "privat" => 54000,
            "offentlig" => 48000
        ],
        "pros" => [
            "Hög lön och goda karriärmöjligheter",
            "Varierat arbete med många kontakter",
            "Möjlighet att påverka och leda",
            "Efterfrågad roll på arbetsmarknaden"
        ],
        "cons" => [
            "Hög stressnivå och ansvar",
            "Långa arbetsdagar vid deadlines",
            "Krav på ständig tillgänglighet",
            "Ofta många möten"
        ],
        "faq" => [
            ["question" => "Vad tjänar en projektledare?", "answer" => "En projektledare tjänar i genomsnitt 52 000 kr per månad. Inom IT och konsultbranschen kan lönen överstiga 60 000 kr."],
            ["question" => "Vad gör en projektledare?", "answer" => "En projektledare planerar, leder och följer upp projekt för att säkerställa att de levereras i tid och inom budget."],
            ["question" => "Vilken utbildning behövs för att bli projektledare?", "answer" => "Det finns ingen specifik utbildning, men högskoleutbildning kombinerat med certifieringar som PMP är vanligt."],
            ["question" => "Är projektledare ett stressigt jobb?", "answer" => "Ja, det kan vara stressigt, särskilt vid deadlines. Men god planering och struktur minskar stressen."],
            ["question" => "Vilken bransch betalar bäst för projektledare?", "answer" => "IT, finans och konsultbranschen betalar generellt bäst, med löner över 55 000 kr i snitt."]
        ],
        "kd" => 14,
        "volume" => 2400,
        "scb" => [
            "ssyk_code" => "1219",
            "year" => 2024,
            "salary_total" => 52000,
            "salary_men" => 54000,
            "salary_women" => 49500,
            "gender_gap_percent" => 91.7,
            "evolution_10y_percent" => 32,
            "history" => [
                "2014" => 39400, "2015" => 40800, "2016" => 42200, "2017" => 43800, "2018" => 45200,
                "2019" => 46800, "2020" => 48000, "2021" => 49500, "2022" => 50500, "2023" => 51200, "2024" => 52000
            ],
            "history_men" => [
                "2014" => 41000, "2015" => 42500, "2016" => 44000, "2017" => 45600, "2018" => 47100,
                "2019" => 48700, "2020" => 50000, "2021" => 51500, "2022" => 52600, "2023" => 53300, "2024" => 54000
            ],
            "history_women" => [
                "2014" => 37500, "2015" => 38900, "2016" => 40200, "2017" => 41800, "2018" => 43200,
                "2019" => 44700, "2020" => 45900, "2021" => 47300, "2022" => 48300, "2023" => 48900, "2024" => 49500
            ],
            "percentiles" => ["p10" => 38500, "p25" => 44000, "p50" => 50500, "p75" => 58000, "p90" => 68000],
            "salary_by_region" => [
                "Stockholm" => 56000, "Göteborg" => 52500, "Malmö" => 51000, "Uppsala" => 50500,
                "Norrbotten" => 48000, "Övriga Sverige" => 47000
            ],
            "salary_by_age" => [
                "18-24" => 35000, "25-34" => 45000, "35-44" => 54000, "45-54" => 58000,
                "55-64" => 56000, "65+" => 52000
            ]
        ]
    ],

    // 4. Systemutvecklare
    [
        "category" => "Data & IT",
        "slug" => "systemutvecklare",
        "title" => "Systemutvecklare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "systemutvecklare lön",
        "avg_salary" => 52500,
        "median_salary" => 51000,
        "description" => "En systemutvecklare designar, programmerar och underhåller mjukvarusystem. Rollen kräver teknisk kompetens inom programmering, databaser och systemarkitektur.",
        "description_extended" => "Systemutvecklare arbetar inom många branscher, från IT-konsultbolag till banker och startup. Lönen är generellt hög och efterfrågan stor. Vanliga språk är Java, C#, Python och JavaScript.",
        "education" => "Högskoleutbildning inom datateknik, systemvetenskap eller motsvarande. Praktisk erfarenhet värderas högt.",
        "salary_by_sector" => [
            "privat" => 54500,
            "offentlig" => 47500
        ],
        "pros" => [
            "Hög lön och stark arbetsmarknad",
            "Möjlighet till distansarbete",
            "Kreativt och problemlösande arbete",
            "Kontinuerlig kompetensutveckling"
        ],
        "cons" => [
            "Stillasittande arbete",
            "Krav på ständig uppdatering av kunskaper",
            "Deadlines och projektpress",
            "Kan vara ensamt arbete"
        ],
        "faq" => [
            ["question" => "Vad tjänar en systemutvecklare?", "answer" => "En systemutvecklare tjänar i genomsnitt 52 500 kr per månad. Senior utvecklare kan tjäna över 65 000 kr."],
            ["question" => "Hur blir man systemutvecklare?", "answer" => "Vanligast är högskoleutbildning inom IT, men bootcamps och självstudier är också möjliga vägar."],
            ["question" => "Vilka programmeringsspråk ska man kunna?", "answer" => "Java, Python, JavaScript och C# är bland de mest efterfrågade. Det varierar dock beroende på bransch."],
            ["question" => "Är systemutvecklare ett framtidsyrke?", "answer" => "Ja, efterfrågan ökar stadigt. Digitalisering driver behovet av utvecklare inom alla sektorer."],
            ["question" => "Vad är skillnaden på systemutvecklare och programmerare?", "answer" => "Systemutvecklare har ofta bredare ansvar inklusive design och arkitektur, medan programmerare fokuserar på kodning."]
        ],
        "kd" => 13,
        "volume" => 2400,
        "scb" => [
            "ssyk_code" => "2512",
            "year" => 2024,
            "salary_total" => 52500,
            "salary_men" => 53500,
            "salary_women" => 49500,
            "gender_gap_percent" => 92.5,
            "evolution_10y_percent" => 35,
            "history" => [
                "2014" => 38900, "2015" => 40400, "2016" => 42000, "2017" => 43800, "2018" => 45500,
                "2019" => 47200, "2020" => 48500, "2021" => 50000, "2022" => 51000, "2023" => 51800, "2024" => 52500
            ],
            "history_men" => [
                "2014" => 39600, "2015" => 41200, "2016" => 42800, "2017" => 44700, "2018" => 46400,
                "2019" => 48100, "2020" => 49500, "2021" => 51000, "2022" => 52000, "2023" => 52800, "2024" => 53500
            ],
            "history_women" => [
                "2014" => 36500, "2015" => 38000, "2016" => 39500, "2017" => 41200, "2018" => 42800,
                "2019" => 44400, "2020" => 45700, "2021" => 47100, "2022" => 48100, "2023" => 48800, "2024" => 49500
            ],
            "percentiles" => ["p10" => 40000, "p25" => 45500, "p50" => 51000, "p75" => 58000, "p90" => 67000],
            "salary_by_region" => [
                "Stockholm" => 56500, "Göteborg" => 53000, "Malmö" => 51500, "Uppsala" => 51000,
                "Norrbotten" => 47000, "Övriga Sverige" => 46500
            ],
            "salary_by_age" => [
                "18-24" => 35000, "25-34" => 48000, "35-44" => 56000, "45-54" => 58000,
                "55-64" => 55000, "65+" => 50000
            ]
        ]
    ],

    // 5. Apotekare
    [
        "category" => "Hälsa & Sjukvård",
        "slug" => "apotekare",
        "title" => "Apotekare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "apotekare lön",
        "avg_salary" => 48500,
        "median_salary" => 47500,
        "description" => "En apotekare är en legitimerad specialist på läkemedel som ger råd om medicinering, kontrollerar recept och säkerställer säker läkemedelsanvändning.",
        "description_extended" => "Apotekare arbetar på apotek, inom sjukvården, läkemedelsindustrin eller myndigheter. De har femårig universitetsutbildning och legitimation från Socialstyrelsen. Lönen är god och arbetsmarknaden stabil.",
        "education" => "Apotekarprogrammet (5 år) vid universitet. Kräver legitimation från Socialstyrelsen för att få arbeta som apotekare.",
        "salary_by_sector" => [
            "privat" => 50000,
            "region" => 47000,
            "industri" => 55000
        ],
        "pros" => [
            "Hög lön och trygg anställning",
            "Meningsfullt arbete med patientkontakt",
            "Regelbundna arbetstider",
            "Möjlighet till specialisering"
        ],
        "cons" => [
            "Lång och krävande utbildning",
            "Ansvar för patientsäkerhet",
            "Repetitivt arbete på vissa arbetsplatser",
            "Kundtjänstinslag"
        ],
        "faq" => [
            ["question" => "Vad tjänar en apotekare?", "answer" => "En apotekare tjänar i genomsnitt 48 500 kr per månad. Inom läkemedelsindustrin kan lönen överstiga 55 000 kr."],
            ["question" => "Hur lång tid tar det att bli apotekare?", "answer" => "Apotekarprogrammet är 5 år, följt av praktik och legitimationsansökan. Totalt ca 5,5 år."],
            ["question" => "Vad är skillnaden mellan apotekare och receptarie?", "answer" => "Apotekare har 5 års utbildning, receptarier 3 år. Apotekare har bredare kompetens och ansvar."],
            ["question" => "Var kan apotekare jobba?", "answer" => "Apotek, sjukhus, läkemedelsindustri, Läkemedelsverket, eller som forskare på universitet."],
            ["question" => "Är apotekare ett bra yrke?", "answer" => "Ja, det erbjuder trygg anställning, bra lön och möjlighet att hjälpa människor med deras hälsa."]
        ],
        "kd" => 13,
        "volume" => 2400,
        "scb" => [
            "ssyk_code" => "2262",
            "year" => 2024,
            "salary_total" => 48500,
            "salary_men" => 51000,
            "salary_women" => 47500,
            "gender_gap_percent" => 93.1,
            "evolution_10y_percent" => 30,
            "history" => [
                "2014" => 37300, "2015" => 38500, "2016" => 39800, "2017" => 41200, "2018" => 42700,
                "2019" => 44100, "2020" => 45300, "2021" => 46500, "2022" => 47300, "2023" => 47900, "2024" => 48500
            ],
            "history_men" => [
                "2014" => 39200, "2015" => 40500, "2016" => 41900, "2017" => 43400, "2018" => 44900,
                "2019" => 46400, "2020" => 47700, "2021" => 49000, "2022" => 49900, "2023" => 50500, "2024" => 51000
            ],
            "history_women" => [
                "2014" => 36500, "2015" => 37700, "2016" => 39000, "2017" => 40400, "2018" => 41800,
                "2019" => 43200, "2020" => 44400, "2021" => 45600, "2022" => 46400, "2023" => 47000, "2024" => 47500
            ],
            "percentiles" => ["p10" => 40000, "p25" => 44000, "p50" => 47500, "p75" => 52000, "p90" => 58000],
            "salary_by_region" => [
                "Stockholm" => 51000, "Göteborg" => 49000, "Malmö" => 48000, "Uppsala" => 48500,
                "Norrbotten" => 47000, "Övriga Sverige" => 46500
            ],
            "salary_by_age" => [
                "18-24" => 38000, "25-34" => 45000, "35-44" => 50000, "45-54" => 52000,
                "55-64" => 51000, "65+" => 48000
            ]
        ]
    ]
];

// Add new professions if they don't exist
$addedCount = 0;
foreach ($newProfessions as $profession) {
    if (!isset($existingSlugs[$profession['slug']])) {
        $data[] = $profession;
        $addedCount++;
        echo "Added: {$profession['title']}\n";
    } else {
        echo "Skipped (exists): {$profession['title']}\n";
    }
}

// Save
if ($addedCount > 0) {
    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    echo "\n✅ Added $addedCount new professions to professions.json\n";
} else {
    echo "\n⚠️ No new professions added (all already exist)\n";
}
