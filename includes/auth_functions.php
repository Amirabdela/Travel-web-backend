<?php
// includes/auth_functions.php

function startSecureSession() {
    if (session_status() === PHP_SESSION_NONE) {
        // Secure session settings
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure', 1); // Enable if using HTTPS
        ini_set('session.use_strict_mode', 1);
        
        session_start();
        
        // Regenerate ID to prevent session fixation
        if (empty($_SESSION['created'])) {
            session_regenerate_id(true);
            $_SESSION['created'] = time();
        } else if (time() - $_SESSION['created'] > 1800) {
            // Regenerate every 30 minutes
            session_regenerate_id(true);
            $_SESSION['created'] = time();
        }
    }
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isLoggedIn() && !empty($_SESSION['is_admin']);
}

function requireLogin($redirect = 'login.php') {
    startSecureSession();
    if (!isLoggedIn()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header("Location: $redirect");
        exit();
    }
}

function requireAdmin($redirect = 'index.php') {
    requireLogin();
    if (!isAdmin()) {
        header("Location: $redirect");
        exit();
    }
}

function logoutUser() {
    startSecureSession();
    $_SESSION = array();
    
    // Delete session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
}

function getUserAvatar($userId) {
    // Default avatar if none set
    return 'images/default-avatar.jpg';
}
?>