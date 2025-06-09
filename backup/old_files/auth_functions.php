<?php
// includes/auth_functions.php

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'];
}

function requireLogin($redirect = 'login.php') {
    if (!isLoggedIn()) {
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
    
    // Unset all session variables
    $_SESSION = array();
    
    // Delete session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destroy the session
    session_destroy();
}

function getUserAvatar($userId) {
    // Implement your avatar logic here
    return 'images/default-avatar.jpg'; // Default avatar
}
?>