<?php 
    session_start();
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
		$sql = "select * from sanpham where nhanhang = 'Vinamilk'";
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
                <a href="user.php">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
            <div class="shopcart">
                <a href="shop.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <div class="shopcart_value">1</div>
                </a>
            </div>
            <?php else: ?>
            <div class="user">
                <a href="../../../@ADMIN@USER/@dang-nhap@dang-ki/dang-nhap.php">Đăng nhập</a> |
                <a href="../../../@ADMIN@USER/@dang-nhap@dang-ki/dang-ki.php" >Đăng ký</a>
            </div>
            <?php endif; ?>

        </div>
        <div class="maincontent">
            <div class="home">
                <div class="home_content">
                    <p>
                        <span style="color: black;">Shop sữa tươi</span>
                        <span style="color: #fff;">hàng trong ngày</span>
                        <i>Trải nghiệm sự phong phú và tinh khiết của các sản phẩm sữa cao cấp của chúng tôi, được lấy trực tiếp từ các nhãn hàng uy tín đến tận nhà bạn.</i>    
                    </p>
                </div>
                <div class="home_img">
                    <img src="" alt="">
                </div>
            </div>
            <div class="products">
                <div class="products_head">
                    <p>
                        <span>Sản phẩm của chúng tôi</span>
                        <i>Khám phá các sản phẩm từ sữa tươi của chúng tôi, được sản xuất cẩn thận từ trang trại đến bàn ăn.</i>
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
                                <button><i class="fa-solid fa-cart-shopping"></i><span> Thêm vào giỏ hàng</span></button>
                            </div>
                        </div>
                        <?php
                            }
                            mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
            <div class="about">
                <div class="about_head">
                    <p>
                        <span>Về chúng tôi</span>
                        <i>Với hơn 15 năm kinh nghiệm trong lĩnh vực phân phối sữa, chúng tôi mang đến cho bạn những sản phẩm sữa chất lượng tốt nhất trên thị trường với giá cả hợp lý dịch vụ tận tình nhất.</i>
                    </p>
                </div>
                <div class="about_contents">
                    <div class="about_contents_img">
                        <img src="" alt="">
                    </div>
                    <div class="about_contents_content">
                            <span>Triết lý từ trang trại đến bàn ăn</span>
                            <i>Tại Milk, chúng tôi tin vào tầm quan trọng của việc biết thực phẩm của bạn đến từ đâu. Triết lý từ nông trại đến bàn ăn của chúng tôi đảm bảo rằng từng giọt sữa đến tay bạn ở dạng tinh khiết nhất, giữ nguyên mọi dưỡng chất và lợi ích tự nhiên.</i>
                            <i>Chúng tôi làm việc trực tiếp với những người nông dân địa phương có chung niềm đam mê với các hoạt động canh tác có đạo đức và phúc lợi động vật, tạo ra một hệ sinh thái bền vững mang lại lợi ích cho tất cả mọi người, từ người nông dân đến người tiêu dùng.</i>
                    </div>
                </div>
                <div class="about_spe">
                    <div class="about_spe_impo">
                            <h2><i class="fa-solid fa-glass-water"></i></h2>
                            <span>Chất lượng của từng trang trại,nguồn hàng</span>
                            <i>Sữa của chúng tôi được lấy trực tiếp từ các nguồn hàng với trang trại an toàn và những chú bò ăn cỏ hạnh phúc.</i>
                    </div>
                    <div class="about_spe_impo">
                            <h2><i class="fa-regular fa-circle-check"></i></h2>
                            <span>100% đảm bảo nguồn hàng chất lượng, Tự nhiên</span>
                            <i>Không có chất bảo quản hoặc phụ gia, chỉ có sữa tự nhiên nguyên chất</i>
                    </div>
                    <div class="about_spe_impo">
                            <h2><i class="fa-solid fa-box"></i></h2>
                            <span>Giao hàng nhanh chóng, tiện lợi và đảm bảo</span>
                            <i>Sản phẩm tươi ngon được giao đến tận nhà bạn nhanh chóng với dịch vụ tận tâm và tiện lợi.</i>
                    </div>
                </div>
            </div>
            <div class="contract">
                <div class="contract_head">
                    <span>Liên hệ với chúng tôi</span>
                    <i>Bạn có thắc mắc hoặc có ý kiến đóng góp? <br>Hãy liên hệ với chúng tôi và chúng tôi sẽ sẵng lòng hỗ trợ.</i>
                </div>
                <div class="askandinfo">
                    <div class="askandinfo_form">
                        <form action="info_user">
                            <label for="txtName">Tên</label>
                            <input type="text" name="txtName" placeholder="Họ và tên">
                            <label for="txtEmail">Email</label>
                            <input type="email" name="txtEmail" placeholder="Email@gmail.com">
                            <label for="txtMessage">Lời nhắn</label>
                            <input type="text" name="txtMessage" placeholder="lời nhắn">
                            <button>Gửi</button>
                        </form>
                    </div>
                    <div class="askandifo_info">
                        <h2>Liên hệ với chúng tôi</h2>
                        <p>
                            <h3><i class="fa-solid fa-location-dot"></i> Địa chỉ</h3>
                            <span>XX Khuê Trung, Cẩm Lệ, TP.Đà Nẵng</span>
                        </p>
                        <p>
                            <h3><i class="fa-solid fa-envelope"></i> Email</h3>
                            <span>honguyenkhoi2710@gmail.com</span>
                        </p>
                        <p>
                            <h3><i class="fa-solid fa-phone"></i> Phone</h3>
                            <span>-0867601269</span>
                        </p>
                        <h3><span>Chúng tôi luôn sẵng sàng 24/24</span></h3>
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
                        <span><a href="batdau.php">Home</a></span>
                        <span><a href="sanpham.php">Sản phẩm</a></span>
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