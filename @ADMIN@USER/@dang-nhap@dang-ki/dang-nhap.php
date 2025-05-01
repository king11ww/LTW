<?php
    session_start();
    require_once('../../ket-noi-co-so-du-lieu.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $tenDangNhap = $_POST['ten-dang-nhap'];
        $matKhau = $_POST['mat-khau'];

        $sql = "SELECT * FROM khachhang WHERE ten_dang_nhap='$tenDangNhap' AND mat_khau='$matKhau'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);
            if($row['loai_tai_khoan'] == 'ADMIN')
            {
                
                header('Location: ../admin-folder/trang-admin.php');
            }
            else
            {
                $_SESSION['id'] = $row['id'];
                $_SESSION['ten_dang_nhap'] = $tenDangNhap;  
                $_SESSION['ho_ten'] = $row['ho_ten'];    
                $_SESSION['gioi_tinh'] = $row['gioi_tinh'];
                $_SESSION['dia_chi'] = $row['dia_chi'];
                $_SESSION['so_dien_thoai'] = $row['so_dien_thoai'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['mat_khau'] = $row['mat_khau'];
                $_SESSION['loai_tai_khoan'] = $row['loai_tai_khoan'];
                header('Location: ../../Giao-dien/baitaplon/php/batdau.php');
            }
            exit();
        } 
        else 
        {
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-folder/mac-dinh.css">
    <title>Đăng nhập</title>
</head>
<body>
    <div>
        <form method="post">
            <h2>Đăng nhập</h2>
            <label for="ten-dang-nhap">Tên đăng nhập</label>
            <input type="text" name="ten-dang-nhap" id="ten-dang-nhap" required><br>
            <label for="mat-khau">Mật khẩu</label>
            <input type="password" name="mat-khau" id="mat-khau" required><br>
            <input type="submit" value="Đăng nhập">
        </form>
        <div>Chưa có tài khoản -> <a href="dang-ki.php">Đăng kí</a></div>
    </div>
</body>
</html>