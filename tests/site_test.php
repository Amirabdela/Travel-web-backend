<?php
require_once '../app/libraries/Database.php';
require_once '../app/helpers/session_helper.php';

class SiteTest {
    private $db;
    private $testResults = [];
    private $testUser = [
        'username' => 'testuser',
        'email' => 'test@example.com',
        'password' => 'testpass123',
        'full_name' => 'Test User'
    ];

    public function __construct() {
        try {
            $this->db = new Database();
            $this->testResults['database_connection'] = true;
        } catch (Exception $e) {
            $this->testResults['database_connection'] = false;
            $this->testResults['database_error'] = $e->getMessage();
        }
    }

    public function runAllTests() {
        echo "<h1>Travel Site Test Results</h1>";
        echo "<div style='font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto;'>";

        // Test Database Connection
        $this->testDatabaseConnection();

        // Test Database Tables
        $this->testDatabaseTables();

        // Test User Authentication
        $this->testUserAuthentication();

        // Test Package Management
        $this->testPackageManagement();

        // Test Booking System
        $this->testBookingSystem();

        // Test Newsletter Subscription
        $this->testNewsletterSubscription();

        // Display Results
        $this->displayResults();

        echo "</div>";
    }

    private function testDatabaseConnection() {
        echo "<h2>Testing Database Connection</h2>";
        if ($this->testResults['database_connection']) {
            echo "<p style='color: green;'>✓ Database connection successful</p>";
        } else {
            echo "<p style='color: red;'>✗ Database connection failed: " . $this->testResults['database_error'] . "</p>";
        }
    }

    private function testDatabaseTables() {
        echo "<h2>Testing Database Tables</h2>";
        try {
            $tables = $this->db->getTables();
            $requiredTables = ['users', 'packages', 'bookings', 'newsletter_subscribers'];
            
            foreach ($requiredTables as $table) {
                if ($this->db->tableExists($table)) {
                    echo "<p style='color: green;'>✓ Table '{$table}' exists</p>";
                } else {
                    echo "<p style='color: red;'>✗ Table '{$table}' is missing</p>";
                }
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Error checking tables: " . $e->getMessage() . "</p>";
        }
    }

    private function testUserAuthentication() {
        echo "<h2>Testing User Authentication</h2>";
        try {
            // Test user registration
            $this->db->query("INSERT INTO users (username, email, password, full_name) VALUES (:username, :email, :password, :full_name)");
            $this->db->bind(':username', $this->testUser['username']);
            $this->db->bind(':email', $this->testUser['email']);
            $this->db->bind(':password', password_hash($this->testUser['password'], PASSWORD_DEFAULT));
            $this->db->bind(':full_name', $this->testUser['full_name']);
            
            if ($this->db->execute()) {
                echo "<p style='color: green;'>✓ User registration successful</p>";
                
                // Test user login
                $this->db->query("SELECT * FROM users WHERE username = :username");
                $this->db->bind(':username', $this->testUser['username']);
                $user = $this->db->single();
                
                if ($user && password_verify($this->testUser['password'], $user->password)) {
                    echo "<p style='color: green;'>✓ User login successful</p>";
                } else {
                    echo "<p style='color: red;'>✗ User login failed</p>";
                }
            } else {
                echo "<p style='color: red;'>✗ User registration failed</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Authentication test error: " . $e->getMessage() . "</p>";
        }
    }

    private function testPackageManagement() {
        echo "<h2>Testing Package Management</h2>";
        try {
            // Test package creation
            $this->db->query("INSERT INTO packages (title, description, price, duration_days) VALUES (:title, :description, :price, :duration)");
            $this->db->bind(':title', 'Test Package');
            $this->db->bind(':description', 'Test Description');
            $this->db->bind(':price', 100.00);
            $this->db->bind(':duration', 3);
            
            if ($this->db->execute()) {
                echo "<p style='color: green;'>✓ Package creation successful</p>";
                
                // Test package retrieval
                $this->db->query("SELECT * FROM packages WHERE title = :title");
                $this->db->bind(':title', 'Test Package');
                $package = $this->db->single();
                
                if ($package) {
                    echo "<p style='color: green;'>✓ Package retrieval successful</p>";
                } else {
                    echo "<p style='color: red;'>✗ Package retrieval failed</p>";
                }
            } else {
                echo "<p style='color: red;'>✗ Package creation failed</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Package management test error: " . $e->getMessage() . "</p>";
        }
    }

    private function testBookingSystem() {
        echo "<h2>Testing Booking System</h2>";
        try {
            // Test booking creation
            $this->db->query("INSERT INTO bookings (user_id, package_id, start_date, end_date, status) VALUES (:user_id, :package_id, :start_date, :end_date, :status)");
            $this->db->bind(':user_id', 1);
            $this->db->bind(':package_id', 1);
            $this->db->bind(':start_date', date('Y-m-d'));
            $this->db->bind(':end_date', date('Y-m-d', strtotime('+3 days')));
            $this->db->bind(':status', 'pending');
            
            if ($this->db->execute()) {
                echo "<p style='color: green;'>✓ Booking creation successful</p>";
                
                // Test booking retrieval
                $this->db->query("SELECT * FROM bookings WHERE user_id = :user_id");
                $this->db->bind(':user_id', 1);
                $booking = $this->db->single();
                
                if ($booking) {
                    echo "<p style='color: green;'>✓ Booking retrieval successful</p>";
                } else {
                    echo "<p style='color: red;'>✗ Booking retrieval failed</p>";
                }
            } else {
                echo "<p style='color: red;'>✗ Booking creation failed</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Booking system test error: " . $e->getMessage() . "</p>";
        }
    }

    private function testNewsletterSubscription() {
        echo "<h2>Testing Newsletter Subscription</h2>";
        try {
            // Test subscriber addition
            $this->db->query("INSERT INTO newsletter_subscribers (email, status) VALUES (:email, :status)");
            $this->db->bind(':email', 'test@example.com');
            $this->db->bind(':status', 'active');
            
            if ($this->db->execute()) {
                echo "<p style='color: green;'>✓ Newsletter subscription successful</p>";
                
                // Test subscriber retrieval
                $this->db->query("SELECT * FROM newsletter_subscribers WHERE email = :email");
                $this->db->bind(':email', 'test@example.com');
                $subscriber = $this->db->single();
                
                if ($subscriber) {
                    echo "<p style='color: green;'>✓ Subscriber retrieval successful</p>";
                } else {
                    echo "<p style='color: red;'>✗ Subscriber retrieval failed</p>";
                }
            } else {
                echo "<p style='color: red;'>✗ Newsletter subscription failed</p>";
            }
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Newsletter test error: " . $e->getMessage() . "</p>";
        }
    }

    private function displayResults() {
        echo "<h2>Test Summary</h2>";
        $totalTests = count($this->testResults);
        $passedTests = count(array_filter($this->testResults));
        
        echo "<p>Total Tests: {$totalTests}</p>";
        echo "<p>Passed Tests: {$passedTests}</p>";
        echo "<p>Failed Tests: " . ($totalTests - $passedTests) . "</p>";
    }

    public function cleanup() {
        try {
            // Clean up test data
            $this->db->query("DELETE FROM users WHERE username = :username");
            $this->db->bind(':username', $this->testUser['username']);
            $this->db->execute();

            $this->db->query("DELETE FROM packages WHERE title = :title");
            $this->db->bind(':title', 'Test Package');
            $this->db->execute();

            $this->db->query("DELETE FROM bookings WHERE user_id = :user_id");
            $this->db->bind(':user_id', 1);
            $this->db->execute();

            $this->db->query("DELETE FROM newsletter_subscribers WHERE email = :email");
            $this->db->bind(':email', 'test@example.com');
            $this->db->execute();

            echo "<p style='color: green;'>✓ Test data cleanup successful</p>";
        } catch (Exception $e) {
            echo "<p style='color: red;'>✗ Cleanup error: " . $e->getMessage() . "</p>";
        }
    }
}

// Run the tests
$tester = new SiteTest();
$tester->runAllTests();
$tester->cleanup(); 