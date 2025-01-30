<?php
class User {
    private $conn;
    private $table = 'users'; // Your users table name

    public function __construct($db) {
        $this->conn = $db;
    }

    // Register a new user with a default role
    public function register($username, $password, $email, $role = 'user') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . $this->table . " (username, password, email, role) VALUES (:username, :password, :email, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    // Login user
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data if login is successful
        }
        return false; // Return false if login fails
    }
}
?>