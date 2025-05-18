<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/auth_functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Habesha - Explore Ethiopia's Wonders</title>
    <link rel="stylesheet" href="index.php">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Poppins:wght@500;600;700&family=Sono:wght@400;500&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header Section -->
    <header class="site-header">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="header-utilities">
                    <!-- Left-aligned items -->
                    <div class="top-bar-left">
                        <div class="quick-links">
                            <a href="tel:+251911811899" class="phone-link">
                                <i class="fas fa-phone-alt"></i> +251 911 811 899
                            </a>
                            <a href="contact.php" class="contact-link">
                                <i class="fas fa-map-marker-alt"></i> Contact Us
                            </a>
                        </div>
                    </div>

                    <!-- Right-aligned user section -->
                    <div class="top-bar-right">
                        <div class="user-account-section">
                            <?php if (isLoggedIn()): ?>
                            <div class="user-menu-dropdown">
                                <a href="profile.php" class="user-avatar">
                                    <img src="<?php echo getUserAvatar($_SESSION['user_id']); ?>" alt="User Profile">
                                    <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                                    <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul class="user-dropdown-menu">
                                    <li><a href="profile.php"><i class="fas fa-user-circle"></i> My Profile</a></li>
                                    <?php if (isAdmin()): ?>
                                    <li><a href="admin.php"><i class="fas fa-cog"></i> Admin Panel</a></li>
                                    <?php endif; ?>
                                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                </ul>
                            </div>
                            <?php else: ?>
                            <div class="auth-links">
                                <a href="login.php" class="login-link"><i class="fas fa-sign-in-alt"></i> Login</a>
                                <a href="register.php" class="register-link"><i class="fas fa-user-plus"></i>
                                    Register</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <div class="main-navigation">
            <div class="container">
                <nav class="navbar">
                    <!-- Logo -->
                    <a href="index.php" class="logo">
                        <span class="logo-text">TRAVEL<span class="logo-highlight">HABESHA</span></span>
                        <span class="logo-tagline">Discover Ethiopia</span>
                    </a>

                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-toggle" aria-label="Toggle navigation">
                        <span class="menu-icon"></span>
                        <span class="menu-icon"></span>
                        <span class="menu-icon"></span>
                    </button>

                    <!-- Navigation Links -->
                    <ul class="nav-menu">
                        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                        <li class="nav-item dropdown">
                            <a href="packages.php" class="nav-link">Packages <i class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="packages.php?type=cultural">Cultural Tours</a></li>
                                <li><a href="packages.php?type=adventure">Adventure Tours</a></li>
                                <li><a href="packages.php?type=historical">Historical Sites</a></li>
                                <li><a href="packages.php?type=nature">Nature & Wildlife</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="shop.php" class="nav-link">Shop</a></li>
                        <li class="nav-item"><a href="rentalcar.php" class="nav-link">Travel Cars</a></li>
                        <li class="nav-item"><a href="hotels.php" class="nav-link">Hotels</a></li>
                        <li class="nav-item"><a href="about.php" class="nav-link">About Us</a></li>

                        <li class="nav-item book-now">
                            <a href="book.php" class="btn-primary">
                                <i class="fas fa-paper-plane"></i> Book Now
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile Menu Toggle
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');

        mobileMenuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navMenu.contains(e.target) && e.target !== mobileMenuToggle) {
                mobileMenuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });

        // Dropdown functionality for mobile
        const dropdownToggles = document.querySelectorAll('.dropdown > .nav-link');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    const dropdown = this.parentElement;
                    const menu = dropdown.querySelector('.dropdown-menu');
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                }
            });
        });

        // User dropdown in top bar
        const userDropdownToggle = document.querySelector('.user-menu-dropdown > .user-avatar');
        if (userDropdownToggle) {
            userDropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.parentElement;
                const menu = dropdown.querySelector('.user-dropdown-menu');
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });

            // Close user dropdown when clicking outside
            document.addEventListener('click', function(e) {
                const userDropdown = document.querySelector('.user-menu-dropdown');
                if (userDropdown && !userDropdown.contains(e.target)) {
                    const menu = userDropdown.querySelector('.user-dropdown-menu');
                    menu.style.display = 'none';
                }
            });
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992) {
                const dropdownMenus = document.querySelectorAll('.dropdown-menu');
                dropdownMenus.forEach(menu => {
                    menu.style.display = '';
                });
            }
        });
    });
    </script>