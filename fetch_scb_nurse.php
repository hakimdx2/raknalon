<?php
// Fetch SCB Data for Sjuksköterska (SSYK 2221)
// Source: Strukturolönestatistik (AM0110)

$baseUrl = "https://api.scb.se/OV0104/v1/doris/sv/ssd";

function scbRequest($endpoint, $postData = null) {
    global $baseUrl;
    $url = $baseUrl . $endpoint;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    if ($postData) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    }
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }
    
    curl_close($ch);
    
    return json_decode($response, true);
}

echo "Fetching Data for SSYK 2221 (Sjuksköterskor)...\n";

// Endpoint: AM0110A (Strukturolönestatistik totalt)
// Table: LonSSYK2012
$endpoint = "/AM/AM0110/AM0110A/LonSSYK2012";

// Debug: Fetch metadata
$data = scbRequest($endpoint); // GET request without postData

if (!$data) {
    echo "Request failed. Check URL.\n";
} else {
    // Filter to show just the variables to keep it short
    $summary = [];
    foreach ($data['variables'] as $var) {
        $summary[$var['code']] = [
            'text' => $var['text'],
            'values_count' => count($var['values']),
            'values_sample' => array_slice($var['values'], 0, 5),
            'valueTexts_sample' => array_slice($var['valueTexts'], 0, 5)
        ];
    }
    echo json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
exit;

/*
$query = [
    "query" => [
        ["code" => "Ssyk2012", "selection" => ["filter" => "item", "values" => ["2221"]]],
        ["code" => "Kon", "selection" => ["filter" => "item", "values" => ["1", "2", "1+2"]]], // 1=Men, 2=Women, 1+2=Total
        ["code" => "ContentsCode", "selection" => ["filter" => "item", "values" => ["000000N2"]]], // 000000N2 = Genomsnittlig månadslön
        ["code" => "Tid", "selection" => ["filter" => "item", "values" => ["2014","2015","2016","2017","2018","2019","2020","2021","2022","2023"]]]
    ],
    "response" => ["format" => "json"]
];

$data = scbRequest($endpoint, $query);
*/

if ($data && isset($data['data'])) {
    $history = [];
    $history_men = [];
    $history_women = [];
    
    foreach ($data['data'] as $row) {
        $ssyk = $row['key'][0];
        $gender = $row['key'][1]; 
        $year = $row['key'][2]; 
        
        $salary = (int)$row['values'][0];
        
        if ($gender === '1+2') {
            $history[$year] = $salary;
        } elseif ($gender === '1') {
            $history_men[$year] = $salary;
        } elseif ($gender === '2') {
            $history_women[$year] = $salary;
        }
    }
    
    // Sort keys just in case
    ksort($history);
    ksort($history_men);
    ksort($history_women);

    $latestYear = end(array_keys($history));
    $salaryTotal = $history[$latestYear];
    $salaryMen = $history_men[$latestYear];
    $salaryWomen = $history_women[$latestYear];
    $genderGap = ($salaryWomen / $salaryMen) * 100;
    
    $scbObject = [
        "year" => (int)$latestYear,
        "salary_total" => $salaryTotal,
        "salary_men" => $salaryMen,
        "salary_women" => $salaryWomen,
        "gender_gap_percent" => round($genderGap, 1),
        "history" => $history,
        "history_men" => $history_men,
        "history_women" => $history_women,
        // Calculate 10 year evolution if possible
        "evolution_10y_percent" => isset($history['2014']) ? round(($salaryTotal - $history['2014']) / $history['2014'] * 100, 1) : null
    ];
    
    echo "\n=== JSON DATA ===\n";
    echo json_encode($scbObject, JSON_PRETTY_PRINT);
    
} else {
    echo "Error or No Data Found.\n";
    print_r($data);
}
