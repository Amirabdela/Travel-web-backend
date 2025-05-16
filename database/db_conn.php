<?php
$server = "localhost";
$username = "root";
$password = "";
<<<<<<< HEAD
$conn = new mysqli($server, $username, $password);
if (!$conn->connect_error) {
 die("Connection failed: " );
}
echo "Connected successfully";
?>
<?php

?>
=======

// SQL statement to create a database
$sql = "CREATE DATABASE user";

// Create connection
$conn = new mysqli($server, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

// Execute SQL query
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

// Close connection
$conn->close();
?>
>>>>>>> aa0917b605de5a0ceab4209cd0f429ad664d9daf
