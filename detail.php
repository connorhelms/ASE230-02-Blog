<?php

$jsonData = file_get_contents('posts.json');
$blogPosts = json_decode($jsonData, true);

if ($blogPosts === null) {
    error_log("Error: Unable to parse blog posts JSON.");
    die("Error: Unable to parse blog posts. Please check the error log.");
}

$post_id = isset($_GET['post_id']) ? filter_var($_GET['post_id'], FILTER_VALIDATE_INT) : null;

if ($post_id === false || !isset($blogPosts[$post_id])) {
    header('Location: index.php');
    exit();
}

$post = $blogPosts[$post_id];

function read_visitors_csv($filename) {
    $visitors = [];
    if (!file_exists($filename)) {
        error_log("Visitors file does not exist: $filename");
        return $visitors;
    }
    if (($handle = fopen($filename, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            if (count($data) == 2) {
                $visitors[$data[0]] = (int)$data[1];
            } else {
                error_log("Invalid CSV data in $filename");
            }
        }
        fclose($handle);
    } else {
        error_log("Failed to open file for reading: $filename");
    }
    return $visitors;
}

function write_visitors_csv($filename, $visitors) {
    if (($handle = fopen($filename, 'w')) !== false) {
        foreach ($visitors as $postId => $count) {
            if (fputcsv($handle, [$postId, $count]) === false) {
                error_log("Failed to write CSV data for post ID: $postId");
            }
        }
        fclose($handle);
    } else {
        error_log("Failed to open file for writing: $filename");
    }
}

$visitorsFile = 'visitors.csv';
$visitors = read_visitors_csv($visitorsFile);

if (isset($visitors[$post_id])) {
    $visitors[$post_id]++; 
} else {
    $visitors[$post_id] = 1; 
}

write_visitors_csv($visitorsFile, $visitors);

$visitCount = $visitors[$post_id];

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

        <p><strong>Visitor count:</strong> <?= $visitCount ?></p>
        <a href="index.php" class="btn btn-primary mt-3">Back to Posts</a>

    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>