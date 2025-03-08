<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing E-Commerce</title>
    <link rel="stylesheet" href="Home.css">
    
</head>

<body>
    <?php include 'Header.php'; ?>
    
    <!-- Add this check at the top after header -->
    <script>
        // Check if user is logged in
        document.addEventListener('DOMContentLoaded', function() {
            const userId = localStorage.getItem('user_id');
            if (!userId) {
                window.location.href = 'Index.php';
            }
        });
    </script>

    <!-- Add logout button -->
    <div style="text-align: right; padding: 10px;">
        <button onclick="logout()" style="padding: 8px 15px; background-color: #ff4444; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Logout
        </button>
    </div>

    <h1>Featured Clothing Ads</h1>
    <div class="ad-rotator" id="adRotator">
       
        <!-- Ad 1 -->
        <div class="ad active">
            <a href="#" target="_blank">
                <img src="Img/AddRO/istockphoto-1207027323-612x612.jpg" alt="Ad Not Founf">
            </a>
        </div>
        <!-- Ad 2 -->
        <div class="ad">
            <a href="#" target="_blank">
                <img src="Img/AddRO/keagan-henman-xPJYL0l5Ii8-unsplash.jpg" alt="Ad Not Founf">
            </a>
        </div>
        <!-- Ad 3 -->
        <div class="ad">
            <a href="#" target="_blank">
                <img src="Img/AddRO/parker-burchfield-tvG4WvjgsEY-unsplash.jpg" alt="Ad Not Founf">
            </a>
        </div>
        <div class="ad active">
            <a href="#" target="_blank">
                <img src="Img/BackGrounf/Header.jpg" alt="Ad Not Founf">
            </a>
        </div>
    </div>

    <script>
        // Add logout function
        function logout() {
            localStorage.removeItem('user_id');
            window.location.href = 'Index.php';
        }

        // JavaScript for rotating ads
        const ads = document.querySelectorAll('.ad');
        let currentAdIndex = 0;

        function rotateAds() {
            ads[currentAdIndex].classList.remove('active'); // Hide current ad
            currentAdIndex = (currentAdIndex + 1) % ads.length; // Move to the next ad
            ads[currentAdIndex].classList.add('active'); // Show next ad
        }

        // Rotate ads every 5 seconds
        setInterval(rotateAds, 3000);
    </script>
    
    
    
   
    <!-- Footer -->
    <?php 
    include 'Footer.php';
    ?>
</body>

</html>