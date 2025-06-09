<?php
class Destination extends Model {
    protected $table = 'destinations';

    public function __construct() {
        parent::__construct();
    }

    public function getFeaturedDestinations($limit = 6) {
        $sql = "SELECT * FROM destinations 
                WHERE featured = 1 
                ORDER BY RAND() LIMIT :limit";
        $this->db->query($sql);
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    public function getDestinationWithDetails($id) {
        $sql = "SELECT * FROM destinations WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function searchDestinations($query) {
        $sql = "SELECT * FROM destinations 
                WHERE name LIKE :query 
                OR description LIKE :query";
        $this->db->query($sql);
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }

    public function getDestinationsByRegion($region) {
        $sql = "SELECT * FROM destinations 
                WHERE location = :region";
        $this->db->query($sql);
        $this->db->bind(':region', $region);
        return $this->db->resultSet();
    }

    public function getDestinationsByType($type) {
        $sql = "SELECT * FROM destinations 
                WHERE category = :type";
        $this->db->query($sql);
        $this->db->bind(':type', $type);
        return $this->db->resultSet();
    }

    public function getDestinationsByClimate($climate) {
        $sql = "SELECT * FROM destinations 
                WHERE climate = :climate";
        $this->db->query($sql);
        $this->db->bind(':climate', $climate);
        return $this->db->resultSet();
    }

    public function getDestinationsByBestTime($best_time) {
        $sql = "SELECT * FROM destinations 
                WHERE best_time_to_visit = :best_time";
        $this->db->query($sql);
        $this->db->bind(':best_time', $best_time);
        return $this->db->resultSet();
    }

    public function getDestinationGallery($destination_id) {
        $sql = "SELECT * FROM destination_gallery 
                WHERE destination_id = :destination_id";
        $this->db->query($sql);
        $this->db->bind(':destination_id', $destination_id);
        return $this->db->resultSet();
    }

    public function getDestinationAttractions($destination_id) {
        $sql = "SELECT * FROM attractions 
                WHERE destination_id = :destination_id";
        $this->db->query($sql);
        $this->db->bind(':destination_id', $destination_id);
        return $this->db->resultSet();
    }

    public function getDestinationReviews($destination_id) {
        $sql = "SELECT r.*, u.first_name, u.last_name, u.avatar
                FROM destination_reviews r
                JOIN users u ON r.user_id = u.id
                WHERE r.destination_id = :destination_id
                ORDER BY r.created_at DESC";
        $this->db->query($sql);
        $this->db->bind(':destination_id', $destination_id);
        return $this->db->resultSet();
    }

    public function addReview($data) {
        $sql = "INSERT INTO destination_reviews (destination_id, user_id, rating, comment, created_at)
                VALUES (:destination_id, :user_id, :rating, :comment, NOW())";
        $this->db->query($sql);
        $this->db->bind(':destination_id', $data['destination_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':comment', $data['comment']);
        return $this->db->execute();
    }
} 