<?php

namespace App\Services;

class SalaryCalculator
{
    // Constants for 2026 (Estimations based on 2025 trends for MVP)
    const PRICE_BASE_AMOUNT = 57300; // Prisbasbelopp (approx)
    const STATE_TAX_THRESHOLD = 615300; // Skiktgräns for state tax (~51,275/mo)
    
    /**
     * Calculate Net Salary from Gross Salary
     * 
     * @param float $grossSalary Monthly gross salary
     * @param float $municipalTaxRate Municipal tax rate (e.g., 32.00 for 32%)
     * @param int $age Age of the person
     * @return array
     */
    public function calculate(float $grossSalary, float $municipalTaxRate = 32.00, int $age = 30): array
    {
        $yearlyGross = $grossSalary * 12;
        
        // 1. Municipal Tax (Kommunalskatt)
        $municipalTax = $grossSalary * ($municipalTaxRate / 100);

        // 2. Job Tax Deduction (Jobbskatteavdrag) - Simplified for MVP
        // Real formula is complex, using an approximation for now
        $jobTaxDeduction = $this->calculateJobTaxDeduction($grossSalary, $age);

        // 3. State Tax (Statlig skatt)
        $stateTax = 0;
        if ($yearlyGross > self::STATE_TAX_THRESHOLD) {
            $taxableAbove = $yearlyGross - self::STATE_TAX_THRESHOLD;
            $stateTaxYearly = $taxableAbove * 0.20;
            $stateTax = $stateTaxYearly / 12;
        }

        // 4. Total Tax
        $totalTax = ($municipalTax + $stateTax) - $jobTaxDeduction;
        if ($totalTax < 0) $totalTax = 0;

        // 5. Net Salary
        $netSalary = $grossSalary - $totalTax;

        // 6. Employer Costs (Arbetsgivaravgift) - 31.42% standard
        $employerCost = $grossSalary * 0.3142;

        return [
            'gross_salary' => round($grossSalary),
            'net_salary' => round($netSalary),
            'total_tax' => round($totalTax),
            'employer_cost' => round($employerCost),
            'details' => [
                'municipal_tax' => round($municipalTax),
                'state_tax' => round($stateTax),
                'job_deduction' => round($jobTaxDeduction)
            ]
        ];
    }

    private function calculateJobTaxDeduction(float $salary, int $age): float
    {
        // Very simplified approximation for standard earners
        // Real algo requires Price Base Amounts logic
        if ($salary < 10000) return 0;
        return min(3500, $salary * 0.08 + 1500); 
    }
}
