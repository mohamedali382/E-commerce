<?php
include "./backend/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/resetPass.css">
    <title>join-us</title>
</head>
<body>
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
            <form action="./backend/resendcode.php" method="POST">
                <h1>field your email address</h1>
                <input type="email" name="Email" placeholder="Email">
                <button type="submit" name="resend">Submit</button>
            </form>
            </div>
    </div>
    <script type="module" src="./js/forms.js"></script>
    <script src="./js/style.js"></script>
</body>
</html>