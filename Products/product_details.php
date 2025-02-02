<?php
include '../Database.php';
$db = new Database();
$conn = $db->connect();

if (!isset($_GET['id'])) {
    die("Product not found.");
}

$product_id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
$stmt->bindParam(':id', $product_id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elefanti75 - <?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>

<?php include '../header.php'; ?>

    <div class="product-details-container">
        <div class="product-image-p2">
        <img src="../assets/<?php echo htmlspecialchars($product['image']); ?>" 
     alt="<?php echo htmlspecialchars($product['name']); ?>" 
     style="width: 300px; height: 500px; object-fit: cover; border-radius: 10px;">

        </div>
        <div class="product-info">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <br>
            
            <p><strong>Cmimi:</strong> <?php echo number_format($product['price'], 2); ?> €</p>
            <p><strong>I disponueshëm:</strong> Ne Stock</p>
            <br>
            <button class="buy-button">Shto ne shporte</button>
            <button class="buy-button">Blini tani</button>
            <br><br>
            
            <h3>Rreth këtij artikulli</h3>
            <br>
            <ul>
                <li><strong>Lloji:</strong> <?php echo htmlspecialchars($product['category']); ?></li>
                <br>
                <li><strong>Përshkrimi:</strong> <?php echo nl2br(htmlspecialchars($product['description'])); ?></li>
                <br>
                <li><strong>Gjinia:</strong> <?php echo htmlspecialchars($product['gender']); ?></li>
            </ul>
        </div>
    </div>

<?php include '../footer.php'; ?>

</body>
</html>