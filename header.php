<?php
session_start(); 
?>

<header class="header">
    <a href="home.php" class="logo">
        <img src="assets/logoo.png" alt="Logo" id="logoja">
    </a>
    <nav class="navbar">
        <a href="home.php">Home</a>
        <a href="products.php">Products</a> <!-- Changed .html to .php -->
        <div class="category">
            <a href="Categories.php">Categories</a> <!-- Changed .html to .php -->
            <div class="dropdown">
                <a href="male-products.php">Male</a> <!-- Changed .html to .php -->
                <a href="female-products.php">Female</a> <!-- Changed .html to .php -->
            </div>
        </div>
        <a href="About-us.php">About Us</a> <!-- Changed .html to .php -->
    </nav>

    
    <?php if (isset($_SESSION["user_id"])): ?>
        <p style="margin-right: 10px;">Welcome, <?php echo $_SESSION["name"]; ?>! 
            <a href="logout.php" style="color: red;">Logout</a>
        </p>
    <?php else: ?>
        <a href="Login.php">
            <button type="button" id="login" style="margin-right: 0px; margin-top: 15px;">Log in</button>
        </a>
    <?php endif; ?>
</header>