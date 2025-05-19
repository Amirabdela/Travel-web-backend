<?php
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</body>

</html>