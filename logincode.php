<?php
include "./connect.php";

if(isset($_POST["login-btn"]))
{
    if(!empty(trim($_POST['Email'])) && !empty(trim($_POST['Password'])))
    {
        $email =mysqli_real_escape_string($connect,$_POST['Email']);
        $password = mysqli_real_escape_string($connect,$_POST['Password']);

        $login_query = "SELECT 
            users_accounts.*, 
            user.ID,
            user.Fname, 
            user.Address, 
            user.Phone 
        FROM 
            users_accounts 
        JOIN 
            user 
        ON 
            users_accounts.Email = user.Email 
        WHERE 
            users_accounts.Email = '$email' 
            AND users_accounts.Password = '$password' 
        LIMIT 1";
        $login_query_run = mysqli_query($connect,$login_query);



        if(mysqli_num_rows($login_query_run) > 0)
        {
            $row = mysqli_fetch_array($login_query_run);

            if($row['verify_status'] == "1")
            {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    "User_ID" => $row['ID'],
                    "Email" => $row['Email'],
                    "Fname" => $row['Fname'],
                    "Address" => $row['Address'],
                    "Phone" => $row['Phone'],
                ];


                header("Location: Profile.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Please verify your email address to login";
                header("Location: signForms.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Invalid email or password";
            header("Location: signForms.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "All fields are Mendatory";
        header("Location: signForms.php");
        exit(0);
    }

}
?>