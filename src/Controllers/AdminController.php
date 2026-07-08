<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\AdminToolbarService;

class AdminController
{
    private AdminToolbarService $service;

    public function __construct(AdminToolbarService $service)
    {
        $this->service = $service;
    }

    public function getData(Request $request, Response $response, $args): Response
    {
        // Simple security check: specific cookie or local environment
        $cookies = $request->getCookieParams();
        $isAdmin = isset($cookies['admin_access']) || $_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1';

        if (!$isAdmin) {
            $payload = json_encode(['error' => 'Unauthorized']);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(403);
        }

        // Get URL from query params
        $params = $request->getQueryParams();
        $url = $params['url'] ?? '';

        if (empty($url)) {
            $payload = json_encode(['error' => 'Missing URL parameter']);
            $response->getBody()->write($payload);
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        // Fetch Data
        $data = $this->service->getAnalytics($url);

        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function submitIndexing(Request $request, Response $response, $args): Response
    {
         // Security check
        $cookies = $request->getCookieParams();
        $isAdmin = isset($cookies['admin_access']) || $_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1';

        if (!$isAdmin) {
             return $response->withStatus(403);
        }

        $params = (array)$request->getParsedBody();
        $url = $params['url'] ?? '';

        if (empty($url)) {
             $payload = json_encode(['error' => 'Missing URL']);
             $response->getBody()->write($payload);
             return $response->withStatus(400);
        }

        $result = $this->service->submitIndex($url);

        $payload = json_encode($result);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function submitAiAnalysis(Request $request, Response $response, $args): Response
    {
        $cookies = $request->getCookieParams();
        $isAdmin = isset($cookies['admin_access']) || $_SERVER['REMOTE_ADDR'] === '127.0.0.1' || $_SERVER['REMOTE_ADDR'] === '::1';
        if (!$isAdmin) return $response->withStatus(403);

        $params = (array)$request->getParsedBody();
        // Decode if it's JSON body not form data
        if (empty($params)) {
             $params = json_decode($request->getBody()->getContents(), true);
        }

        if (empty($params)) {
             return $response->withStatus(400);
        }

        $result = $this->service->analyzeWithAi($params);
        $payload = json_encode($result);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
}
