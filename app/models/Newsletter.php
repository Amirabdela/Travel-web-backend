<?php
class Newsletter extends Model {
    protected $table = 'newsletter_subscribers';

    public function __construct() {
        parent::__construct();
    }

    public function subscribe($email) {
        $sql = "INSERT INTO newsletter_subscribers (email, subscribed_at) VALUES (:email, datetime('now'))";
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        return $this->db->execute();
    }

    public function unsubscribe($email) {
        $sql = "DELETE FROM newsletter_subscribers WHERE email = :email";
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        return $this->db->execute();
    }

    public function isSubscribed($email) {
        $sql = "SELECT * FROM newsletter_subscribers WHERE email = :email";
        $this->db->query($sql);
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function getAllSubscribers() {
        $sql = "SELECT * FROM newsletter_subscribers ORDER BY subscribed_at DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
} 