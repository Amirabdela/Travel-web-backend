<?php
// Database configuration
define('DB_TYPE', 'sqlite');
define('DB_NAME', dirname(dirname(dirname(__FILE__))) . '/database/travel_site.db');

try {
    // Create PDO instance
    $pdo = new PDO(DB_TYPE . ':' . DB_NAME);
    
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode to associative array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Enable foreign keys
    $pdo->exec('PRAGMA foreign_keys = ON');
    
} catch(PDOException $e) {
    // Log error and display user-friendly message
    error_log("Connection failed: " . $e->getMessage());
    die("Sorry, there was a problem connecting to the database. Please try again later.");
} 