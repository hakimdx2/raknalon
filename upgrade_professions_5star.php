<?php
/**
 * Upgrade Professions to 5-Star Quality
 * Fixes errors, enriches descriptions, and adds premium content
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);

// Premium 5-star content upgrades by slug
$upgrades = [
    'elektriker' => [
        'education' => 'El- och energiprogrammet på gymnasium (3 år) med inriktning elteknik, följt av lärlingstid (ca 2 år) hos ett elinstallationsföretag. Efter godkänt yrkesprov erhålls ECY-certifikat som ger rätt att arbeta självständigt.',
        'description' => 'Elektriker installerar, reparerar och underhåller elektriska system i byggnader, industrier och infrastruktur. Yrket kräver certifiering (ECY) och erbjuder goda karriärmöjligheter med hög efterfrågan på arbetsmarknaden.',
        'description_extended' => 'Som elektriker kan du välja mellan flera inriktningar: installationselektriker (nybyggnation och renovering), serviceelektriker (felsökning och reparation), industrielektriker (underhåll av maskiner) eller linjemontör (högspänning och elnät). Lönen följer en tydlig trappa enligt Installationsavtalet: lärling (ca 60% av fullbetald), 1:a års montör, 2:a års montör, 3:e års montör och slutligen fullbetald montör. Många elektriker arbetar på ackord vilket kan ge 10-30% högre lön. I Norge är efterfrågan och lönerna ännu högre, särskilt på oljeplattformar. Det finns goda möjligheter att starta eget eller vidareutbilda sig till elinstallatör med allmän behörighet.',
        'pros' => [
            'Stabil arbetsmarknad med hög efterfrågan i hela landet.',
            'Varierande arbetsuppgifter – inget projekt är det andra likt.',
            'Möjlighet till ackordslön som kan öka inkomsten rejält.',
            'Bra möjligheter att starta eget företag.',
            'Internationella möjligheter, särskilt i Norge.'
        ],
        'cons' => [
            'Fysiskt krävande arbete med mycket stående och klättrande.',
            'Arbete i kyla, värme och trånga utrymmen förekommer.',
            'Lärlingstiden innebär låg lön de första åren.',
            'Risker med el kräver ständig uppmärksamhet och säkerhetstänk.',
            'Oregelbundna arbetstider vid jour- och servicejobb.'
        ]
    ],
    'larare' => [
        'description' => 'Lärare undervisar, handleder och bedömer elevers kunskapsutveckling i skolan. Yrket kräver lärarlegitimation och är uppdelat i behörigheter: förskollärare, grundlärare F-3/4-6, ämneslärare 7-9 och gymnasielärare. Lönen varierar beroende på stadium, ämneskombination och kommun.',
        'description_extended' => 'Läraryrket är Sveriges viktigaste och mest samhällskritiska profession. Det råder stor brist på legitimerade lärare i alla stadier, vilket gör det till en trygg arbetsmarknad. Ämneslärare i matematik, NO och moderna språk är särskilt eftertraktade och har ofta högre ingångslöner. Förstelärare och lektorer med forskarutbildning har betydligt högre löner (45 000-55 000 kr/mån). Arbetet innebär planering, undervisning, bedömning och föräldrakontakt. Många lärare upplever hög arbetsbelastning med administrativt arbete utöver undervisningen. Internationellt finns möjligheter att arbeta på svenska skolor utomlands eller i Norge där lärarlönerna är högre.',
        'education' => 'Lärarutbildning på universitet/högskola: Grundlärarprogram F-3/4-6 (4 år, 240 hp), Ämneslärarprogram 7-9/Gymnasium (4,5-5,5 år, 270-330 hp) eller Förskollärarprogram (3,5 år, 210 hp). Lärarlegitimation utfärdas av Skolverket efter examen.',
        'pros' => [
            'Meningsfullt arbete där du gör verklig skillnad för unga människors liv.',
            'Trygg arbetsmarknad med stor brist på behöriga lärare.',
            'Långa lov och förmånliga arbetstider jämfört med många andra yrken.',
            'Möjlighet till karriärutveckling som förstelärare, lektor eller rektor.',
            'Goda möjligheter till vidareutbildning och specialisering.'
        ],
        'cons' => [
            'Hög arbetsbelastning med planering, bedömning och administration.',
            'Relativt låg lön i förhållande till utbildningslängd.',
            'Stökiga klassrum och elever med behov kan vara utmanande.',
            'Mycket tid går åt till möten och dokumentation.',
            'Risk för utbrändhet vid brist på stöd och resurser.'
        ]
    ],
    'forskollarare' => [
        'description' => 'Förskollärare ansvarar för barns lärande och utveckling i förskolan. Yrket kräver förskollärarexamen och legitimation. Du planerar pedagogiska aktiviteter, dokumenterar barnens utveckling och samarbetar tätt med föräldrar och kollegor.',
        'description_extended' => 'Som förskollärare har du det pedagogiska ansvaret i barngruppen och arbetar enligt förskolans läroplan (Lpfö 18). Arbetsuppgifterna inkluderar att planera och genomföra undervisning, observera och dokumentera barns utveckling, samt hålla utvecklingssamtal med föräldrar. Efterfrågan på legitimerade förskollärare är extremt hög och lönenivåerna har stigit markant de senaste åren. Arbetet är socialt och kreativt men också fysiskt krävande. Karriärvägar inkluderar biträdande rektor, rektor eller specialpedagog. Många kommuner erbjuder lönetillägg för att locka personal till områden med brist.',
        'education' => 'Förskollärarprogram (3,5 år, 210 hp) på universitet eller högskola. Utbildningen inkluderar VFU (verksamhetsförlagd utbildning/praktik). Efter examen ansöker man om förskollärarlegitimation hos Skolverket.',
        'pros' => [
            'Mycket meningsfullt arbete med barns tidiga utveckling.',
            'Hög efterfrågan – lätt att få jobb i hela landet.',
            'Kreativt och lekfullt arbete varje dag.',
            'Kollegialt arbete i team.',
            'Goda möjligheter till karriärutveckling.'
        ],
        'cons' => [
            'Fysiskt påfrestande med mycket lyft och aktivitet.',
            'Höga ljudnivåer i barngrupperna.',
            'Risk för smitta (barn är ofta sjuka).',
            'Stor arbetsbelastning med dokumentation och administration.',
            'Lägre lön än många andra akademiska yrken.'
        ]
    ],
    'ambulansforare' => [
        'education' => 'Ambulanssjukvårdare: YH-utbildning eller påbyggnad efter undersköterska (ca 1-2 terminer). Ambulanssjuksköterska: Sjuksköterskeexamen (3 år) + specialistutbildning i prehospital sjukvård (1 år). Körkort B krävs, C/C1 är meriterande.',
        'description' => 'Ambulanspersonal arbetar i team och ansvarar för prehospital akutsjukvård och säker transport av patienter. Sjuksköterskan har det medicinska ansvaret medan sjukvårdaren (tidigare kallad "ambulansförare") assisterar och kör fordonet.',
        'description_extended' => 'Ambulansyrket är ett av de mest krävande inom vården. Arbetet sker i skift dygnet runt med OB-tillägg för natt och helg. Ett ambulansteam består oftast av en ambulanssjuksköterska (med specialistutbildning) och en ambulanssjukvårdare. Sjuksköterskan har legitimation och får ge läkemedel samt utföra avancerade åtgärder. Arbetsplatser inkluderar landstingens ambulansorganisationer och privata vårdgivare som Falck, Samariten och Ambulanssjukvården. Det finns även specialiserade roller som helikoptersjuksköterska (Flight Nurse) med ännu högre lön. Arbetet innebär fysiska och psykiska påfrestningar men ger också stor tillfredsställelse.',
        'pros' => [
            'Spännande och varierande arbete – ingen dag är den andra lik.',
            'Känslan av att rädda liv och hjälpa människor i nöd.',
            'Självständigt arbete i team utanför sjukhuset.',
            'OB-tillägg ger högre lön vid skiftarbete.',
            'Möjlighet till specialisering (helikopter, MIVA, katastrofmedicin).'
        ],
        'cons' => [
            'Fysiskt och psykiskt påfrestande arbete.',
            'Risk för traumatiska upplevelser och PTSD.',
            'Oregelbundna arbetstider påverkar privatlivet.',
            'Slitage på kroppen med lyft och arbete under stress.',
            'Relativt låg lön som ambulanssjukvårdare.'
        ]
    ],
    'it-arkitekt' => [
        'pros' => [
            'Mycket hög lön och stor efterfrågan på arbetsmarknaden.',
            'Strategisk och intellektuellt stimulerande roll.',
            'Inflytande över företagets tekniska riktning.',
            'Möjlighet att arbeta med den senaste tekniken.',
            'Flexibilitet med distansarbete och internationella möjligheter.'
        ],
        'cons' => [
            'Höga förväntningar och ansvar för långsiktiga beslut.',
            'Kräver ständig kompetensutveckling i snabbföränderlig bransch.',
            'Kan vara stressigt med många intressenter och deadlines.',
            'Risk för "arkitekturtorn" – beslut långt från verklig utveckling.',
            'Många möten och dokumentation kan dominera arbetsdagen.'
        ]
    ],
    'snickare' => [
        'education' => 'Bygg- och anläggningsprogrammet på gymnasium (3 år) med inriktning husbyggnad, följt av lärlingstid (ca 2-3 år) tills du har yrkesbevis från Byggnadsindustrins Yrkesnämnd (BYN).',
        'pros' => [
            'Varierande arbete – allt från nybyggnation till finsnickeri.',
            'Konkret resultat – du ser vad du bygger varje dag.',
            'Hög efterfrågan och möjlighet att starta eget.',
            'Arbete utomhus på nya platser.',
            'Ackordslön kan ge betydligt högre inkomst.'
        ],
        'cons' => [
            'Fysiskt tungt arbete med risk för förslitningsskador.',
            'Arbete i alla väder – kyla, regn och värme.',
            'Låg lärlingslön under utbildningstiden.',
            'Osäkra anställningar under lågkonjunktur.',
            'Risk för olyckor på byggarbetsplatser.'
        ]
    ],
    'vd' => [
        'pros' => [
            'Högsta beslutsfattande position med stort inflytande.',
            'Mycket hög lön och förmåner (bonus, bil, pension).',
            'Strategiskt och varierande arbete.',
            'Prestige och extern nätverkskapital.',
            'Möjlighet att forma företagets framtid.'
        ],
        'cons' => [
            'Extremt högt arbetsansvar och press.',
            'Långa arbetsdagar och ständig tillgänglighet.',
            'Ensamhet på toppen – svårt att ha nära kollegor.',
            'Risk för avsked vid dåliga resultat.',
            'Personligt ansvar för företagets framgång och misslyckanden.'
        ]
    ],
    'ekonomiassistent' => [
        'pros' => [
            'Stabil arbetsmarknad med jobb i hela landet.',
            'Tydliga arbetsuppgifter med struktur.',
            'Möjlighet att jobba utan högskoleutbildning.',
            'Karriärvägar till redovisningsekonom eller controller.',
            'Passar dig som gillar siffror och ordning.'
        ],
        'cons' => [
            'Repetitiva arbetsuppgifter kan kännas monotona.',
            'Stressiga perioder vid bokslut och månadsavstämning.',
            'Lägre lön än ekonomer med högskoleexamen.',
            'Begränsade karriärmöjligheter utan vidareutbildning.',
            'Mycket skärmarbete.'
        ]
    ],
    'bibliotekarie' => [
        'pros' => [
            'Arbete med litteratur, kunskap och kultur.',
            'Lugn arbetsmiljö jämfört med många andra yrken.',
            'Möjlighet att specialisera sig (barn, forskning, IT).',
            'Kontakt med många olika människor.',
            'Meningsfullt arbete med folkbildning.'
        ],
        'cons' => [
            'Relativt låg lön jämfört med utbildningslängd.',
            'Begränsat antal tjänster – hög konkurrens om jobben.',
            'Risk för nedskärningar i kommunala budgetar.',
            'Kan upplevas som stillasittande arbete.',
            'Mindre karriärmöjligheter i mindre kommuner.'
        ]
    ],
    'apotekstekniker' => [
        'pros' => [
            'Kundkontakt och möjlighet att hjälpa människor.',
            'Kortare utbildning än farmaceut/receptarie.',
            'Stabil arbetsmarknad med apotek i hela landet.',
            'Möjlighet till specialisering och karriärutveckling.',
            'Renligt och strukturerat arbete.'
        ],
        'cons' => [
            'Lägre lön än receptarie och farmaceut.',
            'Stående arbete under stora delar av dagen.',
            'Stressigt vid högt kundtryck.',
            'Begränsade möjligheter utan receptbehörighet.',
            'Oregelbundna arbetstider (helger, kvällar) i vissa apotek.'
        ]
    ],
    'fastighetsskotare' => [
        'pros' => [
            'Varierande arbete – både ute och inne.',
            'Självständigt arbete med eget ansvarsområde.',
            'Stabil arbetsmarknad.',
            'Kontakt med hyresgäster och boende.',
            'Möjlighet att utvecklas till arbetsledare.'
        ],
        'cons' => [
            'Arbete i alla väder (snöröjning, trädgårdsarbete).',
            'Fysiskt krävande med lyft och tunga arbetsuppgifter.',
            'Kan behöva ha jour vid akuta problem.',
            'Lägre lön än många andra tekniska yrken.',
            'Klagomål från boende kan vara påfrestande.'
        ]
    ],
    'rormokare' => [
        'pros' => [
            'Hög efterfrågan och goda möjligheter att starta eget.',
            'Varierande arbetsuppgifter – service och nyinstallation.',
            'Bra lön som certifierad montör.',
            'Internationella möjligheter, särskilt i Norge.',
            'Konkret resultat av ditt arbete varje dag.'
        ],
        'cons' => [
            'Fysiskt tungt arbete i trånga utrymmen.',
            'Arbete med avlopp kan vara oaptitligt.',
            'Låg lärlingslön under utbildningstiden.',
            'Risk för arbetsskador (knän, rygg).',
            'Jour- och akutjobb kan störa privatlivet.'
        ]
    ],
    'controller' => [
        'pros' => [
            'Hög lön och god löneutveckling.',
            'Strategisk roll nära företagsledningen.',
            'Intellektuellt stimulerande analysarbete.',
            'Efterfrågad kompetens i alla branscher.',
            'Karriärvägar till CFO eller ekonomichef.'
        ],
        'cons' => [
            'Mycket skärmarbete och siffor.',
            'Stressigt vid månadsslut och bokslut.',
            'Höga förväntningar på leverans och noggrannhet.',
            'Kan upplevas som ensamt arbete.',
            'Kräver ständig kompetensutveckling (system, regelverk).'
        ]
    ]
];

$updatedCount = 0;

foreach ($data as &$profession) {
    $slug = $profession['slug'] ?? '';
    
    if (isset($upgrades[$slug])) {
        $upgrade = $upgrades[$slug];
        
        foreach ($upgrade as $field => $value) {
            $profession[$field] = $value;
        }
        
        echo "✅ Upgraded: {$profession['title']}\n";
        $updatedCount++;
    }
    
    // General cleanup: Remove generic SEO suffix if it ends the description
    if (isset($profession['description_extended'])) {
        $desc = $profession['description_extended'];
        // Remove the generic ending
        $desc = preg_replace('/\s*Använd vår lönekalkylator för att räkna ut din lön efter skatt\.\s*$/', '', $desc);
        // Also remove: Räkna ut din nettolön med vår lönekalkylator.
        $desc = preg_replace('/\s*Räkna ut din nettolön med vår lönekalkylator\.\s*$/', '', $desc);
        $profession['description_extended'] = trim($desc);
    }
}

// Save updated JSON
file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n" . str_repeat("=", 50) . "\n";
echo "✅ UPGRADE COMPLETE!\n";
echo "📊 Upgraded to 5-star quality: $updatedCount professions\n";
echo "🧹 Removed generic SEO suffixes from all descriptions\n";
echo "💾 Saved to: $jsonFile\n";
