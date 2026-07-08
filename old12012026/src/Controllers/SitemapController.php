<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\ProfessionService;

class SitemapController
{
    private $professionService;
    private $baseUrl;

    public function __construct(ProfessionService $professionService)
    {
        $this->professionService = $professionService;
        // In production, this should come from env or config
        $this->baseUrl = 'https://raknalon.se';
    }

    public function index(Request $request, Response $response)
    {
        $urls = [];

        // Static Pages
        $urls[] = ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'];
        $urls[] = ['loc' => '/yrken', 'priority' => '0.9', 'changefreq' => 'weekly'];
        $urls[] = ['loc' => '/brutto-netto', 'priority' => '0.8', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => '/jobbskatteavdrag', 'priority' => '0.8', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => '/statlig-skatt', 'priority' => '0.8', 'changefreq' => 'monthly'];

        // Legal & Information Pages (AdSense & GDPR)
        $urls[] = ['loc' => '/om-oss', 'priority' => '0.5', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => '/kontakt', 'priority' => '0.5', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => '/sa-raknar-vi', 'priority' => '0.6', 'changefreq' => 'monthly'];
        $urls[] = ['loc' => '/integritetspolicy', 'priority' => '0.3', 'changefreq' => 'yearly'];
        $urls[] = ['loc' => '/cookies', 'priority' => '0.3', 'changefreq' => 'yearly'];
        $urls[] = ['loc' => '/ansvarsfriskrivning', 'priority' => '0.3', 'changefreq' => 'yearly'];

        // Dynamic Profession Pages
        $professions = $this->professionService->getAll();
        foreach ($professions as $p) {
            $urls[] = [
                'loc' => '/lon/' . $p['slug'],
                'priority' => '0.9',
                'changefreq' => 'monthly'
            ];
        }

        // Generate XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . $this->baseUrl . $url['loc'] . '</loc>';
            $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $url['priority'] . '</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        $response->getBody()->write($xml);
        return $response->withHeader('Content-Type', 'application/xml');
    }
}
