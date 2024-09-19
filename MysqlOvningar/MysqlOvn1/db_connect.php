<?php
// Database credentials
$host = 'localhost'; // Usually 'localhost'
$dbname = 'company-db'; // Name of your database
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>