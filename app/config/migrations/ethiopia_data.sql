-- Insert Ethiopian Hotels
INSERT INTO hotels (name, type, description, location, price_per_night, rating, image, amenities) VALUES
-- Addis Ababa Hotels
('Sheraton Addis', 'luxury', 'Five-star luxury hotel with stunning views of the city and Entoto Mountains. Features world-class dining and spa facilities.', 'Addis Ababa', 350.00, 5, 'sheraton.jpg', 'WiFi, Pool, Spa, Gym, Multiple Restaurants, Business Center, Conference Facilities'),
('Radisson Blu', 'luxury', 'Modern luxury hotel in the heart of Addis Ababa, offering elegant rooms and excellent service.', 'Addis Ababa', 280.00, 5, 'radisson.jpg', 'WiFi, Pool, Spa, Gym, Restaurant, Business Center'),
('Hilton Addis Ababa', 'luxury', 'Iconic hotel with rich history, offering luxury accommodations and extensive facilities.', 'Addis Ababa', 250.00, 5, 'hilton.jpg', 'WiFi, Pool, Spa, Gym, Multiple Restaurants, Business Center'),
('Bole International Hotel', 'business', 'Conveniently located near Bole International Airport, perfect for business travelers.', 'Addis Ababa', 180.00, 4, 'bole.jpg', 'WiFi, Business Center, Restaurant, Airport Shuttle'),
('Capital Hotel', 'mid-range', 'Comfortable hotel in the city center with easy access to major attractions.', 'Addis Ababa', 120.00, 4, 'capital.jpg', 'WiFi, Restaurant, Business Center'),

-- Lalibela Hotels
('Mountain View Hotel', 'boutique', 'Stunning views of the Lalibela rock churches, offering traditional Ethiopian hospitality.', 'Lalibela', 150.00, 4, 'mountain_view.jpg', 'WiFi, Restaurant, Garden, Church Tours'),
('Lalibela Lodge', 'boutique', 'Unique boutique hotel with traditional architecture near the rock churches.', 'Lalibela', 130.00, 4, 'lalibela_lodge.jpg', 'WiFi, Restaurant, Garden, Cultural Shows'),
('Roha Hotel', 'mid-range', 'Comfortable accommodation with easy access to the rock churches.', 'Lalibela', 100.00, 4, 'roha.jpg', 'WiFi, Restaurant, Tour Desk'),

-- Axum Hotels
('Yeha Hotel', 'mid-range', 'Modern hotel in the historic city of Axum, close to ancient monuments.', 'Axum', 110.00, 4, 'yeha.jpg', 'WiFi, Restaurant, Tour Desk'),
('Remhai Hotel', 'mid-range', 'Comfortable hotel with views of the Stelae field.', 'Axum', 95.00, 4, 'remhai.jpg', 'WiFi, Restaurant, Garden'),

-- Bahir Dar Hotels
('Kuriftu Resort', 'luxury', 'Luxury resort on the shores of Lake Tana, offering water activities and spa services.', 'Bahir Dar', 200.00, 5, 'kuriftu.jpg', 'WiFi, Pool, Spa, Restaurant, Water Sports'),
('Tana Hotel', 'mid-range', 'Comfortable hotel with views of Lake Tana and the Blue Nile.', 'Bahir Dar', 120.00, 4, 'tana.jpg', 'WiFi, Restaurant, Lake Tours'),

-- Gondar Hotels
('Goha Hotel', 'mid-range', 'Hotel with panoramic views of Gondar and the surrounding mountains.', 'Gondar', 115.00, 4, 'goha.jpg', 'WiFi, Restaurant, Garden, City Tours'),
('Taye Hotel', 'mid-range', 'Modern hotel in the heart of Gondar, close to the Royal Enclosure.', 'Gondar', 100.00, 4, 'taye.jpg', 'WiFi, Restaurant, Tour Desk');

-- Insert Ethiopian Rental Cars
INSERT INTO cars (model, type, seats, transmission, fuel_type, luggage, price_per_day, rating, image, description) VALUES
-- Sedans
('Toyota Corolla', 'sedan', 5, 'Automatic', 'Petrol', 3, 50.00, 4, 'corolla.jpg', 'Fuel-efficient sedan perfect for city driving and short trips.'),
('Honda Civic', 'sedan', 5, 'Automatic', 'Petrol', 3, 45.00, 4, 'civic.jpg', 'Reliable and comfortable sedan with modern features.'),
('Hyundai Elantra', 'sedan', 5, 'Automatic', 'Petrol', 3, 48.00, 4, 'elantra.jpg', 'Stylish sedan with excellent fuel economy.'),

-- SUVs
('Toyota Land Cruiser', 'suv', 7, 'Automatic', 'Diesel', 5, 150.00, 5, 'landcruiser.jpg', 'Rugged SUV perfect for off-road adventures and family trips.'),
('Toyota Prado', 'suv', 7, 'Automatic', 'Diesel', 4, 120.00, 5, 'prado.jpg', 'Comfortable SUV with excellent off-road capabilities.'),
('Mitsubishi Pajero', 'suv', 7, 'Automatic', 'Diesel', 4, 100.00, 4, 'pajero.jpg', 'Reliable SUV suitable for both city and off-road driving.'),

-- 4x4 Vehicles
('Toyota Hilux', '4x4', 5, 'Manual', 'Diesel', 3, 80.00, 5, 'hilux.jpg', 'Durable pickup truck perfect for rough terrain and long journeys.'),
('Isuzu D-Max', '4x4', 5, 'Manual', 'Diesel', 3, 75.00, 4, 'dmax.jpg', 'Robust pickup truck with excellent load capacity.'),

-- Luxury Vehicles
('Mercedes-Benz S-Class', 'luxury', 5, 'Automatic', 'Petrol', 3, 200.00, 5, 'sclass.jpg', 'Luxury sedan with premium features and comfort.'),
('BMW 7 Series', 'luxury', 5, 'Automatic', 'Petrol', 3, 180.00, 5, 'bmw7.jpg', 'High-end luxury sedan with advanced technology.'),

-- Minivans
('Toyota Hiace', 'minivan', 12, 'Manual', 'Diesel', 5, 90.00, 4, 'hiace.jpg', 'Spacious minivan ideal for group travel and airport transfers.'),
('Nissan Urvan', 'minivan', 15, 'Manual', 'Diesel', 4, 85.00, 4, 'urvan.jpg', 'Comfortable minivan with ample seating and luggage space.');

-- Insert Ethiopian Travel Packages
INSERT INTO packages (title, type, description, duration_days, price, image_path, difficulty, min_age) VALUES
-- Cultural Tours
('Historic Route Explorer', 'cultural', 'Explore Ethiopia''s historic sites including Axum, Lalibela, and Gondar. Visit ancient churches, castles, and UNESCO World Heritage sites.', 10, 2500.00, 'historic_route.jpg', 'moderate', 12),
('Lalibela Rock Churches', 'cultural', 'Discover the magnificent rock-hewn churches of Lalibela, a UNESCO World Heritage site. Experience local culture and religious ceremonies.', 4, 800.00, 'lalibela_tour.jpg', 'easy', 8),
('Axum & Yeha', 'cultural', 'Visit the ancient city of Axum, home to the famous obelisks and the Ark of the Covenant. Explore the ruins of Yeha temple.', 3, 600.00, 'axum_tour.jpg', 'easy', 8),

-- Adventure Tours
('Simien Mountains Trek', 'adventure', 'Trek through the stunning Simien Mountains National Park. Spot endemic wildlife and enjoy breathtaking views.', 6, 1200.00, 'simien_trek.jpg', 'challenging', 16),
('Danakil Depression', 'adventure', 'Visit the hottest place on earth. See colorful salt lakes, active volcanoes, and the Afar people''s way of life.', 4, 1000.00, 'danakil.jpg', 'challenging', 16),
('Bale Mountains', 'adventure', 'Explore the Bale Mountains National Park. Spot rare wildlife and enjoy beautiful landscapes.', 5, 900.00, 'bale.jpg', 'moderate', 12),

-- Cultural Experiences
('Omo Valley Tribes', 'cultural', 'Experience the unique cultures of Ethiopia''s tribal communities in the Omo Valley. Visit traditional villages and markets.', 7, 1800.00, 'omo_valley.jpg', 'moderate', 12),
('Coffee Tour', 'cultural', 'Visit coffee plantations and learn about Ethiopia''s coffee culture. Experience traditional coffee ceremonies.', 3, 500.00, 'coffee_tour.jpg', 'easy', 8),
('Harar & Dire Dawa', 'cultural', 'Explore the ancient walled city of Harar and the vibrant city of Dire Dawa. Experience local markets and hyena feeding.', 4, 700.00, 'harar.jpg', 'easy', 8),

-- Nature & Wildlife
('Awash National Park', 'nature', 'Visit Awash National Park to see wildlife and beautiful landscapes. Enjoy bird watching and nature walks.', 2, 400.00, 'awash.jpg', 'easy', 8),
('Lake Tana & Blue Nile', 'nature', 'Explore Lake Tana''s monasteries and the Blue Nile Falls. Enjoy boat trips and nature walks.', 3, 600.00, 'tana.jpg', 'easy', 8),

-- Combined Tours
('North Circuit', 'combined', 'Comprehensive tour of northern Ethiopia including Bahir Dar, Gondar, Simien Mountains, Axum, and Lalibela.', 14, 3000.00, 'north_circuit.jpg', 'moderate', 12),
('South Circuit', 'combined', 'Explore southern Ethiopia including the Rift Valley lakes, Omo Valley tribes, and Bale Mountains.', 12, 2800.00, 'south_circuit.jpg', 'moderate', 12); 