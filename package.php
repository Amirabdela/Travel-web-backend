<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
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
    SELECT p.* 
    FROM packages p
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
    <title><?php echo $package['title']; ?> - Travel Habesha</title>
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    /* Package Hero Section */
    .package-hero {
        height: 60vh;
        background-size: cover;
        background-position: center;
        position: relative;
        color: white;
        display: flex;
        align-items: flex-end;
    }

    .hero-overlay {
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        width: 100%;
        padding: 60px 20px 40px;
    }

    .package-hero h1 {
        font-size: 3rem;
        margin-bottom: 10px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .package-hero p {
        font-size: 1.5rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Package Details Section */
    .package-details {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .details-container {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 30px;
    }

    .details-main {
        background: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .details-sidebar {
        display: flex;
        flex-direction: column;
        gap: 30px;
        position: sticky;
        top: 20px;
        align-self: start;
    }

    .booking-box,
    .destination-info {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .booking-box h3,
    .destination-info h3 {
        color: #264653;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .price {
        font-size: 2rem;
        color: #2A9D8F;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .price span {
        font-size: 1rem;
        color: #777;
        font-weight: normal;
    }

    .package-meta {
        margin: 25px 0;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
        color: #555;
    }

    .meta-item i {
        color: #2A9D8F;
        width: 20px;
        text-align: center;
    }

    .btn-book {
        display: block;
        background: linear-gradient(90deg, #2A9D8F, #4CC9A7);
        color: white;
        text-align: center;
        padding: 14px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-book:hover {
        background: linear-gradient(90deg, #228176, #3BAE8F);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(42, 157, 143, 0.3);
    }

    .destination-info img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .destination-info p {
        color: #555;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .btn-more {
        display: inline-block;
        background: #264653;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-more:hover {
        background: #1d3641;
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(38, 70, 83, 0.2);
    }

    /* Package Highlights */
    .package-highlights {
        margin: 30px 0;
    }

    .package-highlights h3 {
        color: #264653;
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    .package-highlights ul {
        list-style: none;
    }

    .package-highlights li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .package-highlights i {
        color: #2A9D8F;
    }

    /* Itinerary */
    .package-itinerary {
        margin-top: 40px;
    }

    .package-itinerary h3 {
        color: #264653;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .itinerary-item {
        display: flex;
        margin-bottom: 25px;
        border-left: 3px solid #E9C46A;
        padding-left: 20px;
    }

    .day {
        font-weight: 700;
        color: #264653;
        min-width: 60px;
    }

    .activity h4 {
        color: #2A9D8F;
        margin-bottom: 8px;
    }

    .activity p {
        color: #555;
        line-height: 1.6;
    }

    /* Related Packages */
    .related-packages {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-header h2 {
        color: #264653;
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .section-header p {
        color: #777;
        font-size: 1.1rem;
    }

    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 30px;
    }

    .package-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .package-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }

    .package-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .package-info {
        padding: 20px;
    }

    .package-info h3 {
        color: #264653;
        font-size: 1.3rem;
        margin-bottom: 15px;
    }

    .package-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    .package-meta span {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.85rem;
        color: #777;
    }

    .package-meta i {
        color: #2A9D8F;
    }

    .package-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #eee;
    }

    .package-footer .price {
        font-size: 1.5rem;
        color: #2A9D8F;
        font-weight: 700;
    }

    .btn-details {
        background: #264653;
        color: white;
        padding: 8px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-details:hover {
        background: #1d3641;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .details-container {
            grid-template-columns: 1fr;
        }

        .details-sidebar {
            position: static;
            grid-row: 1;
            margin-bottom: 40px;
        }
    }

    @media (max-width: 768px) {
        .package-hero h1 {
            font-size: 2.2rem;
        }

        .package-hero p {
            font-size: 1.2rem;
        }

        .packages-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .package-hero {
            height: 50vh;
        }

        .package-hero h1 {
            font-size: 1.8rem;
        }

        .package-hero p {
            font-size: 1rem;
        }

        .details-main,
        .booking-box,
        .destination-info {
            padding: 20px;
        }
    }
    </style>
</head>

<body>
    <!-- Header Section -->


    <!-- Package Hero Section -->
    <section class="package-hero" style="background-image: url('<?php echo $package['image_path']; ?>');">
        <div class="hero-overlay">
            <h1><?php echo $package['title']; ?></h1>
            <p><?php echo $package['destination_name']; ?></p>
        </div>
    </section>

    <!-- Package Details Section -->
    <section class="package-details">
        <div class="details-container">
            <div class="details-main">
                <h2>Package Overview</h2>
                <p><?php echo $package['description']; ?></p>

                <div class="package-highlights">
                    <h3>Highlights</h3>
                    <ul>
                        <li><i class="fas fa-check"></i> <?php echo $package['duration_days']; ?> days of adventure</li>
                        <li><i class="fas fa-check"></i> Experience <?php echo $package['destination_name']; ?></li>
                        <li><i class="fas fa-check"></i> <?php echo ucfirst($package['type']); ?> package</li>
                        <li><i class="fas fa-check"></i> Suitable for ages <?php echo $package['min_age']; ?>+</li>
                    </ul>
                </div>

                <div class="package-itinerary">
                    <h3>Itinerary</h3>
                    <div class="itinerary-item">
                        <div class="day">Day 1</div>
                        <div class="activity">
                            <h4>Arrival and Orientation</h4>
                            <p>Arrive at the destination and get settled in your accommodation. Evening orientation
                                meeting with your guide.</p>
                        </div>
                    </div>
                    <div class="itinerary-item">
                        <div class="day">Day 2</div>
                        <div class="activity">
                            <h4>Exploring the Area</h4>
                            <p>Full day of activities including sightseeing and cultural experiences.</p>
                        </div>
                    </div>
                    <!-- More itinerary items would be dynamically generated from database in a real app -->
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
                            <span><?php echo $package['duration_days']; ?> days</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span><?php echo $package['destination_name']; ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-tag"></i>
                            <span><?php echo ucfirst($package['type']); ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-hiking"></i>
                            <span><?php echo ucfirst($package['difficulty']); ?></span>
                        </div>
                    </div>

                    <a href="book.php?package=<?php echo $package['id']; ?>" class="btn-book">Book Now</a>
                </div>

                <div class="destination-info">
                    <h3>About <?php echo $package['destination_name']; ?></h3>
                    <img src="<?php echo $package['destination_image']; ?>"
                        alt="<?php echo $package['destination_name']; ?>">
                    <p><?php echo substr($package['destination_description'], 0, 200) . '...'; ?></p>
                    <a href="destination.php?id=<?php echo $package['destination_id']; ?>" class="btn-more">Learn
                        More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Packages -->
    <?php if (!empty($relatedPackages)): ?>
    <section class="related-packages">
        <div class="section-header">
            <h2>You Might Also Like</h2>
            <p>Explore more packages in <?php echo $package['destination_name']; ?></p>
        </div>

        <div class="packages-grid">
            <?php foreach ($relatedPackages as $related): ?>
            <div class="package-card">
                <img src="<?php echo $related['image_path']; ?>" alt="<?php echo $related['title']; ?>">
                <div class="package-info">
                    <h3><?php echo $related['title']; ?></h3>
                    <div class="package-meta">
                        <span><i class="fas fa-map-marker-alt"></i> <?php echo $package['destination_name']; ?></span>
                        <span><i class="fas fa-clock"></i> <?php echo $related['duration_days']; ?> days</span>
                        <span><i class="fas fa-tag"></i> <?php echo $related['type']; ?></span>
                    </div>
                    <div class="package-footer">
                        <span class="price">$<?php echo number_format($related['price'], 2); ?></span>
                        <a href="package.php?id=<?php echo $related['id']; ?>" class="btn-details">Details</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>
</body>

</html>