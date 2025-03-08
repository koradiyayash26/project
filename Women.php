
<?php
session_start();
include("Conn.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_cart'])) 
{
    if (!empty($_POST['product_id']) && isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id']; // Assuming user session ID is stored
        $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $quantity = 1; // Default quantity

        // Check if the product is already in the cart
        $check_cart = "SELECT * FROM Cart_demo WHERE User_Id='$user_id' AND Product_Id='$product_id'";
        $result_check = mysqli_query($conn, $check_cart);

        if (mysqli_num_rows($result_check) > 0) {
            // Update quantity if product exists
            $update_cart = "UPDATE cart_demo SET Quantity = Quantity + 1 WHERE User_Id='$user_id' AND Product_Id='$product_id'";
            $query_update = mysqli_query($conn, $update_cart);
        } else {
            // Insert new product into cart
            $insert_cart = "INSERT INTO cart_demo (User_Id, Product_Id, Quantity) VALUES ('$user_id', '$product_id', '$quantity')";
            $query_insert = mysqli_query($conn, $insert_cart);
        }

        if ($query_insert || $query_update) {
            echo "<script>alert('Added to Cart Successfully'); window.location.href='Cart_demo.php';</script>";
        } 
        else 
        {
            echo "<script>alert('Error adding to cart');</script>";
        }
    }
    else 
    {
        echo "<script>alert('Please log in to add items to the cart');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women's Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product {
            width: 30%;
            background: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .product img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product h3 {
            margin: 10px 0;
        }

        .product p {
            color: #555;
        }

        .product span {
            font-weight: bold;
            color: green;
        }

        .add-to-cart {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }

        .add-to-cart:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <?php include 'Header.php'; ?>

    <div class="container">
        <h2>Women's Products</h2>

        <div class="products">
            <?php
            $query = "SELECT * FROM product WHERE category = 'women'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product">
                            <img src="uploads/' . $row['Product_Image'] . '" alt="' . $row['Product_Name'] . '">
                            <h3>' . $row['Product_Name'] . '</h3>
                            <p>Size: ' . $row['Size'] . '</p>
                            <p>' . $row['Description'] . '</p>
                            <span>Price: $' . $row['Price'] . '</span>

                            <form action="cart_demo.php" method="POST">
                                <input type="hidden" name="product_id" value="' . $row['Product_Id'] . '">
                                <input type="hidden" name="product_name" value="' . $row['Product_Name'] . '">
                                <input type="hidden" name="price" value="' . $row['Price'] . '">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-to-cart" name="add_to_cart">Add to Cart</button>
                            </form>

                          </div>';
                }
            } else {
                echo "<p>No products available in this category.</p>";
            }
            ?>
        </div>
    </div>

</body>

</html>
