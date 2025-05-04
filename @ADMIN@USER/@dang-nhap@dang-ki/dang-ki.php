<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-folder/mac-dinh.css">
    <title>Đăng kí</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <form method="post">
                <h2>Đăng kí</h2>
                
                <label for="ten-dang-nhap">Tên đăng nhập:</label>
                <input type="text" name="ten-dang-nhap" id="ten-dang-nhap" placeholder="Tên đăng nhập" required><br>
                
                <label for="ho-va-ten">Họ và tên:</label>
                <input type="text" name="ho-va-ten" id="ho-va-ten" placeholder="Họ và tên" required><br>
                
                <label>Giới tính:</label>
                <div class="gender" style="text-align: left">
                    <label for="gioi-tinh-nam">Nam</label>
                    <input type="radio" name="gioi-tinh" id="gioi-tinh-nam" value="Nam" required checked>
                    <label for="gioi-tinh-nu">Nữ</label><br> 
                    <input type="radio" name="gioi-tinh" id="gioi-tinh-nu" value="Nữ" required>  
                </div>
                
                <label for="dia-chi">Địa chỉ:</label>
                <input type="text" name="dia-chi" id="dia-chi" placeholder="Địa chỉ" required><br>
                
                <label for="so-dien-thoai">Số điện thoại:</label>
                <input type="text" name="so-dien-thoai" id="so-dien-thoai" placeholder="Số điện thoại" required><br>
                
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" required><br>
                
                <label for="mat-khau">Mật khẩu:</label>
                <input type="password" name="mat-khau" id="mat-khau" placeholder="Mật khẩu" required><br>
                
                <label for="nhap-lai-mat-khau">Nhập lại mật khẩu:</label>
                <input type="password" name="nhap-lai-mat-khau" id="nhap-lai-mat-khau" placeholder="Nhập lại mật khẩu" required><br>
                
                <button type="submit">Đăng kí</button>
            </form>
            <div>Đã có tài khoản? <a href="dang-nhap.php">Đăng nhập</a></div>
        </div>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
                require_once("../../ket-noi-co-so-du-lieu.php");
                $get_user = "SELECT * FROM khachhang WHERE ten_dang_nhap = '$tenDangNhap'";
                if ($conn->query($get_user)->num_rows > 0) {
                    echo "<script>alert('Tên đăng nhập đã tồn tại!');</script>";
                    $conn->close();
                    exit();
                }     
                $tenDangNhap = $_POST["ten-dang-nhap"];
                $hoVaTen = $_POST["ho-va-ten"];
                $gioiTinh = $_POST["gioi-tinh"];
                $diaChi = $_POST["dia-chi"];
                $soDienThoai = $_POST["so-dien-thoai"];
                $email = $_POST["email"];
                $matKhau = $_POST["mat-khau"];
                $nhapLaiMatKhau = $_POST["nhap-lai-mat-khau"];

                if($matKhau == $nhapLaiMatKhau)
                {
                    require_once("../../ket-noi-co-so-du-lieu.php");
                    $sql = "INSERT INTO khachhang (ten_dang_nhap, ho_ten, gioi_tinh, dia_chi, so_dien_thoai, email, mat_khau, loai_tai_khoan) 
                        VALUES ('$tenDangNhap', '$hoVaTen', '$gioiTinh', '$diaChi', '$soDienThoai', '$email', '$matKhau', 'USER')";
                    $get_user = "SELECT * FROM khachhang WHERE ten_dang_nhap = '$tenDangNhap'";
                    if ($conn->query($get_user)->num_rows > 0) {
                        echo "<script>alert('Tên đăng nhập đã tồn tại!');</script>";
                        $conn->close();
                        exit();
                    }     

                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Đăng kí thành công!');</script>";
                        header("Location: dang-nhap.php");
                        exit();
                    } else {
                        echo "<script>alert('Lỗi: " . $sql . "<br>" . $conn->error . "');</script>";
                    }
                    $conn->close();
                }
                else
                {
                    echo "<script>alert('Mật khẩu không khớp!');</script>";
                }
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Đăng kí thành công! Vui lòng đăng nhập lại heheh');</script>";
                    header("Location: dang-nhap.php");
                    exit();
                } else {
                    echo "<script>alert('Lỗi: " . $sql . "<br>" . $conn->error . "');</script>"; 
                }
                $conn->close();
                
            }

        ?>
    </div>
</body>
</html>