<?php
    session_start();
    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        header("Location: ../../Giao-dien/baitaplon/php/batdau.php");
        exit();
    }
    
    // Get statistics
    require_once('../../ket-noi-co-so-du-lieu.php');
    
    // Count customers
    $sql_customers = "SELECT COUNT(*) as total FROM khachhang WHERE loai_tai_khoan = 'USER'";
    $result_customers = mysqli_query($conn, $sql_customers);
    $total_customers = mysqli_fetch_assoc($result_customers)['total'];
    
    // Count products
    $sql_products = "SELECT COUNT(*) as total FROM sanpham";
    $result_products = mysqli_query($conn, $sql_products);
    $total_products = mysqli_fetch_assoc($result_products)['total'];
    
    // Count orders
    $sql_orders = "SELECT COUNT(*) as total FROM dohang WHERE xacnhan = 'đã xác nhận'";
    $result_orders = mysqli_query($conn, $sql_orders);
    $total_orders = mysqli_fetch_assoc($result_orders)['total'];
    
    // Count brands
    $sql_brands = "SELECT COUNT(*) as total FROM hangsua";
    $result_brands = mysqli_query($conn, $sql_brands);
    $total_brands = mysqli_fetch_assoc($result_brands)['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <title>Admin Dashboard</title>
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

        /* Dashboard Cards */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .stat-icon.customers {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .stat-icon.products {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stat-icon.orders {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .stat-icon.brands {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }

        /* Quick Actions */
        .quick-actions {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .quick-actions h3 {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 25px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .action-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .action-card:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .action-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: white;
        }

        .action-icon.add {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .action-icon.view {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .action-icon.edit {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }

        .action-info h4 {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .action-info p {
            font-size: 14px;
            color: #64748b;
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
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
            
            .actions-grid {
                grid-template-columns: 1fr;
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
                    <div class="nav-item active">
                        <i class="fa-solid fa-chart-line"></i>
                        <a href="trang-admin.php">Tổng quan</a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <h3>Quản lý</h3>
                    <div class="nav-item">
                        <i class="fa-solid fa-users"></i>
                        <a href="thong-tin/thong-tin-khach-hang.php">Khách hàng</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-building"></i>
                        <a href="thong-tin/thong-tin-hang-sua.php">Hãng sữa</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-box"></i>
                        <a href="thong-tin/thong-tin-sua.php">Sản phẩm</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-shopping-cart"></i>
                        <a href="thong-tin/thong-tin-gio-hang.php">Đơn hàng</a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <h3>Thêm mới</h3>
                    <div class="nav-item">
                        <i class="fa-solid fa-plus"></i>
                        <a href="them/them-hang-sua.php">Thêm hãng sữa</a>
                    </div>
                    <div class="nav-item">
                        <i class="fa-solid fa-plus"></i>
                        <a href="them/them-sua.php">Thêm sản phẩm</a>
                    </div>
                </div>
                
                <div class="logout-item">
                    <div class="nav-item">
                        <i class="fa-solid fa-sign-out-alt"></i>
                        <a href="../../Giao-dien/baitaplon/php/batdau.php">Về trang chủ</a>
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
                <h1 class="page-title">Admin Dashboard</h1>
                <p class="page-subtitle">Quản lý hệ thống bán sữa</p>
            </div>

            <!-- Statistics Cards -->
            <div class="dashboard-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon customers">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-number"><?php echo $total_customers; ?></div>
                    <div class="stat-label">Khách hàng</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon products">
                            <i class="fa-solid fa-box"></i>
                        </div>
                    </div>
                    <div class="stat-number"><?php echo $total_products; ?></div>
                    <div class="stat-label">Sản phẩm</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon orders">
                            <i class="fa-solid fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="stat-number"><?php echo $total_orders; ?></div>
                    <div class="stat-label">Đơn hàng</div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon brands">
                            <i class="fa-solid fa-building"></i>
                        </div>
                    </div>
                    <div class="stat-number"><?php echo $total_brands; ?></div>
                    <div class="stat-label">Hãng sữa</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h3>Thao tác nhanh</h3>
                <div class="actions-grid">
                    <a href="them/them-hang-sua.php" class="action-card">
                        <div class="action-icon add">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="action-info">
                            <h4>Thêm hãng sữa</h4>
                            <p>Tạo hãng sữa mới</p>
                        </div>
                    </a>

                    <a href="them/them-sua.php" class="action-card">
                        <div class="action-icon add">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div class="action-info">
                            <h4>Thêm sản phẩm</h4>
                            <p>Thêm sản phẩm mới</p>
                        </div>
                    </a>

                    <a href="thong-tin/thong-tin-khach-hang.php" class="action-card">
                        <div class="action-icon view">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <div class="action-info">
                            <h4>Xem khách hàng</h4>
                            <p>Quản lý thông tin khách hàng</p>
                        </div>
                    </a>

                    <a href="thong-tin/thong-tin-gio-hang.php" class="action-card">
                        <div class="action-icon view">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <div class="action-info">
                            <h4>Xem đơn hàng</h4>
                            <p>Quản lý đơn hàng</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>