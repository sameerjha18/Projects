-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2020 at 02:13 PM
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
-- Table structure for table `p_specialized`
--

CREATE TABLE `p_specialized` (
  `psp_id` int(11) NOT NULL,
  `v_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `psp_status` tinyint(2) NOT NULL,
  `psp_createdDate` datetime NOT NULL,
  `psp_modifiedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `p_specialized`
--

INSERT INTO `p_specialized` (`psp_id`, `v_id`, `p_id`, `psp_status`, `psp_createdDate`, `psp_modifiedDate`) VALUES
(1, 1, 1, 1, '2020-12-17 12:35:40', '2020-12-17 01:54:01'),
(2, 1, 2, 1, '2020-12-17 12:36:05', '2020-12-17 01:55:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `p_specialized`
--
ALTER TABLE `p_specialized`
  ADD PRIMARY KEY (`psp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `p_specialized`
--
ALTER TABLE `p_specialized`
  MODIFY `psp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
