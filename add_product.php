<?php
include 'Database.php';
$db = new Database();
$conn = $db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = $_POST['price'] ?? '';
    $category = $_POST['category'] ?? '';
    $gender = $_POST['gender'] ?? 'Unisex';

    
    if (empty($name) || empty($description) || empty($price) || empty($category) || empty($gender)) {
        die("Error: All fields are required.");
    }

    
    if (!is_numeric($price) || $price <= 0) {
        die("Error: Price must be a positive number.");
    }

    
    $image = NULL;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = basename($_FILES['image']['name']);
        $target = "assets/" . $image;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            die("Error uploading image.");
        }
    } else {
        die("Error: Image is required.");
    }

 
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image, category, gender) VALUES (:name, :description, :price, :image, :category, :gender)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':gender', $gender);

    if ($stmt->execute()) {
        header("Location: manage_products.php"); 
        exit();
    } else {
        echo "Error adding product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
    <h2>Add New Product</h2>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required>
        <textarea name="description" placeholder="Product Description" required></textarea>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="Perfume">Perfume</option>
            <option value="Skincare">Skincare</option>
            <option value="Accessories">Accessories</option>
        </select>

        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Unisex">Unisex</option>
        </select>

        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Add Product</button>
    </form>

    <br>
    <a href="manage_products.php">Back to Product Management</a>
</body>
</html>