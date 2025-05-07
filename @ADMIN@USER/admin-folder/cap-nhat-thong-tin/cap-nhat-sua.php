
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        form {
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
            $ten = $_GET['ten'];
            $nhanhang = $_GET['nhanhang'];
            $giaban = $_GET['giaban'];
            require_once('../../../ket-noi-co-so-du-lieu.php');
            $sql = "update sanpham set ten = '$ten', nhanhang = '$nhanhang', giaban = '$giaban' where id = '$id'";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            header("Location: ../thong-tin/thong-tin-sua.php");
        }
        if(isset($_GET['huy']))
        {
            header("Location: ../thong-tin/thong-tin-sua.php");
        }
    ?>
    
    <form method="get" >
        <label for="id">ID</label>
        <input type="text" name="id" id="id" value="<?php echo $_GET['id']?>" readonly>
        <label for="ten">Tên sản phẩm</label>
        <input type="text" name="ten" id="ten" value="<?php echo $_GET['ten']?>">
        <label for="nhanhang">Nhãn hàng</label>
        <input type="text" name="nhanhang" id="nhanhang" value="<?php echo $_GET['nhanhang']?>">
        <label for="giaban">Giá bán</label>
        <input type="text" name="giaban" id="giaban" value="<?php echo $_GET['giaban']?>">
        <input type="submit" name="cap-nhat" onclick ="return xacNhanCapNhat();" value="Cập nhật">
        <input type="submit" name ="huy" value="Hủy">
    </form>
 </body>
 <script>
    function xacNhanCapNhat() {
        let id = document.getElementById("id").value;
        let ten = document.getElementById("ten").value;
        let nhanhang = document.getElementById("nhanhang").value;
        let giaban = document.getElementById("giaban").value;

        return confirm(
            "Thông tin sữa sau cập nhật sẽ là:\n" +
            "ID: " + id + "\n" +
            "Tên sản phẩm: " + ten + "\n" +
            "Nhãn hàng: " + nhanhang + "\n" +
            "Giá bán: " + giaban + "\n"
        );
    }
</script>
 </html>