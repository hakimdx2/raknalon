<?php

namespace App\Services;

class BlogService
{
    private string $contentPath;

    public function __construct()
    {
        $this->contentPath = __DIR__ . '/../../content/blog';
    }

    /**
     * Get all blog posts sorted by date (newest first)
     */
    public function getAllPosts(): array
    {
        $posts = [];

        if (!is_dir($this->contentPath)) {
            return [];
        }

        $files = glob($this->contentPath . '/*.md');

        foreach ($files as $file) {
            $post = $this->parseMarkdownFile($file);
            if ($post && ($post['published'] ?? true)) {
                $posts[] = $post;
            }
        }

        // Sort by date descending
        usort($posts, function ($a, $b) {
            return strtotime($b['date'] ?? '2020-01-01') - strtotime($a['date'] ?? '2020-01-01');
        });

        return $posts;
    }

    /**
     * Get a single post by slug
     */
    public function getPostBySlug(string $slug): ?array
    {
        $filePath = $this->contentPath . '/' . $slug . '.md';

        if (!file_exists($filePath)) {
            return null;
        }

        return $this->parseMarkdownFile($filePath);
    }

    /**
     * Parse a markdown file with YAML frontmatter
     */
    private function parseMarkdownFile(string $filePath): ?array
    {
        $content = file_get_contents($filePath);

        if ($content === false) {
            return null;
        }

        // Extract frontmatter and content
        $pattern = '/^---\s*\n(.*?)\n---\s*\n(.*)$/s';

        if (!preg_match($pattern, $content, $matches)) {
            // No frontmatter, treat entire content as markdown
            return [
                'slug' => pathinfo($filePath, PATHINFO_FILENAME),
                'title' => pathinfo($filePath, PATHINFO_FILENAME),
                'content' => $this->parseMarkdown($content),
                'raw_content' => $content,
            ];
        }

        $frontmatter = $this->parseYamlFrontmatter($matches[1]);
        $markdownContent = $matches[2];

        return array_merge($frontmatter, [
            'slug' => pathinfo($filePath, PATHINFO_FILENAME),
            'content' => $this->parseMarkdown($markdownContent),
            'raw_content' => $markdownContent,
            'excerpt' => $this->generateExcerpt($markdownContent, 160),
            'formatted_date' => $this->formatSwedishDate($frontmatter['date'] ?? 'now'),
        ]);
    }

    /**
     * Parse YAML frontmatter (simple parser)
     */
    private function parseYamlFrontmatter(string $yaml): array
    {
        $data = [];
        $lines = explode("\n", $yaml);

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line))
                continue;

            if (preg_match('/^(\w+):\s*(.*)$/', $line, $matches)) {
                $key = $matches[1];
                $value = trim($matches[2], '"\'');

                // Handle arrays (simple format: key: [a, b, c])
                if (preg_match('/^\[(.*)\]$/', $value, $arrayMatches)) {
                    $value = array_map('trim', explode(',', $arrayMatches[1]));
                }
                // Handle booleans
                elseif ($value === 'true') {
                    $value = true;
                } elseif ($value === 'false') {
                    $value = false;
                }

                $data[$key] = $value;
            }
        }

        return $data;
    }

    /**
     * Convert markdown to HTML using Parsedown
     */
    private function parseMarkdown(string $markdown): string
    {
        $parsedown = new \Parsedown();
        $html = $parsedown->text($markdown);

        // Wrap tables in a styled container with shadow and rounded corners
        $html = preg_replace(
            '/<table[^>]*>/',
            '<div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg my-8 not-prose"><table class="min-w-full divide-y divide-slate-300">',
            $html
        );
        $html = str_replace('</table>', '</table></div>', $html);

        // Style thead (Parsedown generates it)
        $html = preg_replace('/<thead[^>]*>/', '<thead class="bg-slate-50">', $html);

        // Style tbody
        $html = preg_replace('/<tbody[^>]*>/', '<tbody class="divide-y divide-slate-200 bg-white">', $html);

        // Consolidate multiple tbodies into one if they are adjacent
        $html = preg_replace('/<\/tbody>\s*<tbody[^>]*>/', '', $html);

        // Style th elements (handle Parsedown's style attributes)
        $html = preg_replace(
            '/<th[^>]*>/',
            '<th scope="col" class="py-3.5 px-4 text-left text-sm font-semibold text-slate-900">',
            $html
        );

        // Style td elements (handle Parsedown's style attributes)
        $html = preg_replace(
            '/<td[^>]*>/',
            '<td class="px-4 py-4 text-sm text-slate-700">',
            $html
        );

        // Handle external links (add target="_blank" and rel="nofollow")
        $html = preg_replace_callback('/<a[^>]+href="([^"]+)"[^>]*>/', function ($matches) {
            $url = $matches[1];
            $isExternal = strpos($url, 'http') === 0 && strpos($url, 'raknalon.se') === false;

            if ($isExternal) {
                // Check if rel or target already exists to avoid duplication (simple check)
                $tag = $matches[0];
                if (strpos($tag, 'target=') === false) {
                    $tag = str_replace('<a ', '<a target="_blank" ', $tag);
                }
                if (strpos($tag, 'rel=') === false) {
                    $tag = str_replace('<a ', '<a rel="nofollow noopener" ', $tag);
                }
                return $tag;
            }
            return $matches[0];
        }, $html);

        return $html;
    }

    /**
     * Generate excerpt from markdown content
     */
    private function generateExcerpt(string $markdown, int $length = 160): string
    {
        // Remove markdown formatting
        $text = preg_replace('/[#*`>\[\]()]/', '', $markdown);
        $text = preg_replace('/\n+/', ' ', $text);
        $text = trim($text);

        if (mb_strlen($text, 'UTF-8') <= $length) {
            return $text;
        }

        return mb_substr($text, 0, $length, 'UTF-8') . '...';
    }

    /**
     * Format date to Swedish
     */
    private function formatSwedishDate(string $dateString): string
    {
        $timestamp = strtotime($dateString);
        if (!$timestamp) {
            return $dateString;
        }

        $months = [
            1 => 'januari',
            2 => 'februari',
            3 => 'mars',
            4 => 'april',
            5 => 'maj',
            6 => 'juni',
            7 => 'juli',
            8 => 'augusti',
            9 => 'september',
            10 => 'oktober',
            11 => 'november',
            12 => 'december'
        ];

        $day = date('j', $timestamp);
        $month = $months[date('n', $timestamp)];
        $year = date('Y', $timestamp);

        return "$day $month $year";
    }

    /**
     * Get posts by category
     */
    public function getPostsByCategory(string $category): array
    {
        $allPosts = $this->getAllPosts();

        return array_filter($allPosts, function ($post) use ($category) {
            return ($post['category'] ?? '') === $category;
        });
    }

    /**
     * Get all categories with post counts
     */
    public function getCategories(): array
    {
        $posts = $this->getAllPosts();
        $categories = [];

        foreach ($posts as $post) {
            $category = $post['category'] ?? 'Övrigt';
            if (!isset($categories[$category])) {
                $categories[$category] = 0;
            }
            $categories[$category]++;
        }

        return $categories;
    }
}
