<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\ProfessionService;

class SitemapController
{
    private $professionService;
    private $blogService;
    private $baseUrl;

    public function __construct(ProfessionService $professionService, \App\Services\BlogService $blogService)
    {
        $this->professionService = $professionService;
        $this->blogService = $blogService;
        // In production, this should come from env or config
        $this->baseUrl = 'https://raknalon.se';
    }

    public function index(Request $request, Response $response)
    {
        $urls = [];

        // Static Pages
        $urls[] = ['loc' => '/', 'priority' => '1.0', 'changefreq' => 'weekly'];
        $urls[] = ['loc' => '/yrken', 'priority' => '0.9', 'changefreq' => 'weekly'];
        $urls[] = ['loc' => '/blogg', 'priority' => '0.8', 'changefreq' => 'weekly'];
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

        // Blog Posts
        $posts = $this->blogService->getAllPosts();
        foreach ($posts as $post) {
            $urls[] = [
                'loc' => '/blogg/' . $post['slug'],
                'priority' => '0.8',
                'changefreq' => 'monthly'
            ];
        }

        // Kommunal Sector Pages
        $urls[] = ['loc' => '/kommunal-lon', 'priority' => '0.8', 'changefreq' => 'monthly'];
        
        // Län Pages (21)
        $kommunalService = new \App\Services\KommunalService();
        $lanData = $kommunalService->getAllLan();
        foreach ($lanData as $lan) {
            $urls[] = [
                'loc' => '/lon/region/' . $lan['slug'],
                'priority' => '0.7',
                'changefreq' => 'monthly'
            ];
        }
        
        // Profession×Kommunal Pages (only include if data actually exists)
        $allKommunal = $kommunalService->getAllKommunal();
        $kommunalProfessionNames = array_map(function($k) {
            return mb_strtolower($k['profession']);
        }, $allKommunal);
        
        // Index kommunal data by SSYK code for fast lookup
        $kommunalBySSYK = [];
        foreach ($allKommunal as $k) {
            $kommunalBySSYK[$k['ssyk_code']] = true;
        }
        
        foreach ($professions as $p) {
            $hasKommunalData = false;
            
            // Check 1: SSYK code match
            if (isset($p['scb']['ssyk_code']) && isset($kommunalBySSYK[$p['scb']['ssyk_code']])) {
                $hasKommunalData = true;
            }
            
            // Check 2: Name match (if no SSYK match)
            if (!$hasKommunalData) {
                $professionLower = mb_strtolower($p['title']);
                foreach ($kommunalProfessionNames as $kommunalName) {
                    if (stripos($kommunalName, $professionLower) !== false) {
                        $hasKommunalData = true;
                        break;
                    }
                }
            }
            
            // Check 3: Fallback salary_by_sector.kommunal
            if (!$hasKommunalData && isset($p['salary_by_sector']['kommunal'])) {
                $hasKommunalData = true;
            }
            
            if ($hasKommunalData) {
                $urls[] = [
                    'loc' => '/lon/' . $p['slug'] . '/kommunal',
                    'priority' => '0.7',
                    'changefreq' => 'monthly'
                ];
            }
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
