-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 09:48 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gex`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_documents`
--

CREATE TABLE IF NOT EXISTS `master_documents` (
`id` int(10) unsigned NOT NULL,
  `code` char(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_documents`
--

INSERT INTO `master_documents` (`id`, `code`, `name`, `display_name`, `type`, `remark`, `created_at`, `updated_at`) VALUES
(1, '', 'MASTER B/L', 'MB/L', NULL, NULL, '2017-10-31 07:55:03', '2017-10-31 07:55:03'),
(2, '', 'HOUSE B/L', 'HB/L', NULL, NULL, '2017-10-31 07:55:03', '2017-10-31 07:55:03'),
(3, '', 'PART OF B/L', 'PART OFF', NULL, NULL, '2017-10-31 07:55:03', '2017-10-31 07:55:03'),
(4, '', 'PEB', 'PEB', NULL, NULL, '2017-10-31 07:55:04', '2017-10-31 07:55:04'),
(5, '', 'SPLIT B/L', 'SPLIT', NULL, NULL, '2017-10-31 07:55:04', '2017-10-31 07:55:04'),
(6, '', 'DELIVERY ORDER', 'DO', NULL, NULL, '2017-10-31 07:55:04', '2017-10-31 07:55:04'),
(7, '', 'CONTAINER AND SEAL', 'CONTAINER', NULL, NULL, '2017-10-31 07:55:04', '2017-10-31 07:55:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_documents`
--
ALTER TABLE `master_documents`
 ADD PRIMARY KEY (`id`), ADD KEY `master_documents_code_index` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_documents`
--
ALTER TABLE `master_documents`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
