<?php
// admin/dashboard.php
session_start();
require_once __DIR__ . '/../includes/connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Travel Habesha</title>
</head>

<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> (Admin)</h1>
    <p><a href="../auth/logout.php">Logout</a></p>

    <h2>Manage Content</h2>
    <ul>
        <li><a href="add_destination.php">Add Destination</a></li>
        <li><a href="view_bookings.php">View Bookings</a></li>
        <li><a href="view_messages.php">View Messages</a></li>
        <!-- Add more admin links here -->
    </ul>
</body>

</html>