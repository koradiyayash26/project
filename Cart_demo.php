<?php 
include "Conn.php"; 
session_start(); // Start session to track users
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleAdda : Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-size: cover;
            display: block;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            margin-top: 3%;
            padding: 20px;
            background-color: aqua;
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
            font-family: 'Times New Roman', Times, serif;
            color: white;
        }
        .remove-btn {
            padding: 10px 15px;
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .remove-btn:hover {
            background-color: darkred;
        }
        .checkout-btn {
            padding: 10px 15px;
            background-color: rgb(32, 136, 19);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin: 20px auto;
            width: 200px;
        }
        .checkout-btn:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <script>
        // Check if user is logged in
        document.addEventListener('DOMContentLoaded', function() {
            const userId = localStorage.getItem('user_id');
            if (!userId) {
                alert('Please login to access your cart');
                window.location.href = 'Index.php';
                return;
            }
        });
    </script>

    <!-- Add logout button -->
    <div style="text-align: right; padding: 10px;">
        <button onclick="logout()" style="padding: 8px 15px; background-color: #ff4444; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Logout
        </button>
    </div>

    <?php include "Header.php"; ?>
    <div class="container">
        <h2>Your Shopping Cart</h2>

        <script>
            // Prevent infinite refresh by tracking user_id submission
            document.addEventListener('DOMContentLoaded', function () {
                var user_id = localStorage.getItem('user_id');
                if (user_id && !sessionStorage.getItem('user_id_submitted')) {
                    var form = document.createElement('form');
                    form.method = 'post';
                    form.style.display = 'none';
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'user_id_php';
                    input.value = user_id;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    sessionStorage.setItem('user_id_submitted', 'true'); // Prevent re-submitting on refresh
                    form.submit();
                }
            });
        </script>

        <table>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        
            <?php
            // Retrieve user_id from POST request or session
            $user_id = isset($_POST['user_id_php']) ? $_POST['user_id_php'] : (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '');

            if (!empty($user_id)) {
                // Debugging: Check if user_id is correctly retrieved
                echo "<script>console.log('User ID: " . $user_id . "');</script>";

                // Store user_id in session for future use
                $_SESSION['user_id'] = $user_id;

                $select_cart = "SELECT p.Product_Id, p.Product_Name, p.Category, p.Price, p.Size, p.Description, p.Product_Image 
                                FROM cart_demo c 
                                JOIN product p ON c.product_id = p.Product_Id 
                                WHERE c.user_id = ?";
                
                $stmt = mysqli_prepare($conn, $select_cart);
                mysqli_stmt_bind_param($stmt, "s", $user_id);
                mysqli_stmt_execute($stmt);
                $result_cart = mysqli_stmt_get_result($stmt);

                $total_price = 0;

                if ($result_cart && mysqli_num_rows($result_cart) > 0) {
                    while ($row = mysqli_fetch_assoc($result_cart)) {
                        $product_id = $row['Product_Id'];
                        $subtotal = $row['Price'];
                        $total_price += $subtotal;

                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['Product_Name']) . "</td>";
                        echo "<td>₹" . htmlspecialchars($row['Price']) . "</td>";
                        echo "<td>1</td>";
                        echo "<td>₹" . htmlspecialchars($subtotal) . "</td>";
                        echo "<td>
                                <form method='post'>
                                    <input type='hidden' name='remove_id' value='" . htmlspecialchars($product_id) . "'>
                                    <button class='remove-btn' name='remove_cart'>Remove</button>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                    echo "<tr>
                            <td colspan='3' style='text-align:right; font-weight:bold;'>Total:</td>
                            <td colspan='2'>₹" . htmlspecialchars($total_price) . "</td>
                          </tr>";
                } else {
                    echo "<tr><td colspan='5' style='text-align:center;'>Your cart is empty.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>Unable to retrieve user information.</td></tr>";
            }
            ?>
        </table>

        <?php if (isset($total_price) && $total_price > 0) { ?>
            <button class="checkout-btn" onclick="window.location.href='checkout.php'">Proceed to Checkout</button>
        <?php } ?>
    </div>

    <?php
    // Remove item from cart
    if (isset($_POST['remove_cart']) && isset($_POST['remove_id'])) {
        $remove_id = $_POST['remove_id'];
        $delete_query = "DELETE FROM cart_demo WHERE product_id=? AND user_id=?";
        
        $stmt = mysqli_prepare($conn, $delete_query);
        mysqli_stmt_bind_param($stmt, "ss", $remove_id, $user_id);
        mysqli_stmt_execute($stmt);

        echo "<script>alert('Item removed from cart!'); window.location.href='Cart_demo.php';</script>";
    }
    ?>

    <script>
        // Add logout function
        function logout() {
            localStorage.removeItem('user_id');
            window.location.href = 'Index.php';
        }
    </script>
</body>
</html>
