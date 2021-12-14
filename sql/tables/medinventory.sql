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
-- Table structure for table `medinventory`
--

CREATE TABLE `medinventory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `mfgdate` date NOT NULL,
  `expdate` date NOT NULL,
  `dateadded` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medinventory`
--

INSERT INTO `medinventory` (`id`, `name`, `category`, `subcategory`, `dosage`, `stock`, `mfgdate`, `expdate`, `dateadded`) VALUES
(7, 'paracetamol', 'gamot', 'antibiotics', '25mg', 1548, '2021-10-31', '2022-01-08', '2021-11-05'),
(8, 'calpol', 'gamot', '', '', 1, '2021-08-30', '2022-03-25', '2021-11-05'),
(15, 'asdada', 'qweq', '', '', 20, '2021-11-01', '2022-01-28', '2021-11-20'),
(20, 'diatabs', 'Medicine', '', '', 120, '2021-11-07', '2022-01-28', '2021-11-22'),
(32, 'asda', 'Select', '', '', 12, '2021-11-02', '2021-12-24', '2021-11-30'),
(35, 'biogesic', 'Medicine', '', '', 123, '2021-12-02', '2021-12-23', '2021-12-04'),
(36, 'calpol', 'medicine', 'aaa', '', 12, '2021-12-01', '2021-12-31', '2021-12-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medinventory`
--
ALTER TABLE `medinventory`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medinventory`
--
ALTER TABLE `medinventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
