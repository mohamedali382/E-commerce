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
    <link rel="stylesheet" href="./style/Admin_add.css">
    <title>Document</title>
</head>
<body>
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
            <form action="./addCode.php" method="POST" enctype="multipart/form-data" id="form">
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
        <div class="multiinputs" id="multiinput">
            <div class="sizes" id="size">
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
    </div>
    <input type="submit" name="add">
    </form>
    <div class="dashboard-button-container">
            <a href="dashboard.php" class="dashboard-button">Return to Dashboard</a>
        </div>
    </main>

    <script src="./js/addProduct.js"></script>
</body>
</html>