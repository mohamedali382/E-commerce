<?php
include "./connect.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendemail_verfiy($name,$Email, $verify_token)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP(); 
    $mail->SMTPAuth   = true;  
    $mail->Host       = 'smtp.gmail.com';
    $mail->Username   = 'mo392213@gmail.com';  
    $mail->Password   = 'lmsziiazdgurcpxn'; 
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mo392213@gmail.com',$name);
    $mail->addAddress($Email);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email varification from Osman Web store';

    $Email_template = "
    <h2>you have registered with osman web store</h2>
    <h5>Verify our email address to login with the below given link</h5>
    <br/><br/>
    <a href='http://localhost/Osman_brand/verify-email.php?token=<?php echo $verify_token; ?>'> Click here </a>
    ";
    $mail->Body = $Email_template;

    $mail->send();
    // echo 'Message has been sent';
}

if(isset($_POST['resend']))
{
    if(!empty(trim($_POST['Email'])))
    {
    
        $Email = mysqli_real_escape_string($connect, $_POST['Email']);

        $check_email_query = "SELECT * from users_accounts WHERE Email = '$Email' LIMIT 1";
        $check_email_query_run = mysqli_query($connect,$check_email_query);


        if(mysqli_num_rows($check_email_query_run) > 0)
        {
            $row = mysqli_fetch_array($check_email_query_run);
            if($row['verify_status'] == "0")
            {
                $name = "osman";
                $Email = $row['Email'];
                $verify_token = $row['Verify_token'];

                sendemail_verfiy($name,$Email, $verify_token);

                $_SESSION['status'] = "verification Email link has been sent to your email address";
                header("Location: resend.php");
                exit(0);
            }
            else
            {
                echo $row['verify_status'];
                $_SESSION['status'] = "Email already verified. please Login";
                header("Location: resend.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email is not Registered. Please Register";
            header("Location: resend.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "Please enter your email field";
        header("Location: resend.php");
        exit(0);
    }

}

?>