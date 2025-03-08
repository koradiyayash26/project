<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-Clothing Slider</title>
  <link rel="stylesheet" href="Css/Slider.css">
</head>
<body>
  <div class="slider">
    <div class="slides">
      <img src="Img/Hey_Girl.webp" alt="Clothing 1">
      <img src="img/Hey_Girl1.webp" alt="Clothing 2">
      <img src="img/Hey_Girl2.webp" alt="Clothing 3">
    </div>
    <div class="navigation">
      <button id="prev">❮</button>
      <button id="next">❯</button>
    </div>
  </div>
  <div class="dots">
    <span class="dot active" data-slide="0"></span>
    <span class="dot" data-slide="1"></span>
    <span class="dot" data-slide="2"></span>
  </div>

  <script>
    const slides = document.querySelector('.slides');
    const slideImages = document.querySelectorAll('.slides img');
    const dots = document.querySelectorAll('.dot');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');

    let currentIndex = 0;

    const updateSlider = () => {
      slides.style.transform = `translateX(-${currentIndex * 100}%)`;
      dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentIndex);
      });
    };

    prevBtn.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + slideImages.length) % slideImages.length;
      updateSlider();
    });

    nextBtn.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % slideImages.length;
      updateSlider();
    });

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        currentIndex = index;
        updateSlider();
      });
    });
  </script>
</body>
</html>
