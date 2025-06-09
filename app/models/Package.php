<?php
class Package extends Model {
    protected $table = 'packages';

    public function getAllPackages() {
        $this->db->query('SELECT * FROM packages ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getPackageById($id) {
        $this->db->query('SELECT * FROM packages WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getPackageTypes() {
        $this->db->query('SELECT DISTINCT type FROM packages ORDER BY type');
        return $this->db->resultSet();
    }

    public function getPackagesByType($type) {
        $sql = "SELECT * FROM packages WHERE type = :type";
        $this->db->query($sql);
        $this->db->bind(':type', $type);
        return $this->db->resultSet();
    }

    public function getPackagesByPriceRange($min, $max) {
        $this->db->query('SELECT * FROM packages WHERE price BETWEEN :min AND :max ORDER BY price ASC');
        $this->db->bind(':min', $min);
        $this->db->bind(':max', $max);
        return $this->db->resultSet();
    }

    public function bookPackage($data) {
        $this->db->query('INSERT INTO package_bookings (package_id, user_id, start_date, guests, special_requests) VALUES (:package_id, :user_id, :start_date, :guests, :special_requests)');
        
        // Bind values
        $this->db->bind(':package_id', $data['package_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':guests', $data['guests']);
        $this->db->bind(':special_requests', $data['special_requests']);

        // Execute
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function isPackageAvailable($package_id, $start_date) {
        $this->db->query('SELECT * FROM package_bookings WHERE package_id = :package_id AND start_date = :start_date');
        
        $this->db->bind(':package_id', $package_id);
        $this->db->bind(':start_date', $start_date);

        $this->db->execute();
        return $this->db->rowCount() == 0;
    }

    public function getFeaturedPackages($limit = 6) {
        $sql = "SELECT * FROM packages ORDER BY RAND() LIMIT :limit";
        $this->db->query($sql);
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    public function getSpecialOffers($limit = 2) {
        $sql = "SELECT p.*, d.name as destination_name 
                FROM packages p
                JOIN destinations d ON p.destination_id = d.id
                WHERE p.price < (SELECT AVG(price) FROM packages)
                ORDER BY RAND() LIMIT :limit";
        $this->db->query($sql);
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    public function getPackagesByDestination($destination_id) {
        // Since we don't have destination_id, we'll return all packages for now
        // This can be modified later to filter by location or other criteria
        $sql = "SELECT * FROM packages";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getPackageWithDetails($id) {
        $sql = "SELECT p.*, d.name as destination_name, d.description as destination_description
                FROM packages p
                JOIN destinations d ON p.destination_id = d.id
                WHERE p.id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function searchPackages($query) {
        $sql = "SELECT * FROM packages 
                WHERE title LIKE :query 
                OR description LIKE :query";
        $this->db->query($sql);
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }

    public function getPackagesByDuration($days) {
        $sql = "SELECT p.*, d.name as destination_name 
                FROM packages p
                JOIN destinations d ON p.destination_id = d.id
                WHERE p.duration_days = :days";
        $this->db->query($sql);
        $this->db->bind(':days', $days);
        return $this->db->resultSet();
    }

    public function getRelatedPackages($package_id, $destination_id, $limit = 3) {
        $sql = "SELECT p.*, d.name as destination_name 
                FROM packages p
                JOIN destinations d ON p.destination_id = d.id
                WHERE p.destination_id = :destination_id 
                AND p.id != :package_id
                LIMIT :limit";
        $this->db->query($sql);
        $this->db->bind(':destination_id', $destination_id);
        $this->db->bind(':package_id', $package_id);
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
} 