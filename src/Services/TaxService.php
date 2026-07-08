<?php

namespace App\Services;

class TaxService
{
    private array $municipalities;

    public function __construct()
    {
        // Load data from JSON
        $dataFile = __DIR__ . '/../../data/kommuner.json';
        if (file_exists($dataFile)) {
            $json = file_get_contents($dataFile);
            $this->municipalities = json_decode($json, true) ?? [];
            
            // Sort by name
            usort($this->municipalities, function($a, $b) {
                return strcmp($a['name'], $b['name']);
            });
        } else {
            $this->municipalities = [];
        }
    }

    public function getAllMunicipalities(): array
    {
        return $this->municipalities;
    }

    public function getTaxRateForMunicipality(string $name): float
    {
        foreach ($this->municipalities as $m) {
            if (strcasecmp($m['name'], $name) === 0) {
                return (float)$m['tax_rate'];
            }
        }
        return 32.37; // Swedish average fallback
    }
}
