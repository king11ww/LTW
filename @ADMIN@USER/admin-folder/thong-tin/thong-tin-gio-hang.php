<?php
    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_start();
        session_destroy();
        header("Location: ../../../Giao-dien/baitaplon/php/batdau.php");
        exit();
    }

    if (isset($_GET['action']) && $_GET['action'] == 'xoa') {
        require_once('../../../ket-noi-co-so-du-lieu.php');
        $id = $_GET['id'];
        $sql_delete = "DELETE FROM dohang WHERE id = $id";
        mysqli_query($conn, $sql_delete);
        header("Location: thong-tin-gio-hang.php");
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <title>Quản lý đơn hàng</title>
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
        }

        .table-header h2 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
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

        .btn-delete {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .order-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .order-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }

        .order-details h4 {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .order-details p {
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

        .status-confirmed {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .price {
            font-weight: 600;
            color: #10b981;
        }

        .quantity {
            background: #e0e7ff;
            color: #3730a3;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
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
                min-width: 800px;
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
                    <div class="nav-item">
                        <i class="fa-solid fa-building"></i>
                        <a href="thong-tin-hang-sua.php">Hãng sữa</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-box"></i>
                        <a href="thong-tin-sua.php">Sản phẩm</a>
                    </div>
                    <div class="nav-item active">
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
                <h1 class="page-title">Quản lý đơn hàng</h1>
                <p class="page-subtitle">Xem và quản lý thông tin các đơn hàng</p>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h2><i class="fa-solid fa-shopping-cart"></i> Danh sách đơn hàng</h2>
                </div>
                <div class="table-content">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Khách hàng</th>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once('../../../ket-noi-co-so-du-lieu.php');
                            $sql = "select * from dohang";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                                $firstLetter = strtoupper(substr($row['ho_ten'], 0, 1));
                            ?>
                            <tr>
                                <td>#<?php echo $row['id'] ?></td>
                                <td>
                                    <div class="order-info">
                                        <div class="order-avatar">
                                            <?= $firstLetter ?>
                                        </div>
                                        <div class="order-details">
                                            <h4><?php echo $row['ho_ten'] ?></h4>
                                            <p><?php echo $row['ten_dang_nhap'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $row['ten_san_pham'] ?></td>
                                <td>
                                    <span class="quantity"><?php echo $row['soluong'] ?></span>
                                </td>
                                <td class="price"><?php echo number_format($row['gia'], 0, ',', '.') ?> VNĐ</td>
                                <td>
                                    <?php if($row['xacnhan'] == 'đã xác nhận'): ?>
                                        <span class="status-badge status-confirmed">Đã xác nhận</span>
                                    <?php else: ?>
                                        <span class="status-badge status-pending">Chờ xác nhận</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="?action=xoa&id=<?php echo $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')" class="btn btn-delete">
                                            <i class="fa-solid fa-trash"></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>