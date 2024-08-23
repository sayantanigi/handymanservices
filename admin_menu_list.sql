-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 01:20 PM
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
-- Table structure for table `admin_menu_list`
--

CREATE TABLE `admin_menu_list` (
  `id` int(11) NOT NULL,
  `menu_name` text NOT NULL,
  `controller_name` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_menu_list`
--

INSERT INTO `admin_menu_list` (`id`, `menu_name`, `controller_name`, `status`) VALUES
(1, 'Dashboard', 'dashboard', 'Active'),
(2, 'Categories', 'category', 'Active'),
(3, 'Sub Categories', 'sub_category', 'Active'),
(4, 'Skill Set', 'specialist', 'Active'),
(5, 'Sliders and Banners', 'banner', 'Active'),
(6, 'Content Management', 'manage_cms', 'Active'),
(7, 'Jod Posts', 'post_job', 'Active'),
(8, 'Messages', 'chat', 'Active'),
(9, 'Users', 'users', 'Active'),
(10, 'Reported Users', 'reportedusers', 'Active'),
(11, 'Our Services', 'our-services', 'Active'),
(12, 'Partner Companies', 'company-logo', 'Active'),
(13, 'Career Tips', 'career', 'Active'),
(14, 'Adsense', 'adsense', 'Active'),
(15, 'Tooltips Management', 'tooltips', 'Active'),
(16, 'Site Settings', 'setting', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_menu_list`
--
ALTER TABLE `admin_menu_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_menu_list`
--
ALTER TABLE `admin_menu_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
