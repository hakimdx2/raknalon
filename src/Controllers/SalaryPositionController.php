<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\SalaryPositionService;

class SalaryPositionController
{
    private SalaryPositionService $salaryPositionService;

    public function __construct(SalaryPositionService $salaryPositionService)
    {
        $this->salaryPositionService = $salaryPositionService;
    }

    /**
     * Calculate user's salary position
     * POST /api/salary-position
     */
    public function calculate(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        // Validate required fields
        $errors = [];
        if (empty($data['profession_slug'])) {
            $errors[] = 'profession_slug is required';
        }
        if (!isset($data['experience_years']) || !is_numeric($data['experience_years'])) {
            $errors[] = 'experience_years must be a number';
        }
        if (empty($data['municipality'])) {
            $errors[] = 'municipality is required';
        }
        if (!isset($data['current_salary']) || !is_numeric($data['current_salary'])) {
            $errors[] = 'current_salary must be a number';
        }

        if (!empty($errors)) {
            $response->getBody()->write(json_encode([
                'success' => false,
                'errors' => $errors
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }

        // Validate ranges
        $experienceYears = max(0, min(50, (int) $data['experience_years']));
        $currentSalary = max(15000, min(500000, (int) $data['current_salary']));

        // Calculate position
        $result = $this->salaryPositionService->calculatePosition(
            $data['profession_slug'],
            $experienceYears,
            $data['municipality'],
            $currentSalary
        );

        $response->getBody()->write(json_encode($result));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($result['success'] ? 200 : 400);
    }
}
