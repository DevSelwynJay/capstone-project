-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2022 at 10:22 AM
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

INSERT INTO `walk_in_patient` (`account_type`, `account_status`, `id`, `last_name`, `first_name`, `middle_name`, `suffix`, `gender`, `birthday`, `purok`, `house_no`, `address`, `occupation`, `civil_status`, `blood_type`, `weight`, `height`, `patient_type`, `email`, `password`, `contact_no`, `OTP`, `date_created`) VALUES
(2, 1, '2022-02-023567', 'Dela cruz', 'Sample', 'Sample', 'III', 'Male', '2014-01-07', '1', '2', 'Sto. Rosario Paombong Bulacan', '', 'Single', 'sample', '25kg', '5`6', 'Adult', 'none-2022-02-023567', 'e2qB41LD', 'none-2022-02-023567', '', '2022-01-19 07:47:35'),
(2, 1, '2022-02-306030', 'Faustino', 'Alfredo', 'Perez', 'Jr', 'Male', '2016-07-13', '3', '29', 'Sto. Rosario Paombong Bulacan', '', 'Single', 'O', '7kg', '20cm', 'Infant', 'lowelllacanilao@gmail.com', 'HnqLmeO5', 'none-2022-02-306030', '', '2022-01-11 06:06:12'),
(2, 1, '2022-02-336149', 'Aguilar', 'Eliezer', 'Acuña', '', 'Male', '1999-02-01', '3', '47', 'Sto. Rosario Paombong Bulacan', 'Student', 'Single', 'A', '85kg', '175cm', 'Adult', 'faustino.selwynjay.d.0493@gmail.com', '7zbBXOUE', 'none-2022-02-336149', '', '2022-01-11 03:47:58'),
(2, 1, '2022-02-639914', 'Benitez', 'Lowell', 'Galvez', '', 'Male', '1990-08-01', '6', '15', 'Sto. Rosario Paombong Bulacan', 'Driver', 'Married', 'AB', '60kg', '165cm', 'Adult', 'dalusung.markjoseph.m.7992@gmail.com', '6jAWH0LD', 'none-2022-02-639914', '', '2022-01-11 04:49:33'),
(2, 1, '2022-02-870336', 'Mercado', 'Mark', 'Dalusung', '', 'Male', '1989-04-30', '6', '31', 'Sto. Rosario Paombong Bulacan', 'Teacher', 'Married', 'O', '60', '153', 'PWD', 'galvez.irishnicole.d.0533@gmail.com', 'aoAik6B3', 'none-2022-02-870336', '', '2022-01-11 06:00:21'),
(2, 1, '2022-02-878400', 'Sample sample', 'Sample', 'Sample', '', 'Male', '2014-01-15', '1', '52', 'Sto. Rosario Paombong Bulacan', '', 'Single', 'o', '150kg', '100cm', 'Adult', 'none-2022-02-878400', 'xsv8wlRu', 'none-2022-02-878400', '', '2022-01-19 05:47:36'),
(3, 1, '2022-03-080861', 'Cruz', 'Bebang', 'Biler', '', 'Male', '2008-01-16', '4', '', 'Sto. Rosario Paombong Bulacan', '', 'Single', '', '', '', 'Minor', 'alfredo.benitez.b.1128@gmail.com', 'mukamo11', '09422698544', '', '2022-01-12 13:40:46'),
(3, 1, '2022-03-304737', 'Florentino', 'Dominic', 'Alba', '', 'Male', '2000-03-17', '7', '', 'Sto. Rosario Paombong Bulacan', 'nurse', 'Single', '', '', '', 'Adult', 'ian.dominic032@gmail.com', 'mukamo11', '09983672680', '', '2022-01-11 04:48:23'),
(3, 1, '2022-03-805831', 'Benitez', 'Alfredo', 'Bas', '', 'Male', '2012-01-18', '4', '', 'Sto. Rosario Paombong Bulacan', '', 'Single', '', '', '', 'Minor', 'benitez.alfredo.b.1128@gmail.com', 'mukamo11', '09422697933', '', '2022-01-20 05:44:12'),
(3, 1, '2022-03-853659', 'Cajucom', 'Kurth', 'Zabala', '', 'Male', '2000-10-04', '4', '', 'Sto. Rosario Paombong Bulacan', 'student', 'Single', '', '', '', 'Adult', 'kurthcajucom4@gmail.com', 'mukamo11', '09750075284', '245431', '2022-01-11 04:48:14'),
(3, 1, '2022-03-969011', 'De leon', 'John david', 'Bernardo', '', 'Male', '2000-12-25', '3', '', 'Sto. Rosario Paombong Bulacan', 'Student', 'Single', '', '', '', 'Adult', 'johndaviddeleon18@gmail.com', 'mukamo11', '09161103174', '', '2022-01-11 03:53:54'),
(3, 1, '2022-03-969456', 'Mercado', 'Ogie', 'Consiles', '', 'Male', '2000-12-25', '3', '', 'Sto. Rosario Paombong Bulacan', 'Student', 'Single', '', '', '', 'Adult', 'cajucom.kurth.z.1699@gmail.com', 'mukamo11', '09161103174', '', '2022-01-11 03:53:54');

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
