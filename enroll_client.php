<?php
session_start();
include('config/database.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch clients
$clients_result = $conn->query("SELECT id, full_name FROM clients ORDER BY full_name");

// Fetch programs
$programs_result = $conn->query("SELECT id, name FROM programs ORDER BY name");

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $program_ids = $_POST['program_ids'];

    if (!$client_id || empty($program_ids)) {
        $error = "Please select a client and at least one program.";
    } else {
        foreach ($program_ids as $program_id) {
            $stmt = $conn->prepare("INSERT INTO enrollments (client_id, program_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $client_id, $program_id);
            $stmt->execute();
        }
        $success = "Client successfully enrolled in selected program(s).";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Enroll Client - Daktari App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Enroll Client in Program</h2>

        <?php if ($success): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php elseif ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Select Client:</label>
            <select name="client_id" required>
                <option value="">-- Choose Client --</option>
                <?php while ($client = $clients_result->fetch_assoc()): ?>
                    <option value="<?= $client['id'] ?>"><?= htmlspecialchars($client['full_name']) ?></option>
                <?php endwhile; ?>
            </select>

            <label>Select Program(s):</label>
            <?php while ($program = $programs_result->fetch_assoc()): ?>
                <div>
                    <label>
                        <input type="checkbox" name="program_ids[]" value="<?= $program['id'] ?>">
                        <?= htmlspecialchars($program['name']) ?>
                    </label>
                </div>
            <?php endwhile; ?>

            <button type="submit">Enroll</button>
        </form>

        <p><a href="dashboard.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
