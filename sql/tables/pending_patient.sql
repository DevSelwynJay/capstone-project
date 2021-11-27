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
-- Table structure for table `pending_patient`
--

CREATE TABLE `pending_patient` (
  `id` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(50) NOT NULL,
  `occupation` varchar(50) DEFAULT NULL,
  `civil_status` varchar(30) NOT NULL,
  `email` char(50) NOT NULL,
  `password` char(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending_patient`
--

INSERT INTO `pending_patient` (`id`, `last_name`, `first_name`, `middle_name`, `gender`, `birthday`, `address`, `occupation`, `civil_status`, `email`, `password`, `contact_no`, `date_created`) VALUES
('2021-02-538075', 'Sample', 'Al', 'Biler', 'Male', '2002-10-10', '5 Purok 3 Sto. Rosario Paombong Bulacan', 'Tambay', 'Single', 'benitez.alfredo.b.1128@gmail.com', 'mukamo11', '09422697900', '2021-11-27 06:41:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pending_patient`
--
ALTER TABLE `pending_patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`contact_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
