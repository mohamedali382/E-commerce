<?php
include "./connect.php";

if (!isset($_SESSION['authenticated']))
{
    $_SESSION['status'] = "Please Login to Access user dashboard";
    header('Location: signForms.php');
    exit(0);
}

?>