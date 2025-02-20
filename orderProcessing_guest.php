<?php
include './connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

header('Content-Type: application/json');

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['paymentId'], $data['email'], $data['name'], $data['address'], $data['phone'])) {
    $Email = $data['email'];
    $Fname = $data['name'];
    $Address = $data['address'];
    $Phone = $data['phone'];
    $amount = $_SESSION['total'] ?? 0;

    $User_ID = "";
    $check = 0;

    // Check if user exists
    $stmt = $connect->prepare("SELECT * FROM user WHERE Email = ?");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $User_data = $result->fetch_assoc();
        $User_ID = $User_data['ID'];
        $check = 1;
    } else {
        // Insert new user
        $stmt = $connect->prepare("INSERT INTO user (Fname, Email, Phone, Address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Fname, $Email, $Phone, $Address);
        $query_user_run = $stmt->execute();
    }

    if ($check == 1 || (isset($query_user_run) && $query_user_run)) {
        if ($check != 1) {
            $User_ID = $connect->insert_id;
        }

        // Insert order
        $formattedDate = (new DateTime())->format('Y-m-d H:i:s');
        $stmt = $connect->prepare("INSERT INTO orders (USER_ID, Total_Price, Time) VALUES (?, ?, ?)");
        $stmt->bind_param("ids", $User_ID, $amount, $formattedDate);
        $query_run = $stmt->execute();

        if ($query_run) {
            $orderID = $connect->insert_id;

            // Insert order items
            foreach ($_SESSION['orderItems'] as $item) {
                $Id = $item['Id'];
                $Price_ID = $item['price_Id'];
                $count = $item['Count'];

                $stmt = $connect->prepare("INSERT INTO order_items (Ord_ID, product_id, price_Id, count) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("iiii", $orderID, $Id, $Price_ID, $count);
                $stmt->execute();
            }

            echo json_encode(["success" => true, "message" => "Order processed successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to create order."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Failed to create user."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid input data."]);
}



// function orderCheckOut($Email)
// {
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = 'mo392213@gmail.com';
    $mail->Password   = 'ciostzbskeptgxrj'; // get email password from video

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mo392213@gmail.com', "Brud");
    $mail->addAddress($Email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Order completed sucessful';

    $Email_template = '
    <html>
      <head>
        <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
          }
          .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          }
          h1 {
            color: #5f799e;
            text-align: center;
          }
          .order-info {
            margin-bottom: 20px;
          }
          .order-info p {
            font-size: 16px;
            color: #333;
          }
          table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
          }
          table, th, td {
            border: 1px solid #ddd;
          }
          th {
            background-color: #f6f0e5;
            padding: 8px;
            text-align: left;
            color: #342822;
          }
          td {
            padding: 8px;
            text-align: left;
          }
          .footer {
            font-size: 14px;
            color: #333;
            text-align: center;
            margin-top: 20px;
          }
        </style>
      </head>
      <body>
        <div class="container">
          <h1>Order Confirmation</h1>
          <div class="order-info">
            <h2><strong>Order ID:</strong> ' . $_SESSION['orderItems'][0]['Id'] . '</h2>
            <p><strong>Order Date:</strong> ' . $formattedDate . '</p>
            <p><strong>Total Price:</strong> $' . number_format($amount, 2) . '</p>
          </div>
          <h3>Order Details:</h3>
          <table>
            <tr>
              <th>Product</th>
              <th>Size</th>
              <th>Price</th>
              <th>Quantity</th>
            </tr>';
    
            // Initialize $orderHTML before the loop
            $orderHTML = '';
    
            // Loop through the order items and add them to the table
            foreach ($_SESSION['orderItems'] as $item) {
              $orderHTML .= '
              <tr>
                <td>' . htmlspecialchars($item['Name']) . '</td>
                <td>' . htmlspecialchars($item['Size']) . '</td>
                <td>$' . number_format($item['Price'], 2) . '</td>
                <td>' . htmlspecialchars($item['Count']) . '</td>
              </tr>';
            }
    
            $Email_template .= $orderHTML . '
          </table>
          <div class="footer">
            <p>Thank you for your purchase! Your order is being processed, and we will notify you once it\'s shipped.</p>
            <p>If you have any questions, feel free to contact us.</p>
          </div>
        </div>
      </body>
    </html>
    ';
    
    
    $mail->Body = $Email_template;

    $mail->send();
// }
?>

