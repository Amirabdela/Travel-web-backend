<?php
// Flash message helper
function flash($name = '', $message = '', $class = 'alert alert-success') {
    if(!empty($name)) {
        if(!empty($message) && empty($_SESSION[$name])) {
            if(!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }
            if(!empty($_SESSION[$name . '_class'])) {
                unset($_SESSION[$name . '_class']);
            }
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif(empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

// Redirect helper
function redirect($page) {
    header('location: ' . URLROOT . '/' . $page);
}

// URL helper
function url($path = '') {
    return URLROOT . '/' . $path;
}

// Asset helper
function asset($path = '') {
    return URLROOT . '/public/' . $path;
}

// Image helper
function image($path = '') {
    return URLROOT . '/public/images/' . $path;
}

// Format date
function formatDate($date) {
    return date('F j, Y', strtotime($date));
}

// Format currency
function formatCurrency($amount) {
    return '$' . number_format($amount, 2);
}

// Sanitize input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

// Generate random string
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Get current page
function getCurrentPage() {
    $page = isset($_GET['url']) ? $_GET['url'] : '';
    return $page;
}

// Pagination helper
function paginate($total, $per_page, $current_page) {
    $total_pages = ceil($total / $per_page);
    $output = '<ul class="pagination">';
    
    if($current_page > 1) {
        $output .= '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
    }
    
    for($i = 1; $i <= $total_pages; $i++) {
        $active = $i == $current_page ? 'active' : '';
        $output .= '<li class="page-item ' . $active . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }
    
    if($current_page < $total_pages) {
        $output .= '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
    }
    
    $output .= '</ul>';
    return $output;
} 