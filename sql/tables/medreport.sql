-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2022 at 07:14 PM
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
  `id` int(11) NOT NULL,
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
(4, 20, 'diatabs', 'Medicine', 'antibiotics', '500mg', 7, '2021-11-07', '2022-01-31', '2022-01-18', 'Medicine'),
(2, 41, 'BCG', 'Vaccine', 'child immunization', '100ml', 1, '2021-11-02', '2024-03-13', '2022-01-18', 'Vaccine'),
(3, 41, 'BCG', 'Vaccine', 'child immunization', '100ml', 1, '2021-11-02', '2024-03-13', '2022-01-18', 'Vaccine'),
(3, 20, 'diatabs', 'Medicine', 'antibiotics', '500mg', 2, '2021-11-07', '2022-01-31', '2022-01-18', 'Medicine');

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
