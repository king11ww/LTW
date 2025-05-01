<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="shop.css">
    <link rel="stylesheet" href="header_footer.css">
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
                    <a href="batdau.php">Sản Phẩm</a>
                </div>
                <div class="chose">
                    <a href="batdau.php">Thông tin</a>
                </div>
                <div class="chose">
                    <a href="batdau.php">Liên hệ</a>
                </div>
            </div>
            <div class="user">
                <a href="../user_produrt/user.html">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
            <div class="shopcart">
                <a href="#">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <div class="shopcart_value">1</div>
                </a>
            </div>
        </div>
        <div class="header1">
            <div class="shopcontent">
                <div class="yourshop">
                    <b>Giỏ hàng của bạn</b>
                </div>

                <div class="infoshop">
                    <div class="b"><b>Sản phẩm trong giỏ hàng</b></div>

                    <div class="product-summary">
                        <div class="inshop">
                            <div class="info">
                                <b class="product-info">Thông tin sản phẩm</b>
                                <div class="setting-photo">
                                    <div class="image-container">
                                        <img src="https://www.thmilk.vn/wp-content/uploads/2019/11/nguyen-chat-1L-2024-1.jpg" alt="Sản phẩm">
                                    </div>
                                    <div class="infophoto">
                                        <b>Sữa Tươi Tiệt Trùng Nguyên Chất TH true MILK 1 L</b>
                                        <p>Quy cách đóng gói: hộp giấy</p>
                                        <p>Dung tích: 1 lít</p>
                                    </div>
                                    <div class="money">
                                        <p>Giá: 41.600 ₫</p>
                                        <label>Số Lượng:</label>
                                        <input type="number" class="quantity" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin đơn hàng -->
                        <div class="howmany">
                            <b class="infomany">Thông tin đơn hàng</b>
                            <div class="summoney">
                                <b>Tổng tiền:</b> <span class="many">41.600 ₫</span>
                            </div>
                            <ul class="runmoney">
                                <li>Phí vận chuyển sẽ được tính ở trang thanh toán.</li>
                                <li>Bạn cũng có thể nhập mã giảm giá ở trang thanh toán.</li>
                            </ul>
                            <a href="../user_produrt/user.html">
                                <button class="pay">THANH TOÁN</button>
                            </a>
                            
                        </div>
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
