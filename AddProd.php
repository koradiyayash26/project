<?php 
include("Conn.php");  

// Add Product  
if (isset($_POST['submit'])) {     
    $Product_Name = $_POST['Product_Name'];     
    $category = $_POST['category'];     
    $Price = $_POST['Price'];     
    $Size = $_POST['Size'];     
    $Description = $_POST['Description'];     
    $Product_Image = $_FILES['Product_Image']['name'];     
    $tmp_name = $_FILES['Product_Image']['tmp_name'];     
    $path = "./uploads";      

    $ProductImage_ext = pathinfo($Product_Image, PATHINFO_EXTENSION);     
    $filename = time() . "." . $ProductImage_ext;      

    $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];      

    // Validate Price
    if (!is_numeric($Price)) {
        echo "<script>alert('Invalid price value.');window.location.href='AddProd.php';</script>";
        exit();
    }

    if (in_array($ProductImage_ext, $allowed_types) && $_FILES['Product_Image']['size'] < 2000000) {     
        // Check if product already exists     
        $check_stmt = $conn->prepare("SELECT COUNT(*) FROM product WHERE Product_Name = ? AND category = ? AND Size = ?");     
        $check_stmt->bind_param("ssi", $Product_Name, $category, $Size);     
        $check_stmt->execute();     
        $check_stmt->bind_result($count);     
        $check_stmt->fetch();     
        $check_stmt->close();      

        if ($count > 0) {         
            echo "<script>alert('Product Already Exists!');window.location.href='LatestCloths.php';</script>";     
        } else {         
            // Proceed with insertion         
            $stmt = $conn->prepare("INSERT INTO product (`Product_Name`, `category`, `Price`, `Size`, `Description`, `Product_Image`) VALUES (?, ?, ?, ?, ?, ?)");         
            $stmt->bind_param("ssisss", $Product_Name, $category, $Price, $Size, $Description, $filename);          

            if ($stmt->execute()) 
            {             
                if (move_uploaded_file($tmp_name, $path . "/" . $filename)) {             
                    echo "<script>alert('Successfully Added Product');window.location.href='LatestCloths.php';</script>";         
                } else {             
                    echo "<script>alert('Failed to upload product image.');window.location.href='Admin.php';</script>";         
                }         
            } 
            else
           {             
                echo "<script>alert('Not Added Product: " . $stmt->error . "');window.location.href='AddProd.php';</script>";         
            }         
            $stmt->close();
        } 
    } else {     
        echo "<script>alert('Invalid file type or file size too large.');window.location.href='AddProd.php';</script>"; 
    }  
}  
?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0px;
      background-image:url("Img/AddProd.jpg");
      background-size: cover;
      opacity: 0.8;
      display:block;
    }

    form {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      margin-top: 3%;
      margin-bottom: 5%;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);

    }

    form h2 {
      margin-bottom: 20px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input,
    select,
    textarea,
    button {
      width: 100%;
      padding: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  
  <form method="POST" enctype="multipart/form-data">
    
    <h2>Add Product</h2>
    <label for="productName">Product Name</label>
    <input type="text" id="productName" name="Product_Name" placeholder="Enter product name" required>

    <label for="category">Category</label>
    <select id="category" name="category" required>
      <option value="">Select category</option>
      <option value="men">Men</option>
      <option value="women">Women</option>
      <option value="kids">Kids</option>
      <option value="accessories">Accessories</option>
    </select>

    <label for="price">Price</label>
    <input type="number" id="price" name="Price" step="0.01" placeholder="Enter product price" required>

    <label for="size">Size</label>
    <select id="size" name="Size" required>
      <option value="">Select size</option>
      <option value="S">Small</option>
      <option value="M">Medium</option>
      <option value="L">Large</option>
      <option value="XL">Extra Large</option>
    </select>

    <label for="description">Description</label>
    <textarea id="description" name="Description" rows="4" placeholder="Enter product description"></textarea>

    <label for="productImage">Product Image</label>
    <input type="file" id="productImage" name="Product_Image" accept="image/*" required>


    <button type="submit" name="submit">Add Product</button>
  </form>
</body>

</html>