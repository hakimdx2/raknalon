<?php

namespace App\Services;

/**
 * KommunalService - Service pour les données du secteur kommunal
 * 
 * Gère:
 * - Données SCB kommunal par profession (136 professions)
 * - Données par Län (21 régions)
 * - Comparaisons kommunal vs privat
 */
class KommunalService
{
    private $kommunalData = [];
    private $lanData = [];
    private $privatData = [];
    private $skattesatser = [];
    
    public function __construct()
    {
        $this->loadData();
    }
    
    private function loadData()
    {
        $dataDir = __DIR__ . '/../../data/scb/';
        
        // Charger données kommunal
        $kommunalFile = $dataDir . '03_kommunal_sektor_2024.json';
        if (file_exists($kommunalFile)) {
            $data = json_decode(file_get_contents($kommunalFile), true);
            foreach ($data as $item) {
                $this->kommunalData[$item['ssyk_code']] = $item;
            }
        }
        
        // Charger données privat pour comparaison
        $privatFile = $dataDir . '01_privat_tjansteman_2024.json';
        if (file_exists($privatFile)) {
            $data = json_decode(file_get_contents($privatFile), true);
            foreach ($data as $item) {
                $this->privatData[$item['ssyk_code']] = $item;
            }
        }
        
        // Charger données Län
        $lanFile = $dataDir . '06_lan_complete_2024.json';
        if (file_exists($lanFile)) {
            $this->lanData = json_decode(file_get_contents($lanFile), true);
        }
        
        // Charger skattesatser
        $skattFile = $dataDir . '05_skattesatser_lan_2024.json';
        if (file_exists($skattFile)) {
            $this->skattesatser = json_decode(file_get_contents($skattFile), true);
        }
    }
    
    /**
     * Obtenir toutes les professions kommunal
     */
    public function getAllKommunal(): array
    {
        return array_values($this->kommunalData);
    }
    
    /**
     * Obtenir une profession kommunal par code SSYK
     */
    public function getKommunalBySsyk(string $ssykCode): ?array
    {
        return $this->kommunalData[$ssykCode] ?? null;
    }
    
    /**
     * Obtenir les top N professions par salaire
     */
    public function getTopSalaries(int $limit = 10): array
    {
        $data = $this->getAllKommunal();
        usort($data, fn($a, $b) => $b['salary_total'] <=> $a['salary_total']);
        return array_slice($data, 0, $limit);
    }
    
    /**
     * Obtenir les statistiques globales
     */
    public function getStats(): array
    {
        $data = $this->getAllKommunal();
        $salaries = array_filter(array_column($data, 'salary_total'), fn($s) => $s > 0);
        
        if (empty($salaries)) {
            return [
                'count' => 0,
                'average' => 0,
                'min' => 0,
                'max' => 0
            ];
        }
        
        return [
            'count' => count($salaries),
            'average' => (int) round(array_sum($salaries) / count($salaries)),
            'min' => min($salaries),
            'max' => max($salaries)
        ];
    }
    
    /**
     * Obtenir tous les Län
     */
    public function getAllLan(): array
    {
        return $this->lanData;
    }
    
    /**
     * Obtenir un Län par slug
     */
    public function getLanBySlug(string $slug): ?array
    {
        foreach ($this->lanData as $lan) {
            if ($lan['slug'] === $slug) {
                return $lan;
            }
        }
        return null;
    }
    
    /**
     * Obtenir les Län triés par tier et salaire
     */
    public function getLanSorted(): array
    {
        $data = $this->lanData;
        usort($data, function($a, $b) {
            if ($a['tier'] !== $b['tier']) {
                return $a['tier'] <=> $b['tier'];
            }
            return $b['salary_estimate'] <=> $a['salary_estimate'];
        });
        return $data;
    }
    
    /**
     * Comparer kommunal vs privat pour un code SSYK
     */
    public function compareKommunalPrivat(string $ssykCode): array
    {
        $kommunal = $this->kommunalData[$ssykCode] ?? null;
        $privat = $this->privatData[$ssykCode] ?? null;
        
        $diff = 0;
        if ($kommunal && $privat && $privat['salary_total'] > 0) {
            $diff = round((($kommunal['salary_total'] - $privat['salary_total']) / $privat['salary_total']) * 100, 1);
        }
        
        return [
            'kommunal' => $kommunal,
            'privat' => $privat,
            'diff_percent' => $diff
        ];
    }
    
    /**
     * Calculer le salaire net pour un brut donné et un Län
     */
    public function calculateNetSalary(int $brutto, string $lanName): array
    {
        $skatt = $this->skattesatser[$lanName] ?? 32.0;
        $netto = (int) round($brutto * (1 - $skatt / 100));
        
        return [
            'brutto' => $brutto,
            'skatt_percent' => $skatt,
            'skatt_amount' => $brutto - $netto,
            'netto' => $netto
        ];
    }
    
    /**
     * Obtenir le salaire moyen national kommunal
     */
    public function getNationalAverage(): int
    {
        // Code 0000 = Samtliga yrken
        $samtliga = $this->kommunalData['0000'] ?? null;
        return $samtliga ? $samtliga['salary_total'] : 36100;
    }
}
