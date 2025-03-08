<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | Fashion Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .categories {
            padding: 3rem 1rem;
            text-align: center;
           
          
        }
        .categories h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #333;
        }
        .category-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1.5rem;
            
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            width: 250px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-bottom: 2px solid #ddd;
        }
        .card p {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 1rem;
            color: #555;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <?php include "Header.php"; ?>
    
    <section class="categories" id="categories">
        <h2>Shop by Category</h2>
        <div class="category-container">
            <a href="Men.php">
            <div class="card">
                <img src="Img/Shirts/S_Img1.jpg" alt="Men's Clothing">
                <p>Men's Clothing</p>
            </div>
            </a>

            <a href="Women.php">
            <div class="card">
                <img src="Img/Women/blum-09.webp" alt="Women's Clothing">
                <p>Women's Clothing</p>
            </div>
            </a>

        </div>
    </section>
    
    <?php include("Footer.php"); ?>
</body>
</html>
