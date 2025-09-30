-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2025 at 04:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding_jwp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_catalogues`
--

CREATE TABLE `tb_catalogues` (
  `catalogue_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `package_name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `status_publish` enum('Y','N') NOT NULL,
  `user_id` int(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_catalogues`
--

INSERT INTO `tb_catalogues` (`catalogue_id`, `image`, `package_name`, `description`, `price`, `status_publish`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 'paket1.jpg', 'Ajib 1', 'Rasakan kemewahan penuh di hari bahagia Anda. Paket Ajib 1 menghadirkan tenda eksklusif dengan dekorasi elegan, pencahayaan mewah, serta fasilitas prasmanan terbaik dengan menu pilihan. Cocok untuk pernikahan besar dengan nuansa megah dan penuh kesan tak terlupakan.', 150000000, 'Y', 1, '2025-09-25 07:23:43', '2025-09-25 12:23:47'),
(5, 'paket2.jpg', 'Ajib 2', 'Pilihan tepat untuk Anda yang menginginkan kemewahan dengan harga lebih terjangkau. Paket Ajib 2 menyediakan tenda nyaman dengan dekorasi cantik dan fasilitas prasmanan lengkap. Memberikan suasana hangat namun tetap elegan untuk momen istimewa bersama keluarga dan tamu undangan.', 100000000, 'Y', 1, '2025-09-25 07:23:43', '2025-09-25 13:07:43'),
(6, 'paket3.jpg', 'Ajib 3', 'Sederhana namun tetap berkelas. Paket Ajib 3 hadir dengan tenda fungsional dan prasmanan yang praktis untuk acara pernikahan yang lebih intim. Pilihan hemat tanpa mengurangi kehangatan dan kebahagiaan momen Anda.', 75000000, 'Y', 1, '2025-09-25 07:23:43', '2025-09-25 13:07:43'),
(10, 'paket4.jpg', 'Ajib 4', 'Paket Ajib 4 adalah solusi sempurna bagi Anda yang mengidamkan perayaan pernikahan yang intim dan berkesan tanpa harus menguras anggaran. Kami merancang paket ini untuk memfasilitasi acara pernikahan yang fokus pada kehangatan dan kebahagiaan, dengan sentuhan elegan yang tidak terlewatkan. Dengan total anggaran Rp50 Juta, paket ini ideal untuk resepsi sederhana, microwedding, atau acara di rumah/gedung serbaguna dengan estimasi tamu undangan 100-150 orang (atau 200-300 porsi katering).', 50000000, 'Y', 1, '2025-09-28 06:23:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `catalogue_id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(256) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `wedding_date` date NOT NULL,
  `status` enum('requested','approved','rejected') NOT NULL,
  `user_id` int(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `catalogue_id`, `name`, `email`, `phone_number`, `wedding_date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 5, 'ferdi sahardika', 'sahardika@gmail.com', '081297485841', '2025-10-05', 'approved', 0, '2025-09-28 12:29:01', '2025-09-28 12:31:58'),
(9, 4, 'asep kusnandar', 'asepsep@gmail.com', '081297485842', '2025-10-12', 'rejected', 0, '2025-09-28 12:29:58', '2025-09-28 12:35:00'),
(10, 10, 'budi', 'budibud@gmail.com', '081297485843', '2025-12-07', 'requested', 0, '2025-09-29 21:01:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_settings`
--

CREATE TABLE `tb_settings` (
  `id` int(11) NOT NULL,
  `website_name` varchar(256) NOT NULL,
  `phone_number1` varchar(15) NOT NULL,
  `phone_number2` varchar(15) DEFAULT NULL,
  `email1` varchar(80) NOT NULL,
  `email2` varchar(80) DEFAULT NULL,
  `address` text NOT NULL,
  `maps` text DEFAULT NULL,
  `logo` varchar(80) NOT NULL,
  `facebook_url` varchar(256) DEFAULT NULL,
  `instagram_url` varchar(256) DEFAULT NULL,
  `youtube_url` varchar(256) DEFAULT NULL,
  `header_business_hour` varchar(160) NOT NULL,
  `time_business_hour` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_settings`
--

INSERT INTO `tb_settings` (`id`, `website_name`, `phone_number1`, `phone_number2`, `email1`, `email2`, `address`, `maps`, `logo`, `facebook_url`, `instagram_url`, `youtube_url`, `header_business_hour`, `time_business_hour`, `created_at`, `updated_at`) VALUES
(1, 'JEWEPE Wedding Organizer', '081297485841', '081297485842', 'info@jewepe.com', 'support@jewepe.com', 'Gg. Mushola Al-Muchtar No.82, RT.011/RW.17, Bahagia, Kec. Babelan, Kabupaten Bekasi, Jawa Barat 17610', 'https://maps.app.goo.gl/y1c5KysZt2ompkN97', 'logo1.png', 'https://facebook.com/jewepe', 'https://instagram.com/jewepe', 'https://youtube.com/@jewepe', 'Buka Setiap Hari', 'Senin - Minggu, 08:00 - 22:00', '2025-09-29 20:48:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `user_id` int(5) NOT NULL,
  `name` varchar(80) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`user_id`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'ferdi', 'admin', 'admin123', '2025-09-25 08:11:12', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_catalogues`
--
ALTER TABLE `tb_catalogues`
  ADD PRIMARY KEY (`catalogue_id`),
  ADD KEY `fk_catalogue_user` (`user_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_order_catalogue` (`catalogue_id`);

--
-- Indexes for table `tb_settings`
--
ALTER TABLE `tb_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_catalogues`
--
ALTER TABLE `tb_catalogues`
  MODIFY `catalogue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_settings`
--
ALTER TABLE `tb_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_catalogues`
--
ALTER TABLE `tb_catalogues`
  ADD CONSTRAINT `fk_catalogue_user` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`user_id`);

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `fk_order_catalogue` FOREIGN KEY (`catalogue_id`) REFERENCES `tb_catalogues` (`catalogue_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
