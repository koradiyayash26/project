<?php
include "Conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyleAdda : Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product-box img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .product-box h3 {
            font-size: 18px;
            margin: 10px 0;
        }

        .product-box p {
            font-size: 14px;
            color: #555;
        }

        .product-box .price {
            font-size: 20px;
            color: #333;
            font-weight: bold;
        }

        .add-to-cart {
            margin-top: 10px;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .add-to-cart:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1 class="heading" style="text-align: center;">Latest Clothes</h1>
<div class="container">
    <div class="products">
        <?php
        $select_products = "SELECT * FROM `product`";
        $result_products = mysqli_query($conn, $select_products);

        if (mysqli_num_rows($result_products) > 0) {
            while ($row = mysqli_fetch_assoc($result_products)) {
                ?>
                <form method="post">
                    <div class='product-box'>
                        <?php
                        $image = !empty($row['Product_Image']) ? $row['Product_Image'] : 'default.jpg';
                        $productName = !empty($row['Product_Name']) ? $row['Product_Name'] : "No Name";
                        ?>
                        <img src='uploads/<?php echo htmlspecialchars($image); ?>' alt='<?php echo htmlspecialchars($productName); ?>'>
                        <h3><?php echo htmlspecialchars($productName); ?></h3>
                        <p>Category: <?php echo htmlspecialchars($row['Category']); ?></p>
                        <p>Size: <?php echo htmlspecialchars($row['Size']); ?></p>
                        <p>Description: <?php echo htmlspecialchars($row['Description']); ?></p>
                        <p class='price'>₹<?php echo htmlspecialchars($row['Price']); ?></p>
                        <input type="hidden" name="product_id" value="<?php echo $row['Product_Id']; ?>"/>
                        <button type="submit" name="add_cart" class="add-to-cart">Add to Cart</button>
                    </div>
                </form>
                <?php
            }
        } else {
            echo "<p style='text-align:center;'>No products found.</p>";
        }
        ?>
    </div>
</div>

<?php
// Handle add to cart submission
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_cart'])) {
    if (!empty($_POST['product_id'])) {
        $pro = mysqli_real_escape_string($conn, $_POST['product_id']);
        
        $sql = "INSERT INTO Cart_demo (User_Id, Product_Id) VALUES (1, '$pro')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script>alert('Added to Cart Successfully'); window.location.href='Cart_demo.php';</script>";
        } else {
            echo "<script>alert('Error adding to cart');</script>";
        }
    }
}
?>
</body>
</html>
