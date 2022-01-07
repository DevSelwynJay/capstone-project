-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2022 at 01:13 PM
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
-- Table structure for table `emr_request`
--

CREATE TABLE `emr_request` (
  `request_id` int(50) NOT NULL,
  `patientOA_ID` varchar(50) NOT NULL,
  `date_requested` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0 not approved 1 approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `emr_request`
--

INSERT INTO `emr_request` (`request_id`, `patientOA_ID`, `date_requested`, `status`) VALUES
(6, '2021-02-052045', '2022-01-05 06:22:15', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emr_request`
--
ALTER TABLE `emr_request`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emr_request`
--
ALTER TABLE `emr_request`
  MODIFY `request_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
