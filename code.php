<?php
include './connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function sendemail_verfiy($name, $Email, $verify_token)
{
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
    $mail->setFrom('mo392213@gmail.com', $name);
    $mail->addAddress($Email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email varification from Osman Web store';

    $Email_template = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Email Verification</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f7f0eb;
                color: #342923;
                line-height: 1.6;
            }
            .email-container {
                max-width: 600px;
                margin: 30px auto;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }
            .email-header {
                background-color: #687ca0;
                color: #ffffff;
                padding: 20px;
                text-align: center;
            }
            .email-header h1 {
                margin: 0;
                font-size: 24px;
            }
            .email-body {
                padding: 20px;
            }
            .email-body h2 {
                font-size: 20px;
                color: #342923;
            }
            .email-body h5 {
                font-size: 16px;
                margin-bottom: 20px;
            }
            .verify-btn {
                display: inline-block;
                background-color: #ffa063;
                color: #ffffff;
                text-decoration: none;
                padding: 12px 20px;
                border-radius: 5px;
                font-size: 16px;
                font-weight: bold;
                text-align: center;
            }
            .verify-btn:hover {
                background-color: #e58b53;
            }
            .email-footer {
                background-color: #f3e0d0;
                text-align: center;
                padding: 15px;
                font-size: 14px;
                color: #555;
            }
            .email-footer a {
                color: #687ca0;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class='email-container'>
            <!-- Header -->
            <div class='email-header'>
                <h1>Brud Store</h1>
            </div>
    
            <!-- Body -->
            <div class='email-body'>
                <h2>Welcome to Brud Store!</h2>
                <h5>We're excited to have you on board. To complete your registration, please verify your email address by clicking the link below:</h5>
                <a href='http://localhost/Osman_brand/verify-email.php?token=$verify_token' class='verify-btn'>Verify Your Email</a>
                <p>If the button doesn't work, you can copy and paste the following link into your browser:</p>
                <p style='word-wrap: break-word; color: #687ca0;'>http://localhost/Osman_brand/verify-email.php?token=$verify_token</p>
            </div>
    
            <!-- Footer -->
            <div class='email-footer'>
                <p>Need help? <a href='http://localhost/Osman_brand/contact-us'>Contact Support</a></p>
                <p>Brud Store &copy; 2025</p>
            </div>
        </div>
    </body>
    </html>
    ";
    
    $mail->Body = $Email_template;

    $mail->send();
    // echo 'Message has been sent';
}

if (isset($_POST['register'])) {
    $Fname = $_POST['Fname'];
    $Email = $_POST['Email'];
    $Phone = $_POST['Phone'];
    $Address = $_POST['Address'];
    $Password = $_POST['Password'];
    $verify_token = md5(rand());
    $name = "Osman";

    $check_email_query = "SELECT Email from users_accounts WHERE Email = '$Email' LIMIT 1";
    $check_email_query_run = mysqli_query($connect, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email already exists";
        header("Location: signForms.php");
    }
    else if($Fname == NULL || $Email == NULL || $Phone == NULL || $Address == NULL || $Password == NULL)
    {
        $_SESSION['status'] = "All information are required";
        header("Location: signForms.php");
    }
    else {
        // insert user
        $query = "INSERT INTO user (Fname,Email, Phone, Address) VALUES ('$Fname','$Email', '$Phone', '$Address')";
        $query_run = mysqli_query($connect, $query);

        if ($query_run) {
            $last_id = mysqli_insert_id($connect);

            $query2 = "INSERT INTO users_accounts (user_id, Email, Password, verify_token) VALUES ('$last_id', '$Email', '$Password', '$verify_token')";
            $query_run2 = mysqli_query($connect, $query2);

            if ($query_run2) {
                $_SESSION['status'] = "Register Successful.! Please verify your email address";
                header("Location: signForms.php");
                sendemail_verfiy($name, $Email, $verify_token);
            } else {
                $_SESSION['status'] = "Registration failed. Please try again.";
                header("Location: signForms.php");
            }
        } else {
            $_SESSION['status'] = "Registration failed. Please try again.";
            header("Location: signForms.php");
        }
    }
}
?>
