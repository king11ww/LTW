<?php
    session_start();
    if(isset($_GET['action']) && $_GET['action'] == 'logout')
    {
        session_destroy();
        header("Location: batdau.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profile Form</title>
  <link rel="stylesheet" href="../css/user.css">
  <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
  <div class="header">
            <div class="logo">
                <a href="batdau.php">
                <i class="fa-solid fa-glass-water"></i>
                <span>Milk</span>   
                </a>
            </div>
            <div class="menu">
                <div class="chose">
                    <a href="batdau.php">Home</a>
                </div>
                <div class="chose">
                    <a href="sanpham.php">Sản Phẩm</a>
                </div>
                <div class="chose">
                    <a href="batdau.php">Thông tin</a>
                </div>
                <div class="chose">
                    <a href="batdau.php">Liên hệ</a>
                </div>
            </div>
            <?php if(isset($_SESSION['ten_dang_nhap'])): ?>
            <div class="user">
                <?php if($_SESSION['loai_tai_khoan'] == 'ADMIN'):?>
                    |ADMIN|: <?php echo $_SESSION['ho_ten'] ?>
                    <a href="../../../@ADMIN@USER/admin-folder/trang-admin.php">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <?php else:?>
                    <a href="user.php">
                        <i class="fa-solid fa-user"></i>
                    </a>
                <?php endif?>  
            </div>
            <div class="shopcart">
                <a href="shop.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <?php
                        require_once("../../../ket-noi-co-so-du-lieu.php");
                        $sql_so_luong_don_hang = "select * from dohang where ten_dang_nhap = '$_SESSION[ten_dang_nhap]'";  
                        $so_luong_don_hang =  mysqli_num_rows(mysqli_query($conn, $sql_so_luong_don_hang));
                    ?>
                    <?php
                        if($so_luong_don_hang > 0){
                    ?>
                    <div class="shopcart_value"><?php echo $so_luong_don_hang ?></div>
                    <?php } ?>
                </a>
            </div>
            <?php endif; ?>

        </div>
  <div class="profile-card">
    <div class="profile-header">
      <img src="https://e7.pngegg.com/pngimages/358/473/png-clipart-computer-icons-user-profile-person-child-heroes.png" alt="Avatar" class="avatar">
      <div class="user-info">
        <h2><?php echo $_SESSION['ten_dang_nhap'] ?></h2>
        <p><?php echo $_SESSION['email'] ?></p>
      </div>
      <button class="settings-btn"><a href="?action=logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');" class="logout">Đăng xuất</a></button>
    </div>

    <form class="profile-form">
      <label>Full Name</label>
      <input type="text" value="<?php echo $_SESSION['ho_ten'] ?>">

      <label>Email</label>
      <input type="email" value="<?php echo $_SESSION['email'] ?>" >
      <small>Email cannot be changed</small>

      <label>Phone</label>
      <input type="text" value="<?php echo $_SESSION['so_dien_thoai'] ?>">

      <label>Address</label>
      <input type="text" value="<?php echo $_SESSION['dia_chi'] ?>">

      <div class="button-group">
        <button type="submit" class="save">Save Changes</button>
        <button type="button" class="cancel">Cancel</button>
      </div>
    </form>
  </div>
  <div class="footer">
    <div class="footer_content">
        <div class="footer_menu">
            <div class="footer_menu_st">
                <h1><i class="fa-solid fa-glass-water"></i> MILK</h1>
                <span>Các sản phẩm từ sữa cao cấp được giao tươi đến tận nhà bạn mỗi ngày.</span>
            </div>
            <div class="footer_menu_st">
                <h2>Qick Links</h2>
                <span><a href="#">Home</a></span>
                <span><a href="#">Sản phẩm</a></span>
                <span><a href="#">Thông tin</a></span>
                <span><a href="#">Liên hệ</a></span>
            </div>
            <div class="footer_menu_st">
                <h2>Các nhãn hàng</h2>
                <span><a href="#">Vinamilk</a></span>
                <span><a href="#">TH true MILK</a></span>
                <span><a href="#">Nutifood</a></span>
                <span><a href="#">Dutch Lady</a></span>
            </div>
            <div class="footer_menu_st">
                <h2>Hãy là một thành viên của chúng tôi!</h2>
                <span><a href="#">tham gia Tuyển dụng ngay</a></span>
            </div>
        </div>
        <div class="footer_end">
            <hr>
            <h6>© 2025 Milk. All rights reserved.</h6>
        </div>
    </div>
</div>
</div>
</body>
</html>
