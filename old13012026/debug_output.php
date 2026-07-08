<?php
require_once __DIR__ . '/vendor/autoload.php';

$content = file_get_contents(__DIR__ . '/content/blog/sjukskoterska-lon.md');
$pattern = '/^---\s*\n(.*?)\n---\s*\n(.*)$/s';
if (preg_match($pattern, $content, $matches)) {
    $markdown = $matches[2];
} else {
    $markdown = $content;
}

$parsedown = new \Parsedown();
$html = $parsedown->text($markdown);

// Logic from BlogService.php
$html = preg_replace(
    '/<table[^>]*>/',
    '<div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg my-8 not-prose"><table class="min-w-full divide-y divide-slate-300">',
    $html
);
$html = str_replace('</table>', '</table></div>', $html);
$html = preg_replace('/<thead[^>]*>/', '<thead class="bg-slate-50">', $html);
$html = preg_replace('/<tbody[^>]*>/', '<tbody class="divide-y divide-slate-200 bg-white">', $html);
$html = preg_replace('/<th[^>]*>/', '<th scope="col" class="py-3.5 px-4 text-left text-sm font-semibold text-slate-900">', $html);
$html = preg_replace('/<td[^>]*>/', '<td class="px-4 py-4 text-sm text-slate-700">', $html);

file_put_contents('debug_table.html', $html);
echo "Debug file written to debug_table.html\n";
