<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\SalaryCalculator;

class CalculatorController
{
    private $calculator;

    public function __construct(SalaryCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function calculate(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();
        $salary = (float)($data['salary'] ?? 0);
        $taxRate = (float)($data['tax_rate'] ?? 32.00);
        $age = (int)($data['age'] ?? 30);

        $result = $this->calculator->calculate($salary, $taxRate, $age);

        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
