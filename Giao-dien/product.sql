-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 08:56 AM
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
  `gia` int(11) NOT NULL
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
(2, 'Nutifood', 'Khu công nghiệp Sóng Thần Bình Dương', '0888888888', 'nutifood@ntf.com');

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
(3, 'demo', 'demo', 'Nữ', 'demo', 'demo', 'demo@gmail.com', 'demo', 'USER'),
(4, 'admin', 'admin', '', 'admin', '', 'admin', 'admin', 'ADMIN'),
(5, 'test', 'test', 'Nữ', 'test', '0123456789', 'test@gmail.com', 'ahihi', 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `nhanhang` varchar(225) NOT NULL,
  `giaban` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `ten`, `nhanhang`, `giaban`, `image`) VALUES
(47, 'Sữa tươi tiệt trùng 100% Vinamilk 180ml (48 hộp/thùng)', 'Vinamilk', 422081, 'Sua_tuoi_tiet_trung_100%_Vinamilk_180ml.png'),
(48, 'Sữa bột Dielac Grow Plus 1+ 800g', 'Vinamilk', 412854, 'Sua_bot_Dielac_Grow_Plus_1+_800g.png'),
(49, 'Sữa bột Optimum Gold 2 800g', 'Vinamilk', 419000, 'Sua_bot_Optimum_Gold_2_800g.png'),
(50, 'Sữa bột Optimum Gold 3 850g', 'Vinamilk', 419000, 'Sua_bot_Optimum_Gold_3_850g.png'),
(51, 'Sữa uống dinh dưỡng Yoko Gold 110ml (lốc 4 hộp)', 'Vinamilk', 120000, 'Sua_uong_dinh_duong_Yoko_Gold_110ml.png'),
(52, 'Sữa uống dinh dưỡng Yoko Gold 180ml (lốc 4 hộp)', 'Vinamilk', 189000, 'Sua_uong_dinh_duong_Yoko_Gold_180ml.png'),
(53, 'Sữa tươi tiệt trùng TH true MILK 110ml (48 hộp/thùng)', 'TH true MILK', 298800, 'Sua_tuoi_tiet_trung_TH_true_MILK_110ml.png'),
(54, 'Sữa tươi tiệt trùng TH true MILK 180ml (48 hộp/thùng)', 'TH true MILK', 469200, 'Sua_tuoi_tiet_trung_TH_true_MILK_180ml.png'),
(55, 'Sữa tươi tiệt trùng TH true MILK ít đường 180ml (lốc 4 hộp)', 'TH true MILK', 39100, 'Sua_tuoi_tiet_trung_TH_true_MILK_it_duong_180ml.png'),
(56, 'Sữa công thức TH true FORMULA 110ml (lốc 4 hộp)', 'TH true MILK', 47520, 'Sua_cong_thuc_TH_true_FORMULA_110ml.png'),
(57, 'Sữa công thức TH true FORMULA 180ml (lốc 4 hộp)', 'TH true MILK', 69908, 'Sua_cong_thuc_TH_true_FORMULA_180ml.png'),
(58, 'Sữa tươi tiệt trùng TH true MILK có đường 110ml (lốc 4 hộp)', 'TH true MILK', 24900, 'Sua_tuoi_tiet_trung_TH_true_MILK_co_duong_110ml.png'),
(59, 'Sữa dinh dưỡng pha sẵn Nuvi Grow 2+ 110ml (lốc 4 hộp)', 'Nutifood', 28000, 'Sua_dinh_duong_pha_san_Nuvi_Grow_2+_110ml.png'),
(60, 'Sữa dinh dưỡng pha sẵn Nuvi Grow 1+ 110ml (lốc 4 hộp)', 'Nutifood', 28000, 'Sua_dinh_duong_pha_san_Nuvi_Grow_1+_110ml.png'),
(61, 'Sữa bột GrowPLUS+ Boosting Digestion 2+ 800g', 'Nutifood', 475000, 'Sua_bot_GrowPLUS+_Boosting_Digestion_2+_800g.png'),
(62, 'Sữa bột GrowPLUS+ Boosting Digestion 1+ 800g', 'Nutifood', 495000, 'Sua_bot_GrowPLUS+_Boosting_Digestion_1+_800g.png'),
(63, 'Sữa tươi tiệt trùng Dutch Lady có đường 110ml (48 hộp/thùng)', 'Dutch Lady', 215000, 'Sua_tuoi_tiet_trung_Dutch_Lady_co_duong_110ml.png'),
(64, 'Sữa tươi tiệt trùng Dutch Lady có đường 180ml (48 hộp/thùng)', 'Dutch Lady', 320000, 'Sua_tuoi_tiet_trung_Dutch_Lady_co_duong_180ml.png'),
(65, 'Sữa tươi tiệt trùng Dutch Lady không đường 180ml (48 hộp/thùng)', 'Dutch Lady', 320000, 'Sua_tuoi_tiet_trung_Dutch_Lady_khong_duong_180ml.png'),
(66, 'Sữa tươi tiệt trùng Dutch Lady có đường 220ml (48 bịch/thùng)', 'Dutch Lady', 320000, 'Sua_tuoi_tiet_trung_Dutch_Lady_co_duong_220ml.png'),
(67, 'Sữa tươi tiệt trùng Dutch Lady không đường 220ml (48 bịch/thùng)', 'Dutch Lady', 320000, 'Sua_tuoi_tiet_trung_Dutch_Lady_khong_duong_220ml.png'),
(68, 'Sữa tươi tiệt trùng Dutch Lady có đường 1 lít (12 hộp/thùng)', 'Dutch Lady', 360000, 'Sua_tuoi_tiet_trung_Dutch_Lady_co_duong_1_lit.png'),
(69, 'Sữa tươi tiệt trùng Dutch Lady không đường 1 lít (12 hộp/thùng)', 'Dutch Lady', 360000, 'Sua_tuoi_tiet_trung_Dutch_Lady_khong_duong_1_lit.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dohang`
--
ALTER TABLE `dohang`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
