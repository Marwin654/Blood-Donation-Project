<?php
session_start();
include "config.php";

$email = mysqli_real_escape_string($conn, $_POST['log-email']);
$password = mysqli_real_escape_string($conn, $_POST['log-password']);
$encrypt_pass = md5($password);

if (!empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $check_user = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}' AND password='{$encrypt_pass}'");

        if (mysqli_num_rows($check_user) > 0) {
            $row = mysqli_fetch_assoc($check_user);
            
            // ✅ Store user data in session
            $_SESSION['user_id'] = $row['id'];  // Store user ID
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];

            // ✅ Show alert and redirect to home.php
            echo "<script>
                    alert('Login successful!');
                    window.location.href = '../home.php';
                  </script>";
            exit();
        } else {
            echo "<script>alert('Email or password incorrect'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Enter a valid email address!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('All input fields are required!'); window.history.back();</script>";
}
?>
