<?php
/**
 * Script to add test comments for CNC-operator page
 * Run: php add_test_comments.php
 */

require __DIR__ . '/vendor/autoload.php';

use SleekDB\Store;

$dataDir = __DIR__ . '/data/comments';
$commentStore = new Store('comments', $dataDir, [
    'auto_cache' => false,
    'timeout' => false
]);

// Test comments for cnc-operator page
$testComments = [
    [
        'page_slug' => 'cnc-operator',
        'author' => 'Erik Lindqvist',
        'email' => 'erik@example.com',
        'content' => 'Hej! Jag funderar på att utbilda mig till CNC-operatör. Är lönen verkligen så bra som det står här? Hur ser framtidsutsikterna ut?',
        'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
        'parent_id' => null,
        'is_approved' => true
    ],
    [
        'page_slug' => 'cnc-operator',
        'author' => 'Maria Svensson',
        'email' => 'maria@example.com',
        'content' => 'Vilken utbildning rekommenderar ni för att bli CNC-operatör? Jag har hört att det finns YH-utbildningar men också kortare kurser.',
        'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
        'parent_id' => null,
        'is_approved' => true
    ],
    [
        'page_slug' => 'cnc-operator',
        'author' => 'Johan Andersson',
        'email' => 'johan@example.com',
        'content' => 'Jag jobbar som CNC-operatör sedan 8 år tillbaka. Lönen stämmer ganska bra med min erfarenhet. Tips: förhandla alltid vid årliga lönesamtal!',
        'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
        'parent_id' => null,
        'is_approved' => true
    ]
];

echo "Adding test comments...\n";

foreach ($testComments as $comment) {
    $result = $commentStore->insert($comment);
    echo "✓ Added comment from {$comment['author']} (ID: {$result['_id']})\n";
}

// Add admin reply to first comment
$allComments = $commentStore->findBy(["page_slug", "=", "cnc-operator"]);
$firstComment = $allComments[0] ?? null;

if ($firstComment) {
    $adminReply = [
        'page_slug' => 'cnc-operator',
        'author' => 'Räkna Lön Team',
        'email' => 'info@raknalon.se',
        'content' => 'Hej Erik! Tack för din fråga. Ja, CNC-operatörer har generellt bra löner och efterfrågan är hög inom svensk industri. Framtidsutsikterna är goda, särskilt om du vidareutbildar dig inom programmering och automation. Vi rekommenderar att du kollar på YH-utbildningar som ofta har bra kontakt med arbetsgivare.',
        'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
        'parent_id' => $firstComment['_id'],
        'is_admin_reply' => true,
        'is_approved' => true
    ];

    $result = $commentStore->insert($adminReply);
    echo "✓ Added admin reply (ID: {$result['_id']})\n";
}

echo "\nDone! " . count($testComments) . " comments + 1 admin reply added.\n";
