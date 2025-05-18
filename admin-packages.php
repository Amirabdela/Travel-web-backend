<?php
require_once 'connect.php';
require_once 'auth.php';

// Redirect if not admin
redirectIfNotAdmin();

// Handle package deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM packages WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin-packages.php?deleted=1");
    exit();
}

// Get all packages with destination info
$stmt = $pdo->query("
    SELECT p.*, d.name as destination_name 
    FROM packages p
    JOIN destinations d ON p.destination_id = d.id
    ORDER BY p.created_at DESC
");
$packages = $stmt->fetchAll();

// Get destinations for dropdown
$stmt = $pdo->query("SELECT id, name FROM destinations ORDER BY name");
$destinations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages - Admin Panel</title>
    <link rel="stylesheet" href="../styles.css">
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

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .data-table th,
    .data-table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .data-table th {
        background: #f5f5f5;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
    }

    .btn-primary {
        background: #3498db;
        color: white;
    }

    .btn-danger {
        background: #e74c3c;
        color: white;
    }

    .btn-success {
        background: #27ae60;
        color: white;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .alert {
        padding: 10px 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
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
                <li><a href="admin-packages.php" class="active"><i class="fas fa-suitcase"></i> Packages</a></li>
                <li><a href="admin-destinations.php"><i class="fas fa-map-marker-alt"></i> Destinations</a></li>
                <li><a href="admin-hotels.php"><i class="fas fa-hotel"></i> Hotels</a></li>
                <li><a href="admin-cars.php"><i class="fas fa-car"></i> Rental Cars</a></li>
                <li><a href="admin-bookings.php"><i class="fas fa-calendar-check"></i> Bookings</a></li>
                <li><a href="admin-users.php"><i class="fas fa-users"></i> Users</a></li>
                <li><a href="admin-messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="../index.php"><i class="fas fa-home"></i> Back to Site</a></li>
                <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="admin-content">
            <h1>Manage Travel Packages</h1>

            <?php if (isset($_GET['deleted'])): ?>
            <div class="alert alert-success">Package deleted successfully!</div>
            <?php endif; ?>

            <a href="admin-package-add.php" class="btn btn-success">
                <i class="fas fa-plus"></i> Add New Package
            </a>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Destination</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($packages as $package): ?>
                    <tr>
                        <td><?php echo $package['id']; ?></td>
                        <td><?php echo $package['title']; ?></td>
                        <td><?php echo $package['destination_name']; ?></td>
                        <td>$<?php echo number_format($package['price'], 2); ?></td>
                        <td><?php echo $package['duration_days']; ?> days</td>
                        <td><?php echo ucfirst($package['type']); ?></td>
                        <td>
                            <a href="admin-package-edit.php?id=<?php echo $package['id']; ?>" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="admin-packages.php?delete=<?php echo $package['id']; ?>" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this package?');">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>