<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

include 'Database.php';
$db = new Database();
$conn = $db->connect();

if (!isset($_GET['id'])) {
    header("Location: manage_news.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM news WHERE id = :id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE news SET title = :title, content = :content WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':id', $id);
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
    <title>Edit News</title>
</head>
<body>
    <h2>Edit News Article</h2>
    <form method="POST">
        <input type="text" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
        <textarea name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>
        <button type="submit">Update News</button>
    </form>
    <br>
    <a href="manage_news.php">Back to News Management</a>
</body>
</html>
