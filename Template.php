<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Fusion</title>
    <link rel="stylesheet" href="Styles.css">
</head>
<body>
    <header>
        <h1>Fashion Fusion</h1>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
    
    <section id="home">
        <h2>Welcome to Fashion Fusion</h2>
        <p>Discover the latest trends in fashion.</p>
    </section>
    
    <section id="products">
        <h2>Featured Products</h2>
        <div class="product">
            <img src="product1.jpg" alt="Fashion Item">
            <p>Stylish Jacket - $99</p>
        </div>
        <div class="product">
            <img src="product2.jpg" alt="Fashion Item">
            <p>Elegant Dress - $120</p>
        </div>
    </section>
    
    <section id="contact">
        <h2>Contact Us</h2>
        <form>
            <label for="name">Name:</label>
            <input type="text" id="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" required>
            
            <label for="message">Message:</label>
            <textarea id="message" required></textarea>
            
            <button type="submit">Send</button>
        </form>
    </section>
    
    <footer>
        <p>&copy; 2025 Fashion Fusion. All rights reserved.</p>
    </footer>
</body>
</html>
