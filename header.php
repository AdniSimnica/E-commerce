<?php
session_start();
?>

<header class="header">
    <a href="/E-commerce/home.php" class="logo">
        <img src="/E-commerce/assets/logoo.png" alt="Logo" id="logoja">
    </a>
    <nav class="navbar">
        <a href="/E-commerce/home.php">Home</a>
        <a href="/E-commerce/Products.php">Products</a>
        <a href="/E-commerce/news.php">News</a>
        <a href="/E-commerce/About-us.php">About Us</a>
        
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="/E-commerce/admin_dashboard.php">Dashboard</a>
        <?php endif; ?>
    </nav>

    <?php if (isset($_SESSION["user_id"])): ?>
        <div class="user-actions" style="display: flex; align-items: center; gap: 10px; margin-right: 10px;">
            <span style="font-weight: bold;"> <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : "Guest"; ?> </span>
            <a href="/E-commerce/logout.php" style="background-color: blue; color: white; padding: 8px 12px; border-radius: 5px; text-decoration: none;">Logout</a>
        </div>
    <?php else: ?>
        <a href="/E-commerce/Login.php">
            <button type="button" id="login" style="margin-right: 0px; margin-top: 15px;">Log in</button>
        </a>
    <?php endif; ?>
</header>
