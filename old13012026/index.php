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

// Create App
$app = AppFactory::create();

// Configure Twig
$container->set('view', function() {
    return Twig::create(__DIR__ . '/templates', [
        'cache' => false, // Set to 'cache/' in production
        'debug' => true
    ]);
});

// Add Twig Middleware
$app->add(TwigMiddleware::createFromContainer($app));
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
        $c->get(App\Services\BlogService::class)
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

// Legal Pages (AdSense & GDPR Compliance)
$app->get('/integritetspolicy', \App\Controllers\LegalController::class . ':integritetspolicy');
$app->get('/om-oss', \App\Controllers\LegalController::class . ':omOss');
$app->get('/kontakt', \App\Controllers\LegalController::class . ':kontakt');
$app->get('/cookies', \App\Controllers\LegalController::class . ':cookies');
$app->get('/ansvarsfriskrivning', \App\Controllers\LegalController::class . ':ansvarsfriskrivning');
$app->get('/sa-raknar-vi', \App\Controllers\LegalController::class . ':metodologi');

// Blog Routes
$app->get('/blogg', \App\Controllers\BlogController::class . ':index');
$app->get('/blogg/kategori/{category}', \App\Controllers\BlogController::class . ':category');
$app->get('/blogg/{slug}', \App\Controllers\BlogController::class . ':show');

// System
$app->get('/sitemap.xml', \App\Controllers\SitemapController::class . ':index');

$app->post('/api/calculate', \App\Controllers\CalculatorController::class . ':calculate');

$app->run();
