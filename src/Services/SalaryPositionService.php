<?php

namespace App\Services;

class SalaryPositionService
{
    private ProfessionService $professionService;
    private TaxService $taxService;

    // Regional salary coefficients (Stockholm = baseline 1.0)
    private array $regionCoefficients = [
        'Stockholm' => 1.08,
        'Göteborg' => 1.05,
        'Malmö' => 1.03,
        'Uppsala' => 1.04,
        'Linköping' => 1.02,
        'Örebro' => 1.00,
        'Västerås' => 1.01,
        'Helsingborg' => 1.02,
        'Jönköping' => 1.00,
        'Norrköping' => 0.99,
        'Lund' => 1.03,
        'Umeå' => 1.02,
        'Gävle' => 0.99,
        'Borås' => 0.99,
        'Södertälje' => 1.05,
        'Eskilstuna' => 0.98,
        'Halmstad' => 0.99,
        'Växjö' => 0.98,
        'Karlstad' => 0.99,
        'Sundsvall' => 1.00,
        'Luleå' => 1.03,
        'Kiruna' => 1.06,
        // Default for unlisted
        'default' => 1.00
    ];

    // Experience multipliers (years => cumulative multiplier)
    private function getExperienceMultiplier(int $years): float
    {
        // First 10 years: +3% per year, then +1% per year (diminishing returns)
        if ($years <= 0)
            return 1.0;
        if ($years <= 10) {
            return 1.0 + ($years * 0.03);
        }
        // 10 years = 1.30, then +1% per additional year
        return 1.30 + (($years - 10) * 0.01);
    }

    public function __construct(ProfessionService $professionService, TaxService $taxService)
    {
        $this->professionService = $professionService;
        $this->taxService = $taxService;
    }

    /**
     * Calculate user's position in the salary distribution
     */
    public function calculatePosition(string $professionSlug, int $experienceYears, string $municipality, int $currentSalary): array
    {
        // 1. Get profession data
        $profession = $this->professionService->getBySlug($professionSlug);
        if (!$profession) {
            return ['success' => false, 'error' => 'Profession not found'];
        }

        // 2. Get base percentiles from SCB data
        $percentiles = $this->getPercentiles($profession);
        if (!$percentiles) {
            return ['success' => false, 'error' => 'No salary data available'];
        }

        // 3. Adjust percentiles for experience and region
        $regionCoef = $this->regionCoefficients[$municipality] ?? $this->regionCoefficients['default'];
        $expMultiplier = $this->getExperienceMultiplier($experienceYears);

        $adjustedPercentiles = [];
        foreach ($percentiles as $key => $value) {
            // Apply experience (based on median as baseline, scaled)
            // Juniors earn closer to p25, seniors push toward p75+
            $baseAdjustment = $value * $expMultiplier;
            // Apply region
            $adjustedPercentiles[$key] = round($baseAdjustment * $regionCoef);
        }

        // 4. Calculate user's percentile position
        $userPercentile = $this->interpolatePercentile($currentSalary, $adjustedPercentiles);

        // 5. Determine market salary (adjusted median for this profile)
        $marketSalary = $adjustedPercentiles['p50'];

        // 6. Calculate potential gain
        $potentialGain = max(0, $marketSalary - $currentSalary);

        // 7. Determine status
        if ($userPercentile < 30) {
            $status = 'underpaid';
            $statusText = 'Underbetald';
            $statusColor = 'red';
        } elseif ($userPercentile < 70) {
            $status = 'fair';
            $statusText = 'Marknadsmässig';
            $statusColor = 'yellow';
        } else {
            $status = 'overpaid';
            $statusText = 'Över snittet';
            $statusColor = 'green';
            $potentialGain = 0; // No negotiation needed
        }

        // 8. Generate comparison text
        $comparisonText = $this->generateComparisonText($profession['title'], $userPercentile, $currentSalary, $marketSalary, $experienceYears);

        // 9. Get negotiation advice
        $advice = $this->getNegotiationAdvice($status, $experienceYears, $potentialGain);

        return [
            'success' => true,
            'data' => [
                'percentile' => round($userPercentile),
                'market_salary' => $marketSalary,
                'current_salary' => $currentSalary,
                'potential_gain' => $potentialGain,
                'potential_gain_yearly' => $potentialGain * 12,
                'status' => $status,
                'status_text' => $statusText,
                'status_color' => $statusColor,
                'comparison_text' => $comparisonText,
                'advice' => $advice,
                'percentiles' => $adjustedPercentiles,
                'profession_title' => $profession['title'],
                'experience_years' => $experienceYears,
                'municipality' => $municipality
            ]
        ];
    }

    /**
     * Extract percentiles from profession data
     */
    private function getPercentiles(array $profession): ?array
    {
        // Try SCB percentiles first
        if (isset($profession['scb']['percentiles'])) {
            $p = $profession['scb']['percentiles'];
            if (isset($p['p10']) && $p['p10'] > 0) {
                return $p;
            }
        }

        // Fallback: estimate from median/avg salary
        $median = $profession['median_salary'] ?? $profession['avg_salary'] ?? 0;
        if ($median <= 0)
            return null;

        return [
            'p10' => round($median * 0.70),
            'p25' => round($median * 0.85),
            'p50' => round($median),
            'p75' => round($median * 1.15),
            'p90' => round($median * 1.35)
        ];
    }

    /**
     * Interpolate user's percentile based on their salary
     */
    private function interpolatePercentile(int $salary, array $percentiles): float
    {
        $points = [
            0 => 0,
            $percentiles['p10'] => 10,
            $percentiles['p25'] => 25,
            $percentiles['p50'] => 50,
            $percentiles['p75'] => 75,
            $percentiles['p90'] => 90,
            $percentiles['p90'] * 1.5 => 100 // Extrapolate for very high salaries
        ];

        // Sort by salary
        ksort($points);

        // Find the two points to interpolate between
        $prevSalary = 0;
        $prevPercentile = 0;

        foreach ($points as $pointSalary => $pointPercentile) {
            if ($salary <= $pointSalary) {
                // Linear interpolation
                if ($pointSalary == $prevSalary)
                    return $pointPercentile;
                $fraction = ($salary - $prevSalary) / ($pointSalary - $prevSalary);
                return $prevPercentile + ($fraction * ($pointPercentile - $prevPercentile));
            }
            $prevSalary = $pointSalary;
            $prevPercentile = $pointPercentile;
        }

        // If salary is above all points
        return 100;
    }

    /**
     * Generate human-readable comparison text
     */
    private function generateComparisonText(string $professionTitle, float $percentile, int $currentSalary, int $marketSalary, int $years): string
    {
        $diff = $currentSalary - $marketSalary;
        $diffFormatted = number_format(abs($diff), 0, ',', ' ');

        if ($percentile < 30) {
            return "Din lön på " . number_format($currentSalary, 0, ',', ' ') . " kr ligger under marknadssnittet för en {$professionTitle} med {$years} års erfarenhet. Du har potential att öka din lön med {$diffFormatted} kr/månad.";
        } elseif ($percentile < 70) {
            return "Din lön på " . number_format($currentSalary, 0, ',', ' ') . " kr är marknadsmässig för en {$professionTitle} med {$years} års erfarenhet. Du ligger nära genomsnittet.";
        } else {
            return "Din lön på " . number_format($currentSalary, 0, ',', ' ') . " kr ligger över marknadssnittet för en {$professionTitle}. Du tillhör de {$percentile}% bäst betalda.";
        }
    }

    /**
     * Get negotiation advice based on status
     */
    private function getNegotiationAdvice(string $status, int $years, int $potentialGain): array
    {
        $advice = [];

        if ($status === 'underpaid') {
            $advice[] = [
                'title' => 'Förbered marknadsdata',
                'text' => 'Samla statistik från SCB och fackförbund som visar vad marknaden betalar.',
                'script' => 'Jag har undersökt marknaden och ser att medianlönen för min roll är X kr. Jag undrar hur vi kan arbeta mot den nivån.'
            ];
            $advice[] = [
                'title' => 'Dokumentera dina prestationer',
                'text' => 'Lista konkreta resultat, projekt och värde du tillfört under året.',
                'script' => 'Under det senaste året har jag [specifik prestation] vilket bidragit till [mätbart resultat].'
            ];
            $advice[] = [
                'title' => 'Välj rätt tidpunkt',
                'text' => 'Boka möte efter en lyckad leverans eller inför budgetperioden.',
                'script' => null
            ];
            if ($potentialGain > 3000) {
                $advice[] = [
                    'title' => 'Överväg externa alternativ',
                    'text' => 'Med ett lönegap på ' . number_format($potentialGain, 0, ',', ' ') . ' kr/mån kan det vara värt att undersöka andra arbetsgivare.',
                    'script' => null
                ];
            }
        } elseif ($status === 'fair') {
            $advice[] = [
                'title' => 'Fokusera på utveckling',
                'text' => 'Din lön är marknadsmässig. För att höja den, fokusera på nya ansvarsområden eller certifieringar.',
                'script' => 'Jag är intresserad av att ta mer ansvar inom [område]. Hur ser du på att koppla det till min löneutveckling?'
            ];
            $advice[] = [
                'title' => 'Förhandla vid rätt tillfälle',
                'text' => 'Vänta på årlig lönerevision eller efter en befordran/omorganisation.',
                'script' => null
            ];
        } else { // overpaid
            $advice[] = [
                'title' => 'Behåll din position',
                'text' => 'Du har en stark lön! Fokusera på att leverera värde och behålla ditt rykte.',
                'script' => null
            ];
            $advice[] = [
                'title' => 'Diversifiera din kompetens',
                'text' => 'Med en hög lön följer höga förväntningar. Investera i kontinuerlig utveckling.',
                'script' => null
            ];
        }

        return $advice;
    }
}
