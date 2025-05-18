<?php require_once 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Travel Habesha'; ?></title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="styles/contact.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->
    <header>
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="con">
                <div class="socials">
                    <i class="fa-solid fa-earth-africa"></i><span class="lang">LANGUAGES</span>
                    <i class="fa-solid fa-share-nodes"></i><span class="lang">OUR SOCIALS</span>
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-pinterest-p"></i>
                </div>
                <div class="right-links">
                    <a class="fav" href="packages.php"><i class="fa-regular fa-star"></i>TOUR PACKAGES</a>
                    <a class="contact" href="contact.php"><i class="fa-solid fa-location-dot"></i>CONTACT US</a>
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
                    <li class="nav-links"><a href="index.php">Home</a></li>
                    <li class="nav-links"><a href="packages.php">Packages</a></li>
                    <li class="nav-links"><a href="shop.php">Shop</a></li>
                    <li class="nav-links"><a href="rentalcar.php">Travel Cars</a></li>
                    <li class="nav-links"><a href="about.php">About Us</a></li>
                    <li class="nav-links"><a href="hotels.php">Hotels</a></li>
                    <?php if (isLoggedIn()): ?>
                    <li class="nav-links"><a href="profile.php"><i class="fa-solid fa-user"></i> My Profile</a></li>
                    <?php if (isAdmin()): ?>
                    <li class="nav-links"><a href="admin/dashboard.php"><i class="fa-solid fa-lock"></i> Admin</a></li>
                    <?php endif; ?>
                    <li class="nav-links"><a href="auth.php?logout=1"><i class="fa-solid fa-sign-out-alt"></i>
                            Logout</a></li>
                    <?php else: ?>
                    <li class="nav-links"><a href="login.php"><i class="fa-solid fa-sign-in-alt"></i> Login</a></li>
                    <?php endif; ?>
                    <li class="book-now"><a href="book.php">Book Now</a></li>
                </ul>
            </nav>
        </div>
    </header>