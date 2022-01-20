-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 10:19 AM
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
-- Table structure for table `declined_patient`
--

CREATE TABLE `declined_patient` (
  `account_type` int(1) NOT NULL DEFAULT 3 COMMENT '3 online registered patient',
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
  `patient_type` varchar(100) NOT NULL COMMENT 'separate by space if many',
  `email` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `OTP` varchar(6) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `declined_patient`
--

INSERT INTO `declined_patient` (`account_type`, `id`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `birthday`, `purok`, `house_no`, `address`, `occupation`, `civil_status`, `blood_type`, `weight`, `height`, `patient_type`, `email`, `password`, `contact_no`, `OTP`, `date_created`) VALUES
(3, '2022-03-302600', 'Benitez', 'Alfredo', 'Bas', '', 'Male', '1999-01-11', '1', '', 'Sto. Rosario Paombong Bulacan', '', 'Single', '', '', '', 'Adult', 'BENITEZ.ALFREDO.B.1128@GMAIL.COM', 'MUKAMO11', '09422697955', '', '2022-01-20 05:30:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `declined_patient`
--
ALTER TABLE `declined_patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`contact_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
