<?php
include 'connect.php';

// Get and sanitize form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$destination = $_POST['destination'] ?? '';
$start_date = $_POST['start-date'] ?? '';
$end_date = $_POST['end-date'] ?? '';
$guests = $_POST['guests'] ?? '';
$notes = $_POST['notes'] ?? '';

// Basic validation
if (!$name || !$email || !$phone || !$destination || !$start_date || !$end_date || !$guests) {
    die("All fields are required.");
}

// Insert into the database
$stmt = $pdo->prepare("
    INSERT INTO bookings (name, email, phone, destination, start_date, end_date, guests, notes)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

try {
    $stmt->execute([$name, $email, $phone, $destination, $start_date, $end_date, $guests, $notes]);
    echo "<h2>Thank you for your booking, $name!</h2>";
    echo "<p>We have received your request to travel to <strong>$destination</strong> from $start_date to $end_date for $guests guest(s).</p>";
    echo "<a href='book.php'>Back to Booking</a>";
} catch (PDOException $e) {
    die("Booking failed: " . $e->getMessage());
}
?>