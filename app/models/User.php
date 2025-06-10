<?php
class User extends Model {
    protected $table = 'users';

    // Register user
    public function register($data) {
        try {
            // Log the registration attempt
            error_log("Attempting to register user with email: " . $data['email']);

            // Validate required fields
            if (empty($data['email']) || empty($data['password']) || empty($data['first_name']) || empty($data['last_name'])) {
                error_log("Missing required fields for registration");
                return false;
            }

            // Check if email already exists
            if ($this->findByEmail($data['email'])) {
                error_log("Email already exists: " . $data['email']);
                return false;
            }

            $this->db->beginTransaction();
            error_log("Transaction started");

            // Prepare statement
            $this->db->query('INSERT INTO users (username, email, password, first_name, last_name, full_name, role, avatar) 
                             VALUES (:username, :email, :password, :first_name, :last_name, :full_name, :role, :avatar)');

            // Generate username from email
            $username = explode('@', $data['email'])[0];
            error_log("Generated username: " . $username);
            
            // Create full name
            $full_name = $data['first_name'] . ' ' . $data['last_name'];
            error_log("Generated full name: " . $full_name);

            // Bind values
            $this->db->bind(':username', $username);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':first_name', $data['first_name']);
            $this->db->bind(':last_name', $data['last_name']);
            $this->db->bind(':full_name', $full_name);
            $this->db->bind(':role', 'user');
            $this->db->bind(':avatar', 'default-avatar.jpg');

            error_log("Values bound, attempting to execute query");

            // Execute
            if($this->db->execute()) {
                $this->db->commit();
                error_log("User registered successfully: " . $data['email']);
                return true;
            } else {
                $this->db->rollBack();
                error_log("Registration failed for email: " . $data['email']);
                return false;
            }
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("PDO Error during registration for email " . $data['email'] . ": " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Unexpected error during registration for email " . $data['email'] . ": " . $e->getMessage());
            return false;
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
        try {
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);
            $row = $this->db->single();
            return $row;
        } catch (Exception $e) {
            error_log("Error finding user by email: " . $e->getMessage());
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
        try {
            $this->db->query('SELECT id, username, email, first_name, last_name, full_name, role, created_at FROM users');
            return $this->db->resultSet();
        } catch (Exception $e) {
            error_log("Error getting all users: " . $e->getMessage());
            return [];
        }
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
     public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        
        $row = $this->db->single();
        
        return $row;
    }

    // Check if users table exists and has correct structure
    public function checkTableStructure() {
        try {
            // Check if table exists
            if (!$this->db->tableExists('users')) {
                error_log("Users table does not exist");
                return false;
            }

            // Get table columns
            $columns = $this->db->getColumns('users');
            if (empty($columns)) {
                error_log("Failed to get columns for users table");
                return false;
            }

            $requiredColumns = ['id', 'username', 'email', 'password', 'first_name', 'last_name', 'full_name', 'avatar', 'role', 'created_at'];
            
            $existingColumns = array_map(function($col) {
                return $col->name;
            }, $columns);

            $missingColumns = array_diff($requiredColumns, $existingColumns);
            
            if (!empty($missingColumns)) {
                error_log("Missing columns in users table: " . implode(', ', $missingColumns));
                return false;
            }

            return true;
        } catch (Exception $e) {
            error_log("Error checking table structure: " . $e->getMessage());
            return false;
        }
    }
} 