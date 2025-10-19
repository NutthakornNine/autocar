-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2025 at 11:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aurocar`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cars`
--

CREATE TABLE `Cars` (
  `car_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `car_type` varchar(100) NOT NULL,
  `car_brand` varchar(100) NOT NULL,
  `car_model` varchar(100) NOT NULL,
  `car_color` varchar(50) NOT NULL,
  `license_plate` varchar(20) NOT NULL,
  `seats` int(10) NOT NULL,
  `fuelsystem` varchar(50) NOT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `car_status` int(1) NOT NULL,
  `province_id` int(11) NOT NULL,
  `car_image` text DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Cars`
--

INSERT INTO `Cars` (`car_id`, `owner_id`, `car_type`, `car_brand`, `car_model`, `car_color`, `license_plate`, `seats`, `fuelsystem`, `price_per_day`, `car_status`, `province_id`, `car_image`, `create_at`) VALUES
(22, 27, 'Sedan', 'toyota', 'camry', 'ดำ', 'กก 102', 6, 'Diesel', 6000.00, 1, 1, '68f3c326c41d2.jpg,68f3c326c431e.jpg,68f3c326c43e3.jpeg,68f3c326c44a9.jpeg,68f3c326c4570.jpeg,68f3c326c462a.jpeg,68f3c326c46d8.jpeg,68f3c326c4794.jpeg', '2025-07-30 23:41:10'),
(23, 27, 'SUV', 'Toyota ', 'cross', 'เทา', 'กก 103', 7, 'Electric', 899.00, 1, 1, '68f3c3d211a42.jpeg,68f3c3d211d40.jpeg,68f3c3d211ef5.jpeg,68f3c3d211fb5.jpeg,68f3c3d212074.jpeg,68f3c3d212220.jpeg', '2025-07-22 23:44:02'),
(24, 28, 'Pickup', 'FORD', 'RANGER', 'น้ำเงิน', 'กร 191', 7, 'Diesel', 788.00, 0, 2, '68f3c4ffe8541.jpeg,68f3c4ffe89e9.jpeg,68f3c4ffe8b21.jpg,68f3c4ffe8c4b.jpeg,68f3c4ffe8d83.jpeg,68f3c4ffe8e6e.jpeg', '2025-07-09 23:49:03'),
(25, 28, 'Sedan', 'honda', 'civic', 'เทา', 'กร 192', 5, 'Benzine', 899.00, 1, 2, '68f3c595d294d.jpg,68f3c595d2f68.jpg,68f3c595d2fc3.jpg,68f3c595d3018.jpg,68f3c595d3070.jpeg', '2025-07-02 23:51:33'),
(28, 27, 'Sedan', 'BMW', '320d', 'ดำ', 'กก 2334', 5, 'Hybrid', 2999.00, 1, 3, '68f4a82b01e89.jpg,68f4a82b04f86.jpg,68f4a82b04ff4.jpg,68f4a82b05055.jpg,68f4a82b050b6.jpeg,68f4a82b05115.jpeg,68f4a82b05169.jpeg,68f4a82b051be.jpeg,68f4a82b05211.jpeg,68f4a82b0526f.jpeg', '2025-10-19 15:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

CREATE TABLE `reserved` (
  `reserved_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `slip` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `pay` int(11) NOT NULL DEFAULT 0,
  `pay_type` varchar(50) NOT NULL,
  `is_return` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`reserved_id`, `user_id`, `car_id`, `date_time`, `start_date`, `end_date`, `slip`, `status`, `pay`, `pay_type`, `is_return`) VALUES
(45, 30, 24, '2025-09-08 00:15:23', '2025-09-08', '2025-09-11', '68f3cb2ba090b.JPG', 1, 1, 'transfer', 1),
(46, 30, 25, '2025-09-02 00:15:49', '2025-09-02', '2025-09-05', '68f3cb4559113.JPG', 1, 1, 'transfer', 1),
(47, 30, 26, '2025-09-22 00:16:14', '2025-09-22', '2025-09-30', '68f3cb5eb6aaf.JPG', 1, 1, 'qrcode', 1),
(48, 29, 21, '2025-10-01 00:17:21', '2025-10-01', '2025-10-09', '68f3cba11797e.JPG', 1, 1, 'qrcode', 1),
(49, 29, 22, '2025-10-08 00:17:43', '2025-10-08', '2025-10-10', '68f3cbb7dedae.JPG', 1, 1, 'transfer', 1),
(50, 29, 23, '2025-10-14 00:18:03', '2025-10-14', '2025-10-17', '68f3cbcb32b4a.JPG', 1, 1, 'transfer', 1),
(51, 30, 22, '2025-10-19 15:39:17', '2025-10-10', '2025-10-24', '68f4a3b5c2b3d.JPG', 1, 1, 'transfer', 1),
(52, 34, 24, '2025-10-19 15:54:27', '2025-10-14', '2025-10-23', '68f4a743a80d2.JPG', 1, 1, 'transfer', 0),
(53, 29, 28, '2025-10-19 16:00:37', '2025-10-22', '2025-10-31', '68f4a8b583c5c.JPG', 1, 1, 'qrcode', 1);

-- --------------------------------------------------------

--
-- Table structure for table `thai_provinces`
--

CREATE TABLE `thai_provinces` (
  `id` int(11) NOT NULL,
  `name_th` varchar(150) NOT NULL,
  `name_en` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thai_provinces`
--

INSERT INTO `thai_provinces` (`id`, `name_th`, `name_en`) VALUES
(1, 'กรุงเทพมหานคร', 'Bangkok'),
(2, 'สมุทรปราการ', 'Samut Prakan'),
(3, 'นนทบุรี', 'Nonthaburi'),
(4, 'ปทุมธานี', 'Pathum Thani'),
(5, 'พระนครศรีอยุธยา', 'Phra Nakhon Si Ayutthaya'),
(6, 'อ่างทอง', 'Ang Thong'),
(7, 'ลพบุรี', 'Loburi'),
(8, 'สิงห์บุรี', 'Sing Buri'),
(9, 'ชัยนาท', 'Chai Nat'),
(10, 'สระบุรี', 'Saraburi'),
(11, 'ชลบุรี', 'Chon Buri'),
(12, 'ระยอง', 'Rayong'),
(13, 'จันทบุรี', 'Chanthaburi'),
(14, 'ตราด', 'Trat'),
(15, 'ฉะเชิงเทรา', 'Chachoengsao'),
(16, 'ปราจีนบุรี', 'Prachin Buri'),
(17, 'นครนายก', 'Nakhon Nayok'),
(18, 'สระแก้ว', 'Sa Kaeo'),
(19, 'นครราชสีมา', 'Nakhon Ratchasima'),
(20, 'บุรีรัมย์', 'Buri Ram'),
(21, 'สุรินทร์', 'Surin'),
(22, 'ศรีสะเกษ', 'Si Sa Ket'),
(23, 'อุบลราชธานี', 'Ubon Ratchathani'),
(24, 'ยโสธร', 'Yasothon'),
(25, 'ชัยภูมิ', 'Chaiyaphum'),
(26, 'อำนาจเจริญ', 'Amnat Charoen'),
(27, 'หนองบัวลำภู', 'Nong Bua Lam Phu'),
(28, 'ขอนแก่น', 'Khon Kaen'),
(29, 'อุดรธานี', 'Udon Thani'),
(30, 'เลย', 'Loei'),
(31, 'หนองคาย', 'Nong Khai'),
(32, 'มหาสารคาม', 'Maha Sarakham'),
(33, 'ร้อยเอ็ด', 'Roi Et'),
(34, 'กาฬสินธุ์', 'Kalasin'),
(35, 'สกลนคร', 'Sakon Nakhon'),
(36, 'นครพนม', 'Nakhon Phanom'),
(37, 'มุกดาหาร', 'Mukdahan'),
(38, 'เชียงใหม่', 'Chiang Mai'),
(39, 'ลำพูน', 'Lamphun'),
(40, 'ลำปาง', 'Lampang'),
(41, 'อุตรดิตถ์', 'Uttaradit'),
(42, 'แพร่', 'Phrae'),
(43, 'น่าน', 'Nan'),
(44, 'พะเยา', 'Phayao'),
(45, 'เชียงราย', 'Chiang Rai'),
(46, 'แม่ฮ่องสอน', 'Mae Hong Son'),
(47, 'นครสวรรค์', 'Nakhon Sawan'),
(48, 'อุทัยธานี', 'Uthai Thani'),
(49, 'กำแพงเพชร', 'Kamphaeng Phet'),
(50, 'ตาก', 'Tak'),
(51, 'สุโขทัย', 'Sukhothai'),
(52, 'พิษณุโลก', 'Phitsanulok'),
(53, 'พิจิตร', 'Phichit'),
(54, 'เพชรบูรณ์', 'Phetchabun'),
(55, 'ราชบุรี', 'Ratchaburi'),
(56, 'กาญจนบุรี', 'Kanchanaburi'),
(57, 'สุพรรณบุรี', 'Suphan Buri'),
(58, 'นครปฐม', 'Nakhon Pathom'),
(59, 'สมุทรสาคร', 'Samut Sakhon'),
(60, 'สมุทรสงคราม', 'Samut Songkhram'),
(61, 'เพชรบุรี', 'Phetchaburi'),
(62, 'ประจวบคีรีขันธ์', 'Prachuap Khiri Khan'),
(63, 'นครศรีธรรมราช', 'Nakhon Si Thammarat'),
(64, 'กระบี่', 'Krabi'),
(65, 'พังงา', 'Phangnga'),
(66, 'ภูเก็ต', 'Phuket'),
(67, 'สุราษฎร์ธานี', 'Surat Thani'),
(68, 'ระนอง', 'Ranong'),
(69, 'ชุมพร', 'Chumphon'),
(70, 'สงขลา', 'Songkhla'),
(71, 'สตูล', 'Satun'),
(72, 'ตรัง', 'Trang'),
(73, 'พัทลุง', 'Phatthalung'),
(74, 'ปัตตานี', 'Pattani'),
(75, 'ยะลา', 'Yala'),
(76, 'นราธิวาส', 'Narathiwat'),
(77, 'บึงกาฬ', 'buogkan');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `address` text NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL,
  `role` int(1) NOT NULL DEFAULT 0,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `email`, `fullname`, `lastname`, `phone`, `address`, `timestamp`, `status`, `role`, `password`) VALUES
(26, 'admin@gmail.com', 'admin', 'admin', '0654941792', '330 ถ.เชียงใหม่-ลำปาง ต.ป่าตัน อ.เมือง\r\nรหัสไปรษณีย์ 50300', '2025-10-18 23:18:58', 1, 0, 'MTIzNDU2Nzg='),
(27, 'provider1@gmail.com', 'provider1', 'provider1', '0635179644', 'เลขที่ 6/141, หมู่ที่ 4, หมู่บ้าน วิโรจน์วิลล์, ถนน 345 ตำบลละหาร, อำเภอบางบัวทอง นนทบุรี 11110', '2025-10-18 23:33:28', 1, 2, 'MTIzNDU2Nzg='),
(28, 'provider2@gmail.com', 'provider2', 'provider2', '0654941792', 'เลขที่ 6/141, หมู่ที่ 4, หมู่บ้าน วิโรจน์วิลล์, ถนน 345 ตำบลละหาร, อำเภอบางบัวทอง นนทบุรี 11110', '2025-10-18 23:34:08', 1, 2, 'MTIzNDU2Nzg='),
(30, 'customer2@gmail.com', 'customer2', 'customer2', '0654941792', 'เลขที่ 6/141, หมู่ที่ 4, หมู่บ้าน วิโรจน์วิลล์, ถนน 345 ตำบลละหาร, อำเภอบางบัวทอง นนทบุรี 11110', '2025-10-18 23:35:57', 1, 1, 'MTIzNDU2Nzg='),
(34, 'customer3@gmail.com', 'customer3', 'customer3', '0654941792', 'เลขที่ 6/141, หมู่ที่ 4, หมู่บ้าน วิโรจน์วิลล์, ถนน 345 ตำบลละหาร, อำเภอบางบัวทอง นนทบุรี 11110', '2025-10-19 15:50:39', 1, 1, 'MTIzNDU2Nzg=');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cars`
--
ALTER TABLE `Cars`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `reserved`
--
ALTER TABLE `reserved`
  ADD PRIMARY KEY (`reserved_id`);

--
-- Indexes for table `thai_provinces`
--
ALTER TABLE `thai_provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cars`
--
ALTER TABLE `Cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `reserved`
--
ALTER TABLE `reserved`
  MODIFY `reserved_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
