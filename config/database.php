<?php
// Database configuration
$servername = "localhost";  // Your database server (localhost when using XAMPP)
$username = "root";          // Default XAMPP username
$password = "";              // Default XAMPP password is empty
$dbname = "daktari_app";     // The name of your database

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    // If there is an error, stop the script and display the error message
    die("Connection failed: " . $conn->connect_error);
}


// (You can uncomment the line below to test)
// echo "Database connection successful!";
?>
