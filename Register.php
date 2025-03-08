<?php
session_start();
include("Conn.php");
?>

<?php
// ob_start();

// $FullName = $e_FullName = "";

if (isset($_POST['submitbt'])) {

    $FullName = $_POST['FullName'];
    $Email = $_POST['Email'];
    $PassWord = $_POST['PassWord'];
    $Phone = $_POST['Phone'];

    // $count = 0;

    // if ($FullName == "") {
    //     $e_FullName = "Please Enter FullName ";
    //     $count++;
    // }


    $sql = "INSERT INTO register values(null,'$FullName', '$Email', '$PassWord',' $Phone')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>alert('Insert Data Successfully');window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Failed to Insert Data');window.location.href='Register.php';</script>";
    }
}
?>

<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Shopping Site</title>
    <link rel="stylesheet" href="Register.css">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <div class="blur">
            <h2>Register Form </h2>
            <form method="POST" action='Register.php'>
                <div class="form-group">
                    <label for="full-name">Full Name</label>
                    <input type="text" name="FullName" placeholder="Enter Fullname" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="Email" placeholder="Enter Email" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="PassWord" placeholder="Enter Password" autocomplete="off" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="Phone" placeholder="Enter Phone" autocomplete="off" required>
                </div>


                <input type="submit" value="Submit" name="submitbt">

            </form>

            <div class="note">
                <p>Already have an account? <a href="index.php">Login here</a></p>
            </div>
        </div>
    </div>


</body>

</html>