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
    $mail->Password   = 'lmsziiazdgurcpxn'; // get email password from video
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('mo392213@gmail.com', $get_name);
    $mail->addAddress($get_email);

    $mail->isHTML(true);
    $mail->Subject = 'Password Reset Request';

    $Email_template = "
    <h2>Password Reset</h2>
    <h5>Click on this link to reset your password</h5>
    <br/><br/>
    <a href='http://localhost/Osman_brand/passwordChange.php?token=$update_token&Email=$get_email'> Click here </a>
    ";
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