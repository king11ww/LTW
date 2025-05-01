<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kết nối cơ sở dữ liệu
    require_once '../../ket-noi-co-so-du-lieu.php';

    // Lấy dữ liệu từ form
    $ma_sua = $_POST['ma_sua'];
    $ten_sua = $_POST['ten_sua'];
    $hang_sua = $_POST['hang_sua'];
    $loai_sua = $_POST['loai_sua'];
    $trong_luong = $_POST['trong_luong'];
    $don_gia = $_POST['don_gia'];
    $mo_ta = $_POST['mo_ta'];
    $hinh_anh = $_FILES['hinh_anh']['name'];

    // Xử lý upload hình ảnh
    $target_dir = "../../Giao-dien/baitaplon/img/"; // Thư mục lưu ảnh
    $target_file = $target_dir . basename($_FILES["hinh_anh"]["name"]);

    // Kiểm tra và di chuyển file ảnh
    if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file)) {
        // Thêm dữ liệu vào bảng
        $sql = "INSERT INTO sua (ma_sua, ten_sua, hang_sua, loai_sua, trong_luong, don_gia, mo_ta, hinh_anh) 
                VALUES ('$ma_sua', '$ten_sua', '$hang_sua', '$loai_sua', '$trong_luong', '$don_gia', '$mo_ta', '$hinh_anh')";

        if ($conn->query($sql) === TRUE) {
            // Chuyển hướng về trang admin
            header("Location: trang-admin.php");
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
    <form action="" method="post">
        <label for="ma-sua">Mã Sữa:</label>
        <input type="text" id="ma-sua" name="ma_sua" placeholder="Nhập mã sữa" required>

        <label for="ten-sua">Tên Sữa:</label>
        <input type="text" id="ten-sua" name="ten_sua" placeholder="Nhập tên sữa" required>

        <label for="hang-sua">Hãng Sữa:</label>
        <select id="hang-sua" name="hang_sua" required>
            <option value="">-- Chọn hãng sữa --</option>
            <option value="Vinamilk">Vinamilk</option>
            <option value="TH True Milk">TH True Milk</option>
            <option value="Nutifood">Nutifood</option>
        </select>

        <label for="loai-sua">Loại Sữa:</label>
        <select id="loai-sua" name="loai_sua" required>
            <option value="">-- Chọn loại sữa --</option>
            <option value="Sữa bột">Sữa bột</option>
            <option value="Sữa tươi">Sữa tươi</option>
            <option value="Sữa đặc">Sữa đặc</option>
        </select>

        <label for="trong-luong">Trọng Lượng (gram):</label>
        <input type="number" id="trong-luong" name="trong_luong" placeholder="Nhập trọng lượng" required>

        <label for="don-gia">Đơn Giá (VNĐ):</label>
        <input type="number" id="don-gia" name="don_gia" placeholder="Nhập đơn giá" required>

        <label for="mo-ta">Mô Tả:</label>
        <textarea id="mo-ta" name="mo_ta" rows="4" placeholder="Nhập mô tả" required></textarea>

        <label for="hinh-anh">Hình Ảnh:</label>
        <input type="file" id="hinh-anh" name="hinh_anh" accept="image/*" required>

        <button type="submit">Thêm Sữa</button>
    </form>
</body>
</html>