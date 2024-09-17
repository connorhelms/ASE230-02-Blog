<?php

$blogPosts = [
    [
        'title' => 'Team Member 1',
        'content' => 'I am the first team member. I am working alone so I just used 2 UFC fighters as placeholders.',
        'author' => 'Connor Helms',
        'date' => '2024-09-17'
    ],
    [
        'title' => 'Team Member 2',
        'content' => 'Charles Oliveira is the second team member. He is a UFC fighter and a former world champion. He is fighting Michael Chandler in december as the co-main event.',
        'author' => 'Charles Oliveira',
        'date' => '2024-09-17'
    ],
    [
        'title' => 'Team Member 3',
        'content' => 'Khalil Rountree is the third team member. He is a UFC fighter and has a UFC lightheavyweight title fight coming up.',
        'author' => 'Khalil Rountree',
        'date' => '2024-09-17'
    ],
    // You can add more blog posts here
];
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
                <a href="detail.php?post_id=<?= $index ?>" class="list-group-item list-group-item-action">
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
