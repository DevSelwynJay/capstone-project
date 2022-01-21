-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 10:26 AM
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
  `id` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(11) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `criticalstock` int(11) NOT NULL,
  `mfgdate` date NOT NULL,
  `expdate` date NOT NULL,
  `dateadded` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medinventory`
--

INSERT INTO `medinventory` (`id`, `name`, `category`, `subcategory`, `dosage`, `stock`, `criticalstock`, `mfgdate`, `expdate`, `dateadded`) VALUES
('15', 'IPV', 'Vaccine', 'child immunization', '120ml', 196, 50, '2021-11-01', '2022-02-16', '2021-11-20'),
('20', 'diatabs', 'Medicine', 'antibiotics', '500mg', 115, 50, '2021-11-07', '2022-01-31', '2021-11-22'),
('2022', 'Calpol', 'Medicine', 'Gamot', '12ml', 150, 150, '2022-01-07', '2022-01-29', '2022-01-21'),
('2022-04-250452', 'Calpol', 'Medicine', 'Gamot', '150', 150, 12, '2022-01-01', '2022-01-29', '2022-01-21'),
('2022-04-772295', 'Calpol', 'Medicine', 'Gamot', '500ml', 150, 12, '2022-01-01', '2022-01-29', '2022-01-21'),
('2022-05-086884', 'Moderna', 'Vaccine', 'Covid', '12ml', 15, 12, '2022-01-01', '2022-01-29', '2022-01-21'),
('32', 'OPV', 'Vaccine', 'child immunization', '100ml', 498, 500, '2021-11-02', '2022-06-08', '2021-11-30'),
('37', 'paracetamol', 'Medicine', 'antibiotics', '500mg', 125, 2000, '2021-10-31', '2023-01-11', '2021-11-05'),
('38', 'calpol', 'Medicine', 'pain reliver', '250mg', 64, 20, '2021-12-01', '2023-12-13', '2021-12-20'),
('39', 'paracetamol', 'Medicine', 'antibiotics', '500mg', 495, 150, '2021-10-31', '2028-01-13', '2021-12-30'),
('41', 'BCG', 'Vaccine', 'child immunization', '100ml', 498, 180, '2021-11-02', '2024-03-13', '2021-11-30'),
('43', 'Pfizer', 'Vaccine', 'Covid', '100ml', 497, 500, '2021-11-02', '2022-09-07', '2021-11-30'),
('47', 'MMR', 'Vaccine', 'child immunization', '100ml', 555, 500, '2021-11-02', '2023-01-11', '2021-11-30'),
('48', 'Calpol', 'Medicine', 'Gamot', '125', 150, 120, '2022-01-07', '2022-01-29', '2022-01-21'),
('8', 'calpol', 'Medicine', 'pain reliver', '500mg', 55, 100, '2021-08-30', '2022-03-25', '2021-11-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medinventory`
--
ALTER TABLE `medinventory`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
