
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        form {
            width: 400px;
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
        input[type="text"], button {
            width: 100%;
            height:50px;
            padding: auto;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size:24px;
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
    <title>Cập nhật</title>
 </head>
 <body>
    <?php

        if(isset($_GET['cap-nhat']))
        {   $id = $_GET['id'];
            $name = $_GET['ten-khach-hang'];
            $gioi_tinh = $_GET['gioi-tinh'];
            $dia_chi = $_GET['dia-chi'];
            $email = $_GET['email'];
            require_once('../../../ket-noi-co-so-du-lieu.php');
                $sql = "update khachhang set ho_ten = '$name', gioi_tinh = '$gioi_tinh', dia_chi = '$dia_chi', email = '$email' where id = '$id'";
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                header("Location: ../thong-tin/thong-tin-khach-hang.php");
        }
        if(isset($_GET['huy']))
        {
            header("Location: ../thong-tin/thong-tin-khach-hang.php");
        }
    ?>
    <form method="get">
        <label for="id">ID</label>
        <input type="text" name="id" id="id" value="<?php echo $_GET['id']?>" readonly>
        <label for="ten-khach-hang">Tên Khách hàng</label>
        <input type="text" name="ten-khach-hang" id="ten-khach-hang" value="<?php echo $_GET['ho_ten']?>">
        <label for="gioi-tinh">Giới Tính</label>
        <input type="text" name="gioi-tinh" id="gioi-tinh" value="<?php echo $_GET['gioi_tinh']?>">
        <label for="dia-chi">Địa chỉ</label>
        <input type="text" name="dia-chi" id="dia-chi" value="<?php echo $_GET['dia_chi']?>">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $_GET['email']?>">
        <input type="submit" name="cap-nhat" value="Cập nhật" onclick="return xacNhanCapNhat()">
        <input type="submit" name ="huy" value="hủy">
    </form>
 </body>
 <script>
    function xacNhanCapNhat() {
        let id = document.getElementById("id").value;
        let ten = document.getElementById("ten-khach-hang").value;
        let gioiTinh = document.getElementById("gioi-tinh").value;
        let diaChi = document.getElementById("dia-chi").value;
        let email = document.getElementById("email").value;

        return confirm(
            "Thông tin khách hàng sau cập nhật sẽ là:\n" +
            "ID: " + id + "\n" +
            "Tên khách hàng: " + ten + "\n" +
            "Giới tính: " + gioiTinh + "\n" +
            "Địa chỉ: " + diaChi + "\n" +
            "Email: " + email
        );
    }
</script>
 </html>