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
                    <b>Giỏ hàng của bạn</b>
                </div>

                <div class="infoshop">
                    <div class="b"><b>Sản phẩm trong giỏ hàng</b></div>

                    <div class="product-summary">
                                <?php
                                require_once("../../../ket-noi-co-so-du-lieu.php");
                                $sql = "select * from dohang as dh inner join sanpham as sp on sp.ten = dh.ten_san_pham where ten_dang_nhap = '$_SESSION[ten_dang_nhap]' and xacnhan = 'chưa xác nhận'";  
                                $result = mysqli_query($conn, $sql);
                                $allmoney = 0;
                                if(mysqli_num_rows($result) < 1):
                                    echo "<h1 style='text-align: center;color: white;width: 100%;'>Không có đơn hàng<h1>";
                                else:    
                            ?>
                        <div class="inshop">
                            <?php
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            
                            <div class="info">
                                <b class="product-info">Thông tin sản phẩm</b>
                                <div class="setting-photo">
                                    <div class="image-container">
                                        <img src="../img/<?php echo $row['image']?>" alt="Sản phẩm">
                                    </div>
                                    <div class="infophoto">
                                        <b><?php echo $row['ten_san_pham'] ?></b>
                                        <p>Tên nhãn hàng: <?php echo $row['nhanhang'] ?></p>
                                    </div>
                                    <div class="money">
                                    <form action="shop.php" method="post">
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
                                        <p>Giá: <?php echo $row['gia'] ?>vnđ</p>
                                        <label>Số Lượng:</label>
                                        <input type="number" name="so_luong" class="quantity" value="<?php echo $row['soluong'] ?>" min="1" max ="20">
                                        
                                        <button type="submit" name="thay-doi-so-luong">Thay đổi số lượng</button>
                                        <button type="submit" name="huy-don-hang" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">Hủy đơn hàng</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $allmoney += $row['gia'];
                                }    
                                endif;
                            ?>
                        </div>
                        <?php 
                            if($allmoney > 0):
                        ?>
                        <div class="howmany">
                            <b class="infomany">Thông tin đơn hàng</b>
                            <div class="summoney">
                                <b>Tổng tiền:</b> <span class="many"><?php echo $allmoney ?> ₫</span>
                            </div>
                            <ul class="runmoney">
                                <li>Phí vận chuyển sẽ được tính ở trang thanh toán.</li>
                                <li>Bạn cũng có thể nhập mã giảm giá ở trang thanh toán.</li>
                            </ul>
                            <a href="thanhtoan.php?totalmoney=<?php echo $allmoney?>">
                                <button class="pay">THANH TOÁN</button>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="noteoder">
                        <b>Ghi chú cho đơn hàng</b>
                        <div class="note">
                            <input type="text" placeholder="Ghi chú cho đơn hàng">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
