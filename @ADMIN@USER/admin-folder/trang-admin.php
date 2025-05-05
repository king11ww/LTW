<?php
    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_start();
        session_destroy();
        header("Location: ../../Giao-dien/baitaplon/php/batdau.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css-folder/admins.css">
    <title>ADMIN</title>
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="">
            <i class="fa-solid fa-glass-water"></i>
            <span>Milk</span>
            <div class="space"><h6>Admin space</h6></div>  
            </a>
        </div>
        <div class="menu">
            <div class="chose">
                <a href="../../Giao-dien/baitaplon/php/batdau.php">Trang Chủ</a>
            </div>
            <div class="chose">
                <a href="thong-tin/thong-tin-khach-hang.php">Thông tin khách hàng</a>
            </div>
            <div class="chose">
                <a href="thong-tin/thong-tin-hang-sua.php">Thông tin hãng sữa</a>
            </div>
            <div class="chose">
                <a href="thong-tin/thong-tin-sua.php">Thông tin sữa</a>
            </div>
            <div class="chose">
                <a href="thong-tin/thong-tin-gio-hang.php">đơn hàng</a>
            </div>
            <div class="chose">
                <a href="?action=logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');" class="logout">Đăng xuất</a>
            </div>
        </div>
    </div>
    <p style="text-align:center; font-size:200px;">ADMIN</p>
</body>
</html>