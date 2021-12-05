-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2021 at 07:15 AM
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
-- Table structure for table `walk_in_patient`
--

CREATE TABLE `walk_in_patient` (
  `account_type` int(1) NOT NULL DEFAULT 2 COMMENT '2 patient',
  `id` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
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
-- Dumping data for table `walk_in_patient`
--

INSERT INTO `walk_in_patient` (`account_type`, `id`, `last_name`, `first_name`, `middle_name`, `gender`, `birthday`, `purok`, `house_no`, `address`, `occupation`, `civil_status`, `blood_type`, `weight`, `height`, `patient_type`, `email`, `password`, `contact_no`, `OTP`, `date_created`) VALUES
(2, '2021-03-111222', 'Cruz', 'Bebang', 'Biler', 'Female', '2008-10-09', '1', '1', 'Sto. Rosario Paombong Bulacan', 'Sales Lady', 'Single', 'O', '60', '169', 'Minor', 'alfredpogiebenitez@gmail.com', 'mukamo11', '09422454512', '', '2021-10-25 07:28:47'),
(2, '2021-03-111243', 'Benitez', 'Beng', 'Bas', 'Female', '1995-10-11', '4', '2', 'Sto. Rosario Paombong Bulacan', 'Sales Lady', 'Single', 'A', '55', '155', 'Adult', 'benitez@gmail.com', 'mukamo11', '09422454513', '', '2021-11-28 07:28:47');

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
