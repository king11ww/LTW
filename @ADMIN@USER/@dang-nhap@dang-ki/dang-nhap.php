<?php
    session_start();
    require_once('../../ket-noi-co-so-du-lieu.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $tenDangNhap = $_POST['ten-dang-nhap'];
        $matKhau = $_POST['mat-khau'];

        $sql = "SELECT * FROM khachhang WHERE ten_dang_nhap='$tenDangNhap' AND mat_khau='$matKhau'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) 
        {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            $_SESSION['ten_dang_nhap'] = $tenDangNhap;  
            $_SESSION['ho_ten'] = $row['ho_ten'];    
            $_SESSION['gioi_tinh'] = $row['gioi_tinh'];
            $_SESSION['dia_chi'] = $row['dia_chi'];
            $_SESSION['so_dien_thoai'] = $row['so_dien_thoai'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['mat_khau'] = $row['mat_khau'];
            $_SESSION['loai_tai_khoan'] = $row['loai_tai_khoan'];
            if($row['loai_tai_khoan'] == 'ADMIN')
            {
                header('Location: ../admin-folder/trang-admin.php');
            }
            else
            {
                header('Location: ../../Giao-dien/baitaplon/php/batdau.php');
            }
            exit();
        } 
        else 
        {
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
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

        .form-group {
            margin-bottom: 25px;
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

        .btn-login {
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

        .btn-login:hover {
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

        .register-link {
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
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

        @media (max-width: 480px) {
            .login-container {
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
    <div class="login-container">
        <div class="login-card">
            <div class="card-header">
                <div class="logo">
                    <i class="fa-solid fa-glass-water"></i>
                </div>
                <h2>Chào mừng trở lại</h2>
                <p>Đăng nhập vào tài khoản của bạn</p>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="ten-dang-nhap">Tên đăng nhập</label>
                        <div class="input-group">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="ten-dang-nhap" id="ten-dang-nhap" placeholder="Nhập tên đăng nhập" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="mat-khau">Mật khẩu</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="mat-khau" id="mat-khau" placeholder="Nhập mật khẩu" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <i class="fa-solid fa-sign-in-alt"></i>
                        Đăng nhập
                    </button>
                </form>
                
                <div class="divider">
                    <span>hoặc</span>
                </div>
                
                <div class="register-link">
                    Chưa có tài khoản? <a href="dang-ki.php">Đăng ký ngay</a>
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
</body>
</html>