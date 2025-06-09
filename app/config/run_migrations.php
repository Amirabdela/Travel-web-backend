<?php
// Include database configuration
require_once 'database.php';

// Function to run SQL file
function runSQLFile($pdo, $file) {
    try {
        // Read SQL file
        $sql = file_get_contents($file);
        
        // Execute SQL
        $pdo->exec($sql);
        
        echo "Successfully executed: " . basename($file) . "\n";
    } catch(PDOException $e) {
        echo "Error executing " . basename($file) . ": " . $e->getMessage() . "\n";
    }
}

// Get all migration files
$migrations = [
    'cars.sql',
    'hotels_packages.sql',
    'ethiopia_data.sql'
];

// Run migrations
foreach($migrations as $migration) {
    $file = __DIR__ . '/migrations/' . $migration;
    if(file_exists($file)) {
        runSQLFile($pdo, $file);
    } else {
        echo "Migration file not found: " . $migration . "\n";
    }
}

echo "\nMigration process completed.\n"; 