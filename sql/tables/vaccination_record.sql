-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 13, 2022 at 07:14 AM
-- Server version: 10.5.13-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u232612118_capstonehis`
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
(96, '2022-01-515702', '2022-02-306030', 'Infant', '3', 'Vaccine', '15', 'IPV', '120ml', 'child immunization', '2', '2022-01-12 12:29:05', '2022-01-12 12:29:05', '2022-02-09 00:00:00', 'unang ipv'),
(97, '2018-01-120123', '2022-02-259672', 'Adult', '1', 'Vaccine', '43', 'Pfizer', '100ml', 'Covid', '2', '2022-01-12 15:01:46', '2022-01-12 15:01:46', '2022-02-14 00:00:00', '1st dose'),
(98, '2018-01-120123', '2022-02-639914', 'Adult', '6', 'Vaccine', '45', 'IPV', '100ml', 'child immunization', '1', '2021-11-10 17:30:07', '2021-11-10 17:30:07', NULL, '1st ipv'),
(99, '2018-01-120123', '2022-02-306030', 'Infant', '3', 'Vaccine', '43', 'Pfizer', '100ml', 'Covid', '2', '2022-01-13 06:07:11', '2022-01-13 06:07:11', '2022-02-10 00:00:00', 'hehehehe'),
(100, '2022-01-419239', '2022-03-853659', 'Adult', '4', 'Vaccine', '43', 'Pfizer', '100ml', 'Covid', '1', '2022-01-13 06:32:35', '2022-01-13 06:32:35', NULL, 'Anti Covid');

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
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
