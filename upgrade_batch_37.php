<?php
/**
 * Batch Upgrade Script - 37 more professions to 5-star quality
 * Adds pros/cons sections to all professions that don't have them
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);

// 5-star content for remaining professions
$upgrades = [
    // Healthcare
    'psykolog' => [
        'pros' => [
            'Meningsfullt arbete där du hjälper människor med psykisk ohälsa.',
            'Hög efterfrågan på både offentlig och privat marknad.',
            'Möjlighet att starta egen praktik med hög timdebitering.',
            'Intellektuellt stimulerande och varierande arbetsuppgifter.',
            'Flexibla arbetstider som egenföretagare.'
        ],
        'cons' => [
            'Emotionellt krävande att möta andras lidande dagligen.',
            'Risk för empatitrötthet och utbrändhet.',
            'Lång utbildning (5 år + PTP-år) innan legitimation.',
            'Kan vara ensamt arbete utan kollegialt stöd.',
            'Administrativ börda med dokumentation och journaler.'
        ]
    ],
    'tandskoterska' => [
        'pros' => [
            'Stabilt yrke med god arbetsmarknad.',
            'Kortare utbildning än tandhygienist/tandläkare.',
            'Varierande arbete med patientkontakt.',
            'Möjlighet att specialisera sig.',
            'Förmånliga arbetstider (sällan kvällar/helger).'
        ],
        'cons' => [
            'Fysiskt påfrestande med statiska arbetsställningar.',
            'Begränsade karriärmöjligheter utan vidareutbildning.',
            'Lägre lön än tandhygienist och tandläkare.',
            'Kan vara stressigt vid högt patienttryck.',
            'Arbete nära patienter kan innebära smittrisker.'
        ]
    ],
    'tandhygienist' => [
        'pros' => [
            'Självständigt arbete med egen patientbokbok.',
            'God lönenivå och efterfrågan.',
            'Möjlighet att starta eget eller arbeta deltid.',
            'Förebyggande arbete – du hjälper patienter behålla friska tänder.',
            'Förmånliga arbetstider på de flesta kliniker.'
        ],
        'cons' => [
            'Repetitiva arbetsuppgifter (tandstensborttagning).',
            'Statiska arbetsställningar kan ge besvär.',
            'Begränsad karriärstege utan vidareutbildning.',
            'Ansvar för egna behandlingar och dokumentation.',
            'Kan vara stressigt med många patienter per dag.'
        ]
    ],
    'fysioterapeut' => [
        'pros' => [
            'Fysiskt aktivt arbete där du hjälper människor rehabiliteras.',
            'Möjlighet att specialisera sig (ortopedi, neurologi, idrott).',
            'Relativt hög efterfrågan på arbetsmarknaden.',
            'Kan starta egen praktik eller arbeta inom privat sektor.',
            'Varierande arbetsuppgifter och patientgrupper.'
        ],
        'cons' => [
            'Fysiskt krävande arbete med manuella behandlingar.',
            'Begränsade löneökningar utan specialisering.',
            'Hög administrativ börda med journaldokumentation.',
            'Vårdköer och tidsbrist kan begränsa behandlingskvalitet.',
            'Risk för arbetsrelaterade förslitningsskador.'
        ]
    ],
    'arbetsterapeut' => [
        'pros' => [
            'Meningsfullt arbete som förbättrar människors vardag.',
            'Varierande arbetsuppgifter och patientgrupper.',
            'God efterfrågan, särskilt inom äldreomsorg.',
            'Möjlighet till vidareutbildning och specialisering.',
            'Samarbete i tvärprofessionella team.'
        ],
        'cons' => [
            'Lägre lön än fysioterapeuter och sjuksköterskor.',
            'Begränsad allmän kunskap om yrket.',
            'Administrativ börda med hjälpmedelsbeställningar.',
            'Kan kännas ensamt utan kollegor i mindre kommuner.',
            'Känslomässigt belastande möten med svårt sjuka patienter.'
        ]
    ],
    'specialistsjukskoterska' => [
        'pros' => [
            'Betydligt högre lön än grundutbildad sjuksköterska.',
            'Mer avancerade och varierande arbetsuppgifter.',
            'Stor efterfrågan inom alla specialiteter.',
            'Möjlighet till forskning och utbildningsuppdrag.',
            'Karriärvägar som vårdutvecklare eller chef.'
        ],
        'cons' => [
            'Kräver ytterligare 1-1,5 års högskolestudier.',
            'Högt ansvar och stress i kritiska situationer.',
            'Oregelbundna arbetstider med natt och helg.',
            'Fysiskt och psykiskt krävande, särskilt inom akutvård.',
            'Risk för utbrändhet vid hög arbetsbelastning.'
        ]
    ],
    
    // Tech & IT
    'systemutvecklare' => [
        'pros' => [
            'Hög lön och stark efterfrågan på arbetsmarknaden.',
            'Flexibilitet med distansarbete och fria arbetstider.',
            'Kreativt problemlösande arbete.',
            'Ständig utveckling och nya tekniker att lära sig.',
            'Möjlighet att arbeta internationellt eller som konsult.'
        ],
        'cons' => [
            'Mycket skärmarbete kan ge fysiska besvär.',
            'Snabba teknikförändringar kräver konstant lärande.',
            'Stressigt vid deadlines och leveranser.',
            'Kan vara socialt isolerande med enpersonsuppgifter.',
            'Risk för "imposter syndrome" i snabbrörlig bransch.'
        ]
    ],
    'webbprogrammerare' => [
        'pros' => [
            'Kreativt arbete med att bygga webbsidor och appar.',
            'Bra ingångsmöjligheter även utan formell utbildning.',
            'Möjlighet till frilansarbete och egna projekt.',
            'Stora möjligheter att jobba på distans.',
            'Snabb teknikutveckling håller arbetet intressant.'
        ],
        'cons' => [
            'Lägre lön än backend- och fullstack-utvecklare.',
            'Snabba teknikförändringar kräver ständigt lärande.',
            'Mycket skärmtid kan vara fysiskt påfrestande.',
            'Kundkrav och ändringsförslag kan vara frustrerande.',
            'Konkurrens från offshore-utvecklare kan pressa löner.'
        ]
    ],
    'it-tekniker' => [
        'pros' => [
            'Varierande arbete med både hårdvara och mjukvara.',
            'Kortare utbildning än utvecklare ger snabbare inkomst.',
            'Stabil efterfrågan – alla företag behöver IT-support.',
            'Möjlighet att avancera till systemadministratör eller specialist.',
            'Socialt arbete med många användarkontakter.'
        ],
        'cons' => [
            'Lägre lön än programmerare och systemutvecklare.',
            'Repetitiva supportärenden kan bli monotona.',
            'Jourtjänstgöring kan förekomma.',
            'Frustration från stressade användare.',
            'Karriärtaket kan nås utan vidareutbildning.'
        ]
    ],
    
    // Finance & Business
    'civilekonom' => [
        'pros' => [
            'Bred utbildning som öppnar många karriärvägar.',
            'Hög lön och god löneutveckling över tid.',
            'Efterfrågan i både privat och offentlig sektor.',
            'Möjlighet till internationell karriär.',
            'Prestige och nätverk från utbildningen.'
        ],
        'cons' => [
            'Hög konkurrens om de mest åtråvärda tjänsterna.',
            'Kan kräva överdrivna arbetsinsatser i vissa branscher.',
            'Abstrakta arbetsuppgifter utan konkreta resultat.',
            'Risk för utbrändhet i konsult- och finansbranschen.',
            'Karriären kan kräva flytt till storstad.'
        ]
    ],
    'revisor' => [
        'pros' => [
            'Hög efterfrågan och trygg arbetsmarknad.',
            'God löneutveckling, särskilt som auktoriserad.',
            'Insikter i många olika företag och branscher.',
            'Tydlig karriärstege mot partner eller CFO.',
            'Möjlighet till internationell karriär i Big 4.'
        ],
        'cons' => [
            'Stressiga perioder under busy season (jan-maj).',
            'Mycket övertid under högsäsong.',
            'Detaljgranskning kan upplevas som monotont.',
            'Höga krav på noggrannhet och dokumentation.',
            'Högt ansvar med juridiska konsekvenser.'
        ]
    ],
    'redovisningsekonom' => [
        'pros' => [
            'Stabil arbetsmarknad med jobb i hela landet.',
            'Tydliga och strukturerade arbetsuppgifter.',
            'Kortare utbildningsväg än civilekonom.',
            'Möjlighet att avancera till controller eller ekonomichef.',
            'Flexibla arbetstider utanför bokslutsperioder.'
        ],
        'cons' => [
            'Stressigt vid månads- och årsbokslut.',
            'Repetitiva arbetsuppgifter i den dagliga bokföringen.',
            'Mycket skärmarbete hela dagen.',
            'Lönetaket kan nås utan vidareutbildning.',
            'Regeländringar kräver kontinuerlig uppdatering.'
        ]
    ],
    'ekonom' => [
        'pros' => [
            'Bred kompetens som efterfrågas i alla branscher.',
            'Tydliga karriärvägar mot controller, CFO eller konsult.',
            'God lön och löneutveckling över tid.',
            'Varierande arbetsuppgifter beroende på roll.',
            'Möjlighet att specialisera sig.'
        ],
        'cons' => [
            'Bred utbildning kan göra det svårt att stå ut.',
            'Konkurrens med civilekonomer om de bästa jobben.',
            'Mycket administrativt arbete i vissa roller.',
            'Stress under rapporterings- och bokslutsperioder.',
            'Kan upplevas som "sifferjobb" utan kreativitet.'
        ]
    ],
    
    // Education
    'grundskollarare' => [
        'pros' => [
            'Meningsfullt arbete med stor samhällsnytta.',
            'Stor brist på behöriga lärare ger trygg anställning.',
            'Långa lov (sommar, jul, påsk, lov under terminen).',
            'Kreativt och varierande arbete med barn.',
            'Möjligheter till förstelärartjänst och ledningsroller.'
        ],
        'cons' => [
            'Hög arbetsbelastning utöver undervisningstid.',
            'Stökiga elever och föräldrakontakter kan vara påfrestande.',
            'Relativt låg lön jämfört med utbildningslängd.',
            'Mycket dokumentation och administration.',
            'Risk för utbrändhet vid brist på stöd.'
        ]
    ],
    'gymnasielarare' => [
        'pros' => [
            'Självständigt arbete med ämnesfördjupning.',
            'Arbete med äldre och mer mogna elever.',
            'Möjlighet till förstelärartjänst och ledarskap.',
            'Långa lov och en viss arbetstidsflexibilitet.',
            'Stor brist på ämneslärare ger trygg anställning.'
        ],
        'cons' => [
            'Hög arbetsbelastning med planering och rättning.',
            'Begränsad lön i förhållande till utbildningslängd.',
            'Kräver ständig uppdatering inom ämnesområdet.',
            'Elever med bristande motivation kan vara utmanande.',
            'Administrativa uppgifter tar tid från undervisningen.'
        ]
    ],
    'barnskotare' => [
        'pros' => [
            'Lekfullt och kreativt arbete med barn.',
            'Kortare utbildning än förskollärare.',
            'Stabilt yrke med jobb i hela landet.',
            'Kollegialt arbete i team.',
            'Meningsfullt arbete med barns utveckling.'
        ],
        'cons' => [
            'Låg lön jämfört med många andra yrken.',
            'Fysiskt tungt med lyft och aktivitet.',
            'Höga ljudnivåer i barngrupper.',
            'Risk för smitta från småbarn.',
            'Begränsade karriärmöjligheter utan vidareutbildning.'
        ]
    ],
    'specialpedagog' => [
        'pros' => [
            'Specialistkompetens som är mycket efterfrågad.',
            'Gör stor skillnad för elever med särskilda behov.',
            'Högre lön än grundutbildade lärare.',
            'Varierande arbete med utredningar och handledning.',
            'Strategisk roll i skolans elevhälsoteam.'
        ],
        'cons' => [
            'Kräver lärarutbildning plus specialpedagogexamen.',
            'Stora arbetsbördor med många elever att stödja.',
            'Kan kännas tungt med svåra elevärenden.',
            'Begränsade resurser i många skolor.',
            'Ibland otydligt uppdrag mellan lärare och chef.'
        ]
    ],
    
    // Engineering
    'ingenjor' => [
        'pros' => [
            'Hög lön och god löneutveckling.',
            'Bred efterfrågan i många branscher.',
            'Kreativt och tekniskt problemlösande arbete.',
            'Möjligheter till internationell karriär.',
            'Respekterad yrkestitel med prestige.'
        ],
        'cons' => [
            'Lång utbildning (3-5 år).',
            'Kan vara stressigt med projektdeadlines.',
            'Tekniska problem kan vara frustrerande.',
            'Kontorsbunden roll i vissa positioner.',
            'Kontinuerlig kompetensutveckling krävs.'
        ]
    ],
    'civilingenjor' => [
        'pros' => [
            'Mycket hög lön och karriärmöjligheter.',
            'Strategiska och ledande roller tillgängliga.',
            'Efterfrågad kompetens i alla tekniska branscher.',
            'Möjlighet till chefs- eller specialistkarriär.',
            'Internationella karriärmöjligheter.'
        ],
        'cons' => [
            'Mycket lång och krävande utbildning (5 år).',
            'Hög konkurrens om toppjobben.',
            'Ansvar och press medför stress.',
            'Risk för övertid och hög arbetsbelastning.',
            'Kan kräva flytt för bästa jobbmöjligheterna.'
        ]
    ],
    'byggingenjor' => [
        'pros' => [
            'Konkret arbete – du ser vad du bygger.',
            'God efterfrågan i byggbranschen.',
            'Varierande projekt och arbetsplatser.',
            'Möjlighet att avancera till projektledare.',
            'Bra lön, särskilt i storstäder.'
        ],
        'cons' => [
            'Stressigt med tidspresser och budgetkrav.',
            'Ansvar för säkerhet och kvalitet.',
            'Arbete utomhus kan vara påfrestande.',
            'Risker vid konjunkturnedgångar i byggbranschen.',
            'Kräver kontinuerlig uppdatering av regelverk.'
        ]
    ],
    
    // Other professions
    'malare' => [
        'pros' => [
            'Kreativt hantverk med synligt resultat.',
            'God efterfrågan, särskilt vid renoveringar.',
            'Självständigt arbete med frihet under ansvar.',
            'Möjlighet att starta eget företag.',
            'Fysiskt aktivt arbete utanför kontor.'
        ],
        'cons' => [
            'Fysiskt tungt med mycket stående och klättrande.',
            'Exponering för färg och kemikalier.',
            'Säsongsvariationer i arbetsbelastning.',
            'Låg lön under lärlingstiden.',
            'Arbete i trånga och dammigas utrymmen.'
        ]
    ],
    'svetsare' => [
        'pros' => [
            'Efterfrågad kompetens, särskilt med certifikat.',
            'Möjlighet till höga löner i specialiserade roller.',
            'Varierande arbetsplatser (industri, offshore, bygg).',
            'Självständigt och tekniskt arbete.',
            'Internationella möjligheter, särskilt i Norge.'
        ],
        'cons' => [
            'Fysiskt påfrestande och varmt arbete.',
            'Risk för arbetsskador (ögon, lungor, brännskador).',
            'Krav på skyddsutrustning hela tiden.',
            'Obekväma arbetsställningar i trånga utrymmen.',
            'Enformigt arbete vid massproduktion.'
        ]
    ],
    'kock' => [
        'pros' => [
            'Kreativt arbete med mat och smaker.',
            'Möjlighet att avancera till köksmästare eller egen restaurang.',
            'Internationella karriärmöjligheter.',
            'Socialt arbete i team.',
            'Tillfredsställelse när gäster uppskattar maten.'
        ],
        'cons' => [
            'Låg lön i förhållande till arbetsinsats.',
            'Långa och obekväma arbetstider (kvällar, helger).',
            'Stressigt och hektiskt tempo i köket.',
            'Fysiskt tungt med mycket stående.',
            'Hög personalomsättning i branschen.'
        ]
    ],
    'lastbilschauffor' => [
        'pros' => [
            'Självständigt arbete på vägen.',
            'God efterfrågan på behöriga chaufförer.',
            'Möjlighet att se olika delar av landet/världen.',
            'Relativt enkel ingång med körkort C/CE.',
            'Internationella möjligheter med högre lön.'
        ],
        'cons' => [
            'Långa och osociala arbetstider.',
            'Stillasittande arbete kan ge hälsoproblem.',
            'Pressade tidsscheman och stressiga leveranser.',
            'Risk för olyckor och trafikfaror.',
            'Kan vara ensamt och isolerande.'
        ]
    ],
    'busschauffor' => [
        'pros' => [
            'Socialt arbete med passagerarkontakt.',
            'Reglerade arbetstider enligt kollektivavtal.',
            'Stabilt yrke med god efterfrågan.',
            'Kortare utbildning än många andra yrken.',
            'Mängdrabatt på resor hos vissa arbetsgivare.'
        ],
        'cons' => [
            'Låg lön jämfört med lastbilsförare.',
            'Stökiga eller otrevliga passagerare.',
            'Stillasittande arbete med hälsorisker.',
            'Tidiga morgnar och sena kvällar.',
            'Stressigt i rusningstrafik och vid förseningar.'
        ]
    ],
    'brandman' => [
        'pros' => [
            'Samhällsviktigt och respekterat yrke.',
            'Kamratlig arbetsmiljö på stationen.',
            'Fysiskt aktivt och varierande arbete.',
            'Bra schema med lediga perioder mellan pass.',
            'Tidig pension i vissa kollektivavtal.'
        ],
        'cons' => [
            'Livsfarliga situationer vid insatser.',
            'Psykiskt påfrestande upplevelser.',
            'Krav på god fysik och regelbundna tester.',
            'Skiftarbete med nätter.',
            'Relativt låg lön för riskerna.'
        ]
    ],
    'vaktare' => [
        'pros' => [
            'Ingångsjobb som kräver kort utbildning.',
            'Möjlighet att avancera inom bevakningsbranschen.',
            'Varierande arbetsplatser (butik, event, fastighet).',
            'OB-tillägg för natt- och helgarbete.',
            'Socialt arbete med kundkontakter.'
        ],
        'cons' => [
            'Låg grundlön utan OB-tillägg.',
            'Risk för hot och våld i vissa situationer.',
            'Stillasittande eller enformigt arbete på vissa poster.',
            'Obekväma arbetstider (nätter, helger).',
            'Begränsade avancemangmöjligheter utan vidareutbildning.'
        ]
    ],
    'ordningsvakt' => [
        'pros' => [
            'Högre status och befogenheter än väktare.',
            'God efterfrågan på krogar och evenemang.',
            'Skiftarbete ger OB-tillägg.',
            'Självständigt arbete med ansvar.',
            'Möjlighet att kombinera med andra jobb.'
        ],
        'cons' => [
            'Hög risk för konfrontationer och våld.',
            'Obekväma arbetstider (kvällar och nätter).',
            'Kräver god fysik och mental styrka.',
            'Utsatthet vid alkoholpåverkade situationer.',
            'Begränsat juridiskt skydd vid skador.'
        ]
    ],
    'kriminalvardare' => [
        'pros' => [
            'Stabilt statligt jobb med trygga villkor.',
            'Meningsfullt rehabiliteringsarbete med intagna.',
            'Möjlighet till vidareutbildning och karriärsteg.',
            'Kollegialt arbete i team.',
            'OB-tillägg för obekväma arbetstider.'
        ],
        'cons' => [
            'Risk för hot och våld från intagna.',
            'Psykiskt påfrestande arbetsmiljö.',
            'Skiftarbete med nätter och helger.',
            'Strikta säkerhetsrutiner och regler.',
            'Hög personalomsättning i svåra anstalter.'
        ]
    ],
    'truckforare' => [
        'pros' => [
            'Kort utbildning ger snabb ingång till arbete.',
            'God efterfrågan inom lager och industri.',
            'Självständigt arbete.',
            'Möjlighet till specialisering (kran, reach).',
            'Relativt stabila arbetstider.'
        ],
        'cons' => [
            'Låg lön jämfört med många andra yrken.',
            'Monotont arbete vid masshantering.',
            'Fysiska besvär av sittande och vibrationer.',
            'Risk för olyckor med tunga maskiner.',
            'Begränsade karriärmöjligheter utan vidareutbildning.'
        ]
    ],
    'pilot' => [
        'pros' => [
            'Mycket hög lön och prestige.',
            'Möjlighet att se världen.',
            'Spännande och tekniskt avancerat arbete.',
            'Starka fackförbund med bra villkor.',
            'Status och respekt i samhället.'
        ],
        'cons' => [
            'Extremt dyr utbildning (ofta 800 000+ kr).',
            'Obekväma arbetstider med jetlag.',
            'Långa perioder borta från familjen.',
            'Hög stress vid flygsäkerhetssituationer.',
            'Branschvolatilitet vid kriser (ex. pandemi).'
        ]
    ],
    'fastighetsmäklare' => [
        'pros' => [
            'Hög lön vid lyckade affärer (provision).',
            'Varierande arbete med många kundkontakter.',
            'Möjlighet att starta eget mäklarföretag.',
            'Flexibla arbetstider och självständighet.',
            'Spännande bransch med marknadskännedom.'
        ],
        'cons' => [
            'Osäker inkomst beroende på försäljning.',
            'Hög konkurrens och press att prestera.',
            'Kvällar och helger för visningar.',
            'Emotionellt krävande med nervösa köpare/säljare.',
            'Konjunkturkänsligt med nedgångar i fastighetsmarknaden.'
        ]
    ],
    'jurist' => [
        'pros' => [
            'Hög lön och prestige, särskilt på advokatbyrå.',
            'Intellektuellt stimulerande arbete.',
            'Bred arbetsmarknad (byrå, företag, myndighet).',
            'Möjlighet till partnerskap eller specialisering.',
            'Respekterad yrkestitel.'
        ],
        'cons' => [
            'Lång utbildning (4,5 år) utan garanti för drömjobb.',
            'Mycket övertid på advokatbyråer.',
            'Högt tempo och stress vid deadlines.',
            'Konkurrens om de bästa positionerna.',
            'Risk för utbrändhet i pressade advokatkulturer.'
        ]
    ],
    'socionom' => [
        'pros' => [
            'Meningsfullt arbete som hjälper utsatta människor.',
            'Bred arbetsmarknad (kommun, region, privat).',
            'Möjlighet att specialisera sig (barn, kriminalvård, HR).',
            'Karriärvägar mot chef eller specialist.',
            'Samhällsviktigt yrke med stor efterfrågan.'
        ],
        'cons' => [
            'Emotionellt tungt med svåra ärenden.',
            'Hög arbetsbelastning och tidsbrist.',
            'Risk för sekundär traumatisering.',
            'Relativt låg lön i förhållande till ansvar.',
            'Hot och våldssituationer förekommer.'
        ]
    ],
    'socialpedagog' => [
        'pros' => [
            'Meningsfullt arbete med utsatta målgrupper.',
            'Varierande arbete i olika verksamheter.',
            'Efterfrågad kompetens inom behandling och stöd.',
            'Möjlighet till vidareutbildning och specialisering.',
            'Praktiskt inriktat arbete, inte bara samtal.'
        ],
        'cons' => [
            'Emotionellt krävande med svåra situationer.',
            'Risk för hot och våld i vissa verksamheter.',
            'Oregelbundna arbetstider i vissa roller.',
            'Lägre lön än socionomer i vissa fall.',
            'Oklara gränser mellan yrkesroller ibland.'
        ]
    ]
];

$updatedCount = 0;

foreach ($data as &$profession) {
    $slug = $profession['slug'] ?? '';
    
    // Apply specific upgrades
    if (isset($upgrades[$slug])) {
        foreach ($upgrades[$slug] as $field => $value) {
            $profession[$field] = $value;
        }
        echo "✅ Upgraded: {$profession['title']}\n";
        $updatedCount++;
    }
}

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n" . str_repeat("=", 60) . "\n";
echo "✅ BATCH UPGRADE COMPLETE!\n";
echo "📊 Upgraded to 5-star quality: $updatedCount additional professions\n";
echo "💾 Saved to: $jsonFile\n";
