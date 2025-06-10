<?php
require_once 'connect.php';
require_once 'includes/auth_functions.php';

// Redirect if not admin
redirectIfNotAdmin();

// Get stats for dashboard
$stats = [
    'bookings' => $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn(),
    'users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
    'packages' => $pdo->query("SELECT COUNT(*) FROM packages")->fetchColumn(),
    'revenue' => $pdo->query("SELECT SUM(p.price) FROM bookings b JOIN packages p ON b.package_id = p.id")->fetchColumn()
];

// Get recent bookings
$stmt = $pdo->query("
    SELECT b.*, u.username, p.title as package_title 
    FROM bookings b
    LEFT JOIN users u ON b.user_id = u.id
    LEFT JOIN packages p ON b.package_id = p.id
    ORDER BY b.created_at DESC LIMIT 5
");
$recentBookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Travel Habesha</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    .admin-container {
        display: grid;
        grid-template-columns: 250px 1fr;
        min-height: 100vh;
    }

    .admin-sidebar {
        background: #2c3e50;
        color: white;
        padding: 20px;
    }

    .admin-content {
        padding: 20px;
    }

    .stat-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .stat-card h3 {
        margin-top: 0;
        color: #555;
    }

    .stat-card .value {
        font-size: 2em;
        font-weight: bold;
        color: #2c3e50;
    }

    .recent-table {
        width: 100%;
        border-collapse: collapse;
    }

    .recent-table th,
    .recent-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .recent-table th {
        background: #f5f5f5;
    }

    .status-pending {
        color: #e67e22;
    }

    .status-confirmed {
        color: #27ae60;
    }

    .status-cancelled {
        color: #e74c3c;
    }
    </style>
</head>

<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <h2>Admin Dashboard</h2>
            <ul>
                <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="admin-packages.php"><i class="fas fa-suitcase"></i> Packages</a></li>
                <li><a href="admin-destinations.php"><i class="fas fa-map-marker-alt"></i> Destinations</a></li>
                <li><a href="admin-hotels.php"><i class="fas fa-hotel"></i> Hotels</a></li>
                <li><a href="admin-cars.php"><i class="fas fa-car"></i> Rental Cars</a></li>
                <li><a href="admin-bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a></li>
                <li><a href="admin-users.php"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="admin-messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="index.php"><i class="fas fa-home"></i> Back to Site</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <h1>Dashboard Overview</h1>

            <!-- Stats Cards -->
            <div class="stat-cards">
                <div class="stat-card">
                    <h3>Total Bookings</h3>
                    <div class="value"><?php echo $stats['bookings']; ?></div>
                </div>

                <div class="stat-card">
                    <h3>Registered Users</h3>
                    <div class="value"><?php echo $stats['users']; ?></div>
                </div>

                <div class="stat-card">
                    <h3>Travel Packages</h3>
                    <div class="value"><?php echo $stats['packages']; ?></div>
                </div>

                <div class="stat-card">
                    <h3>Total Revenue</h3>
                    <div class="value">$<?php echo number_format($stats['revenue'] ?: 0, 2); ?></div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <h2>Recent Bookings</h2>
            <table class="recent-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Package</th>
                        <th>Dates</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentBookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking['id']; ?></td>
                        <td><?php echo $booking['username'] ?: 'Guest'; ?></td>
                        <td><?php echo $booking['package_title'] ?: 'Custom'; ?></td>
                        <td><?php echo date('M d, Y', strtotime($booking['start_date'])); ?> to
                            <?php echo date('M d, Y', strtotime($booking['end_date'])); ?></td>
                        <td><?php echo $booking['guests']; ?></td>
                        <td class="status-<?php echo $booking['status']; ?>"><?php echo ucfirst($booking['status']); ?>
                        </td>
                        <td>
                            <a href="admin-booking.php?id=<?php echo $booking['id']; ?>" class="btn-small">View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>