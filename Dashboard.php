<?php
include './connect.php';
// $sql = "SELECT orders.Total_Price, user.Fname, messages.FirstName, messages.LastName
// FROM orders
// CROSS JOIN user
// CROSS JOIN messages
// ORDER BY orders.Total_Price DESC, user.Fname DESC, messages.FirstName DESC, messages.LastName DESC
// LIMIT 1";

$sql = "SELECT orders.Total_Price, user.Fname, messages.FirstName, messages.LastName
from orders
Cross join user
cross join messages
ORDER BY orders.Total_Price DESC, user.Fname DESC
LIMIT 1
";
$result = $connect->query($sql); $data = []; if ($result->num_rows > 0) { while
($row = $result->fetch_assoc()) { $data[] = [ 'last_payment' =>
$row['Total_Price'], 'new_user' => $row['Fname'], 'message_fname' =>
$row['FirstName'], 'message_lname' => $row['LastName'], ]; } } ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Main Page</title>
    <link rel="stylesheet" href="./style/Dashboard.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>
  <body>
    <header>
      <h1>Admin Dashboard</h1>
    </header>
    <main>
      <section class="links">
        <a href="./Admin_orders.php"
          ><div class="adminPages">
            <div class="photo">
              <img src="./img/rectangular-bar-chart-svgrepo-com.svg" alt="" />
            </div>
            <h2>Orders</h2>
          </div></a
        >
        <a href="./Admin_ordersList.php"
          ><div class="adminPages">
            <div class="photo">
              <img src="./img/notification-bell-svgrepo-com.svg" alt="" />
            </div>
            <h2>Pending orders</h2>
          </div></a
        >
        <a href="./AddProduct.php"
          ><div class="adminPages">
            <div class="photo">
              <img src="./img/up-arrow-with-tray-svgrepo-com.svg" alt="" />
            </div>
            <h2>Add Product</h2>
          </div></a>
          <a href="./Admin_Messages.php"
          ><div class="adminPages">
            <div class="photo">
              <img src="./img/message-square-list-svgrepo-com.svg" alt="" />
            </div>
            <h2>Add Product</h2>
          </div></a>
      </section>
      <section class="activity">
        <div class="header-board">
          <h1>Activity</h1>
          <p>Last week data</p>
        </div>
        <div class="board">
          <div class="notes">
            <div class="note red">
              <h2>
                <?php echo $data[0]['last_payment']; ?>
                USD was added
              </h2>
              <p>
                Payment of
                <?php echo $data[0]['last_payment']; ?>
                USD was successfully processed.
              </p>
            </div>
            <div class="note blue">
              <h2>
                New customer:
                <?php echo $data[0]['new_user']; ?>
                joined
              </h2>
              <p>
                Welcome to our platform,
                <?php echo $data[0]['new_user']; ?>!
              </p>
            </div>
            <div class="note green">
              <h2>
                New messages from
                <?php echo $data[0]['message_fname']; echo " "; echo $data[0]['message_lname']; ?>
              </h2>
              <p>
                You have new messages from
                <?php echo $data[0]['message_fname']; ?>
                <?php echo $data[0]['message_lname']; ?>.
              </p>
            </div>
          </div>

          <div class="graph">
            <canvas class="charts" id="graph"></canvas>
          </div>
        </div>
      </section>
      <script src="./js/visualization.js"></script>
    </main>
  </body>
</html>
