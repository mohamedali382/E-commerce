<?php
include './connect.php';
$sql = "SELECT Total_Price, Date FROM orders";
$result = $connect->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "Total_Price" => $row['Total_Price'],
            "Date" => $row['Date']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($data);

?>