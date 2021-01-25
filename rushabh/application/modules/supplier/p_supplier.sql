-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2020 at 10:07 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drishyasolutions_rushabh`
--

-- --------------------------------------------------------

--
-- Table structure for table `p_supplier`
--

CREATE TABLE `p_supplier` (
  `ps_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ps_status` tinyint(2) NOT NULL,
  `ps_createdDate` datetime NOT NULL,
  `ps_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_supplier`
--

INSERT INTO `p_supplier` (`ps_id`, `v_id`, `p_id`, `s_id`, `ps_status`, `ps_createdDate`, `ps_modifiedDate`) VALUES
(1, 1, 2, 2, 1, '2020-12-17 09:16:41', '2020-12-17 10:04:50'),
(2, 1, 2, 1, 1, '2020-12-17 09:17:06', '2020-12-17 09:17:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p_supplier`
--
ALTER TABLE `p_supplier`
  ADD PRIMARY KEY (`ps_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `p_supplier`
--
ALTER TABLE `p_supplier`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
