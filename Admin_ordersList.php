<?php
include './connect.php';
$sql = "SELECT * FROM orders";
$result = $connect->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/admin_list.css">
</head>
<body>
    <h1>orders list</h1>
    <main>
        <div class="list">

            <?php
            if($result->num_rows>0)
            {
                while($row = $result->fetch_assoc())
                {
                    echo "
                    <div class='order'>
                        <div class='data'><h3>Order ID: " . $row['Order_ID'] . "</h3></div>
                        <div class='data'><h3>Total Price: " . $row['Total_Price'] . "</h3></div>
                        <div class='data'><h3>Date: " . $row['Date'] . "</h3></div>
                        <div class='data'><h3>ID: " . $row['Order_ID'] . "</h3></div>
                        <a href='./Admin_orderItems.php?ID=" . $row['Order_ID'] . "'><button>view</button></a>
                    </div>
                    ";
                }
            }
            ?>
        </div>
        <div class="dashboard-button-container">
            <a href="dashboard.php" class="dashboard-button">Return to Dashboard</a>
        </div>
    </main>
</body>
</html>