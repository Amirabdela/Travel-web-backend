-- Create cars table
CREATE TABLE IF NOT EXISTS cars (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    model VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    seats INTEGER NOT NULL,
    transmission VARCHAR(20) NOT NULL,
    fuel_type VARCHAR(20) NOT NULL,
    luggage INTEGER NOT NULL,
    price_per_day DECIMAL(10,2) NOT NULL,
    rating INTEGER DEFAULT 5,
    image VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create car_bookings table
CREATE TABLE IF NOT EXISTS car_bookings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    car_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert sample car data
INSERT INTO cars (model, type, seats, transmission, fuel_type, luggage, price_per_day, rating, image, description) VALUES
('Toyota Corolla', 'sedan', 5, 'Automatic', 'Petrol', 3, 50.00, 4, 'corolla.jpg', 'Comfortable and fuel-efficient sedan perfect for city driving.'),
('Honda CR-V', 'suv', 5, 'Automatic', 'Petrol', 4, 75.00, 5, 'crv.jpg', 'Spacious SUV with excellent fuel economy and modern features.'),
('Ford Mustang', 'sports', 4, 'Manual', 'Petrol', 2, 120.00, 5, 'mustang.jpg', 'Iconic sports car with powerful engine and sleek design.'),
('Toyota Land Cruiser', 'suv', 7, 'Automatic', 'Diesel', 5, 150.00, 5, 'landcruiser.jpg', 'Rugged SUV perfect for off-road adventures and family trips.'),
('Honda Civic', 'sedan', 5, 'Automatic', 'Petrol', 3, 45.00, 4, 'civic.jpg', 'Reliable and efficient compact sedan with modern technology.'); 