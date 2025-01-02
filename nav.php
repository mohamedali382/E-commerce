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
      <div><a href="./profile.php">Account</a></div>
        <div><h1>BuRd</h1></div>
        <div class="personals">
        <?php
          if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
            echo '<a href="./Profile.php">Dashboard</a>';
          }
          else{
            echo '<a href="./signForms.php">Sign in</a>';
          }
        ?>
          <a href="./cart.php">Cart</a>
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
</body>
</html>