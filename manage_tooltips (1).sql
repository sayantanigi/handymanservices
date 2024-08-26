-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 23, 2024 at 02:43 PM
-- Server version: 8.0.37
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectsgoigi_411web3`
--

-- --------------------------------------------------------

--
-- Table structure for table `manage_tooltips`
--

CREATE TABLE `manage_tooltips` (
  `id` int NOT NULL,
  `menu_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_tooltips`
--

INSERT INTO `manage_tooltips` (`id`, `menu_name`, `description`, `status`, `created_date`, `update_date`) VALUES
(3, 'category', '<p>1. Category add from backend with listing</p>\r\n\r\n<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/category_backend.png\" style=\"height:315px; width:600px\" /></p>\r\n\r\n<p>2. Category listing showing in frontend</p>\r\n\r\n<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/category.png\" style=\"height:309px; width:600px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 11:30:20'),
(5, 'banner', '<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_9.png\" style=\"height:181px; width:953px\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_10.png\" style=\"height:467px; width:1319px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 13:29:28'),
(6, 'manage_cms', '<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_12.png\" /><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_11.png\" style=\"height:588px; width:1330px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 13:36:20'),
(7, 'post_job', '<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_14.png\" style=\"height:500px; width:695px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_13.png\" style=\"height:588px; width:1327px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 13:39:02'),
(8, 'chat', '<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_15.png\" style=\"height:611px; width:1111px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_16.png\" style=\"height:569px; width:1330px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 13:40:54'),
(9, 'users', '<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_17.png\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_18.png\" style=\"height:606px; width:1334px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 13:42:47'),
(10, 'adsense', '<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_19.png\" style=\"height:600px; width:1348px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 13:46:41'),
(11, 'tooltips', '<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_20.png\" style=\"height:586px; width:1350px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 13:47:44'),
(12, 'career', '<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_21.png\" /><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_22.png\" style=\"height:611px; width:1354px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 13:49:15'),
(13, 'setting', '<p><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_23.png\" style=\"height:609px; width:1351px\" /><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_24.png\" style=\"height:606px; width:1353px\" /><img alt=\"\" src=\"https://projects.goigi.biz/411web3/uploads/tooltips/Screenshot_25.png\" style=\"height:605px; width:1338px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 13:51:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manage_tooltips`
--
ALTER TABLE `manage_tooltips`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manage_tooltips`
--
ALTER TABLE `manage_tooltips`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
