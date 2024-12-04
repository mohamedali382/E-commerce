<?php
include "./connect.php";
if (isset($_GET['token'])) 
{
    $token = $_GET['token'];
    $verify_query = "SELECT verify_token,verify_status FROM users_accounts WHERE verify_token = '$token' LIMIT 1";
    $verify_query_run = mysqli_query($connect, $verify_query);


    if (mysqli_num_rows($verify_query_run) > 0)
    {
        $row = mysqli_fetch_assoc($verify_query_run);
        // echo $row['verify_token'];

        if ($row['verify_status'] == "0")
        {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE users_accounts SET verify_status='1' WHERE verify_token='$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($connect, $update_query);
            
            if($update_query_run)
            {
                $_SESSION['status'] = "Account has been verfied successfully!";
                header("Location: signForms.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Verification field";
                header("Location: signForms.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email already verified. Please log in.";
            header("Location: signForms.php");
            exit(0);
        }
    }
    else 
    {
        $_SESSION['status'] = "This token does not exist";
        header("Location: signForms.php");
        exit(0);
    }
        // {
        //     
        //     
        //     

        //     if ($update_query_run) 
        //     {
        //         $_SESSION['status'] = "Your account has been verified successfully!";
        //         header("Location: signForms.php");
        //         exit(0);
        //     } 
        //     else 
        //     {
                // $_SESSION['status'] = "Verification failed!";
                // header("Location: verification-check.php");
                // exit(0);
        //     }
        // } 
        // else 
        // {

        // }
    //}

} 
else 
{
    $_SESSION['status'] = "Not allowed";
    header("Location: signForms.php");
    exit(0);
}
?>