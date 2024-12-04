<?php
include './connect.php';

if (isset($_POST['add'])) {


        $fileTmpPath = $_FILES['pro_image']['tmp_name'];
        $fileName = $_FILES['pro_image']['name'];
        $fileSize = $_FILES['pro_image']['size'];
        $fileType = $_FILES['pro_image']['type'];

        // Read the file as binary data
        $imageData = file_get_contents($fileTmpPath);

    $Pro_name = $_POST['Pro_name'];
    $max_price = $_POST['max-price'];
    $min_price = $_POST['min-price'];
    $Description = $_POST['Description'];

    $sizes = $_POST['size'];
    $prices = $_POST['price'];

    // Check if the product name already exists
    $check_name_query = "SELECT Pro_name FROM product WHERE Pro_name = ? LIMIT 1";
    $stmt = $connect->prepare($check_name_query);
    $stmt->bind_param("s", $Pro_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['status'] = "This product is already added";
        header("Location: AddProduct.php");
        exit();
    } else {
        if (isset($_FILES['pro_image']) && $_FILES['pro_image']['error'] === UPLOAD_ERR_OK) {
            // Insert into product table
            $query = "INSERT INTO product (Pro_name, Description, pro_image, `max-price`, `min-price`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $connect->prepare($query);
            $stmt->bind_param("sssdd", $Pro_name, $Description, $imageData, $max_price, $min_price);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                // Get the product ID
                $pro_id = $connect->insert_id;
                if (is_array($_POST['size']) && is_array($_POST['price']) && count($_POST['size']) == count($_POST['price'])) {
                    $query2 = "INSERT INTO products_sizes (pro_id, size, price) VALUES (?, ?, ?)";
                    $stmt2 = $connect->prepare($query2);
            
                    for ($i = 0; $i < count($_POST['size']); $i++) {
                        $size = $_POST['size'][$i];
                        $price = $_POST['price'][$i];
                        $stmt2->bind_param("isd", $pro_id, $size, $price);
                        $stmt2->execute();
                    }
            
                    $stmt2->close();
                } else {
                    // Handle error: sizes and prices arrays have different lengths
                    $_SESSION['status'] = "Error: Sizes and prices must have the same number of elements.";
                    header("Location: AddProduct.php");
                    exit();
                }
                $_SESSION['status'] = "Product added successfully!";
            } else {
                $_SESSION['status'] = "Process failed, please try again";
            }
            
            // Closing statements
            $stmt->close();
            header("Location: AddProduct.php");
        } else {
            $_SESSION['status'] = "Error uploading image";
            header("Location: AddProduct.php");
        }
    }
}
?>
