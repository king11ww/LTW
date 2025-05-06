
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>THÊM SỮA THÀNH CÔNG!</h2>
    <div>
            <h1><?php echo $_GET['ten_sua']?></h1>
            <p><?php echo $_GET['nhan_hang']?></p>
            <p><?php echo $_GET['don_gia']?></p>
            <img src="../../../Giao-dien/baitaplon/img/<?php echo $_GET['hinh_anh']?>" width="200px" height ="200px"alt="Hình ảnh">
            <a href="them-sua.php">Quay lại</a>
    </div>
</body>
</html>