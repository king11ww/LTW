<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thông Tin Sản Phẩm</title>
  <link rel="stylesheet" href="../css/thongtin.css">
</head>
<body>
  <div class="container">
    <div class="product-box">
      <a href="../php/batdau.php" class="close-button">×</a>
      <div class="product-image">
        <img src="../img/<?php echo $_GET['image']?>" alt="ảnh">
      </div>

      <div class="product-info">
        <h2 class="product-title"><?php echo $_GET['ten']?></h2>

        <div class="nutrition">
          <p>Nhà sản xuất : <?php echo $_GET['nhanhang']?></p>
          <div class="section-title">Thành phần dinh dưỡng:</div>
          
          <p>Sữa non, DHA, FOS, Canxi, Vitamin D3, Kẽm, Lysine...</p>
        </div>

        <div class="benefits">
          <div class="section-title">Lợi ích sản phẩm:</div>
          <ul>
            <li>Hỗ trợ tăng cân và chiều cao cho trẻ suy dinh dưỡng</li>
            <li>Tăng cường sức đề kháng và phát triển trí não</li>
            <li>Giúp tiêu hóa tốt và hấp thu dưỡng chất hiệu quả</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
