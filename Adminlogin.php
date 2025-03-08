<?php
    include("Conn.php");

    if(isset($_POST['Admin']))
    {
        $Username=$_POST['Username'];
        $PassWord=$_POST['PassWord'];

        $sql="select * from  Admin where Username='$Username' and Password='$PassWord'";
        $query=mysqli_query($conn,$sql);
        $check=mysqli_num_rows($query);


        if ($check) {
            echo "<script>alert(' Successfully Login ');window.location.href='Admin.php';</script>";
        } else {
            echo "<script>alert('Wrong UserName & PassWord');window.location.href='Adminlogin.php';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

/* Background and Container */
body {
    background-image: url("Img/BackGrounf/AdminHD.jpg");
    background-size: cover;
    background-position: center;
    height: 100vh;
    opacity: 0.6;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-container {
    display: flex;
    justify-content: left;
    margin-left: 100px;
    align-items: center;
    width: 100%;
    height: 100%;
}

.login-box {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    padding: 30px 40px;
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Heading */
.login-box h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
    font-family: 'Times New Roman', Times, serif;
}

/* Form */
.form-group {
    margin-bottom: 15px;
    text-align: left;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    font-family:Arial, Helvetica, sans-serif;
    color: #555;
}

.form-group input {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-family: comic sans ms;
    transition: border-color 0.3s ease;
}

.form-group input:focus {
    border-color: #6a11cb;
    outline: none;
    box-shadow: 0 0 5px rgba(106, 17, 203, 0.3);
    
}

/* Button */
#login-button {
    background:rgb(48, 94, 178);
    color: #fff;
    font-size: 18px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
    width: 100%;
    font-family:Arial, Helvetica, sans-serif;
}

#login-button:hover {
    background: #2575fc;
}

/* Responsive Design */
@media (max-width: 768px) {
    .login-box {
        padding: 20px;
    }
}

    
    </style>
</head>
<body>
<div class="login-container">
        <div class="login-box">
            <h2>Admin Login</h2>
            <form method="post" action="Adminlogin.php">
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" id="username" name="Username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="PassWord" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="Admin" id="login-button">Login</button>
            </form>
        </div>
    </div>
</body>
</html>