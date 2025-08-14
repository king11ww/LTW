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
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <title>Thêm hãng sữa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Courier New', Courier, monospace;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 24px;
            font-weight: bold;
            color: #fbbf24;
        }

        .sidebar-logo i {
            font-size: 28px;
        }

        .admin-badge {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 5px;
            display: inline-block;
        }

        .sidebar-nav {
            padding: 0 20px;
        }

        .nav-section {
            margin-bottom: 30px;
        }

        .nav-section h3 {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 15px;
            padding: 0 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .nav-item.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
        }

        .nav-item a {
            color: inherit;
            text-decoration: none;
            font-weight: 500;
        }

        .logout-item {
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
        }

        .logout-item .nav-item {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .logout-item .nav-item:hover {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px;
        }

        .page-header {
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 32px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 16px;
        }

        /* Form Styling */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .form-header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .form-body {
            padding: 40px;
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

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            background: #e2e8f0;
            color: #64748b;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #cbd5e1;
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert.error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert.success {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 250px;
            }
            
            .main-content {
                margin-left: 250px;
            }
        }

        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            
            .form-body {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fa-solid fa-glass-water"></i>
                    <span>Milk</span>
                </div>
                <div class="admin-badge">ADMIN PANEL</div>
            </div>
            
            <div class="sidebar-nav">
                <div class="nav-section">
                    <h3>Dashboard</h3>
                    <div class="nav-item">
                        <i class="fa-solid fa-chart-line"></i>
                        <a href="../trang-admin.php">Tổng quan</a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <h3>Quản lý</h3>
                    <div class="nav-item">
                        <i class="fa-solid fa-users"></i>
                        <a href="../thong-tin/thong-tin-khach-hang.php">Khách hàng</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-building"></i>
                        <a href="../thong-tin/thong-tin-hang-sua.php">Hãng sữa</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-box"></i>
                        <a href="../thong-tin/thong-tin-sua.php">Sản phẩm</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <a href="../thong-tin/thong-tin-gio-hang.php">Đơn hàng</a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <h3>Thêm mới</h3>
                    <div class="nav-item active">
                        <i class="fa-solid fa-plus"></i>
                        <a href="them-hang-sua.php">Thêm hãng sữa</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-plus"></i>
                        <a href="them-sua.php">Thêm sản phẩm</a>
                    </div>
                </div>
                
                <div class="logout-item">
                    <div class="nav-item">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        <a href="../../../Giao-dien/baitaplon/php/batdau.php">Về trang chủ</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Thêm hãng sữa</h1>
                <p class="page-subtitle">Tạo hãng sữa mới cho hệ thống</p>
            </div>

            <div class="form-container">
                <div class="form-card">
                    <div class="form-header">
                        <h2><i class="fa-solid fa-building"></i> Thông tin hãng sữa</h2>
                        <p>Điền thông tin chi tiết về hãng sữa mới</p>
                    </div>
                    <div class="form-body">
                        <?php if (isset($error_message)): ?>
                            <div class="alert error">
                                <i class="fa-solid fa-exclamation-triangle"></i>
                                <?php echo $error_message; ?>
                            </div>
                        <?php endif; ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="ten-hang-sua">Tên hãng sữa</label>
                                <div class="input-group">
                                    <i class="fa-solid fa-building"></i>
                                    <input type="text" id="ten-hang-sua" name="ten_hang_sua" placeholder="Nhập tên hãng sữa" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dia-chi">Địa chỉ</label>
                                <div class="input-group">
                                    <i class="fa-solid fa-map-marker-alt"></i>
                                    <input type="text" id="dia-chi" name="dia_chi" placeholder="Nhập địa chỉ" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dien-thoai">Điện thoại</label>
                                <div class="input-group">
                                    <i class="fa-solid fa-phone"></i>
                                    <input type="tel" id="dien-thoai" name="dien_thoai" placeholder="Nhập số điện thoại" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="email" id="email" name="email" placeholder="Nhập email" required>
                                </div>
                            </div>

                            <button type="submit" class="btn-submit">
                                <i class="fa-solid fa-plus"></i>
                                Thêm hãng sữa
                            </button>
                        </form>
                        
                        <a href="../thong-tin/thong-tin-hang-sua.php" class="btn-cancel">
                            <i class="fa-solid fa-arrow-left"></i>
                            Quay lại danh sách
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>