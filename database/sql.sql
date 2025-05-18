-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    full_name TEXT,
    phone TEXT,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    is_admin INTEGER DEFAULT 0
);

-- Destinations table
CREATE TABLE IF NOT EXISTS destinations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    description TEXT,
    location TEXT,
    image_path TEXT,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
);

-- Packages table
CREATE TABLE IF NOT EXISTS packages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    destination_id INTEGER,
    title TEXT NOT NULL,
    description TEXT,
    duration_days INTEGER,
    price REAL,
    image_path TEXT,
    type TEXT, -- cultural, adventure, etc.
    difficulty TEXT,
    min_age INTEGER,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_id) REFERENCES destinations(id)
);

-- Hotels table
CREATE TABLE IF NOT EXISTS hotels (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    location TEXT,
    description TEXT,
    price_per_night REAL,
    rating INTEGER,
    image_path TEXT,
    amenities TEXT, -- comma-separated list
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
);

-- Rental Cars table
CREATE TABLE IF NOT EXISTS rental_cars (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    model TEXT NOT NULL,
    type TEXT,
    price_per_day REAL,
    image_path TEXT,
    features TEXT,
    rating INTEGER,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP
);

-- Bookings table (expanded)
CREATE TABLE IF NOT EXISTS bookings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER,
    package_id INTEGER,
    start_date TEXT,
    end_date TEXT,
    guests INTEGER,
    status TEXT DEFAULT 'pending', -- pending, confirmed, cancelled
    special_requests TEXT,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (package_id) REFERENCES packages(id)
);

-- Contact messages
CREATE TABLE IF NOT EXISTS contact_messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL,
    message TEXT NOT NULL,
    created_at TEXT DEFAULT CURRENT_TIMESTAMP,
    status TEXT DEFAULT 'unread' -- unread, read, replied
);

select * from contact_messages