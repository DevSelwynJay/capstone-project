-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 03:30 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

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

INSERT INTO `medreport` (`id`, `name`, `category`, `subcategory`, `dosage`, `stock`, `mfgdate`, `expdate`, `dateadded`, `type`) VALUES
(1, 'diatabs', 'Medicine', '', '', 120, '2021-11-07', '2022-01-28', '2021-11-22', 'Add'),
(2, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-22', 'Add'),
(3, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(4, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(5, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(6, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(7, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(8, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(9, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(10, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(11, '', '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(12, 'a', 'a', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(13, 'asdada', '', '', '', 20, '2021-11-01', '2022-01-28', '2021-11-30', 'Update'),
(14, 'calpol', '', '', '', 1, '2021-08-30', '2022-03-25', '2021-11-30', 'Update'),
(15, 'asda', 'Select', '', '', 12, '2021-11-02', '2021-12-24', '2021-11-30', 'Add'),
(16, 'asda', '', '', '', 0, '2021-11-04', '2021-11-30', '2021-11-30', 'Add'),
(17, 'asda', 'Vaccine', '', '', 0, '2021-11-18', '2021-11-30', '2021-11-30', 'Add'),
(18, 'biogesicsssss', 'gamots', '', '', 1202, '2021-11-01', '2021-11-30', '2021-12-01', 'Delete'),
(19, 'asda', '', '', '', 0, '2021-11-04', '2021-11-30', '2021-12-01', 'Delete'),
(20, 'asda', 'Vaccine', '', '', 0, '2021-11-18', '2021-11-30', '2021-12-01', 'Delete'),
(21, 'propan tlc', 'vitamins', '', '', 123, '2021-11-04', '2021-12-01', '2021-12-04', 'Delete'),
(22, 'biogesic', 'Medicine', '', '', 123, '2021-12-02', '2021-12-23', '2021-12-04', 'Add');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medreport`
--
ALTER TABLE `medreport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medreport`
--
ALTER TABLE `medreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
