<?php
include './authentication.php';
$status = " "; // Initialize status message

if (isset($_POST['change'])) {

    // Get input values
    $old_pass = $_POST['old_Password'];
    $new_pass = $_POST['new_Password'];
    $conf_pass = $_POST['conf_Password'];

    // Check if any field is empty
    if ($old_pass !== null && $new_pass !== null && $conf_pass !== null) {

        // Query to check the current password from the database
        $sql_check = "SELECT users_accounts.Password
                      FROM users_accounts
                      WHERE users_accounts.user_id = " . $_SESSION['auth_user']['User_ID'];

        $sql_run = $connect->query($sql_check);
        $password = $sql_run->fetch_assoc();

        if ($old_pass == $password['Password']) {
            if ($new_pass == $conf_pass) {
                $sql_update = "UPDATE users_accounts SET Password = ? WHERE user_id = ?";
                if ($sql_new = $connect->prepare($sql_update)) {
                    $sql_new->bind_param("si", $new_pass, $_SESSION['auth_user']['User_ID']);
                    $sql_new->execute();
                    $status = "Password changed successfully!";
                }
            } else {
                $status = "Confirm password does not match the new password.";
            }
        } else {
            $status = "Your old password is incorrect.";
        }

    } else {
        $status = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/data_changes.css">
    <title>Change Password</title>
</head>
<body>
    <main>
        <form action="" method="POST">
            <h2>Change Password</h2>
            <input type="password" name="old_Password" placeholder="Old password" required>
            <input type="password" name="new_Password" placeholder="New password" required>
            <input type="password" name="conf_Password" placeholder="Confirm password" required>
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
