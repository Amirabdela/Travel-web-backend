<?php
// login_handler.php
session_start();

// Only process if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    require_once 'connect.php';
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Validate input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Please fill in all fields";
        header("Location: login.php");
        exit();
    }
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            // Set all necessary session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_admin'] = (bool)$user['is_admin']; // Ensure this is boolean
            
            // Clear any existing error
            unset($_SESSION['error']);
            
            // Redirect based on role
            header("Location: " . ($_SESSION['is_admin'] ? 'admin/dashboard.php' : 'profile.php'));
            exit();
        } else {
            $_SESSION['error'] = "Invalid username or password";
            header("Location: login.php");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error occurred";
        header("Location: login.php");
        exit();
    }
} else {
    // If not a POST request, redirect to login
    header("Location: index.php");
    exit();
}
?>