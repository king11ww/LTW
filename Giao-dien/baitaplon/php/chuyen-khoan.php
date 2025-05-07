<?php
    session_start();
    require_once('../../../ket-noi-co-so-du-lieu.php');
    if (!isset($_SESSION['ten_dang_nhap'])) {
        header('Location: batdau.php'); // Chuyển hướng về trang bắt đầu nếu chưa đăng nhập
        exit();
    }
    $sql = "update dohang set xacnhan = 'Đã xác nhận' where ten_dang_nhap = '$_SESSION[ten_dang_nhap]' and xacnhan = 'Chưa xác nhận'";
    mysqli_query($conn, $sql);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="container" style="display: grid;">
        <div>
            <h1>Quét mã QR để thanh toán</h1>
        </div>
        <div id="momo-mark" class="mx-auto pt-3"></div>

        <div class="qrcode_scan_container">
            <div class="qrcode_scan">
                <div class="qrcode_gradient">
                    <img alt="" src="./assets/qrcode-gradient-ecfeda44ae2870718219b2046c4abe3e.png" loading="lazy" class="jsx-d22f6bd0771ae323 img-fluid">
                </div>
                <div class="qrcode_border">
                    <img alt="" src="./assets/border-qrcode-deab3eb55f9ef6d6a8d6d1b5b194b36c.svg" class="jsx-d22f6bd0771ae323 img-fluid">
                </div>
                <div class="qrcode_image">
                    <img alt="paymentcode" class="image-qr-code" src="https://api.vietqr.io/970416/42617657/50000/HD1990/vietqr_net_2.jpg">
                </div>
            </div>
        </div>
        <div>
            <h2>Thông tin thanh toán</h2>
            <p>Tên tài khoản: <strong>Hồ Nguyên Khởi</strong></p>
            <p>Số tiền: <strong><?php echo $_GET['totalmoney']?> Vnd</strong></p>
            <p>Nội dung: <strong>Thanh toán đơn hàng #12345</strong></p>
        </div>
    </div>
</body>
</html>