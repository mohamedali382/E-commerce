<?php
include "./connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/resetPass.css">
    <title>join-us</title>
</head>
<body>
<header>
      <div class="offer">free shipping on orders over 200 AED</div>
      <div class="head">
      <div><a href="./Dashboard.php">Dashboard</a></div>
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
    <div class="container">
        <div class="alert">
            <?php
            if(isset($_SESSION['status']))
            {
                echo"<h4>".$_SESSION['status']."</h1>";
                unset($_SESSION['status']);
            }
            ?>
        </div>
        <div class="forms-modify">
            <form action="resendcode.php" method="POST">
                <h1>field your email address</h1>
                <input type="email" name="Email" placeholder="Email">
                <button type="submit" name="resend">Submit</button>
            </form>
            </div>
    </div>
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
    <script type="module" src="./js/forms.js"></script>
    <script src="./js/style.js"></script>
</body>
</html>