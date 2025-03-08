<!DOCTYPE html>
<html lang="en">
<?php include 'Conn.php'?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Header.css">
</head>

<body>
    <header>
        <img src="Img/Logo/StyleAdda-removebg-preview.png" width="100" height="90" align=left>
        <!-- <h1><b>E Commerce Clothing </b></h1> -->

        <div class="auth-buttons" style="text-align: right; padding: 10px;">
            <div id="loggedOut" style="display: none;">
                <a href="Index.php" style="padding: 8px 15px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px;">
                    Sign In
                </a>
                <a href="Register.php" style="padding: 8px 15px; background-color: #2196F3; color: white; text-decoration: none; border-radius: 5px;">
                    Sign Up
                </a>
            </div>
            <div id="loggedIn" style="display: none;">
                <button onclick="logout()" style="padding: 8px 15px; background-color: #ff4444; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Logout
                </button>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const userId = localStorage.getItem('user_id');
                const loggedInDiv = document.getElementById('loggedIn');
                const loggedOutDiv = document.getElementById('loggedOut');
                
                if (userId) {
                    loggedInDiv.style.display = 'block';
                    loggedOutDiv.style.display = 'none';
                } else {
                    loggedInDiv.style.display = 'none';
                    loggedOutDiv.style.display = 'block';
                }
            });

            function logout() {
                localStorage.removeItem('user_id');
                window.location.href = 'Index.php';
            }
        </script>
    </header>
    <nav>
        <a href="Home.php">Home</a>
        <a href="categories.php">Categories</a>
        <a href="Aboutus.php">About Us</a>
        <a href="ContactUs.php">Contact</a>
        <?php
            $select_rows = mysqli_query($conn, "SELECT * FROM `Cart_demo`") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);

        ?>
        <a href="Cart_demo.php">Cart <span><?php echo $row_count; ?></span></a>
    </nav>
</body>

</html>