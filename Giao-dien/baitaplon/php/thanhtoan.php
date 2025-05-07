<?php
    session_start();

    if (!isset($_SESSION['ten_dang_nhap'])) {
        header('Location: batdau.php'); 
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once('../../../ket-noi-co-so-du-lieu.php');
        $phuongThucThanhToan = ($_POST['phuong-thuc-thanh-toan'] == 'chuyen-khoan') ? 'Chuyển khoản' : 'Thanh toán khi nhận hàng';
        $ten_dang_nhap = $_SESSION['ten_dang_nhap'];
        echo $phuongThucThanhToan;
        if($phuongThucThanhToan == 'Chuyển khoản') {
            header('Location: chuyen-khoan.php?totalmoney='.$_GET['totalmoney']);
            exit();
        } else {
            $_SESSION['phuong-thuc-thanh-toan'] = "tao-thanh-cong";
            $sql = "update dohang set xacnhan = 'đã xác nhận' where ten_dang_nhap = '$_SESSION[ten_dang_nhap]' and xacnhan = 'Chưa xác nhận'";
            mysqli_query($conn, $sql);
        }
        mysqli_close($conn);
        header('Location: llichsudathang.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/thanhtoan.css">
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