<?php
include "./connect.php";

if(isset($_POST["click"]))
{
$FirstName = $_POST['FirstName'];
$LastName = $_POST['LastName'];
$Number = $_POST['Number'];
$Email = $_POST['Email'];
$message = $_POST['message'];

if($FirstName == NULL || $LastName == NULL || $Number == NULL || $Email == NULL || $message == NULL)
{
    $_SESSION['Mess'] = "All information are required";
    header("Location: ContactUs.php");
}
else{
    $query = "INSERT INTO messages(FirstName, LastName, Number, Email, message) VALUES('$FirstName','$LastName', '$Number', '$Email','$message')";
    $query_run = mysqli_query($connect,$query);
    if($query_run)
    {
        $_SESSION['Mess'] = "your Message was sent successful!";
        header("Location: ContactUs.php");
    }
    else{
        {
            $_SESSION['Mess'] = "There was error, Please tyr again";
            header("Location: ContactUs.php");
        }
    }
}
}
?>