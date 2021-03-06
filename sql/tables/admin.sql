-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2022 at 05:42 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `account_type` int(1) NOT NULL DEFAULT 1 COMMENT '0 superAdmin, 1 admin, 2 patient',
  `id` varchar(50) NOT NULL,
  `account_status` int(11) NOT NULL DEFAULT 1 COMMENT '//1 active 0 deactive',
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL COMMENT 'Male Female',
  `birthday` date DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `email` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL,
  `OTP` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`account_type`, `id`, `account_status`, `last_name`, `first_name`, `middle_name`, `gender`, `birthday`, `address`, `email`, `password`, `contact_no`, `role`, `OTP`) VALUES
(1, '2021-01-111222', 1, 'Benitez', 'Alfred', 'Bas', 'Male', '2003-01-09', '2  Sto. Rosario Paombong Bulacan', 'alfredogiebenitez@gmail.com', 'Mukamo11', '09422697900', 'Health Worker', '735983'),
(1, '2021-01-212222', 1, 'Benitez', 'Ogie', 'Bas ', 'Male', '2005-12-31', '3 Sto. Rosario Paombong Bulacan', 'alfredo.benitez.b@bulsu.edu.ph', 'mukamo11', '09542120321', 'Health Worker', '358530');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gmail` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
