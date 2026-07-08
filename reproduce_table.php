<?php
require_once __DIR__ . '/vendor/autoload.php';

$markdown = <<<EOD
| |
| :--- |
| Bruttolön | Ungefärlig Nettolön |
| :-------- | :------------------ |
| 30 000 kr | ca 23 500 kr        |
EOD;

$parsedown = new \Parsedown();
$html = $parsedown->text($markdown);

echo "--- RAW PARSEDOWN OUTPUT ---\n";
echo $html . "\n";

// Logic from BlogService.php
$styledHtml = preg_replace(
    '/<table>/',
    '<div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg my-8 not-prose"><table class="min-w-full divide-y divide-slate-300">',
    $html
);
$styledHtml = str_replace('</table>', '</table></div>', $styledHtml);
$styledHtml = preg_replace('/<thead>/', '<thead class="bg-slate-50">', $styledHtml);
$styledHtml = preg_replace('/<tbody>/', '<tbody class="divide-y divide-slate-200 bg-white">', $styledHtml);

$styledHtml = preg_replace(
    '/<th[^>]*>/',
    '<th scope="col" class="py-3.5 px-4 text-left text-sm font-semibold text-slate-900">',
    $styledHtml
);

$styledHtml = preg_replace(
    '/<td[^>]*>/',
    '<td class="px-4 py-4 text-sm text-slate-700">',
    $styledHtml
);

echo "\n--- STYLED OUTPUT ---\n";
echo $styledHtml . "\n";
