<?php
    include "Conn.php";

    $select="select * from product";
    $result=$conn->query($select);
    $countTP=mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Main Content */
    .main-content {
      flex-grow: 1;
      padding: 20px;
      background-color: #ecf0f1;
    }

    .header {
      background-color: #3498db;
      color: white;
      padding: 15px;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .content-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }

    .card {
      background-color: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .card h3 {
      margin-bottom: 10px;
    }

    .card p {
      color: #7f8c8d;
    }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="main-content">
    <div class="header">
      <h1>Welcome, Admin</h1>
      <p>Manage your clothing store effectively.</p>
    </div>

    <div class="content-cards">
      <div class="card">
        <h3>Total Products</h3>
        <p><?php echo $countTP; ?></p>
      </div>
      <div class="card">
        <h3>Pending Orders</h3>
        <p>42</p>
      </div>
      <div class="card">
        <h3>Revenue</h3>
        <p>$18,450</p>
      </div>
      <div class="card">
        <h3>Customers</h3>
        <p>1,245</p>
      </div>
      <div class="card">
        <h3>Out of Stock</h3>
        <p>15 Products</p>
      </div>
    </div>
  </div>
</body>
</html>