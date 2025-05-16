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
                <input type="number" id="guests" name="guests" min="1" max="20" placeholder="Enter number of guests" required>
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

$name = $email = $phone = $destination = $start_date = $end_date = $guests = $notes = "";
$nameErr = $emailErr = $phoneErr = $destinationErr = $dateErr = $guestsErr = "";
$package = null;
$package_id = $_GET['package'] ?? 0;

// Get package details if package_id is provided
if ($package_id) {
    $stmt = $pdo->prepare("
        SELECT p.*, d.name as destination_name 
        FROM packages p
        JOIN destinations d ON p.destination_id = d.id
        WHERE p.id = ?
    ");
    $stmt->execute([$package_id]);
    $package = $stmt->fetch();
    
    if ($package) {
        $destination = $package['destination_name'];
    }
}

// If user is logged in, pre-fill their details
if (isLoggedIn()) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    if ($user) {
        $name = $user['full_name'];
        $email = $user['email'];
        $phone = $user['phone'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = cleanInput($_POST["name"]);
    $email = cleanInput($_POST["email"]);
    $phone = cleanInput($_POST["phone"]);
    $destination = cleanInput($_POST["destination"]);
    $start_date = $_POST["start-date"];
    $end_date = $_POST["end-date"];
    $guests = cleanInput($_POST["guests"]);
    $notes = cleanInput($_POST["notes"]);
    $package_id = cleanInput($_POST["package_id"]);

    // Validate inputs
    if (empty($name)) {
        $nameErr = "Name is required";
    }

    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (empty($phone)) {
        $phoneErr = "Phone number is required";
    }

    if (empty($destination)) {
        $destinationErr = "Please select a destination";
    }

    if (empty($start_date) || empty($end_date)) {
        $dateErr = "Both start and end dates are required";
    } elseif ($start_date > $end_date) {
        $dateErr = "Start date must be before end date";
    }

    if (empty($guests)) {
        $guestsErr = "Please enter number of guests";
    } elseif ((int)$guests <= 0 || (int)$guests > 20) {
        $guestsErr = "Guests must be between 1 and 20";
    }

    // If all valid, process booking
    if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && 
        empty($destinationErr) && empty($dateErr) && empty($guestsErr)) {
        
        try {
            $user_id = isLoggedIn() ? $_SESSION['user_id'] : null;
            
            $stmt = $pdo->prepare("
                INSERT INTO bookings (user_id, package_id, start_date, end_date, guests, special_requests)
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            
            $stmt->execute([
                $user_id,
                $package_id ?: null,
                $start_date,
                $end_date,
                $guests,
                $notes
            ]);
            
            // Send confirmation email (pseudo-code)
            // sendConfirmationEmail($email, $name, $booking_details);
            
            // Redirect to success page
            header("Location: booking-success.php?booking_id=" . $pdo->lastInsertId());
            exit();
        } catch (PDOException $e) {
            $error = "Booking failed: " . $e->getMessage();
        }
    }
}

// Get destinations for dropdown
$stmt = $pdo->query("SELECT * FROM destinations ORDER BY name");
$destinations = $stmt->fetchAll();
require_once __DIR__ . '/includes/header.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Now - Travel Habesha</title>
    <link rel="stylesheet" href="index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins&family=Sono&display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <style>
    .error-message {
        color: red;
        font-size: 0.9em;
        margin-top: 4px;
        display: block;
    }
    </style>
</head>

<body class="body-book">
    <!-- Header -->
    <!-- Booking Form -->
    <div class="header-book">
        <h1>Book Your Adventure - Travel Habesha</h1>
        <div class="container-book">
            <h1>Book Now</h1>

            <?php if (isset($error)): ?>
            <p style="color: red; font-weight: bold;"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if ($package): ?>
            <div class="package-summary">
                <h3>You're booking: <?php echo $package['title']; ?></h3>
                <p>Destination: <?php echo $package['destination_name']; ?></p>
                <p>Duration: <?php echo $package['duration_days']; ?> days</p>
                <p>Price: $<?php echo number_format($package['price'], 2); ?></p>
            </div>
            <?php endif; ?>

            <form class="form-book" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">

                <div class="form-group-book">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>"
                        placeholder="Enter your full name" required>
                    <span class="error-message"><?php echo $nameErr; ?></span>
                </div>

                <div class="form-group-book">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>"
                        placeholder="Enter your email" required>
                    <span class="error-message"><?php echo $emailErr; ?></span>
                </div>

                <div class="form-group-book">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>"
                        placeholder="Enter your phone number" required>
                    <span class="error-message"><?php echo $phoneErr; ?></span>
                </div>

                <div class="form-group-book">
                    <label for="destination">Destination</label>
                    <select id="destination" name="destination" required>
                        <option value="">Select a destination</option>
                        <?php foreach ($destinations as $dest): ?>
                        <option value="<?php echo $dest['name']; ?>"
                            <?php echo ($destination == $dest['name']) ? 'selected' : ''; ?>>
                            <?php echo $dest['name']; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="error-message"><?php echo $destinationErr; ?></span>
                </div>

                <div class="form-group-inline-book">
                    <div class="form-group-book">
                        <label for="start-date">Start Date</label>
                        <input type="date" id="start-date" name="start-date" value="<?php echo $start_date; ?>"
                            required>
                    </div>
                    <div class="form-group-book">
                        <label for="end-date">End Date</label>
                        <input type="date" id="end-date" name="end-date" value="<?php echo $end_date; ?>" required>
                    </div>
                    <span class="error-message"><?php echo $dateErr; ?></span>
                </div>

                <div class="form-group-book">
                    <label for="guests">Number of Guests</label>
                    <input type="number" id="guests" name="guests" value="<?php echo $guests; ?>" min="1" max="20"
                        placeholder="Enter number of guests" required>
                    <span class="error-message"><?php echo $guestsErr; ?></span>
                </div>

                <div class="form-group-book">
                    <label for="notes">Special Requests or Notes</label>
                    <textarea id="notes" name="notes" rows="5"
                        placeholder="Enter any special requests"><?php echo $notes; ?></textarea>
                </div>

                <button type="submit">Submit Booking</button>
            </form>
        </div>
    </div>

    <!-- Footer -->

</body>

</html>
>>>>>>> aa0917b605de5a0ceab4209cd0f429ad664d9daf
