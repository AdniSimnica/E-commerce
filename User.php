<?php
class User {
    private $conn;
    private $table = 'users'; // Your users table name

    public function __construct($db) {
        $this->conn = $db;
    }

    // Check if email already exists
    private function userExists($email) {
        $query = "SELECT id FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }

    // Register a new user with a default role
    public function register($name, $email, $password, $role = 'user') {
        if ($this->userExists($email)) {
            return "Email already exists!";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . $this->table . " (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $role);
        
        return $stmt->execute() ? true : "Registration failed!";
    }

    // Login user
    public function login($email, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user data if login is successful
        }
        return false; // Return false if login fails
    }
}
?>