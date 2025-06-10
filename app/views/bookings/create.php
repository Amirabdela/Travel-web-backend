<?php
require_once APPROOT . '/helpers/session_helper.php';
require_once APPROOT . '/config/config.php';

// Initialize SQLite database connection
try {
    $pdo = new PDO('sqlite:' . DB_NAME);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

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
        $name = $user['full_name'] ?? '';
        $email = $user['email'] ?? '';
        $phone = $user['phone'] ?? '';
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
            
            // Redirect to success page
            header("Location: " . URLROOT . "/bookings/success?booking_id=" . $pdo->lastInsertId());
            exit();
        } catch (PDOException $e) {
            $error = "Booking failed: " . $e->getMessage();
        }
    }
}

// Get destinations for dropdown
$stmt = $pdo->query("SELECT * FROM destinations ORDER BY name");
$destinations = $stmt->fetchAll();

// Load header
require_once APPROOT . '/views/inc/header.php';
?>

<div class="booking-container">
    <h1>Book Your Adventure</h1>

    <?php if (isset($error)): ?>
    <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if ($package): ?>
    <div class="package-summary">
        <h3>You're booking: <?php echo $package['title']; ?></h3>
        <p>Destination: <?php echo $package['destination_name']; ?></p>
        <p>Duration: <?php echo $package['duration_days']; ?> days</p>
        <p>Price: $<?php echo number_format($package['price'], 2); ?></p>
    </div>
    <?php endif; ?>

    <form class="booking-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            <span class="error"><?php echo $nameErr; ?></span>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            <span class="error"><?php echo $emailErr; ?></span>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" required>
            <span class="error"><?php echo $phoneErr; ?></span>
        </div>

        <div class="form-group">
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
            <span class="error"><?php echo $destinationErr; ?></span>
        </div>

        <div class="form-group">
            <label for="start-date">Start Date</label>
            <input type="date" id="start-date" name="start-date" value="<?php echo $start_date; ?>" required>
        </div>

        <div class="form-group">
            <label for="end-date">End Date</label>
            <input type="date" id="end-date" name="end-date" value="<?php echo $end_date; ?>" required>
        </div>
        <span class="error"><?php echo $dateErr; ?></span>

        <div class="form-group">
            <label for="guests">Number of Guests</label>
            <input type="number" id="guests" name="guests" value="<?php echo $guests; ?>" min="1" max="20" required>
            <span class="error"><?php echo $guestsErr; ?></span>
        </div>

        <div class="form-group">
            <label for="notes">Special Requests</label>
            <textarea id="notes" name="notes" rows="4"><?php echo $notes; ?></textarea>
        </div>

        <button type="submit" class="btn-primary">Complete Booking</button>
    </form>
</div>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>