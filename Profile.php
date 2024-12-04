<?php
include "./authentication.php";
// $sql = "SELECT * FORM orders WHERE USER_ID = ['auth_user']['user_id']";

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
<header>
      <div class="offer">free shipping on orders over 200 AED</div>
      <div class="head">
      <div><a href="./Profile.php">Dashboard</a></div>
        <div><h1>BuRd</h1></div>
        <div class="personals">
          <a href="./signForms.php">Account</a>
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
    <main>
      <div class="welcome_message">
      <a href="./logout.php"><button>logout</button></a>
    <h2>Welcome<span></span></h2>
    <h5>email: <?= $_SESSION['auth_user']['Email']?></h5>
      </div>
      <section class="pending_orders">
        <h3>pending</h3>

      </section>
      <section class="history_orders">
        <h3>history</h3>
      </section>
    </main>
    <footer>
      <div class="links">
        <h1>BuRd</h1>
      </div>
      <div class="links">
        <h3>Info</h3>
        <div class="spans">
          <span>Digital</span>
          <span>Print</span>
          <span>Tutorial</span>
          <span>FAQ</span>
        </div>
      </div>
      <div class="links">
        <h3>connect</h3>
        <div class="spans">
          <span><a href="#">instgram</a></span>
          <span><a href="#">Facebook</a></span>
          <span><a href="#">tiktok</a></span>
          <span><a href="#">contact</a></span>
        </div>
      </div>
      <div class="links">
        <h3>Pen Pals</h3>
        <div class="spans">
          <span><a href="#">instgram</a></span>
          <span><a href="#">Facebook</a></span>
        </div>
      </div>
    </footer>
    <script type="module" src="./js/history.js"></script>
</body>
</html>