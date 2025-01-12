<?php
include "./connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email, $update_token)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = 'mo392213@gmail.com';
    $mail->Password   = 'ciostzbskeptgxrj'; // get email password from video
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('mo392213@gmail.com', $get_name);
    $mail->addAddress($get_email);

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';

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
                <h5>We're excited to have you on board. To complete your request to check your password by clicking the link below:</h5>
                <a href='http://localhost/Osman_brand/passwordChange.php?token=$update_token&Email=$get_email' class='verify-btn'>Reset your Password</a>
                <p>If the button doesn't work, you can copy and paste the following link into your browser:</p>
            </div>
    
            <!-- Footer -->
            <div class='email-footer'>
                <p>Need help? <a href='http://localhost/Osman_brand/contact-us'>Contact Support</a></p>
                <p>Brud Store &copy; 2025</p>
            </div>
        </div>
    </body>
    </html>";




    $mail->Body = $Email_template;

    $mail->send();
}

if (isset($_POST['PasswordResetLink'])) {
    $Email = mysqli_real_escape_string($connect, $_POST['Email']);
    $token = md5(rand());

    $check_email = "SELECT Email FROM users_accounts WHERE Email = '$Email' LIMIT 1";
    $check_email_run = mysqli_query($connect, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = "Osman";
        $get_email = $row['Email'];

        // Using prepared statement
        $update_token_stmt = $connect->prepare("UPDATE users_accounts SET verify_token=? WHERE Email=? LIMIT 1");
        $update_token_stmt->bind_param("ss", $token, $get_email);
        $update_token_run = $update_token_stmt->execute();

        if ($update_token_run) {
            send_password_reset($get_name, $get_email, $token); // Note the change to use $token
            $_SESSION['status'] = "We e-mailed you a password reset link";
            header("Location: Password-reset.php");
            exit(0);
        } else {
            $_SESSION['status'] = "Something went wrong: " . $update_token_stmt->error;
            header("Location: Password-reset.php");
            exit(0);
        }

        $update_token_stmt->close();
    } else {
        $_SESSION['status'] = "No Email Found";
        header("Location: Password-reset.php");
        exit(0);
    }
}

if (isset($_POST['Password-update'])) {
    $Email = mysqli_real_escape_string($connect, $_POST['Email']);
    $new_password = mysqli_real_escape_string($connect, $_POST['new_Password']);
    $confirm_password = mysqli_real_escape_string($connect, $_POST['Confirm-Password']);
    $token = mysqli_real_escape_string($connect, $_POST['password_token']);

    if (!empty($token)) {
        if (!empty($Email) && !empty($new_password) && !empty($confirm_password)) {
            $check_token = "SELECT verify_token FROM users_accounts WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($connect, $check_token);

            if (mysqli_num_rows($check_token_run) > 0) {
                if ($new_password == $confirm_password) {
                    // Using prepared statement
                    $update_password_stmt = $connect->prepare("UPDATE user_accounts SET Password=? WHERE verify_token=? LIMIT 1");
                    $update_password_stmt->bind_param("ss", $new_password, $token);
                    $update_password_run = $update_password_stmt->execute();

                    if ($update_password_run) {
                        $_SESSION['status'] = "New Password updated successfully!";
                        header("Location: signForms.php");
                        exit(0);
                    } else {
                        $_SESSION['status'] = "Something went wrong: " . $update_password_stmt->error;
                        header("Location: Password-reset.php?token=$token&Email=$Email");
                        exit(0);
                    }

                    $update_password_stmt->close();
                } else {
                    $_SESSION['status'] = "Password and confirm password not matched";
                    header("Location: Password-reset.php?token=$token&Email=$Email");
                    exit(0);
                }
            } else {
                $_SESSION['status'] = "Invalid token";
                header("Location: Password-reset.php?token=$token&Email=$Email");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "All fields are mandatory";
            header("Location: passwordChange.php?token=$token&Email=$Email");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No Token available";
        header("Location: Password-reset.php");
        exit(0);
    }
}

?>