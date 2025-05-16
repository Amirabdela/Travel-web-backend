<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

// Fetch products from database
$products = [];
try {
    $stmt = $pdo->query("SELECT * FROM products WHERE status = 'active'");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Log error and show empty state
    error_log("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Shop | Travel Habesha</title>
    <link rel="stylesheet" href="styles/shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>


    <!-- Hero Section -->
    <section class="shop-hero">
        <div class="hero-content">
            <h1>Explore Ethiopia's Wonders</h1>
            <p>Book unique experiences and travel packages</p>
        </div>
    </section>

    <!-- Shop Filters -->
    <section class="shop-filters">
        <div class="container">
            <form action="shop.php" method="get">
                <div class="filter-group">
                    <label for="destination">Destination:</label>
                    <select name="destination" id="destination">
                        <option value="">All Destinations</option>
                        <option value="simien">Simien Mountains</option>
                        <option value="lalibela">Lalibela</option>
                        <option value="danakil">Danakil Depression</option>
                        <option value="omo">Omo Valley</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="price-range">Price Range:</label>
                    <select name="price-range" id="price-range">
                        <option value="">Any Price</option>
                        <option value="0-500">$0 - $500</option>
                        <option value="500-1000">$500 - $1000</option>
                        <option value="1000-2000">$1000 - $2000</option>
                        <option value="2000+">$2000+</option>
                    </select>
                </div>

                <button type="submit" class="filter-btn">Filter</button>
                <button type="reset" class="reset-btn">Reset</button>
            </form>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="shop-products">
        <div class="container">
            <?php if (empty($products)): ?>
            <div class="no-products">
                <p>No travel packages found. Please check back later.</p>
            </div>
            <?php else: ?>
            <div class="products-grid">
                <?php foreach ($products as $product): ?>
                <div class="product-card" data-id="<?= htmlspecialchars($product['id']) ?>">
                    <div class="product-image">
                        <img src="<?= htmlspecialchars($product['image_url']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>">
                        <?php if ($product['is_featured']): ?>
                        <span class="featured-badge">Featured</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-details">
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <div class="rating" data-rating="<?= round($product['average_rating']) ?>">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="fas fa-star<?= $i <= round($product['average_rating']) ? '' : '-empty' ?>"></i>
                            <?php endfor; ?>
                            <span>(<?= (int)$product['review_count'] ?>)</span>
                        </div>
                        <div class="price">
                            $<?= number_format($product['price_from']) ?> - $<?= number_format($product['price_to']) ?>
                        </div>
                        <div class="product-actions">
                            <a href="product.php?id=<?= $product['id'] ?>" class="btn view-details">View Details</a>
                            <button class="btn add-to-cart" data-id="<?= $product['id'] ?>">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="page-nav disabled"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="page-number active">1</a>
                <a href="#" class="page-number">2</a>
                <a href="#" class="page-number">3</a>
                <a href="#" class="page-nav"><i class="fas fa-chevron-right"></i></a>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="js/shop.js"></script>
</body>

</html>
