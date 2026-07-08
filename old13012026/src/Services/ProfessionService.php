<?php

namespace App\Services;

class ProfessionService
{
    private array $professions;

    public function __construct()
    {
        $dataFile = __DIR__ . '/../../data/professions.json';
        if (file_exists($dataFile)) {
            $json = file_get_contents($dataFile);
            $this->professions = json_decode($json, true) ?? [];
        } else {
            $this->professions = [];
        }
    }

    public function getAll(): array
    {
        return $this->professions;
    }

    public function getBySlug(string $slug): ?array
    {
        foreach ($this->professions as $p) {
            if ($p['slug'] === $slug) {
                return $p;
            }
        }
        return null; // Not found
    }
}
