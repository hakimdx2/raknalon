<?php

$config = include 'config.php';
$dbConf = $config['database'];

try {
    $dsn = "mysql:host={$dbConf['host']};port={$dbConf['port']};dbname={$dbConf['database']};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbConf['username'], $dbConf['password']);

    echo "--- DISCUSSIONS Table ---\n";
    $stmt = $pdo->query("DESCRIBE discussions");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        echo "{$row['Field']} ({$row['Type']}) - Null: {$row['Null']} - Default: {$row['Default']}\n";
    }

    echo "\n--- POSTS Table ---\n";
    $stmt = $pdo->query("DESCRIBE posts");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {
        echo "{$row['Field']} ({$row['Type']}) - Null: {$row['Null']} - Default: {$row['Default']}\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
