<?php
$localhost="localhost";
$username="root";
$password="";
$database="osman";

$connect=mysqli_connect($localhost,$username,$password,$database);
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Start the session only if it's not started yet
}

?>