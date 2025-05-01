<?php
    require_once('../../ket-noi-co-so-du-lieu.php');
    $sql = "SELECT * FROM khachhang";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css-folder/admins.css">
    <title>Thông tin khách hàng</title>
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="">
            <i class="fa-solid fa-glass-water"></i>
            <span>Milk</span>
            <div class="space"><h6>Admin workspace</h6></div>  
            </a>
        </div>
        <div class="menu">
            <div class="chose">
                <a href="thong-tin-khach-hang.php">Thông tin khách hàng</a>
            </div>
            <div class="chose">
                <a href="thong-tin-hang-sua.php">Thông tin hãng sữa</a>
            </div>
            <div class="chose">
                <a href="thong-tin-sua.php">Thông tin sữa</a>
            </div>
            <div class="chose">
                <a href="thong-tin-sua.php">Thông tin đơn hàng</a>
            </div>
            <div class="chose">
                <a href="dang-xuat.php">Đăng xuất</a>
            </div>
        </div>
    </div>
    <div id="thong-tin-khach-hang">
        <h1>THÔNG TIN KHÁCH HÀNG</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Giới tính</th>
                <th>Địa chỉ</th>
                <th>Email</th>
                <th>Thao tác</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { 
                if($row['ten_dang_nhap'] == 'admin')
                {
                    continue;
                }
            ?>    
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['ho_ten'] ?></td>
                <td><?= $row['gioi_tinh'] ?></td>
                <td><?= $row['dia_chi'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="capnhat.php?khoa=<?= $row['id'] ?>">Cập nhật</a> | 
                    <a href="xoa.php?khoa=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
