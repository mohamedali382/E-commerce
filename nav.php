<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/global_rules.css">
</head>
<body>
<header>
      <div class="offer">free shipping on orders over 200 AED</div>
      <div class="head">
      <div><a href="#">Account</a></div>
        <div><h1>BuRd</h1></div>
        <div class="personals">
        <?php
          if (!isset($_SESSION['authenticated'])) {
            echo '<a href="./signForms.php">Sign in</a>';
          }
          else{
            echo '<a href="./Profile.php">Profile</a>';
          }
        ?>
          <a href="./cart.php">Cart <span id="Cart_counter"></span></a>
        </div>
      </div>
      <nav>
        <ul>
          <li><a href="./index.php">Home</a></li>
          <li><a href="./Products.php">Shop All</a></li>
          <li><a href="./aboutUs.php">about us</a></li>
          <li><a href="./ContactUs.php">contact us</a></li>
        </ul>
      </nav>
    </header>
    <script type="module" src="./js/counter.js"></script>
</body>
</html>