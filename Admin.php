<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clothing Store Admin</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      display: flex;
      min-height: 100vh;
      
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color:rgb(245, 245, 246);
      color: white;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .sidebar a {
      color: black;
      text-decoration: none;
      margin: 10px 0;
      padding: 10px;
      border-radius: 5px;
      display: block;
    }

    .sidebar a:hover {
      background-color: #34495e;
    }
    .sidebar a:focus{
      background-color: #34495e;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
  <img src="Img/Logo/StyleAdda-removebg-preview.png" width="100" height="100" >
    <a href="deshboard.php" target="content">Dashboard</a>
    <a href="Products.php" target="content">View Products</a>
    <a href="Orders.php" target="content">Orders</a>
    <a href="categories.php" target="content">Categories</a>
    <a href="Customers.php" target="content">Customers</a>
    <a href="AddProd.php" target="content">Add Product</a>
    <a href="#Logout.php">Logout</a>
  </div>
</body>
</html>
