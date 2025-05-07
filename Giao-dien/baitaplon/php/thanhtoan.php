<?php
    session_start();

    // Kiểm tra nếu người dùng chưa đăng nhập
    if (!isset($_SESSION['ten_dang_nhap'])) {
        header('Location: batdau.php'); // Chuyển hướng về trang bắt đầu nếu chưa đăng nhập
        exit();
    }

    // Xử lý khi người dùng nhấn nút "Xác nhận"
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $phuongThucThanhToan = $_POST['phuong-thuc-thanh-toan'];

        // Lưu thông tin thanh toán vào session
        $_SESSION['phuong_thuc_thanh_toan'] = $phuongThucThanhToan;

        // Chuyển hướng đến trang hoàn tất thanh toán
        header('Location: hoantat-thanh-toan.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-folder/mac-dinh.css">
    <title>Thanh toán</title>
</head>
<body>
    <div class="container">
        <h2>Thanh toán</h2>
        <form method="post">
            <div>
                <h3>Chọn phương thức thanh toán:</h3>
                <label>
                    <input type="radio" name="phuong-thuc-thanh-toan" value="chuyen-khoan" required>
                    Chuyển khoản ngân hàng
                </label><br>
                <label>
                    <input type="radio" name="phuong-thuc-thanh-toan" value="thanh-toan-khi-nhan-hang" required>
                    Thanh toán khi nhận hàng
                </label>
            </div>
            <br>
            <button type="submit">Xác nhận</button>
        </form>
        <br>
        <a href="batdau.php">Quay lại trang chủ</a>
    </div>
</body>
</html>