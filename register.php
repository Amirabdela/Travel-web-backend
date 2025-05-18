<?php
require_once __DIR__ . '/includes/auth_functions.php';
startSecureSession();
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/includes/header.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = cleanInput($_POST['username']);
    $email = cleanInput($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $fullName = cleanInput($_POST['full_name']);
    $phone = cleanInput($_POST['phone']);
    
    // Validation
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
    
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters";
    } elseif ($password !== $confirmPassword) {
        $errors['confirm_password'] = "Passwords do not match";
    }
    
    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    $count = $stmt->fetchColumn();
    
    if ($count > 0) {
        $errors['general'] = "Username or email already exists";
    }
    
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password, full_name, phone)
            VALUES (?, ?, ?, ?, ?)
        ");
        
        try {
            $stmt->execute([$username, $email, $hashedPassword, $fullName, $phone]);
            $success = "Registration successful! You can now login.";
        } catch (PDOException $e) {
            $errors['general'] = "Registration failed: " . $e->getMessage();
        }
    }
}

// If already logged in, redirect to home
if (isLoggedIn()) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Travel Habesha</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>


    <section class="auth-section">
        <div class="auth-container">
            <h2>Create an Account</h2>

            <?php if (!empty($errors['general'])): ?>
            <div class="error-message"><?php echo $errors['general']; ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
            <div class="success-message"><?php echo $success; ?></div>
            <?php else: ?>
            <form method="POST" action="register.php">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <?php if (!empty($errors['username'])): ?>
                    <span class="error"><?php echo $errors['username']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                    <?php if (!empty($errors['email'])): ?>
                    <span class="error"><?php echo $errors['email']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <?php if (!empty($errors['password'])): ?>
                    <span class="error"><?php echo $errors['password']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                    <?php if (!empty($errors['confirm_password'])): ?>
                    <span class="error"><?php echo $errors['confirm_password']; ?></span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone">
                </div>

                <button type="submit" class="btn-primary">Register</button>
            </form>
            <?php endif; ?>

            <div class="auth-links">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </section>


</body>

</html>