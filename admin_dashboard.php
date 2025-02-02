<?php
include 'Database.php';
$db = new Database();
$conn = $db->connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
<?php include 'header.php'; ?>
    <h2>Admin Dashboard</h2>
    
    
    <br><br>

    <nav>
        <ul>
            <li><a href="manage_products.php">Manage Products</a></li>
            <li><a href="manage_news.php">Manage News</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_messages.php">Manage Messages</a></li>
        </ul>
    </nav>
    
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>
