-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 05:28 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstonehis`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs_acc_req`
--

CREATE TABLE `logs_acc_req` (
  `log_id` int(11) NOT NULL,
  `admin_id` varchar(50) NOT NULL,
  `patient_id` varchar(50) NOT NULL,
  `admin_action` varchar(500) NOT NULL COMMENT '0 declined 1 accpeted',
  `description` varchar(500) NOT NULL,
  `date_occured` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs_acc_req`
--

INSERT INTO `logs_acc_req` (`log_id`, `admin_id`, `patient_id`, `admin_action`, `description`, `date_occured`) VALUES
(3, '2021-01-111222', '2022-03-549690', '0', 'nantrip lang', '2022-01-22 03:19:02'),
(4, '2021-01-111222', '2022-03-542653', '0', 'prank ung pic', '2022-01-22 06:16:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logs_acc_req`
--
ALTER TABLE `logs_acc_req`
  ADD PRIMARY KEY (`log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logs_acc_req`
--
ALTER TABLE `logs_acc_req`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
