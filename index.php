<?php

$jsonData = file_get_contents('posts.json');
$blogPosts = json_decode($jsonData, true);

if ($blogPosts === null) {
    error_log("Error: Unable to parse blog posts JSON.");
    die("Error: Unable to parse blog posts. Please check the error log.");
}

function sortPostsByDate($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
}

uasort($blogPosts, 'sortPostsByDate');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Blog Index</title>
</head>

<body>

    <div class="container mt-5">
        
        <h1 class="mb-4">Blog Posts</h1>

        <div class="list-group">
            <?php foreach ($blogPosts as $index => $post): ?>
                <a href="detail.php?post_id=<?= urlencode($index) ?>" class="list-group-item list-group-item-action">
                    <h5 class="mb-1"><?= htmlspecialchars($post['title']) ?></h5>
                    <p class="mb-1 text-muted">By <?= htmlspecialchars($post['author']) ?> on <?= htmlspecialchars($post['date']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>