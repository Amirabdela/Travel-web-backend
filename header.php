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
<<<<<<< HEAD
    <link rel="stylesheet" href="styles/header-footer.css">
=======
    <link rel="stylesheet" href="index.css">
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
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
<<<<<<< HEAD
=======
                        <div class="language-selector">
                            <i class="fas fa-globe"></i>
                            <select aria-label="Language selector">
                                <option value="en">English</option>
                                <option value="am">አማርኛ</option>
                            </select>
                        </div>

                        <div class="social-links">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                        </div>

>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
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

<<<<<<< HEAD
        // Dropdown Menus for Mobile
        const dropdownToggles = document.querySelectorAll('.nav-item.dropdown > .nav-link');
=======
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navMenu.contains(e.target) && e.target !== mobileMenuToggle) {
                mobileMenuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            }
        });

        // Dropdown functionality for mobile
        const dropdownToggles = document.querySelectorAll('.dropdown > .nav-link');
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                if (window.innerWidth <= 992) {
                    e.preventDefault();
<<<<<<< HEAD
                    const parent = this.parentElement;
                    parent.classList.toggle('active');
=======
                    const dropdown = this.parentElement;
                    const menu = dropdown.querySelector('.dropdown-menu');
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
                }
            });
        });

<<<<<<< HEAD
        // User Dropdown
=======
        // User dropdown in top bar
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
        const userDropdownToggle = document.querySelector('.user-menu-dropdown > .user-avatar');
        if (userDropdownToggle) {
            userDropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.parentElement;
                const menu = dropdown.querySelector('.user-dropdown-menu');
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
<<<<<<< HEAD
        }


        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            // Close mobile menu
            if (!navMenu.contains(e.target)) {
                mobileMenuToggle.classList.remove('active');
                navMenu.classList.remove('active');
            }

            // Close user dropdown
            const userDropdown = document.querySelector('.user-menu-dropdown');
            if (userDropdown && !userDropdown.contains(e.target)) {
                const menu = userDropdown.querySelector('.user-dropdown-menu');
                menu.style.display = 'none';
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });

                    // Close mobile menu if open
                    mobileMenuToggle.classList.remove('active');
                    navMenu.classList.remove('active');
                }
            });
        });

        const animateOnScroll = function() {
            const elements = document.querySelectorAll(
                '.destination-card, .package-card, .offer-card, .stat-item');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (elementPosition < windowHeight - 100) {
                    element.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        };

        // Run once on load
        animateOnScroll();

        // Run on scroll
        window.addEventListener('scroll', animateOnScroll);

        // Hero image parallax effect
        const hero = document.querySelector('.hero');
        if (hero) {
            window.addEventListener('scroll', function() {
                const scrollPosition = window.pageYOffset;
                hero.style.backgroundPositionY = scrollPosition * 0.5 + 'px';
            });
        }

        // Stats counter animation
        const statNumbers = document.querySelectorAll('.stat-number');
        if (statNumbers.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        statNumbers.forEach(number => {
                            const target = parseInt(number.textContent);
                            const duration = 2000;
                            const start = 0;
                            const increment = target / (duration / 16);

                            let current = start;
                            const timer = setInterval(() => {
                                current += increment;
                                if (current >= target) {
                                    clearInterval(timer);
                                    current = target;
                                }
                                number.textContent = Math.floor(
                                    current);
                            }, 16);
                        });
                        observer.disconnect();
                    }
                });
            }, {
                threshold: 0.5
            });

            observer.observe(document.querySelector('.stats-section'));
        }
=======

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
>>>>>>> 13a686bc9ac501ba73114b0c410598bdac9afd51
    });
    </script>