<?php
if (isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "you are already logged in";
    header('Location: Dashboard.php');
    exit(0);
}
include './nav.php';
include './connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/form.css">
    <title>join-us</title>
</head>
<body>
    <div class="container">
    <div class="alert">
        <?php
        if (isset($_SESSION['status'])) {
            echo "<h4>" . $_SESSION['status'] . "</h4>";
            unset($_SESSION['status']);
        }
        ?>
    </div>
    <div class="forms" id="forms">
        <form action="code.php" method="POST" id="form1">
            <h1>Sign-Up</h1>
            <input type="text" name="Fname" placeholder="Full name" required>
            <input type="email" name="Email" placeholder="Email" required>
            <input type="number" name="Phone" placeholder="Phone Number" required>
            <input type="text" name="Address" placeholder="Your Address" required>
            <input type="password" name="Password" placeholder="Create Your Password" required>
            <button type="submit" name="register">Submit</button>
        </form>

        <form action="./logincode.php" method="POST" id="form2" style="display: none;">
            <h1>Sign-In</h1>
            <input type="email" name="Email" placeholder="Email" required>
            <input type="password" name="Password" placeholder="Password" required>
            <a href="./password-reset.php">Forget Password?</a>
            <a href="./resend.php">Resend Verification Code?</a>
            <button type="submit" name="login-btn">Submit</button>
        </form>

        <div class="welcome-message" id="welcomeMessage" style="display: none;">
            <h1>Welcome Back!</h1>
            <p>We're glad to see you again. Please sign in to continue.</p>
            <button id="backToSignUp">Sign Up</button>
        </div>

        <div class="image" id="image">
            <div class="image-blur">
                <div class="image-content">
                    <h1><span>Create Account</span></h1>
                    <p><span>Enter your personal details and<br>start your journey with us</span></p>
                    <button id="varButton">Sign In</button>
                </div>
            </div>
        </div>
    </div>
</div>

  <?php 
  include './footer.php';
  ?>
    <script src="./js/form.js"></script>
</body>
</html>