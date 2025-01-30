<!-- admin_dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php"); // Redirect to home if not admin
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="/Style.css"> <!-- Link to your existing CSS file -->
</head>
<body>
<?php include 'header.php'; ?>

    <h1>Welcome, Admin <?php echo $_SESSION['username']; ?></h1>
    <h2>Admin Options</h2>
    <ul>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="view_reports.php">View Reports</a></li>
        <!-- Add more admin options as needed -->
    </ul>
    <a href="logout.php">Logout</a>
</body>
</html>