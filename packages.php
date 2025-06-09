<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

<<<<<<< HEAD
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
=======
// Get all packages with destination info
$stmt = $pdo->query("
    SELECT p.*, d.name as destination_name, d.location as destination_location 
    FROM packages p
    JOIN destinations d ON p.destination_id = d.id
");
$packages = $stmt->fetchAll();

// Get unique package types for filter
$stmt = $pdo->query("SELECT DISTINCT type FROM packages");
$types = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Get unique difficulties for filter
$stmt = $pdo->query("SELECT DISTINCT difficulty FROM packages");
$difficulties = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
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
=======
    <title>Packages - Travel Habesha</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles/packages.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-all">
            <div class="hero-padding">
                <span id="our">OUR PACKAGES</span>
                <h2>Search your Holiday</h2>
            </div>
            <div class="search">
                <div class="search-form">
                    <!-- Destination Dropdown -->
                    <div class="form-group">
                        <label for="destination">Select Your Destination:</label>
                        <select id="destination">
                            <option value="">All Destinations</option>
                            <?php 
                            $stmt = $pdo->query("SELECT id, name FROM destinations");
                            while ($row = $stmt->fetch()): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Package Type Dropdown -->
                    <div class="form-group">
                        <label for="type">Package Type:</label>
                        <select id="type">
                            <option value="">All Types</option>
                            <?php foreach ($types as $type): ?>
                            <option value="<?php echo $type; ?>"><?php echo ucfirst($type); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Difficulty Dropdown -->
                    <div class="form-group">
                        <label for="difficulty">Difficulty:</label>
                        <select id="difficulty">
                            <option value="">All Difficulties</option>
                            <?php foreach ($difficulties as $difficulty): ?>
                            <option value="<?php echo $difficulty; ?>"><?php echo ucfirst($difficulty); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Price Slider -->
                    <div class="form-group">
                        <div class="price-v">
                            <label for="price">Max Price:</label>
                            <span class="price-value">$2500</span>
                        </div>
                        <div class="price-range">
                            <input type="range" id="price" min="0" max="5000" step="100" value="2500">
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="form-group">
                        <button type="button" id="search-btn" class="btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Grid -->
    <section class="cards" id="packages-container">
        <?php foreach ($packages as $package): ?>
        <div class="card" data-destination="<?php echo $package['destination_id']; ?>"
            data-type="<?php echo $package['type']; ?>" data-difficulty="<?php echo $package['difficulty']; ?>"
            data-price="<?php echo $package['price']; ?>">
            <img src="<?php echo $package['image_path']; ?>" alt="<?php echo $package['title']; ?>">
            <div class="card-content">
                <h3><?php echo $package['title']; ?></h3>
                <div class="i-city">
                    <i class="fa-solid fa-location-dot"></i>
                    <span class="city"><?php echo $package['destination_name']; ?></span>
                </div>
                <div class="cult">
                    <div>
                        <h6><?php echo $package['type']; ?></h6>
                        <h6><?php echo $package['difficulty']; ?></h6>
                    </div>
                    <h2>$<?php echo number_format($package['price'], 2); ?></h2>
                </div>
                <p><?php echo substr($package['description'], 0, 100) . '...'; ?></p>
                <a href="package.php?id=<?php echo $package['id']; ?>" class="detail-btn">DETAILS</a>
            </div>
        </div>
        <?php endforeach; ?>
    </section>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize elements
        const searchBtn = document.getElementById('search-btn');
        const priceSlider = document.getElementById('price');
        const priceValue = document.querySelector('.price-value');
        const filters = ['destination', 'type', 'difficulty'];

        // Format currency
        const formatCurrency = (amount) => {
            return '$' + amount.toLocaleString('en-US');
        };

        // Update price display
        const updatePriceDisplay = () => {
            priceValue.textContent = formatCurrency(parseInt(priceSlider.value));
        };

        // Initialize price display
        updatePriceDisplay();

        // Add event listeners
        priceSlider.addEventListener('input', updatePriceDisplay);
        searchBtn.addEventListener('click', filterPackages);

        // Allow filtering on Enter key
        filters.forEach(filter => {
            document.getElementById(filter).addEventListener('keypress', function(e) {
                if (e.key === 'Enter') filterPackages();
            });
        });

        // Filter packages function
        function filterPackages() {
            const destination = document.getElementById('destination').value;
            const type = document.getElementById('type').value;
            const difficulty = document.getElementById('difficulty').value;
            const maxPrice = parseInt(priceSlider.value);

            const packages = document.querySelectorAll('.card');
            let visibleCount = 0;

            packages.forEach(pkg => {
                const pkgDestination = pkg.dataset.destination;
                const pkgType = pkg.dataset.type;
                const pkgDifficulty = pkg.dataset.difficulty;
                const pkgPrice = parseFloat(pkg.dataset.price);

                const show =
                    (destination === '' || pkgDestination === destination) &&
                    (type === '' || pkgType === type) &&
                    (difficulty === '' || pkgDifficulty === difficulty) &&
                    pkgPrice <= maxPrice;

                if (show) {
                    pkg.style.display = 'block';
                    visibleCount++;
                    pkg.classList.add('animate__animated', 'animate__fadeIn');
                } else {
                    pkg.style.display = 'none';
                    pkg.classList.remove('animate__animated', 'animate__fadeIn');
                }
            });

            // Show/hide no results message
            const noResults = document.getElementById('no-results');
            if (visibleCount === 0) {
                if (!noResults) {
                    const packagesContainer = document.getElementById('packages-container');
                    const message = document.createElement('div');
                    message.id = 'no-results';
                    message.className = 'no-results animate__animated animate__fadeIn';
                    message.innerHTML = `
                    <i class="fas fa-compass"></i>
                    <p>No packages match your search criteria. Try adjusting your filters.</p>
                    <button class="btn-reset" id="reset-filters">Reset Filters</button>
                `;
                    packagesContainer.appendChild(message);

                    // Add reset functionality
                    document.getElementById('reset-filters').addEventListener('click', function() {
                        document.getElementById('destination').value = '';
                        document.getElementById('type').value = '';
                        document.getElementById('difficulty').value = '';
                        priceSlider.value = 2500;
                        updatePriceDisplay();
                        filterPackages();
                        message.remove();
                    });
                }
            } else if (noResults) {
                noResults.remove();
            }

            // Smooth scroll to results
            document.getElementById('packages-container').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Initial filter on page load
        filterPackages();
    });
    </script>
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
</body>

</html>