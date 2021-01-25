-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2020 at 01:30 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drishyas_nakoda`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminmaster`
--

CREATE TABLE `adminmaster` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `admin_fullname` varchar(100) NOT NULL,
  `admin_password` text DEFAULT NULL,
  `admin_role` varchar(255) DEFAULT NULL,
  `admin_status` enum('0','1','2') DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT 0,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminmaster`
--

INSERT INTO `adminmaster` (`id`, `admin_name`, `admin_fullname`, `admin_password`, `admin_role`, `admin_status`, `status`, `created_date`, `updated_date`) VALUES
(1, 'admin', 'Hitesh Dhruv', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1,2,3,4,5,6,7,8,9,10', '1', 0, '2019-03-25 21:34:25', '2019-03-27 19:08:24'),
(2, 'jay', 'Jay Deepak Shah', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1,2,3,4,5,6,7,8,9,10', '1', 0, '2019-03-25 21:34:25', '2019-03-27 19:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `b_id` int(11) NOT NULL,
  `b_name` varchar(128) NOT NULL,
  `b_status` tinyint(1) NOT NULL,
  `b_modifiedDate` datetime NOT NULL,
  `b_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`b_id`, `b_name`, `b_status`, `b_modifiedDate`, `b_createdDate`) VALUES
(1, 'Nakoda', 1, '2020-11-03 10:38:24', '2020-11-03 10:38:24'),
(2, 'royal', 1, '2020-11-03 10:39:06', '2020-11-03 10:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `c_name` varchar(100) NOT NULL,
  `c_address1` varchar(100) DEFAULT NULL,
  `c_address2` varchar(100) DEFAULT NULL,
  `c_address3` varchar(100) DEFAULT NULL,
  `c_state` varchar(100) DEFAULT NULL,
  `c_city` varchar(100) DEFAULT NULL,
  `c_pincode` int(11) DEFAULT NULL,
  `c_country` varchar(100) DEFAULT NULL,
  `c_mobile` bigint(20) DEFAULT NULL,
  `c_alt` bigint(20) DEFAULT NULL,
  `c_email` varchar(100) DEFAULT NULL,
  `c_status` tinyint(2) DEFAULT NULL,
  `c_createdDate` datetime DEFAULT NULL,
  `c_modifiedDate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `c_name`, `c_address1`, `c_address2`, `c_address3`, `c_state`, `c_city`, `c_pincode`, `c_country`, `c_mobile`, `c_alt`, `c_email`, `c_status`, `c_createdDate`, `c_modifiedDate`) VALUES
(1, 'Abc Ltd', 'shop no 5 thakur complex', 'kandivali east', 'near st. laurence', 'maharashtra', 'mumbai', 400101, 'india', 8692947183, 9082131155, 'sameerranjan999@gmail.com', 1, '2020-11-03 10:33:54', '2020-11-03 10:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `clientcontact`
--

CREATE TABLE `clientcontact` (
  `cc_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `cc_name` varchar(150) NOT NULL,
  `cc_mobile` bigint(15) NOT NULL,
  `cc_designation` varchar(50) NOT NULL,
  `cc_email` varchar(255) NOT NULL,
  `cc_status` smallint(2) NOT NULL,
  `cc_createdDate` datetime(5) NOT NULL,
  `cc_modifiedDate` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clientcontact`
--

INSERT INTO `clientcontact` (`cc_id`, `client_id`, `cc_name`, `cc_mobile`, `cc_designation`, `cc_email`, `cc_status`, `cc_createdDate`, `cc_modifiedDate`) VALUES
(1, 1, 'sameer', 8692947183, 'jr.developer', 'samrokss18@gmail.com', 1, '2020-11-03 10:35:47.00000', '2020-11-03 10:35:47.00000');

-- --------------------------------------------------------

--
-- Table structure for table `colour`
--

CREATE TABLE `colour` (
  `cl_id` int(11) NOT NULL,
  `cl_name` varchar(25) NOT NULL,
  `cl_status` tinyint(4) NOT NULL,
  `cl_createdDate` datetime NOT NULL,
  `cl_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colour`
--

INSERT INTO `colour` (`cl_id`, `cl_name`, `cl_status`, `cl_createdDate`, `cl_modifiedDate`) VALUES
(1, 'red', 1, '2020-11-03 10:37:44', '2020-11-03 10:37:44'),
(2, 'light blue', 1, '2020-11-03 10:37:52', '2020-11-03 10:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(128) NOT NULL,
  `c_address1` varchar(255) NOT NULL,
  `c_address2` varchar(255) NOT NULL,
  `c_mobile` bigint(20) NOT NULL,
  `c_pincode` smallint(4) NOT NULL,
  `c_alt` bigint(20) NOT NULL,
  `c_modifiedDate` datetime NOT NULL,
  `c_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_address1`, `c_address2`, `c_mobile`, `c_pincode`, `c_alt`, `c_modifiedDate`, `c_createdDate`) VALUES
(1, 'sameer', 'abgf', 'hgty', 9876543210, 32767, 9082131155, '2020-11-03 11:04:06', '2020-11-03 11:04:06'),
(2, 'jay shah', 'ahgfb', 'hjyt', 9087654321, 32767, 1234567891, '2020-11-03 11:07:28', '2020-11-03 11:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `dimension`
--

CREATE TABLE `dimension` (
  `d_id` int(11) NOT NULL,
  `d_size` varchar(128) NOT NULL,
  `d_status` tinyint(4) NOT NULL,
  `d_modifiedDate` datetime NOT NULL,
  `d_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dimension`
--

INSERT INTO `dimension` (`d_id`, `d_size`, `d_status`, `d_modifiedDate`, `d_createdDate`) VALUES
(1, '10.5 x 7.6', 1, '2020-11-03 10:36:38', '2020-11-03 10:36:38'),
(2, '20 H X 34 W', 1, '2020-11-03 10:45:35', '2020-11-03 10:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `c_id` int(11) NOT NULL,
  `paymode` int(11) NOT NULL,
  `inv_taxamt` float(11,2) NOT NULL,
  `inv_amt` float(11,2) NOT NULL,
  `in_createdBy` varchar(16) NOT NULL,
  `in_createdId` int(11) NOT NULL,
  `in_status` int(11) NOT NULL DEFAULT 1,
  `in_modifiedDate` datetime NOT NULL,
  `in_createdDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_products`
--

CREATE TABLE `invoice_products` (
  `ip_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `ip_qty` int(11) NOT NULL,
  `p_price` float(11,2) NOT NULL,
  `ip_taxtype` varchar(100) NOT NULL,
  `ip_taxper` int(11) NOT NULL,
  `ip_taxprice` float(11,2) NOT NULL,
  `ip_status` int(11) DEFAULT 1,
  `ip_addedBy` int(11) NOT NULL,
  `ip_addedId` int(11) NOT NULL,
  `ip_createdDate` datetime NOT NULL,
  `ip_modifiedDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `ord_numberShipped` int(11) NOT NULL,
  `ord_date` date NOT NULL,
  `ord_name` varchar(128) NOT NULL,
  `ord_modifiedDate` datetime NOT NULL,
  `ord_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmode`
--

CREATE TABLE `paymentmode` (
  `pm_id` int(11) NOT NULL,
  `pm_name` varchar(100) NOT NULL,
  `pm_status` int(11) NOT NULL,
  `pm_createdDate` datetime NOT NULL,
  `pm_modifiedDate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmode`
--

INSERT INTO `paymentmode` (`pm_id`, `pm_name`, `pm_status`, `pm_createdDate`, `pm_modifiedDate`) VALUES
(1, 'Cash', 1, '2020-10-30 10:52:12', '2020-10-30 10:59:14'),
(2, 'CreditCard', 1, '2020-02-23 10:59:21', '2020-02-23 10:59:21'),
(3, 'DebitCard', 1, '2020-02-23 10:59:28', '2020-02-23 10:59:28'),
(4, 'Google pay', 1, '2020-02-23 10:59:34', '2020-02-23 10:59:49'),
(5, 'Paytm', 1, '2020-02-23 10:59:41', '2020-02-23 10:59:41'),
(6, 'later', 1, '2020-02-23 05:06:24', '2020-02-23 05:06:24'),
(7, 'UPI ICICIBANK', 1, '2020-02-24 06:45:17', '2020-02-24 06:45:17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `p_code` varchar(255) DEFAULT NULL,
  `p_name` varchar(128) NOT NULL,
  `p_image` varchar(255) DEFAULT NULL,
  `cl_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL,
  `b_id` int(11) DEFAULT NULL,
  `p_status` tinyint(4) NOT NULL,
  `p_modifiedDate` datetime NOT NULL,
  `p_createdDate` datetime NOT NULL,
  `p_tax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `t_id`, `p_code`, `p_name`, `p_image`, `cl_id`, `d_id`, `b_id`, `p_status`, `p_modifiedDate`, `p_createdDate`, `p_tax`) VALUES
(1, 1, 'bt1', 'Bath Tub', 'Pokémon_Ultra_Sun_And_Ultra_Moon_Beef_Up_Legendaries_With_New_Z-Moves___Pokemon_Group.jpg', 1, 1, 1, 1, '2020-11-03 10:41:34', '2020-11-03 10:41:34', 4),
(2, 2, 'c1', 'Chair-red', 'Pokémon_Ultra_Sun_And_Ultra_Moon_Beef_Up_Legendaries_With_New_Z-Moves___Pokemon_Group.jpg', 2, 2, 2, 1, '2020-11-03 10:45:59', '2020-11-03 10:42:24', 2),
(3, 2, 'tb1', 'Table-light blue', 'wallpaper.jpg', 2, 2, 1, 1, '2020-11-03 12:17:58', '2020-11-03 12:17:58', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

CREATE TABLE `product_inventory` (
  `pi_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_total` int(11) NOT NULL,
  `p_avail` int(11) NOT NULL,
  `p_sold` int(11) NOT NULL,
  `p_damage` int(11) NOT NULL,
  `pi_createdDate` datetime NOT NULL,
  `pi_modifiedDate` datetime NOT NULL,
  `pi_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`pi_id`, `p_id`, `p_total`, `p_avail`, `p_sold`, `p_damage`, `pi_createdDate`, `pi_modifiedDate`, `pi_status`) VALUES
(1, 1, 2000, 2000, 0, 0, '2020-11-03 10:41:34', '2020-11-03 10:41:34', 1),
(2, 2, 5000, 5000, 0, 0, '2020-11-03 10:42:24', '2020-11-03 10:42:24', 1),
(3, 3, 0, 0, 0, 0, '2020-11-03 12:17:58', '2020-11-03 12:17:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `purchase_remarks` text DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `purchase_status` int(11) NOT NULL,
  `purchase_addedId` int(11) NOT NULL,
  `purchase_addedBy` varchar(30) NOT NULL,
  `purchase_modifiedDate` datetime NOT NULL,
  `purchase_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `sp_id`, `purchase_remarks`, `purchase_date`, `purchase_status`, `purchase_addedId`, `purchase_addedBy`, `purchase_modifiedDate`, `purchase_createdDate`) VALUES
(1, 2, 'abgcf', '2020-11-03', 1, 1, 'admin', '2020-11-03 11:02:53', '2020-11-03 11:02:53'),
(2, 1, 'Product Being purchased', '2020-11-03', 1, 2, 'admin', '2020-11-03 12:14:12', '2020-11-03 12:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `pd_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `pd_qty` int(11) NOT NULL,
  `pd_unitprice` float(11,2) NOT NULL,
  `pd_money` int(11) NOT NULL,
  `pd_addstock` int(11) NOT NULL,
  `pd_status` int(11) NOT NULL,
  `pd_addedId` int(11) NOT NULL,
  `pd_addedBy` varchar(50) NOT NULL,
  `pd_modifiedDate` datetime NOT NULL,
  `pd_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`pd_id`, `purchase_id`, `p_id`, `pd_qty`, `pd_unitprice`, `pd_money`, `pd_addstock`, `pd_status`, `pd_addedId`, `pd_addedBy`, `pd_modifiedDate`, `pd_createdDate`) VALUES
(1, 1, 1, 2000, 500.00, 0, 1, 1, 1, 'admin', '2020-11-03 11:03:16', '2020-11-03 11:03:11'),
(2, 2, 2, 5000, 3000.00, 0, 1, 1, 2, 'admin', '2020-11-03 12:14:37', '2020-11-03 12:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`) VALUES
(1, 'Andhra Pradesh'),
(2, 'Assam'),
(3, 'Arunachal Pradesh'),
(4, 'Bihar'),
(5, 'Goa'),
(6, 'Gujarat'),
(7, 'Jammu and Kashmir'),
(8, ' Jharkhand'),
(9, 'West Bengal'),
(10, 'Karnataka'),
(11, 'Kerala'),
(12, 'Madhya Pradesh'),
(13, 'Maharashtra'),
(14, 'Manipur'),
(15, 'Meghalaya'),
(16, 'Mizoram'),
(17, 'Nagaland'),
(18, 'Orissa'),
(19, 'Punjab'),
(20, 'Rajasthan'),
(21, 'Sikkim'),
(22, 'Tamil Nadu'),
(23, 'Tripura'),
(24, 'Uttaranchal'),
(25, 'Uttar Pradesh'),
(26, 'Haryana'),
(27, 'Himachal Pradesh'),
(28, 'Chhattisgarh');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `sp_id` int(11) NOT NULL,
  `sp_name` varchar(128) NOT NULL,
  `sp_address1` varchar(255) DEFAULT NULL,
  `sp_address2` varchar(255) DEFAULT NULL,
  `sp_address3` varchar(255) DEFAULT NULL,
  `sp_city` varchar(25) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `sp_country` varchar(128) NOT NULL,
  `sp_pincode` int(11) DEFAULT NULL,
  `sp_mobile` bigint(20) DEFAULT NULL,
  `sp_alt` bigint(20) DEFAULT NULL,
  `sp_email` varchar(100) DEFAULT NULL,
  `sp_status` tinyint(2) DEFAULT NULL,
  `sp_modifiedDate` datetime NOT NULL,
  `sp_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`sp_id`, `sp_name`, `sp_address1`, `sp_address2`, `sp_address3`, `sp_city`, `state_id`, `sp_country`, `sp_pincode`, `sp_mobile`, `sp_alt`, `sp_email`, `sp_status`, `sp_modifiedDate`, `sp_createdDate`) VALUES
(1, 'Jay Shah', 'ganjawala building 9', 'shop no 9', 'borivali east', 'mumbai', 1, 'india', 400101, 8692947183, 9082131155, 'jayshah1996@gmail.com', 1, '2020-11-03 10:53:12', '2020-11-03 10:52:58'),
(2, 'Sameer Jha', 'room no 5 kailashpuri chawl ', 'gawndevi road kajupada ', 'poisar kandivali east ', 'mumbai', 13, 'india', 400101, 8692947183, 9082131155, 'sameer.jha@outlook.com', 1, '2020-11-03 10:55:21', '2020-11-03 10:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `t_id` int(11) NOT NULL,
  `tax_name` varchar(50) NOT NULL,
  `tax_price` decimal(11,2) NOT NULL,
  `tax_amt` float(20,9) NOT NULL,
  `t_createdDate` datetime NOT NULL,
  `t_modifiedDate` datetime NOT NULL,
  `t_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`t_id`, `tax_name`, `tax_price`, `tax_amt`, `t_createdDate`, `t_modifiedDate`, `t_status`) VALUES
(1, '18 % CGST + SGST', '18.00', 0.152542368, '2020-02-22 12:36:03', '2020-02-23 06:57:39', 1),
(2, '18% IGST', '18.00', 0.152542368, '2020-02-22 12:36:30', '2020-02-23 06:58:04', 1),
(3, '12% CGST + SGST', '12.00', 0.107142858, '2020-02-23 06:58:22', '2020-02-23 06:58:22', 1),
(4, '12% IGST', '12.00', 0.107142858, '2020-02-23 06:58:35', '2020-02-23 06:58:48', 1),
(5, '0%', '0.00', 0.000000000, '2020-11-02 14:13:58', '2020-11-02 14:13:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `t_id` int(11) NOT NULL,
  `t_name` varchar(128) DEFAULT NULL,
  `t_desc` varchar(255) DEFAULT NULL,
  `t_status` int(11) NOT NULL,
  `t_modifiedDate` datetime NOT NULL,
  `t_createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`t_id`, `t_name`, `t_desc`, `t_status`, `t_modifiedDate`, `t_createdDate`) VALUES
(1, 'Bathroom Product', 'bathroom product', 1, '2020-11-03 10:39:47', '2020-11-03 10:39:47'),
(2, 'home product', 'Home related product', 1, '2020-11-03 10:40:23', '2020-11-03 10:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `v_id` int(11) NOT NULL,
  `v_name` varchar(25) NOT NULL,
  `v_address1` varchar(255) NOT NULL,
  `v_address2` varchar(255) NOT NULL,
  `v_address3` varchar(255) NOT NULL,
  `v_state` varchar(25) NOT NULL,
  `v_city` varchar(25) NOT NULL,
  `v_pincode` smallint(6) NOT NULL,
  `v_country` varchar(25) NOT NULL,
  `v_gst` varchar(128) NOT NULL,
  `v_pan` varchar(128) NOT NULL,
  `v_mobile` bigint(20) NOT NULL,
  `v_alt` bigint(20) NOT NULL,
  `v_email` varchar(25) NOT NULL,
  `v_status` tinyint(2) NOT NULL,
  `v_createdDate` datetime(5) NOT NULL,
  `v_modifiedDate` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendorcontact`
--

CREATE TABLE `vendorcontact` (
  `vc_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `vc_name` varchar(255) NOT NULL,
  `vc_mobile` bigint(25) NOT NULL,
  `vc_designation` varchar(255) NOT NULL,
  `vc_email` varchar(255) NOT NULL,
  `vc_status` tinyint(2) NOT NULL,
  `vc_createdDate` datetime(5) NOT NULL,
  `vc_modifiedDate` datetime(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `clientcontact`
--
ALTER TABLE `clientcontact`
  ADD PRIMARY KEY (`cc_id`);

--
-- Indexes for table `colour`
--
ALTER TABLE `colour`
  ADD PRIMARY KEY (`cl_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `dimension`
--
ALTER TABLE `dimension`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `invoice_products`
--
ALTER TABLE `invoice_products`
  ADD PRIMARY KEY (`ip_id`);

--
-- Indexes for table `paymentmode`
--
ALTER TABLE `paymentmode`
  ADD PRIMARY KEY (`pm_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`pi_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`pd_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sp_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `vendorcontact`
--
ALTER TABLE `vendorcontact`
  ADD PRIMARY KEY (`vc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clientcontact`
--
ALTER TABLE `clientcontact`
  MODIFY `cc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `colour`
--
ALTER TABLE `colour`
  MODIFY `cl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dimension`
--
ALTER TABLE `dimension`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_products`
--
ALTER TABLE `invoice_products`
  MODIFY `ip_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paymentmode`
--
ALTER TABLE `paymentmode`
  MODIFY `pm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `pi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendorcontact`
--
ALTER TABLE `vendorcontact`
  MODIFY `vc_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
