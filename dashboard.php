<?php
session_start();
require 'Database.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}
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

    <h1>Welcome, Admin</h1>
    
    <div class="dashboard-container">
        <ul>
            <li><a href="manage_products.php">Manage Products</a></li>
            <li><a href="manage_news.php">Manage News</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="contact.php">View Contact Messages</a></li>
        </ul>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>