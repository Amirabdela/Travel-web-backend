<?php
// connect.php
try {
    $pdo = new PDO("sqlite:database/travel.db");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create tables if they don't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            full_name TEXT,
            phone TEXT,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            is_admin INTEGER DEFAULT 0
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS destinations (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            description TEXT,
            location TEXT,
            image_path TEXT,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS packages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            destination_id INTEGER,
            title TEXT NOT NULL,
            description TEXT,
            duration_days INTEGER,
            price REAL,
            image_path TEXT,
            type TEXT,
            difficulty TEXT,
            min_age INTEGER,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (destination_id) REFERENCES destinations(id)
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS hotels (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            location TEXT,
            description TEXT,
            price_per_night REAL,
            rating INTEGER,
            image_path TEXT,
            amenities TEXT,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS rental_cars (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            model TEXT NOT NULL,
            type TEXT,
            price_per_day REAL,
            image_path TEXT,
            features TEXT,
            rating INTEGER,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS bookings (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER,
            package_id INTEGER,
            start_date TEXT,
            end_date TEXT,
            guests INTEGER,
            status TEXT DEFAULT 'pending',
            special_requests TEXT,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (package_id) REFERENCES packages(id)
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS contact_messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            message TEXT NOT NULL,
            created_at TEXT DEFAULT CURRENT_TIMESTAMP,
            status TEXT DEFAULT 'unread'
        )
    ");
    
    // Create admin user if not exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE is_admin = 1");
    $stmt->execute();
    $adminCount = $stmt->fetchColumn();
    
    if ($adminCount == 0) {
        $adminUsername = 'admin';
        $adminEmail = 'admin@travelhabesha.com';
        $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
        
        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password, full_name, is_admin)
            VALUES (?, ?, ?, ?, 1)
        ");
        $stmt->execute([$adminUsername, $adminEmail, $adminPassword, 'Admin User']);
    }
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to sanitize input
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>