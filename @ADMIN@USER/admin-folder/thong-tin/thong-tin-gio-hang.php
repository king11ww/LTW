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
        $sql_delete = "DELETE FROM dohang WHERE id = $id";
        mysqli_query($conn, $sql_delete);
        header("Location: thong-tin-gio-hang.php");
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
                <a href="thong-tin-hang-sua.php">Thông tin hãng sữa</a>
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
                <td>Tên đăng nhập</td>
                <td>Tên khách hàng</td>
                <td>số lượng</td>
                <td>tên sản phẩm</td>
                <td>giá</td>
            </tr>
            <?php
            require_once('../../../ket-noi-co-so-du-lieu.php');
            $sql = "select * from dohang";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['ten_dang_nhap'] ?></td>
                <td><?php echo $row['ho_ten'] ?></td>
                <td><?php echo $row['soluong'] ?></td>
                <td><?php echo $row['ten_san_pham'] ?></td>
                <td><?php echo $row['gia'] ?></td>
                <td><a href="capnhat.php?khoa=<?php echo $row['id']; ?>">Cập nhật</a> </td>
				<td>
					<a href="xoa.php?khoa=<?php echo $row['id']; ?>" 
                    onclick = "confirm('Bạn có chắc chắn muốn xóa hay không')">Xóa</a> 
				</td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>