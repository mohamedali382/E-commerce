<?php
include "./connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/global_forms.css">
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
            <form action="password-reset-code.php" method="POST">
                <h1>Write your Email Address</h1>
                <input type="email" name="Email" placeholder="Email">
                <button type="submit" name="PasswordResetLink">Submit</button>
            </form>
            <a href="./signForms.php">back</a>
        </div>
    </div>
  
    <script type="module" src="./js/forms.js"></script>
    <script src="./js/style.js"></script>
</body>
</html>

