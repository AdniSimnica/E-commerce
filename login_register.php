<?php
session_start(); 

include 'Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $role = isset($_POST['role']) && $_POST['role'] === 'admin' ? 'admin' : 'user';

    $db = new Database();
    $conn = $db->connect();

    
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    if ($stmt->rowCount() > 0) {
        echo "Error: Email already exists!";
        exit();
    }

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);

    if ($stmt->execute()) {
        
        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;

        
        if ($role == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: home.php");
        }
        exit();
    } else {
        echo "Registration failed. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="login_register.php">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit">Register</button>
</form>
    
</body>
</html>

