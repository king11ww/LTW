<?php
    require_once('../../../ket-noi-co-so-du-lieu.php');
    $sql = "SELECT * FROM hangsua";
    $result = mysqli_query($conn, $sql);
    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_start();
        session_destroy();
        header("Location: ../../../Giao-dien/baitaplon/php/batdau.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css-folder/admins.css">
    <style>
        
    </style>
    <title>Thông tin hãng sữa</title>
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
                <a href="../../../Giao-dien/baitaplon/php/batdau.php">Trang Chủ</a>
            </div>
            <div class="chose">
                <a href="thong-tin-khach-hang.php">Thông tin khách hàng</a>
            </div>
            <div class="chose">
                <a href="thong-tin-hang-sua.php">hãng sữa</a>
            </div>
            <div class="chose">
                <a href="thong-tin-sua.php">Thông tin sữa</a>
            </div>
            <div class="chose">
                <a href="thong-tin-gio-hang.php">đơn hàng</a>
            </div>
            <div class="chose">
            <a href="?action=logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');" class="logout">Đăng xuất</a>
            </div>
        </div>
    </div>
    <div id="thong-tin-hang-sua">
        <table border="1">
            <h1>THÔNG TIN HÃNG SỮA</h1>
            <tr>
                <td>ID</td>
                <td>Tên hãng sữa</td>
                <td>Địa chỉ</td>
                <td>Điện thoại</td>
                <td>Email</td>
                <td colspan = "2">Thao tác</td>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result)) 
                {   
            ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['ten_hang_sua']?></td>
                <td><?php echo $row['dia_chi']?></td>
                <td><?php echo $row['dien_thoai']?></td>
                <td><?php echo $row['email']?></td>
                <td><a href="../cap-nhat-thong-tin/cap-nhat-thong-tin-hang-sua.php?id=<?php echo $row['id'];?>&ten_hang_sua=<?php echo $row['ten_hang_sua']?>&dia_chi=<?php echo $row['dia_chi']?>&dien_thoai=<?php echo $row['dien_thoai']?>&email=<?php echo $row['email']?>">Cập nhật</a></td>
                <td>
                    <a href="xoa.php?khoa=<?php echo $row['id']; ?>" onclick = "confirm('Bạn có chắc chắn muốn xóa hay không')">Xóa</a> 
                </td>
            </tr>
            <?php }?>
        </table>
        <button><a href="../them/them-hang-sua.php">Thêm</a></button>
    </div>
</body>
</html>