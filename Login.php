<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start session at the beginning

require_once 'Database.php';
require_once 'User.php';

$db = new Database();
$conn = $db->connect();
$user = new User($conn);

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']); // Sanitize input
    $password = trim($_POST['password']);

    $loggedInUser = $user->login($username, $password);
    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['username'] = $loggedInUser['username'];
        $_SESSION['role'] = $loggedInUser['role']; // Store user role in session

        // Redirect user based on role
        if ($_SESSION['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: home.php");
        }
        exit();
    } else {
        $error_message = "Login failed! Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="Style.css"/> 
  </head>
  <body>
    <div class="container">
        <br>
        <h1 id="Login">Log in</h1>
        <br>
        <?php if (!empty($error_message)): ?>
            <p style="color: red; text-align: center;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <p id="para">Don't have an account? <a href="login_register.php">Sign up.</a></p>
        <form action="login.php" method="POST"> <!-- Ensure form submits to the same PHP file -->
            <label for="username" class="pass"><b>Email:</b></label>
            <input type="text" name="username" id="username" placeholder="Email" required />
            <br>
            <label for="password" class="pass"><b>Password:</b></label>
            <input type="password" name="password" id="password" placeholder="Password" required />
            <br>
            <button type="submit" id="button" name="login">Log In</button>
        </form>
    </div>
    <script src="Projektneweb/login.js"></script>
  </body>
</html>
