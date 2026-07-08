<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use DI\Container;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/vendor/autoload.php';

// Create Container
$container = new Container();
AppFactory::setContainer($container);

// Comment Service
$container->set(App\Services\CommentService::class, function ($c) {
    return new App\Services\CommentService();
});

// Job Service
$container->set(App\Services\JobService::class, function ($c) {
    return new App\Services\JobService();
});

// Salary Position Service
$container->set(App\Services\SalaryPositionService::class, function ($c) {
    return new App\Services\SalaryPositionService(
        $c->get(App\Services\ProfessionService::class),
        $c->get(App\Services\TaxService::class)
    );
});

// Salary Position Controller
$container->set(App\Controllers\SalaryPositionController::class, function ($c) {
    return new App\Controllers\SalaryPositionController(
        $c->get(App\Services\SalaryPositionService::class)
    );
});

// Comment Controller
$container->set(App\Controllers\CommentController::class, function ($c) {
    return new App\Controllers\CommentController($c->get(App\Services\CommentService::class));
});

// Create App
$app = AppFactory::create();

// Configure Twig
$container->set('view', function () {
    return Twig::create(__DIR__ . '/templates', [
        'cache' => false, // Set to 'cache/' in production
        'debug' => true
    ]);
});

// Add Twig Middleware
$app->add(TwigMiddleware::createFromContainer($app));
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

// HSTS Middleware
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response->withHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
});

// DI Container Config
$container->set(App\Services\TaxService::class, function ($c) {
    return new App\Services\TaxService();
});

$container->set(App\Services\SalaryCalculator::class, function ($c) {
    return new App\Services\SalaryCalculator();
});

$container->set(App\Controllers\CalculatorController::class, function ($c) {
    return new App\Controllers\CalculatorController($c->get(App\Services\SalaryCalculator::class));
});

$container->set(App\Controllers\HomeController::class, function ($c) {
    return new App\Controllers\HomeController(
        $c->get('view'),
        $c->get(App\Services\TaxService::class),
        $c->get(App\Services\ProfessionService::class)
    );
});

$container->set(App\Services\ProfessionService::class, function ($c) {
    return new App\Services\ProfessionService();
});

$container->set(App\Controllers\ProfessionController::class, function ($c) {
    return new App\Controllers\ProfessionController(
        $c->get('view'),
        $c->get(App\Services\ProfessionService::class),
        $c->get(App\Services\TaxService::class),
        $c->get(App\Services\BlogService::class),
        $c->get(App\Services\CommentService::class),
        $c->get(App\Services\JobService::class)
    );
});

$container->set(App\Controllers\ConceptController::class, function ($c) {
    return new App\Controllers\ConceptController($c->get('view'));
});

$container->set(App\Controllers\SitemapController::class, function ($c) {
    return new App\Controllers\SitemapController(
        $c->get(App\Services\ProfessionService::class),
        $c->get(App\Services\BlogService::class)
    );
});

$container->set(App\Controllers\LegalController::class, function ($c) {
    return new App\Controllers\LegalController($c->get('view'));
});

// KommunalService and Controller
$container->set(App\Services\KommunalService::class, function ($c) {
    return new App\Services\KommunalService();
});

$container->set(App\Controllers\KommunalController::class, function ($c) {
    return new App\Controllers\KommunalController(
        $c->get('view'),
        $c->get(App\Services\KommunalService::class),
        $c->get(App\Services\ProfessionService::class)
    );
});

// BlogService and Controller
$container->set(App\Services\BlogService::class, function ($c) {
    return new App\Services\BlogService();
});

$container->set(App\Controllers\BlogController::class, function ($c) {
    return new App\Controllers\BlogController(
        $c->get(App\Services\BlogService::class),
        $c->get('view')
    );
});

// FaqController
$container->set(App\Controllers\FaqController::class, function ($c) {
    return new App\Controllers\FaqController(
        $c->get('view'),
        $c->get(App\Services\ProfessionService::class),
        $c->get(App\Services\BlogService::class)
    );
});

// Admin Toolbar
$container->set(App\Services\AdminToolbarService::class, function ($c) {
    return new App\Services\AdminToolbarService();
});

$container->set(App\Controllers\AdminController::class, function ($c) {
    return new App\Controllers\AdminController(
        $c->get(App\Services\AdminToolbarService::class)
    );
});

// Ads.txt Fallback (Resolves Nginx/Apache rewrites missing static file)


// Routes
$app->get('/', \App\Controllers\HomeController::class . ':index');
$app->get('/yrken', \App\Controllers\HomeController::class . ':yrken');
$app->get('/lon/{slug}', \App\Controllers\ProfessionController::class . ':show');

// Kommunal Sector Routes
$app->get('/kommunal-lon', \App\Controllers\KommunalController::class . ':index');
$app->get('/lon/region/{slug}', \App\Controllers\KommunalController::class . ':showLan');
$app->get('/lon/{slug}/kommunal', \App\Controllers\ProfessionController::class . ':showKommunal');

// Concept Pages
$app->get('/brutto-netto', \App\Controllers\ConceptController::class . ':bruttoNetto');
$app->get('/jobbskatteavdrag', \App\Controllers\ConceptController::class . ':jobbskatteavdrag');
$app->get('/statlig-skatt', \App\Controllers\ConceptController::class . ':statligSkatt');
$app->get('/lon-efter-skatt', \App\Controllers\ConceptController::class . ':lonEfterSkatt');

// Verktyg (Tools)
$app->get('/verktyg/lone-speedrunner', function ($request, $response, $args) use ($container) {
    return $container->get('view')->render($response, 'verktyg/lone-speedrunner.twig', [
        'pageTitle' => 'Löne-Speedrunner 2026 - Beräkna din lojalitetsskatt',
        'pageDescription' => 'Hur mycket förlorar du på att stanna kvar? Beräkna din lojalitetsskatt och få exakta scripts för att höja din lön.'
    ]);
});

$app->get('/verktyg/brag-sheet', function ($request, $response, $args) use ($container) {
    return $container->get('view')->render($response, 'verktyg/brag-sheet.twig');
});


// Legal Pages (AdSense & GDPR Compliance)
$app->get('/integritetspolicy', \App\Controllers\LegalController::class . ':integritetspolicy');
$app->get('/om-oss', \App\Controllers\LegalController::class . ':omOss');
$app->get('/om-oss/nala', \App\Controllers\ConceptController::class . ':nala');
$app->get('/kontakt', \App\Controllers\LegalController::class . ':kontakt');
$app->get('/cookies', \App\Controllers\LegalController::class . ':cookies');
$app->get('/ansvarsfriskrivning', \App\Controllers\LegalController::class . ':ansvarsfriskrivning');
$app->get('/sa-raknar-vi', \App\Controllers\LegalController::class . ':metodologi');

// Blog Routes
$app->get('/blogg', \App\Controllers\BlogController::class . ':index');
$app->get('/blogg/kategori/{category}', \App\Controllers\BlogController::class . ':category');
$app->get('/blogg/{slug}', \App\Controllers\BlogController::class . ':show');


// FAQ Routes
$app->get('/faq/{slug}', \App\Controllers\FaqController::class . ':show');

// System
$app->get('/sitemap.xml', \App\Controllers\SitemapController::class . ':index');

// Ads.txt Fallback (Resolves Nginx/Apache rewrites missing static file)
$app->get('/ads.txt', function (Request $request, Response $response) {
    // Check root and public paths
    $files = [__DIR__ . '/ads.txt', __DIR__ . '/public/ads.txt'];
    $content = "";

    foreach ($files as $file) {
        if (file_exists($file)) {
            $content = file_get_contents($file);
            break;
        }
    }

    if (empty($content)) {
        $content = "google.com, pub-0000000000000000, DIRECT, f08c47fec0942fa0"; // Minimal fallback
    }

    $response->getBody()->write($content);
    return $response->withHeader('Content-Type', 'text/plain');
});



$app->post('/api/calculate', \App\Controllers\CalculatorController::class . ':calculate');
$app->get('/api/admin/toolbar', \App\Controllers\AdminController::class . ':getData');
$app->post('/api/admin/indexing', \App\Controllers\AdminController::class . ':submitIndexing');
$app->post('/api/admin/analyze', \App\Controllers\AdminController::class . ':submitAiAnalysis');

// Comment API Routes
$app->post('/api/comments', \App\Controllers\CommentController::class . ':submitComment');
$app->post('/api/comments/reply', \App\Controllers\CommentController::class . ':submitReply');

// Salary Position API
$app->post('/api/salary-position', \App\Controllers\SalaryPositionController::class . ':calculate');

// Newsletter Subscription API (Simple inline handler)
$app->post('/api/subscribe', function ($request, $response, $args) {
    $dataFile = __DIR__ . '/protected/subscribers.json';

    // Parse JSON body
    $data = $request->getParsedBody();
    if (empty($data)) {
        $body = (string) $request->getBody();
        $data = json_decode($body, true);
    }

    // Validate email
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $payload = json_encode(['error' => 'Invalid email address']);
        $response->getBody()->write($payload);
        return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
    }

    // Create entry
    // Create entry
    $entry = [
        'id' => uniqid('sub_', true),
        'email' => htmlspecialchars($data['email']),
        'variant_id' => isset($data['variant_id']) ? htmlspecialchars($data['variant_id']) : 'unknown',
        'url' => isset($data['url']) ? htmlspecialchars($data['url']) : 'unknown',
        'source' => isset($data['source']) ? htmlspecialchars($data['source']) : 'unknown',
        'date' => date('Y-m-d H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR'],
        // GDPR Compliance
        'marketing_consent' => isset($data['marketing_consent']) ? (bool) $data['marketing_consent'] : false,
        'consent_timestamp' => isset($data['consent_timestamp']) ? htmlspecialchars($data['consent_timestamp']) : date('c'),
        'consent_text' => isset($data['consent_text']) ? htmlspecialchars($data['consent_text']) : null
    ];

    // Read existing data
    $currentData = [];
    if (file_exists($dataFile)) {
        $content = file_get_contents($dataFile);
        $currentData = json_decode($content, true);
        if (!is_array($currentData)) {
            $currentData = [];
        }
    }
    $currentData[] = $entry;

    // Save
    if (file_put_contents($dataFile, json_encode($currentData, JSON_PRETTY_PRINT), LOCK_EX) === false) {
        $payload = json_encode(['error' => 'Failed to save data']);
        $response->getBody()->write($payload);
        return $response->withStatus(500)->withHeader('Content-Type', 'application/json');
    }

    // Success
    $payload = json_encode(['success' => true, 'message' => 'Subscribed successfully']);
    $response->getBody()->write($payload);
    return $response->withStatus(200)->withHeader('Content-Type', 'application/json');
});

$app->run();
