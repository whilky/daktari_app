<?php
include('config/database.php');

// Test the database connection
if (isset($pdo)) {
    echo "Database connection successful!";
} else {
    echo "Database connection failed.";
}
?>
