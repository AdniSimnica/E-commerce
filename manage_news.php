<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php"); 
    exit();
}

include 'Database.php';
$db = new Database();
$conn = $db->connect();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM news WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: manage_news.php");
    exit();
}


$stmt = $conn->prepare("SELECT news.*, users.name AS author FROM news JOIN users ON news.created_by = users.id ORDER BY created_at DESC");
$stmt->execute();
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News</title>
    
</head>
<body>
    <h2>Manage News</h2>
    <a href="add_news.php">Add New Article</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($news as $article): ?>
            <tr>
                <td><?php echo $article['id']; ?></td>
                <td><?php echo htmlspecialchars($article['title']); ?></td>
                <td><?php echo htmlspecialchars($article['author']); ?></td>
                <td><?php echo $article['created_at']; ?></td>
                <td>
                    <a href="edit_news.php?id=<?php echo $article['id']; ?>">Edit</a> | 
                    <a href="manage_news.php?delete=<?php echo $article['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
