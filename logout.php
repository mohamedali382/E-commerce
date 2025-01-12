<?php
include "./connect.php";
$_SESSION['nav'] = '<a href="./signForms.php">Sign in</a>';
unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "You Logged out successfully";
header("Location: signForms.php");
?>