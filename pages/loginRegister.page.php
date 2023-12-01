<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../loginRegister.css">
    <title>Login | Register</title>
</head>
<body>
    
    <div class="container">
        <div class="sign-up-wrapper">
            <form action="../includes/signup.php" method="post" id="signup-form">
                <h2>Create Account</h2>
                <div class="social">
                    <div>
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                    <div>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                    <div>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="input-group">
                    <p class="username-error" id="signup-username-paragraph"></p>
                    <input type="text" placeholder="Name" name="signup-username" id="signup-username">
                    <p class="email-error" id="signup-email-paragraph"></p>
                    <input type="email" placeholder="Email" name="signup-email" id="signup-email">
                    <p class="password-error" id="signup-password-paragraph"></p>
                    <input type="password" placeholder="Password" name="signup-password" id="signup-password">
                    <p class="confirmpassword-error" id="signup-confirmpassword-paragraph"></p>
                    <input type="password" placeholder="Confirm password" name="signup-confirmpassword" id="signup-confirmpassword">
                    <button name="signup" id="register">Sign Up</button>
                </div>
            </form>
        </div>
        <div class="sign-in-wrapper">
            <form action ="../includes/login.php" method="post">
                <h2>Sign in</h2>
                <div class="social">
                    <div>
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                    <div>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                    <div>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="input-group">
                    <p class="username-error" id="login-username-paragraph"></p>
                    <input type="text" placeholder="Name" name="login-username" id="login-username">
                    <p class="password-error" id="login-password-paragraph"></p>
                    <input type="password" placeholder="Password" name="login-password" id="login-password">
                    <a href="#">Forgot you password ?</a>
                    <button id="login" name="signin">Sign In</button>
                </div>
            </form>
        </div>
        <div class="overlay">
            <div class="overlay-left">
                <h2>Welcome Back</h2>
                <p>To keep connected with us please login with your personal info</p>
                <button id="signin" class="overlay-btn">Sign in</button>
            </div>
            <div class="overlay-right">
                <h2>Hello, Friend</h2>
                <p>Enter your personal details and start your journey with us</p>
                <button id="signup" class="overlay-btn">Sign Up</button>
            </div>
        </div>
    </div>

    <script src="../main.js"></script>
    <script src="../ajax/signin.ajax.js"></script>
    <script src="../ajax/signup.ajax.js"></script>
</body>
</html>