<?php
include "./connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="./style/forms.css">
    <link rel="stylesheet" href="./style/fixed.css">
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
            <form action="./backend/password-reset-code.php" method="POST">
                <h1>Change your password</h1>
                <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
                <input type="email" name="Email" value="<?php if(isset($_GET['Email'])) {echo $_GET['Email'];}?>" placeholder="Email">
                <input type="password" name="new_Password" placeholder="New Password">
                <input type="password" name="Confirm-Password" placeholder="Confirm Password">
                <button type="submit" name="Password-update">Submit</button>
            </form>
        </div>
    </div>    <script type="module" src="./js/forms.js"></script>
    <script src="./js/style.js"></script>
</body>
</html>