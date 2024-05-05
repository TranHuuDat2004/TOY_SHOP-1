<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <title>Omacha - Playful World</title>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="style.css">
    <!-- link icon -->
    <link rel="icon" type="image/png" href="images/icon.png" />
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body1>
    <div class="container">
        <form action="signup.php" method="post" autocomplete="off" class="sign-in-form">
            <input type="checkbox" id="flip">
            <div class="cover">
                <div class="front">
                    <img src="images/icon.png" alt="">
                </div>
                <div class="back">
                    <img class="backImg" src="images/backImg.jpg" alt="">
                    <div class="text">
                        <span class="text-1">Complete miles of journey <br> with one step</span>
                        <span class="text-2">Let's get started</span>
                    </div>
                </div>
            </div>
            <div class="forms">
                <div class="form-content">
                    <div class="login-form">
                        <div class="title">Signup</div>
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="userName" placeholder="Enter your name" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="loginpassword" placeholder="Enter your password" required>
                            </div>
                            <div class="text"><a href="#">Forgot password?</a></div>
                            <div class="button input-box">
                                <input type="submit" value="Sign Up" class="sign-btn">
                            </div>
                            <div class="text sign-up-text">Already have an account? <a href="login.php">Login
                                    now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body1>


</html>