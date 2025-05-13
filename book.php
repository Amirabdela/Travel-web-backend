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
     <script src="mainJS/index2.js"></script>

     <!-- Header Section -->
     <header class="header-booknow">
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

 <body class="body-book">
     <div class="header-book">
         <h1>Book Your Adventure - Travel Habesa</h1>
         <div class="container-book">
             <h1>Book Now</h1>
             <form class="form-book" action="/submit-booking" method="post">
                 <!-- Personal Information -->
                 <div class="form-group-book">
                     <label for="name">Full Name</label>
                     <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                 </div>

                 <div class="form-group-book">
                     <label for="email">Email Address</label>
                     <input type="email" id="email" name="email" placeholder="Enter your email" required>
                 </div>

                 <div class="form-group-book">
                     <label for="phone">Phone Number</label>
                     <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                 </div>

                 <!-- Booking Details -->
                 <div class="form-group-book">
                     <label for="destination">Destination</label>
                     <select id="destination" name="destination" required>
                         <option value="">Select a destination</option>
                         <option value="simien-mountains">Simien Mountains</option>
                         <option value="lalibela">Lalibela</option>
                         <option value="danakil-depression">Danakil Depression</option>
                         <option value="gondar">Gondar</option>
                     </select>
                 </div>

                 <div class="form-group-inline-book">
                     <div class="form-group-book">
                         <label for="start-date">Start Date</label>
                         <input type="date" id="start-date" name="start-date" required>
                     </div>
                     <div class="form-group-book">
                         <label for="end-date">End Date</label>
                         <input type="date" id="end-date" name="end-date" required>
                     </div>
                 </div>

                 <div class="form-group-book">
                     <label for="guests">Number of Guests</label>
                     <input type="number" id="guests" name="guests" min="1" max="20"
                         placeholder="Enter number of guests" required>
                 </div>

                 <!-- Additional Notes -->
                 <div class="form-group-book">
                     <label for="notes">Special Requests or Notes</label>
                     <textarea id="notes" name="notes" rows="5" placeholder="Enter any special requests"></textarea>
                 </div>

                 <!-- Submit Button -->
                 <button type="submit">Submit Booking</button>
             </form>
         </div>

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