<?php
    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_start();
        session_destroy();
        header("Location: ../../../Giao-dien/baitaplon/php/batdau.php");
        exit();
    }

    require_once('../../../ket-noi-co-so-du-lieu.php');

    $limit = 10; 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $result_all = mysqli_query($conn, "SELECT COUNT(*) AS total FROM sanpham");
    $row_all = mysqli_fetch_assoc($result_all);
    $total_records = $row_all['total'];
    $total_pages = ceil($total_records / $limit);

    $sql = "SELECT * FROM sanpham LIMIT $start, $limit";
    $result = mysqli_query($conn, $sql);

    if (isset($_GET['action']) && $_GET['action'] == 'xoa') {
        $id = $_GET['id'];
        $sql_delete = "DELETE FROM sanpham WHERE id = $id";
        mysqli_query($conn, $sql_delete);
        header("Location: thong-tin-sua.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <title>Quản lý sản phẩm</title>
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

        .back-btn {
            background: rgba(255, 255, 255, 0.15);
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
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            border-color: rgba(255, 255, 255, 0.3);
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

        .product-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .product-avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 12px;
        }

        .product-details h4 {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .product-details p {
            color: #64748b;
            font-size: 12px;
        }

        .price {
            font-weight: 600;
            color: #10b981;
        }

        .brand-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            background: #e0e7ff;
            color: #3730a3;
        }

        /* Pagination */
        .pagination-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .pagination a {
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            text-decoration: none;
            color: #64748b;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .pagination a.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
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
                min-width: 700px;
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
                    <div class="nav-item active">
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
                <h1 class="page-title">Quản lý sản phẩm</h1>
                <p class="page-subtitle">Xem và quản lý thông tin các sản phẩm sữa</p>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h2><i class="fa-solid fa-box"></i> Danh sách sản phẩm</h2>
                    <div style="display: flex; gap: 15px; align-items: center;">
                        <a href="../them/them-sua.php" class="add-btn">
                            <i class="fa-solid fa-plus"></i>
                            Thêm sản phẩm
                        </a>
                        <a href="../trang-admin.php" class="back-btn">
                            <i class="fa-solid fa-arrow-left"></i>
                            Quay lại
                        </a>
                    </div>
                </div>
                <div class="table-content">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sản phẩm</th>
                                <th>Nhãn hàng</th>
                                <th>Giá bán</th>
                                <th>Hình ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($result)) { 
                                $firstLetter = strtoupper(substr($row['ten'], 0, 1));
                            ?>
                            <tr>
                                <td>#<?php echo $row['id'] ?></td>
                                <td>
                                    <div class="product-info">
                                        <div class="product-avatar">
                                            <?= $firstLetter ?>
                                        </div>
                                        <div class="product-details">
                                            <h4><?php echo $row['ten'] ?></h4>
                                            <p>Sản phẩm sữa</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="brand-badge"><?php echo $row['nhanhang'] ?></span>
                                </td>
                                <td class="price"><?php echo number_format($row['giaban'], 0, ',', '.') ?> VNĐ</td>
                                <td><?php echo $row['image'] ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="../cap-nhat-thong-tin/cap-nhat-sua.php?id=<?php echo $row['id'];?>&ten=<?php echo $row['ten'];?>&nhanhang=<?php echo $row['nhanhang'];?>&giaban=<?php echo $row['giaban']?>&image=<?php echo $row['image']?>" class="btn btn-edit">
                                            <i class="fa-solid fa-edit"></i> Sửa
                                        </a>
                                        <a href="thong-tin-sua.php?action=xoa&id=<?php echo $row['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')" class="btn btn-delete">
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

            <!-- Pagination -->
            <div class="pagination-container">
                <div class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
