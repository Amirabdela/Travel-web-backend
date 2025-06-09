<?php
class User extends Model {
    protected $table = 'users';

    // Register user
    public function register($data) {
        try {
            $this->db->query('INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)');
            
            // Bind values
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute
            return $this->db->execute();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation
                return false;
            }
            throw $e;
        }
    }

    // Login user
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $user = $this->db->single();

        if($user) {
            if(password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    // Find user by email
    public function findByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        // Check row
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Update user profile
    public function updateProfile($id, $data) {
        // If password is being updated, hash it
        if(isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        return $this->update($id, $data);
    }

    // Get user with role
    public function getUserWithRole($id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get all users
    public function getAllUsers() {
        return $this->getAll();
    }

    // Search users
    public function searchUsers($query) {
        $fields = ['first_name', 'last_name', 'email'];
        return $this->search($query, $fields);
    }

    // Get users with pagination
    public function getUsersPaginated($page = 1, $per_page = 10) {
        return $this->getPaginated($page, $per_page);
    }

    // Count total users
    public function getTotalUsers() {
        return $this->count();
    }
} 