<?php
class Contact {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function addMessage($name, $email, $message, $subject = '') {
        $this->db->query('INSERT INTO contacts (name, email, subject, message) VALUES (:name, :email, :subject, :message)');
        
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':subject', $subject);
        $this->db->bind(':message', $message);

        return $this->db->execute();
    }

    public function getMessages() {
        $this->db->query('SELECT * FROM contacts ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getMessageById($id) {
        $this->db->query('SELECT * FROM contacts WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function deleteMessage($id) {
        $this->db->query('DELETE FROM contacts WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
} 