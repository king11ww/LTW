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
</head>
<body>
  <div class="container">
    <div class="product-box">
      <div class="product-image">
        <img src="../img/<?php echo $_GET['image']?>" alt="ảnh">
      </div>
      <div class="product-info">
        <h2 class="product-title"><?php echo $_GET['ten']?></h2>

        <div class="nutrition">
          <p>Nhà sản xuất : <?php echo $_GET['nhanhang']?></p>
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
</body>
</html>