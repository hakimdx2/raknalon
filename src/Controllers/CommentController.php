<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\CommentService;

class CommentController
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function submitComment(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        
        // Validation
        if (empty($data['page_slug']) || empty($data['author']) || empty($data['email']) || empty($data['content'])) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Alla fält är obligatoriska.']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        try {
            $newComment = $this->commentService->addComment(
                $data['page_slug'],
                $data['author'],
                $data['email'],
                $data['content']
            );

            $response->getBody()->write(json_encode(['success' => true, 'comment' => $newComment]));
            return $response->withHeader('Content-Type', 'application/json');

        } catch (\Exception $e) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    }

    public function submitReply(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();

        // Validation
        if (empty($data['parent_id']) || empty($data['author']) || empty($data['email']) || empty($data['content'])) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => 'Alla fält är obligatoriska.']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(400);
        }

        try {
            $newReply = $this->commentService->addReply(
                (int)$data['parent_id'],
                $data['author'],
                $data['email'],
                $data['content']
            );

            $response->getBody()->write(json_encode(['success' => true, 'reply' => $newReply]));
            return $response->withHeader('Content-Type', 'application/json');

        } catch (\Exception $e) {
            $response->getBody()->write(json_encode(['success' => false, 'message' => $e->getMessage()]));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(500);
        }
    }
}
