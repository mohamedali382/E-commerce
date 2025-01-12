<?php
include './authentication.php';
$status = " "; // Initialize status message

if (isset($_POST['change'])) {

    // Get input values
    $New_Email = trim($_POST['New_Email']); // Trim to remove extra spaces

    // Check if the email field is not empty
    if (!empty($New_Email)) {

        // Update queries for both tables
        $sql_update_accounts = "UPDATE users_accounts SET Email = ? WHERE user_id = ?";
        $sql_update_users = "UPDATE user SET Email = ? WHERE ID = ?";

        // Start a transaction
        $connect->begin_transaction();

        try {
            // Prepare and execute the first query for `users_accounts`
            $stmt1 = $connect->prepare($sql_update_accounts);
            if ($stmt1 === false) {
                throw new Exception("Failed to prepare statement for users_accounts.");
            }
            $stmt1->bind_param("si", $New_Email, $_SESSION['auth_user']['User_ID']);
            $stmt1->execute();

            // Prepare and execute the second query for `users`
            $stmt2 = $connect->prepare($sql_update_users);
            if ($stmt2 === false) {
                throw new Exception("Failed to prepare statement for users.");
            }
            $stmt2->bind_param("si", $New_Email, $_SESSION['auth_user']['User_ID']);
            $stmt2->execute();

            // Commit the transaction
            $connect->commit();

            $status = "Email changed successfully";
        } catch (Exception $e) {
            // Roll back the transaction in case of any error
            $connect->rollback();
            $status = "An error occurred: " . $e->getMessage();
        }

        // Close the statements
        if (isset($stmt1)) $stmt1->close();
        if (isset($stmt2)) $stmt2->close();
    } else {
        $status = "Email field cannot be empty.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/data_changes.css">
    <title>Change Email</title>
</head>
<body>
    <main>
        <form action="" method="POST">
            <h2>Change Email</h2>
            <input type="Email" name="New_Email" placeholder="Email" required>
            <button type="submit" name="change">Reset</button>
            <div class="messages">
        <?php
            echo "<h3>".$status."</h3>";
        ?>
        </div>
        </form>
        <a href="./Profile.php">back to profile</a>
    </main>
</body>
</html>