<?php
class Booking extends Model {
    protected $table = 'bookings';

    public function __construct() {
        parent::__construct();
    }
    public function createBooking($data) {
    $this->db->query('INSERT INTO bookings 
        (user_id, booking_type, item_id, start_date, end_date, total_price) 
        VALUES (:user_id, :booking_type, :item_id, :start_date, :end_date, :total_price)');
    
    $this->db->bind(':user_id', $data['user_id']);
    $this->db->bind(':booking_type', $data['booking_type']);
    $this->db->bind(':item_id', $data['item_id']);
    $this->db->bind(':start_date', $data['start_date']);
    $this->db->bind(':end_date', $data['end_date']);
    $this->db->bind(':total_price', $data['total_price']);
    
    return $this->db->execute();
}
    public function getBookingsByUser($user_id) {
        $sql = "SELECT b.*, p.title as package_title, p.image_path as package_image, d.name as destination_name
                FROM bookings b
                LEFT JOIN packages p ON b.package_id = p.id
                LEFT JOIN destinations d ON p.destination_id = d.id
                WHERE b.user_id = :user_id
                ORDER BY b.start_date DESC";
        $this->db->query($sql);
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function getBookingWithDetails($id) {
        $sql = "SELECT b.*, p.title as package_title, p.image_path as package_image, d.name as destination_name
                FROM bookings b
                LEFT JOIN packages p ON b.package_id = p.id
                LEFT JOIN destinations d ON p.destination_id = d.id
                WHERE b.id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getBookingsByPackage($package_id) {
        $sql = "SELECT * FROM bookings WHERE package_id = :package_id ORDER BY start_date DESC";
        $this->db->query($sql);
        $this->db->bind(':package_id', $package_id);
        return $this->db->resultSet();
    }

    public function getBookingsByHotel($hotel_id) {
        $sql = "SELECT * FROM bookings WHERE hotel_id = :hotel_id ORDER BY start_date DESC";
        $this->db->query($sql);
        $this->db->bind(':hotel_id', $hotel_id);
        return $this->db->resultSet();
    }

    public function getBookingsByCar($car_id) {
        $sql = "SELECT * FROM bookings WHERE car_id = :car_id ORDER BY start_date DESC";
        $this->db->query($sql);
        $this->db->bind(':car_id', $car_id);
        return $this->db->resultSet();
    }

    public function cancelBooking($id, $user_id) {
        $sql = "UPDATE bookings SET status = 'cancelled' WHERE id = :id AND user_id = :user_id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $user_id);
        return $this->db->execute();
    }

    public function confirmBooking($id) {
        $sql = "UPDATE bookings SET status = 'confirmed' WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getPendingBookings() {
        $sql = "SELECT * FROM bookings WHERE status = 'pending' ORDER BY created_at DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
} 