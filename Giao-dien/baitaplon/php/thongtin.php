<?php
  if (isset($_GET['id'])):
    require_once('../../../ket-noi-co-so-du-lieu.php');
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM sanpham WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $_GET['ten'] = $row['ten'];
    $_GET['nhanhang'] = $row['nhanhang'];
    $_GET['thanhphan'] = $row['thanhphan'];
    $_GET['loinhuan'] = $row['loinhuan'];
    $_GET['image'] = $row['image'];
    $_GET['giaban'] = $row['giaban'];
  endif;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi tiết sản phẩm</title>
  <link rel="stylesheet" href="../css/thongtin.css">
  <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
  <script>
    function goBack() {
      if (document.referrer) {
        history.back();
      } else {
        window.location.href = 'shop.php';
      }
    }
  </script>
  </head>
<body>
  <div class="detail-container">
    <div class="detail-header">
      <button class="btn btn-secondary" onclick="goBack()">
        <i class="fa-solid fa-arrow-left"></i> Quay lại
      </button>
      <div class="breadcrumbs">
        <span>Trang chủ</span>
        <i class="fa-solid fa-angle-right"></i>
        <span>Sản phẩm</span>
        <i class="fa-solid fa-angle-right"></i>
        <span class="current"><?php echo $_GET['ten'] ?></span>
      </div>
    </div>

    <div class="detail-content">
      <div class="image-side">
        <div class="image-frame">
          <img src="../img/<?php echo $_GET['image']?>" alt="<?php echo $_GET['ten']?>" />
        </div>
      </div>

      <div class="info-side">
        <div class="title-row">
          <h1 class="title"><?php echo $_GET['ten']?></h1>
          <span class="brand-badge"><i class="fa-solid fa-building"></i> <?php echo $_GET['nhanhang']?></span>
        </div>
        <div class="price-row">
          <span class="price"><?php echo number_format((int)$_GET['giaban'], 0, ',', '.') ?> VNĐ</span>
        </div>

        <div class="cards">
          <div class="info-card">
            <div class="card-header">
              <i class="fa-solid fa-seedling"></i>
              <h3>Thành phần dinh dưỡng</h3>
            </div>
            <div class="card-body">
              <p><?php echo $_GET['thanhphan']?></p>
            </div>
          </div>

          <div class="info-card">
            <div class="card-header">
              <i class="fa-solid fa-heart"></i>
              <h3>Lợi ích sản phẩm</h3>
            </div>
            <div class="card-body">
              <p><?php echo $_GET['loinhuan']?></p>
            </div>
          </div>
        </div>

        <div class="actions">
          <button class="btn btn-primary" onclick="goBack()">
            <i class="fa-solid fa-cart-shopping"></i> Quay về cửa hàng
          </button>
          <a class="btn btn-light" href="javascript:window.close()">
            <i class="fa-solid fa-xmark"></i> Đóng
          </a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>