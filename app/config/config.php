<?php
// Database Configuration
define('DB_TYPE', 'sqlite');    
define('DB_NAME', dirname(dirname(dirname(__FILE__))) . '/database/travel_site.db');

// Application Configuration
define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', 'http://localhost/travel-site/public');
define('SITENAME', 'Travel Habesha');

// Session Configuration
define('SESSION_NAME', 'travel_habesha_session');
define('SESSION_LIFETIME', 7200); // 2 hours

// File Upload Configuration
define('UPLOAD_PATH', dirname(dirname(__FILE__)) . '/public/images/uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB

// Email Configuration
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'your-email@gmail.com');
define('SMTP_PASS', 'your-app-password');

// Security Configuration
define('HASH_COST', 12); // For password hashing
define('TOKEN_LIFETIME', 3600); // 1 hour for password reset tokens 