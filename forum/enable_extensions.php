<?php

$config = include 'config.php';

if (!is_array($config)) {
    die("Error: Could not load config.php\n");
}

$dbConf = $config['database'];

try {
    $dsn = "mysql:host={$dbConf['host']};port={$dbConf['port']};dbname={$dbConf['database']};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbConf['username'], $dbConf['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database.\n";

    // 1. Enable Extensions
    $stmt = $pdo->prepare("SELECT value FROM settings WHERE `key` = 'extensions_enabled'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $extensions = [];
    if ($row && $row['value']) {
        $extensions = json_decode($row['value'], true);
    }

    $newExtensions = ['fof-best-answer', 'v17development-flarum-seo'];
    $updated = false;

    foreach ($newExtensions as $ext) {
        if (!in_array($ext, $extensions)) {
            $extensions[] = $ext;
            $updated = true;
            echo "Enabled extension: $ext\n";
        }
    }

    if ($updated) {
        $newValue = json_encode($extensions);
        if ($row) {
            $update = $pdo->prepare("UPDATE settings SET value = :value WHERE `key` = 'extensions_enabled'");
            $update->execute([':value' => $newValue]);
        } else {
            $insert = $pdo->prepare("INSERT INTO settings (`key`, value) VALUES ('extensions_enabled', :value)");
            $insert->execute([':value' => $newValue]);
        }
    } else {
        echo "Extensions already enabled.\n";
    }

    // 2. Seed Welcome Post
    // Check if discussion exists
    $stmt = $pdo->prepare("SELECT id FROM discussions WHERE title = 'Välkommen till Raknalon Forum! 👋'");
    $stmt->execute();
    if (!$stmt->fetch()) {
        $now = date('Y-m-d H:i:s');

        // Create Discussion
        $stmt = $pdo->prepare("INSERT INTO discussions (title, comment_count, participant_count, post_number_index, created_at, user_id, first_post_id, last_post_id, last_posted_at, last_posted_user_id, slug) VALUES (:title, 1, 1, 1, :now, 1, 0, 0, :now, 1, 'valkommen-till-raknalon-forum')");
        $stmt->execute([
            ':title' => 'Välkommen till Raknalon Forum! 👋',
            ':now' => $now
        ]);
        $discussionId = $pdo->lastInsertId();

        // Create Post
        $content = "Hej och välkommen! \n\nHär kan vi diskutera allt som rör **lön**, **skatt** och **karriär**. \n\nHar du funderingar kring din lönestatistik? Eller undrar du hur skatten faktiskt fungerar? Ställ din fråga här!\n\nGlöm inte att vara trevlig ton. 😉";

        $stmt = $pdo->prepare("INSERT INTO posts (discussion_id, number, created_at, user_id, type, content) VALUES (:discussion_id, 1, :now, 1, 'comment', :content)");
        $stmt->execute([
            ':discussion_id' => $discussionId,
            ':now' => $now,
            ':content' => $content
        ]);
        $postId = $pdo->lastInsertId();

        // Update Discussion with Post IDs
        $stmt = $pdo->prepare("UPDATE discussions SET first_post_id = :pid, last_post_id = :pid WHERE id = :did");
        $stmt->execute([':pid' => $postId, ':did' => $discussionId]);

        // Link to Tag (e.g., 'Om Raknalon' which is likely ID 5)
        // We need to find tag ID for 'om-raknalon'
        $stmt = $pdo->prepare("SELECT id FROM tags WHERE slug = 'om-raknalon'");
        $stmt->execute();
        $tag = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tag) {
            $stmt = $pdo->prepare("INSERT INTO discussion_tag (discussion_id, tag_id) VALUES (:did, :tid)");
            $stmt->execute([':did' => $discussionId, ':tid' => $tag['id']]);
        }

        echo "Created welcome discussion ID: $discussionId\n";
    } else {
        echo "Welcome discussion already exists.\n";
    }

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage() . "\n");
}
