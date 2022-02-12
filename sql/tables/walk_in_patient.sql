-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2022 at 05:35 PM
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
-- Table structure for table `walk_in_patient`
--

CREATE TABLE `walk_in_patient` (
  `account_type` int(1) NOT NULL COMMENT '2 walk in// 3 register online ',
  `account_status` int(1) NOT NULL DEFAULT 1 COMMENT '1 active 0 disable',
  `id` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `suffix` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL COMMENT 'Male Female',
  `birthday` date NOT NULL,
  `purok` char(1) NOT NULL,
  `house_no` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `civil_status` varchar(30) NOT NULL,
  `blood_type` varchar(20) NOT NULL,
  `weight` varchar(50) NOT NULL COMMENT 'in KG',
  `height` varchar(50) NOT NULL COMMENT 'in CENTIMETER',
  `allergies` text NOT NULL,
  `patient_type` varchar(100) NOT NULL COMMENT 'separate by space if many',
  `email` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `OTP` varchar(6) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `walk_in_patient`
--

INSERT INTO `walk_in_patient` (`account_type`, `account_status`, `id`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `birthday`, `purok`, `house_no`, `address`, `occupation`, `civil_status`, `blood_type`, `weight`, `height`, `allergies`, `patient_type`, `email`, `password`, `contact_no`, `OTP`, `date_created`) VALUES
(2, 1, '2022-02-101739', 'Sample', 'Sample', 'Sample', '', 'Male', '2021-02-02', '2', '1', 'Sto. Rosario Paombong Bulacan', '', 'Single', '', '', '', '', 'Infant', 'none-2022-02-101739', 'VGQeuYqf', 'none-2022-02-101739', '', '2022-02-07 06:24:17'),
(2, 1, '2022-02-577690', 'Cruz', 'Aven', 'Biler', 'jr', 'Male', '2019-01-09', '1', '1', 'Sto. Rosario Paombong Bulacan', 'Driver', 'Married', 'ab+', '150kg', '150cm', '', 'Adult', 'benitez.alfredo.b.1128@gmail.com', '9EakuXAL', 'none-2022-02-577690', '', '2022-02-06 14:29:56'),
(2, 1, '2022-02-901781', 'Sample2', 'Sample2', 'Sample2', '', 'Male', '1994-02-23', '1', '12', 'Sto. Rosario Paombong Bulacan', '', 'Single', 'o', '50kg', '160cm', 'sa medicol may side effect\n', 'Adult', 'none-2022-02-901781', 'NV6qbJyZ', 'none-2022-02-901781', '', '2022-02-12 14:10:55'),
(2, 1, '2022-02-918785', 'Benitez', 'Ogie', 'Bas', '', 'Male', '2007-02-07', '1', '0', 'Sto. Rosario Paombong Bulacan', '', 'Single', '', '', '', '', 'Minor', 'none-2022-02-918785', 'IRExsLJN', 'none-2022-02-918785', '', '2022-02-07 06:23:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `walk_in_patient`
--
ALTER TABLE `walk_in_patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`contact_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
