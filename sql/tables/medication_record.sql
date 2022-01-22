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
-- Table structure for table `medication_record`
--

CREATE TABLE `medication_record` (
  `event_id` int(11) NOT NULL,
  `admin_id` varchar(50) NOT NULL,
  `patient_id` varchar(50) NOT NULL,
  `patient_type` varchar(50) NOT NULL,
  `patient_purok` char(1) NOT NULL COMMENT '1 to 7',
  `type` varchar(50) NOT NULL DEFAULT 'Medicine' COMMENT 'Medicine',
  `medicine_id` varchar(50) NOT NULL,
  `medicine_name` varchar(50) NOT NULL,
  `medicine_sub_category` varchar(50) NOT NULL,
  `given_med_quantity` varchar(50) NOT NULL COMMENT 'ilang piraso ng gamot binigay',
  `dosage` varchar(50) NOT NULL COMMENT 'can be in mg/ g',
  `no_times` varchar(50) NOT NULL COMMENT 'per day\r\n',
  `interval_days` varchar(50) NOT NULL DEFAULT '0' COMMENT 'by default 0 (daily ang pag inum)',
  `date_given` timestamp NOT NULL DEFAULT current_timestamp(),
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'kelang start inumin',
  `end_date` timestamp NULL DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medication_record`
--

INSERT INTO `medication_record` (`event_id`, `admin_id`, `patient_id`, `patient_type`, `patient_purok`, `type`, `medicine_id`, `medicine_name`, `medicine_sub_category`, `given_med_quantity`, `dosage`, `no_times`, `interval_days`, `date_given`, `start_date`, `end_date`, `description`) VALUES
(2, '2021-01-111222', '2022-03-080861', 'Minor', '4', 'Medicine', '2022-04-223587', 'Paracetamol', 'antibiotics', '3', '500mg', '3', '0', '2022-01-22 08:01:41', '2022-01-21 16:00:00', '2022-01-21 16:00:00', 'headache');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medication_record`
--
ALTER TABLE `medication_record`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medication_record`
--
ALTER TABLE `medication_record`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
