<?php
include './authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/orderDetails.css">
    <title>Order details</title>
</head>
<body>
<header>
      <div class="offer">free shipping on orders over 200 AED</div>
      <div class="head">
      <div><a href="./profile.php">Account</a></div>
        <div><h1>BuRd</h1></div>
        <div class="personals">
          <a href="./signForms.php">sign in</a>
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
        <section>
            <div id="details">
                
            </div>
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
    <script type="module" src="./js/orderDetails.js"></script>
</body>
</html>