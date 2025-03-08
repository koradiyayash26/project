<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing E-Commerce</title>
    <link rel="stylesheet" href="Css/Home.css">
    
</head>

<body>
    <?php include 'Header.php'; ?>
    <h1>Featured Clothing Ads</h1>
    <div class="ad-rotator" id="adRotator">
       
        <!-- Ad 1 -->
        <div class="ad active">
            <a href="#" target="_blank">
                <img src="Css/Img/AddRO/istockphoto-1207027323-612x612.jpg" alt="Ad Not Founf">
            </a>
        </div>
        <!-- Ad 2 -->
        <div class="ad">
            <a href="#" target="_blank">
                <img src="Css/Img/AddRO/keagan-henman-xPJYL0l5Ii8-unsplash.jpg" alt="Ad Not Founf">
            </a>
        </div>
        <!-- Ad 3 -->
        <div class="ad">
            <a href="#" target="_blank">
                <img src="Css/Img/AddRO/parker-burchfield-tvG4WvjgsEY-unsplash.jpg" alt="Ad Not Founf">
            </a>
        </div>
        <div class="ad active">
            <a href="#" target="_blank">
                <img src="Css/Img/BackGrounf/Header.jpg" alt="Ad Not Founf">
            </a>
        </div>
    </div>

    <script>
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