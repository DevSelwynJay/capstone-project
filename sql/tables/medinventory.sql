-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2022 at 01:47 PM
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
(7, 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2021-11-05'),
(8, 'calpol', 'Medicine', 'pain reliver', '500mg', 33, '2021-08-30', '2022-03-25', '2021-11-05'),
(15, 'IPV', 'Vaccine', 'child immunization', '120ml', 196, '2021-11-01', '2022-01-28', '2021-11-20'),
(20, 'diatabs', 'Medicine', 'antibiotics', '500mg', 110, '2021-11-07', '2022-01-28', '2021-11-22'),
(32, 'OPV', 'Vaccine', 'child immunization', '100ml', 498, '2021-11-02', '2021-12-24', '2021-11-30'),
(36, 'calpol', 'Medicine', 'pain reliver', '250mg', 36, '2021-12-01', '2021-12-31', '2021-12-13'),
(37, 'paracetamol', 'Medicine', 'antibiotics', '500mg', 100, '2021-10-31', '2022-01-08', '2021-11-05'),
(38, 'calpol', 'Medicine', 'pain reliver', '250mg', 64, '2021-12-01', '2021-12-31', '2021-12-20'),
(39, 'paracetamol', 'Medicine', 'antibiotics', '500mg', 495, '2021-10-31', '2028-01-13', '2021-12-30'),
(40, 'IPV', 'Vaccine', 'child immunization', '100ml', 498, '2021-11-02', '2021-12-24', '2021-11-30'),
(41, 'BCG', 'Vaccine', 'child immunization', '100ml', 498, '2021-11-02', '2021-12-24', '2021-11-30'),
(42, 'MMR', 'Vaccine', 'child immunization', '100ml', 498, '2021-11-02', '2021-12-24', '2021-11-30'),
(43, 'Pfizer', 'Vaccine', 'Covid Vaccine', '100ml', 498, '2021-11-02', '2021-12-24', '2021-11-30'),
(44, 'OPV', 'Vaccine', 'child immunization', '100ml', 450, '2021-11-02', '2021-12-24', '2021-11-30'),
(45, 'IPV', 'Vaccine', 'child immunization', '100ml', 555, '2021-11-02', '2021-12-24', '2021-11-30'),
(46, 'BCG', 'Vaccine', 'child immunization', '100ml', 555, '2021-11-02', '2021-12-24', '2021-11-30'),
(47, 'MMR', 'Vaccine', 'child immunization', '100ml', 555, '2021-11-02', '2021-12-24', '2021-11-30'),
(48, 'Pfizer', 'Vaccine', 'Covid Vaccine', '100ml', 555, '2021-11-02', '2021-12-24', '2021-11-30');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
