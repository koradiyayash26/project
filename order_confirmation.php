<?php
include "Conn.php";
session_start();
$user_id = 1; // Example: Replace with actual user session ID

// Fetch the latest order details
$order_query = "SELECT * FROM orders WHERE User_Id = '$user_id' ORDER BY Order_Id DESC LIMIT 1";
$result_order = mysqli_query($conn, $order_query);
$order = mysqli_fetch_assoc($result_order);

if (!$order) {
    echo "<script>alert('No recent order found! Redirecting to home.'); window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #28a745;
        }
        .details {
            margin-top: 20px;
            text-align: left;
        }
        .details p {
            font-size: 16px;
        }
        .home-btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
        }
        .home-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thank You for Your Order!</h2>
        <p>Your order has been placed successfully.</p>

        <div class="details">
            <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['Order_Id']); ?></p>
            <p><strong>Total Amount:</strong> ₹<?php echo htmlspecialchars($order['Total_Amount']); ?></p>
            <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($order['Address']); ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['Payment_Method']); ?></p>
        </div>

        <a href="Bill.php" class="home-btn">Collect Bill</a>
    </div>
</body>
</html>
