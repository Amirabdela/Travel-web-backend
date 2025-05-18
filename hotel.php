<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: hotels.php");
    exit();
}

$hotel_id = $_GET['id'];

// Get hotel details
$stmt = $pdo->prepare("SELECT * FROM hotels WHERE id = ?");
$stmt->execute([$hotel_id]);
$hotel = $stmt->fetch();

if (!$hotel) {
    header("Location: hotels.php");
    exit();
}

// Get amenities as array
$amenities = $hotel['amenities'] ? explode(',', $hotel['amenities']) : [];

// Get other hotels in same location
$stmt = $pdo->prepare("
    SELECT * FROM hotels 
    WHERE location LIKE ? AND id != ?
    ORDER BY rating DESC
    LIMIT 3
");
$stmt->execute(['%' . $hotel['location'] . '%', $hotel_id]);
$similarHotels = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $hotel['name']; ?> - Travel Habesha</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles/hotels.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->


    <!-- Hotel Hero Section -->
    <section class="hotel-hero" style="background-image: url('<?php echo $hotel['image_path']; ?>');">
        <div class="hero-overlay">
            <h1><?php echo $hotel['name']; ?></h1>
            <p><?php echo $hotel['location']; ?></p>
            <div class="hotel-rating">
                <?php for ($i = 0; $i < 5; $i++): ?>
                <i class="fas fa-star <?php echo $i < $hotel['rating'] ? 'active' : ''; ?>"></i>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Hotel Details Section -->
    <section class="hotel-details">
        <div class="container">
            <div class="hotel-main">
                <h2>About <?php echo $hotel['name']; ?></h2>
                <p><?php echo $hotel['description']; ?></p>

                <div class="hotel-amenities">
                    <h3>Amenities</h3>
                    <div class="amenities-grid">
                        <?php foreach ($amenities as $amenity): ?>
                        <div class="amenity">
                            <i class="fas fa-check"></i> <?php echo trim($amenity); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="hotel-gallery">
                    <h3>Photo Gallery</h3>
                    <div class="gallery-grid">
                        <div class="gallery-item" style="background-image: url('assets/hotel1.jpg');"></div>
                        <div class="gallery-item" style="background-image: url('assets/hotel2.jpg');"></div>
                        <div class="gallery-item" style="background-image: url('assets/hotel3.jpg');"></div>
                        <div class="gallery-item" style="background-image: url('assets/hotel4.jpg');"></div>
                    </div>
                </div>
            </div>

            <div class="hotel-sidebar">
                <div class="booking-box">
                    <h3>Book Your Stay</h3>
                    <div class="price">
                        $<?php echo number_format($hotel['price_per_night'], 2); ?>
                        <span>per night</span>
                    </div>

                    <form method="POST" action="book-hotel.php">
                        <input type="hidden" name="hotel_id" value="<?php echo $hotel['id']; ?>">

                        <div class="form-group">
                            <label for="check-in">Check-in</label>
                            <input type="date" id="check-in" name="check_in" required>
                        </div>

                        <div class="form-group">
                            <label for="check-out">Check-out</label>
                            <input type="date" id="check-out" name="check_out" required>
                        </div>

                        <div class="form-group">
                            <label for="guests">Guests</label>
                            <select id="guests" name="guests">
                                <option value="1">1 Guest</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                                <option value="4">4 Guests</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-book">Book Now</button>
                    </form>
                </div>

                <div class="hotel-contact">
                    <h3>Contact Information</h3>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $hotel['location']; ?></p>
                    <p><i class="fas fa-phone"></i> +251 911 811 899</p>
                    <p><i class="fas fa-envelope"></i>
                        info@<?php echo strtolower(str_replace(' ', '', $hotel['name'])); ?>.com</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Similar Hotels -->
    <?php if (!empty($similarHotels)): ?>
    <section class="similar-hotels">
        <div class="container">
            <h2>Similar Hotels in <?php echo $hotel['location']; ?></h2>
            <p>Other accommodations you might like</p>

            <div class="hotels-grid">
                <?php foreach ($similarHotels as $similar): ?>
                <div class="hotel-card">
                    <img src="<?php echo $similar['image_path']; ?>" alt="<?php echo $similar['name']; ?>">
                    <div class="hotel-info">
                        <h3><?php echo $similar['name']; ?></h3>
                        <div class="hotel-rating">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star <?php echo $i < $similar['rating'] ? 'active' : ''; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p><?php echo substr($similar['description'], 0, 100) . '...'; ?></p>
                        <div class="hotel-footer">
                            <span
                                class="price">$<?php echo number_format($similar['price_per_night'], 2); ?>/night</span>
                            <a href="hotel.php?id=<?php echo $similar['id']; ?>" class="btn-details">View</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <!-- <?php include 'footer.php'; ?> -->
</body>

</html>