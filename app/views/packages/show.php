<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
// Assuming header.php handles the main header HTML and links CSS
require_once __DIR__ . '/includes/header.php'; 

if (!isset($_GET['id'])) {
    header("Location: packages.php");
    exit();
}

$package_id = $_GET['id'];

// Get package details
$stmt = $pdo->prepare("
    SELECT p.*, d.name as destination_name, d.description as destination_description, 
           d.location as destination_location, d.image_path as destination_image
    FROM packages p
    JOIN destinations d ON p.destination_id = d.id
    WHERE p.id = ?
");
$stmt->execute([$package_id]);
$package = $stmt->fetch();

if (!$package) {
    header("Location: packages.php");
    exit();
}

// Get related packages (same destination)
$stmt = $pdo->prepare("
    SELECT p.* FROM packages p
    WHERE p.destination_id = ? AND p.id != ?
    LIMIT 3
");
$stmt->execute([$package['destination_id'], $package_id]);
$relatedPackages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($package['title']); ?> - Travel Habesha</title>


    <link rel="stylesheet" href="css/pages/package.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Poppins:wght@400;500;600&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php 
    // Ensure header.php includes session_helper if it needs session_start()
    require_once __DIR__ . '/includes/header.php'; 
    ?>

    <section class="package-hero"
        style="background-image: url('<?php echo htmlspecialchars($package['image_path']); ?>');">
        <div class="hero-overlay">
            <h1><?php echo htmlspecialchars($package['title']); ?></h1>
            <p><?php echo htmlspecialchars($package['destination_name']); ?></p>
        </div>
    </section>

    <section class="package-details">
        <div class="details-container">
            <div class="details-main">
                <h2>Package Overview</h2>
                <p><?php echo nl2br(htmlspecialchars($package['description'])); ?></p>
                <div class="package-highlights">
                    <h3>Highlights</h3>
                    <ul>
                        <li><i class="fas fa-check"></i> <?php echo htmlspecialchars($package['duration_days']); ?> days
                            of adventure</li>
                        <li><i class="fas fa-check"></i> Experience
                            <?php echo htmlspecialchars($package['destination_name']); ?></li>
                        <li><i class="fas fa-check"></i> <?php echo ucfirst(htmlspecialchars($package['type'])); ?>
                            package</li>
                        <li><i class="fas fa-check"></i> Suitable for ages
                            <?php echo htmlspecialchars($package['min_age']); ?>+</li>
                        <?php if (!empty($package['max_guests'])): ?>
                        <li><i class="fas fa-users"></i> Max <?php echo htmlspecialchars($package['max_guests']); ?>
                            guests</li>
                        <?php endif; ?>
                        <?php if (!empty($package['inclusions'])): ?>
                        <li><i class="fas fa-utensils"></i> Inclusions:
                            <?php echo htmlspecialchars($package['inclusions']); ?></li>
                        <?php endif; ?>
                        <?php if (!empty($package['exclusions'])): ?>
                        <li><i class="fas fa-ban"></i> Exclusions:
                            <?php echo htmlspecialchars($package['exclusions']); ?></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="package-itinerary">
                    <h3>Itinerary</h3>
                    <div class="itinerary-item">
                        <div class="day">Day 1</div>
                        <div class="activity">
                            <h4>Arrival and Orientation in <?php echo htmlspecialchars($package['destination_name']); ?>
                            </h4>
                            <p>Arrive at the destination and get settled in your accommodation. Our local guide will
                                meet you for an evening orientation meeting, detailing the exciting days ahead.</p>
                        </div>
                    </div>
                    <div class="itinerary-item">
                        <div class="day">Day 2</div>
                        <div class="activity">
                            <h4>Exploring the <?php echo htmlspecialchars($package['destination_name']); ?> Area</h4>
                            <p>Embark on a full day of exploration. This may include visiting historical sites,
                                experiencing local culture, or enjoying scenic natural wonders, depending on your chosen
                                package type.</p>
                        </div>
                    </div>
                    <?php 
                    // Example of how you might include more dynamic itinerary
                    // if ($package['duration_days'] > 2) {
                    //    echo '<div class="itinerary-item"><div class="day">Day 3</div><div class="activity"><h4>Continue Adventure</h4><p>More detailed activities...</p></div></div>';
                    // }
                    ?>
                    <div class="itinerary-item">
                        <div class="day">Day <?php echo htmlspecialchars($package['duration_days']); ?></div>
                        <div class="activity">
                            <h4>Departure</h4>
                            <p>Enjoy a final Ethiopian breakfast before heading to the airport for your departure,
                                filled with unforgettable memories.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="details-sidebar">
                <div class="booking-box">
                    <h3>Book This Package</h3>
                    <div class="price">
                        $<?php echo number_format($package['price'], 2); ?>
                        <span>per person</span>
                    </div>

                    <div class="package-meta">
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span><?php echo htmlspecialchars($package['duration_days']); ?> days</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo htmlspecialchars($package['destination_name']); ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-tag"></i>
                            <span><?php echo ucfirst(htmlspecialchars($package['type'])); ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-hiking"></i>
                            <span><?php echo ucfirst(htmlspecialchars($package['difficulty'])); ?></span>
                        </div>
                    </div>

                    <a href="book.php?package=<?php echo htmlspecialchars($package['id']); ?>" class="btn-book">Book
                        Now</a>
                </div>

                <div class="destination-info">
                    <h3>About <?php echo htmlspecialchars($package['destination_name']); ?></h3>
                    <img src="<?php echo htmlspecialchars($package['destination_image']); ?>"
                        alt="<?php echo htmlspecialchars($package['destination_name']); ?>">
                    <p><?php echo nl2br(substr(htmlspecialchars($package['destination_description']), 0, 200)); ?>...
                    </p>
                    <a href="destination.php?id=<?php echo htmlspecialchars($package['destination_id']); ?>"
                        class="btn-more">Learn
                        More</a>
                </div>
            </div>
        </div>
    </section>

    <?php if (!empty($relatedPackages)): ?>
    <section class="related-packages">
        <div class="section-header">
            <h2>You Might Also Like</h2>
            <p>Explore more packages in <?php echo htmlspecialchars($package['destination_name']); ?></p>
        </div>

        <div class="packages-grid">
            <?php foreach ($relatedPackages as $related): ?>
            <div class="package-card">
                <img src="<?php echo htmlspecialchars($related['image_path']); ?>"
                    alt="<?php echo htmlspecialchars($related['title']); ?>">
                <div class="package-info">
                    <h3><?php echo htmlspecialchars($related['title']); ?></h3>
                    <div class="package-meta">
                        <span><i class="fas fa-map-marker-alt"></i>
                            <?php echo htmlspecialchars($package['destination_name']); ?></span>
                        <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($related['duration_days']); ?>
                            days</span>
                        <span><i class="fas fa-tag"></i> <?php echo htmlspecialchars($related['type']); ?></span>
                    </div>
                    <div class="package-footer">
                        <span class="price">$<?php echo number_format($related['price'], 2); ?></span>
                        <a href="package.php?id=<?php echo htmlspecialchars($related['id']); ?>"
                            class="btn-details">Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php require_once __DIR__ . '/includes/footer.php'; ?>
</body>

</html>