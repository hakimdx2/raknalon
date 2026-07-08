<?php
/**
 * Apply remaining 5-star upgrades (Förskollärare, Ambulansförare)
 */

$jsonFile = __DIR__ . '/data/professions.json';
$data = json_decode(file_get_contents($jsonFile), true);

$upgrades = [
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
        'description' => 'Ambulanspersonal arbetar i team och ansvarar för prehospital akutsjukvård och säker transport av patienter. Sjuksköterskan har det medicinska ansvaret medan sjukvårdaren (tidigare kallad "ambulansförare") assisterar och kör fordonet.',
        'description_extended' => 'Ambulansyrket är ett av de mest krävande inom vården. Arbetet sker i skift dygnet runt med OB-tillägg för natt och helg. Ett ambulansteam består oftast av en ambulanssjuksköterska (med specialistutbildning) och en ambulanssjukvårdare. Sjuksköterskan har legitimation och får ge läkemedel samt utföra avancerade åtgärder. Arbetsplatser inkluderar landstingens ambulansorganisationer och privata vårdgivare som Falck, Samariten och Ambulanssjukvården. Det finns även specialiserade roller som helikoptersjuksköterska (Flight Nurse) med ännu högre lön. Arbetet innebär fysiska och psykiska påfrestningar men ger också stor tillfredsställelse.',
        'education' => 'Ambulanssjukvårdare: YH-utbildning eller påbyggnad efter undersköterska (ca 1-2 terminer). Ambulanssjuksköterska: Sjuksköterskeexamen (3 år) + specialistutbildning i prehospital sjukvård (1 år). Körkort B krävs, C/C1 är meriterande.',
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
}

file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "\n" . str_repeat("=", 50) . "\n";
echo "✅ Applied remaining 5-star upgrades: $updatedCount professions\n";
