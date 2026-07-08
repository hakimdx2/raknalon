<?php
$data = json_decode(file_get_contents('data/professions.json'), true);
foreach($data as $p) {
    $slug = $p['slug'] ?? '';
    if($slug == 'sjukskoterska') {
        echo "Found: " . $p['title'] . "\n";
        if(isset($p['scb']['percentiles'])) {
            echo "Percentiles:\n";
            print_r($p['scb']['percentiles']);
        } else {
            echo "NO percentiles key\n";
        }
        break;
    }
}
