-- Insert sample destinations
INSERT INTO destinations (name, description, location, image, price, rating, category, climate, best_time_to_visit, featured, features) VALUES
('Bali Paradise', 'Experience the beauty of Bali with its stunning beaches and rich culture', 'Bali, Indonesia', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', 1200.00, 4.8, 'Cultural', 'Tropical', 'April to October', 1, 'Beach, Culture, Nightlife'),
('Paris Getaway', 'Discover the romance of Paris with its iconic landmarks and cuisine', 'Paris, France', 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34', 1500.00, 4.9, 'Cultural', 'Temperate', 'April to June, September to October', 1, 'Museums, Food, Romance'),
('Tokyo Adventure', 'Immerse yourself in the vibrant culture of Tokyo', 'Tokyo, Japan', 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf', 1800.00, 4.7, 'Cultural', 'Temperate', 'March to May, September to November', 1, 'Technology, Shopping, Cuisine');

-- Insert sample destination gallery
INSERT INTO destination_gallery (destination_id, image_url, caption) VALUES
(1, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', 'Beautiful Bali Beach'),
(1, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', 'Bali Temple'),
(2, 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34', 'Eiffel Tower'),
(2, 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34', 'Paris Streets'),
(3, 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf', 'Tokyo Cityscape'),
(3, 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf', 'Tokyo Nightlife');

-- Insert sample attractions
INSERT INTO attractions (destination_id, name, description, image_url) VALUES
(1, 'Ubud Monkey Forest', 'Sacred forest with hundreds of monkeys', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4'),
(1, 'Tegallalang Rice Terraces', 'Beautiful rice terraces in Ubud', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4'),
(2, 'Eiffel Tower', 'Iconic symbol of Paris', 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34'),
(2, 'Louvre Museum', 'World''s largest art museum', 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34'),
(3, 'Shibuya Crossing', 'World''s busiest pedestrian crossing', 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf'),
(3, 'Tokyo Skytree', 'Tallest structure in Japan', 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf');

-- Insert sample hotels
INSERT INTO hotels (name, description, location, image, price_per_night, rating, type, amenities) VALUES
('Grand Luxury Resort', 'Luxurious resort with ocean views and world-class amenities', 'Maldives', 'https://images.unsplash.com/photo-1571896349842-33c89424de2d', 500.00, 4.9, 'Resort', 'Pool, Spa, Beach Access, Restaurant'),
('City Center Hotel', 'Modern hotel in the heart of the city', 'New York', 'https://images.unsplash.com/photo-1566073771259-6a8506099945', 300.00, 4.5, 'Hotel', 'Gym, Restaurant, Business Center'),
('Mountain View Lodge', 'Cozy lodge with stunning mountain views', 'Swiss Alps', 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4', 250.00, 4.7, 'Lodge', 'Spa, Restaurant, Ski Access');

-- Insert sample cars
INSERT INTO cars (model, type, seats, transmission, fuel_type, luggage, price_per_day, rating, image, description) VALUES
('Mercedes-Benz S-Class', 'Luxury', 5, 'Automatic', 'Hybrid', 4, 200.00, 4.9, 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8', 'Luxury sedan with premium features and comfort'),
('Toyota Land Cruiser', 'SUV', 7, 'Automatic', 'Diesel', 5, 150.00, 4.8, 'https://images.unsplash.com/photo-1583121274602-3e2820c69888', 'Powerful SUV perfect for family adventures'),
('BMW 3 Series', 'Sedan', 5, 'Automatic', 'Petrol', 3, 120.00, 4.7, 'https://images.unsplash.com/photo-1555215695-3004980ad54e', 'Sporty sedan with excellent handling and comfort');

-- Insert sample users
INSERT INTO users (username, email, password, first_name, last_name, full_name, avatar, role) VALUES
('admin', 'admin@example.com', '$2y$12$LQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewKyNiAYMyzJ/IiG', 'Admin', 'User', 'Admin User', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e', 'admin');

-- Insert sample packages
INSERT INTO packages (name, description, price, image, type, features) VALUES
('Romantic Paris', 'A romantic getaway for two in Paris.', 2000.00, 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34', 'Romantic', 'Eiffel Tower, Seine River Cruise, Fine Dining'),
('Bali Adventure', 'Adventure package in Bali with guided tours.', 1800.00, 'https://images.unsplash.com/photo-1537996194471-e657df975ab4', 'Adventure', 'Surfing, Temples, Jungle Trek'),
('Tokyo Explorer', 'Explore the best of Tokyo.', 2200.00, 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf', 'Cultural', 'City Tour, Sushi Workshop, Anime District'); 