<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Login & Register </title>
</head>
<?php
if (isset($_GET['message']) && $_GET['message'] === "loggedout") {
    echo "<script>alert('You have been logged out successfully.');</script>";
}
?>


<body>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
<header>
<h1 align="left">BloodLine🩸</h1>
</header>
    <div class="wrapper">
        <div class="form-header">
            <div class="titles">
                <div class="title-login">Login</div>
                <div class="title-register">Register</div>
            </div>
        </div>
        <!-- Error container -->
         <div class="error-message">


         </div>
        <!-- LOGIN FORM -->
        <form  class="login-form" method="POST" autocomplete="off" action="php/login.php">
            <div class="input-box">
                <input type="text" name="log-email" class="input-field" id="log-email" autocomplete="off" required>
                <label for="log-email" class="label">Email</label>
                <i class='bx bx-envelope icon'></i>
            </div>
            <div class="input-box">
                <input type="password" name="log-password" class="input-field" id="log-password" autocomplete="off" required>
                <label for="log-password" class="label">Password</label>
                <i class='bx bx-lock-alt icon' ></i>
            </div>
            <div class="input-box">
                <button class="btn-submit" name="login" id="SignInBtn">Sign In <i class='bx bx-log-in' ></i></button>
            </div>
            <div class="switch-form">
                <span>Don't have an account? <a href="#" onclick="registerFunction()">Register</a></span>
            </div>
        </form>

        <!-- REGISTER FORM -->
        <form  method="POST" class="register-form" autocomplete="off" action="php/register.php">
            <div class="input-box">
                <input type="text" name="reg-name" class="input-field" id="reg-name" autocomplete="off" pattern="[A-Za-z]+" title="Only letters are allowed" required>
                <label for="reg-name" class="label">Username</label>
                <i class='bx bx-user icon' ></i>
            </div>
            <div class="input-box">
                <input type="text" name="reg-email" class="input-field" id="reg-email" pattern="[a-zA-Z0-9._%+-]+@gmail\.com$" title="Only Gmail addresses are allowed" autocomplete="off"  required>
                <label for="reg-email" class="label">Email</label>
                <i class='bx bx-envelope icon'></i>
            </div>
            <div class="input-box">
                <input type="password" name="reg-password" class="input-field" id="reg-pass" autocomplete="off" required minlength="8" title="password must be atleast 8 characters long"> 
                <label for="reg-pass" class="label">Password</label>
                <i class='bx bx-lock-alt icon' ></i>
            </div>
            <div class="input-box">
                <button class="btn-submit" name="register"  id="SignUpBtn">Sign Up <i class='bx bx-user-plus' ></i></button>
            </div>
            <div class="switch-form">
                <span>Already have an account? <a href="#" onclick="loginFunction()">Login</a></span>
            </div>
        </form>
    </div>

    <script src="js/script.js"></script>
    
</body>
</html>