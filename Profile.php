<?php
include "./authentication.php";
include './nav.php';

$sql = "SELECT * FROM orders WHERE USER_ID = ' " . $_SESSION['auth_user']['User_ID'] . "'";
$result = $connect->query($sql);

$orders = array();

if($result->num_rows > 0)
{
  while($row = $result->fetch_assoc())
  {
    $orders[] = $row;
  }
}
else{
    echo "";
}
$converting = json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('orders.json',$converting);

foreach ($orders as $order) {
    $sql2 = "SELECT 
    order_items.*, 
    products_sizes.size, 
    products_sizes.price
FROM 
    order_items
JOIN 
    products_sizes 
ON 
    order_items.price_Id = products_sizes.id
WHERE 
    order_items.Ord_ID = '" . $order["Order_ID"] . "'
    
    ";
    $result2 = $connect->query($sql2);

    if ($result2->num_rows > 0) {
        while ($order_item = $result2->fetch_assoc()) {
            $order_items[] = $order_item;
        }
    }
}
if(!empty($order_items))
{
$converting_ietms = json_encode($order_items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('orderItems.json',$converting_ietms);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/profile.css">
    <title>Document</title>
</head>
<body>
    <main>
      <div class="welcome_message">
    <h2>Welcome<span></span></h2>
    <h5><?php echo $_SESSION['auth_user']['Fname']; ?></h5>
    <h5><?php echo $_SESSION['auth_user']['User_ID']; ?></h5>
    <a href="./change_password.php"><button>change password</button></a>
    <a href="./change_Email.php"><button>change email</button></a>
    <a href="./logout.php"><button>logout</button></a>
      </div>
      <section class="pending_orders">
        <h3>pending</h3>

      </section>
      <section class="history_orders">
        <h3>history</h3>
      </section>
    </main>
    <?php 
    include './footer.php';
    ?>
    <script type="module" src="./js/history.js"></script>
</body>
</html>