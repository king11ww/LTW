
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
            $ten_hang_sua = $_GET['ten_hang_sua'];
            $dia_chi = $_GET['dia_chi'];
            $dien_thoai = $_GET['dien_thoai'];
            $email = $_GET['email'];
            require_once('../../../ket-noi-co-so-du-lieu.php');
                $sql = "update hangsua set ten_hang_sua = '$ten_hang_sua', dia_chi = '$dia_chi', dien_thoai = '$dien_thoai', email = '$email' where id = '$id'";
                mysqli_query($conn, $sql);
                mysqli_close($conn);
                header("Location: ../thong-tin/thong-tin-hang-sua.php");
        }
        if(isset($_GET['huy']))
        {
            header("Location: ../thong-tin/thong-tin-hang-sua.php");
        }
    ?>
    <form method="get">
        <label for="id">ID</label>
        <input type="text" name="id" id="id" value="<?php echo $_GET['id']?>" readonly>
        <label for="ten_hang_sua">Tên Hãng Sữa</label>
        <input type="text" name="ten_hang_sua" id="ten_hang_sua" value="<?php echo $_GET['ten_hang_sua']?>">
        <label for="dia_chi">Địa chỉ</label>
        <input type="text" name="dia_chi" id="dia_chi" value="<?php echo $_GET['dia_chi']?>">
        <label for="dien_thoai">Điện thoại</label>
        <input type="text" name="dien_thoai" id="dien_thoai" value="<?php echo $_GET['dien_thoai']?>">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $_GET['email']?>">
        <input type="submit" name="cap-nhat" value="Cập nhật" onclick="return xacNhanCapNhat()">
        <input type="submit" name ="huy" value="hủy">
    </form>
 </body>
 <script>
    function xacNhanCapNhat() {
        let id = document.getElementById("id").value;
        let ten_hang_sua = document.getElementById("ten_hang_sua").value;
        let dia_chi = document.getElementById("dia_chi").value;
        let email = document.getElementById("email").value;

        return confirm(
            "Thông tin Hãng sữa sau cập nhật sẽ là:\n" +
            "ID: " + id + "\n" +
            "Tên Hãng: " + ten_hang_sua + "\n" +
            "Địa chỉ: " + dia_chi + "\n" +
            "Email: " + email
        );
    }
</script>
 </html>