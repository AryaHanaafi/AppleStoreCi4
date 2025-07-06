-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 08:59 PM
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
-- Database: `db_ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-05-24-080824', 'App\\Database\\Migrations\\User', 'default', 'App', 1748243720, 1),
(2, '2025-05-24-080834', 'App\\Database\\Migrations\\Product', 'default', 'App', 1748243720, 1),
(3, '2025-05-24-080845', 'App\\Database\\Migrations\\Transaction', 'default', 'App', 1748243720, 1),
(4, '2025-05-24-080854', 'App\\Database\\Migrations\\TransactionDetail', 'default', 'App', 1748243720, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` int(5) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `nama`, `harga`, `jumlah`, `foto`, `created_at`, `updated_at`, `kategori`) VALUES
(1, 'iPhone 16 Pro', 18499000, 7, '1748882869_40818f89febcd19efc57.jpg', '2025-06-02 16:40:36', '2025-06-06 09:39:23', 'iPhone'),
(2, 'iPhone 16', 14999000, 5, '1748884202_f0f1f52c9593a3d92bbd.jpg', '2025-06-02 17:10:02', NULL, 'iPhone'),
(3, 'iPhone 16e', 12749000, 12, '1748884309_13fbc04addda2a7d4a9a.jpg', '2025-06-02 17:11:49', NULL, 'iPhone'),
(4, 'iPhone 15', 11499000, 8, '1748884404_ec344a3575d0748a0cef.jpg', '2025-06-02 17:13:24', NULL, 'iPhone'),
(5, '15-inch MacBook Air M4', 21499000, 8, '1749198288_16cb10b157c6c58981d3.webp', '2025-06-06 08:24:47', NULL, 'MacBook'),
(6, '16-inch MacBook Pro M4 Max', 59999000, 10, '1749198504_9d29ffa43dc7d25c5da7.webp', '2025-06-06 08:28:24', '2025-06-06 09:22:36', 'MacBook'),
(7, '15-inch MacBook Air M3', 21499000, 22, '1749199301_bc84ba9f534464344195.webp', '2025-06-06 08:41:12', '2025-06-06 08:41:41', 'MacBook'),
(9, '13-inch iPad Pro M4', 25499000, 21, '1749199436_aec00a519c405e6689f4.webp', '2025-06-06 08:43:56', '2025-06-06 09:23:33', 'iPad'),
(12, '2021 10.2-inch iPad', 4449000, 15, '1749200705_21a60b439483e907cb83.webp', '2025-06-06 09:05:05', NULL, 'iPad');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `total_harga` double NOT NULL,
  `alamat` text NOT NULL,
  `ongkir` double DEFAULT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `username`, `total_harga`, `alamat`, `ongkir`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HanaafiArya', 10908000, 'genukbanjir', 9000, 1, '2025-05-26 14:55:25', '2025-05-26 14:55:25'),
(2, 'user123', 34838000, 'genukbanjir', 40000, 0, '2025-06-02 23:29:53', '2025-06-02 23:29:53'),
(3, 'HanaafiArya', 60010000, 'genukbanjir', 11000, 0, '2025-06-06 22:07:53', '2025-06-06 22:07:53'),
(4, 'HanaafiArya', 195180000, 'hawa 3 no.14', 40000, 0, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(5, 'HanaafiArya', 15008000, 'genuk', 9000, 0, '2025-06-23 11:35:33', '2025-06-23 11:35:33'),
(6, 'HanaafiArya', 33534000, 'genuk', 36000, 0, '2025-06-23 13:35:35', '2025-06-23 13:35:35'),
(7, 'HanaafiArya', 60008000, 'Genuk', 9000, 0, '2025-06-23 13:54:59', '2025-06-23 13:54:59'),
(8, 'HanaafiArya', 96537000, 'genuk', 40000, 0, '2025-06-23 14:21:10', '2025-06-23 14:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_detail`
--

CREATE TABLE `transaction_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `jumlah` int(5) NOT NULL,
  `diskon` double DEFAULT NULL,
  `subtotal_harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_detail`
--

INSERT INTO `transaction_detail` (`id`, `transaction_id`, `product_id`, `jumlah`, `diskon`, `subtotal_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, 10899000, '2025-05-26 14:55:25', '2025-05-26 14:55:25'),
(2, 2, 1, 2, 0, 21600000, '2025-06-02 23:29:53', '2025-06-02 23:29:53'),
(3, 2, 2, 1, 0, 6899000, '2025-06-02 23:29:53', '2025-06-02 23:29:53'),
(4, 2, 3, 1, 0, 6299000, '2025-06-02 23:29:53', '2025-06-02 23:29:53'),
(5, 3, 12, 1, 0, 59999000, '2025-06-06 22:07:53', '2025-06-06 22:07:53'),
(6, 4, 1, 1, 0, 18499000, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(7, 4, 2, 1, 0, 14999000, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(8, 4, 3, 1, 0, 12749000, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(9, 4, 4, 1, 0, 11499000, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(10, 4, 5, 1, 0, 21499000, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(11, 4, 6, 1, 0, 59999000, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(12, 4, 7, 1, 0, 21499000, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(13, 4, 9, 1, 0, 25499000, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(14, 4, 12, 2, 0, 8898000, '2025-06-21 19:06:02', '2025-06-21 19:06:02'),
(15, 5, 2, 1, 0, 14999000, '2025-06-23 11:35:33', '2025-06-23 11:35:33'),
(16, 6, 2, 1, 0, 14999000, '2025-06-23 13:35:35', '2025-06-23 13:35:35'),
(17, 6, 1, 1, 0, 18499000, '2025-06-23 13:35:35', '2025-06-23 13:35:35'),
(18, 7, 6, 1, 0, 59999000, '2025-06-23 13:54:59', '2025-06-23 13:54:59'),
(19, 8, 2, 1, 0, 14999000, '2025-06-23 14:21:10', '2025-06-23 14:21:10'),
(20, 8, 5, 1, 0, 21499000, '2025-06-23 14:21:10', '2025-06-23 14:21:10'),
(21, 8, 6, 1, 0, 59999000, '2025-06-23 14:21:10', '2025-06-23 14:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'HanaafiArya', 'HanaafiArya123@gmail.com\r\n', '$2y$10$I1K6Hm8Z3EBEmD6mw.qMsOtwMfq6SgC24gR6FZh2hLlC1xs10aMP2', 'admin', '2025-05-26 07:32:29', NULL),
(2, 'ekusmawati', 'niyaga.oktaviani@gmail.co.id', '$2y$10$E7xPja0LEh/bMRXBKwB2r.tzrMn1lcPxBhNejaqi4a13qorcfCA76', 'admin', '2025-05-26 07:32:29', NULL),
(3, 'hasna.zulaika', 'balidin47@tarihoran.biz.id', '$2y$10$Ecf2M/2ONEJi7V6j2XnNXe5nGH9.KufMNdTo6hAs0Z.AcYTT7oxoC', 'admin', '2025-05-26 07:32:29', NULL),
(4, 'user123', 'nasyiah.rachel@marbun.go.id', '$2y$10$pZw8RFi9zy9CjW2O0Jqa9utbNtVnu5ythvJVvx2vqku3OuhTn17N6', 'guest', '2025-05-26 07:32:29', NULL),
(5, 'kuswoyo.raina', 'clestari@yahoo.com', '$2y$10$cO0jiz4F/l604tbktJo6VOafVhw05Agf8b7mZS6QSCK7AdemNbgKK', 'admin', '2025-05-26 07:32:29', NULL),
(6, 'artawan.laksita', 'haryanto.cengkal@astuti.web.id', '$2y$10$Le1cJ2TjGc4zcOPjpT4qVeTQZbUwfJ3gMUskvn9PgVM9LQcQ9P8F.', 'admin', '2025-05-26 07:32:29', NULL),
(7, 'laksmiwati.ilsa', 'eka.sinaga@haryanto.net', '$2y$10$cD97QwbpZ3EhlgP7iX7NOecY7.k9rKNT0XZ505coWHVrSjxgxgZDu', 'guest', '2025-05-26 07:32:30', NULL),
(8, 'iriana06', 'sudiati.queen@narpati.or.id', '$2y$10$94AFpsfC24kErW.durba0e7jI5XZkysbXc6FITs.irsw0a73r.wk2', 'guest', '2025-05-26 07:32:30', NULL),
(9, 'ardianto.umay', 'prastuti.rini@hastuti.mil.id', '$2y$10$5KA5ybN3SIbt06XGvtBGDuXgbtvUe.Iygq31HmDzsPGnkgsUdSYIG', 'guest', '2025-05-26 07:32:30', NULL),
(10, 'padmasari.jamil', 'wacana.amalia@palastri.my.id', '$2y$10$P9.sSy8jV5wvmWsB8.YeI.sWCRwYmppGp65UEy35QIQcXfQGKbSHy', 'admin', '2025-05-26 07:32:30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaction_detail`
--
ALTER TABLE `transaction_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
