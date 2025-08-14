<?php
    session_start();

    if(isset($_GET['action']) && $_GET['action'] == 'logout')
    {
        session_destroy();
        header("Location: batdau.php");
        exit();
    }
    require_once("../../../ket-noi-co-so-du-lieu.php");

    if(isset($_POST['thay-doi-so-luong'])) {
        $ten_sp = $_POST['ten_san_pham'];
        $ten_dn = $_POST['ten_dang_nhap'];
        $so_luong = $_POST['so_luong'];
        $gia_sp = $_POST['gia_san_pham'];
        $sql_update = "UPDATE dohang SET soluong = $so_luong , gia =  $so_luong * $gia_sp WHERE ten_san_pham = '$ten_sp' AND ten_dang_nhap = '$ten_dn'";
        mysqli_query($conn, $sql_update);
        header("Location: shop.php");
        exit();
    }

    if(isset($_POST['huy-don-hang'])) {
        $ten_sp = $_POST['ten_san_pham'];
        $ten_dn = $_POST['ten_dang_nhap'];
        $so_luong = $_POST['so_luong'];
        $sql_xoa_don_hang = "DELETE FROM dohang WHERE `dohang`.`ten_dang_nhap` = '$ten_dn' and `ten_san_pham` = '$ten_sp'";
        mysqli_query($conn, $sql_xoa_don_hang);
        $_SESSION['xoa-don-hang'] = "Xóa thành công đơn hàng " . $ten_sp . " với số lượng " . $so_luong;
        
        header("Location: shop.php");
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
    <title>Giỏ hàng</title>
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
                    <a href="llichsudathang.php">lịch sử đăt hàng</a>
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
                        $sql_so_luong_don_hang = "select * from dohang where ten_dang_nhap = '$ten_dang_nhap' and xacnhan = 'Chưa xác nhận'";  
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
                    <b><i class="fa-solid fa-shopping-cart cart-icon"></i>Giỏ hàng của bạn</b>
                </div>

                <div class="infoshop">
                    <div class="b"><b>Sản phẩm trong giỏ hàng</b></div>

                    <?php
                    require_once("../../../ket-noi-co-so-du-lieu.php");
                    $sql = "select * from dohang as dh inner join sanpham as sp on sp.ten = dh.ten_san_pham where ten_dang_nhap = '$_SESSION[ten_dang_nhap]' and xacnhan = 'chưa xác nhận'";  
                    $result = mysqli_query($conn, $sql);
                    $allmoney = 0;
                    if(mysqli_num_rows($result) < 1):
                        echo '<div class="empty-cart">
                            <i class="fa-solid fa-shopping-cart"></i>
                            <h3>Giỏ hàng trống</h3>
                            <p>Bạn chưa có sản phẩm nào trong giỏ hàng</p>
                            <a href="batdau.php">Tiếp tục mua sắm</a>
                        </div>';
                    else:
                        // Calculate total first
                        $temp_result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_assoc($temp_result)){
                            $allmoney += $row['gia'];
                        }
                    ?>
                    
                    <!-- Cart Table -->
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)):
                                $total_price = $row['gia'];
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
                                    <?php echo number_format($row['gia'] / $row['soluong']) ?> ₫
                                </td>
                                <td class="product-quantity" data-label="Số lượng">
                                    <form action="shop.php" method="post" class="quantity-form">
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
                                        
                                        <div class="quantity-input">
                                            <button type="button" class="quantity-btn" onclick="changeQuantity(this, -1)">-</button>
                                            <input type="number" name="so_luong" class="quantity" value="<?php echo $row['soluong'] ?>" min="1" max="20" readonly>
                                            <button type="button" class="quantity-btn" onclick="changeQuantity(this, 1)">+</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="product-total" data-label="Tổng">
                                    <?php echo number_format($total_price) ?> ₫
                                </td>
                                <td class="product-actions" data-label="Hành động">
                                    <div class="action-buttons">
                                        <button type="submit" form="quantity-form-<?php echo $row['ten_san_pham'] ?>" name="thay-doi-so-luong" class="update-btn">
                                            <i class="fa-solid fa-sync-alt"></i>
                                        </button>
                                        <button type="submit" form="quantity-form-<?php echo $row['ten_san_pham'] ?>" name="huy-don-hang" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');" class="remove-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- Hidden form for each product -->
                                    <form id="quantity-form-<?php echo $row['ten_san_pham'] ?>" action="shop.php" method="post" style="display: none;">
                                        <input type="hidden" name="ten_san_pham" value="<?php echo $row['ten_san_pham'] ?>">
                                        <input type="hidden" name="ten_dang_nhap" value="<?php echo $_SESSION['ten_dang_nhap'] ?>">
                                        <input type="hidden" name="gia_san_pham" value="<?php echo $gia_ban?>">
                                        <input type="hidden" name="so_luong" class="quantity-hidden" value="<?php echo $row['soluong'] ?>">
                                    </form>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <!-- Order Summary -->
                    <div class="order-summary">
                        <div class="summary-header">
                            <i class="fa-solid fa-receipt"></i> Thông tin đơn hàng
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Tổng tiền hàng:</span>
                            <span class="summary-value"><?php echo number_format($allmoney) ?> ₫</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Phí vận chuyển:</span>
                            <span class="summary-value">Tính ở trang thanh toán</span>
                        </div>
                        
                        <div class="summary-row">
                            <span class="summary-label">Tổng cộng:</span>
                            <span class="summary-total"><?php echo number_format($allmoney) ?> ₫</span>
                        </div>
                        
                        <div class="summary-info">
                            <ul>
                                <li><i class="fa-solid fa-truck"></i> Phí vận chuyển sẽ được tính ở trang thanh toán</li>
                                <li><i class="fa-solid fa-tag"></i> Bạn cũng có thể nhập mã giảm giá ở trang thanh toán</li>
                                <li><i class="fa-solid fa-shield-alt"></i> Đơn hàng được bảo vệ 100%</li>
                            </ul>
                        </div>
                        
                        <a href="thanhtoan.php?totalmoney=<?php echo $allmoney?>">
                            <button class="checkout-btn">
                                <i class="fa-solid fa-credit-card"></i> THANH TOÁN NGAY
                            </button>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <div class="noteoder">
                        <b><i class="fa-solid fa-sticky-note"></i> Ghi chú cho đơn hàng</b>
                        <div class="note">
                            <input type="text" placeholder="Nhập ghi chú cho đơn hàng của bạn...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Function to change quantity
        function changeQuantity(button, change) {
            const quantityInput = button.parentElement.querySelector('.quantity');
            const hiddenInput = button.closest('tr').querySelector('.quantity-hidden');
            let currentValue = parseInt(quantityInput.value);
            let newValue = currentValue + change;
            
            // Ensure quantity is between 1 and 20
            if (newValue < 1) newValue = 1;
            if (newValue > 20) newValue = 20;
            
            quantityInput.value = newValue;
            hiddenInput.value = newValue;
            
            // Update button states
            const minusBtn = button.parentElement.querySelector('.quantity-btn:first-child');
            const plusBtn = button.parentElement.querySelector('.quantity-btn:last-child');
            
            minusBtn.disabled = newValue <= 1;
            plusBtn.disabled = newValue >= 20;
        }
        
        // Initialize quantity buttons on page load
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInputs = document.querySelectorAll('.quantity');
            quantityInputs.forEach(input => {
                const value = parseInt(input.value);
                const minusBtn = input.parentElement.querySelector('.quantity-btn:first-child');
                const plusBtn = input.parentElement.querySelector('.quantity-btn:last-child');
                
                minusBtn.disabled = value <= 1;
                plusBtn.disabled = value >= 20;
            });
        });
    </script>
</body>
</html>
