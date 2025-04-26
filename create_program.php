<?php
session_start();
include('config/database.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $program_name = trim($_POST['program_name']);
    $description = trim($_POST['description']);

    if ($program_name === '') {
        $error = "Program name is required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO programs (name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $program_name, $description);

        if ($stmt->execute()) {
            $success = "Health program created successfully!";
        } else {
            $error = "Something went wrong. Try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Program - Daktari App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Create Health Program</h2>
        <?php if ($success): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php elseif ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="program_name" placeholder="Program Name (e.g. HIV)" required>
            <input type="text" name="description" placeholder="Short Description (optional)">
            <button type="submit">Create Program</button>
        </form>
        <p><a href="dashboard.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
