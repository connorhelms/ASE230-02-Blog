<?php
// Include the blog posts array
include 'index.php';

// Function to get post by ID
function getPostById($id) {
    global $blogPosts;
    if (isset($blogPosts[$id])) {
        return $blogPosts[$id];
    }
    return null;
}

// Get the post ID from the URL
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : -1;

// Get the post
$post = getPostById($post_id);

// Redirect to index if post doesn't exist
if (!$post) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4"><?= htmlspecialchars($post['title']) ?></h1>
        <p class="text-muted">By <?= htmlspecialchars($post['author']) ?> on <?= htmlspecialchars($post['date']) ?></p>
        <div class="mt-4">
            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        </div>
        <a href="index.php" class="btn btn-primary mt-3">Back to Posts</a>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>