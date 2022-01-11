-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2022 at 05:50 AM
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

INSERT INTO `walk_in_patient` (`account_type`, `account_status`, `id`, `last_name`, `first_name`, `middle_name`, `gender`, `birthday`, `purok`, `house_no`, `address`, `occupation`, `civil_status`, `blood_type`, `weight`, `height`, `patient_type`, `email`, `password`, `contact_no`, `OTP`, `date_created`) VALUES
(2, 1, '2022-02-336149', 'Aguilar', 'Eliezer', 'Acuña', 'Male', '1999-02-01', '3', '47', 'Sto. Rosario Paombong Bulacan', 'Student', 'Single', 'A', '85kg', '175cm', 'Adult', 'none-2022-02-336149', '7zbBXOUE', 'none-2022-02-336149', '', '2022-01-11 03:47:58'),
(2, 1, '2022-02-639914', 'Benitez', 'Lowell', 'Galvez', 'Male', '1990-08-01', '6', '15', 'Sto. Rosario Paombong Bulacan', 'Driver', 'Married', 'AB', '60kg', '165cm', 'Senior', 'none-2022-02-639914', '6jAWH0LD', 'none-2022-02-639914', '', '2022-01-11 04:49:33'),
(2, 1, '2022-02-779987', 'Cruz', 'Bebang', 'Biler', 'Male', '2009-10-14', '1', '0', 'Sto. Rosario Paombong Bulacan', '', 'Single', '', '', '', 'Minor', 'none-2022-02-779987', '', 'none-2022-02-779987', '', '2022-01-10 08:16:23'),
(3, 1, '2022-03-304737', 'Florentino', 'Dominic', 'Alba', 'Male', '2000-03-17', '7', '', 'Sto. Rosario Paombong Bulacan', 'nurse', 'Single', '', '', '', 'Adult', 'ian.dominic032@gmail.com', 'mukamo11', '09983672680', '', '2022-01-11 04:48:23'),
(3, 1, '2022-03-539441', 'Cruz', 'Fredie', 'Biler', 'Male', '2012-01-10', '2', '', 'Sto. Rosario Paombong Bulacan', '', 'Single', '', '', '', 'Minor', 'benitez.alfredo.b.1128@gmail.com', 'aaaaaaaa', '09422697903', '', '2022-01-10 09:59:18'),
(3, 1, '2022-03-853659', 'Cajucom', 'Kurth', 'Zabala', 'Male', '2000-10-04', '4', '', 'Sto. Rosario Paombong Bulacan', 'student', 'Single', '', '', '', 'Adult', 'kurthcajucom4@gmail.com', 'mukamo11', '09750075284', '', '2022-01-11 04:48:14'),
(3, 1, '2022-03-969011', 'De leon', 'John david', 'Bernardo', 'Male', '2000-12-25', '3', '', 'Sto. Rosario Paombong Bulacan', 'Student', 'Single', '', '', '', 'Adult', 'johndaviddeleon18@gmail.com', 'mukamo11', '09161103174', '', '2022-01-11 03:53:54');

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
