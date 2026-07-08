<?php

namespace App\Services;

class AdminToolbarService
{
    private string $iaToolPath;

    public function __construct() {
        // Path to the api_toolbar.php script
        $this->iaToolPath = realpath(__DIR__ . '/../../../../ia-tool/api_toolbar.php');
    }

    public function getAnalytics(string $url): array
    {
        if (!$this->iaToolPath || !file_exists($this->iaToolPath)) {
            return ['error' => 'IA-Tool script not found'];
        }

        // Escape shell argument for safety
        $safeUrl = escapeshellarg($url);
        
        // Construct command
        $command = "php \"{$this->iaToolPath}\" --url={$safeUrl}";
        
        // Execute
        $output = shell_exec($command);
        
        // Parse JSON
        $data = json_decode($output, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'error' => 'JSON Decode Error',
                'raw_output' => $output
            ];
        }

        return $data;
    }

    public function submitIndex(string $url): array
    {
        // Path to submit-indexing.php
        $scriptPath = realpath(__DIR__ . '/../../../../ia-tool/submit-indexing.php');
        
        if (!$scriptPath || !file_exists($scriptPath)) {
            return ['error' => 'Indexing script not found'];
        }

        // Arguments: --url="..." --yes (auto confirm)
        $safeUrl = escapeshellarg($url);
        $command = "php \"{$scriptPath}\" --url={$safeUrl} --yes";
        
        // Execute (might take a few seconds)
        // Capture both stdout and stderr
        $output = shell_exec($command . " 2>&1");
        
        // Simple success check logic based on script output
        // The script returns nice Markdown report, but we just want to know if it worked.
        // We look for "200" (HTTP success) or "Updating URL" success message.
        
        // Let's assume ANY output is better than nothing, but ideally we check for errors.
        if (strpos($output, 'Error') !== false || strpos($output, '❌') !== false) {
             return [
                'success' => false,
                'message' => 'Indexing failed',
                'raw_output' => $output
            ];
        }

        return [
            'success' => true,
            'message' => 'Submitted for indexing',
            'raw_output' => $output
        ];
    }

    public function analyzeWithAi(array $data): array
    {
        $scriptPath = realpath(__DIR__ . '/../../../../ia-tool/api_ai.php');
        if (!$scriptPath || !file_exists($scriptPath)) {
            return ['error' => 'AI script not found'];
        }

        // Use proper directory for temp file
        $iaToolDir = realpath(__DIR__ . '/../../../../ia-tool');
        $tempFile = $iaToolDir . '/temp_ai_payload_' . uniqid() . '.json';
        
        // Write payload
        $writeResult = file_put_contents($tempFile, json_encode($data));
        if ($writeResult === false) {
            return ['error' => 'Failed to write temp file'];
        }

        $command = "php \"{$scriptPath}\" --file=\"{$tempFile}\"";
        $output = shell_exec($command . " 2>&1");
        
        // Cleanup
        if (file_exists($tempFile)) unlink($tempFile);

        // Handle empty output
        if (empty($output)) {
            return ['error' => 'Empty response from AI script'];
        }

        // Try parsing
        $json = json_decode(trim($output), true);
        
        // If parsing fails, return raw output for debugging
        if ($json === null) {
            return ['error' => 'JSON parse failed', 'raw' => substr($output, 0, 500)];
        }

        // Pass through whatever the script returned (including errors)
        return $json;
    }
}
