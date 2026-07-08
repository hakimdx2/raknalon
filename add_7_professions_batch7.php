<?php
/**
 * Batch 7: Add 7 more professions to reach 150
 * Target: Fastighetsmäklare, Socialsekreterare, Receptionist, Civilekonom, Nätverkstekniker, UX-designer, Logistiker
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);
$existingSlugs = array_map(function($p) { return $p['slug']; }, $data);

$newProfessions = [
    // 1. Fastighetsmäklare
    [
        "category" => "Försäljning & Marknad",
        "slug" => "fastighetsmaklare",
        "title" => "Fastighetsmäklare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "mäklare lön",
        "avg_salary" => 48000,
        "median_salary" => 42000,
        "description" => "En fastighetsmäklare förmedlar bostäder och fastigheter. Lönen är ofta helt provisionsbaserad.",
        "description_extended" => "Mäklare arbetar med att värdera, marknadsföra och sälja bostäder. Det är ett säljyrke med oregelbundna arbetstider och stor konkurrens. Framgångsrika mäklare tjänar mycket bra.",
        "education" => "Fastighetsmäklarprogrammet (2 år, 120 hp) vid högskola + registrering hos FMI.",
        "salary_by_sector" => ["privat" => 48000],
        "pros" => ["Obegränsad lönepotential", "Socialt arbete", "Frihet under ansvar", "Spänning i affärer"],
        "cons" => ["Osäker inkomst (provision)", "Mycket kvälls- och helgjobb", "Hög stress", "Konjunkturkänsligt"],
        "faq" => [
            ["question" => "Vad tjänar en mäklare?", "answer" => "Genomsnittet är 48 000 kr, men variationen är enorm. Vissa tjänar 20 000 kr, andra 200 000 kr."],
            ["question" => "Har mäklare fast lön?", "answer" => "Oftast inte. De flesta har 100% provision, men garantilön kan förekomma i början."],
            ["question" => "Hur blir man mäklare?", "answer" => "Två års högskolestudier och 10 veckors praktik."],
            ["question" => "Är det svårt att lyckas?", "answer" => "Ja, många slutar inom några år p.g.a. den hårda konkurrensen."],
            ["question" => "Krävs registrering?", "answer" => "Ja, man måste vara registrerad hos Fastighetsmäklarinspektionen (FMI)."]
        ],
        "kd" => 18, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "3334", "year" => 2024,
            "salary_total" => 48000, "salary_men" => 52000, "salary_women" => 44000,
            "gender_gap_percent" => 84.6, "evolution_10y_percent" => 25,
            "history" => ["2014" => 38500, "2015" => 40000, "2016" => 42000, "2017" => 43500, "2018" => 44000, "2019" => 45000, "2020" => 46000, "2021" => 47000, "2022" => 47500, "2023" => 47800, "2024" => 48000],
            "history_men" => ["2014" => 42000, "2015" => 43500, "2016" => 45500, "2017" => 47000, "2018" => 47500, "2019" => 49000, "2020" => 50000, "2021" => 51000, "2022" => 51500, "2023" => 51800, "2024" => 52000],
            "history_women" => ["2014" => 35000, "2015" => 36500, "2016" => 38000, "2017" => 39500, "2018" => 40000, "2019" => 41000, "2020" => 42000, "2021" => 43000, "2022" => 43500, "2023" => 43800, "2024" => 44000],
            "percentiles" => ["p10" => 25000, "p25" => 32000, "p50" => 42000, "p75" => 58000, "p90" => 80000],
            "salary_by_age" => ["18-24" => 28000, "25-34" => 42000, "35-44" => 55000, "45-54" => 52000, "55-64" => 48000, "65+" => 40000]
        ]
    ],

    // 2. Socialsekreterare
    [
        "category" => "Samhälle & Service",
        "slug" => "socialsekreterare",
        "title" => "Socialsekreterare",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "socialsekreterare lön",
        "avg_salary" => 38500,
        "median_salary" => 38000,
        "description" => "En socialsekreterare arbetar inom socialtjänsten med att utreda behov och besluta om insatser för individer och familjer.",
        "description_extended" => "Arbetet kan handla om ekonomiskt bistånd, barn och unga, eller missbruk. Det är ett myndighetsutövande yrke som kräver god juridisk och social kompetens.",
        "education" => "Socionomexamen (3,5 år, 210 hp).",
        "salary_by_sector" => ["kommunal" => 38500],
        "pros" => ["Viktigt samhällsjobb", "Trygg anställning", "Goda karriärvägar (chef)", "Hjälper utsatta"],
        "cons" => ["Hög arbetsbelastning", "Emotionellt tungt", "Hot förekommer", "Komplex lagstiftning"],
        "faq" => [
            ["question" => "Vad tjänar en socialsekreterare?", "answer" => "Snittlönen är ca 38 500 kr, men varierar mellan kommuner."],
            ["question" => "Vilken utbildning krävs?", "answer" => "Socionomexamen är standardkravet."],
            ["question" => "Är det brist på socialsekreterare?", "answer" => "Ja, det är stor brist i de flesta kommuner."],
            ["question" => "Vad gör man på dagarna?", "answer" => "Möter klienter, gör utredningar, skriver beslut och samverkar med andra myndigheter."],
            ["question" => "Kan man jobba privat?", "answer" => "Ja, inom privata vårdbolag eller bemanning, men de flesta jobbar kommunalt."]
        ],
        "kd" => 21, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "2635", "year" => 2024,
            "salary_total" => 38500, "salary_men" => 39500, "salary_women" => 38200,
            "gender_gap_percent" => 96.7, "evolution_10y_percent" => 32,
            "history" => ["2014" => 29200, "2015" => 30500, "2016" => 32000, "2017" => 33500, "2018" => 34800, "2019" => 36000, "2020" => 37000, "2021" => 37800, "2022" => 38200, "2023" => 38400, "2024" => 38500],
            "history_men" => ["2014" => 30000, "2015" => 31500, "2016" => 33000, "2017" => 34500, "2018" => 35800, "2019" => 37000, "2020" => 38000, "2021" => 38800, "2022" => 39200, "2023" => 39400, "2024" => 39500],
            "history_women" => ["2014" => 29000, "2015" => 30300, "2016" => 31800, "2017" => 33200, "2018" => 34500, "2019" => 35800, "2020" => 36800, "2021" => 37600, "2022" => 38000, "2023" => 38200, "2024" => 38200],
            "percentiles" => ["p10" => 34000, "p25" => 36000, "p50" => 38000, "p75" => 41000, "p90" => 44000],
            "salary_by_age" => ["18-24" => 33000, "25-34" => 36500, "35-44" => 39500, "45-54" => 40500, "55-64" => 40000, "65+" => 38000]
        ]
    ],

    // 3. Receptionist
    [
        "category" => "Administration",
        "slug" => "receptionist",
        "title" => "Receptionist",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "receptionist lön",
        "avg_salary" => 28500,
        "median_salary" => 28000,
        "description" => "En receptionist är företagets ansikte utåt. De tar emot besökare, svarar i telefon och sköter administrativ service.",
        "description_extended" => "Arbetar på hotell, kontor, vårdcentraler eller gym. Servicekänsla och stresstålighet är viktigt. Språkkunskaper är ofta meriterande.",
        "education" => "Gymnasieutbildning (Hotell/Turism/Handel).",
        "salary_by_sector" => ["privat" => 29000, "offentlig" => 28000],
        "pros" => ["Socialt", "Bra instegsjobb", "Träffar mycket folk", "Varierande arbetsplatser"],
        "cons" => ["Låg lön", "Kan vara stressigt", "Enformiga uppgifter", "Svår karriärstege"],
        "faq" => [
            ["question" => "Vad tjänar en receptionist?", "answer" => "Genomsnittslönen är ca 28 500 kr. Hotellreceptionister har ofta något lägre grundlön men OB-tillägg."],
            ["question" => "Krävs utbildning?", "answer" => "Ofta räcker gymnasium, men erfarenhet av service är viktigast."],
            ["question" => "Var kan man jobba?", "answer" => "Hotell, företagskontor, tandläkare, vårdcentraler, gym."],
            ["question" => "Vad gör man?", "answer" => "Checkar in gäster, svarar i växel, bokar rum/tider och hanterar post."],
            ["question" => "Är det skiftarbete?", "answer" => "På hotell ja (inklusive natt/helg). På kontor oftast kontorstider."]
        ],
        "kd" => 13, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "422", "year" => 2024,
            "salary_total" => 28500, "salary_men" => 29500, "salary_women" => 28200,
            "gender_gap_percent" => 95.6, "evolution_10y_percent" => 22,
            "history" => ["2014" => 23400, "2015" => 23900, "2016" => 24500, "2017" => 25100, "2018" => 25800, "2019" => 26500, "2020" => 27000, "2021" => 27500, "2022" => 28000, "2023" => 28300, "2024" => 28500],
            "history_men" => ["2014" => 24000, "2015" => 24500, "2016" => 25200, "2017" => 25800, "2018" => 26500, "2019" => 27200, "2020" => 27800, "2021" => 28500, "2022" => 29000, "2023" => 29300, "2024" => 29500],
            "history_women" => ["2014" => 23200, "2015" => 23700, "2016" => 24300, "2017" => 24900, "2018" => 25600, "2019" => 26300, "2020" => 26800, "2021" => 27200, "2022" => 27700, "2023" => 28000, "2024" => 28200],
            "percentiles" => ["p10" => 24500, "p25" => 26000, "p50" => 28000, "p75" => 31000, "p90" => 33000],
            "salary_by_age" => ["18-24" => 25000, "25-34" => 28000, "35-44" => 29500, "45-54" => 30000, "55-64" => 29500, "65+" => 27000]
        ]
    ],

    // 4. Civilekonom
    [
        "category" => "Ekonomi & Finans",
        "slug" => "civilekonom",
        "title" => "Civilekonom",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "civilekonom lön",
        "avg_salary" => 52000,
        "median_salary" => 50000,
        "description" => "En civilekonom har en bred akademisk utbildning och arbetar med ekonomisk styrning, analys eller ledarskap.",
        "description_extended" => "Civilekonomer kan ha roller som controller, marknadschef, revisor eller analytiker. Utbildningen är 4 år (240 hp). Lönen varierar kraftigt beroende på roll och bransch.",
        "education" => "Civilekonomprogrammet (4 år, 240 hp).",
        "salary_by_sector" => ["privat" => 54000, "offentlig" => 48000],
        "pros" => ["Bred arbetsmarknad", "Bra lön", "Karriärmöjligheter", "Internationellt gångbar"],
        "cons" => ["Hög konkurrens om instegsjobb", "Krävande studier", "Stressigt i vissa roller", "Mycket övertid"],
        "faq" => [
            ["question" => "Vad tjänar en civilekonom?", "answer" => "Snittet är 52 000 kr, men ingångslönen är lägre (ca 32-35 000 kr) och slutlönen kan vara mycket hög."],
            ["question" => "Vad gör man som civilekonom?", "answer" => "Allt från bokföring och revision till marknadsföring, banktjänster och företagsledning."],
            ["question" => "Vilken utbildning krävs?", "answer" => "Civilekonomexamen (240 hp)."],
            ["question" => "Är det lätt att få jobb?", "answer" => "Ja, men konkurrensen är hård om de mest attraktiva traineetjänsterna."],
            ["question" => "Vad är skillnaden mot ekonom?", "answer" => "Civilekonom är en skyddad yrkestitel (sedan 2007) för den 4-åriga utbildningen."]
        ],
        "kd" => 16, "volume" => 1600,
        "scb" => [
            "ssyk_code" => "241", "year" => 2024,
            "salary_total" => 52000, "salary_men" => 56000, "salary_women" => 49000,
            "gender_gap_percent" => 87.5, "evolution_10y_percent" => 28,
            "history" => ["2014" => 40600, "2015" => 41800, "2016" => 43000, "2017" => 44500, "2018" => 46000, "2019" => 47500, "2020" => 48500, "2021" => 49500, "2022" => 50500, "2023" => 51200, "2024" => 52000],
            "history_men" => ["2014" => 43500, "2015" => 45000, "2016" => 46200, "2017" => 48000, "2018" => 49500, "2019" => 51000, "2020" => 52000, "2021" => 53500, "2022" => 54500, "2023" => 55200, "2024" => 56000],
            "history_women" => ["2014" => 38000, "2015" => 39000, "2016" => 40200, "2017" => 41500, "2018" => 42800, "2019" => 44000, "2020" => 45000, "2021" => 46000, "2022" => 47000, "2023" => 48000, "2024" => 49000],
            "percentiles" => ["p10" => 35000, "p25" => 42000, "p50" => 50000, "p75" => 60000, "p90" => 75000],
            "salary_by_age" => ["18-24" => 33000, "25-34" => 44000, "35-44" => 55000, "45-54" => 60000, "55-64" => 58000, "65+" => 50000]
        ]
    ],

    // 5. Nätverkstekniker
    [
        "category" => "Teknik & IT",
        "slug" => "natverkstekniker",
        "title" => "Nätverkstekniker",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "nätverkstekniker lön",
        "avg_salary" => 39000,
        "median_salary" => 38500,
        "description" => "En nätverkstekniker installerar, driftar och övervakar datanätverk (LAN/WAN) på företag.",
        "description_extended" => "Ansvarar för att internet, wifi och brandväggar fungerar. Arbetet är tekniskt och kräver kunskap om routrar, switchar och säkerhet. Certifieringar som Cisco CCNA är värdefulla.",
        "education" => "YH-utbildning (2 år) eller högskola.",
        "salary_by_sector" => ["privat" => 40000, "offentlig" => 38000],
        "pros" => ["Teknisk spetskompetens", "Hög efterfrågan", "Bra lönepotential", "Tydliga uppgifter"],
        "cons" => ["Jourtjänstgöring", "Stressigt vid nätverksproblem", "Måste ständigt plugga nytt", "Stillasittande"],
        "faq" => [
            ["question" => "Vad tjänar en nätverkstekniker?", "answer" => "Genomsnittslönen är ca 39 000 kr, men seniora tekniker tjänar betydligt mer."],
            ["question" => "Vilka certifikat är bra?", "answer" => "CCNA (Cisco), CCNP och olika säkerhetscertifieringar höjer lönen."],
            ["question" => "Var jobbar man?", "answer" => "IT-avdelningar, internetleverantörer (ISP), konsultbolag och datacenter."],
            ["question" => "Är det framtidssäkert?", "answer" => "Ja, allt mer kopplas upp, så behovet av nätverksexperter ökar."],
            ["question" => "Vad gör man?", "answer" => "Konfigurerar switchar, felsöker uppkopplingar, installerar wifi och övervakar trafik."]
        ],
        "kd" => 13, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "3513", "year" => 2024,
            "salary_total" => 39000, "salary_men" => 39500, "salary_women" => 38000,
            "gender_gap_percent" => 96.2, "evolution_10y_percent" => 26,
            "history" => ["2014" => 31000, "2015" => 31800, "2016" => 32600, "2017" => 33500, "2018" => 34500, "2019" => 35500, "2020" => 36500, "2021" => 37500, "2022" => 38200, "2023" => 38600, "2024" => 39000],
            "history_men" => ["2014" => 31400, "2015" => 32200, "2016" => 33000, "2017" => 34000, "2018" => 35000, "2019" => 36000, "2020" => 37000, "2021" => 38000, "2022" => 38800, "2023" => 39200, "2024" => 39500],
            "history_women" => ["2014" => 30000, "2015" => 30800, "2016" => 31600, "2017" => 32400, "2018" => 33200, "2019" => 34000, "2020" => 34800, "2021" => 35800, "2022" => 36500, "2023" => 37000, "2024" => 38000],
            "percentiles" => ["p10" => 30000, "p25" => 34000, "p50" => 38500, "p75" => 44000, "p90" => 50000],
            "salary_by_age" => ["18-24" => 30000, "25-34" => 36000, "35-44" => 41000, "45-54" => 42000, "55-64" => 41000, "65+" => 28000]
        ]
    ],

    // 6. UX-designer
    [
        "category" => "Teknik & IT",
        "slug" => "ux-designer",
        "title" => "UX-designer",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "ux designer lön",
        "avg_salary" => 46000,
        "median_salary" => 45000,
        "description" => "En UX-designer (User Experience) arbetar med att göra digitala produkter användarvänliga och intuitiva.",
        "description_extended" => "Genom research, wireframing och tester säkerställer UX-designern att användarens behov står i centrum. Arbetar ofta i team med utvecklare och produktägare.",
        "education" => "Kandidatexamen i interaktionsdesign eller YH-utbildning.",
        "salary_by_sector" => ["privat" => 47000, "offentlig" => 43000],
        "pros" => ["Kreativt", "Hög efterfrågan", "Bra lön", "Möjlighet att påverka"],
        "cons" => ["Sittande arbete", "Ständig teknikutveckling", "Kan vara svårt att förklara värdet för vissa", "Deadlines"],
        "faq" => [
            ["question" => "Vad tjänar en UX-designer?", "answer" => "Genomsnittslönen är ca 46 000 kr. Erfarna kan tjäna 60 000+ kr."],
            ["question" => "Vad betyder UX?", "answer" => "User Experience (Användarupplevelse). Det handlar om hur en produkt känns att använda."],
            ["question" => "Vilken utbildning behövs?", "answer" => "Yrkeshögskola (2 år) eller universitet (Systemvetenskap/Design)."],
            ["question" => "Måste man kunna koda?", "answer" => "Nej, men grundläggande förståelse för kod hjälper i samarbetet med utvecklare."],
            ["question" => "Är UI och UX samma sak?", "answer" => "Nej. UI (User Interface) är det visuella, UX är upplevelsen och flödet. Många gör dock båda."]
        ],
        "kd" => 11, "volume" => 1300,
        "scb" => [
            "ssyk_code" => "2513", "year" => 2024,
            "salary_total" => 46000, "salary_men" => 47000, "salary_women" => 45000,
            "gender_gap_percent" => 95.7, "evolution_10y_percent" => 28,
            "history" => ["2014" => 36000, "2015" => 37000, "2016" => 38000, "2017" => 39500, "2018" => 41000, "2019" => 42500, "2020" => 43500, "2021" => 44500, "2022" => 45500, "2023" => 45800, "2024" => 46000],
            "history_men" => ["2014" => 36500, "2015" => 37500, "2016" => 39000, "2017" => 40500, "2018" => 42000, "2019" => 43500, "2020" => 44500, "2021" => 45500, "2022" => 46500, "2023" => 46800, "2024" => 47000],
            "history_women" => ["2014" => 35500, "2015" => 36500, "2016" => 37500, "2017" => 38500, "2018" => 39500, "2019" => 41000, "2020" => 42000, "2021" => 43000, "2022" => 44000, "2023" => 44500, "2024" => 45000],
            "percentiles" => ["p10" => 34000, "p25" => 39000, "p50" => 45000, "p75" => 52000, "p90" => 60000],
            "salary_by_age" => ["18-24" => 32000, "25-34" => 40000, "35-44" => 48000, "45-54" => 50000, "55-64" => 49000, "65+" => 45000]
        ]
    ],

    // 7. Logistiker
    [
        "category" => "Transport & Logistik",
        "slug" => "logistiker",
        "title" => "Logistiker",
        "banner_image" => "/img/professions/default-banner.png",
        "keyword" => "logistiker lön",
        "avg_salary" => 36500,
        "median_salary" => 36000,
        "description" => "En logistiker planerar och optimerar flöden av varor och information för att effektivisera transporter.",
        "description_extended" => "Kan arbeta med inköp, transportplanering eller lagerstyrning. Rollen handlar om att sänka kostnader och hålla leveranstider. Arbetar på åkerier, industri eller e-handel.",
        "education" => "YH-utbildning inom logistik (2 år) eller högskoleingenjör.",
        "salary_by_sector" => ["privat" => 37000, "offentlig" => 35000],
        "pros" => ["Problemlösning", "Internationellt", "Växande e-handelsbransch", "Tydliga resultat"],
        "cons" => ["Stress vid förseningar", "Kan vara ensamt", "Sittande arbete", "Pressade marginaler"],
        "faq" => [
            ["question" => "Vad tjänar en logistiker?", "answer" => "Genomsnittslönen är ca 36 500 kr. Logistikchefer tjänar betydligt mer."],
            ["question" => "Vad är logistik?", "answer" => "Att se till att rätt vara finns på rätt plats, i rätt tid och till rätt kostnad."],
            ["question" => "Vilken utbildning ska man välja?", "answer" => "YH-utbildning till Logistiker är populärt och leder ofta till jobb."],
            ["question" => "Var jobbar logistiker?", "answer" => "På transportföretag (DHL, PostNord), e-handlare, hamnar och industriföretag."],
            ["question" => "Är det brist på logistiker?", "answer" => "Ja, e-handelns tillväxt har ökat behovet av logistikkompetens."]
        ],
        "kd" => 15, "volume" => 1000,
        "scb" => [
            "ssyk_code" => "4323", "year" => 2024,
            "salary_total" => 36500, "salary_men" => 37500, "salary_women" => 35000,
            "gender_gap_percent" => 93.3, "evolution_10y_percent" => 24,
            "history" => ["2014" => 29400, "2015" => 30200, "2016" => 31000, "2017" => 31800, "2018" => 32600, "2019" => 33500, "2020" => 34200, "2021" => 35000, "2022" => 35800, "2023" => 36200, "2024" => 36500],
            "history_men" => ["2014" => 30200, "2015" => 31000, "2016" => 31800, "2017" => 32800, "2018" => 33600, "2019" => 34500, "2020" => 35200, "2021" => 36000, "2022" => 36800, "2023" => 37200, "2024" => 37500],
            "history_women" => ["2014" => 28200, "2015" => 29000, "2016" => 29800, "2017" => 30500, "2018" => 31200, "2019" => 32000, "2020" => 32800, "2021" => 33500, "2022" => 34200, "2023" => 34600, "2024" => 35000],
            "percentiles" => ["p10" => 29000, "p25" => 32000, "p50" => 36000, "p75" => 40000, "p90" => 45000],
            "salary_by_age" => ["18-24" => 29000, "25-34" => 34000, "35-44" => 38000, "45-54" => 39000, "55-64" => 38000, "65+" => 35000]
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
