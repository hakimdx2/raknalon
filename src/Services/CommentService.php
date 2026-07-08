<?php

namespace App\Services;

use SleekDB\Store;

class CommentService
{
    private $commentStore;
    private $dataDir;

    public function __construct()
    {
        // Define the data directory relative to the project root
        $this->dataDir = __DIR__ . '/../../data/comments';
        
        // Create the directory if it doesn't exist
        if (!file_exists($this->dataDir)) {
            mkdir($this->dataDir, 0777, true);
        }

        // Initialize the store
        $this->commentStore = new Store('comments', $this->dataDir, [
            'auto_cache' => false,
            'timeout' => false // No timeout
        ]);
    }

    /**
     * Get all approved comments for a specific page slug, threaded.
     */
    public function getCommentsByPage(string $slug): array
    {
        // Fetch all comments for this page
        $comments = $this->commentStore->findBy(["page_slug", "=", $slug], ["created_at" => "desc"]);
        
        // Since SleekDB is a flat document store, replies might be stored separately or nested.
        // For simplicity, let's assume we store replies within the parent comment object or link them.
        // Structure:
        // {
        //   "_id": 1,
        //   "page_slug": "sjukskoterska",
        //   "author": "Name",
        //   "content": "...",
        //   "created_at": "timestamp",
        //   "parent_id": null
        // }
        
        // Filter out replies from the main list (root comments)
        $rootComments = array_filter($comments, function($c) {
            return empty($c['parent_id']);
        });

        // Get replies
        $replies = array_filter($comments, function($c) {
            return !empty($c['parent_id']);
        });

        // Nest replies under their parents
        foreach ($rootComments as &$root) {
            $root['replies'] = [];
            foreach ($replies as $reply) {
                if ($reply['parent_id'] == $root['_id']) {
                    $root['replies'][] = $reply;
                }
            }
            // Sort replies ASC (oldest first)
            usort($root['replies'], function($a, $b) {
                return strtotime($a['created_at']) - strtotime($b['created_at']);
            });
        }

        return array_values($rootComments);
    }

    /**
     * Add a new root comment
     */
    public function addComment(string $slug, string $author, string $email, string $content): array
    {
        $comment = [
            'page_slug' => $slug,
            'author' => htmlspecialchars($author),
            'email' => htmlspecialchars($email), // Keep email for admin/gravatar but maybe don't display it to public
            'content' => htmlspecialchars($content),
            'created_at' => date('Y-m-d H:i:s'),
            'parent_id' => null,
            'is_approved' => true // Auto-approve for now, or false if moderation needed
        ];

        return $this->commentStore->insert($comment);
    }

    /**
     * Add a reply to a comment
     */
    public function addReply(int $parentId, string $author, string $email, string $content): array
    {
        // Verify parent exists
        $parent = $this->commentStore->findById($parentId);
        if (!$parent) {
            throw new \Exception("Parent comment not found");
        }

        $reply = [
            'page_slug' => $parent['page_slug'],
            'author' => htmlspecialchars($author),
            'email' => htmlspecialchars($email),
            'content' => htmlspecialchars($content),
            'created_at' => date('Y-m-d H:i:s'),
            'parent_id' => $parentId,
            'is_admin_reply' => false, // Can be set to true if logged in as admin
            'is_approved' => true 
        ];

        return $this->commentStore->insert($reply);
    }
    
    /**
     * Add an admin reply (special styling)
     */
    public function addAdminReply(int $parentId, string $content): array
    {
        $parent = $this->commentStore->findById($parentId);
        if (!$parent) {
             throw new \Exception("Parent comment not found");
        }

        $reply = [
            'page_slug' => $parent['page_slug'],
            'author' => 'Räkna Lön Team',
            'email' => 'info@raknalon.se',
            'content' => htmlspecialchars($content),
            'created_at' => date('Y-m-d H:i:s'),
            'parent_id' => $parentId,
            'is_admin_reply' => true,
            'is_approved' => true
        ];

        return $this->commentStore->insert($reply);
    }
}
