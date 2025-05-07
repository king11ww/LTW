<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once('../../../ket-noi-co-so-du-lieu.php');
    

    $ten_hang_sua = $_POST['ten_hang_sua'];
    $dia_chi = $_POST['dia_chi'];
    $dien_thoai = $_POST['dien_thoai'];
    $email = $_POST['email'];
    

    $sql = "INSERT INTO hangsua (ten_hang_sua, dia_chi, dien_thoai, email) 
            VALUES ('$ten_hang_sua', '$dia_chi', '$dien_thoai', '$email')";
    $check_sql = "SELECT * FROM hangsua WHERE ten_hang_sua = '$ten_hang_sua'";
    $result = $conn->query($check_sql);
    if($result->num_rows > 0) {
        $error_message = "Hãng sữa <strong>" . ($ten_hang_sua) . "</strong> đã tồn tại!";
    } 
    else {
        if ($conn->query($sql) === TRUE) {
            header("Location: ../thong-tin/thong-tin-hang-sua.php");
            exit();
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
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
    <title>Thêm Hãng Sữa</title>
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
        input[type="text"], input[type="email"], input[type="tel"], button {
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
    <h1 style="text-align: center;">Thêm Hãng Sữa</h1>
    <form action="" method="post">
        <label for="ten-hang-sua">Tên Hãng Sữa:</label>
        <input type="text" id="ten-hang-sua" name="ten_hang_sua" placeholder="Nhập tên hãng sữa" required>

        <label for="dia-chi">Địa Chỉ:</label>
        <input type="text" id="dia-chi" name="dia_chi" placeholder="Nhập địa chỉ" required>

        <label for="dien-thoai">Điện Thoại:</label>
        <input type="tel" id="dien-thoai" name="dien_thoai" placeholder="Nhập số điện thoại" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Nhập email" required>

        <button type="submit">Thêm Hãng Sữa</button>
        <?php
        if (isset($error_message)) {
            echo "<p style='color: red; text-align: center;'>$error_message</p>";
        }
        ?>
    </form>
</body>
</html>