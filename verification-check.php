<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/verify.css">
    <title>Document</title>
</head>
<body>
    <main>
        <div class="check_message">
        <?php
            if(isset($_SESSION['status']))
            {
                echo"<h4>".$_SESSION['status']."</h1>";
                unset($_SESSION['status']);
            }
            ?>
            <a href="./signForms.php"><button type="submit">Back</button></a>
        </div>
    </main>
</body>
</html>