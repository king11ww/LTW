<?php
    require_once('../../../ket-noi-co-so-du-lieu.php');
    $sql = "SELECT * FROM hangsua";
    $result = mysqli_query($conn, $sql);
    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_start();
        session_destroy();
        header("Location: ../../../Giao-dien/baitaplon/php/batdau.php");
        exit();
    }

    if(isset($_GET['action']) && $_GET['action'] == 'xoa')
    {
        $id = $_GET['khoa'];
        $sql = "DELETE FROM hangsua WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Xóa thành công!');</script>";
        } else {
            echo "<script>alert('Xóa không thành công!');</script>";
        }
        header("Location: thong-tin-hang-sua.php");
        exit(); 
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <title>Quản lý hãng sữa</title>
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

        /* Table Styling */
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h2 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }

        .add-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .table-content {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #f8fafc;
            color: #1e293b;
            font-weight: 600;
            padding: 15px 20px;
            text-align: left;
            border-bottom: 2px solid #e2e8f0;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 14px;
        }

        tr:hover {
            background: #f8fafc;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-edit {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
        }

        .btn-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .brand-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .brand-details h4 {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .brand-details p {
            color: #64748b;
            font-size: 12px;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
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
            
            .table-content {
                overflow-x: auto;
            }
            
            table {
                min-width: 600px;
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
                        <a href="thong-tin-khach-hang.php">Khách hàng</a>
                    </div>
                    <div class="nav-item active">
                        <i class="fa-solid fa-building"></i>
                        <a href="thong-tin-hang-sua.php">Hãng sữa</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-box"></i>
                        <a href="thong-tin-sua.php">Sản phẩm</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <a href="thong-tin-gio-hang.php">Đơn hàng</a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <h3>Thêm mới</h3>
                    <div class="nav-item">
                        <i class="fa-solid fa-plus"></i>
                        <a href="../them/them-hang-sua.php">Thêm hãng sữa</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-plus"></i>
                        <a href="../them/them-sua.php">Thêm sản phẩm</a>
                    </div>
                </div>
                
                <div class="logout-item">
                    <div class="nav-item">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        <a href="../../../Giao-dien/baitaplon/php/batdau.php">Về trang chủ</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        <a href="?action=logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');">Đăng xuất</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-header">
                <h1 class="page-title">Quản lý hãng sữa</h1>
                <p class="page-subtitle">Xem và quản lý thông tin các hãng sữa</p>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h2><i class="fa-solid fa-building"></i> Danh sách hãng sữa</h2>
                    <a href="../them/them-hang-sua.php" class="add-btn">
                        <i class="fa-solid fa-plus"></i>
                        Thêm hãng sữa
                    </a>
                </div>
                <div class="table-content">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Hãng sữa</th>
                                <th>Địa chỉ</th>
                                <th>Điện thoại</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = mysqli_fetch_assoc($result)) { 
                                $firstLetter = strtoupper(substr($row['ten_hang_sua'], 0, 1));
                            ?>
                            <tr>
                                <td>#<?php echo $row['id']?></td>
                                <td>
                                    <div class="brand-info">
                                        <div class="brand-avatar">
                                            <?= $firstLetter ?>
                                        </div>
                                        <div class="brand-details">
                                            <h4><?php echo $row['ten_hang_sua']?></h4>
                                            <p>Hãng sữa</p>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $row['dia_chi']?></td>
                                <td><?php echo $row['dien_thoai']?></td>
                                <td><?php echo $row['email']?></td>
                                <td>
                                    <span class="status-badge status-active">Hoạt động</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="../cap-nhat-thong-tin/cap-nhat-thong-tin-hang-sua.php?id=<?php echo $row['id'];?>&ten_hang_sua=<?php echo $row['ten_hang_sua']?>&dia_chi=<?php echo $row['dia_chi']?>&dien_thoai=<?php echo $row['dien_thoai']?>&email=<?php echo $row['email']?>" class="btn btn-edit">
                                            <i class="fa-solid fa-edit"></i> Sửa
                                        </a>
                                        <a href="thong-tin-hang-sua.php?action=xoa&khoa=<?php echo $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa hãng sữa này không?')" class="btn btn-delete">
                                            <i class="fa-solid fa-trash"></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>