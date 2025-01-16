<?php
include "./connect.php";
include "./nav.php";

$status = "";
if (isset($_POST['Email']) && isset($_POST['ord_id'])) {
    // Sanitize and validate inputs
    $email = mysqli_real_escape_string($connect, $_POST['Email']);
    $order_id = mysqli_real_escape_string($connect, $_POST['ord_id']);

    if (!empty($email) && !empty($order_id)) {
        // Check if email exists in the user table
        $check_sql = "SELECT Email, ID FROM user WHERE Email = '$email'";
        $check_sql_run = mysqli_query($connect, $check_sql);

        if (mysqli_num_rows($check_sql_run) > 0) {
            $user_data = mysqli_fetch_assoc($check_sql_run);
            $user_id = $user_data['ID'];

            // Check for the order in the orders table
            $sql = "
                SELECT Order_ID, order_status, delivered 
                FROM orders 
                WHERE Order_ID = '$order_id' AND USER_ID = '$user_id'
            ";
            $sql_run = mysqli_query($connect, $sql);

            if (mysqli_num_rows($sql_run) > 0) {
                $order_data = mysqli_fetch_assoc($sql_run);

                // Determine order status
                if ($order_data['order_status'] == 1 && $order_data['delivered'] == 1) {
                    $status = "your order Delivered";
                } elseif ($order_data['order_status'] == 1 && $order_data['delivered'] == 0) {
                    $status = "your order has been Shipped";
                } else {
                    $status = "your order In progress";
                }
            } else {
                $status = "No order found for the given ID.";
            }
        } else {
            $status = "No user found with the provided email.";
        }
    } else {
        $status = "Email and Order ID cannot be empty.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/global_forms.css">
    <title>Track Your Order</title>
</head>
<body>
    <div class="container">
        <div class="forms-modify">
            <form action="" method="POST">
                <h1>Track Your Order</h1>
                <input type="email" name="Email" placeholder="Enter your email" required>
                <input type="number" name="ord_id" placeholder="Enter order ID" required>
                <button type="submit" name="show">Submit</button>
            </form>
        </div>
        <?php echo "<h2 class='status'>" . htmlspecialchars($status) . "</h2>"; ?>
    </div>
    <?php include "./footer.php"; ?>
    <script type="module" src="./js/forms.js"></script>
</body>
</html>
