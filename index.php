<?php
// index.php
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

// Get one random destination for hero background
$stmt = $pdo->query("SELECT * FROM destinations ORDER BY RANDOM() LIMIT 1");
$hero_destination = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Travel Habesha</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="js/main.js" defer></script>
</head>

<body>


    <!-- Hero Section with Special Offer -->
    <section class="hero"
        style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo $hero_destination['image_path']; ?>');">
        <div class="hero-content">
            <h1 class="animate__animated animate__fadeInDown">Discover <?php echo $hero_destination['name']; ?></h1>
            <p class="animate__animated animate__fadeInUp">Explore the beauty of Ethiopia with our exclusive travel
                packages</p>
            <div class="hero-buttons animate__animated animate__fadeInUp">
                <a href="#packages" class="btn-primary">View Packages</a>
                <a href="#destinations" class="btn-secondary">Explore Destinations</a>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="home" id="destinations">
        <h2 class="section-title">Our Featured Destinations</h2>
        <div class="destinations-grid">
            <?php foreach ($destinations as $destination): ?>
            <div class="destination-card">
                <img src="<?php echo $destination['image_path']; ?>" alt="<?php echo $destination['name']; ?>">
                <div class="destination-info">
                    <h3><?php echo $destination['name']; ?></h3>
                    <p><?php echo substr($destination['description'], 0, 100) . '...'; ?></p>
                    <a href="destination.php?id=<?php echo $destination['id']; ?>" class="btn-explore">Explore</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Popular Packages -->
    <section class="packages-section" id="packages">
        <h2 class="section-title">Popular Travel Packages</h2>
        <div class="packages-grid">
            <?php foreach ($packages as $package): ?>
            <div class="package-card">
                <img src="<?php echo $package['image_path']; ?>" alt="<?php echo $package['title']; ?>">
                <div class="package-info">
                    <h3><?php echo $package['title']; ?></h3>
                    <div class="package-meta">
                        <span><i class="fas fa-map-marker-alt"></i> <?php echo $package['destination_name']; ?></span>
                        <span><i class="fas fa-clock"></i> <?php echo $package['duration_days']; ?> days</span>
                        <span><i class="fas fa-tag"></i> <?php echo $package['type']; ?></span>
                    </div>
                    <p><?php echo substr($package['description'], 0, 150) . '...'; ?></p>
                    <div class="package-footer">
                        <span class="price">$<?php echo number_format($package['price'], 2); ?></span>
                        <a href="package.php?id=<?php echo $package['id']; ?>" class="btn-details">Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Special Offers -->
    <section class="offers-section">
        <h2 class="section-title">Special Offers</h2>
        <div class="offers-grid">
            <?php foreach ($offers as $offer): ?>
            <div class="offer-card">
                <div class="offer-badge">-50%</div>
                <img src="<?php echo $offer['image_path']; ?>" alt="<?php echo $offer['title']; ?>">
                <div class="offer-info">
                    <h3><?php echo $offer['title']; ?></h3>
                    <div class="offer-meta">
                        <span><i class="fas fa-map-marker-alt"></i> <?php echo $offer['destination_name']; ?></span>
                        <span><i class="fas fa-clock"></i> <?php echo $offer['duration_days']; ?> days</span>
                    </div>
                    <div class="price-container">
                        <span class="old-price">$<?php echo number_format($offer['price'] * 2, 2); ?></span>
                        <span class="new-price">$<?php echo number_format($offer['price'], 2); ?></span>
                    </div>
                    <a href="book.php?package=<?php echo $offer['id']; ?>" class="btn-book">Book Now</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stat-item">
                <span class="stat-number">30</span>
                <span class="stat-label">years of experience</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">78</span>
                <span class="stat-label">satisfied customers</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">8</span>
                <span class="stat-label">type of insurance</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">17</span>
                <span class="stat-label">travel destinations</span>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>