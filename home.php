<?php
include 'Database.php';
$db = new Database();
$conn = $db->connect();

// Fetch latest 6 products from the database
$stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 6");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elefanti75</title>
    <link rel="stylesheet" href="Style.css">
    <script src="./script.js" defer></script>
    <style>
        .product-container-1 {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .product-item {
            width: 180px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .product-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

    <img src="assets/web.png" alt="photo" id="foto">

    <section class="ourproducts">
        <h1>Disa nga produktet tona</h1>

        <div class="slider">
            <div class="slider-container" id="slider-container">
                
            </div>
        </div>

        <div class="button-products">
            <a href="Products.php" class="continue">
                <button>Vazhdoni tek faqja e produkteve</button>
            </a>
        </div>

        <div class="product-container-1">
            <?php foreach ($products as $product): ?>
                <a href="Products/product_details.php?id=<?php echo $product['id']; ?>" class="product-item">
                    <img src="assets/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <p><?php echo htmlspecialchars($product['name']); ?></p>
                    <strong>€<?php echo number_format($product['price'], 2); ?></strong>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>
</html>
