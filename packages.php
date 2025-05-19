<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

// Get featured destinations
$stmt = $pdo->query("SELECT * FROM destinations ORDER BY RANDOM() LIMIT 6");
$destinations = $stmt->fetchAll();

// Get featured packages
$stmt = $pdo->query("
    SELECT p.*, d.name as destination_name 
    FROM packages p
    JOIN destinations d ON p.destination_id = d.id
    ORDER BY RANDOM() LIMIT 4
");
$packages = $stmt->fetchAll();

// Get special offers
$stmt = $pdo->query("
    SELECT p.*, d.name as destination_name 
    FROM packages p
    JOIN destinations d ON p.destination_id = d.id
    WHERE p.price < (SELECT AVG(price) FROM packages)
    ORDER BY RANDOM() LIMIT 2
");
$offers = $stmt->fetchAll();

// Get hero background
$stmt = $pdo->query("SELECT * FROM destinations ORDER BY RANDOM() LIMIT 1");
$hero_destination = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Habesha - Explore Ethiopia</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Poppins:wght@500;600;700&family=Sono:wght@400;500&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>


    <main>
        <!-- Hero Section -->
        <section class="hero"
            style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?= $hero_destination['image_path'] ?>');">
            <div class="container">
                <div class="hero-content">
                    <h1>Discover <?= $hero_destination['name'] ?></h1>
                    <p class="subtitle">Explore the beauty of Ethiopia with our exclusive travel packages</p>
                    <div class="hero-actions">
                        <a href="#packages" class="btn btn-primary">View Packages</a>
                        <a href="#destinations" class="btn btn-outline">Explore Destinations</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Destinations -->
        <section id="destinations" class="section">
            <div class="container">
                <h2 class="section-title">Our Featured Destinations</h2>
                <div class="grid destinations-grid">
                    <?php foreach ($destinations as $destination): ?>
                    <div class="card destination-card">
                        <img src="<?= $destination['image_path'] ?>" alt="<?= $destination['name'] ?>" class="card-img">
                        <div class="card-body">
                            <h3 class="card-title"><?= $destination['name'] ?></h3>
                            <p class="card-text"><?= substr($destination['description'], 0, 100) ?>...</p>
                            <a href="destination.php?id=<?= $destination['id'] ?>"
                                class="btn btn-sm btn-primary">Explore</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Popular Packages -->
        <section id="packages" class="section bg-light">
            <div class="container">
                <h2 class="section-title">Popular Travel Packages</h2>
                <div class="grid packages-grid">
                    <?php foreach ($packages as $package): ?>
                    <div class="card package-card">
                        <img src="<?= $package['image_path'] ?>" alt="<?= $package['title'] ?>" class="card-img">
                        <div class="card-body">
                            <div class="card-meta">
                                <span><i class="fas fa-map-marker-alt"></i> <?= $package['destination_name'] ?></span>
                                <span><i class="fas fa-clock"></i> <?= $package['duration_days'] ?> days</span>
                            </div>
                            <h3 class="card-title"><?= $package['title'] ?></h3>
                            <p class="card-text"><?= substr($package['description'], 0, 150) ?>...</p>
                            <div class="card-footer">
                                <span class="price">$<?= number_format($package['price'], 2) ?></span>
                                <a href="package.php?id=<?= $package['id'] ?>"
                                    class="btn btn-sm btn-outline">Details</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Special Offers -->
        <section class="section">
            <div class="container">
                <h2 class="section-title">Special Offers</h2>
                <div class="grid offers-grid">
                    <?php foreach ($offers as $offer): ?>
                    <div class="card offer-card">
                        <div class="card-badge">Save 50%</div>
                        <img src="<?= $offer['image_path'] ?>" alt="<?= $offer['title'] ?>" class="card-img">
                        <div class="card-body">
                            <div class="card-meta">
                                <span><i class="fas fa-map-marker-alt"></i> <?= $offer['destination_name'] ?></span>
                                <span><i class="fas fa-clock"></i> <?= $offer['duration_days'] ?> days</span>
                            </div>
                            <h3 class="card-title"><?= $offer['title'] ?></h3>
                            <div class="price-container">
                                <span class="old-price">$<?= number_format($offer['price'] * 2, 2) ?></span>
                                <span class="new-price">$<?= number_format($offer['price'], 2) ?></span>
                            </div>
                            <a href="book.php?package=<?= $offer['id'] ?>" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section">
            <div class="container">
                <div class="grid stats-grid">
                    <div class="stat-item">
                        <span class="stat-number">30+</span>
                        <span class="stat-label">Years Experience</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Happy Travelers</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Destinations</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Support</span>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="js/main.js"></script>
</body>

</html>