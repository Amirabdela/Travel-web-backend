<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';
// Get all rental cars
$stmt = $pdo->query("SELECT * FROM rental_cars ORDER BY price_per_day ASC");
$cars = $stmt->fetchAll();

// Get unique car types for filter
$stmt = $pdo->query("SELECT DISTINCT type FROM rental_cars");
$types = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Cars - Travel Habesha</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles/cars.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<!-- Header Section -->
<header>
    <!-- Top Bar -->
    <div class="top-bar">
        <!-- Share Icon -->
        <div class="con">
            <div class="socials">
                <i class="fa-solid fa-earth-africa"></i><span class="lang">LANGUAGESENES</span>
                <i class="fa-solid fa-share-nodes"></i><span class="lang">OUR SOCIALS</span>
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-pinterest-p"></i>
            </div>
            <div class="right-links">
                <a class="fav" href="#"><i class="fa-regular fa-star"></i>TOUR PACKAGES</a>
                <a class="contact" href="#"><i class="fa-solid fa-location-dot"></i>CONTACT US</a>
            </div>
        </div>

    </div>

    <!-- Navigation -->
    <div class="nav-bar">
        <nav>

            <div class="logo">
                <strong>TRAVEL HABESHA.</strong>
                <i class="small-block fas fa-bars menu-icon"></i>
            </div>
            <ul>
                <li class="nav-links"><a href="/index.php">Home</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/packages.php">Packages</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/shop.php">Shop</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/rentalcar.php">Travel Cars</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/about.php">About Us</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/hotels.php">Hotels</a></li>
                <li class="book-now"><a href="../Travel-web-backend/book.php">Book Now</a></li>
            </ul>
        </nav>
    </div>
</header>
<!-- Hero Section -->
<section class="tour-hero">
    <h2 class="shop">tour cars</h2>
</section>
<!-- Cards Section -->
<section class="car-cards">
    <div class="car-card">
        <a href="https://www.ethiopiacarrentals.com/shop/">
            <img src="assets/car1.jpg" alt="frendship addis ababa">
            <div class="car-hover">
                <h1>Range Rover</h1>
                <div class="star-rating">
                    <span class="star" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                </div>

                <div class="filter-group">
                    <label for="price-range">Price Range</label>
                    <select id="price-range">
                        <option value="0-1000">Any Price</option>
                        <option value="0-50">Under $50/day</option>
                        <option value="50-100">$50 - $100/day</option>
                        <option value="100-200">$100 - $200/day</option>
                        <option value="200-500">$200+/day</option>
                    </select>
                </div>

                <button type="button" id="search-cars" class="btn-primary">Search</button>
                </form>
            </div>
</section>

<!-- Cars Grid -->
<section class="rental-cars-section">
    <div class="">
        <div class="cars-grid" id="cars-container">
            <?php foreach ($cars as $car): ?>
            <div class="car-card" data-type="<?php echo $car['type']; ?>"
                data-price="<?php echo $car['price_per_day']; ?>">
                <img src="<?php echo $car['image_path']; ?>" alt="<?php echo $car['model']; ?>">
                <div class="car-info">
                    <h3><?php echo $car['model']; ?></h3>
                    <div class="car-type">
                        <i class="fas fa-car"></i> <?php echo ucfirst($car['type']); ?>
                    </div>
                    <div class="car-rating">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                        <i class="fas fa-star <?php echo $i < $car['rating'] ? 'active' : ''; ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="car-features">
                        <?php 
                                $features = $car['features'] ? explode(',', $car['features']) : [];
                                foreach ($features as $feature): ?>
                        <span><?php echo trim($feature); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <div class="car-footer">
                        <span class="price">$<?php echo number_format($car['price_per_day'], 2); ?>/day</span>
                        <a href="car.php?id=<?php echo $car['id']; ?>" class="btn-book">Book Now</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include 'footer.php'; ?>

<script>
// Filter cars based on selections
document.getElementById('search-cars').addEventListener('click', function() {
    const type = document.getElementById('car-type').value;
    const priceRange = document.getElementById('price-range').value;
    const [minPrice, maxPrice] = priceRange.split('-').map(Number);

    const cars = document.querySelectorAll('.car-card');

    cars.forEach(car => {
        const carType = car.dataset.type;
        const carPrice = parseFloat(car.dataset.price);

        const show =
            (type === '' || carType === type) &&
            (priceRange === '0-1000' || (carPrice >= minPrice && carPrice <= maxPrice));

        car.style.display = show ? 'block' : 'none';
    });
});
</script>
</body>

</html>