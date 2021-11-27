-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 06:50 AM
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
  `stock` int(11) NOT NULL,
  `mfgdate` date NOT NULL,
  `expdate` date NOT NULL,
  `dateadded` date NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medreport`
--

INSERT INTO `medreport` (`id`, `name`, `category`, `subcategory`, `stock`, `mfgdate`, `expdate`, `dateadded`, `type`) VALUES
(1, 'diatabs', 'Medicine', '', 120, '2021-11-07', '2022-01-28', '2021-11-22', 'Add'),
(2, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-22', 'Add'),
(3, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(4, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(5, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(6, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(7, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(8, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(9, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(10, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(11, '', '', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add'),
(12, 'a', 'a', '', 0, '0000-00-00', '0000-00-00', '2021-11-26', 'Add');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
