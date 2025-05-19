<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';
// require_once 'auth_functions.php';
// requireLogin();
// Redirect if not logged in
define('REQUIRE_AUTH', true);
require_once __DIR__ . '/includes/auth_functions.php';
requireLogin();

// Get user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    // User not found, log them out
    logoutUser();
    header("Location: login.php");
    exit();
}

// Get user bookings
$stmt = $pdo->prepare("
    SELECT b.*, p.title as package_title, p.image_path as package_image, 
           d.name as destination_name, b.status as booking_status
    FROM bookings b
    LEFT JOIN packages p ON b.package_id = p.id
    LEFT JOIN destinations d ON p.destination_id = d.id
    WHERE b.user_id = ?
    ORDER BY b.start_date DESC
");
$stmt->execute([$_SESSION['user_id']]);
$bookings = $stmt->fetchAll();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $full_name = cleanInput($_POST['full_name']);
    $phone = cleanInput($_POST['phone']);
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    $errors = [];
    
    // Validate password change if any password field is filled
    if (!empty($current_password) || !empty($new_password) || !empty($confirm_password)) {
        if (empty($current_password)) {
            $errors['current_password'] = "Current password is required";
        } elseif (!password_verify($current_password, $user['password'])) {
            $errors['current_password'] = "Current password is incorrect";
        }
        
        if (empty($new_password)) {
            $errors['new_password'] = "New password is required";
        } elseif (strlen($new_password) < 6) {
            $errors['new_password'] = "Password must be at least 6 characters";
        }
        
        if ($new_password !== $confirm_password) {
            $errors['confirm_password'] = "Passwords do not match";
        }
    }
    
    if (empty($errors)) {
        // Update profile
        $update_data = [
            'full_name' => $full_name,
            'phone' => $phone,
            'id' => $_SESSION['user_id']
        ];
        
        $sql = "UPDATE users SET full_name = :full_name, phone = :phone";
        
        // Add password to update if changing
        if (!empty($new_password)) {
            $update_data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
            $sql .= ", password = :password";
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute($update_data)) {
            // Update session with new name
            $_SESSION['full_name'] = $full_name;
            
            $success = "Profile updated successfully!";
            // Refresh user data
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();
        } else {
            $error = "Failed to update profile";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Travel Habesha</title>
    <link rel="stylesheet" href="styles/profile.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    .profile-container {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 30px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .profile-sidebar {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }


    .profile-content {
        background: white;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .profile-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #f5f5f5;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3em;
        color: #2c3e50;
    }

    .booking-card {
        display: grid;
        grid-template-columns: 120px 1fr;
        gap: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
    }

    .booking-card:last-child {
        border-bottom: none;
    }

    .booking-image {
        width: 120px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
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
    <!-- Header -->


    <main class="profile-container">
        <!-- Profile Sidebar -->
        <div class="profile-sidebar">
            <div class="profile-avatar">
                <?php echo strtoupper(substr($user['full_name'] ?: $user['username'], 0, 1)); ?>
            </div>

            <h2><?php echo $user['full_name'] ?: $user['username']; ?></h2>
            <p><i class="fas fa-envelope"></i> <?php echo $user['email']; ?></p>
            <?php if ($user['phone']): ?>
            <p><i class="fas fa-phone"></i> <?php echo $user['phone']; ?></p>
            <?php endif; ?>

            <p>Member since <?php echo date('M Y', strtotime($user['created_at'])); ?></p>
        </div>

        <!-- Profile Content -->
        <div class="profile-content">
            <h1>My Profile</h1>

            <?php if (isset($success)): ?>
            <div class="alert success"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
            <div class="alert error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" class="profile-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" value="<?php echo $user['username']; ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" value="<?php echo $user['email']; ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo $user['full_name']; ?>">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
                </div>

                <h3>Change Password</h3>

                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password">
                    <?php if (isset($errors['current_password'])): ?>
                    <span class="error"><?php echo $errors['current_password']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password">
                    <?php if (isset($errors['new_password'])): ?>
                    <span class="error"><?php echo $errors['new_password']; ?></span>
                    <?php endif; ?>
                </div>


                <div class="form-group">
                    <label for="confirm_password">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password">
                    <?php if (isset($errors['confirm_password'])): ?>
                    <span class="error"><?php echo $errors['confirm_password']; ?></span>
                    <?php endif; ?>
                </div>

                <button type="submit" name="update_profile" class="btn-primary">Update Profile</button>
            </form>

            <h2 style="margin-top: 40px;">My Bookings</h2>

            <?php if (empty($bookings)): ?>
            <p>You haven't made any bookings yet.</p>
            <a href="packages.php" class="btn-primary">Browse Packages</a>
            <?php else: ?>
            <?php foreach ($bookings as $booking): ?>
            <div class="booking-card">
                <?php if ($booking['package_image']): ?>
                <img src="<?php echo $booking['package_image']; ?>" alt="<?php echo $booking['package_title']; ?>"
                    class="booking-image">
                <?php else: ?>
                <div class="booking-image"
                    style="background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-suitcase" style="font-size: 2em; color: #999;"></i>
                </div>
                <?php endif; ?>

                <div>
                    <h3>
                        <?php echo $booking['package_title'] ?: 'Custom Booking'; ?>
                        <?php if ($booking['destination_name']): ?>
                        <small>(<?php echo $booking['destination_name']; ?>)</small>
                        <?php endif; ?>
                    </h3>

                    <p>
                        <i class="far fa-calendar-alt"></i>
                        <?php echo date('M d, Y', strtotime($booking['start_date'])); ?> -
                        <?php echo date('M d, Y', strtotime($booking['end_date'])); ?>
                    </p>

                    <p>
                        <i class="fas fa-users"></i> <?php echo $booking['guests']; ?> guests
                    </p>

                    <p class="status-<?php echo $booking['booking_status']; ?>">
                        <i class="fas fa-circle"></i> <?php echo ucfirst($booking['booking_status']); ?>
                    </p>

                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>


</body>

</html>