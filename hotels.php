<?php
// hotels.php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

// Get hotels from database
$stmt = $pdo->query("SELECT * FROM hotels ORDER BY name");
$hotels = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels - Travel Habesha</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles/hotels.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<!-- Header Section -->
<header>
    <!-- Top Bar -->
    <div class="top-bar">
        <!-- Share Icon -->
        <div class="con">
            <div class="socials">
                <i class="fa-solid fa-earth-africa"></i><span class="lang">LANGUAGESENES</span>
                <i class="fa-solid fa-share-nodes"></i><span class="lang">OUR SOCIALS</span>
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-pinterest-p"></i>
            </div>
            <div class="right-links">
                <a class="fav" href="#"><i class="fa-regular fa-star"></i>TOUR PACKAGES</a>
                <a class="contact" href="#"><i class="fa-solid fa-location-dot"></i>CONTACT US</a>
            </div>
        </div>

    </div>

    <!-- Navigation -->
    <div class="nav-bar">
        <nav>

            <div class="logo">
                <strong>TRAVEL HABESHA.</strong>
                <i class="small-block fas fa-bars menu-icon"></i>
            </div>
            <ul>
                <li class="nav-links"><a href="/index.php">Home</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/packages.php">Packages</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/shop.php">Shop</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/rentalcar.php">Travel Cars</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/about.php">About Us</a></li>
                <li class="nav-links"><a href="../Travel-web-backend/hotels.php">Hotels</a></li>
                <li class="book-now"><a href="../Travel-web-backend/book.php">Book Now</a></li>
            </ul>
        </nav>
    </div>
</header>
<!-- Hero Section -->
<section class="hotels">
    <h2 class="shop">hotels</h2>
</section>
<!-- Cards Section -->
<section class="shop-cards">
    <div class="hotel-card">

        <img src="assets/hotels1.jpg" alt="frendship addis ababa">
        <div class="hotel-star"><i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
        </div>
        <h1>paradise lodge</h1>
        <p class="near">Arbaminch </p>
        <a href="https://www.paradiselodgeethiopia.com/" class="hotel-book-now"> book-now</a>
    </div>
    <div class="hotel-card">
        <img src="assets/hotels2.jpg" alt="frendship addis ababa">
        <div class="hotel-star"><i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
        </div>
        <h1>Haile resort</h1>
        <p class="near">Hawassa</p>
        <a href="https://hailehotelsandresorts.com/hawassa-resort/" class="hotel-book-now"> book-now</a>
    </div>
    <div class="hotel-card">

        <img src="assets/hotels3.jpg" alt="frendship addis ababa">
        <div class="hotel-star"><i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
        </div>
        <h1>Lewi Resort</h1>
        <p class="near">Wolayita Sodo</p>
        <a href="https://www.lewihotelsandresort.com/sodo.php" class="hotel-book-now"> book-now</a>
    </div>
    <div class="hotel-card">

        <img src="assets/hotels4.jpg" alt="frendship addis ababa">
        <div class="hotel-star"><i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
            <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
        </div>
        <h1>skylight hotel</h1>
        <p class="near">Addis ababa</p>
        <a href="https://www.ethiopianskylighthotel.com/" class="hotel-book-now"> book-now</a>
    </div>
    <div class="hotel-card">

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
</body>

</html>