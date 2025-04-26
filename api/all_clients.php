<?php
// ===== Connect to the database =====
include('../config/database.php');

// ===== Tell browsers this will return JSON =====
header('Content-Type: application/json');

// ===== API Key for simple security =====
$API_KEY = "MYSECRET123"; // Make sure it's same as before

// ===== Check for API Key =====
if (!isset($_GET['api_key']) || $_GET['api_key'] !== $API_KEY) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Unauthorized: Missing or invalid API key'
    ]);
    exit();
}

// ===== Fetch all clients =====
$sql = "SELECT id, full_name, gender, date_of_birth, phone_number, email, address FROM clients ORDER BY full_name";
$result = $conn->query($sql);

// ===== Prepare an array to store all clients =====
$clients = [];

if ($result->num_rows > 0) {
    while ($client = $result->fetch_assoc()) {
        $clients[] = $client;
    }
}

// ===== Output the list of clients =====
echo json_encode([
    'status' => 'success',
    'data' => $clients
], JSON_PRETTY_PRINT);
?>
