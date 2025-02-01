<?php
include 'Database.php';
$db = new Database();
$conn = $db->connect();
$stmt = $conn->prepare("SELECT * FROM news ORDER BY created_at DESC");
$stmt->execute();
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link rel="stylesheet" href="Style.css"> 
</head>
<body>

<?php include 'header.php'; ?> 

<div class="news-container">
    <h2>Latest News</h2>
    <?php if (count($news) > 0): ?>
        <?php foreach ($news as $article): ?>
            <div class="news-item">
                <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
                <small>Published on: <?php echo $article['created_at']; ?></small>
                <hr>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No news articles available.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?> 

</body>
</html>