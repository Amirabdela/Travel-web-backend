<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: rentalcar.php");
    exit();
}

$car_id = $_GET['id'];

// Get car details
$stmt = $pdo->prepare("SELECT * FROM rental_cars WHERE id = ?");
$stmt->execute([$car_id]);
$car = $stmt->fetch();

if (!$car) {
    header("Location: rentalcar.php");
    exit();
}

// Get features as array
$features = $car['features'] ? explode(',', $car['features']) : [];

// Get other cars of same type
$stmt = $pdo->prepare("
    SELECT * FROM rental_cars 
    WHERE type = ? AND id != ?
    ORDER BY price_per_day ASC
    LIMIT 3
");
$stmt->execute([$car['type'], $car_id]);
$similarCars = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $car['model']; ?> - Travel Habesha</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/cars.css">
=======
    <link rel="stylesheet" href="index.css">
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->


    <!-- Car Hero Section -->
    <section class="car-hero" style="background-image: url('<?php echo $car['image_path']; ?>');">
        <div class="hero-overlay">
            <h1><?php echo $car['model']; ?></h1>
            <p><?php echo ucfirst($car['type']); ?> Vehicle</p>
            <div class="car-rating">
                <?php for ($i = 0; $i < 5; $i++): ?>
                <i class="fas fa-star <?php echo $i < $car['rating'] ? 'active' : ''; ?>"></i>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Car Details Section -->
    <section class="car-details">
        <div class="container">
            <div class="car-main">
                <h2>Vehicle Details</h2>

                <div class="car-specs">
                    <div class="spec-item">
                        <i class="fas fa-car"></i>
                        <span>Type: <?php echo ucfirst($car['type']); ?></span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Transmission: Automatic</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-gas-pump"></i>
                        <span>Fuel: Petrol</span>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-users"></i>
                        <span>Seats: 5</span>
                    </div>
                </div>

                <div class="car-features">
                    <h3>Features</h3>
                    <div class="features-grid">
                        <?php foreach ($features as $feature): ?>
                        <div class="feature">
                            <i class="fas fa-check"></i> <?php echo trim($feature); ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="car-gallery">
                    <h3>Photo Gallery</h3>
                    <div class="gallery-grid">
                        <div class="gallery-item" style="background-image: url('assets/car1.jpg');"></div>
                        <div class="gallery-item" style="background-image: url('assets/car2.jpg');"></div>
                        <div class="gallery-item" style="background-image: url('assets/car3.jpg');"></div>
                        <div class="gallery-item" style="background-image: url('assets/car4.jpg');"></div>
                    </div>
                </div>
            </div>

            <div class="car-sidebar">
                <div class="booking-box">
                    <h3>Book This Vehicle</h3>
                    <div class="price">
                        $<?php echo number_format($car['price_per_day'], 2); ?>
                        <span>per day</span>
                    </div>

                    <form method="POST" action="book-car.php">
                        <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">

                        <div class="form-group">
                            <label for="pickup-date">Pickup Date</label>
                            <input type="date" id="pickup-date" name="pickup_date" required>
                        </div>

                        <div class="form-group">
                            <label for="return-date">Return Date</label>
                            <input type="date" id="return-date" name="return_date" required>
                        </div>

                        <div class="form-group">
                            <label for="pickup-location">Pickup Location</label>
                            <select id="pickup-location" name="pickup_location">
                                <option value="Addis Ababa">Addis Ababa</option>
                                <option value="Bahir Dar">Bahir Dar</option>
                                <option value="Gondar">Gondar</option>
                                <option value="Lalibela">Lalibela</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-book">Book Now</button>
                    </form>
                </div>

                <div class="car-includes">
                    <h3>Price Includes</h3>
                    <ul>
                        <li><i class="fas fa-check"></i> Unlimited mileage</li>
                        <li><i class="fas fa-check"></i> Collision damage waiver</li>
                        <li><i class="fas fa-check"></i> Theft protection</li>
                        <li><i class="fas fa-check"></i> 24/7 roadside assistance</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Similar Cars -->
    <?php if (!empty($similarCars)): ?>
    <section class="similar-cars">
        <div class="container">
            <h2>Similar <?php echo ucfirst($car['type']); ?> Vehicles</h2>
            <p>Other options you might consider</p>

            <div class="cars-grid">
                <?php foreach ($similarCars as $similar): ?>
                <div class="car-card">
                    <img src="<?php echo $similar['image_path']; ?>" alt="<?php echo $similar['model']; ?>">
                    <div class="car-info">
                        <h3><?php echo $similar['model']; ?></h3>
                        <div class="car-rating">
                            <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fas fa-star <?php echo $i < $similar['rating'] ? 'active' : ''; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="car-features">
                            <?php 
                                    $simFeatures = $similar['features'] ? explode(',', $similar['features']) : [];
                                    foreach (array_slice($simFeatures, 0, 3) as $feature): ?>
                            <span><?php echo trim($feature); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="car-footer">
                            <span class="price">$<?php echo number_format($similar['price_per_day'], 2); ?>/day</span>
                            <a href="car.php?id=<?php echo $similar['id']; ?>" class="btn-book">View</a>
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