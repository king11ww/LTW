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
            <a href="batdau.php">Sản Phẩm</a>
        </div>
        <div class="chose">
            <a href="batdau.php">Thông tin</a>
        </div>
        <div class="chose">
            <a href="batdau.php">Liên hệ</a>
        </div>
    </div>
    <div class="user">
        <a href="#">
            <i class="fa-solid fa-user"></i>
        </a>
    </div>
    <div class="shopcart">
        <a href="../ShoppingCart/shop.html">
            <i class="fa-solid fa-cart-shopping"></i>
            <div class="shopcart_value">1</div>
        </a>
    </div>
</div>
  <div class="profile-card">
    <div class="profile-header">
      <img src="https://e7.pngegg.com/pngimages/358/473/png-clipart-computer-icons-user-profile-person-child-heroes.png" alt="Avatar" class="avatar">
      <div class="user-info">
        <h2>John Doe</h2>
        <p>john.doe@example.com</p>
      </div>
      <button class="settings-btn">⚙</button>
    </div>

    <form class="profile-form">
      <label>Full Name</label>
      <input type="text" value="John Doe">

      <label>Email</label>
      <input type="email" value="john.doe@example.com" >
      <small>Email cannot be changed</small>

      <label>Phone</label>
      <input type="text" value="+84 123 456 789">

      <label>Address</label>
      <input type="text" value="123 Nguyen Hue, District 1, Ho Chi Minh City">

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
