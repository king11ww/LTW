<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Courier New', Courier, monospace;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 600px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .logo {
            font-size: 48px;
            margin-bottom: 15px;
            color: #fbbf24;
        }

        .card-header h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .card-header p {
            opacity: 0.9;
            font-size: 16px;
        }

        .card-body {
            padding: 40px 30px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 16px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8fafc;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group input::placeholder {
            color: #94a3b8;
        }

        .gender-group {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .gender-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .gender-option input[type="radio"] {
            width: auto;
            margin: 0;
            cursor: pointer;
        }

        .gender-option label {
            margin: 0;
            cursor: pointer;
            color: #64748b;
        }

        .btn-register {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #64748b;
            font-size: 14px;
        }

        .login-link {
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #5a67d8;
        }

        .back-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-home a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 0 10px;
            }

            .card-header {
                padding: 30px 20px;
            }

            .card-body {
                padding: 30px 20px;
            }

            .card-header h2 {
                font-size: 24px;
            }

            .logo {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="card-header">
                <div class="logo">
                    <i class="fa-solid fa-glass-water"></i>
                </div>
                <h2>Tham gia cùng chúng tôi</h2>
                <p>Tạo tài khoản mới để bắt đầu</p>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="ten-dang-nhap">Tên đăng nhập</label>
                            <div class="input-group">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" name="ten-dang-nhap" id="ten-dang-nhap" placeholder="Nhập tên đăng nhập" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="ho-va-ten">Họ và tên</label>
                            <div class="input-group">
                                <i class="fa-solid fa-id-card"></i>
                                <input type="text" name="ho-va-ten" id="ho-va-ten" placeholder="Nhập họ và tên" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Giới tính</label>
                            <div class="gender-group">
                                <div class="gender-option">
                                    <input type="radio" name="gioi-tinh" id="gioi-tinh-nam" value="Nam" required checked>
                                    <label for="gioi-tinh-nam">Nam</label>
                                </div>
                                <div class="gender-option">
                                    <input type="radio" name="gioi-tinh" id="gioi-tinh-nu" value="Nữ" required>
                                    <label for="gioi-tinh-nu">Nữ</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="so-dien-thoai">Số điện thoại</label>
                            <div class="input-group">
                                <i class="fa-solid fa-phone"></i>
                                <input type="text" name="so-dien-thoai" id="so-dien-thoai" placeholder="Nhập số điện thoại" required>
                            </div>
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="dia-chi">Địa chỉ</label>
                            <div class="input-group">
                                <i class="fa-solid fa-map-marker-alt"></i>
                                <input type="text" name="dia-chi" id="dia-chi" placeholder="Nhập địa chỉ" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" name="email" id="email" placeholder="Nhập email" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="mat-khau">Mật khẩu</label>
                            <div class="input-group">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="mat-khau" id="mat-khau" placeholder="Nhập mật khẩu" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="nhap-lai-mat-khau">Nhập lại mật khẩu</label>
                            <div class="input-group">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="nhap-lai-mat-khau" id="nhap-lai-mat-khau" placeholder="Nhập lại mật khẩu" required>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-register">
                        <i class="fa-solid fa-user-plus"></i>
                        Đăng ký
                    </button>
                </form>
                
                <div class="divider">
                    <span>hoặc</span>
                </div>
                
                <div class="login-link">
                    Đã có tài khoản? <a href="dang-nhap.php">Đăng nhập</a>
                </div>
            </div>
        </div>
        
        <div class="back-home">
            <a href="../../Giao-dien/baitaplon/php/batdau.php">
                <i class="fa-solid fa-home"></i>
                Về trang chủ
            </a>
        </div>
    </div>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {   
            $tenDangNhap = $_POST["ten-dang-nhap"];
            $hoVaTen = $_POST["ho-va-ten"];
            $gioiTinh = $_POST["gioi-tinh"];
            $diaChi = $_POST["dia-chi"];
            $soDienThoai = $_POST["so-dien-thoai"];
            $email = $_POST["email"];
            $matKhau = $_POST["mat-khau"];
            $nhapLaiMatKhau = $_POST["nhap-lai-mat-khau"];
            require_once("../../ket-noi-co-so-du-lieu.php");
            $get_user = "SELECT * FROM khachhang WHERE ten_dang_nhap = '$tenDangNhap'";
            if ($conn->query($get_user)->num_rows > 0) {
                echo "<script>alert('Tên đăng nhập đã tồn tại!');</script>";
                $conn->close();
                exit();
            }     
            
            $sql = "select *";
            if($matKhau == $nhapLaiMatKhau)
            {
                require_once("../../ket-noi-co-so-du-lieu.php");
                $sql = "INSERT INTO khachhang (ten_dang_nhap, ho_ten, gioi_tinh, dia_chi, so_dien_thoai, email, mat_khau, loai_tai_khoan) 
                    VALUES ('$tenDangNhap', '$hoVaTen', '$gioiTinh', '$diaChi', '$soDienThoai', '$email', '$matKhau', 'USER')";
                $get_user = "SELECT * FROM khachhang WHERE ten_dang_nhap = '$tenDangNhap'";
                if ($conn->query($get_user)->num_rows > 0) {
                    echo "<script>alert('Tên đăng nhập đã tồn tại!');</script>";
                }     

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Đăng kí thành công!');</script>";
                    header("Location: dang-nhap.php");
                } else {
                    echo "<script>alert('Lỗi: " . $sql . "<br>" . $conn->error . "');</script>";
                }
            }
            else
            {
                echo "<script>alert('Mật khẩu không khớp!');</script>";
            }
            $conn->close();
            
        }
    ?>
</body>
</html>