<?php
// Get raw POST data
include './connect.php';
$jsonData = file_get_contents("php://input");

// Decode JSON data to PHP associative array
$data = json_decode($jsonData, true);

// Check if 'total' is set and print it inside <h1> tag
if (isset($data['total']) && isset($data['orderItems'])) {
    // Store the decoded data into session
    $_SESSION['orderItems'] = $data['orderItems'];
    $_SESSION['total'] = $data['total'];

} else {
    echo "<h1>No valid data received.</h1>";  // Output if no data was received
}
?>

