<?php
/**
 * EXPLORATION SCB - TABLES KOMMUNAL
 * 
 * Script pour trouver la bonne table avec les données kommunal par SSYK
 */

$baseUrl = "https://api.scb.se/OV0104/v1/doris/sv/ssd";

function scbGet($endpoint) {
    global $baseUrl;
    $url = $baseUrl . $endpoint;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode !== 200) {
        return null;
    }
    
    return json_decode($response, true);
}

echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║  EXPLORATION SCB - TABLES KOMMUNAL                            ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n\n";

// Explorer AM (Arbetsmarknad) → AM01 (Löner och arbetskostnader)
echo "━━━ AM/AM01 - Löner och arbetskostnader ━━━\n\n";

// AM0103 - Privat sektor
// AM0104 - Statlig sektor  
// AM0105 - Landsting/Regioner
// AM0106 - Kommuner
// AM0107 - Lönestrukturstatistik

echo "📁 AM0106 - Kommuner:\n";
$am0106 = scbGet("/AM/AM0106");
if ($am0106) {
    foreach ($am0106 as $item) {
        if (is_array($item) && isset($item['id'])) {
            echo "  └─ {$item['id']}: {$item['text']}\n";
        }
    }
}

echo "\n📁 AM0106/AM0106A:\n";
$am0106a = scbGet("/AM/AM0106/AM0106A");
if ($am0106a) {
    foreach ($am0106a as $item) {
        if (is_array($item) && isset($item['id'])) {
            $hasSSYK = (stripos($item['id'], 'SSYK') !== false) ? " ⭐ SSYK!" : "";
            echo "  └─ {$item['id']}: " . substr($item['text'] ?? '', 0, 60) . "$hasSSYK\n";
        }
    }
}

// Explorer AM0107
echo "\n📁 AM0107 - Lönestrukturstatistik:\n";
$am0107 = scbGet("/AM/AM0107");
if ($am0107) {
    foreach ($am0107 as $item) {
        if (is_array($item) && isset($item['id'])) {
            echo "  └─ {$item['id']}: {$item['text']}\n";
        }
    }
}

echo "\n📁 AM0107/AM0107A:\n";
$am0107a = scbGet("/AM/AM0107/AM0107A");
if ($am0107a) {
    foreach ($am0107a as $item) {
        if (is_array($item) && isset($item['id'])) {
            $hasSSYK = (stripos($item['id'], 'SSYK') !== false) ? " ⭐ SSYK!" : "";
            echo "  └─ {$item['id']}: " . substr($item['text'] ?? '', 0, 60) . "$hasSSYK\n";
        }
    }
}

// Chercher une table avec SSYK dans AM0106A
echo "\n━━━ Recherche de tables SSYK dans AM0106A ━━━\n";
$tables = ['Kommun17g', 'Kommun17gSSYK4', 'Kommun4g12'];

foreach ($tables as $table) {
    echo "\n🔍 Test: AM0106A/$table\n";
    $meta = scbGet("/AM/AM0106/AM0106A/$table");
    
    if ($meta && isset($meta['variables'])) {
        echo "  ✓ Table accessible\n";
        foreach ($meta['variables'] as $var) {
            $count = count($var['values'] ?? []);
            $hasSSYK = (stripos($var['code'], 'SSYK') !== false || stripos($var['code'], 'Yrke') !== false) ? " ⭐" : "";
            echo "    [{$var['code']}] {$var['text']} ($count)$hasSSYK\n";
        }
    } else {
        echo "  ✗ Non accessible\n";
    }
}

// Vérifier si AM9999 (All sectors combined) existe
echo "\n━━━ Recherche dans AM9999 (tous secteurs) ━━━\n";
$am9999 = scbGet("/AM/AM9999");
if ($am9999) {
    foreach ($am9999 as $item) {
        if (is_array($item) && isset($item['id'])) {
            echo "  └─ {$item['id']}: " . ($item['text'] ?? '') . "\n";
        }
    }
} else {
    echo "  Pas de AM9999\n";
}

echo "\n━━━ FIN DE L'EXPLORATION ━━━\n";
