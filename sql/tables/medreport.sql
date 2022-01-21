-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 01:36 PM
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
-- Table structure for table `medreport`
--

CREATE TABLE `medreport` (
  `event_id` int(11) NOT NULL DEFAULT 0 COMMENT 'para lang sa med at vaccine released at ',
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `mfgdate` date NOT NULL,
  `expdate` date NOT NULL,
  `dateadded` date NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medreport`
--

INSERT INTO `medreport` (`event_id`, `id`, `name`, `category`, `subcategory`, `dosage`, `stock`, `mfgdate`, `expdate`, `dateadded`, `type`) VALUES
(1, '2022-04-243587', 'Paracetamol', 'Medicine', 'antibiotics', '500mg', 4, '2021-10-31', '2028-01-13', '2022-01-21', 'Medicine'),
(1, '2022-05-086555', 'BCG', 'Vaccine', 'child immunization', '100ml', 1, '2021-11-02', '2024-03-13', '2022-01-21', 'Vaccine');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medreport`
--
ALTER TABLE `medreport`
  ADD KEY `id` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
