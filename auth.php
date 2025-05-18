<?php
// auth.php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isLoggedIn() && $_SESSION['role'] === 'admin';
}

function cleanInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function redirect($location) {
    header("Location: $location");
    exit();
}

function requireAuth() {
    if (!isLoggedIn()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        redirect('login.php');
    }
}

function requireAdmin() {
    requireAuth();
    if (!isAdmin()) {
        $_SESSION['error'] = "Unauthorized access";
        redirect('index.php');
    }
}
?>