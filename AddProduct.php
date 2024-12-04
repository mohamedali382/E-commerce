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
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./style/fixed.css">
    <link rel="stylesheet" href="./style/dash.css">
    <title>Document</title>
</head>
<body>
    <header class="NAV">
        <div class="nav-items" style="height: 10vh;">

            <div class="items">
                <a href="./Home.html"><h1>Osman</h1></a>
                
            </div>
            <div class="items">
                <i class="fa-solid fa-magnifying-glass"></i>
                <a href="./signForms.html"><i class="fa-solid fa-user"></i></a>
                <i class="fa-solid fa-list" onclick="toggleMenu()"></i>
            </div>
        </div>

        <nav>
            <ul>
                <li><a href="./Home.html">Home</a></li>
                <li><a href="./Products.html">our store</a></li>
                <li><a href="./aboutUs.html">Blog</a></li>
                <li><a href="./ContactUs.html">Contact Us</a></li>
                <li id="buttons">
                    <a href="./signForms.html"><button>join-us</button></a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
    <div class="alert">
            <?php
            if(isset($_SESSION['status']))
            {
                echo"<h4>".$_SESSION['status']."</h1>";
                unset($_SESSION['status']);
            }
            ?>
        </div>
            <form action="addCode.php" method="POST" enctype="multipart/form-data" id="form">
        <div class="headerFont">
            <h1>Add product</h1>
        </div>
        <div class="inputs">
            <label for="new" id="uploadImage">
                <input type="file" name="pro_image" accept="image/*" id="new" hidden>
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <h2>Upload product photo</h2>
                <p>png - jpg - pdf</p>
            </label>
            <div class="fonts">
                <div class="productName">
                    <label>Product name *</label>
                    <input type="text" name="Pro_name" required>
                </div>
                <div class="prices">
                    <div class="price">
                        <label>Max Price</label>
                        <input type="number" name="max-price" required>
                    </div>
                    <div class="price">
                        <label>Min Price</label>
                        <input type="number" name="min-price" required>
                    </div>
                </div>
                <div class="Description">
                    <label>Description*</label>
                    <input type="text" name="Description" required>
                </div>
            </div>
        </div>
        <div class="multiinputs">
            <div class="sizes">
                <div class="size">
                    <label>Size</label>
                    <input type="text" name="size[]" required>
                </div>
                <div class="size">
                    <label>Price</label>
                    <input type="number" name="price[]" required>
                </div>
            </div>
        </div>

        <div id="controls-container">
        <div class="add">
            <i class="fa-solid fa-plus" id="addition"></i>
            <h3>Add Size</h3>
        </div>
        <button type="submit" name="add">Submit</button>
    </div>
    </form>
    </main>

    <footer>
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
    <script src="./js/style.js"></script>
    <script src="./js/modify.js"></script>
</body>
</html>