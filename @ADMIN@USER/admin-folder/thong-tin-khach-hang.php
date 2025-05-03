<?php
    require_once('../../ket-noi-co-so-du-lieu.php');
    $sql = "SELECT * FROM khachhang";
    $result = mysqli_query($conn, $sql);

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_start();
        session_destroy();
        header("Location: ../../Giao-dien/baitaplon/php/batdau.php");
        exit();
    }

    // Cập nhật thông tin khách hàng
    if (isset($_POST['btnSua'])) {
        $id = $_POST['id'];
        $ho_ten = $_POST['ho_ten'];
        $gioi_tinh = $_POST['gioi_tinh'];
        $dia_chi = $_POST['dia_chi'];
        $email = $_POST['email'];

        $sql_update = "UPDATE khachhang SET ho_ten='$ho_ten', gioi_tinh='$gioi_tinh', dia_chi='$dia_chi', email='$email' WHERE id='$id'";
        mysqli_query($conn, $sql_update);
    }

    // Xóa khách hàng
    if (isset($_GET['action']) && $_GET['action'] == 'xoa') {
        $id = $_GET['id'];
        $sql_delete = "DELETE FROM khachhang WHERE id = $id";
        mysqli_query($conn, $sql_delete);
        header("Location: thong-tin-khach-hang.php");  // reload trang sau khi xóa
        exit();
    }

    // Nếu có yêu cầu cập nhật, lấy dữ liệu khách hàng
    if (isset($_GET['action']) && $_GET['action'] == 'capnhat') {
        $id = $_GET['id'];
        $sql = "SELECT * FROM khachhang WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        // Truyền dữ liệu vào form
        echo "<script>
        document.getElementById('formCapNhat').style.display = 'block';
        document.getElementById('id').value = '".$row['id']."';
        document.getElementById('Ho_ten').value = '".$row['ho_ten']."';
        document.getElementById('Gioi_tinh').value = '".$row['gioi_tinh']."';
        document.getElementById('Dia_chi').value = '".$row['dia_chi']."';
        document.getElementById('Email').value = '".$row['email']."';
        </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css-folder/admins.css">
    <title>Thông tin khách hàng</title>
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="">
            <i class="fa-solid fa-glass-water"></i>
            <span>Milk</span>
            <div class="space"><h6>Admin workspace</h6></div>  
            </a>
        </div>
        <div class="menu">
            <div class="chose">
                <a href="thong-tin-khach-hang.php">Thông tin khách hàng</a>
            </div>
            <div class="chose">
                <a href="thong-tin-hang-sua.php">Thông tin hãng sữa</a>
            </div>
            <div class="chose">
                <a href="thong-tin-sua.php">Thông tin sữa</a>
            </div>
            <div class="chose">
                <a href="thong-tin-sua.php">Thông tin đơn hàng</a>
            </div>
            <div class="chose">
            <a href="?action=logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');" class="logout">Đăng xuất</a>
            </div>
        </div>
    </div>

    <div id="thong-tin-khach-hang">
        <h1>THÔNG TIN KHÁCH HÀNG</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Tên khách hàng</th>
                <th>Giới tính</th>
                <th>Địa chỉ</th>
                <th>Email</th>
                <th>Thao tác</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { 
                if($row['loai_tai_khoan'] != 'USER') continue;
            ?>    
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['ho_ten'] ?></td>
                <td><?= $row['gioi_tinh'] ?></td>
                <td><?= $row['dia_chi'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="?action=capnhat&id=<?= $row['id'] ?>">Cập nhật</a> | 
                    <a href="?action=xoa&id=<?= $row['id']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <!-- Form Cập nhật -->
        <div id="formCapNhat" style="position:fixed; top:30%; left:50%; transform:translateX(-50%);
                                        background:#f0f0f0; padding:15px; border:1px solid #ccc;">
            <form method="POST">
                <input type="hidden" name="id" id="id">
                <label>Họ tên:</label><input type="text" name="ho_ten" id="Ho_ten"><br>
                <label>Giới tính:</label><input type="text" name="gioi_tinh" id="Gioi_tinh"><br>
                <label>Địa chỉ:</label><input type="text" name="dia_chi" id="Dia_chi"><br>
                <label>Email:</label><input type="text" name="email" id="Email"><br><br>
                <button type="submit" name="btnSua">Cập nhật</button>
                <button type="button" onclick="document.getElementById('formCapNhat').style.display = 'none';">Hủy</button>
            </form>
        </div>
    </div>
</body>
</html>
