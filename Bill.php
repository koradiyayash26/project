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

// Fetch order items
$order_id = $order['Order_Id'];
$order_items_query = "SELECT product.Product_Name, product.Price 
                      FROM order_items 
                      INNER JOIN product ON order_items.Product_Id = product.Product_Id 
                      WHERE order_items.Order_Id = '$order_id'";

$result_items = mysqli_query($conn, $order_items_query);
if (!$result_items) {
    die("Query failed: " . mysqli_error($conn)); // Debugging error
}

$order_items = mysqli_fetch_all($result_items, MYSQLI_ASSOC);


// GST calculation
$gst_rate = 0.18;
$gst_amount = $order['Total_Amount'] * $gst_rate;
$grand_total = $order['Total_Amount'] + $gst_amount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing - StyleAdda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .details {
            margin-top: 20px;
            font-size: 16px;
        }
        .invoice-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
        }
        .invoice-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Billing Details</h2>
        <div class="details">
            <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['Order_Id']); ?></p>
            <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($order['Address']); ?></p>
            <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['Payment_Method']); ?></p>
        </div>

        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
            </tr>
            <?php foreach ($order_items as $item) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['Product_Name']); ?></td>
                    <td>₹<?php echo htmlspecialchars($item['Price']); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td style="text-align:right; font-weight:bold;">Subtotal:</td>
                <td>₹<?php echo htmlspecialchars($order['Total_Amount']); ?></td>
            </tr>
            <tr>
                <td style="text-align:right; font-weight:bold;">GST (18%):</td>
                <td>₹<?php echo number_format($gst_amount, 2); ?></td>
            </tr>
            <tr>
                <td style="text-align:right; font-weight:bold;">Grand Total:</td>
                <td>₹<?php echo number_format($grand_total, 2); ?></td>
            </tr>
        </table>

        <a href="Home.php?order_id=<?php echo $order_id; ?>" class="invoice-btn">Continue Shopping</a>
    </div>
</body>
</html>
