<?php
session_start();
include('config/database.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$client_id = $_GET['id'] ?? null;
$client = null;
$enrolled_programs = [];

if ($client_id) {
    // Fetch client details
    $stmt = $conn->prepare("SELECT * FROM clients WHERE id = ?");
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $client = $result->fetch_assoc();

    // Fetch enrolled programs
    $stmt = $conn->prepare("SELECT programs.name FROM enrollments 
                            JOIN programs ON enrollments.program_id = programs.id
                            WHERE enrollments.client_id = ?");
    $stmt->bind_param("i", $client_id);
    $stmt->execute();
    $program_result = $stmt->get_result();

    while ($program = $program_result->fetch_assoc()) {
        $enrolled_programs[] = $program['name'];
    }
}

if (!$client) {
    header('Location: search_client.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Client Profile - Daktari App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="profile-container">
        <h2>Client Profile: <?= htmlspecialchars($client['full_name']) ?></h2>
        
        <p><strong>Full Name:</strong> <?= htmlspecialchars($client['full_name']) ?></p>
        <p><strong>Gender:</strong> <?= htmlspecialchars($client['gender']) ?></p>
        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($client['date_of_birth']) ?></p>
        <p><strong>Phone Number:</strong> <?= htmlspecialchars($client['phone_number']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($client['email']) ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($client['address']) ?></p>

        <h3>Enrolled Programs</h3>
        <?php if (count($enrolled_programs) > 0): ?>
            <ul>
                <?php foreach ($enrolled_programs as $program): ?>
                    <li><?= htmlspecialchars($program) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>This client is not enrolled in any programs.</p>
        <?php endif; ?>

        <p><a href="dashboard.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
