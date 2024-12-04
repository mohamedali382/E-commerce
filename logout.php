<?php
include "./connect.php";

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "You Logged out successfully";
header("Location: signForms.php");
?>