-- Insert sample destinations (Ethiopian version)
INSERT INTO destinations (name, description, location, image, price, rating, category, climate, best_time_to_visit, featured, features) VALUES
('Lalibela Wonders', 'Explore the magnificent rock-hewn churches of Lalibela, a UNESCO World Heritage site', 'Lalibela, Ethiopia', 'https://images.unsplash.com/flagged/photo-1572644973628-e9be84915d59?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8bGFsaWJlbGF8ZW58MHx8MHx8fDA%3D', 800.00, 4.9, 'Cultural', 'Temperate', 'October to March', 1, 'History, Religion, Architecture'),
('Simien Mountains', 'Trek through the breathtaking landscapes of Simien Mountains National Park', 'Amhara Region, Ethiopia', 'https://media.istockphoto.com/id/471439851/photo/gelada-baboons-in-the-simien-mountains.webp?a=1&b=1&s=612x612&w=0&k=20&c=EAL1CdxZl35srUnB92qOxz0hYxudYwcLyGSq5e6Ae3A=', 950.00, 4.8, 'Adventure', 'Cool', 'November to February', 1, 'Hiking, Wildlife, Scenic Views'),
('Danakil Depression', 'Witness one of Earth''s most extreme environments with colorful sulfur springs', 'Afar Region, Ethiopia', 'https://media.istockphoto.com/id/970176090/photo/view-into-the-lava-lake-of-erta-ale-volcano-ethiopia.webp?a=1&b=1&s=612x612&w=0&k=20&c=jtmqIqOgvY7JPehKnfMEmJwHIhEjTANfkWa9i8RoCgw=', 1200.00, 4.7, 'Adventure', 'Hot', 'November to February', 1, 'Geology, Volcanoes, Unique Landscape');
-- Insert sample destination gallery (Ethiopian version)

UPDATE destinations SET image = 'https://images.unsplash.com/photo-1572644973628-e9be84915d59' WHERE name = 'Lalibela Wonders';
UPDATE destinations SET image = 'https://media.istockphoto.com/id/471439851/photo/gelada-baboons-in-the-simien-mountains.jpg' WHERE name = 'Simien Mountains';
UPDATE destinations SET image = 'https://media.istockphoto.com/id/970176090/photo/view-into-the-lava-lake-of-erta-ale-volcano-ethiopia.jpg' WHERE name = 'Danakil Depression';
INSERT INTO destination_gallery (destination_id, image_url, caption) VALUES
(1, 'https://images.unsplash.com/photo-1604537466573-5e94508fd243', 'Bete Giyorgis Church in Lalibela'),
(1, 'https://images.unsplash.com/photo-1604537466158-8a6c14b2c33e', 'Interior of Lalibela church'),
(2, 'https://images.unsplash.com/photo-1585409677003-3b37a9a52492', 'Simien Mountains landscape'),
(2, 'https://images.unsplash.com/photo-1585409677003-3b37a9a52492', 'Gelada baboons in Simien'),
(3, 'https://images.unsplash.com/photo-1597220667202-0c7c5d5a9c8e', 'Colorful sulfur springs in Danakil'),
(3, 'https://images.unsplash.com/photo-1597220667202-0c7c5d5a9c8e', 'Erta Ale lava lake');

-- Insert sample attractions (Ethiopian version)
INSERT INTO attractions (destination_id, name, description, image_url) VALUES
(1, 'Bete Giyorgis', 'Most famous cross-shaped rock-hewn church', 'https://images.unsplash.com/photo-1604537466573-5e94508fd243'),
(1, 'Lalibela Market', 'Traditional Ethiopian market with local crafts', 'https://images.unsplash.com/photo-1604537466158-8a6c14b2c33e'),
(2, 'Gelada Monkeys', 'Unique primates found only in Ethiopian highlands', 'https://images.unsplash.com/photo-1585409677003-3b37a9a52492'),
(2, 'Ras Dashen', 'Ethiopia''s highest peak at 4,550 meters', 'https://images.unsplash.com/photo-1585409677003-3b37a9a52492'),
(3, 'Erta Ale Volcano', 'One of the few permanent lava lakes in the world', 'https://images.unsplash.com/photo-1597220667202-0c7c5d5a9c8e'),
(3, 'Dallol Sulfur Springs', 'Vibrant acidic springs creating surreal colors', 'https://images.unsplash.com/photo-1597220667202-0c7c5d5a9c8e');

-- Insert sample hotels (Ethiopian version)
INSERT INTO hotels (name, description, location, image, price_per_night, rating, type, amenities) VALUES
('Lalibela Lodge', 'Eco-friendly lodge with stunning views of the churches', 'Lalibela, Ethiopia', 'https://images.unsplash.com/photo-1604537466158-8a6c14b2c33e', 150.00, 4.7, 'Lodge', 'Restaurant, Cultural Shows, Guided Tours'),
('Simien Lodge', 'Africa''s highest hotel with breathtaking mountain views', 'Simien Mountains, Ethiopia', 'https://images.unsplash.com/photo-1585409677003-3b37a9a52492', 200.00, 4.8, 'Lodge', 'Restaurant, Hiking Guides, Fireplace'),
('Gheralta Lodge', 'Unique lodge blending with Tigray''s rock formations', 'Tigray, Ethiopia', 'https://images.unsplash.com/photo-1604537466158-8a6c14b2c33e', 180.00, 4.6, 'Lodge', 'Pool, Restaurant, Rock Church Tours');

-- Insert sample cars (Ethiopian version)
INSERT INTO cars (model, type, seats, transmission, fuel_type, luggage, price_per_day, rating, image, description) VALUES
('Toyota Land Cruiser', '4x4', 7, 'Automatic', 'Diesel', 5, 120.00, 4.8, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888', 'Reliable off-road vehicle for Ethiopian terrain'),
('Hiace Minibus', 'Minivan', 12, 'Manual', 'Diesel', 8, 100.00, 4.5, 'https://images.unsplash.com/photo-1555215695-3004980ad54e', 'Comfortable transport for group tours'),
('Toyota RAV4', 'SUV', 5, 'Automatic', 'Petrol', 3, 80.00, 4.6, 'https://images.unsplash.com/photo-1585409677003-3b37a9a52492', 'Comfortable city and light off-road vehicle');

-- Insert sample users (unchanged)
INSERT INTO users (username, email, password, first_name, last_name, full_name, avatar, role) VALUES
('admin', 'admin@example.com', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewKyNiAYMyzJ/IiG', 'Admin', 'User', 'Admin User', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e', 'admin');

-- Insert sample packages (Ethiopian version)
INSERT INTO packages (name, description, price, image, type, features) VALUES
('Historical Ethiopia', 'Explore Ethiopia''s ancient history and religious sites', 1500.00, 'https://images.unsplash.com/photo-1604537466573-5e94508fd243', 'Cultural', 'Lalibela, Axum, Gondar, Local Cuisine'),
('Mountain Trekking', 'Adventure through Ethiopia''s stunning highlands', 1800.00, 'https://images.unsplash.com/photo-1585409677003-3b37a9a52492', 'Adventure', 'Simien Mountains, Bale Mountains, Wildlife'),
('Danakil Expedition', 'Journey to one of Earth''s most extreme environments', 2200.00, 'https://images.unsplash.com/photo-1597220667202-0c7c5d5a9c8e', 'Adventure', 'Erta Ale, Dallol, Salt Flats, Camel Caravans');


select * from contacts

select * from bookings