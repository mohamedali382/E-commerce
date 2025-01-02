<?php
include "./authentication.php";
include './nav.php';
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
      <a href="./logout.php"><button>logout</button></a>
    <h2>Welcome<span></span></h2>
    <h5><?php echo $_SESSION['auth_user']['Fname']; ?></h5>
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