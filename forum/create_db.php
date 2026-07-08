<?php
$servername = "127.0.0.1";
$username = "root";
$password = ""; // Try empty first
$port = 3306;

try {
    $conn = new PDO("mysql:host=$servername;port=$port", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS raknalon_forum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $conn->exec($sql);
    echo "Database created successfully via empty password.\n";
} catch (PDOException $e) {
    // Try with 'root' password
    try {
        $password = "root";
        $conn = new PDO("mysql:host=$servername;port=$port", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS raknalon_forum CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        $conn->exec($sql);
        echo "Database created successfully via 'root' password.\n";
    } catch (PDOException $e2) {
        echo "Connection failed: " . $e->getMessage() . " | " . $e2->getMessage();
        exit(1);
    }
}
?>