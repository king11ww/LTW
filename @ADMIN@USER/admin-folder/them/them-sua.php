<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kết nối cơ sở dữ liệu
    require_once '../../../ket-noi-co-so-du-lieu.php';

    // Lấy dữ liệu từ form;
    $ten_sua = $_POST['ten_sua'];
    $nhan_hang = $_POST['nhan-hang'];
    $don_gia = $_POST['don_gia'];
    // $mo_ta = $_POST['mo_ta'];
    $hinh_anh = $_FILES['hinh_anh']['name'];
    $thanh_phan = $_POST['thanh-phan'];
    $loi_ich = $_POST['loi-ich'];

    // Xử lý upload hình ảnh
    $target_dir = "../../../Giao-dien/baitaplon/img/"; // Thư mục lưu ảnh
    $target_file = $target_dir . basename($_FILES["hinh_anh"]["name"]);

    // Kiểm tra và di chuyển file ảnh
    if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file)) {
        // Thêm dữ liệu vào bảng
        $sql = "INSERT INTO sanpham (ten, nhanhang, giaban, `image`, thanhphan, loinhuan) 
                VALUES ('$ten_sua', '$nhan_hang', '$don_gia', '$hinh_anh', '$thanh_phan', '$loi_ich')";

        if ($conn->query($sql) === TRUE) {
            // Chuyển hướng về trang admin
            header("Location: them-thanh-cong.php?ten_sua=$ten_sua&nhan_hang=$nhan_hang&don_gia=$don_gia&hinh_anh=$hinh_anh&thanh_phan=$thanh_phan&loi_ich=$loi_ich");
            exit();
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Lỗi khi tải lên hình ảnh.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-folder/mac-dinh.css">
    <title>Thêm Sữa</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], textarea, select, input[type="file"], button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Thêm Sữa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="ten-sua">Tên Sữa:</label>
        <input type="text" id="ten-sua" name="ten_sua" placeholder="Nhập tên sữa" required>

        <label for="nhan-hang">Nhãn hàng:</label>
        <select id="nhan-hang" name="nhan-hang" required>
            <option value="">-- Chọn hãng hàng --</option>
            <option value="Vinamilk">Vinamilk</option>
            <option value="TH True Milk">TH True Milk</option>
            <option value="Nutifood">Nutifood</option>
        </select>

        <label for="don-gia">Đơn Giá (VNĐ):</label>
        <input type="number" id="don-gia" name="don_gia" placeholder="Nhập đơn giá" required>

        <!-- <label for="mo-ta">Mô Tả:</label>
        <textarea id="mo-ta" name="mo_ta" rows="4" placeholder="Nhập mô tả" required></textarea> -->

        <label for="hinh-anh">Hình Ảnh:</label>
        <input type="file" id="hinh-anh" name="hinh_anh" accept="image/*" required>
        <label for="thanh-phan">thành phần:</label>
        <input type="text" id="thanh-phan" name="thanh-phan" placeholder="Nhập thành phần" required>
        <label for="loi-ich">lợi ích:</label>
        <input type="text" id="loi-ich" name="loi-ich" placeholder="Nhập lợi ích" required>

        <button type="submit">Thêm Sữa</button>
    
        <button type="button"><a href="../thong-tin/thong-tin-sua.php" style="text-decoration:none; color: white; width:100%;">Hủy</a></button>
    </form>
</body>
</html>