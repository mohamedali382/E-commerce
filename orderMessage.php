<?php
include './authentication.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;
// require 'vendor/autoload.php';

// $Email = $_SESSION['auth_user']['Email'];
// $User_ID = $_SESSION['auth_user']['User_ID'];
// $amount = $_SESSION['total'];
// $dateTime = new DateTime();
// $formattedDate = $dateTime->format('Y-m-d H:i:s');

// $query = "INSERT INTO orders (Order_ID,USER_ID, Total_Price, Time) VALUES (NULL,'$User_ID', '$amount', '$formattedDate')";
// $query_run = mysqli_query($connect, $query);
// if ($query_run) {
//     $orderID = $connect->insert_id;
//     foreach ($_SESSION['orderItems'] as $item) {
//         $Id = $item['Id'];
//         $Price_ID = $item['price_Id'];
//         $count = $item['Count'];
//         $query2 = "INSERT INTO order_items (Ord_ID, product_id, price_Id, count) VALUES ('$orderID', '$Id', '$Price_ID','$count')";
//         $query_run2 = mysqli_query($connect, $query2);
//     }
// }


// // function orderCheckOut($Email)
// // {
//     $mail = new PHPMailer(true);
//     $mail->SMTPDebug = 0;
//     $mail->isSMTP();
//     $mail->SMTPAuth   = true;
//     $mail->Host       = 'smtp.gmail.com';
//     $mail->Username   = 'mo392213@gmail.com';
//     $mail->Password   = 'ciostzbskeptgxrj'; // get email password from video

//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom('mo392213@gmail.com', "Brud");
//     $mail->addAddress($Email);     //Add a recipient

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Order completed sucessful';

//     $Email_template = '
//     <html>
//       <head>
//         <style>
//           body {
//             font-family: Arial, sans-serif;
//             margin: 0;
//             padding: 0;
//             background-color: #f4f4f4;
//           }
//           .container {
//             width: 100%;
//             max-width: 600px;
//             margin: 20px auto;
//             background-color: #fff;
//             padding: 20px;
//             border-radius: 8px;
//             box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
//           }
//           h1 {
//             color: #5f799e;
//             text-align: center;
//           }
//           .order-info {
//             margin-bottom: 20px;
//           }
//           .order-info p {
//             font-size: 16px;
//             color: #333;
//           }
//           table {
//             width: 100%;
//             border-collapse: collapse;
//             margin-bottom: 20px;
//           }
//           table, th, td {
//             border: 1px solid #ddd;
//           }
//           th {
//             background-color: #f6f0e5;
//             padding: 8px;
//             text-align: left;
//             color: #342822;
//           }
//           td {
//             padding: 8px;
//             text-align: left;
//           }
//           .footer {
//             font-size: 14px;
//             color: #333;
//             text-align: center;
//             margin-top: 20px;
//           }
//         </style>
//       </head>
//       <body>
//         <div class="container">
//           <h1>Order Confirmation</h1>
//           <div class="order-info">
//             <p><strong>Order Date:</strong> ' . $formattedDate . '</p>
//             <p><strong>Total Price:</strong> $' . number_format($amount, 2) . '</p>
//           </div>
//           <h3>Order Details:</h3>
//           <table>
//             <tr>
//               <th>Product</th>
//               <th>Size</th>
//               <th>Price</th>
//               <th>Quantity</th>
//             </tr>';
    
//             // Initialize $orderHTML before the loop
//             $orderHTML = '';
    
//             // Loop through the order items and add them to the table
//             foreach ($_SESSION['orderItems'] as $item) {
//               $orderHTML .= '
//               <tr>
//                 <td>' . htmlspecialchars($item['Name']) . '</td>
//                 <td>' . htmlspecialchars($item['Size']) . '</td>
//                 <td>$' . number_format($item['Price'], 2) . '</td>
//                 <td>' . htmlspecialchars($item['Count']) . '</td>
//               </tr>';
//             }
    
//             $Email_template .= $orderHTML . '
//           </table>
//           <div class="footer">
//             <p>Thank you for your purchase! Your order is being processed, and we will notify you once it\'s shipped.</p>
//             <p>If you have any questions, feel free to contact us.</p>
//           </div>
//         </div>
//       </body>
//     </html>
//     ';
    
    
//     $mail->Body = $Email_template;

//     $mail->send();
//     // echo 'Message has been sent';


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Successful</title>
  <link rel="stylesheet" href="./style/message.css">
</head>
<body>
  <main class="order-success">
    <div class="success-message">
      <h1>🎉 Order Successful!</h1>
      <p>Thank you for your purchase! Your order is being processed and will be delivered within <strong>7-14 days</strong>.</p>
      <p>If you have any questions, feel free to contact our support team.</p>
      <div class="buttons">
      <a href="./Products.php" ><button class="btn">Continue Shopping</button></a>
      <a href="./ContactUs.php" ><button class="btn secondary">Contact Support</button></a>
      </div>
    </div>
  </main>
  <script type="module" src="./js/clearCard.js"></script>
</body>
</html>