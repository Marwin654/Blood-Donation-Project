<?php
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $log_email=$_POST["log-email"];
    $log_pass=$_POST["log-password"];
    if(isset($users[$log_email])&&$users([$log_pass]===$log_pass))
    {
        $_SESSION["log-email"]=$log_email;
        header("Location:home.php");
        exit();
    }
    else{
        echo "Invalid username or password";
    }
}
?>