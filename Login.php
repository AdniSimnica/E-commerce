<?php
session_start();
include 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? ''; 
    $password = $_POST['password'] ?? '';

    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $password == $user['password']) { 
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name']; 
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: home.php");
        }
        exit();
    } else {
        echo "Invalid username or password!";
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
        <p id="para">Don't have an account? <a href="Signin.php">Sign up.</a></p>
        <form action="login.php" method="POST"> 
            <label for="email" class="pass"><b>Email:</b></label>
            <input type="text" name="email" id="email" placeholder="Email" required />
            <br>
            <label for="password" class="pass"><b>Password:</b></label>
            <input type="password" name="password" id="password" placeholder="Password" required />
            <br>
            <button type="submit" id="button" name="login">Log In</button>
        </form>
    </div>
    <script src="login.js"></script>
  </body>
</html>

