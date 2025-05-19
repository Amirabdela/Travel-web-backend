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
    <title><?php echo $destination['name']; ?> - Travel Habesha</title>
    <link rel="stylesheet" href="styles/destination.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/index.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->


    <!-- Destination Hero Section -->
    <section class="destination-hero" style="background-image: url('<?php echo $destination['image_path']; ?>');">
        <div class="hero-overlay">
            <h1><?php echo $destination['name']; ?></h1>
            <p><?php echo $destination['location']; ?></p>
        </div>
    </section>

    <!-- Destination Content -->
    <section class="destination-content">
        <div class="">
            <div class="destination-about">
                <h2>About <?php echo $destination['name']; ?></h2>
                <p><?php echo $destination['description']; ?></p>

                <div class="destination-features">
                    <div class="feature">
                        <i class="fas fa-landmark"></i>
                        <h3>Culture</h3>
                        <p>Experience the rich cultural heritage of this destination with traditional ceremonies and
                            local customs.</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-mountain"></i>
                        <h3>Landscape</h3>
                        <p>Explore breathtaking landscapes from mountains to valleys, with unique geological formations.
                        </p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-utensils"></i>
                        <h3>Cuisine</h3>
                        <p>Taste authentic local dishes made with traditional recipes passed down through generations.
                        </p>
                    </div>
                </div>
            </div>

            <div class="destination-gallery">
                <h2>Gallery</h2>
                <?php if (!empty($destination_images)): ?>
                <div class="gallery-grid">
                    <?php foreach ($destination_images as $image): ?>
                    <div class="gallery-item">
                        <img src="<?php echo htmlspecialchars($image['image_path']); ?>"
                            alt="<?php echo !empty($image['caption']) ? htmlspecialchars($image['caption']) : 'Destination image'; ?>"
                            class="gallery-image">
                        <?php if (!empty($image['caption'])): ?>
                        <div class="gallery-caption"><?php echo htmlspecialchars($image['caption']); ?></div>
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
            <h2>Packages in <?php echo $destination['name']; ?></h2>
            <p>Choose from our carefully curated travel packages</p>

            <div class="packages-grid">
                <?php foreach ($packages as $package): ?>
                <div class="package-card">
                    <img src="<?php echo $package['image_path']; ?>" alt="<?php echo $package['title']; ?>">
                    <div class="package-info">
                        <h3><?php echo $package['title']; ?></h3>
                        <div class="package-meta">
                            <span><i class="fas fa-clock"></i> <?php echo $package['duration_days']; ?> days</span>
                            <span><i class="fas fa-tag"></i> <?php echo $package['type']; ?></span>
                        </div>
                        <p><?php echo substr($package['description'], 0, 100) . '...'; ?></p>
                        <div class="package-footer">
                            <span class="price">$<?php echo number_format($package['price'], 2); ?></span>
                            <a href="package.php?id=<?php echo $package['id']; ?>" class="btn-details">Details</a>
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
            <h2>Recommended Hotels in <?php echo $destination['name']; ?></h2>
            <p>Comfortable accommodations for your stay</p>

            <div class="hotels-grid">
                <?php foreach ($hotels as $hotel): ?>
                <div class="hotel-card">
                    <img src="<?php echo $hotel['image_path']; ?>" alt="<?php echo $hotel['name']; ?>">
                    <div class="hotel-info">
                        <h3><?php echo $hotel['name']; ?></h3>
                        <div class="hotel-rating">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star <?php echo $i < $hotel['rating'] ? 'active' : ''; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p><?php echo substr($hotel['description'], 0, 100) . '...'; ?></p>
                        <div class="hotel-footer">
                            <span class="price">From
                                $<?php echo number_format($hotel['price_per_night'], 2); ?>/night</span>
                            <a href="hotel.php?id=<?php echo $hotel['id']; ?>" class="btn-details">View</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>

</html>