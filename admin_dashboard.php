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
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .nav-container {
            margin-top: 20px;
        }
        .nav-btn {
            display: block;
            width: 250px;
            padding: 10px;
            margin: 10px auto;
            text-decoration: none;
            color: white;
            background-color:rgb(73, 73, 73);
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
       
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <h2>Admin Dashboard</h2>

    <div class="nav-container">
        <a href="manage_products.php" class="nav-btn">Manage Products</a>
        <a href="manage_news.php" class="nav-btn">Manage News</a>
        <a href="manage_users.php" class="nav-btn">Manage Users</a>
        <a href="manage_messages.php" class="nav-btn">Manage Messages</a>
    </div>
    
    <br>
    <a href="logout.php" class="nav-btn" style="background-color: red;">Logout</a>
</body>
</html>

