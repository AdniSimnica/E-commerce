<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Database.php';
require_once 'User.php';

$db = new Database();
$conn = $db->connect();
$user = new User($conn);

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = 'user'; // Default role

    // Check if the user is an admin (you can implement your own logic here)
    if (isset($_POST['is_admin']) && $_POST['is_admin'] == '1') {
        $role = 'admin';
    }

    if ($user->register($username, $password, $email, $role)) {
        echo "Registration successful!";
        header("Location: Login.php"); // Redirect to login page
        exit();
    } else {
        echo "Registration failed!";
    }
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loggedInUser  = $user->login($username, $password);
    if ($loggedInUser ) {
        session_start();
        $_SESSION['user_id'] = $loggedInUser ['id'];
        $_SESSION['username'] = $loggedInUser ['username'];
        $_SESSION['role'] = $loggedInUser ['role']; // Store user role in session
        echo "Login successful! Welcome, " . $loggedInUser ['username'];
        header("Location: home.php"); // Redirect to home page
        exit();
    } else {
        echo "Login failed! Invalid username or password.";
    }
}
?>