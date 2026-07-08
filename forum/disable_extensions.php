<?php

$config = include 'config.php';

if (!is_array($config)) {
    die("Error: Could not load config.php\n");
}

$dbConf = $config['database'];

try {
    $dsn = "mysql:host={$dbConf['host']};port={$dbConf['port']};dbname={$dbConf['database']};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbConf['username'], $dbConf['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database.\n";

    // Disable problematic extensions
    $stmt = $pdo->prepare("SELECT value FROM settings WHERE `key` = 'extensions_enabled'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $extensions = [];
    if ($row && $row['value']) {
        $extensions = json_decode($row['value'], true);
    }

    $toDisable = ['fof-best-answer', 'v17development-flarum-seo'];
    $newExtensions = array_values(array_diff($extensions, $toDisable));

    $newValue = json_encode($newExtensions);

    if ($row) {
        $update = $pdo->prepare("UPDATE settings SET value = :value WHERE `key` = 'extensions_enabled'");
        $update->execute([':value' => $newValue]);
    }

    echo "Disabled fof-best-answer and v17development-flarum-seo.\n";

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage() . "\n");
}
