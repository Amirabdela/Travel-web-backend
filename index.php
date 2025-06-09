<?php
<<<<<<< HEAD
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';

if (!isset($_GET['id'])) {
    header("Location: packages.php");
    exit();
}

$destination_id = $_GET['id'];

// Get destination details
$stmt = $pdo->prepare("SELECT * FROM destinations WHERE id = ?");
$stmt->execute([$destination_id]);
$destination = $stmt->fetch();

$stmt = $pdo->prepare("SELECT * FROM destination_images WHERE destination_id = ?");
$stmt->execute([$destination_id]);
$destination_images = $stmt->fetchAll();

if (!$destination) {
    header("Location: packages.php");
    exit();
}

// Get packages for this destination
$stmt = $pdo->prepare("
    SELECT * FROM packages 
    WHERE destination_id = ?
    ORDER BY price ASC
");
$stmt->execute([$destination_id]);
$packages = $stmt->fetchAll();

// Get hotels in this destination
$stmt = $pdo->prepare("
    SELECT * FROM hotels 
    WHERE location LIKE ?
    ORDER BY rating DESC
    LIMIT 3
");
$stmt->execute(['%' . $destination['location'] . '%']);
$hotels = $stmt->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>
=======
// hotels.php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

// Get hotels from database
$stmt = $pdo->query("SELECT * FROM hotels ORDER BY name");
$hotels = $stmt->fetchAll();
?>

>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title><?= $destination['name'] ?> - Travel Habesha</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Poppins:wght@500;600;700&family=Sono:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="styles/destination.css">
</head>

<body>


    <main>
        <!-- Destination Hero -->
        <section class="destination-hero" style="background-image: url('<?= $destination['image_path'] ?>');">
            <div class="hero-content">
                <div class="container">
                    <h1><?= $destination['name'] ?></h1>
                    <p><?= $destination['location'] ?></p>
                </div>
            </div>
        </section>

        <!-- Destination Content -->
        <section class="destination-content">
            <div class="container">
                <div class="destination-about">
                    <h2>About <?= $destination['name'] ?></h2>
                    <p><?= $destination['description'] ?></p>

                    <div class="features-grid">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <h3>Culture</h3>
                            <p>Experience the rich cultural heritage with traditional ceremonies and local customs.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-mountain"></i>
                            </div>
                            <h3>Landscape</h3>
                            <p>Explore breathtaking landscapes from mountains to valleys with unique geological
                                formations.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <h3>Cuisine</h3>
                            <p>Taste authentic local dishes made with traditional recipes passed down through
                                generations.</p>
                        </div>
                    </div>
                </div>

                <!-- Gallery -->
                <div class="destination-gallery">
                    <h2>Gallery</h2>
                    <?php if (!empty($destination_images)): ?>
                    <div class="gallery-grid">
                        <?php foreach ($destination_images as $image): ?>
                        <div class="gallery-item">
                            <img src="<?= htmlspecialchars($image['image_path']) ?>"
                                alt="<?= !empty($image['caption']) ? htmlspecialchars($image['caption']) : 'Destination image' ?>"
                                class="gallery-image">
                            <?php if (!empty($image['caption'])): ?>
                            <div class="gallery-caption"><?= htmlspecialchars($image['caption']) ?></div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <p>No images available for this destination yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Packages Section -->
        <?php if (!empty($packages)): ?>
        <section class="destination-packages">
            <div class="container">
                <h2 class="section-title">Packages in <?= $destination['name'] ?></h2>
                <p class="section-subtitle">Choose from our carefully curated travel packages</p>

                <div class="packages-grid">
                    <?php foreach ($packages as $package): ?>
                    <div class="card package-card">
                        <img src="<?= $package['image_path'] ?>" alt="<?= $package['title'] ?>" class="card-img">
                        <div class="card-body">
                            <h3 class="card-title"><?= $package['title'] ?></h3>
                            <div class="card-meta">
                                <span><i class="fas fa-clock"></i> <?= $package['duration_days'] ?> days</span>
                                <span><i class="fas fa-hiking"></i> <?= $package['difficulty'] ?></span>
                            </div>
                            <p class="card-text"><?= substr($package['description'], 0, 100) ?>...</p>
                            <div class="card-footer">
                                <span class="price">$<?= number_format($package['price'], 2) ?></span>
                                <a href="package.php?id=<?= $package['id'] ?>"
                                    class="btn btn-sm btn-primary">Details</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Hotels Section -->
        <?php if (!empty($hotels)): ?>
        <section class="destination-hotels">
            <div class="container">
                <h2 class="section-title">Recommended Hotels</h2>
                <p class="section-subtitle">Comfortable accommodations for your stay in <?= $destination['name'] ?></p>

                <div class="hotels-grid">
                    <?php foreach ($hotels as $hotel): ?>
                    <div class="card hotel-card">
                        <img src="<?= $hotel['image_path'] ?>" alt="<?= $hotel['name'] ?>" class="card-img">
                        <div class="card-body">
                            <h3 class="card-title"><?= $hotel['name'] ?></h3>
                            <div class="hotel-rating">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                <i class="fas fa-star <?= $i < $hotel['rating'] ? 'active' : '' ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="card-text"><?= substr($hotel['description'], 0, 100) ?>...</p>
                            <div class="card-footer">
                                <span class="price">From
                                    $<?= number_format($hotel['price_per_night'], 2) ?>/night</span>
                                <a href="hotel.php?id=<?= $hotel['id'] ?>" class="btn btn-sm btn-outline">View</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </main>

    <?php include 'includes/footer.php'; ?>
=======
    <title>Hotels - Travel Habesha</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles/hotels.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->


    <!-- Hero Section -->
    <section class="hotels-hero">
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
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
</body>

</html>