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
<header class="NAV">
        <div class="nav-items" style="height: 10vh;">

            <div class="items">
                <a href="./Home.php"><h1>Osman</h1></a>
                
            </div>
            <div class="items">
                <i class="fa-solid fa-magnifying-glass"></i>
                <a href="./signForms.php"><i class="fa-solid fa-user"></i></a>
                <i class="fa-solid fa-list" onclick="toggleMenu()"></i>
            </div>
        </div>

        <nav>
            <ul>
                <li><a href="./Home.php">Home</a></li>
                <li><a href="./Dashboard.php">Dashborad</a></li>
                <li><a href="./Products.php?cat=ALL">our store</a></li>
                <li><a href="./Products.php?cat=boys">Boys</a></li>
                <li><a href="./Products.php?cat=girls">Girls</a></li>
                <li><a href="./aboutUs.php">Blog</a></li>
                <li><a href="./ContactUs.php">Contact Us</a></li>
                <li id="buttons">
                    <a href="./signForms.php"><button>join-us</button></a>
                </li>
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
            <form action="password-reset-code.php" method="POST">
                <h1>Change your password</h1>
                <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
                <input type="email" name="Email" value="<?php if(isset($_GET['Email'])) {echo $_GET['Email'];}?>" placeholder="Email">
                <input type="password" name="new_Password" placeholder="New Password">
                <input type="password" name="Confirm-Password" placeholder="Confirm Password">
                <button type="submit" name="Password-update">Submit</button>
            </form>
        </div>
    </div> <footer>

        <div class="social-media">
            <h3>Our social media</h3>
            <div class="icons">
                <i class="fa-brands fa-linkedin-in"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-facebook-f"></i>
                <i class="fa-brands fa-x-twitter"></i>
                <i class="fa-brands fa-tiktok"></i>
            </div>
        </div>
        <div class="footer-items">
            <div class="footer-font">
                <h3>help</h3>
                <p>sdss</p>
                <p>sdss</p>
                <p>sdss</p>
                <p>sdss</p>
            </div>
            <div class="footer-font">
                <h3>help</h3>
                <p>sdss</p>
                <p>sdss</p>
                <p>sdss</p>
                <p>sdss</p>
            </div>
            <div class="footer-font">
                <h3>help</h3>
                <p>sdss</p>
                <p>sdss</p>
                <p>sdss</p>
                <p>sdss</p>
            </div>
            <div class="footer-font">
                <h3>help</h3>
                <p>sdss</p>
                <p>sdss</p>
                <p>sdss</p>
                <p>sdss</p>
            </div>
        </div>
        <div class="footer-head">
            <h2>Osman</h2>
        </div>
    </footer>
    <script type="module" src="./js/forms.js"></script>
    <script src="./js/style.js"></script>
</body>
</html>