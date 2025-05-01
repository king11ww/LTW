<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css-folder/admins.css">
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
    <div id="thong-tin-hang-sua">
        <table border="1">
            <h1>THÔNG TIN HÃNG SỮA</h1>
            <tr>
                <td>ID</td>
                <td>Tên khách hàng</td>
                <td>Giới tính</td>
                <td>Địa chỉ</td>
                <td>Số địa chỉ</td>
                <td>Email</td>
            </tr>
            <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td><a href="capnhat.php?khoa=<?php echo $row['id']; ?>">Cập nhật</a> </td>
                <td>
                    <a href="xoa.php?khoa=<?php echo $row['id']; ?>" onclick = "confirm('Bạn có chắc chắn muốn xóa hay không')">Xóa</a> 
                </td>
            </tr>
        </table>
        <button><a href="them-hang-sua.php">Thêm</a></button>
    </div>
</body>
</html>