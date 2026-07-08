<?php
/**
 * Generate Internal Linking (SEO Clusters)
 * Updates professions.json with 'related' field based on clusters.
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);

// Define SEO Clusters (Slugs)
$clusters = [
    'health' => [
        'title' => 'Vård & Hälsa',
        'slugs' => [
            'sjukskoterska', 'underskoterska', 'lakare', 'specialistsjukskoterska', 
            'specialistunderskoterska', 'st-lakare', 'barnmorska', 'tandlakare', 
            'tandskoterska', 'tandhygienist', 'psykolog', 'fysioterapeut', 
            'arbetsterapeut', 'dietist', 'logoped', 'apotekare', 'apotekstekniker',
            'biomedicinsk-analytiker', 'rontgensjukskoterska', 'vardbitrade',
            'ambulansforare', 'audionom', 'overlakare'
        ]
    ],
    'construction' => [
        'title' => 'Bygg & Hantverk',
        'slugs' => [
            'snickare', 'malare', 'elektriker', 'rormokare', 'svetsare', 
            'plattsattare', 'murare', 'golvlaggare', 'betongarbetare', 
            'fastighetsskotare', 'fastighetstekniker', 'drifttekniker', 
            'vvs-montor', 'cnc-operator', 'maskinoperator'
        ]
    ],
    'tech' => [
        'title' => 'IT & Teknik',
        'slugs' => [
            'systemutvecklare', 'webbprogrammerare', 'front-end-utvecklare', 
            'it-tekniker', 'supporttekniker', 'natverkstekniker', 
            'civilingenjor', 'ingenjor', 'byggingenjor', 'maskiningenjor', 
            'automationsingenjor', 'automationstekniker', 'elkraftsingenjor', 
            'ux-designer', 'projektledare', 'spelutvecklare'
        ]
    ],
    'education' => [
        'title' => 'Skola & Utbildning',
        'slugs' => [
            'forskollarare', 'grundskollarare', 'gymnasielarare', 'larare', 
            'barnskotare', 'fritidspedagog', 'specialpedagog', 'stodpedagog', 
            'elevassistent', 'kurator', 'studie-och-yrkesvagledare', 'rektor'
        ]
    ],
    'finance_law' => [
        'title' => 'Ekonomi & Juridik',
        'slugs' => [
            'ekonom', 'civilekonom', 'redovisningsekonom', 'redovisningskonsult', 
            'controller', 'business-controller', 'loneadministratok', 'loneadministratör', // Check typo
            'ekonomiassistent', 'banktjansteman', 'jurist', 'advokat', 'paralegal', 
            'aklagare', 'kronofogde', 'maklare', 'fastighetsmaklare', 'inkopare'
        ]
    ],
    'admin_hr' => [
        'title' => 'Admin & HR',
        'slugs' => [
            'administrator', 'receptionist', 'hr-specialist', 'rekryterare', 
            'personalvetare', 'medicinsk-sekreterare', 'kundtjanstmedarbetare', 
            'kommunikator'
        ]
    ],
    'transport' => [
        'title' => 'Transport & Logistik',
        'slugs' => [
            'lastbilschauffor', 'busschauffor', 'lokforare', 'tagvard', 
            'truckforare', 'logistiker', 'pilot', 'flygvardinna', 'brevbarare', 
            'sopbilschauffor'
        ]
    ],
    'security' => [
        'title' => 'Säkerhet & Blåljus',
        'slugs' => [
            'polis', 'brandman', 'vaktare', 'ordningsvakt', 'kriminalvardare', 
            'tulltjanteman', 'kustbevakare'
        ]
    ],
    'service' => [
        'title' => 'Service & Restaurang',
        'slugs' => [
            'kock', 'kallskanka', 'bagare', 'konditor', 'servitor', 'hovmastare', 
            'bartender', 'frisor', 'butikssaljare', 'butikschef', 'lokalvardare'
        ]
    ]
];

// Helper to find cluster for a slug
function findCluster($slug, $clusters) {
    foreach ($clusters as $key => $cluster) {
        if (in_array($slug, $cluster['slugs'])) {
            return $key;
        }
    }
    return null;
}

$updatedCount = 0;

foreach ($data as &$profession) {
    $slug = $profession['slug'];
    $clusterKey = findCluster($slug, $clusters);

    if ($clusterKey) {
        $clusterSlugs = $clusters[$clusterKey]['slugs'];
        
        // Remove self from candidates
        $candidates = array_diff($clusterSlugs, [$slug]);
        
        // Pick top 4 related (simple logic: existing array order is prioritized)
        // Ideally we could manually map "best matches", but cluster neighbors are a good start.
        $related = array_slice($candidates, 0, 4);

        // Populate related data (we only store basic info to keep JSON light, or just slugs?)
        // Let's store full objects for easy Twig rendering, or just slug/title/salary/image.
        // To be safe and consistent with current Twig usage, we likely need objects. 
        // But storing slug is cleaner. The template can lookup? 
        // No, current architecture doesn't seem to have a global lookup in Twig easily without passing the whole list.
        // Let's store a simplified object: title, slug, avg_salary, banner_image.
        
        $relatedData = [];
        foreach ($related as $relSlug) {
            // Find the full profession data for this related slug
            foreach ($data as $p) {
                if ($p['slug'] === $relSlug) {
                    $relatedData[] = [
                        'title' => $p['title'],
                        'slug' => $p['slug'],
                        'avg_salary' => $p['avg_salary'],
                        'median_salary' => $p['median_salary'] ?? $p['avg_salary'], // Fallback
                        'banner_image' => $p['banner_image'] ?? '/img/professions/default-banner.png'
                    ];
                    break;
                }
            }
        }

        if (!empty($relatedData)) {
            $profession['related_professions'] = [
                'title' => 'Liknande yrken inom ' . $clusters[$clusterKey]['title'],
                'items' => $relatedData
            ];
            $updatedCount++;
        }
    }
}

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "✅ Updated $updatedCount professions with internal linking data.\n";
