<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sono:wght@200..800&display=swap" rel="stylesheet">
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
          <li class="nav-links"><a href="index.html">Home</a></li>
          <li class="nav-links"><a href="packages.html">Packages</a></li>
          <li class="nav-links"><a href="shop.html">shop</a></li>
          <li class="nav-links"><a href="rentalcar.html">Travel Cars</a></li>
          <li class="nav-links"><a href="about.html">About Us</a></li>
          <li class="nav-links"><a href="hotels.html">hotels</a></li>
          <li class="book-now"><a href="book.html">Book Now</a> </li>
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
          <p>Explore Axum’s obelisks, royal tombs, and the legendary Ark of the Covenant, delving into Ethiopia’s history.</p>
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
          <p>The Simien Mountains are a UNESCO site, known for dramatic landscapes, wildlife, and trekking opportunities.</p>
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
          <p>Beynouna Village is a new development in Ethiopia, designed for modern living, sustainability, and cultural heritage.</p>
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
          <p>Haile Resort offers luxurious accommodations, and recreational activities, perfect for relaxation and tourism.</p>
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
          <p>Entoto offers scenic views, historical sites, hiking trails, and the famous Entoto Maryam Church near Addis Ababa.</p>
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
          <p>Adwa Museum displays artifacts and history of the 1896 Battle of Adwa, symbolizing Ethiopia's victory and resistance.</p>
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
              <input type="text" size="40" maxlength="400" >
              <input type="submit" value="send" >
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
=======
<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</body>

</html>
>>>>>>> aa0917b605de5a0ceab4209cd0f429ad664d9daf
g