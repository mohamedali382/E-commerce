<?php
include './connect.php';

$sql = "SELECT Order_ID, Total_Price,Date FROM orders";
$sql2 = "SELECT SUM(Total_Price) AS total_sum From orders";

$query = $connect->query($sql);
$totalQuery = $connect->query($sql2);
$totalRow = $totalQuery->fetch_assoc();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/admin_orders.css">
</head>
<body>
    <h1>All orders</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>total</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($query->num_rows > 0)
        {
            while($row = $query->fetch_assoc())
            {
                echo "<tr>
                        <td>" .$row['Order_ID'] ."</td>
                        <td>" .$row['Date'] ."</td>
                        <td>" .$row['Total_Price'] ."</td>
                ";
            }
        }
        ?>
        </tbody>
        <tfoot>
            <?php
                    echo "<td> total: ".$totalRow['total_sum']."";
                    
            ?>
        </tfoot>
    </table>
    <div class="dashboard-button-container">
            <a href="dashboard.php" class="dashboard-button">Return to Dashboard</a>
        </div>
</body>
</html>