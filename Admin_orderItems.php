<?php
include './connect.php';
$orderID = $_GET['ID'];
$orderID = intval($orderID); // Ensure it's an integer

$sql = "SELECT 
            order_items.*,
            products_sizes.size, 
            products_sizes.price,
            orders.Total_Price, 
            orders.order_status, 
            orders.delivered,
            product.pro_image, 
            product.Pro_name 
        FROM order_items 
        JOIN product 
        ON order_items.product_id = product.Pro_ID 
        JOIN orders 
        ON order_items.Ord_ID = orders.Order_ID
        JOIN products_sizes 
        ON order_items.price_Id = products_sizes.id
        WHERE order_items.Ord_ID = ?";

$stmt = $connect->prepare($sql);
if (!$stmt) {
    die("SQL preparation failed: " . $connect->error);
}

// Bind the order ID as an integer
$stmt->bind_param("i", $orderID);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/admin_Ord_details.css">
</head>
<body>
    <main>
        
    <?php
            // echo "<h1> ".$orderID."</h1>";
            if($result->num_rows>0)
            {
                $status = "In progress";
                while($row = $result->fetch_assoc())
                {
                    $total = $row['Total_Price'];
                    if($row['order_status'] == 1 && $row['delivered'] == 1)
                    {
                        $status = "delivered";
                    }
                    else if($row['order_status'] == 1 && $row['delivered'] == 0)
                    {
                        $status = "shipped";
                    }
                    $imageData = base64_encode($row['pro_image']);
                    $mimeType = 'image/jpeg'; // Adjust MIME type based on your images
                    
                    echo "
                    <div class='list'>
                        <div class='product-image'>
                            <img src='data:$mimeType;base64,$imageData' alt='Product Image'>
                        </div>
                        <div class='product-details'>
                            <h3 class='product-name'>Name: " . htmlspecialchars($row['Pro_name']) . "</h3>
                            <h3 class='product-size'>Size: " . htmlspecialchars($row['size']) . "</h3>
                            <h3 class='product-price'>Price: $" . htmlspecialchars($row['price']) . "</h3>
                            <h3 class='product-count'>Count: " . htmlspecialchars($row['count']) . "</h3>
                        </div>
                    </div>
                    ";
                } 
            }
            echo "
            <div class='info'><h3>Total Price: " .$total. "</h3></div>
            <div class='info'><h3>status: " .$status. "</h3></div>";
            if($status != "delivered")
            {
                if($status == "In progress")
                {
                echo "<form method='POST'>
                <button name='sent'>sent</button>
                <button name='delivered'>delivered</button>
                </form>";
                }
                else if ($status == "shipped")
                {
                    echo "<form method='POST'>
                    <button name='delivered'>delivered</button>
                    </form>";
                }
                if(isset($_POST['sent']))
                {
                    $sql3 = "UPDATE orders SET order_status = 1 WHERE Order_ID = $orderID";
                    if($connect->query($sql3) == True)
                    {   
                        echo "<div><h3>Order marked as sent successfully!</h3></div>";
                        $status = "shipped";
                    } 
                    else {
                        echo "Error updating record: " . $connect->error;
                    
                    }
                }
                if(isset($_POST['delivered']))
                {
                    $sql3 = "UPDATE orders SET delivered = 1 WHERE Order_ID = $orderID";
                    if($connect->query($sql3) == True)
                    {   
                        echo "<div><h3>Order marked as delivered successfully!</h3></div>";
                        $status = "delivered";
                    } 
                    else {
                        echo "Error updating record: " . $connect->error;
                    
                    }
                }
            }
            
            ?>
    <a href="./Admin_ordersList.php">back</a>
    </main>
</body>
</html>