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
    $full_name = trim($_POST['full_name']);
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $phone_number = trim($_POST['phone_number']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    if ($full_name === '' || $gender === '' || $date_of_birth === '') {
        $error = "Please fill in all required fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO clients (full_name, gender, date_of_birth, phone_number, email, address) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $full_name, $gender, $date_of_birth, $phone_number, $email, $address);

        if ($stmt->execute()) {
            $success = "Client registered successfully!";
        } else {
            $error = "Error occurred while saving client.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Client - Daktari App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Register New Client</h2>
        <?php if ($success): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php elseif ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="full_name" placeholder="Full Name" required>
            
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <input type="date" name="date_of_birth" required>
            <input type="text" name="phone_number" placeholder="Phone Number">
            <input type="email" name="email" placeholder="Email">
            <input type="text" name="address" placeholder="Address">
            <button type="submit">Register Client</button>
        </form>
        <p><a href="dashboard.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
