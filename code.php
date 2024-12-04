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
    $mail->Password   = 'lmsziiazdgurcpxn'; // get email password from video

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mo392213@gmail.com', $name);
    $mail->addAddress($Email);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email varification from Osman Web store';

    $Email_template = "
    <h2>you have registered with osman web store</h2>
    <h5>Verify our email address to login with the below given link</h5>
    <br/><br/>
    <a href='http://localhost/Osman_brand/verify-email.php?token=$verify_token'> Click here </a>
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
    } else {
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
