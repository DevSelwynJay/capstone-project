-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 07:51 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
-- Table structure for table `patient_archive`
--

CREATE TABLE `patient_archive` (
  `account_type` int(1) NOT NULL DEFAULT 2 COMMENT '2 patient',
  `id` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL COMMENT 'Male Female',
  `birthday` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `civil_status` varchar(30) NOT NULL,
  `blood_type` varchar(20) DEFAULT NULL,
  `email` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `OTP` varchar(6) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_archive`
--

INSERT INTO `patient_archive` (`account_type`, `id`, `last_name`, `first_name`, `middle_name`, `gender`, `birthday`, `address`, `occupation`, `civil_status`, `blood_type`, `email`, `password`, `contact_no`, `OTP`, `date_created`) VALUES
(2, '2021-02-111242', 'Galvez', 'Irish', 'D.', 'Female', '2000-09-27', 'Sto. Rosario Paombong Bulacan', 'Doctor', 'Single', 'O', 'galvezirish144@gmail.com', 'qwer', '09199480221', NULL, '2021-09-20 07:28:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient_archive`
--
ALTER TABLE `patient_archive`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`contact_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
