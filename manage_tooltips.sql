-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 01:21 PM
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
-- Database: `handymanservices`
--

-- --------------------------------------------------------

--
-- Table structure for table `manage_tooltips`
--

CREATE TABLE `manage_tooltips` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `created_date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manage_tooltips`
--

INSERT INTO `manage_tooltips` (`id`, `menu_name`, `description`, `status`, `created_date`, `update_date`) VALUES
(1, 'dashboard', '<p>This is demo tooltips for dashboard.</p>\r\n\r\n<p><img alt=\"\" src=\"http://localhost/handymanservices/uploads/tooltips/mslider1 (2).jpg\" style=\"height:256px; width:1120px\" /></p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 09:34:39'),
(2, 'company-logo', '<p>This is demo tooltips for partner companies</p>\r\n', 'Active', '0000-00-00 00:00:00', '2024-08-23 11:17:22');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
