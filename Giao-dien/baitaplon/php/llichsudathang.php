<?php
    session_start();
    if(isset($_SESSION['phuong-thuc-thanh-toan']) && $_SESSION['phuong-thuc-thanh-toan'] == 'tao-thanh-cong') {
        echo '<script>alert("Tạo đơn hàng thành công")</script>';
        unset($_SESSION['phuong-thuc-thanh-toan']);
    }
    if(isset($_GET['action']) && $_GET['action'] == 'logout')
    {
        session_destroy();
        header("Location: batdau.php");
        exit();
    }
    require_once("../../../ket-noi-co-so-du-lieu.php");

    if(isset($_POST['huy-don-hang'])) {
        $ten_sp = $_POST['ten_san_pham'];
        $ten_dn = $_POST['ten_dang_nhap'];
        $so_luong = $_POST['so_luong'];
        $sql_xoa_don_hang = "DELETE FROM dohang WHERE `dohang`.`ten_dang_nhap` = '$ten_dn' and `ten_san_pham` = '$ten_sp'";
        mysqli_query($conn, $sql_xoa_don_hang);
        $_SESSION['xoa-don-hang'] = "Xóa thành công đơn hàng " . $ten_sp . " với số lượng " . $so_luong;
        
        header("Location: llichsudathang.php");
        exit();
    }
    if(isset($_SESSION['xoa-don-hang']))
    {
        $thong_bao_xoa_don_hang_thanh_cong = $_SESSION['xoa-don-hang'];
        echo "<script> alert('$thong_bao_xoa_don_hang_thanh_cong')</script>";
        unset($_SESSION['xoa-don-hang']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử đặt hàng</title>
    <link rel="stylesheet" href="../css/shop.css">
    <link rel="stylesheet" href="../css/header_footer.css">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
    <div class="header">
            <div class="logo">
                <a href="batdau.php">
                <i class="fa-solid fa-glass-water"></i>
                <span>Milk</span>   
                </a>
            </div>
            <div class="menu">
                <div class="chose">
                    <a href="batdau.php">Home</a>
                </div>
                <div class="chose">
                    <a href="sanpham.php">Sản Phẩm</a>
                </div>
                <div class="chose">
                    <a href="batdau.php">Thông tin</a>
                </div>
                <div class="chose">
                    <a href="batdau.php">Liên hệ</a>
                </div>
            </div>
            <?php if(isset($_SESSION['ten_dang_nhap'])): ?>
            <div class="user">
                <?php if($_SESSION['loai_tai_khoan'] == 'ADMIN'):?>
                    ADMIN TỐI CAO: <?php echo $_SESSION['ho_ten'] ?>
                    <a href="../../../@ADMIN@USER/admin-folder/trang-admin.php">
                        <i class="fa-solid fa-user"></i>
                    </a>
                <?php else:?>
                    Người dùng: <?php echo $_SESSION['ho_ten'] ?>
                    <a href="user.php">
                        <i class="fa-solid fa-user"></i>
                    </a>
                <?php endif?>  
            </div>
            <div class="shopcart">
                <a href="shop.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <?php
                        require_once("../../../ket-noi-co-so-du-lieu.php");
                        $ten_dang_nhap = $_SESSION['ten_dang_nhap'];
                        $sql_so_luong_don_hang = "select * from dohang where ten_dang_nhap = '$ten_dang_nhap'";  
                        $so_luong_don_hang =  mysqli_num_rows(mysqli_query($conn, $sql_so_luong_don_hang));
                    ?>
                    <?php
                        if($so_luong_don_hang > 0){
                    ?>
                    <div class="shopcart_value"><?php echo $so_luong_don_hang ?></div>
                    <?php } ?>
                </a>
            </div>
            <a href="?action=logout" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?');" style="font-size:15px;" class="logout">Đăng xuất</a>
            <?php else: ?>
            <div class="user">
                <a href="../../../@ADMIN@USER/@dang-nhap@dang-ki/dang-nhap.php">Đăng nhập</a> |
                <a href="../../../@ADMIN@USER/@dang-nhap@dang-ki/dang-ki.php" >Đăng ký</a>
            </div>
            <?php endif; ?>

        </div>
        <div class="header1">
            <div class="shopcontent">
                <div class="yourshop">
                    <b><i class="fa-solid fa-clock-rotate-left cart-icon"></i>Lịch sử đặt hàng</b>
                </div>

                <div class="infoshop">
                    <div class="b"><b>Lịch sử đơn hàng</b></div>

                    <?php
                    require_once("../../../ket-noi-co-so-du-lieu.php");
                    $sql = "select * from dohang as dh inner join sanpham as sp on sp.ten = dh.ten_san_pham where ten_dang_nhap = '$_SESSION[ten_dang_nhap]' and xacnhan = 'đã xác nhận'";  
                    $result = mysqli_query($conn, $sql);
                    $allmoney = 0;
                    if(mysqli_num_rows($result) < 1):
                        echo '<div class="empty-cart">'
                            .'<i class="fa-solid fa-clipboard-list"></i>'
                            .'<h3>Chưa có đơn hàng đã xác nhận</h3>'
                            .'<p>Khi bạn đặt hàng thành công, đơn hàng sẽ xuất hiện tại đây</p>'
                            .'<a href="batdau.php">Tiếp tục mua sắm</a>'
                        .'</div>';
                    else:
                        // Tính tổng tiền
                        $temp_result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($temp_result)){
                            $allmoney += $row['gia'];
                        }
                    ?>

                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)):
                                $don_gia = ($row['soluong'] > 0) ? ($row['gia'] / $row['soluong']) : $row['gia'];
                            ?>
                            <tr>
                                <td class="product-image" data-label="Sản phẩm">
                                    <img src="../img/<?php echo $row['image']?>" alt="<?php echo $row['ten_san_pham'] ?>">
                                </td>
                                <td class="product-name" data-label="Tên sản phẩm">
                                    <h4><?php echo $row['ten_san_pham'] ?></h4>
                                    <p>Nhãn hàng: <?php echo $row['nhanhang'] ?></p>
                                </td>
                                <td class="product-price" data-label="Giá">
                                    <?php echo number_format($don_gia) ?> ₫
                                </td>
                                <td class="product-quantity" data-label="Số lượng">
                                    <?php echo $row['soluong'] ?>
                                </td>
                                <td class="product-total" data-label="Tổng">
                                    <?php echo number_format($row['gia']) ?> ₫
                                </td>
                                <td class="product-price" data-label="Trạng thái">
                                    <?php echo ucfirst($row['xacnhan']); ?>
                                </td>
                                <td class="product-actions" data-label="Hành động">
                                    <form action="llichsudathang.php" method="post" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn đặt hàng này không?');">
                                        <?php 
                                            require_once("../../../ket-noi-co-so-du-lieu.php");
                                            $ten_sp = $row['ten_san_pham'];
                                            $sql_gia_ban = "select * from sanpham where ten = '$ten_sp'";
                                            $ans = mysqli_query($conn, $sql_gia_ban);
                                            $hang = mysqli_fetch_assoc($ans);
                                            $gia_ban = $hang['giaban'];
                                        ?>
                                        <input type="hidden" name="ten_san_pham" value="<?php echo $row['ten_san_pham'] ?>">
                                        <input type="hidden" name="ten_dang_nhap" value="<?php echo $_SESSION['ten_dang_nhap'] ?>">
                                        <input type="hidden" name="gia_san_pham" value="<?php echo $gia_ban?>">
                                        <input type="hidden" name="so_luong" value="<?php echo $row['soluong'] ?>">
                                        <button type="submit" name="huy-don-hang" class="remove-btn"><i class="fa-solid fa-trash"></i> Hủy</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <div class="order-summary">
                        <div class="summary-header">
                            <i class="fa-solid fa-receipt"></i> Tổng chi phí các đơn đã xác nhận
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Tổng tiền hàng:</span>
                            <span class="summary-total"><?php echo number_format($allmoney) ?> ₫</span>
                        </div>
                        <div class="summary-info">
                            <ul>
                                <li><i class="fa-solid fa-circle-info"></i> Đây là tổng tiền của các đơn đã xác nhận</li>
                                <li><i class="fa-solid fa-rotate"></i> Bạn có thể hủy đơn nếu cần (nếu cửa hàng cho phép)</li>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
