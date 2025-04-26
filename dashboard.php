<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Daktari App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, Dr. <?= htmlspecialchars($_SESSION['user_name']) ?></h2>
        <div class="dashboard-links">
            <a href="create_program.php" class="dashboard-link">Create Health Program</a>
            <a href="register_client.php" class="dashboard-link">Register New Client</a>
            <a href="enroll_client.php" class="dashboard-link">Enroll Client in Program</a>
            <a href="search_client.php" class="dashboard-link">Search for Client</a>
            <a href="view_profile.php" class="dashboard-link">View Client Profile</a>
        </div>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
