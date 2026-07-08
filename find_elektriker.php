<?php
$data = json_decode(file_get_contents('data/professions.json'), true);
foreach ($data as $e) {
    if (isset($e['slug']) && (strpos($e['slug'], 'elektriker') !== false || strpos($e['slug'], 'industri') !== false)) {
        echo $e['slug'] . ' - ' . $e['title'] . PHP_EOL;
    }
}
