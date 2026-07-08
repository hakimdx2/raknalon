<?php

use Valet\Drivers\BasicValetDriver;

/**
 * Custom Valet Driver for Slim Framework
 * This driver allows Laravel Herd/Valet to serve Slim applications correctly
 */
class LocalValetDriver extends BasicValetDriver
{
    /**
     * Determine if the driver serves the request.
     */
    public function serves(string $sitePath, string $siteName, string $uri): bool
    {
        // This driver serves this site - check for index.php at root
        return file_exists($sitePath . '/index.php')
            && file_exists($sitePath . '/vendor/autoload.php');
    }

    /**
     * Determine if the incoming request is for a static file.
     */
    public function isStaticFile(string $sitePath, string $siteName, string $uri)/*: string|false*/
    {
        // Check if the URI points to an actual file
        $staticFilePath = $sitePath . $uri;
        if ($uri !== '/' && file_exists($staticFilePath) && !is_dir($staticFilePath)) {
            return $staticFilePath;
        }

        // Handle Flarum assets (map /forum/xyz -> /forum/public/xyz)
        if (strpos($uri, '/forum') === 0) {
            $forumRelPath = substr($uri, 6); // Remove '/forum'
            $forumCandidate = $sitePath . '/forum/public' . $forumRelPath;
            if (file_exists($forumCandidate) && !is_dir($forumCandidate)) {
                return $forumCandidate;
            }
        }

        // Check in public directory
        if (file_exists($staticFilePath = $sitePath . '/public' . $uri)) {
            return $staticFilePath;
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     */
    public function frontControllerPath(string $sitePath, string $siteName, string $uri): string
    {
        // Route /forum requests to Flarum
        if (strpos($uri, '/forum') === 0) {
            return $sitePath . '/forum/public/index.php';
        }

        // All other requests go to main index.php
        return $sitePath . '/index.php';
    }
}
