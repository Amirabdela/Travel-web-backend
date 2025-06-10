<?php
session_start();

// Flash message helper
function flash($name = '', $message = '', $type = 'success') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION['flash_message'])) {
            $_SESSION['flash_message'] = $message;
            $_SESSION['flash_type'] = $type;
        } elseif (empty($message) && !empty($_SESSION['flash_message'])) {
            $type = !empty($_SESSION['flash_type']) ? $_SESSION['flash_type'] : 'success';
            echo '<div class="flash-message ' . $type . ' animate__animated animate__fadeIn">
                    <div class="container">
                        <div class="flash-content">
                            <i class="fas ' . ($type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle') . '"></i>
                            <span>' . $_SESSION['flash_message'] . '</span>
                        </div>
                        <button class="flash-close" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                  </div>';
            unset($_SESSION['flash_message']);
            unset($_SESSION['flash_type']);
        }
    }
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

// Clean input data
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Get user avatar
function getUserAvatar($user_id) {
    $avatar_path = 'public/images/avatars/' . $user_id . '.jpg';
    $default_avatar = 'public/images/avatars/default.jpg';
    
    // Check if user has a custom avatar
    if (file_exists($avatar_path)) {
        return $avatar_path;
    }
    
    // Return default avatar if no custom avatar exists
    return $default_avatar;
} 