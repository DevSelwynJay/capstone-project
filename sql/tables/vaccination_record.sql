-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2022 at 05:31 PM
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
-- Table structure for table `vaccination_record`
--

CREATE TABLE `vaccination_record` (
  `event_id` int(11) NOT NULL,
  `admin_id` varchar(50) NOT NULL,
  `patient_id` varchar(50) NOT NULL,
  `patient_type` varchar(50) NOT NULL,
  `patient_purok` char(1) NOT NULL COMMENT '1 to 7',
  `type` varchar(20) NOT NULL DEFAULT 'Vaccine',
  `vaccine_id` varchar(50) NOT NULL,
  `vaccine_name` varchar(50) NOT NULL,
  `vaccine_dosage` varchar(50) NOT NULL,
  `vaccine_sub_category` varchar(50) NOT NULL COMMENT 'child pregnant covid others',
  `reccommended_no_of_dosage` varchar(50) NOT NULL COMMENT 'gaano kadami ang dapat na turok',
  `date_given` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'just a redundant to match column name in medication record',
  `date_vaccinated` timestamp NOT NULL DEFAULT current_timestamp(),
  `expected_next_date_vaccination` timestamp NULL DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination_record`
--

INSERT INTO `vaccination_record` (`event_id`, `admin_id`, `patient_id`, `patient_type`, `patient_purok`, `type`, `vaccine_id`, `vaccine_name`, `vaccine_dosage`, `vaccine_sub_category`, `reccommended_no_of_dosage`, `date_given`, `date_vaccinated`, `expected_next_date_vaccination`, `description`) VALUES
(1, '2021-01-111222', '2022-02-023567', 'Adult', '1', 'Vaccine', '2022-05-086555', 'BCG', '100ml', 'child immunization', '1', '2022-01-22 08:22:32', '2022-01-22 08:22:32', NULL, '1st BCG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vaccination_record`
--
ALTER TABLE `vaccination_record`
  ADD PRIMARY KEY (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vaccination_record`
--
ALTER TABLE `vaccination_record`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
