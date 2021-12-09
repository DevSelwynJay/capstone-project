-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2021 at 02:42 AM
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
-- Table structure for table `medinventory`
--

CREATE TABLE `medinventory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `mfgdate` date NOT NULL,
  `expdate` date NOT NULL,
  `dateadded` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medinventory`
--

INSERT INTO `medinventory` (`id`, `name`, `category`, `subcategory`, `stock`, `mfgdate`, `expdate`, `dateadded`) VALUES
(19, 'Paracetamol Biogesic', 'Medicine', '', 500, '2021-08-04', '2022-11-17', '2021-11-22'),
(20, 'Diatabs', 'Medicine', '', 120, '2021-11-07', '2022-01-28', '2021-11-22'),
(32, 'OPV', 'Vaccine', 'Child', 1000, '2021-10-07', '2024-12-03', '2021-12-05'),
(33, 'IPV', 'Vaccine', 'Child', 1000, '2021-10-07', '2024-12-03', '2021-12-05'),
(34, 'Metropolol', 'Medicine', '', 1000, '2021-10-07', '2024-12-03', '2021-12-07'),
(35, 'Neozep', 'Medicine', '', 500, '2021-10-07', '2024-12-03', '2021-12-07'),
(36, 'Ambroxol', 'Medicine', '', 50, '2021-12-08', '2021-12-16', '2021-12-08');

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
