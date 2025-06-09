<?php
require_once '/../connect.php';

$destinations = [
    [
        'name' => 'Beynouna Village',
        'description' => 'Designed for modern living, sustainability, and cultural heritage.',
        'image' => 'assets/dp5.jpg',
        'price' => 211
    ],
    [
        'name' => 'Haile Resort',
        'description' => 'Luxurious accommodations and recreational activities.',
        'image' => 'assets/dp6.jpg',
        'price' => 220
    ],
    [
        'name' => 'Entoto',
        'description' => 'Scenic views, historical sites, hiking, Entoto Maryam Church.',
        'image' => 'assets/dp7.jpg',
        'price' => 700
    ],
    [
        'name' => 'Adwa Museum',
        'description' => 'Displays history of the 1896 Battle of Adwa.',
        'image' => 'assets/dp10.jpg',
        'price' => 70
    ],
];

foreach ($destinations as $dest) {
    try {
        $stmt = $pdo->prepare("INSERT INTO destinations (name, description, image, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$dest['name'], $dest['description'], $dest['image'], $dest['price']]);
        echo "Inserted: {$dest['name']}<br />";
    } catch (PDOException $e) {
        echo "Error inserting {$dest['name']}: " . $e->getMessage() . "<br />";
    }
}

echo "Seeding completed.";