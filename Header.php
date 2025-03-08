<!DOCTYPE html>
<html lang="en">
<?php include 'Conn.php'?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/Header.css">
</head>

<body>
    <header>
        <img src="Css/Img/Logo/StyleAdda-removebg-preview.png" width="100" height="90" align=left>
        <!-- <h1><b>E Commerce Clothing </b></h1> -->
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
        
        <a href="Register.php">Sign Up</a>
        <a href="Index.php">Sign In</a>
    </nav>
</body>

</html>