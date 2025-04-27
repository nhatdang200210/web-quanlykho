-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 11, 2024 lúc 04:42 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `khodienmay_sql`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `tennv` varchar(30) NOT NULL,
  `manv` varchar(11) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `sdt` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `tennv`, `manv`, `diachi`, `sdt`, `username`, `password`, `admin_status`) VALUES
(1, 'ADMIN', '', '', 0, 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
(4, 'NV1', 'B1221', 'cần thơ', 12344444, 'nv1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(8, 'NV2', 'N002', 'cần thơ', 9982332, 'nv2@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cartdetail_nhap`
--

CREATE TABLE `tbl_cartdetail_nhap` (
  `id_cdt_nhap` int(11) NOT NULL,
  `tensanpham` varchar(200) NOT NULL,
  `gianhap` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `id_nhap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cartdetail_nhap`
--

INSERT INTO `tbl_cartdetail_nhap` (`id_cdt_nhap`, `tensanpham`, `gianhap`, `soluong`, `id_nhap`) VALUES
(41, 'Tủ Lạnh LG Inverter 266 Lít GV-B262PS', 6000000, 10, 29),
(42, 'Tủ Lạnh LG Inverter 508 Lít LFI50BLMAI', 31000000, 5, 29),
(43, 'Máy lạnh Toshiba Inverter 1 Hp RAS-H10E2KCVG-V', 9500000, 15, 30),
(44, 'Máy Giặt LG Inverter 9 Kg FB1209S6W', 5000000, 20, 31);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cartdetail_tam`
--

CREATE TABLE `tbl_cartdetail_tam` (
  `id_tam` int(11) NOT NULL,
  `tensanpham` varchar(100) NOT NULL,
  `gianhap` int(11) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cartdetail_xuat`
--

CREATE TABLE `tbl_cartdetail_xuat` (
  `id_cdt_xuat` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `soluong_xuat` int(11) NOT NULL,
  `id_xuat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cartdetail_xuat`
--

INSERT INTO `tbl_cartdetail_xuat` (`id_cdt_xuat`, `id_sanpham`, `soluong_xuat`, `id_xuat`) VALUES
(23, 46, 2, 15),
(24, 46, 2, 16),
(25, 46, 1, 17),
(26, 37, 1, 18),
(27, 42, 6, 19);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_danhmuc`
--

CREATE TABLE `tbl_danhmuc` (
  `id_danhmuc` int(11) NOT NULL,
  `tendanhmuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_danhmuc`
--

INSERT INTO `tbl_danhmuc` (`id_danhmuc`, `tendanhmuc`) VALUES
(21, 'Tivi'),
(22, 'Tủ lạnh, tủ đông'),
(23, 'Máy lạnh, quạt điều hoà'),
(24, 'Máy lọc nước'),
(25, 'Máy giặt, máy sấy'),
(26, 'Dụng cụ gia dụng'),
(30, 'Phụ kiện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_khachhang`
--

CREATE TABLE `tbl_khachhang` (
  `id_khachhang` int(11) NOT NULL,
  `tenkhachhang` varchar(50) NOT NULL,
  `sdt` int(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `diachi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_khachhang`
--

INSERT INTO `tbl_khachhang` (`id_khachhang`, `tenkhachhang`, `sdt`, `email`, `diachi`) VALUES
(7, 'Nguyễn Văn A', 98636232, 'nd7433@gmail.com', 'cần thơ, ninh kiều, đại học công nghệ kỹ thuật,'),
(8, 'Nguyễn Thị Màu', 237487432, 'mau@gmail.com', 'càn thơ , ninh kiều,'),
(9, 'Văn C', 98253647, 'c@cgmail.com', '123 ninh kiều cần thơ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_ncc`
--

CREATE TABLE `tbl_ncc` (
  `id_ncc` int(11) NOT NULL,
  `tenncc` varchar(100) NOT NULL,
  `email_ncc` varchar(50) NOT NULL,
  `sdt_ncc` int(11) NOT NULL,
  `diachi_ncc` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_ncc`
--

INSERT INTO `tbl_ncc` (`id_ncc`, `tenncc`, `email_ncc`, `sdt_ncc`, `diachi_ncc`) VALUES
(1, 'SAMSUNG', 'samsung@samsung.vn', 988333399, 'Hẻm 222, Phường Anh Khánh, Quận Ninh Kiều, TP Cần Thơ'),
(2, 'TOSIBA', 'tosiba@tosiba.vn', 3122, 'số 1, phan đình phùng, Ninh Kiều, TP. Cần Thơ'),
(4, 'SONY', 'sony@sony.vn', 9982332, 'càn thơ , ninh kiều,'),
(5, 'SHARP', 'sharp@sharp.vn', 9982332, 'Phường Anh Khánh, Quận Ninh Kiều, TP Cần Thơ'),
(6, 'LG', 'lg@lg.vn', 3208934, 'cần thơ, ninh kiều,');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_nhap`
--

CREATE TABLE `tbl_nhap` (
  `id_nhap` int(11) NOT NULL,
  `thoigian` date NOT NULL,
  `id_ncc` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `ten_nv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_nhap`
--

INSERT INTO `tbl_nhap` (`id_nhap`, `thoigian`, `id_ncc`, `trangthai`, `ten_nv`) VALUES
(29, '2024-11-01', 6, 1, 'NV1'),
(30, '2024-10-29', 2, 1, 'NV2'),
(31, '2024-10-31', 6, 1, 'NV2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `id_sanpham` int(11) NOT NULL,
  `tensanpham` varchar(100) NOT NULL,
  `soluong` int(11) NOT NULL,
  `giasanpham` int(11) NOT NULL,
  `giamua` int(11) NOT NULL,
  `id_danhmuc` int(11) NOT NULL,
  `avt` text NOT NULL,
  `id_ncc` int(11) NOT NULL,
  `tinhtrang` int(11) NOT NULL,
  `mota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`id_sanpham`, `tensanpham`, `soluong`, `giasanpham`, `giamua`, `id_danhmuc`, `avt`, `id_ncc`, `tinhtrang`, `mota`) VALUES
(34, 'Smart Tivi Samsung 4K UHD 55 Inch UA55AU7002', 20, 8990000, 8000000, 21, '1729526241_smart-tivi-sams_multi_8_127_1020.png.webp', 6, 1, '  Smart Tivi Samsung 4K UHD 55 Inch UA55AU7002 là siêu phẩm tivi sở hữu vẻ ngoài thời thượng và được trang bị nhiều công nghệ cao cấp của Samsung. Nếu đang tìm kiếm một thiết bị nghe nhìn hiện đại, vừa mang đến cho bạn những trải nghiệm giải trí đẳng cấp, đồng thời cũng có thể nâng cao tính thẩm mỹ trong không gian nội thất thì sản phẩm này sẽ là sự lựa chọn vô cùng phù hợp. '),
(35, 'Smart NanoCell Tivi LG 4K 55 Inch 55NANO76SQA', 33, 22900000, 20000000, 21, '1729526368_smart-nanocell-_multi_3_525_1020.png.webp', 4, 1, ' Nếu bạn đang tìm kiếm chiếc tivi vừa có thiết kế hiện đại lại mang đến trải nghiệm giải trí tuyệt vời nhờ hình ảnh sắc nét thì không thể bỏ qua Smart NanoCell Tivi LG 4K 55 Inch 55NANO76SQA. Sản phẩm này có nhiều ưu điểm nổi bật như vẻ ngoài đẹp mắt, hình ảnh hiển thị có độ phân giải 4K vượt trội, công nghệ hình ảnh và âm thanh tiên tiến,... hứa hẹn sẽ không làm người dùng thất vọng.'),
(36, 'Sony BRAVIA 3 LED 4K 55 Inch K-55S30', 9, 17500000, 16000000, 21, '1729526472_google-tivi-son_multi_0_425_1020.png.webp', 6, 1, ' Google Tivi Sony 4K 55 Inch K-55S30 là siêu phẩm tivi hiện đại được nhà sản xuất tích hợp nhiều tính năng thông minh, có thể mang lại cho mọi khách hàng trải nghiệm xem tiện lợi và thoải mái tại gia mỗi ngày. Tivi giúp bạn thưởng thức thế giới hình ảnh giàu chi tiết, màu sắc rực rỡ kết hợp cùng âm thanh sống động để phút giây thư giãn của bạn trở nên chất lượng hơn bao giờ hết.'),
(37, 'Tủ Lạnh Toshiba Inverter 325 Lít GR-RB410WE-PMV(37)-SG', 9, 8450000, 7000000, 22, '1729526643_tu-lanh-toshiba_main_727_1020.png (1).webp', 2, 1, 'Tủ Lạnh Toshiba Inverter 325 Lít GR-RB410WE-PMV(37)-SG hứa hẹn đem đến cho người dùng những trải nghiệm tuyệt vời nhất nhờ thiết kế hiện đại cùng hàng loạt các công nghệ được hãng trang bị nhu công nghệ khử khuẩn vượt trội, công nghệ làm lạnh đa chiều,...\r\nTủ Lạnh Toshiba Inverter 325 Lít GR-RB410WE-PMV(37)-SG mang bên mình màu xám Satin sang trọng, kết hợp cùng các đường nét vuông vức được chăm chút tỉ mỉ, mang đến vẻ đẹp sang trọng cho không gian bếp nhà bạn.'),
(38, 'Tủ Lạnh LG Inverter 470 Lít GR-B50BL', 10, 13990000, 12000000, 22, '1729526705_tu-lanh-lg-inve_main_32_1020.png.webp', 6, 1, ' Tủ Lạnh LG Inverter 470 Lít GR-B50BL là giải pháp tuyệt vời để bảo quản nhiều thực phẩm cho gia đình. Nhờ trang bị công nghệ Express Freeze mà tủ có thể cấp đông nhanh chóng cho toàn bộ thực phẩm, giúp giữ trọn hương vị tươi ngon vốn có. Đặc biệt với công nghệ Inverter, người dùng không cần phải lo lắng quá nhiều về chi phí điện hằng tháng khi sử dụng chiếc tủ lạnh LG này.'),
(39, 'Máy Giặt Toshiba Inverter 10.5 Kg TW-BL115A2V(SS)', 20, 6790000, 6000000, 25, '1729526971_may-giat-toshib_main_571_1020.png.webp', 2, 1, ' Máy giặt Toshiba Inverter 10.5 Kg TW-BL115A2V(SS) là một sản phẩm tiên tiến và đa chức năng trong lĩnh vực giặt giũ. Với thiết kế hiện đại và tính năng thông minh, máy giặt này mang lại nhiều lợi ích và tiện ích cho người dùng.'),
(41, 'Máy Sấy Thông Hơi Toshiba 7 Kg TD-H80SEV(SK)', 4, 5990000, 5000000, 25, '1729527284_may-say-thong-h_main_715_1020.png.webp', 2, 1, '  Máy sấy thông hơi Toshiba 7kg TD-H80SEV(SK) là sản phẩm thiết kế tối giản, hiện đại và đáng chú ý. Với nguồn cảm hứng từ lối sống tối giản, máy sấy này tạo nên một điểm nhấn hoàn hảo cho không gian sống của bạn. '),
(42, 'Máy lạnh Toshiba Inverter 1 Hp RAS-H10S4KCV2G-V', 10, 9100000, 8000000, 23, '1729527568_may-lanh-toshib_main_744_1020.png.webp', 2, 1, '  Máy lạnh Toshiba Inverter 1 Hp RAS-H10S4KCV2G-V với thiết kế nguyên khối sang trọng là sự kết hợp tinh tế giữa đường nét mềm mại và bề mặt sáng bóng, tạo nên điểm nhấn đẳng cấp cho không gian sống của bạn.\r\n\r\nVới công suất làm lạnh 1HP (tương đương 9.000 BTU), máy lạnh Toshiba Inverter đảm bảo đưa không gian của bạn về nhiệt độ thoải mái, đặc biệt phù hợp với các phòng có diện tích dưới 15m² (từ 30 đến 45m³) như phòng ngủ, phòng làm việc, phòng khách nhỏ,.. '),
(46, 'Máy Lạnh Samsung Inverter 1 Hp AR10DYHZAWKNSV', 4, 7790000, 6000000, 23, '1729570758_may-lanh-samsun_main_757_1020.png.webp', 1, 1, ' Máy Lạnh Samsung Inverter 1 Hp AR10DYHZAWKNSV có khả năng làm lạnh nhanh cho toàn căn phòng nhờ trang bị công nghệ Fast Cooling. Bên cạnh khả năng làm lạnh, máy còn có bộ lọc Easy Filter Plus hỗ trợ giữ lại những bụi bẩn lơ lửng trong không khí. Đặc biệt với công nghệ Digital Inverter Boost kết hợp cùng chế độ Eco lượng điện năng tiêu thụ của thiết bị được giảm đi đáng kể so với những động cơ truyền thống.\r\n\r\nMáy Lạnh Samsung Inverter 1 Hp AR10DYHZAWKNSV - Mang hơi lạnh dễ chịu đến toàn căn phòng\r\nKiểu dáng thanh lịch, phù hợp với nhiều không gian\r\nDàn lạnh\r\nMáy Lạnh Samsung Inverter 1 Hp AR10DYHZAWKNSV có kiểu dáng thon gọn đi cùng tông trắng chủ đạo nên phù hợp để lắp đặt trong nhiều không gian phòng. Các góc cạnh của máy đều được bo cong tinh tế giúp tổng thể thiết bị trở nên mềm mại và hài hòa hơn. Dàn lạnh chỉ nặng 7.7kg nên quá trình lắp đặt thiết bị trên cao cũng thuận tiện và dễ dàng.'),
(49, 'Tủ Lạnh LG Inverter 266 Lít GV-B262PS', 10, 0, 6000000, 0, '0', 6, 1, '0'),
(50, 'Tủ Lạnh LG Inverter 508 Lít LFI50BLMAI', 5, 0, 31000000, 0, '0', 6, 1, '0'),
(51, 'Máy lạnh Toshiba Inverter 1 Hp RAS-H10E2KCVG-V', 15, 0, 9500000, 0, '0', 2, 1, '0'),
(52, 'Máy Giặt LG Inverter 9 Kg FB1209S6W', 20, 0, 5000000, 0, '0', 6, 1, '0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_xuat`
--

CREATE TABLE `tbl_xuat` (
  `id_xuat` int(11) NOT NULL,
  `id_khachhang` int(11) NOT NULL,
  `trangthai` int(11) NOT NULL,
  `ngayxuat` date NOT NULL,
  `ten_nv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_xuat`
--

INSERT INTO `tbl_xuat` (`id_xuat`, `id_khachhang`, `trangthai`, `ngayxuat`, `ten_nv`) VALUES
(15, 9, 1, '2024-10-30', 'NV1'),
(16, 7, 1, '2024-11-01', 'NV2'),
(17, 7, 0, '2024-10-31', 'NV1'),
(18, 8, 1, '2024-10-28', 'NV2'),
(19, 9, 1, '2024-11-04', 'NV2');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_xuat_tam`
--

CREATE TABLE `tbl_xuat_tam` (
  `id_xuat_tam` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `tbl_cartdetail_nhap`
--
ALTER TABLE `tbl_cartdetail_nhap`
  ADD PRIMARY KEY (`id_cdt_nhap`),
  ADD KEY `id_nhap` (`id_nhap`);

--
-- Chỉ mục cho bảng `tbl_cartdetail_tam`
--
ALTER TABLE `tbl_cartdetail_tam`
  ADD PRIMARY KEY (`id_tam`);

--
-- Chỉ mục cho bảng `tbl_cartdetail_xuat`
--
ALTER TABLE `tbl_cartdetail_xuat`
  ADD PRIMARY KEY (`id_cdt_xuat`),
  ADD KEY `id_xuat` (`id_xuat`);

--
-- Chỉ mục cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Chỉ mục cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  ADD PRIMARY KEY (`id_khachhang`);

--
-- Chỉ mục cho bảng `tbl_ncc`
--
ALTER TABLE `tbl_ncc`
  ADD PRIMARY KEY (`id_ncc`);

--
-- Chỉ mục cho bảng `tbl_nhap`
--
ALTER TABLE `tbl_nhap`
  ADD PRIMARY KEY (`id_nhap`);

--
-- Chỉ mục cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`id_sanpham`),
  ADD KEY `id_danhmuc` (`id_danhmuc`);

--
-- Chỉ mục cho bảng `tbl_xuat`
--
ALTER TABLE `tbl_xuat`
  ADD PRIMARY KEY (`id_xuat`),
  ADD KEY `id_khachhang` (`id_khachhang`);

--
-- Chỉ mục cho bảng `tbl_xuat_tam`
--
ALTER TABLE `tbl_xuat_tam`
  ADD PRIMARY KEY (`id_xuat_tam`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_cartdetail_nhap`
--
ALTER TABLE `tbl_cartdetail_nhap`
  MODIFY `id_cdt_nhap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `tbl_cartdetail_tam`
--
ALTER TABLE `tbl_cartdetail_tam`
  MODIFY `id_tam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `tbl_cartdetail_xuat`
--
ALTER TABLE `tbl_cartdetail_xuat`
  MODIFY `id_cdt_xuat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  MODIFY `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `tbl_khachhang`
--
ALTER TABLE `tbl_khachhang`
  MODIFY `id_khachhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tbl_ncc`
--
ALTER TABLE `tbl_ncc`
  MODIFY `id_ncc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tbl_nhap`
--
ALTER TABLE `tbl_nhap`
  MODIFY `id_nhap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `id_sanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `tbl_xuat`
--
ALTER TABLE `tbl_xuat`
  MODIFY `id_xuat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `tbl_xuat_tam`
--
ALTER TABLE `tbl_xuat_tam`
  MODIFY `id_xuat_tam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cartdetail_nhap`
--
ALTER TABLE `tbl_cartdetail_nhap`
  ADD CONSTRAINT `tbl_cartdetail_nhap_ibfk_1` FOREIGN KEY (`id_nhap`) REFERENCES `tbl_nhap` (`id_nhap`);

--
-- Các ràng buộc cho bảng `tbl_cartdetail_xuat`
--
ALTER TABLE `tbl_cartdetail_xuat`
  ADD CONSTRAINT `tbl_cartdetail_xuat_ibfk_2` FOREIGN KEY (`id_xuat`) REFERENCES `tbl_xuat` (`id_xuat`);

--
-- Các ràng buộc cho bảng `tbl_xuat`
--
ALTER TABLE `tbl_xuat`
  ADD CONSTRAINT `tbl_xuat_ibfk_1` FOREIGN KEY (`id_khachhang`) REFERENCES `tbl_khachhang` (`id_khachhang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
