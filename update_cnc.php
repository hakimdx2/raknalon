<?php
$data = json_decode(file_get_contents('data/professions.json'), true);

// Complete new CNC entry based on etude 5.md
$newCnc = [
    "category" => "Industri & Tillverkning",
    "slug" => "cnc-operator",
    "title" => "CNC-operatör Lön 2026",
    "banner_image" => "/img/professions/default-banner.webp",
    "keyword" => "cnc-operatör lön",
    "avg_salary" => 35200,
    "median_salary" => 34200,
    "ingangslön" => 26500,
    "min_salary" => 26000,
    "max_salary" => 45000,
    "description" => "CNC-operatörer programmerar, ställer in och övervakar datorstyrda maskiner som fräser, svarvar eller borrar detaljer i metall, trä eller plast. Medellönen är 35 200 kr/månad — med OB-tillägg kan du nå 44 000+ kr.",
    "description_extended" => "Vägen till CNC-operatör tar cirka 9–12 månader via Yrkesvux och är <strong>helt gratis i Sverige</strong>. Det råder <strong>stor brist på CNC-operatörer</strong> (147+ lediga tjänster januari 2026), vilket ger utmärkta karriärmöjligheter. <strong>Västsverige</strong> betalar högst (+10% över snittet) tack vare fordonsindustrin. Skiftarbete (2-skift, 3-skift) kan öka lönen med 20–30%.",
    "education" => "<strong>Yrkesvux</strong> (9–12 månader) är den vanligaste vägen. Inkluderar CNC-programmering (G-kod), CAD/CAM-mjukvara (Mastercam, Fusion 360), ritningsläsning och säkerhet. <strong>Grönt certifikat</strong> (säkerhetscertifikat) är obligatoriskt.",
    "salary_by_sector" => [
        "privat" => 35800,
        "offentlig" => 33500
    ],
    "experience_levels" => [
        [
            "years" => "Nybörjare (0-1 år)",
            "salary" => 26500,
            "range" => "24 000–30 000 kr",
            "description" => "Nyutbildad, övervakas av erfaren operatör"
        ],
        [
            "years" => "Junior (1-3 år)",
            "salary" => 28500,
            "range" => "26 000–32 000 kr",
            "description" => "Självständigt arbete, grundläggande programmering"
        ],
        [
            "years" => "Erfaren (3-7 år)",
            "salary" => 34200,
            "range" => "31 000–37 000 kr",
            "description" => "Komplex programmering, kvalitetskontroll"
        ],
        [
            "years" => "Senior (7+ år)",
            "salary" => 38000,
            "range" => "36 000–42 000 kr",
            "description" => "Expert, mentorskap, problemlösning"
        ],
        [
            "years" => "Specialist (5-axlig, CAM)",
            "salary" => 39000,
            "range" => "37 000–45 000+ kr",
            "description" => "CNC-ställare, CAM-beredare, programmerare"
        ]
    ],
    "specialties" => [
        ["name" => "CAM-beredare (Programmerare)", "salary" => 43000, "diff" => "+22,2%", "description" => "Skapar G-kod och bearbetningsstrategier", "roi_months" => 12],
        ["name" => "CNC-ställare", "salary" => 40000, "diff" => "+13,6%", "description" => "Riggning och inställning av maskiner", "roi_months" => 12],
        ["name" => "5-axlig specialist", "salary" => 41000, "diff" => "+16,5%", "description" => "Expert på komplexa fleraxliga maskiner", "roi_months" => 18],
        ["name" => "CNC + Svetsning", "salary" => 39000, "diff" => "+10,8%", "description" => "Kombination CNC och svetsningskompetens", "roi_months" => 16],
        ["name" => "Fräsare", "salary" => 35500, "diff" => "+0,9%", "description" => "Fräsmaskin-specialist", "roi_months" => 0],
        ["name" => "Svarvare", "salary" => 35000, "diff" => "-0,6%", "description" => "Svarvmaskin-specialist", "roi_months" => 0],
        ["name" => "Grundutbildad", "salary" => 35200, "diff" => "0%", "description" => "Bas CNC-operatör", "roi_months" => 0]
    ],
    "career_paths" => [
        [
            "title" => "CNC-ställare",
            "description" => "Ansvara för riggning och finjustering av maskiner",
            "new_salary" => 40000,
            "time" => "2-3 år",
            "cost" => "0 kr (on-the-job)",
            "roi_note" => "Snabb — direkt löneökning efter certifiering"
        ],
        [
            "title" => "CAM-beredare/Programmerare",
            "description" => "Skapa G-kod och bearbetningsstrategier i Mastercam/Fusion 360",
            "new_salary" => 43000,
            "time" => "6-12 månader",
            "cost" => "3 000–5 000 kr (certifiering)",
            "roi_note" => "Hög potential — mest eftertraktad specialisering"
        ],
        [
            "title" => "Produktionstekniker",
            "description" => "Optimera produktionsprocesser och effektivitet",
            "new_salary" => 45000,
            "time" => "2 år (Yrkeshögskola)",
            "cost" => "0 kr (gratis)",
            "roi_note" => "Längre väg men stabil karriär"
        ],
        [
            "title" => "Chef/Förman",
            "description" => "Leda team på 5–10 operatörer",
            "new_salary" => 46000,
            "time" => "5-7 år",
            "cost" => "Ledarskapsutbildning",
            "roi_note" => "Kräver erfarenhet och sociala kompetenser"
        ],
        [
            "title" => "Underhållstekniker CNC",
            "description" => "Preventivt och korrigerande underhåll av CNC-maskiner",
            "new_salary" => 41000,
            "time" => "12-18 månader",
            "cost" => "Intern utbildning",
            "roi_note" => "Stabil efterfrågan, mindre monotont"
        ]
    ],
    "ob_tillagg" => [
        "description" => "CNC-operatörer med skiftarbete får OB-tillägg som kan öka lönen rejält",
        "examples" => [
            ["type" => "Dagtid (06-18)", "extra" => "0%"],
            ["type" => "2-skift (dag/kväll)", "extra" => "+8-12%"],
            ["type" => "3-skift (dag/kväll/natt)", "extra" => "+15-25%"],
            ["type" => "Permanent nattskift", "extra" => "+18-30%"]
        ],
        "total_extra" => "3 000 – 10 500 kr/mån",
        "impact_text" => "En CNC-operatör med 3-skift kan nå 44 000 kr/månad istället för grundlönen 35 200 kr. Permanent natt ger upp till 45 700 kr."
    ],
    "forecast" => [
        "current_year" => "2024",
        "current_value" => 35200,
        "trend" => "-1,7%",
        "reason" => "Ökad utbildning balanserar brist",
        "data" => [
            ["year" => 2025, "value" => 35800, "change" => "+1,7%"],
            ["year" => 2026, "value" => 36600, "change" => "+2,2%"],
            ["year" => 2027, "value" => 37400, "change" => "+2,2%"],
            ["year" => 2028, "value" => 38300, "change" => "+2,4%"],
            ["year" => 2029, "value" => 39200, "change" => "+2,4%"],
            ["year" => 2030, "value" => 40100, "change" => "+2,3%"]
        ]
    ],
    "regional_salaries" => [
        ["region" => "Västsverige (Göteborg)", "salary" => 38800, "diff" => "+10,2%"],
        ["region" => "Sydsverige (Malmö)", "salary" => 35400, "diff" => "+0,6%"],
        ["region" => "Övre Norrland", "salary" => 34900, "diff" => "-0,9%"],
        ["region" => "Norra Mellansverige", "salary" => 34800, "diff" => "-1,1%"],
        ["region" => "Östra Mellansverige", "salary" => 34800, "diff" => "-1,1%"],
        ["region" => "Stockholm", "salary" => 33300, "diff" => "-5,4%"],
        ["region" => "Småland med Öarna", "salary" => 33500, "diff" => "-4,8%"],
        ["region" => "Mellersta Norrland", "salary" => 32100, "diff" => "-8,9%"]
    ],
    "lifetime_earnings" => [
        "amount" => "17 000 000 kr",
        "years" => 40,
        "note" => "Beräknat från 20 år till pension (60 år) med 2% årlig löneökning"
    ],
    "author" => [
        "name" => "Nala",
        "role" => "Löneexpert & Guide",
        "image" => "/img/team/nala.png",
        "bio" => "Din guide i lönedjungeln. Jag översätter krångliga siffror till ren svenska så du vet exakt vad du är värd."
    ],
    "workplaces" => [
        ["type" => "Fordonsindustri (Volvo, Scania)", "salary" => 38000],
        ["type" => "Flygindustri (SAAB)", "salary" => 40000],
        ["type" => "Medicinsk teknik", "salary" => 37000],
        ["type" => "Tung industri (Epiroc, Atlas Copco)", "salary" => 36000],
        ["type" => "PME/Underleverantörer", "salary" => 34000]
    ],
    "faq" => [
        [
            "question" => "Vad tjänar en CNC-operatör i Sverige 2026?",
            "answer" => "En CNC-operatör tjänar i snitt 35 200 kr/månad före skatt. Med skiftarbete (OB-tillägg) kan du nå 40 000–44 000+ kr. Västsverige betalar bäst (+10% över snittet) tack vare fordonsindustrin."
        ],
        [
            "question" => "Vad är ingångslön för CNC-operatör?",
            "answer" => "En nyutbildad CNC-operatör startar på cirka 26 500 kr/månad. Efter 3-5 år kan du nå 34 000+ kr. Specialisering (CAM-beredare, 5-axlig) kan ge 39 000–43 000 kr."
        ],
        [
            "question" => "Hur lång är utbildningen till CNC-operatör?",
            "answer" => "Yrkesvux tar 9–12 månader och är helt gratis i Sverige. Du lär dig G-kod programmering, CAD/CAM-mjukvara (Mastercam, Fusion 360), ritningsläsning och säkerhet. Grönt certifikat är obligatoriskt."
        ],
        [
            "question" => "Är det brist på CNC-operatörer?",
            "answer" => "Ja! Det finns 147+ lediga tjänster (januari 2026) och stor brist på kvalificerade operatörer. 95% av nyutbildade får jobb inom 3 månader. Medelåldern är 48 år — många pensioneras snart."
        ],
        [
            "question" => "Hur mycket tjänar man med skiftarbete?",
            "answer" => "OB-tillägg kan öka din lön med 8–30%. Med 2-skift: 38 000–39 500 kr. Med 3-skift: 40 500–44 000 kr. Permanent nattskift: upp till 45 700 kr/månad!"
        ],
        [
            "question" => "Vilka regioner betalar bäst?",
            "answer" => "Västsverige (Göteborg) toppar med 38 800 kr (+10%). Sydsverige (Malmö) ligger på snittet. Stockholm betalar faktiskt lägre (-5%) på grund av högre konkurrens om tjänsterna."
        ],
        [
            "question" => "Hur blir man CAM-beredare?",
            "answer" => "CAM-beredare (programmerare) tjänar 43 000 kr (+22% över snittet). Det kräver 6–12 månaders vidareutbildning i Mastercam eller Fusion 360. Certifieringen kostar 3 000–5 000 kr men lönar sig snabbt."
        ],
        [
            "question" => "Vilka företag anställer CNC-operatörer?",
            "answer" => "Stora arbetsgivare: Volvo, Scania, SAAB Aeronautics, Epiroc, Atlas Copco. Fordonsindustrin står för 35% av jobben. Flygindustrin betalar bäst (37 000–42 000 kr) men ställer högre krav."
        ],
        [
            "question" => "Hur många jobbar som CNC-operatör i Sverige?",
            "answer" => "Cirka 20 000–25 000 CNC-operatörer arbetar i Sverige. Arbetslösheten är extremt låg (2,1% vs 4,5% nationellt). Marknaden växer med 8–12% de närmaste 5 åren."
        ],
        [
            "question" => "Hur ser karriären ut långsiktigt?",
            "answer" => "Typisk karriär: Junior (27k) → Erfaren (34k) → Specialist/CNC-ställare (38-40k) → Chef/Produktionstekniker (45k+). Med 10+ års erfarenhet kan du bli förman eller övergå till kvalitet/underhåll."
        ]
    ],
    "scb" => [
        "ssyk_code" => "7223",
        "year" => 2026,
        "source" => "SCB - Statistiska centralbyrån & IF Metall",
        "salary_total" => 35200,
        "salary_men" => 35400,
        "salary_women" => 34100,
        "gender_gap_percent" => 96.3,
        "percentiles" => [
            "p10" => 26500,
            "p25" => 30000,
            "p50" => 34200,
            "p75" => 38000,
            "p90" => 42000
        ],
        "history" => [
            "2022" => 33000,
            "2023" => 34000,
            "2024" => 35200,
            "2025" => 35800
        ],
        "evolution_10y_percent" => 18.5
    ],
    "international" => [
        "norge" => 42000,
        "tyskland" => 38000,
        "danmark" => 40000
    ],
    "related_professions" => [
        "title" => "Liknande yrken inom Industri & Tillverkning",
        "items" => [
            [
                "title" => "Svetsare",
                "slug" => "svetsare",
                "avg_salary" => 36500,
                "median_salary" => 35800,
                "banner_image" => "/img/professions/default-banner.png"
            ],
            [
                "title" => "Industrielektriker",
                "slug" => "industrielektriker",
                "avg_salary" => 38200,
                "median_salary" => 37500,
                "banner_image" => "/img/professions/default-banner.png"
            ],
            [
                "title" => "Maskinoperatör",
                "slug" => "maskinoperator",
                "avg_salary" => 31500,
                "median_salary" => 30800,
                "banner_image" => "/img/professions/default-banner.png"
            ]
        ]
    ],
    "kd" => 35,
    "volume" => 8100,
    "pros" => [
        "Stor efterfrågan — 147+ lediga tjänster, 95% får jobb inom 3 månader.",
        "Kort utbildning — 9–12 månader, helt gratis via Yrkesvux.",
        "OB-tillägg — Skiftarbete kan ge +20–30% i lön.",
        "Tydliga karriärvägar — CNC-ställare, CAM-beredare, produktionstekniker.",
        "Teknikintresse tillfredsställs — Arbete med avancerade maskiner och mjukvara."
    ],
    "cons" => [
        "Fysiskt krävande — Stående arbete 8 timmar, buller (60–90 dB).",
        "Monotont — Repetitiva uppgifter dag efter dag.",
        "Skiftarbete — Påverkar sömn, hälsa och socialt liv.",
        "Hög ansvar — Ett programmeringsfel kan förstöra dyra detaljer (500–5000 kr).",
        "Framtidsrisk — Automatisering och robotik kan minska behov på sikt."
    ],
    "meta_description" => "CNC-operatör lön 2026: 35 200 kr/mån ✓ | Med OB-tillägg 44 000+ kr | Västsverige +10% | 9 mån utbildning → Se lönestatistik per region & specialisering!",
    "hitta_jobb" => [
        "enabled" => true,
        "search_term" => "CNC-operatör",
        "links" => [
            [
                "platform" => "Indeed",
                "url" => "https://se.indeed.com/jobb?q=cnc-operat%C3%B6r&l=Sverige",
                "icon" => "/img/icons/indeed.svg"
            ],
            [
                "platform" => "Arbetsförmedlingen",
                "url" => "https://arbetsformedlingen.se/platsbanken/annonser?q=cnc-operat%C3%B6r",
                "icon" => "/img/icons/af.svg"
            ],
            [
                "platform" => "LinkedIn",
                "url" => "https://www.linkedin.com/jobs/search/?keywords=cnc-operat%C3%B6r&location=Sweden",
                "icon" => "/img/icons/linkedin.svg"
            ]
        ]
    ]
];

// Replace at index 14
$data[14] = $newCnc;

// Save
$json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('data/professions.json', $json);

echo "✅ CNC-operatör entry replaced successfully!\n";
echo "New entry has:\n";
echo "  - " . count($newCnc['experience_levels']) . " experience levels\n";
echo "  - " . count($newCnc['specialties']) . " specialties\n";
echo "  - " . count($newCnc['career_paths']) . " career paths\n";
echo "  - " . count($newCnc['regional_salaries']) . " regional salaries\n";
echo "  - " . count($newCnc['faq']) . " FAQs\n";
echo "  - Author: Nala\n";
echo "  - Forecast: 2024-2030\n";
echo "  - OB-tillägg: YES\n";
echo "  - Lifetime earnings: YES\n";
