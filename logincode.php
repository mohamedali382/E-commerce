<?php
include "./connect.php";

if(isset($_POST["login-btn"]))
{
    if(!empty(trim($_POST['Email'])) && !empty(trim($_POST['Password'])))
    {
        $email =mysqli_real_escape_string($connect,$_POST['Email']);
        $password = mysqli_real_escape_string($connect,$_POST['Password']);

        $login_query = "SELECT * FROM users_accounts WHERE Email = '$email' AND Password = '$password' LIMIT 1";
        $login_query_run = mysqli_query($connect,$login_query);

        if(mysqli_num_rows($login_query_run) > 0)
        {
            $row = mysqli_fetch_array($login_query_run);
            // echo $row['verify_status'];
            if($row['verify_status'] == "1")
            {
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user'] = [
                    "Email" => $row['Email'],
                ];
                $sql = "SELECT * FROM orders WHERE USER_ID = ' " . $row["user_id"] . "'";
                $result = $connect->query($sql);

                $orders = array();
                
                if($result->num_rows > 0)
                {
                  while($row = $result->fetch_assoc())
                  {
                    $orders[] = $row;
                  }
                }
                else{
                    echo "result equal zero";
                }
                $converting = json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                file_put_contents('orders.json',$converting);

                foreach ($orders as $order) {
                    $sql2 = "SELECT * FROM order_items WHERE Ord_ID = '" . $order["Order_ID"] . "'";
                    $result2 = $connect->query($sql2);
                
                    if ($result2->num_rows > 0) {
                        while ($order_item = $result2->fetch_assoc()) {
                            $order_items[] = $order_item;
                        }
                    }
                }
                $converting_ietms = json_encode($order_items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                file_put_contents('orderItems.json',$converting_ietms);

                $_SESSION['status'] = "You are Logged In Successfully !";
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