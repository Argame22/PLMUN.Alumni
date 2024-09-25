php
<?php
// db.php

// Database configuration
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Your database username (default for many installations)
$password = "12345"; // Your database password (leave empty if no password)
$dbname = "Alumni_Database"; // The name of the database

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set charset to UTF-8 for better character handling
$conn->set_charset("utf8");

?>