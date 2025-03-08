<?php
include "Conn.php";
session_start();
$user_id = 1; // Example: Replace with actual user session ID

// Fetch cart items for a specific user
$select_cart = "SELECT cart_demo.Product_Id, product.Product_Name, product.Price 
                FROM cart_demo 
                INNER JOIN product ON cart_demo.Product_Id = product.Product_Id 
                WHERE cart_demo.User_Id = '$user_id'";

$result_cart = mysqli_query($conn, $select_cart);
$total_price = 0;
$cart_items = [];

if ($result_cart && mysqli_num_rows($result_cart) > 0) {
    while ($row = mysqli_fetch_assoc($result_cart)) {
        $cart_items[] = $row;
        $total_price += $row['Price'];
    }
} else {
    echo "<script>alert('Your cart is empty! Redirecting to home.'); window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleAdda : Checkout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(251, 251, 249);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-image: url("Img/BackGrounf/check.avif");
            background-size: cover  ;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            font-family:'Times New Roman', Times, serif;
            color: white;
        }
        .checkout-form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            font-family: Arial, sans-serif;
            border-radius: 5px;
        }
        .place-order-btn {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 15px;
        }
        .place-order-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <?php include "Header.php"; ?>
    <div class="container">
        <h2>Checkout</h2>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
            </tr>
            <?php foreach ($cart_items as $item) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['Product_Name']); ?></td>
                    <td>₹<?php echo htmlspecialchars($item['Price']); ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td style="text-align:right; font-weight:bold;">Total:</td>
                <td>₹<?php echo htmlspecialchars($total_price); ?></td>
            </tr>
        </table>
        
        <form class="checkout-form" method="post">
            <div class="form-group">
                <label for="address">Shipping Address:</label>
                <input type="text" name="address" id="address" required>
            </div>
            <div class="form-group">
                <label for="payment">Payment Method:</label>
                <select name="payment" id="payment" required>
                    <option value="COD">Cash on Delivery</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="UPI">UPI</option>
                </select>
            </div>
            <button type="submit" name="place_order" class="place-order-btn">Place Order</button>
        </form>
    </div>

    <?php
    if (isset($_POST['place_order'])) {
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $payment_method = mysqli_real_escape_string($conn, $_POST['payment']);
        
        // Insert order details into database
        $order_query = "INSERT INTO orders (User_Id, Total_Amount, Address, Payment_Method) VALUES ('$user_id', '$total_price', '$address', '$payment_method')";
        
        if (mysqli_query($conn, $order_query)) {
            $order_id = mysqli_insert_id($conn);
            foreach ($cart_items as $item) {
                $product_id = $item['Product_Id'];
                mysqli_query($conn, "INSERT INTO order_items (Order_Id, Product_Id) VALUES ('$order_id', '$product_id')");
            }
            
            // Clear the cart after order is placed
            mysqli_query($conn, "DELETE FROM cart_demo WHERE User_Id='$user_id'");
            echo "<script>alert('Order placed successfully!'); window.location.href='order_confirmation.php';</script>";
        } else {
            echo "<script>alert('Failed to place order. Please try again.');</script>";
        }
    }
    ?>
</body>
</html>
