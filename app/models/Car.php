<?php
class Car {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllCars() {
        $this->db->query('SELECT * FROM cars ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getCarById($id) {
        $this->db->query('SELECT * FROM cars WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getCarTypes() {
        $this->db->query('SELECT DISTINCT type FROM cars ORDER BY type');
        return $this->db->resultSet();
    }

    public function getCarsByType($type) {
        $this->db->query('SELECT * FROM cars WHERE type = :type ORDER BY created_at DESC');
        $this->db->bind(':type', $type);
        return $this->db->resultSet();
    }

    public function getCarsByPriceRange($min, $max) {
        $this->db->query('SELECT * FROM cars WHERE price_per_day BETWEEN :min AND :max ORDER BY price_per_day ASC');
        $this->db->bind(':min', $min);
        $this->db->bind(':max', $max);
        return $this->db->resultSet();
    }

    public function bookCar($data) {
        $this->db->query('INSERT INTO car_bookings (car_id, user_id, start_date, end_date) VALUES (:car_id, :user_id, :start_date, :end_date)');
        
        // Bind values
        $this->db->bind(':car_id', $data['car_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function isCarAvailable($car_id, $start_date, $end_date) {
        $this->db->query('SELECT * FROM car_bookings WHERE car_id = :car_id AND 
            ((start_date BETWEEN :start_date AND :end_date) OR 
            (end_date BETWEEN :start_date AND :end_date))');
        
        $this->db->bind(':car_id', $car_id);
        $this->db->bind(':start_date', $start_date);
        $this->db->bind(':end_date', $end_date);

        $this->db->execute();
        return $this->db->rowCount() == 0;
    }
} 