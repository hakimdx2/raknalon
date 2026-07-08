<?php

namespace App\Services;

/**
 * Service pour gérer les widgets affiliés
 * Charge la configuration depuis data/widgets_config.json
 */
class WidgetService
{
    private $config;
    private $configPath;

    public function __construct()
    {
        $this->configPath = __DIR__ . '/../../data/widgets_config.json';
        $this->loadConfig();
    }

    /**
     * Charge la configuration des widgets depuis le fichier JSON
     */
    private function loadConfig()
    {
        if (file_exists($this->configPath)) {
            $json = file_get_contents($this->configPath);
            $this->config = json_decode($json, true);
        } else {
            // Configuration par défaut si fichier manquant
            $this->config = [
                'simulateur' => ['enabled' => false],
                'unionen' => ['enabled' => false],
                'compricer' => ['enabled' => false]
            ];
        }
    }

    /**
     * Retourne la configuration complète
     */
    public function getAll(): array
    {
        return $this->config;
    }

    /**
     * Vérifie si un widget spécifique est activé
     */
    public function isEnabled(string $widgetName): bool
    {
        return isset($this->config[$widgetName]['enabled']) 
            && $this->config[$widgetName]['enabled'] === true;
    }

    /**
     * Retourne la configuration d'un widget spécifique
     */
    public function getWidget(string $widgetName): ?array
    {
        return $this->config[$widgetName] ?? null;
    }

    /**
     * Retourne l'URL affiliée d'un widget
     */
    public function getAffiliateUrl(string $widgetName): ?string
    {
        return $this->config[$widgetName]['affiliate_url'] ?? null;
    }

    /**
     * Retourne l'exemple de crédit pour Compricer
     */
    public function getCreditExample(): ?array
    {
        return $this->config['compricer']['credit_example'] ?? null;
    }
}
