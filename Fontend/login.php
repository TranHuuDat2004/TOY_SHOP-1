<?php
session_start();

// if (!isset($_SESSION['user'])) {
//   header('Location: ../admin/index.php');
//   die();
// }

$user = '';
$pass = '';
$error = '';

$conn = new mysqli('localhost', 'root', '', 'toy-shop'); //servername, username, password, database's name
if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
} else {
    if (isset($_POST['user']) && isset($_POST['pass'])) { // kiem tra xem bien co ton tai hay hong
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        if ($user === 'admin' && $pass === '1234') {
            $_SESSION['user'] = 'admin.com';
            header('Location: ../Admin/public/index.php');
        } else {
            $stmt = $conn->prepare("SELECT * FROM login WHERE userName = ? AND loginpassword = ?"); // so sanh bien nhap vao voi database
            $stmt->bind_param("ss", $user, $pass);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows <= 0) {
                $error = 'Invalid username or password';
            } else if ($result->num_rows > 0) {
                $_SESSION['user'] = $user;
                header('Location: ../Fontend/index.php');
            }
            $stmt->close();
            $conn->close();
        }
    }
}
?>

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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off" class="sign-in-form">
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
                        <div class="title">Login</div>
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" name="user" placeholder="Enter your Name" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="pass" placeholder="Enter your password" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" name="signin" value="Sign In" class="sign-btn">
                            </div>
                            <div class="text sign-up-text">Don't have an account? <a href="register.php">Sign up
                                    now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body1>


</html>