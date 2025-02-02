<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: home.php");
    exit();
}

include 'Database.php';
$db = new Database();
$conn = $db->connect();

// Handle deleting products
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: manage_products.php");
    exit();
}

// Fetch all products
$stmt = $conn->prepare("SELECT products.id, products.name, products.price, products.category, products.gender, users.name AS author, products.created_at 
                        FROM products 
                        LEFT JOIN users ON products.created_by = users.id 
                        ORDER BY products.created_at DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
</head>
<body>
    <h2>Manage Products</h2>
    <a href="add_product.php">Add New Product</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Gender</th>
            <th>Author</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td>€<?php echo number_format($product['price'], 2); ?></td>
                <td><?php echo htmlspecialchars($product['category']); ?></td>
                <td><?php echo htmlspecialchars($product['gender']); ?></td>
                <td><?php echo htmlspecialchars($product['author'] ?? 'Unknown'); ?></td>
                <td><?php echo $product['created_at']; ?></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a> | 
                    <a href="manage_products.php?delete=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
