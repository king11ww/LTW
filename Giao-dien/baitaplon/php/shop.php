<?php
    session_start();
    if(isset($_GET['action']) && $_GET['action'] == 'logout')
    {
        session_destroy();
        header("Location: batdau.php");
        exit();
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
                    <b>Giỏ hàng của bạn</b>
                </div>

                <div class="infoshop">
                    <div class="b"><b>Sản phẩm trong giỏ hàng</b></div>

                    <div class="product-summary">
                                <?php
                                require_once("../../../ket-noi-co-so-du-lieu.php");
                                $sql = "select * from dohang as dh inner join sanpham as sp on sp.ten = dh.ten_san_pham where ten_dang_nhap = '$_SESSION[ten_dang_nhap]'";  
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
                                        <p>Tên nhãn hàngt: <?php echo $row['nhanhang'] ?></p>
                                    </div>
                                    <div class="money">
                                        <p>Giá: <?php echo $row['gia'] ?>vnđ</p>
                                        <label>Số Lượng:</label>
                                        <input type="number" class="quantity" value="<?php echo $row['soluong'] ?>" min="1">
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
                            <a href="../user_produrt/user.html">
                                <button class="pay">THANH TOÁN</button>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- Ghi chú đơn hàng -->
                    <div class="noteoder">
                        <b>Ghi chú cho đơn hàng</b>
                        <div class="note">
                            <input type="text" placeholder="Ghi chú cho đơn hàng">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footer_content">
                <div class="footer_menu">
                    <div class="footer_menu_st">
                        <h1><i class="fa-solid fa-glass-water"></i> MILK</h1>
                        <span>Các sản phẩm từ sữa cao cấp được giao tươi đến tận nhà bạn mỗi ngày.</span>
                    </div>
                    <div class="footer_menu_st">
                        <h2>Qick Links</h2>
                        <span><a href="#">Home</a></span>
                        <span><a href="#">Sản phẩm</a></span>
                        <span><a href="#">Thông tin</a></span>
                        <span><a href="#">Liên hệ</a></span>
                    </div>
                    <div class="footer_menu_st">
                        <h2>Các nhãn hàng</h2>
                        <span><a href="#">Vinamilk</a></span>
                        <span><a href="#">TH true MILK</a></span>
                        <span><a href="#">Nutifood</a></span>
                        <span><a href="#">Dutch Lady</a></span>
                    </div>
                    <div class="footer_menu_st">
                        <h2>Hãy là một thành viên của chúng tôi!</h2>
                        <span><a href="#">tham gia Tuyển dụng ngay</a></span>
                    </div>
                </div>
                <div class="footer_end">
                    <hr>
                    <h6>© 2025 Milk. All rights reserved.</h6>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
