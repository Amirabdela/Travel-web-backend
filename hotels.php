<?php
// hotels.php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

// Get hotels from database
$stmt = $pdo->query("SELECT * FROM hotels ORDER BY name");
$hotels = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels - Travel Habesha</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/destination.css">

=======
    <link rel="stylesheet" href="index.css">
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
    <link rel="stylesheet" href="styles/hotels.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->


    <!-- Hero Section -->
<<<<<<< HEAD
    <section class="hotels-hero best-hotel-hero">
=======
    <section class="hotels-hero">
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
        <h1>Hotels & Accommodations</h1>
        <p>Find the perfect place to stay for your trip</p>
    </section>

    <!-- Search Filters -->
    <section class="hotels-filters">
        <div class="">
            <form id="hotel-search">
                <div class="filter-group">
                    <label for="location">Location</label>
                    <select id="location">
                        <option value="">All Locations</option>
                        <?php foreach ($locations as $loc): ?>
                        <option value="<?php echo $loc; ?>"><?php echo $loc; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="rating">Minimum Rating</label>
                    <select id="rating">
                        <option value="0">Any Rating</option>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="price-range">Price Range</label>
                    <select id="price-range">
                        <option value="0-1000">Any Price</option>
                        <option value="0-50">Under $50</option>
                        <option value="50-100">$50 - $100</option>
                        <option value="100-200">$100 - $200</option>
                        <option value="200-500">$200 - $500</option>
                        <option value="500-1000">$500+</option>
                    </select>
                </div>

                <button type="button" id="search-hotels" class="btn-primary">Search</button>
            </form>
        </div>
    </section>

    <!-- Hotels Grid -->
    <section class="hotels-grid-section">
        <div class="">
            <div class="hotels-grid" id="hotels-container">
                <?php foreach ($hotels as $hotel): ?>
                <div class="hotel-card" data-location="<?php echo $hotel['location']; ?>"
                    data-rating="<?php echo $hotel['rating']; ?>" data-price="<?php echo $hotel['price_per_night']; ?>">
                    <img src="<?php echo $hotel['image_path']; ?>" alt="<?php echo $hotel['name']; ?>">
                    <div class="hotel-info">
                        <h3><?php echo $hotel['name']; ?></h3>
                        <div class="hotel-location">
                            <i class="fas fa-map-marker-alt"></i> <?php echo $hotel['location']; ?>
                        </div>
                        <div class="hotel-rating">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star <?php echo $i < $hotel['rating'] ? 'active' : ''; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p><?php echo substr($hotel['description'], 0, 100) . '...'; ?></p>
                        <div class="hotel-footer">
                            <span class="price">$<?php echo number_format($hotel['price_per_night'], 2); ?>/night</span>
                            <a href="hotel.php?id=<?php echo $hotel['id']; ?>" class="btn-book">View Details</a>
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
    // Filter hotels based on selections
    document.getElementById('search-hotels').addEventListener('click', function() {
        const location = document.getElementById('location').value;
        const minRating = parseInt(document.getElementById('rating').value);
        const priceRange = document.getElementById('price-range').value;
        const [minPrice, maxPrice] = priceRange.split('-').map(Number);

        const hotels = document.querySelectorAll('.hotel-card');

        hotels.forEach(hotel => {
            const hotelLocation = hotel.dataset.location;
            const hotelRating = parseInt(hotel.dataset.rating);
            const hotelPrice = parseFloat(hotel.dataset.price);

            const show =
                (location === '' || hotelLocation.includes(location)) &&
                hotelRating >= minRating &&
                (priceRange === '0-1000' || (hotelPrice >= minPrice && hotelPrice <= maxPrice));

            hotel.style.display = show ? 'block' : 'none';
        });
    });
    </script>
</body>

</html>