<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

include 'Database.php';
$db = new Database();
$conn = $db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $created_by = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO news (title, content, created_by) VALUES (:title, :content, :created_by)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':created_by', $created_by);
    $stmt->execute();

    header("Location: manage_news.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
</head>
<body>
    <h2>Add News Article</h2>
    <form method="POST" action="add_news.php">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <button type="submit">Add News</button>
    </form>
    <br>
    <a href="manage_news.php">Back to News Management</a>
</body>
</html>
