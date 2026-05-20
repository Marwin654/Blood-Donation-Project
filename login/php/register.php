<?php
include "config.php";

// Sanitize input
$name = mysqli_real_escape_string($conn, $_POST['reg-name']);
$email = mysqli_real_escape_string($conn, $_POST['reg-email']);
$password = mysqli_real_escape_string($conn, $_POST['reg-password']);
$encrypt_pass = md5($password);

// Ensure all fields are filled
if (!empty($name) && !empty($email) && !empty($password)) {
    
    // Check if email is a valid Gmail address
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) {

        // Check if email already exists
        $verify_email = mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'");
        
        if (mysqli_num_rows($verify_email) > 0) {
            echo "<script>alert('Email already exists'); window.history.back();</script>";
        } else {
            // Insert new user
            $insert = mysqli_query($conn, "INSERT INTO users (name, email, password) VALUES ('{$name}', '{$email}', '{$encrypt_pass}')");
            
            if ($insert) {
                echo "<script>
                    alert('Registered successfully!');
                    window.location.href = '../index.php';
                </script>";
            } else {
                echo "<script>alert('Cannot register'); window.history.back();</script>";
            }
        }
        
    } else {
        echo "<script>alert('Only Gmail addresses are allowed.'); window.history.back();</script>";
    }

} else {
    echo "<script>alert('All fields are required'); window.history.back();</script>";
}
?>
