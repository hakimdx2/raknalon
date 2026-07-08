<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\BlogService;
use Slim\Views\Twig;

class BlogController
{
    private BlogService $blogService;
    private Twig $twig;

    public function __construct(BlogService $blogService, Twig $twig)
    {
        $this->blogService = $blogService;
        $this->twig = $twig;
    }

    /**
     * Blog listing page
     */
    public function index(Request $request, Response $response): Response
    {
        $posts = $this->blogService->getAllPosts();
        $categories = $this->blogService->getCategories();

        return $this->twig->render($response, 'blog/index.twig', [
            'title' => 'Blogg – Lön & Karriär | Räkna Lön',
            'description' => 'Läs våra artiklar om lön, karriär, jobbmarknad och arbetsvillkor i Sverige. Aktuella tips och råd för din ekonomi.',
            'current_path' => '/blogg',
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
     * Single blog post page
     */
    public function show(Request $request, Response $response, array $args): Response
    {
        $slug = $args['slug'] ?? '';
        $post = $this->blogService->getPostBySlug($slug);

        if (!$post) {
            throw new \Slim\Exception\HttpNotFoundException($request, 'Artikel hittades inte');
        }

        // Get related posts (same category)
        $relatedPosts = [];
        if (isset($post['category'])) {
            $categoryPosts = $this->blogService->getPostsByCategory($post['category']);
            $relatedPosts = array_filter($categoryPosts, fn($p) => $p['slug'] !== $slug);
            $relatedPosts = array_slice($relatedPosts, 0, 3);
        }

        return $this->twig->render($response, 'blog/post.twig', [
            'title' => ($post['title'] ?? 'Artikel') . ' | Räkna Lön',
            'description' => $post['excerpt'] ?? $post['description'] ?? '',
            'current_path' => '/blogg/' . $slug,
            'post' => $post,
            'related_posts' => $relatedPosts,
        ]);
    }

    /**
     * Category listing page
     */
    public function category(Request $request, Response $response, array $args): Response
    {
        $category = $args['category'] ?? '';
        $posts = $this->blogService->getPostsByCategory($category);
        $categories = $this->blogService->getCategories();

        if (empty($posts)) {
            throw new \Slim\Exception\HttpNotFoundException($request, 'Kategori hittades inte');
        }

        return $this->twig->render($response, 'blog/index.twig', [
            'title' => $category . ' – Blogg | Räkna Lön',
            'description' => 'Läs våra artiklar om ' . $category . '. Tips och råd för din karriär och ekonomi.',
            'current_path' => '/blogg/kategori/' . $category,
            'posts' => $posts,
            'categories' => $categories,
            'current_category' => $category,
        ]);
    }
}
