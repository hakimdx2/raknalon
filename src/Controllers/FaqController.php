<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Exception\HttpNotFoundException;
use App\Services\ProfessionService;
use App\Services\BlogService;

class FaqController
{
    private $view;
    private $professionService;
    private $blogService;

    public function __construct(Twig $view, ProfessionService $professionService, BlogService $blogService)
    {
        $this->view = $view;
        $this->professionService = $professionService;
        $this->blogService = $blogService;
    }

    public function show(Request $request, Response $response, $args)
    {
        $slug = str_replace('-lon', '', $args['slug']); // Convert "underskoterska-lon" to "underskoterska"
        
        $profession = $this->professionService->getBySlug($slug);

        if (!$profession) {
            // Try explicit slug if replacement failed
            $profession = $this->professionService->getBySlug($args['slug']);
        }

        if (!$profession) {
            throw new HttpNotFoundException($request);
        }

        // Get related professions for internal linking
        $allProfessions = $this->professionService->getAll();
        $relatedProfessions = array_slice(array_filter($allProfessions, function($p) use ($slug) {
            return $p['slug'] !== $slug;
        }), 0, 5);

        return $this->view->render($response, 'faq_profession.twig', [
            'profession' => $profession,
            'related_professions' => $relatedProfessions,
        ]);
    }
}
