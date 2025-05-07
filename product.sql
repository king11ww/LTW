-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 05:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product`
--

-- --------------------------------------------------------

--
-- Table structure for table `dohang`
--

CREATE TABLE `dohang` (
  `id` int(11) NOT NULL,
  `ten_dang_nhap` varchar(255) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `soluong` int(11) NOT NULL DEFAULT 1,
  `ten_san_pham` varchar(255) NOT NULL,
  `gia` int(11) NOT NULL,
  `xacnhan` varchar(255) NOT NULL DEFAULT 'chưa xác nhận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hangsua`
--

CREATE TABLE `hangsua` (
  `id` int(11) NOT NULL,
  `ten_hang_sua` varchar(255) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `dien_thoai` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `hangsua`
--

INSERT INTO `hangsua` (`id`, `ten_hang_sua`, `dia_chi`, `dien_thoai`, `email`) VALUES
(1, 'Vinamilk', '123 Nguyễn Du - Quận 1 - TP.HCM', '0999999999', 'vinamilk@vnm.com'),
(2, 'Nutifood', 'Khu công nghiệp Sóng Thần Bình Dương', '0888888888', 'nutifood@ntf.com'),
(3, 'Dutch Lady', 'Đà Nẵng', '0000888008', 'Dutch_Lady@gamil.vc'),
(4, 'TH true MILK', 'Đà Nẵng', '0000888090', 'TH_true_MILK@gamil.vc');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `id` int(11) NOT NULL,
  `ten_dang_nhap` varchar(255) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `gioi_tinh` varchar(5) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mat_khau` varchar(50) NOT NULL,
  `loai_tai_khoan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`id`, `ten_dang_nhap`, `ho_ten`, `gioi_tinh`, `dia_chi`, `so_dien_thoai`, `email`, `mat_khau`, `loai_tai_khoan`) VALUES
(4, 'admin', 'admin', '', 'admin', '', 'demo@gmail.com', 'admin', 'ADMIN'),
(8, 'demo', 'demos', 'Nam', '123d', '12343455', 'demo@gmail.comm', '123', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `nhanhang` varchar(225) NOT NULL,
  `giaban` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thanhphan` varchar(255) NOT NULL,
  `loinhuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `ten`, `nhanhang`, `giaban`, `image`, `thanhphan`, `loinhuan`) VALUES
(47, 'Sữa tươi tiệt trùng 100% Vinamilk 180ml (48 hộp/thùng)', 'Vinamilk', 422081, 'Sua_bot_Dielac_Grow_Plus_1+_800g.png', 'Sữa tươi (96%)<br>Đường (3,8%)<br>Chất ổn định (471, 460(i), 407, 466)<br>Vitamin A, D3<br>Khoáng chất (natri selenit)', 'Cung cấp năng lượng và dưỡng chất<br>Hỗ trợ phát triển xương và răng<br>Tăng cường hệ miễn dịch'),
(48, 'Sữa bột Dielac Grow Plus 1+ 800g', 'Vinamilk', 412854, 'Sua_bot_Dielac_Grow_Plus_1+_800g.png', 'Sữa bò tươi nguyên chất (99,7%)<br>Chất ổn định (471, 460(i), 407, 466)<br>Vitamin A, D3<br>Khoáng chất (natri selenit)', 'Không đường, phù hợp người ăn kiêng<br>Hỗ trợ tim mạch và kiểm soát cân nặng<br>Bổ sung canxi và vitamin D3'),
(49, 'Sữa bột Optimum Gold 2 800g', 'Vinamilk', 419000, 'Sua_bot_Dielac_Grow_Plus_1+_800g.png', 'Sữa tươi (97,1%)<br>Đường (2,7%)<br>Chất ổn định (471, 460(i), 407, 466)<br>Vitamin A, D3<br>Khoáng chất (natri selenit)', 'Ít đường hơn, phù hợp kiểm soát đường huyết<br>Cung cấp năng lượng và dưỡng chất<br>Tăng cường hệ miễn dịch'),
(50, 'Sữa bột Optimum Gold 3 850g', 'Vinamilk', 419000, 'Sua_bot_Dielac_Grow_Plus_1+_800g.png', 'Sữa tươi (93,9%)<br>Đường<br>Chất ổn định<br>Hương liệu (hương dâu)<br>Màu tự nhiên (120)<br>Vitamin A, D3<br>Khoáng chất (natri selenit)', 'Hương vị dâu thơm ngon, dễ uống<br>Hỗ trợ phát triển xương<br>Tăng cường hệ miễn dịch'),
(51, 'Sữa uống dinh dưỡng Yoko Gold 110ml (lốc 4 hộp)', 'Vinamilk', 120000, 'Sua_uong_dinh_duong_Yoko_Gold_110ml.png', 'Sữa tươi (93%)<br>Đường<br>Bột cacao (0,6%)<br>Chất ổn định<br>Hương liệu tổng hợp<br>Vitamin A, D3<br>Khoáng chất (natri selenit)', 'Hương vị socola hấp dẫn<br>Cung cấp năng lượng<br>Tăng cường hệ miễn dịch và phát triển thể chất'),
(52, 'Sữa uống dinh dưỡng Yoko Gold 180ml (lốc 4 hộp)', 'Vinamilk', 189000, 'Sua_uong_dinh_duong_Yoko_Gold_180ml.png', 'Sữa tươi tách béo (~95%)<br>Đường (~3,5%)<br>Chất ổn định<br>Vitamin A, D3<br>Khoáng chất (natri selenit)', 'Ít chất béo, phù hợp kiểm soát cân nặng<br>Vẫn đầy đủ dưỡng chất<br>Hỗ trợ miễn dịch và xương'),
(53, 'Sữa tươi tiệt trùng TH true MILK 110ml (48 hộp/thùng)', 'TH true MILK', 298800, 'Sua_tuoi_tiet_trung_TH_true_MILK_110ml.png', 'Sữa tươi sạch (96%)<br>Đường (3,8%)<br>Vitamin A, D, B1, B2<br>Canxi và khoáng chất thiết yếu', 'Cung cấp năng lượng và vitamin<br>Hỗ trợ hệ xương chắc khỏe<br>Tăng sức đề kháng cho cơ thể'),
(54, 'Sữa tươi tiệt trùng TH true MILK 180ml (48 hộp/thùng)', 'TH true MILK', 469200, 'Sua_tuoi_tiet_trung_TH_true_MILK_180ml.png', 'Sữa tươi sạch nguyên chất (99,8%)<br>Vitamin A, D<br>Không thêm đường<br>Không chất bảo quản', 'Tốt cho người ăn kiêng, tiểu đường<br>Bổ sung dưỡng chất từ sữa tự nhiên<br>Hỗ trợ xương và thị lực'),
(55, 'Sữa tươi tiệt trùng TH true MILK ít đường 180ml (lốc 4 hộp)', 'TH true MILK', 39100, 'Sua_tuoi_tiet_trung_TH_true_MILK_it_duong_180ml.png', 'Sữa tươi sạch (97%)<br>Đường (2,5%)<br>Vitamin A, D<br>Khoáng chất thiết yếu', 'Cân bằng vị ngọt<br>Tốt cho kiểm soát đường huyết<br>Tăng cường vitamin và khoáng chất'),
(56, 'Sữa công thức TH true FORMULA 110ml (lốc 4 hộp)', 'TH true MILK', 47520, 'Sua_cong_thuc_TH_true_FORMULA_110ml.png', 'Sữa tươi sạch (93%)<br>Đường<br>Hương liệu tự nhiên từ dâu<br>Vitamin A, D<br>Khoáng chất', 'Hương dâu thơm ngon dễ uống<br>Tăng cường năng lượng và miễn dịch<br>Phù hợp cho trẻ em'),
(57, 'Sữa công thức TH true FORMULA 180ml (lốc 4 hộp)', 'TH true MILK', 69908, 'Sua_cong_thuc_TH_true_FORMULA_180ml.png', 'Sữa tươi sạch (92%)<br>Đường<br>Bột cacao nguyên chất<br>Hương liệu tổng hợp<br>Vitamin A, D', 'Hương socola đậm đà<br>Cung cấp năng lượng<br>Tốt cho trí não và thể chất'),
(58, 'Sữa tươi tiệt trùng TH true MILK có đường 110ml (lốc 4 hộp)', 'TH true MILK', 24900, 'Sua_tuoi_tiet_trung_TH_true_MILK_co_duong_110ml.png', 'Sữa tươi sạch tách béo (~95%)<br>Đường<br>Vitamin A, D<br>Ít chất béo, không chất bảo quản', 'Tốt cho người kiểm soát cân nặng<br>Giữ nguyên dưỡng chất<br>Hỗ trợ miễn dịch và xương chắc khỏe'),
(59, 'Sữa dinh dưỡng pha sẵn Nuvi Grow 2+ 110ml (lốc 4 hộp)', 'Nutifood', 28000, 'Sua_dinh_duong_pha_san_Nuvi_Grow_2+_110ml.png', 'Sữa tươi (96%)<br>Đường<br>Chất ổn định<br>Vitamin A, D, B1, B2<br>Khoáng chất (canxi, kali)', 'Cung cấp năng lượng cho ngày mới<br>Giúp xương và răng chắc khỏe<br>Tốt cho thị lực và miễn dịch'),
(60, 'Sữa dinh dưỡng pha sẵn Nuvi Grow 1+ 110ml (lốc 4 hộp)', 'Nutifood', 28000, 'Sua_dinh_duong_pha_san_Nuvi_Grow_1+_110ml.png', 'Sữa tươi (99%)<br>Không đường<br>Vitamin A, D<br>Không chất bảo quản', 'Phù hợp người ăn kiêng<br>Bổ sung dưỡng chất tự nhiên từ sữa<br>Tốt cho tim mạch và kiểm soát đường huyết'),
(61, 'Sữa bột GrowPLUS+ Boosting Digestion 2+ 800g', 'Nutifood', 475000, 'Sua_bot_GrowPLUS+_Boosting_Digestion_2+_800g.png', 'Sữa tươi (97%)<br>Ít đường<br>Vitamin A, D, B1<br>Khoáng chất tự nhiên', 'Cân bằng vị ngọt<br>Giúp kiểm soát lượng đường hấp thụ<br>Giữ gìn vóc dáng và sức khỏe'),
(62, 'Sữa bột GrowPLUS+ Boosting Digestion 1+ 800g', 'Nutifood', 495000, 'Sua_bot_GrowPLUS+_Boosting_Digestion_1+_800g.png', 'Sữa tươi (93%)<br>Đường<br>Hương liệu dâu tự nhiên<br>Vitamin A, D<br>Chất ổn định', 'Hương dâu hấp dẫn, dễ uống cho trẻ nhỏ<br>Bổ sung năng lượng và dưỡng chất<br>Giúp phát triển trí tuệ'),
(63, 'Sữa tươi tiệt trùng Dutch Lady có đường 110ml (48 hộp/thùng)', 'Dutch Lady', 215000, 'Sua_tuoi_tiet_trung_Dutch_Lady_co_duong_110ml.png', 'Sữa tươi (92%)<br>Đường<br>Bột cacao<br>Hương socola<br>Vitamin A, D<br>Khoáng chất thiết yếu', 'Ngon miệng với vị socola<br>Tăng cường trí não<br>Giúp học sinh năng động hơn'),
(64, 'Sữa tươi tiệt trùng Dutch Lady có đường 180ml (48 hộp/thùng)', 'Dutch Lady', 320000, 'Sua_tuoi_tiet_trung_Dutch_Lady_co_duong_180ml.png', 'Sữa tươi tách béo<br>Đường (vừa phải)<br>Vitamin A, D<br>Không chất bảo quản', 'Hàm lượng chất béo thấp<br>Phù hợp người ăn uống lành mạnh<br>Vẫn đảm bảo dưỡng chất cần thiết'),
(65, 'Sữa tươi tiệt trùng Dutch Lady không đường 180ml (48 hộp/thùng)', 'Dutch Lady', 320000, 'Sua_tuoi_tiet_trung_Dutch_Lady_khong_duong_180ml.png', 'Sữa tươi (95%)<br>Đường<br>Canxi, vitamin A, D<br>Khoáng chất (phốt pho, kali)', 'Cung cấp năng lượng và canxi<br>Giúp bé phát triển chiều cao<br>Tăng cường sức đề kháng'),
(66, 'Sữa tươi tiệt trùng Dutch Lady có đường 220ml (48 bịch/thùng)', 'Dutch Lady', 320000, 'Sua_tuoi_tiet_trung_Dutch_Lady_co_duong_220ml.png', 'Sữa tươi nguyên chất (99%)<br>Vitamin A, D<br>Không chất tạo ngọt<br>Không chất bảo quản', 'Tốt cho người tiểu đường hoặc ăn kiêng<br>Duy trì xương chắc khỏe<br>Hỗ trợ hệ miễn dịch'),
(67, 'Sữa tươi tiệt trùng Dutch Lady không đường 220ml (48 bịch/thùng)', 'Dutch Lady', 320000, 'Sua_tuoi_tiet_trung_Dutch_Lady_khong_duong_220ml.png', 'Sữa tươi (97%)<br>Ít đường<br>Vitamin A, D, B1<br>Khoáng chất thiết yếu', 'Cân bằng vị ngon và lành mạnh<br>Giúp kiểm soát cân nặng<br>Tốt cho hệ tiêu hóa'),
(68, 'Sữa tươi tiệt trùng Dutch Lady có đường 1 lít (12 hộp/thùng)', 'Dutch Lady', 360000, 'Sua_tuoi_tiet_trung_Dutch_Lady_co_duong_1_lit.png', 'Sữa tươi (93%)<br>Đường<br>Hương dâu tự nhiên<br>Vitamin A, D<br>Không phẩm màu tổng hợp', 'Hương vị socola hấp dẫn<br>Giúp cải thiện trí nhớ và sự tập trung<br>Bổ sung năng lượng nhanh chóng'),
(69, 'Sữa tươi tiệt trùng Dutch Lady không đường 1 lít (12 hộp/thùng)', 'Dutch Lady', 360000, 'Sua_tuoi_tiet_trung_Dutch_Lady_khong_duong_1_lit.png', 'Sữa tươi tách béo (~94%)<br>Đường<br>Vitamin A, D<br>Chất ổn định tự nhiên', 'Tốt cho người lớn tuổi hoặc ăn kiêng<br>Giúp duy trì sức khỏe tim mạch<br>Ít béo nhưng giàu dưỡng chất');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dohang`
--
ALTER TABLE `dohang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hangsua`
--
ALTER TABLE `hangsua`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`ten`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dohang`
--
ALTER TABLE `dohang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hangsua`
--
ALTER TABLE `hangsua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
