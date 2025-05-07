<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thông Tin Sản Phẩm</title>
  <link rel="stylesheet" href="../../css-folder/them-thanh-cong.css">
</head>
<body>
  
  <div class="container">
    <div class="main-them-sua">
    <div class="them-sua">Thêm sữa thành công !</div>
    <div class="product-box">
      <a href="../thong-tin/thong-tin-sua.php" class="close-button">×</a>
      <div class="product-image">
        <img src="../../../Giao-dien/baitaplon/img/<?php echo $_GET['hinh_anh']?>" alt="GrowPLUS+">
      </div>

      <div class="product-info">
        <h2 class="product-title"><?php echo $_GET['ten_sua']?></h2>

        <div class="nutrition">
          <p>Nhà sản xuất : <?php echo $_GET['nhan_hang']?></p>
          <p>Nhà sản xuất : <?php echo $_GET['don_gia']?></p>
          <div class="section-title">Thành phần dinh dưỡng:</div>
          
          <p><?php echo $_GET['thanh_phan']?>.</p>
        </div>

        <div class="benefits">
          <div class="section-title">Lợi ích sản phẩm:</div>
          <p><?php echo $_GET['loi_ich']?></p>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>
</html>
