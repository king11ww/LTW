<?php
    require_once('../../../ket-noi-co-so-du-lieu.php');
    $sql = "SELECT * FROM khachhang";
    $result = mysqli_query($conn, $sql);

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_start();
        session_destroy();
        header("Location: ../../../Giao-dien/baitaplon/php/batdau.php");
        exit();
    }

    // Xóa khách hàng
    if (isset($_GET['action']) && $_GET['action'] == 'xoa') {
        require_once('../../../ket-noi-co-so-du-lieu.php');
        $id = $_GET['id'];
        $sql_delete = "DELETE FROM khachhang WHERE id = $id";
        mysqli_query($conn, $sql_delete);
        header("Location: thong-tin-khach-hang.php");
        mysqli_close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css-folder/admins.css">
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
                <a href="../../../Giao-dien/baitaplon/php/batdau.php">Trang Chủ</a>
            </div>
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
            <a href="?action=logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');" class="logout">Đăng xuất</a>
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
                if($row['loai_tai_khoan'] != 'USER') continue;
            ?>    
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['ho_ten'] ?></td>
                <td><?= $row['gioi_tinh'] ?></td>
                <td><?= $row['dia_chi'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="cap-nhat-thong-tin-khach-hang.php?id=<?= $row['id'] ?>&ho_ten=<?= $row['ho_ten'] ?>&gioi_tinh=<?= $row['gioi_tinh'] ?>&dia_chi=<?= $row['dia_chi']?>&email=<?= $row['email'] ?>">Cập nhật</a> | 
                    <a href="?action=xoa&id=<?= $row['id']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
