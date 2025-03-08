<?php
include "Conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Shopping Site</title>
    <link rel="stylesheet" href="Css/Login.css">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="********" required>
            </div>

            <div class="checkbox-container">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>

            <input type="submit" value="Login" name="log">
        </form>

        <div class="forgot-password">
            <p><a href="Forgot.php">Forgot your password?</a></p>
        </div>

        <div class="note">
            <p>Don't have an account? <a href="Register.php">Sign up here</a></p>
        </div>
    </div>
    <?php
    if (isset($_POST['log'])) 
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $userSql = "SELECT * FROM register WHERE Email='$email' AND PassWord='$password'";
        $userResult = mysqli_query($conn, $userSql);
        $userRow = mysqli_fetch_assoc($userResult);
        $userCheck = mysqli_num_rows($userResult);

        if ($userCheck) 
        {
            $userId = $userRow['Id'];
            echo "<script>localStorage.setItem('user_id', '$userId');</script>";
            echo "<script>alert(' Welcome To StyleADDA ');window.location.href='Home.php';</script>";
        } 
        else 
        {
            echo "<script>alert('Wrong Email & Password');window.location.href='Index.php';</script>";
        }
    }
    ?>

</body>

</html>
