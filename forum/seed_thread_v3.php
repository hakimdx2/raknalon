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

    $now = date('Y-m-d H:i:s');
    $title = 'Välkommen till Raknalon Forum! 👋';
    $slug = 'valkommen-till-raknalon-forum';

    // Check if discussion exists based on slug (more reliable)
    $stmt = $pdo->prepare("SELECT id FROM discussions WHERE slug = :slug");
    $stmt->execute([':slug' => $slug]);
    $existing = $stmt->fetch();

    if ($existing) {
        $discussionId = $existing['id'];
        echo "Discussion already exists (ID: $discussionId). Updating...\n";
    } else {
        // Create Discussion
        // Explicitly setting EVERY column identified in schema
        // is_private, is_approved, is_sticky, is_locked are NOT NULL per schema
        $stmt = $pdo->prepare("
            INSERT INTO discussions 
            (title, slug, comment_count, participant_count, post_number_index, created_at, user_id, first_post_id, last_post_id, last_posted_at, last_posted_user_id, is_private, is_approved, is_sticky, is_locked) 
            VALUES 
            (:title, :slug, 1, 1, 1, :now, 1, 0, 0, :now, 1, 0, 1, 0, 0)
        ");
        $stmt->execute([
            ':title' => $title,
            ':slug' => $slug,
            ':now' => $now
        ]);
        $discussionId = $pdo->lastInsertId();
        echo "Created discussion ID: $discussionId\n";
    }

    // Create Post
    // Check if post exists for this discussion
    $stmt = $pdo->prepare("SELECT id FROM posts WHERE discussion_id = :did LIMIT 1");
    $stmt->execute([':did' => $discussionId]);
    $existingPost = $stmt->fetch();

    if ($existingPost) {
        $postId = $existingPost['id'];
        echo "Post already exists (ID: $postId).\n";
    } else {
        $content = "Hej och välkommen! \n\nHär kan vi diskutera allt som rör **lön**, **skatt** och **karriär**. \n\nHar du funderingar kring din lönestatistik? Eller undrar du hur skatten faktiskt fungerar? Ställ din fråga här!\n\nGlöm inte att vara trevlig ton. 😉";

        // Explicitly setting is_private, is_approved per schema
        $stmt = $pdo->prepare("
            INSERT INTO posts 
            (discussion_id, number, created_at, user_id, type, content, is_private, is_approved, ip_address) 
            VALUES 
            (:discussion_id, 1, :now, 1, 'comment', :content, 0, 1, '127.0.0.1')
        ");
        $stmt->execute([
            ':discussion_id' => $discussionId,
            ':now' => $now,
            ':content' => $content
        ]);
        $postId = $pdo->lastInsertId();
        echo "Created post ID: $postId\n";
    }

    // Update Discussion with Post IDs
    $stmt = $pdo->prepare("UPDATE discussions SET first_post_id = :pid, last_post_id = :pid WHERE id = :did");
    $stmt->execute([':pid' => $postId, ':did' => $discussionId]);
    echo "Linked post to discussion.\n";

    // Link to Tag (e.g., 'Om Raknalon')
    $stmt = $pdo->prepare("SELECT id FROM tags WHERE slug = 'om-raknalon'");
    $stmt->execute();
    $tag = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($tag) {
        // Check link exists
        $stmt = $pdo->prepare("SELECT 1 FROM discussion_tag WHERE discussion_id = :did AND tag_id = :tid");
        $stmt->execute([':did' => $discussionId, ':tid' => $tag['id']]);
        if (!$stmt->fetch()) {
            $stmt = $pdo->prepare("INSERT INTO discussion_tag (discussion_id, tag_id) VALUES (:did, :tid)");
            $stmt->execute([':did' => $discussionId, ':tid' => $tag['id']]);
            echo "Linked discussion to tag '{$tag['id']}'.\n";
        }
    }

} catch (PDOException $e) {
    die("DB Error: " . $e->getMessage() . "\n");
}
