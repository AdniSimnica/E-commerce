<?php
include 'Database.php';
$db = new Database();
$conn = $db->connect();

// Fetch all products ordered by gender
$stmt = $conn->prepare("SELECT * FROM products ORDER BY gender, category, created_at DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group products by gender and category
$genders = ['Male' => [], 'Female' => [], 'Unisex' => []];
foreach ($products as $product) {
    $genders[$product['gender']][] = $product;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link rel="stylesheet" href="Style.css">
    <script>
        function filterCategory(category) {
            document.querySelectorAll('.product-category').forEach(section => {
                if (category === 'All' || section.id === category) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }
    </script>
</head>
<body>

<?php include 'header.php'; ?>

<section class="ourproducts">
    <h1>Our Products</h1>

    <!-- Dropdown to Select Categories -->
    <label for="category-filter">Select Category:</label>
    <select id="category-filter" onchange="filterCategory(this.value)">
        <option value="All">All</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Unisex">Unisex</option>
    </select>

    <?php foreach ($genders as $gender => $products): ?>
        <?php if (!empty($products)): ?>
            <div class="product-category" id="<?php echo $gender; ?>">
                <h2 class="gender-title"><?php echo htmlspecialchars($gender); ?></h2>
                <div class="product-container" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
                    <?php foreach ($products as $product): ?>
                        <a href="Products/product_details.php?id=<?php echo $product['id']; ?>" class="product-item" style="width: 200px; text-align: center; display: flex; flex-direction: column; align-items: center;">
                            <div class="product-image" style="width: 180px; height: 200px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                <img src="assets/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                            </div>
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p><strong>Price: €<?php echo number_format($product['price'], 2); ?></strong></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</section>

<?php include 'footer.php'; ?>

</body>
</html>
