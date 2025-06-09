-- Create hotels table
CREATE TABLE IF NOT EXISTS hotels (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    description TEXT,
    location VARCHAR(255) NOT NULL,
    price_per_night DECIMAL(10,2) NOT NULL,
    rating INTEGER DEFAULT 5,
    image VARCHAR(255) NOT NULL,
    amenities TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create hotel_bookings table
CREATE TABLE IF NOT EXISTS hotel_bookings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    hotel_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    guests INTEGER NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create packages table
CREATE TABLE IF NOT EXISTS packages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    description TEXT,
    duration INTEGER NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    rating INTEGER DEFAULT 5,
    image VARCHAR(255) NOT NULL,
    included_services TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create package_bookings table
CREATE TABLE IF NOT EXISTS package_bookings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    package_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    start_date DATE NOT NULL,
    guests INTEGER NOT NULL,
    special_requests TEXT,
    total_price DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (package_id) REFERENCES packages(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert sample hotel data
INSERT INTO hotels (name, type, description, location, price_per_night, rating, image, amenities) VALUES
('Addis Ababa Hilton', 'luxury', 'Luxury hotel in the heart of Addis Ababa', 'Addis Ababa', 200.00, 5, 'hilton.jpg', 'WiFi, Pool, Spa, Restaurant'),
('Bole International Hotel', 'business', 'Modern business hotel near the airport', 'Addis Ababa', 150.00, 4, 'bole.jpg', 'WiFi, Business Center, Restaurant'),
('Sheraton Addis', 'luxury', 'Five-star luxury hotel with stunning views', 'Addis Ababa', 300.00, 5, 'sheraton.jpg', 'WiFi, Pool, Spa, Gym, Restaurant'),
('Axum Hotel', 'mid-range', 'Comfortable hotel in historic Axum', 'Axum', 100.00, 4, 'axum.jpg', 'WiFi, Restaurant'),
('Lalibela Lodge', 'boutique', 'Unique boutique hotel near rock churches', 'Lalibela', 120.00, 4, 'lalibela.jpg', 'WiFi, Restaurant, Garden');

-- Insert sample package data
INSERT INTO packages (name, type, description, duration, price, rating, image, included_services) VALUES
('Historic Route', 'cultural', 'Explore Ethiopia''s historic sites including Axum, Lalibela, and Gondar', 7, 1500.00, 5, 'historic.jpg', 'Accommodation, Transportation, Guide, Meals'),
('Danakil Depression', 'adventure', 'Visit the hottest place on earth and see the colorful salt lakes', 4, 800.00, 5, 'danakil.jpg', 'Accommodation, Transportation, Guide, Meals'),
('Omo Valley Tribes', 'cultural', 'Experience the unique cultures of Ethiopia''s tribal communities', 5, 1000.00, 4, 'omo.jpg', 'Accommodation, Transportation, Guide, Meals'),
('Simien Mountains', 'adventure', 'Trek through the stunning Simien Mountains National Park', 6, 1200.00, 5, 'simien.jpg', 'Accommodation, Transportation, Guide, Meals'),
('Coffee Tour', 'cultural', 'Visit coffee plantations and learn about Ethiopia''s coffee culture', 3, 500.00, 4, 'coffee.jpg', 'Accommodation, Transportation, Guide, Meals'); 