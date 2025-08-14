<?php
  if(isset($_GET['id'])):
    require_once('../../../ket-noi-co-so-du-lieu.php');
    $id = $_GET['id'];
    $sql = "select * from sanpham where id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $_GET['ten'] = $row['ten'];
    $_GET['nhanhang'] = $row['nhanhang'];
    $_GET['thanhphan'] = $row['thanhphan'];
    $_GET['loinhuan'] = $row['loinhuan'];
    $_GET['image'] = $row['image'];
  endif;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thông Tin Sản Phẩm</title>
  <link rel="stylesheet" href="../css/thongtin.css">
  <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
</head>
<body>
  <!-- Loading Screen -->
  <div class="loading"></div>
  
  <div class="container">
    <div class="product-box">
      <div class="product-image">
        <img src="../img/<?php echo $_GET['image']?>" alt="ảnh">
      </div>
      <div class="product-info">
        <h2 class="product-title"><?php echo $_GET['ten']?></h2>

        <div class="nutrition">
          <p><strong>Nhà sản xuất:</strong> <?php echo $_GET['nhanhang']?></p>
          <div class="section-title">Thành phần dinh dưỡng:</div>
          
          <p><?php echo $_GET['thanhphan']?></p>
        </div>

        <div class="benefits">
          <div class="section-title">Lợi ích sản phẩm:</div>
          <?php echo $_GET['loinhuan']?>
        </div>
      </div>
    </div>
  </div>

  <!-- Close Button -->
  <a href="javascript:window.close()" class="close-button">
    <i class="fas fa-times"></i>
  </a>

  <script>
    // Loading Animation
    window.addEventListener('load', function() {
      const loading = document.querySelector('.loading');
      if (loading) {
        setTimeout(() => {
          loading.style.display = 'none';
        }, 2000);
      }
    });

    // Particle Effect
    function createParticle() {
      const particle = document.createElement('div');
      particle.style.position = 'fixed';
      particle.style.width = '3px';
      particle.style.height = '3px';
      particle.style.background = 'rgba(102, 126, 234, 0.6)';
      particle.style.borderRadius = '50%';
      particle.style.pointerEvents = 'none';
      particle.style.zIndex = '1';
      particle.style.left = Math.random() * window.innerWidth + 'px';
      particle.style.top = window.innerHeight + 'px';
      particle.style.animation = 'particleFloat 8s linear infinite';
      
      document.body.appendChild(particle);
      
      setTimeout(() => {
        particle.remove();
      }, 8000);
    }

    // Create particles periodically
    setInterval(createParticle, 2000);

    // Add CSS for particle animation
    const style = document.createElement('style');
    style.textContent = `
      @keyframes particleFloat {
        0% {
          transform: translateY(0) rotate(0deg);
          opacity: 1;
        }
        100% {
          transform: translateY(-100vh) rotate(360deg);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);

    // Scroll Reveal Animation
    function revealOnScroll() {
      const reveals = document.querySelectorAll('.product-box, .product-image, .product-info');
      reveals.forEach(element => {
        const windowHeight = window.innerHeight;
        const elementTop = element.getBoundingClientRect().top;
        const elementVisible = 150;
        
        if (elementTop < windowHeight - elementVisible) {
          element.classList.add('active');
        }
      });
    }

    // Initialize reveal on scroll
    document.addEventListener('DOMContentLoaded', function() {
      revealOnScroll();
    });

    // Listen for scroll events
    window.addEventListener('scroll', revealOnScroll);

    // Add hover effects to list items
    document.addEventListener('DOMContentLoaded', function() {
      const listItems = document.querySelectorAll('li');
      listItems.forEach(item => {
        item.classList.add('glow');
      });
    });

    // Parallax effect for background
    window.addEventListener('scroll', function() {
      const scrolled = window.pageYOffset;
      const parallax = document.querySelector('body::before');
      if (parallax) {
        const speed = scrolled * 0.5;
        parallax.style.transform = `translateY(${speed}px)`;
      }
    });

    // Add typing effect to title
    function typeWriter(element, text, speed = 100) {
      let i = 0;
      element.innerHTML = '';
      
      function type() {
        if (i < text.length) {
          element.innerHTML += text.charAt(i);
          i++;
          setTimeout(type, speed);
        }
      }
      
      type();
    }

    // Initialize typing effect
    document.addEventListener('DOMContentLoaded', function() {
      const title = document.querySelector('.product-title');
      if (title) {
        const originalText = title.textContent;
        setTimeout(() => {
          typeWriter(title, originalText, 50);
        }, 1000);
      }
    });
  </script>
</body>
</html>