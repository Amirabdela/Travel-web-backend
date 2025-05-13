<!DOCTYPE html>
<html lang="en">

<head>
    <title>Travel Habesha</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sono:wght@200..800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="mainJS/index.js"></script>
</head>

<body>
    <!-- Header Section -->
    <section class="animate__animated animate__slideInLeft anim">
        <div class="home-w animate__animated animate__pulse">
            <p>only until
                <br>11.2.25
            </p>
        </div>
        <div class="pack-va">
            <p class="pack-sale"> PACKAGE
                <br>
                SALE
                <br>
                -50%
                <br>
                <a href="shop.html">shop now</a>
            </p>
        </div>
    </section>
    <header>
        <!-- Top Bar -->
        <div class="top-bar">
            <!-- Container for social icons and right links -->
            <div class="con">
                <!-- Social icons and language options -->
                <div class="socials">
                    <i class="fa-solid fa-earth-africa"></i><span class="lang">LANGUAGES</span>
                    <i class="fa-solid fa-share-nodes"></i><span class="lang">OUR SOCIALS</span>
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-pinterest-p"></i>
                </div>
                <!-- Right side links (Tour Packages and Contact Us) -->
                <div class="right-links">
                    <a class="fav" href="#"><i class="fa-regular fa-star"></i>TOUR PACKAGES</a>
                    <a class="contact" href="#"><i class="fa-solid fa-location-dot"></i>CONTACT US</a>
                </div>
            </div>
        </div>

        <!-- Navigation Bar -->
        <div class="nav-bar">
            <nav>
                <!-- Logo and menu icon for small screens -->
                <div class="logo" id="logo">
                    <strong">TRAVEL HABESHA.</strong>
                        <i class="small-block fas fa-bars menu-icon"></i>
                </div>
                <!-- Navigation links -->
                <ul>
                    <li class="nav-links"><a href="../Travel-web-backend/index.php">Home</a></li>
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
    <!-- sidebar -->
    <div id="sidebar" class="sidebar">
        <a href="signIn.html" class="sidebar-header">
            <i class="fa-solid fa-user-large"></i>
            <span>Hello, sign in</span>
        </a>
        <div class="sidebar-sections">
            <!-- Travel Packages -->
            <div class="sidebar-section">
                <h4>Travel Packages</h4>
                <ul>
                    <li class="sidebar-list">Adventure Tours<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Cultural Tours<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Luxury Getaways<i class="fa-solid fa-angle-right arrow"></i></li>
                </ul>
            </div>
            <!-- Travel Destinations -->
            <div class="sidebar-section">
                <h4>Explore by Destination</h4>
                <ul>
                    <li class="sidebar-list">Ethiopia<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Africa<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Asia<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Europe<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="see-all-toggle ">See all<i class="fa-solid fa-chevron-down arrow"></i></li>
                    <div class="hidden-lists">
                        <li class="sidebar-list">North America<i class="fa-solid fa-angle-right arrow"></i></li>
                        <li class="sidebar-list">South America<i class="fa-solid fa-angle-right arrow"></i></li>
                        <li class="sidebar-list">Oceania<i class="fa-solid fa-angle-right arrow"></i></li>
                        <li class="see-less-toggle ">See less<i class="fa-solid fa-chevron-up arrow"></i></li>
                    </div>
                </ul>
            </div>
            <!-- Travel Services -->
            <div class="sidebar-section">
                <h4>Travel Services</h4>
                <ul>
                    <li class="sidebar-list">Flight Bookings<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Hotel Reservations<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Car Rentals<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Travel Insurance<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="see-all-toggle-two">See all<i class="fa-solid fa-chevron-down arrow"></i></li>
                    <div class="hidden-lists-two">
                        <li class="sidebar-list">Cruise Bookings</li>
                        <li class="see-less-toggle-two">See less<i class="fa-solid fa-chevron-up arrow"></i></li>
                    </div>
                </ul>
            </div>
            <!-- Travel Tips & Resources -->
            <div class="sidebar-section">
                <h4>Travel Tips & Resources</h4>
                <ul>
                    <li class="sidebar-list">Travel Blogs<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Travel Guides<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Packing Tips<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Currency Converters<i class="fa-solid fa-angle-right arrow"></i></li>
                    <li class="sidebar-list">Travel Safety<i class="fa-solid fa-angle-right arrow"></i></li>
                </ul>
            </div>
            <!-- Help & Settings -->
            <div class="sidebar-section">
                <h4>Help & Settings</h4>
                <ul>
                    <li class="sidebar-help"><a href="#">Your Account</a></li>
                    <li class="sidebar-help sidebar-help-LN"><i class="fa-solid fa-globe"></i>English</li>
                    <li class="sidebar-help sidebar-help-LN"><img src="../images/flags/ethiopia_flag.png"
                            alt="Ethiopia Flag" />Ethiopia</li>
                    <li class="sidebar-help"><a href="customerService.html">Customer Service</a></li>
                    <li class="sidebar-help sidebar-help-last"><a href="signIn.html">Sign in</a></li>
                </ul>
            </div>
        </div>
    </div>

    <button class="close-btn" id="closeBtn">&times;</button>

    <!-- Overlay (Darkens the rest of the page when the sidebar is active) -->
    <div id="overlay" class="overlay"></div>

    <!-- Cards Section -->
    <section class="home">
        <div></div>
    </section>

    <p class="our-d">our <u>destinations</u></p>
    <section class="destination">
        <div class="di1">
            <!-- Container for destination information for Addis Ababa -->
            <div class="dp1">
                <p>addis ababa<br>4-packages</p>
            </div>
            <div>
                <!-- Beynouna village package -->
                <div class="small-d">
                    <img src="assets/dp5.jpg">
                    <div>
                        <p class="ccc1">Beynouna village<br>
                        <p class="small-dp"><i class="fa-solid fa-location-dot"></i>oromia </p>
                        <a href="book.html">
                            <p class="from">from 150$</p>
                        </a>
                        </p>
                    </div>
                </div>
                <!-- Haile resort package -->
                <div class="small-d">
                    <img src="assets/dp6.jpg">
                    <div>
                        <p>haile resort<br>
                        <p class="small-dp"><i class="fa-solid fa-location-dot"></i>arba minch</p>
                        <a href="book.html">
                            <p class="from">from 150$</p>
                        </a>
                        </p>
                    </div>
                </div>
                <!-- Entoto package -->
                <div class="small-d">
                    <img src="assets/dp7.jpg">
                    <div>
                        <p>entoto<br>
                        <p class="small-dp"><i class="fa-solid fa-location-dot"></i>addis ababa</p>
                        <a href="book.html">
                            <p class="from">from 20$</p>
                        </a>
                        </p>
                    </div>
                </div>
                <!-- Adwa museum package -->
                <div class="small-d">
                    <img src="assets/dp10.jpg">
                    <div>
                        <p>adwa museum<br>
                        <p class="small-dp"><i class="fa-solid fa-location-dot"></i>addis ababa</p>
                        <p class="from">from 50$</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="di2">
            <!-- Container for destination information for Gonder -->
            <div class="dp2">
                <p>gonder<br>2-packages</p>
            </div>
            <div>
                <!-- Jugole package -->
                <div class="small-d">
                    <img src="assets/dp2.jpg">
                    <div>
                        <p class="ccc1">Jugole<br>
                        <p class="small-dp"><i class="fa-solid fa-location-dot"></i>harar</p>
                        <a href="book.html">
                            <p class="from">from 142$</p>
                        </a>
                        </p>
                    </div>
                </div>
                <!-- Axum package -->
                <div class="small-d">
                    <img src="assets/axum1.jpg">
                    <div>
                        <p>axum<br>
                        <p class="small-dp"><i class="fa-solid fa-location-dot"></i>tigray</p>
                        <p class="from">from 122$</p>
                        </p>
                    </div>
                </div>
                <!-- Lalibela package -->
                <div class="small-d">
                    <img src="assets/lalibela.jpg">
                    <div>
                        <p>lalibela<br>
                        <p class="small-dp"><i class="fa-solid fa-location-dot"></i>gonder</p>
                        <p class="from">from 150$</p>
                        </p>
                    </div>
                </div>
                <!-- Danakil package -->
                <div class="small-d">
                    <img src="assets/dp3.jpg">
                    <div>
                        <p>Danakil<br>
                        <p class="small-dp"><i class="fa-solid fa-location-dot"></i>afar</p>
                        <p class="from">from 250$</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>

        <section>

        </section>

    </section>

    <section class="index-back">
        <!-- Title of the section -->
        <p> OUR Destinations</p>

        <!-- Container for the search form -->
        <div class="search-index">
            <div class="search-form-index">

                <!-- Destination selection dropdown -->
                <div class="form-groupi">
                    <label for="destination">Destinations</label>
                    <select id="destination">
                        <option>All Destinations</option>
                        <option></option>
                        <option></option>
                        <option></option>
                    </select>
                </div>

                <!-- Typology selection dropdown -->
                <div class="form-groupi">
                    <label for="destination">TYPOLOGY</label>
                    <select id="destination">
                        <option>All Typologies</option>
                        <option></option>
                        <option></option>
                        <option></option>
                    </select>
                </div>

                <!-- Duration selection dropdown -->
                <div class="form-groupi">
                    <label for="destination">DURATIONS</label>
                    <select id="destination">
                        <option>All Durations</option>
                        <option></option>
                        <option></option>
                        <option></option>
                    </select>
                </div>

                <!-- Difficulty selection dropdown -->
                <div class="form-groupi">
                    <label for="destination">DIFFICULTY</label>
                    <select id="destination">
                        <option>All Difficulty</option>
                        <option></option>
                        <option></option>
                        <option></option>
                    </select>
                </div>

                <!-- Minimum age selection dropdown -->
                <div class="form-groupi">
                    <label for="destination">MIN AGE</label>
                    <select id="destination">
                        <option>All Min Age</option>
                        <option></option>
                        <option></option>
                        <option></option>
                    </select>
                </div>

                <!-- Search button -->
                <div class="form-groupi">
                    <div class="search-i">search</div>
                </div>
            </div>
        </div>
    </section>

    <section>

    </section>

    <section>
        <div class="index-img">
            <div class="year">
                <p> <span style="font-size: 34px;">30</span> years of experience</p>
                <p> <span style="font-size: 34px;">78</span>satisfied customer</p>
                <p> <span style="font-size: 34px;">8</span>type of insurance</p>
                <p> <span style="font-size: 34px;">17</span>travel destinations</p>
            </div>
        </div>
    </section>
    <section>


    </section>

    <!-- Footer -->
    <div class="footer-container">
        <div class="keep">
            <h3>keep in touch</h3>
            <div class="with-us">
                <h2>travel with us</h2>
                <div>
                    <input type="text" size="40" maxlength="400">
                    <input type="submit" value="send">
                </div>

            </div>
        </div>
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-p">
                    <h4 id="log">Travel Habesha</h4>
                    <p>Discover the best travel spots,
                        with hassle-free booking and
                        expert recommendations to make your adventures
                        unforgettable.
                    </p>
                </div>
                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="./index.html">Home</a></li>
                        <li><a href="./packages.html">Packages</li></a>
                        <li><a href="./hotels.html">Hotels</li></a>
                        <li><a href="./rentalcar.html">Travel Cars</a></li>
                        <li><a href="./about.html"> About Us</li></a>

                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Resources</h4>
                    <ul>
                        <li>Blog</li>
                        <li>Privacy Policy</li>
                        <li>Terms & Conditions</li>
                        <li>FAQs</li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Last Minute</h4>
                    <ul>
                        <li>Weekend Deals</li>
                        <li>Family Packages</li>
                        <li>Group Discounts</li>
                        <li>Limited Offers</li>
                    </ul>
                </div>

        </footer>
        <div class="footer-bottom">
            <p>The Best Travel Platform for Exploring Ethiopia</p>
            <p>Launched in 2024</p>
        </div>
    </div>
    </div>
</body>

</html>