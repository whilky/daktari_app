<?php
session_start();
include('config/database.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$clients = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search_term = trim($_POST['search']);

    if ($search_term !== '') {
        $stmt = $conn->prepare("SELECT * FROM clients WHERE full_name LIKE ?");
        $like_term = "%$search_term%";
        $stmt->bind_param("s", $like_term);
        $stmt->execute();
        $result = $stmt->get_result();
        $clients = $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Client - Daktari App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Search Client</h2>
        <form method="POST">
            <input type="text" name="search" placeholder="Enter full name..." required>
            <button type="submit">Search</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <h3>Results:</h3>
            <?php if (count($clients) > 0): ?>
                <ul>
                    <?php foreach ($clients as $client): ?>
                        <li>
                            <?= htmlspecialchars($client['full_name']) ?> - 
                            <a href="view_profile.php?id=<?= $client['id'] ?>">View Profile</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No clients found.</p>
            <?php endif; ?>
        <?php endif; ?>

        <p><a href="dashboard.php">← Back to Dashboard</a></p>
    </div>
</body>
</html>
