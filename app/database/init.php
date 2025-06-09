<?php
// Database configuration
require_once '../config/config.php';

try {
    // Create database directory if it doesn't exist
    $dbDir = dirname(DB_NAME);
    if (!file_exists($dbDir)) {
        mkdir($dbDir, 0777, true);
    }

    // Create database connection
    $db = new PDO('sqlite:' . DB_NAME);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Drop existing tables if they exist
    $db->exec("DROP TABLE IF EXISTS bookings");
    $db->exec("DROP TABLE IF EXISTS cars");
    $db->exec("DROP TABLE IF EXISTS hotels");
    $db->exec("DROP TABLE IF EXISTS packages");
    $db->exec("DROP TABLE IF EXISTS destinations");
    $db->exec("DROP TABLE IF EXISTS users");
    $db->exec("DROP TABLE IF EXISTS destination_gallery");
    $db->exec("DROP TABLE IF EXISTS attractions");
    $db->exec("DROP TABLE IF EXISTS destination_reviews");

    // Read and execute SQL file
    $sql = file_get_contents(__DIR__ . '/init.sql');
    $db->exec($sql);

    echo "Database initialized successfully!\n";
    echo "Database location: " . DB_NAME . "\n";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
} 