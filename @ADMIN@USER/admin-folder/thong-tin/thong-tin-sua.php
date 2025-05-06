<?php
    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_start();
        session_destroy();
        header("Location: ../../../Giao-dien/baitaplon/php/batdau.php");
        exit();
    }

    if (isset($_GET['action']) && $_GET['action'] == 'xoa') {
        require_once('../../../ket-noi-co-so-du-lieu.php');
        $id = $_GET['id'];
        $sql_delete = "DELETE FROM sanpham WHERE id = $id";
        mysqli_query($conn, $sql_delete);
        header("Location: thong-tin-sua.php");
        mysqli_close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css-folder/admins.css">
    <title>Thông tin sữa</title>
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
                <a href="thong-tin-hang-sua.php">Hãng sữa</a>
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
    <div id="thong-tin-sua" >
        <table border="1">
            <h1>THÔNG TIN SỮA</h1>
            <tr>
                <td>ID</td>
                <td>Tên sản phẩm</td>
                <td>nhãn hàng</td>
                <td>Giá bán</td>
                <td>tên file ảnh</td>
            </tr>
            <?php
            require_once('../../../ket-noi-co-so-du-lieu.php');
            $sql = "select * from sanpham";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['ten'] ?></td>
                <td><?php echo $row['nhanhang'] ?></td>
                <td><?php echo $row['giaban'] ?></td>
                <td><?php echo $row['image'] ?></td>
                <td><a href="../cap-nhat-thong-tin/cap-nhat-sua.php?id=<?php echo $row['id'];?>&ten=<?php echo $row['ten'];?>&nhanhang=<?php echo $row['nhanhang'];?>&giaban=<?php echo $row['giaban']?>&image=<?php echo $row['image']?>">Cập nhật</a> </td>
				<td>
                    <a href="thong-tin-sua.php?action=xoa&id=<?php echo $row['id']; ?>" 
                    onclick="return confirm('Bạn có chắc chắn muốn xóa hay không?')">Xóa</a>
				</td>
            </tr>
            <?php } ?>
        </table>
        <div class="add">
            <a href="../them/them-sua.php" class="btn-add">Thêm</a>
        </div>
    </div>
</body>
</html>