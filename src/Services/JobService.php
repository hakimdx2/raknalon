<?php

namespace App\Services;

class JobService
{
    private $authKey = 'YOUR_API_KEY_HERE'; // Opional for public access
    private $cacheDir;
    private $apiUrl = 'https://jobsearch.api.jobtechdev.se/search';

    public function __construct()
    {
        // Define cache directory in project root
        $this->cacheDir = __DIR__ . '/../../cache/jobs/';
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    public function getJobs(string $keyword, ?string $municipality = null, int $limit = 6): array
    {
        // 1. Try Local Search first (Keyword + Municipality)
        if ($municipality) {
            $jobs = $this->fetchFromApi($keyword, $municipality, $limit);
            if (!empty($jobs)) {
                return $jobs;
            }
        }

        // 2. Fallback: National Search (Keyword only) if no local jobs found
        return $this->fetchFromApi($keyword, null, $limit);
    }

    private function fetchFromApi(string $keyword, ?string $municipality, int $limit): array
    {
        $cacheKey = md5($keyword . '_' . ($municipality ?? 'national') . '_' . $limit);
        $cacheFile = $this->cacheDir . $cacheKey . '.json';

        // Check Cache (1 hour)
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < 3600)) {
            return json_decode(file_get_contents($cacheFile), true);
        }

        // Build Query
        $params = [
            'q' => $keyword . ($municipality ? ' ' . $municipality : ''),
            'limit' => $limit,
            'offset' => 0,
            'sort' => 'pubdate-desc'
        ];

        $url = $this->apiUrl . '?' . http_build_query($params);

        // Fetch API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2); // Fast timeout
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $jobs = [];

        if ($httpCode === 200) {
            $data = json_decode($response, true);

            if (isset($data['hits'])) {
                foreach ($data['hits'] as $hit) {
                    $jobs[] = [
                        'id' => $hit['id'],
                        'title' => $hit['headline'],
                        'employer' => $hit['employer']['name'] ?? 'Okänd arbetsgivare',
                        'logo_url' => $hit['logo_url'] ?? null,
                        'location' => $hit['workplace_address']['municipality'] ?? 'Sverige',
                        'url' => $hit['webpage_url'],
                        'published' => $this->timeElapsed($hit['publication_date']),
                        'description' => mb_strimwidth($hit['description']['text'] ?? '', 0, 100, '...')
                    ];
                }
            }

            // Save to Cache
            file_put_contents($cacheFile, json_encode($jobs));
        }

        return $jobs;
    }

    private function timeElapsed($datetime, $full = false)
    {
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $weeks = floor($diff->days / 7);
        $days = $diff->d - ($weeks * 7);

        $string = array(
            'y' => 'år',
            'm' => 'mån',
            'w' => 'veckor',
            'd' => 'dagar',
            'h' => 'tim',
            'i' => 'min',
            's' => 'sek',
        );
        foreach ($string as $k => &$v) {
            if ($k == 'w') {
                if ($weeks) {
                    $v = $weeks . ' ' . $v;
                } else {
                    unset($string[$k]);
                }
            } elseif ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full)
            $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' sedan' : 'just nu';
    }
}
