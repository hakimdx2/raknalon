<?php

$json = file_get_contents(__DIR__ . '/../data/professions.json');
$data = json_decode($json, true);

foreach ($data as $p) {
    if ($p['slug'] === 'elektriker') {
        file_put_contents('elektriker_dump.txt', print_r($p, true));
        break;
    }
}
