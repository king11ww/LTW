<?php
    session_start();
    if(isset($_GET['action']) && $_GET['action'] == 'logout')
    {
        session_destroy();
        exit();
    }
    if (isset($_POST['them_gio_hang'])) {
        if(!isset($_SESSION['ten_dang_nhap']))
        {
            echo "<script> alert('Bạn chưa đăng nhập hoặc đăng kí')</script>";
        }
        else
        {  
            require_once("../../../ket-noi-co-so-du-lieu.php");
            $ten_dang_nhap = $_SESSION['ten_dang_nhap'];
            $ho_ten = $_SESSION['ho_ten'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia_ban = $_POST['gia_ban'];
            $sql_shop = "select * from dohang where ten_dang_nhap = '$ten_dang_nhap' and ten_san_pham = '$ten_san_pham'";
            $kq_shop = mysqli_query($conn, $sql_shop);
            if(mysqli_num_rows($kq_shop) == 0):
                $sql_insert = "INSERT INTO dohang(ten_dang_nhap,ho_ten, soluong, ten_san_pham, gia, xacnhan) VALUES ('$ten_dang_nhap','$ho_ten', '1' ,'$ten_san_pham', '$gia_ban', '0')";
                $kq_insert = mysqli_query($conn, $sql_insert);
            else:
                $sql_update = "update dohang set soluong = soluong + 1 where ten_dang_nhap = '$ten_dang_nhap' and ten_san_pham = '$ten_san_pham'";
                $kq_update = mysqli_query($conn, $sql_update);
                $sql_update = "update dohang set gia = '$gia_ban' * soluong";
                $kq_update = mysqli_query($conn, $sql_update);
            endif;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/batdau.css">
    <link rel="stylesheet" href="../css/header_footer.css">
    <script src="https://kit.fontawesome.com/bb6c8d9b87.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
		require_once("../../../ket-noi-co-so-du-lieu.php"); // ..(1) out ra php ..(2) out ra baitaplon ..(3) out ra Giao-dien
		$sql = "select * from sanpham";
		$kq = mysqli_query($conn, $sql); //Go
	?>
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
                        $sql_so_luong_don_hang = "select * from dohang where ten_dang_nhap = '$_SESSION[ten_dang_nhap]'";  
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
        <div class="maincontent">
            <div class="products">
                <div class="products_head">
                    <p>
                        <span>Sản phẩm của chúng tôi</span>
                        <i>Khám phá các sản phẩm từ sữa tươi của chúng tôi, nguồn gốc và thông tin rõ ràng.</i>
                    </p>
                </div>
                <div class="products_maincontent">
                    <input type="search" placeholder="Tìm kiếm sản phẩm...">
                    <div class="products_product">
                        <?php
                            while($row = mysqli_fetch_assoc($kq)){
                        ?>
                        <div class="product">
                            <div class="product_img"><img src="../img/<?php echo $row['image'] ?>" alt="demo"></div>
                            <div class="product_info">
                               <p>
                                    <span><?php echo $row["ten"] ?></span>
                                    <span><?php echo $row["giaban"] ?>vnđ</span>
                                    <div class="mota">
                                        <i>Mô tả
                                            <div class="cuasomota">
                                                <p>
                                                    <span>ten nha san xuat: <?php echo $row["nhanhang"] ?></span>
                                                </p>
                                            </div>
                                        </i>
                                    </div>
                                </p>
                            </div>
                            <div class="button_add_card">
                                <form method="post">
                                    <input type="hidden" name="ten_san_pham" value = "<?php echo $row['ten']?>">
                                    <input type="hidden" name="gia_ban" value = "<?php echo $row['giaban']?>">
                                    <button type="submit" name="them_gio_hang"><i class="fa-solid fa-cart-shopping"></i><span> Thêm vào giỏ hàng</span></button>
                                </form>
                            </div>
                        </div>
                        <?php
                            }
                            mysqli_close($conn);
                        ?>
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