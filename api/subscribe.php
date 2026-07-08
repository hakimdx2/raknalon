<?php
/**
 * Backend simple pour la Newsletter Raknalon
 * Version corrigée : Output Buffering pour éviter les bugs JSON.
 */

// 1. Démarrer le buffering (Capture tout ce qui traîne)
ob_start();

// Configuration
$dataFile = __DIR__ . '/../protected/subscribers.json';
$logFile = __DIR__ . '/../protected/debug_log.txt';
$allowedOrigin = 'https://raknalon.se';

// 2. Désactiver l'affichage des erreurs HTML (C'est ce qui casse votre JSON)
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// 3. Logguer dans un fichier à la place
function logDebug($msg, $file)
{
    // Si le dossier n'est pas accessible, on ne fait rien pour ne pas crash
    if (is_writable(dirname($file))) {
        file_put_contents($file, date('[Y-m-d H:i:s] ') . $msg . "\n", FILE_APPEND);
    }
}

logDebug("Script started. Method: " . $_SERVER['REQUEST_METHOD'], $logFile);

// Headers CORS
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Pre-flight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    ob_end_clean(); // On nettoie avant de répondre
    http_response_code(200);
    exit();
}

// Vérifier Method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit();
}

// Lire l'input
$input = file_get_contents('php://input');
logDebug("Input: " . $input, $logFile);
$data = json_decode($input, true);

// Validation
if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    logDebug("Invalid email", $logFile);
    ob_end_clean();
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email address']);
    exit();
}

// Créer l'entrée avec champs GDPR
$entry = [
    'id' => uniqid('sub_', true),
    'email' => htmlspecialchars($data['email']),
    'variant_id' => isset($data['variant_id']) ? htmlspecialchars($data['variant_id']) : null,
    'url' => isset($data['url']) ? htmlspecialchars($data['url']) : null,
    'source' => isset($data['source']) ? htmlspecialchars($data['source']) : 'unknown',
    'date' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'],
    // GDPR Compliance fields
    'marketing_consent' => isset($data['marketing_consent']) ? (bool) $data['marketing_consent'] : false,
    'consent_timestamp' => isset($data['consent_timestamp']) ? htmlspecialchars($data['consent_timestamp']) : date('c'),
    'consent_text' => isset($data['consent_text']) ? htmlspecialchars($data['consent_text']) : null
];

// Gestion du fichier JSON
$currentData = [];
if (file_exists($dataFile)) {
    $content = file_get_contents($dataFile);
    $currentData = json_decode($content, true);
    if (!is_array($currentData)) {
        $currentData = [];
    }
}
$currentData[] = $entry;

// Sauvegarde
if (file_put_contents($dataFile, json_encode($currentData, JSON_PRETTY_PRINT), LOCK_EX) === false) {
    logDebug("Write Warning: Failed to write to " . $dataFile, $logFile);
    ob_end_clean();
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save data']);
    exit();
}

// SUCCÈS
logDebug("Success!", $logFile);

// 4. Nettoyage FINAL et Crucial
// On efface tout warning <br/><b> qui aurait pu s'afficher
if (ob_get_length()) {
    ob_end_clean();
}

// On envoie la réponse propre
header('Content-Type: application/json');
http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Subscribed successfully']);
exit();
