<?php
include './connect.php';

// Fetch all messages from the database
$sql = "SELECT * FROM messages";
$result = $connect->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/Admin_messages.css">
    <title>Admin Messages</title>
</head>
<body>
    <main class="messages-container">
        <h1>Messages from Users</h1>
        <?php if ($result->num_rows > 0): ?>
            <div class="messages">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="message-card">
                        <h2><?= htmlspecialchars($row['FirstName']) . ' ' . htmlspecialchars($row['LastName']); ?></h2>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($row['Number']); ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($row['Email']); ?></p>
                        <p><strong>Message:</strong> <?= htmlspecialchars($row['message']); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="no-messages">No messages found.</p>
        <?php endif; ?>
        <div class="dashboard-button-container">
            <a href="dashboard.php" class="dashboard-button">Return to Dashboard</a>
        </div>
    </main>
</body>
</html>
