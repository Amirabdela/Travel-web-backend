<?php
// Database initialization script

// Get the database path from config
require_once __DIR__ . '/../app/config/config.php';

// Create database directory if it doesn't exist
if (!file_exists(dirname(DB_NAME))) {
    mkdir(dirname(DB_NAME), 0777, true);
}

try {
    // Create/connect to SQLite database
    $pdo = new PDO('sqlite:' . DB_NAME);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Enable foreign keys
    $pdo->exec('PRAGMA foreign_keys = ON');
    
    // Read and execute schema
    $schema = file_get_contents(__DIR__ . '/schema.sql');
    $pdo->exec($schema);
    
    // Read and execute sample data
    $sampleData = file_get_contents(__DIR__ . '/sample_data.sql');
    $pdo->exec($sampleData);
    
    echo "Database initialized successfully!\n";
    
} catch(PDOException $e) {
    die("Database initialization failed: " . $e->getMessage() . "\n");
} 