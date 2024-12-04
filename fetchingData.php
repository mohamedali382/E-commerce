<?php
include './connect.php';

$sql = "SELECT * FROM product";

$result = $connect->query($sql);

$products = array();


if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        if (isset($row['pro_image'])) {
            // Convert BLOB data to Base64
            $row['pro_image'] = base64_encode($row['pro_image']);
            // Prepend with the correct MIME type for the image (e.g., 'data:image/jpeg;base64,')
            $row['pro_image'] = 'data:image/jpeg;base64,' . $row['pro_image']; // Update MIME type if needed
        }
        $products[] = $row;
    }
} else {
    echo "0 results";
}
$encoded = json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('products.json',$encoded);


$sql2 = "SELECT * FROM products_sizes";

$result2 = $connect->query($sql2);

$sizes = array();


if ($result2->num_rows > 0) {
    // Output data of each row
    while($row = $result2->fetch_assoc()) {
        $sizes[] = $row;
    }
} else {
    echo "0 results";
}
$encoded2 = json_encode($sizes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
file_put_contents('products_sizes.json',$encoded2);
?>