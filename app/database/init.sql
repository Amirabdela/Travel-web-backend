-- Create users table if it doesn't exist
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    first_name TEXT NOT NULL,
    last_name TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT DEFAULT 'user',
    avatar TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create destinations table if it doesn't exist
CREATE TABLE IF NOT EXISTS destinations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    location TEXT NOT NULL,
    category TEXT NOT NULL,
    image TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create destination_gallery table
CREATE TABLE IF NOT EXISTS destination_gallery (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    destination_id INTEGER NOT NULL,
    image TEXT NOT NULL,
    caption TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_id) REFERENCES destinations(id)
);

-- Create attractions table
CREATE TABLE IF NOT EXISTS attractions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    destination_id INTEGER NOT NULL,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    image TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_id) REFERENCES destinations(id)
);

-- Create destination_reviews table
CREATE TABLE IF NOT EXISTS destination_reviews (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    destination_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    rating INTEGER NOT NULL,
    comment TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_id) REFERENCES destinations(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Create packages table if it doesn't exist
CREATE TABLE IF NOT EXISTS packages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    duration_days INTEGER NOT NULL,
    type TEXT NOT NULL,
    destination_id INTEGER NOT NULL,
    image TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (destination_id) REFERENCES destinations(id)
);

-- Create hotels table if it doesn't exist
CREATE TABLE IF NOT EXISTS hotels (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    location TEXT NOT NULL,
    type TEXT NOT NULL,
    price_per_night DECIMAL(10,2) NOT NULL,
    rating DECIMAL(2,1) NOT NULL,
    image TEXT NOT NULL,
    amenities TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create cars table if it doesn't exist
CREATE TABLE IF NOT EXISTS cars (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    model TEXT NOT NULL,
    description TEXT NOT NULL,
    type TEXT NOT NULL,
    price_per_day DECIMAL(10,2) NOT NULL,
    image TEXT NOT NULL,
    features TEXT NOT NULL,
    seats INTEGER NOT NULL,
    transmission TEXT NOT NULL,
    fuel_type TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create bookings table if it doesn't exist
CREATE TABLE IF NOT EXISTS bookings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    package_id INTEGER,
    hotel_id INTEGER,
    car_id INTEGER,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status TEXT DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (package_id) REFERENCES packages(id),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id),
    FOREIGN KEY (car_id) REFERENCES cars(id)
);

-- Insert sample destinations
INSERT INTO destinations (name, description, location, category, image) VALUES
('Lalibela', 'Home to the famous rock-hewn churches, a UNESCO World Heritage site.', 'Amhara Region', 'Religious', 'img/destinations/lalibela.jpg'),
('Simien Mountains', 'A stunning mountain range with unique wildlife and breathtaking views.', 'Amhara Region', 'Natural', 'img/destinations/simien.jpg'),
('Danakil Depression', 'One of the hottest places on Earth with unique geological features.', 'Afar Region', 'Natural', 'img/destinations/danakil.jpg'),
('Axum', 'Ancient city with historical monuments and religious significance.', 'Tigray Region', 'Historical', 'img/destinations/axum.jpg'),
('Bale Mountains', 'Home to diverse wildlife and beautiful landscapes.', 'Oromia Region', 'Natural', 'img/destinations/bale.jpg'),
('Gondar', 'Known as the "Camelot of Africa" with its medieval castles.', 'Amhara Region', 'Historical', 'img/destinations/gondar.jpg'),
('Omo Valley', 'Rich in cultural diversity and traditional customs.', 'Southern Nations Region', 'Cultural', 'img/destinations/omo.jpg'),
('Harar', 'Ancient walled city with unique Islamic heritage.', 'Harari Region', 'Cultural', 'img/destinations/harar.jpg');

-- Insert sample destination gallery
INSERT INTO destination_gallery (destination_id, image, caption) VALUES
(1, 'img/gallery/lalibela1.jpg', 'Bete Giyorgis Church'),
(1, 'img/gallery/lalibela2.jpg', 'Bete Medhane Alem Church'),
(2, 'img/gallery/simien1.jpg', 'Simien Mountains View'),
(2, 'img/gallery/simien2.jpg', 'Gelada Baboons');

-- Insert sample attractions
INSERT INTO attractions (destination_id, name, description, image) VALUES
(1, 'Bete Giyorgis', 'The most famous rock-hewn church in Lalibela.', 'img/attractions/bete-giyorgis.jpg'),
(1, 'Bete Medhane Alem', 'The largest monolithic church in the world.', 'img/attractions/bete-medhane.jpg'),
(2, 'Ras Dashen', 'The highest peak in Ethiopia.', 'img/attractions/ras-dashen.jpg'),
(2, 'Gelada Baboon Colony', 'Home to the endemic Gelada baboons.', 'img/attractions/gelada.jpg');

-- Insert sample destination reviews
INSERT INTO destination_reviews (destination_id, user_id, rating, comment) VALUES
(1, 1, 5, 'Amazing experience visiting the rock-hewn churches!'),
(1, 2, 4, 'Beautiful historical site, but quite crowded.'),
(2, 1, 5, 'Breathtaking views and unique wildlife.');

-- Insert sample packages
INSERT INTO packages (title, description, price, duration_days, type, destination_id, image) VALUES
('Lalibela Rock-Hewn Churches Tour', 'Experience the ancient rock-hewn churches of Lalibela, a UNESCO World Heritage site. This tour includes visits to all 11 churches, local cultural experiences, and traditional Ethiopian cuisine.', 899.99, 3, 'Cultural', 1, 'img/packages/lalibela.jpg'),
('Simien Mountains Trek', 'Trek through the stunning Simien Mountains National Park, home to rare wildlife including the Gelada baboon and Ethiopian wolf. Includes guided hiking, camping equipment, and park permits.', 1299.99, 5, 'Adventure', 2, 'img/packages/simien.jpg'),
('Danakil Depression Expedition', 'Visit one of the hottest places on Earth. Experience the otherworldly landscapes, active volcanoes, and salt lakes. Includes 4x4 transportation, camping gear, and local guides.', 1499.99, 4, 'Adventure', 3, 'img/packages/danakil.jpg'),
('Axum Historical Tour', 'Explore the ancient city of Axum, home to the famous obelisks and the Church of St. Mary of Zion. Learn about Ethiopia''s rich history and the legend of the Ark of the Covenant.', 799.99, 2, 'Cultural', 4, 'img/packages/axum.jpg'),
('Bale Mountains Wildlife Safari', 'Discover the diverse wildlife of Bale Mountains National Park. Spot Ethiopian wolves, mountain nyala, and various bird species. Includes guided tours and accommodation.', 1099.99, 4, 'Wildlife', 5, 'img/packages/bale.jpg'),
('Gondar Castle Tour', 'Visit the Royal Enclosure in Gondar, known as the "Camelot of Africa". Explore the medieval castles and churches, and learn about Ethiopia''s imperial history.', 699.99, 2, 'Cultural', 6, 'img/packages/gondar.jpg'),
('Omo Valley Cultural Experience', 'Immerse yourself in the diverse cultures of the Omo Valley. Meet various ethnic groups, witness traditional ceremonies, and learn about their unique customs.', 1599.99, 6, 'Cultural', 7, 'img/packages/omo.jpg'),
('Harar City Tour', 'Explore the ancient walled city of Harar, known for its 99 mosques and unique hyena feeding tradition. Experience the vibrant markets and rich Islamic heritage.', 899.99, 3, 'Cultural', 8, 'img/packages/harar.jpg');

-- Insert sample hotels
INSERT INTO hotels (name, description, location, type, price_per_night, rating, image, amenities) VALUES
('Sheraton Addis', 'Luxury hotel in the heart of Addis Ababa with stunning views of the city.', 'Addis Ababa', 'Luxury', 250.00, 4.8, 'img/hotels/sheraton.jpg', 'WiFi,Pool,Spa,Gym,Restaurant'),
('Kuriftu Resort', 'Luxury resort on the shores of Lake Tana with beautiful views.', 'Bahir Dar', 'Resort', 180.00, 4.6, 'img/hotels/kuriftu.jpg', 'WiFi,Pool,Spa,Restaurant'),
('Lalibela Lodge', 'Traditional lodge near the rock-hewn churches with authentic Ethiopian architecture.', 'Lalibela', 'Lodge', 120.00, 4.5, 'img/hotels/lalibela.jpg', 'WiFi,Restaurant,Bar'),
('Simien Lodge', 'Mountain lodge with breathtaking views of the Simien Mountains.', 'Simien Mountains', 'Lodge', 150.00, 4.7, 'img/hotels/simien.jpg', 'WiFi,Restaurant,Bar'),
('Gondar Hills Resort', 'Resort with panoramic views of Gondar and its castles.', 'Gondar', 'Resort', 130.00, 4.4, 'img/hotels/gondar.jpg', 'WiFi,Pool,Restaurant'),
('Bale Mountain Lodge', 'Eco-lodge in the heart of Bale Mountains National Park.', 'Bale Mountains', 'Lodge', 140.00, 4.6, 'img/hotels/bale.jpg', 'WiFi,Restaurant,Bar'),
('Harar Ras Hotel', 'Traditional hotel in the heart of Harar''s old town.', 'Harar', 'Standard', 90.00, 4.3, 'img/hotels/harar.jpg', 'WiFi,Restaurant'),
('Axum Hotel', 'Modern hotel near the ancient ruins of Axum.', 'Axum', 'Standard', 110.00, 4.4, 'img/hotels/axum.jpg', 'WiFi,Pool,Restaurant');

-- Insert sample cars
INSERT INTO cars (name, model, description, type, price_per_day, image, features, seats, transmission, fuel_type) VALUES
('Toyota Land Cruiser', 'LC200', '4x4 vehicle perfect for off-road adventures.', 'SUV', 100.00, 'img/cars/landcruiser.jpg', '4x4,AC,Radio', 7, 'Automatic', 'Diesel'),
('Toyota Hilux', 'Double Cab', 'Durable pickup truck for rugged terrain.', 'Pickup', 80.00, 'img/cars/hilux.jpg', '4x4,AC,Radio', 5, 'Manual', 'Diesel'),
('Mitsubishi Pajero', 'Sport', 'Comfortable SUV for family trips.', 'SUV', 90.00, 'img/cars/pajero.jpg', '4x4,AC,Radio', 7, 'Automatic', 'Petrol'),
('Toyota Corolla', 'SE', 'Economical sedan for city travel.', 'Sedan', 50.00, 'img/cars/corolla.jpg', 'AC,Radio', 5, 'Automatic', 'Petrol'),
('Nissan Patrol', 'Y62', 'Luxury SUV for comfortable travel.', 'SUV', 120.00, 'img/cars/patrol.jpg', '4x4,AC,Radio,Leather', 7, 'Automatic', 'Petrol'),
('Toyota Coaster', 'HZB50', 'Mini bus for group travel.', 'Bus', 150.00, 'img/cars/coaster.jpg', 'AC,Radio,Spacious', 30, 'Manual', 'Diesel'),
('Suzuki Jimny', 'JB74', 'Compact 4x4 for adventurous couples.', 'SUV', 70.00, 'img/cars/jimny.jpg', '4x4,AC,Radio', 4, 'Manual', 'Petrol'),
('Hyundai Starex', 'H-1', 'Van for family or group travel.', 'Van', 100.00, 'img/cars/starex.jpg', 'AC,Radio,Spacious', 12, 'Automatic', 'Diesel');

select * from packages;
select * from packages;