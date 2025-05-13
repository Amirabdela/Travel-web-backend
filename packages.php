<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sono:wght@200..800&display=swap"
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
<!-- Hero Section -->
<section class="hero">
    <div class="hero-all">
        <div class="hero-padding"><span id="our">OUR PACKAGES</span>
            <h2>Search your Holiday</h2>
        </div>
        <div class="search">
            <div class="search-form">
                <!-- Destination Dropdown -->
                <div class="form-group">
                    <label for="destination">Select Your Destination:</label>
                    <select id="destination">
                        <option>All Destinations</option>
                        <option>Paris</option>
                        <option>New York</option>
                        <option>Tokyo</option>
                    </select>
                </div>

                <!-- Date Picker -->
                <div class="form-group">
                    <label for="date">Select Your Date:</label>
                    <input type="date" id="date" />
                </div>

                <!-- Price Slider -->
                <div class="form-group">
                    <div class="price-v">
                        <label for="price">Max Price:</label>
                        <span class="price-value">2500 $</span>
                    </div>
                    <div class="price-range">
                        <input type="range" id="price" min="0" max="5000" step="100" value="2500" />
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" id="promotions">
                        <label for="promotions">See only promotions</label>
                    </div>
                </div>

                <!-- More Filters Button -->

            </div>
            <div class="more-filters">
                <button>
                    <i class="fa-solid fa-filter"></i> More Filters
                </button>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Cards Section -->
<section class="cards">
    <div class="card">
        <img src="assets/lalibela.jpg" alt="Lalibela">
        <div class="card-content">
            <h3>Lalibela</h3>
            <div class="i-city"><i class="fa-solid fa-location-dot"></i><span class="city">bahir dar</span></div>
            <div class="cult">
                <div>
                    <h6>cultural</h6>
                    <h6>relax</h6>
                </div>
                <h2>700$</h2>
            </div>
            <p>Visit Lalibela's iconic rock-hewn churches,
                an ancient architectural wonder and UNESCO World Heritage site.
            </p>
            <button class="detail"><a href="details.html">DETAILS</a></button>
        </div>
    </div>
    <div class="card">
        <img src="assets/axum4.jpg" alt="Lalibela">
        <div class="card-content">
            <h3>Axum</h3>
            <div class="i-city"><i class="fa-solid fa-location-dot"></i><span class="city">mekele</span></div>
            <div class="cult">
                <div>
                    <h6>historical</h6>
                    <h6>town</h6>
                </div>
                <h2>120$</h2>
            </div>
            <p>Explore Axum’s obelisks, royal tombs, and the legendary Ark of the Covenant, delving into Ethiopia’s
                history.</p>
            <button class="detail"><a href="detailss.html">DETAILS</a></button>
        </div>
    </div>
    <div class="card">
        <img src="assets/harar.jpg" alt="Lalibela">
        <div class="card-content">
            <h3>Harar</h3>
            <div class="i-city"><i class="fa-solid fa-location-dot"></i><span class="city">harar</span></div>
            <div class="cult">
                <div>
                    <h6>cultural</h6>
                    <h6>holiday</h6>
                </div>
                <h2>180$</h2>
            </div>
            <p>Shawal Eid celebrates the end of Ramadan with prayers, feasts, charity, and community gatherings.</p>
            <button class="detail"><a href="">DETAILS</a></button>
        </div>
    </div>
    <div class="card">
        <img src="assets/Simien-Mountains-Ethiopia.jpg" alt="Lalibela">
        <div class="card-content">
            <h3>Simien-Mountains</h3>
            <div class="i-city"><i class="fa-solid fa-location-dot"></i><span class="city">bale oromia</span></div>
            <div class="cult">
                <div>
                    <h6>relax </h6>
                    <h6>sport</h6>
                </div>
                <h2>148$</h2>
            </div>
            <p>The Simien Mountains are a UNESCO site, known for dramatic landscapes, wildlife, and trekking
                opportunities.</p>
            <button class="detail"><a href="">DETAILS</a></button>
        </div>
    </div>
    <div class="card">
        <img src="assets/dp5.jpg" alt="Lalibela">
        <div class="card-content">
            <h3>Beynouna Village</h3>
            <div class="i-city"><i class="fa-solid fa-location-dot"></i><span class="city">oromia</span></div>
            <div class="cult">
                <div>
                    <h6>cultural</h6>
                    <h6>relax</h6>
                </div>
                <h2>211$</h2>
            </div>
            <p>Beynouna Village is a new development in Ethiopia, designed for modern living, sustainability, and
                cultural heritage.</p>
            <button class="detail"><a href="">DETAILS</a></button>
        </div>
    </div>
    <div class="card">
        <img src="assets/dp6.jpg" alt="Lalibela">
        <div class="card-content">
            <h3>haile resort</h3>
            <div class="i-city"><i class="fa-solid fa-location-dot"></i><span class="city">adama</span></div>
            <div class="cult">
                <div>
                    <h6>cultural</h6>
                    <h6>relax</h6>
                </div>
                <h2>220$</h2>
            </div>
            <p>Haile Resort offers luxurious accommodations, and recreational activities, perfect for relaxation and
                tourism.</p>
            <button class="detail"><a href="">DETAILS</a></button>
        </div>
    </div>
    <div class="card">
        <img src="assets/dp7.jpg" alt="Lalibela">
        <div class="card-content">
            <h3>entoto</h3>
            <div class="i-city"><i class="fa-solid fa-location-dot"></i><span class="city">addis ababa</span></div>
            <div class="cult">
                <div>
                    <h6>cultural</h6>
                    <h6>relax</h6>
                </div>
                <h2>700$</h2>
            </div>
            <p>Entoto offers scenic views, historical sites, hiking trails, and the famous Entoto Maryam Church near
                Addis Ababa.</p>
            <button class="detail"><a href="">DETAILS</a></button>
        </div>
    </div>
    <div class="card">
        <img src="assets/dp10.jpg" alt="Lalibela">
        <div class="card-content">
            <h3>adwa museume</h3>
            <div class="i-city"><i class="fa-solid fa-location-dot"></i><span class="city">addis ababa</span></div>
            <div class="cult">
                <div>
                    <h6>cultural</h6>
                    <h6>relax</h6>
                </div>
                <h2>70$</h2>
            </div>
            <p>Adwa Museum displays artifacts and history of the 1896 Battle of Adwa, symbolizing Ethiopia's victory and
                resistance.</p>
            <button class="detail"><a href="">DETAILS</a></button>
        </div>
    </div>

</section>
<!-- Footer -->
<div class="footer-container-pack">
    <div class="keep">
        <h3>keep in touch</h3>
        <div class="with-us">
            <h2>travel with us</h2>
            <div class="sendw">
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