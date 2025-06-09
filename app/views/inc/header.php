<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once APPROOT . '/helpers/session_helper.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Habesha</title>
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/header.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/footer.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/packages.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/hotels.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/cars.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/destinations.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/profile.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/booking.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/about.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/contact.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pages/auth.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&family=Sono:wght@400;500&display=swap"
        rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <header class="site-header">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-content">
                    <div class="top-bar-left">
                        <div class="language-selector">
                            <i class="fas fa-globe"></i>
                            <select>
                                <option value="en">English</option>
                                <option value="am">አማርኛ</option>
                            </select>
                        </div>
                        <div class="contact-info">
                            <a href="tel:+251912345678"><i class="fas fa-phone"></i> +251 91 234 5678</a>
                            <a href="mailto:info@travelhabesha.com"><i class="fas fa-envelope"></i>
                                info@travelhabesha.com</a>
                        </div>
                    </div>
                    <div class="top-bar-right">
                        <div class="social-links">
                            <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        <?php if (isLoggedIn()): ?>
                        <div class="user-menu-dropdown">
                            <div class="user-avatar">
                                <img src="<?php echo URLROOT . '/' . getUserAvatar($_SESSION['user_id']); ?>"
                                    alt="User Avatar">
                            </div>
                            <ul class="user-dropdown-menu">
                                <li><a href="<?php echo URLROOT; ?>/users/profile"><i class="fas fa-user"></i> My
                                        Profile</a></li>
                                <li><a href="<?php echo URLROOT; ?>/bookings"><i class="fas fa-calendar-check"></i> My
                                        Bookings</a></li>
                                <?php if (isAdmin()): ?>
                                <li><a href="<?php echo URLROOT; ?>/admin/dashboard"><i class="fas fa-cog"></i> Admin
                                        Panel</a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo URLROOT; ?>/users/logout"><i class="fas fa-sign-out-alt"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                        <?php else: ?>
                        <div class="auth-links">
                            <a href="<?php echo URLROOT; ?>/users/login" class="btn-login"><i
                                    class="fas fa-sign-in-alt"></i> Login</a>
                            <a href="<?php echo URLROOT; ?>/users/register" class="btn-register"><i
                                    class="fas fa-user-plus"></i> Register</a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="main-navigation">
            <div class="container">
                <div class="navbar">
                    <a href="<?php echo URLROOT; ?>" class="logo">
                        <span class="logo-text">Travel<span class="logo-highlight">Habesha</span></span>
                        <span class="logo-tagline">Discover Ethiopia</span>
                    </a>

                    <button class="mobile-menu-toggle" aria-label="Toggle Menu">
                        <span class="menu-icon"></span>
                        <span class="menu-icon"></span>
                        <span class="menu-icon"></span>
                    </button>

                    <ul class="nav-menu">
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/pages/index" class="nav-link">Home</a></li>
                        <li class="nav-item dropdown">
                            <a href="<?php echo URLROOT; ?>/packages" class="nav-link">Packages <i
                                    class="fas fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo URLROOT; ?>/packages/index?type=adventure"><i
                                            class="fas fa-mountain"></i> Adventure Tours</a></li>
                                <li><a href="<?php echo URLROOT; ?>/packages/index?type=cultural"><i
                                            class="fas fa-landmark"></i> Cultural Tours</a></li>
                                <li><a href="<?php echo URLROOT; ?>/packages/index?type=wildlife"><i
                                            class="fas fa-paw"></i> Wildlife Safaris</a></li>
                                <li><a href="<?php echo URLROOT; ?>/packages/index?type=religious"><i
                                            class="fas fa-pray"></i> Religious Tours</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/hotels/index" class="nav-link">Hotels</a>
                        </li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/cars/index" class="nav-link">Car Rental</a>
                        </li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/destinations/index"
                                class="nav-link">Destinations</a></li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/pages/about" class="nav-link">About Us</a>
                        </li>
                        <li class="nav-item"><a href="<?php echo URLROOT; ?>/pages/contact" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item book-now"><a href="<?php echo URLROOT; ?>/bookings/create"
                                class="btn-primary">Book Now</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php flash(); ?>

    <main>
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