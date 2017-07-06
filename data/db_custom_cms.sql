-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 06, 2017 at 03:31 অপরাহ্ণ
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_custom_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(4) UNSIGNED NOT NULL,
  `parent_category_id` int(4) UNSIGNED NOT NULL DEFAULT '0',
  `category_title` varchar(150) NOT NULL,
  `category_description` text NOT NULL,
  `category_order` int(4) NOT NULL,
  `active_state` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `deletion_state` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `parent_category_id`, `category_title`, `category_description`, `category_order`, `active_state`, `deletion_state`) VALUES
(2, 0, 'Pants', '', 0, 1, 0),
(3, 2, 'Jeans', '', 0, 1, 0),
(4, 2, 'Standard', '', 0, 1, 0),
(11, 0, 'T-Shirt', '', 0, 1, 0),
(9, 1, 'Full Shirt', '', 0, 1, 0),
(10, 1, 'Half Shirt With Slave', '', 0, 1, 0),
(12, 11, 'Blue T-Shirt With Slave', '', 0, 1, 0),
(14, 0, 'Three piece', '', 0, 1, 0),
(15, 0, 'Electronics Product', '', 0, 1, 0),
(16, 15, 'Refrigerator', '', 0, 1, 0),
(17, 15, 'TV', '', 0, 1, 0),
(18, 15, 'Microwave Oven', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `product_code` varchar(20) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `product_name_seo` varchar(200) NOT NULL,
  `product_description` text NOT NULL,
  `product_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sort_order` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `active_state` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `product_code`, `product_name`, `product_name_seo`, `product_description`, `product_price`, `sort_order`, `active_state`, `created_on`) VALUES
(1, 16, 'PRO-00001', 'LG', 'LG-00001', 'asdf asdf adsfafdsa\r\n', '50000.00', 0, 1, '2017-07-06 11:32:31'),
(2, 17, 'PRO-00002', 'LG Smart TV', '', 'asdf asdfafaf adsf\r\n', '5999.00', 0, 1, '2017-07-06 11:36:41'),
(3, 17, 'PRO-00003', 'LG Smart LED TV', 'LG-Smart-LED-TV', '&nbsp;asd adsfafaf asfaf\r\n', '50000.00', 0, 1, '2017-07-06 11:57:45'),
(4, 17, 'PRO-00004', 'SONY Smart WIFI TV', 'SONY-Smart-WIFI-TV', 'asdf asdfafaf\r\n', '60000.00', 0, 1, '2017-07-06 11:59:00'),
(8, 18, 'PRO-00008', 'Singer Oven', 'Singer-Oven', 'werqwerqr qewrq werqr\r\n', '15500.00', 0, 1, '2017-07-06 12:20:23'),
(6, 17, 'PRO-00006', 'LG Smart 5G TV', 'LG-Smart-5G-TV', 'asdf asdfa dfasf\r\n', '50000.00', 0, 1, '2017-07-06 12:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_image`
--

CREATE TABLE `tbl_product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT '0',
  `file_name` varchar(200) NOT NULL,
  `file_org_name` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL,
  `sessionId` varchar(64) NOT NULL,
  `level` enum('guest','admin') NOT NULL DEFAULT 'guest'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `sessionId`, `level`) VALUES
(1, 'admin', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', '', 'admin'),
(2, 'test2', '', '', 'guest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_category_id` (`parent_category_id`),
  ADD KEY `parent_category_id_2` (`parent_category_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name_seo` (`product_name_seo`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_product_image`
--
ALTER TABLE `tbl_product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
