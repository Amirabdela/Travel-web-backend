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
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/cars.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>


    <!-- Hero Section -->
    <section class="rental-hero">
        <h1>Rental Cars</h1>
        <p>Find the perfect vehicle for your journey</p>
    </section>

    <!-- Search Filters -->
    <section class="rental-filters">
        <div class="">
            <form id="car-search">
                <div class="filter-group">
                    <label for="car-type">Car Type</label>
                    <select id="car-type">
                        <option value="">All Types</option>
                        <?php foreach ($types as $type): ?>
                        <option value="<?php echo $type; ?>"><?php echo ucfirst($type); ?></option>
                        <?php endforeach; ?>
                    </select>
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