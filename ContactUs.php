<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullName = $_POST['fullName'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // You can process the form data here (e.g., send email, store in database, etc.)
    echo "<p>Thank you for contacting us, $fullName! We will get back to you soon.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | E-Clothing Fashion</title>
    <link rel="stylesheet" href="Css\style.css">
</head>
<body>

<div class="container">
    <div class="contact-form">
        <h2>Contact Us</h2>
        <p>Sign Up For Our News Letters</p>
        
        <form action="" method="POST">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">SEND NOW</button>
        </form>
    </div>

    <div class="contact-info">
        <h3>Connect With Us</h3>
        <p><strong>Phone:</strong> (+91) 02849 231 005</p>
        <p><strong>Email:</strong> INFO@ECLOTHINGFASHION.COM</p>
        <p><strong>Address:</strong> FASHION STREET, GIDC, PALIYAD ROAD, BOTAD, GUJARAT-364710</p>
        <div class="map">
            <img src="map.png" alt="Map">
        </div>
    </div>
</div>

</body>
</html>