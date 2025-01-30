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
    <header class="header">
        <a href="home.php" class="logo">
            <img src="assets/logoo.png" alt="Logo" id="logoja">
        </a>
        <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="products.html">Products</a>
            <div class="category">
                <a href="Categories.html">Categories</a>
                <div class="dropdown">
                    <a href="male-products.html">Male</a>
                    <a href="female-products.html">Female</a>
                </div>
            </div>
            <a href="About-us.html">About Us</a>
            <div class="dropdown">
                <button class="dropbtn">Admin Options</button>
                <div class="dropdown-content">
                    <a href="admin_dashboard.php">Admin Dashboard</a>
                    <a href="manage_users.php">Manage Users</a>
                    <a href="view_reports.php">View Reports</a>
                </div>
            </div>
        </nav>
        <a href="logout.php">
            <button type="button" id="login" style="margin-right: 0px; margin-top: 15px;">Log out</button>
        </a>
    </header>

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