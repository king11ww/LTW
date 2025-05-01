<?php
    require_once('../../ket-noi-co-so-du-lieu.php');
    $sql = "SELECT * FROM hangsua";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        
    </style>
    <title>Thông tin hãng sữa</title>
</head>
<body>
    <div id="thong-tin-hang-sua">
        <table border="1">
            <h1>THÔNG TIN HÃNG SỮA</h1>
            <tr>
                <td>ID</td>
                <td>Tên hãng sữa</td>
                <td>Địa chỉ</td>
                <td>Điện thoại</td>
                <td>Email</td>
                <td colspan = "2">Thao tác</td>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result)) 
                {   
            ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['ten_hang_sua']?></td>
                <td><?php echo $row['dia_chi']?></td>
                <td><?php echo $row['dien_thoai']?></td>
                <td><?php echo $row['email']?></td>
                <td><a href="capnhat.php?khoa=<?php echo $row['id']; ?>">Cập nhật</a> </td>
                <td>
                    <a href="xoa.php?khoa=<?php echo $row['id']; ?>" onclick = "confirm('Bạn có chắc chắn muốn xóa hay không')">Xóa</a> 
                </td>
            </tr>
            <?php }?>
        </table>
        <button><a href="them-hang-sua.php">Thêm</a></button>
    </div>
</body>
</html>