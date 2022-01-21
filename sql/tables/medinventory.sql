-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 01:35 PM
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
('2022-04-243337', 'Pfizer', 'Vaccine', 'Covid', '100ml', 100, 50, '2021-11-02', '2022-09-07', '2021-11-22'),
('2022-04-243587', 'Paracetamol', 'Medicine', 'antibiotics', '500mg', 486, 150, '2021-10-31', '2028-01-13', '2021-12-30'),
('2022-04-492307', 'Diatabs', 'Medicine', 'antidiarrheal agents', '500mg', 69, 10, '2021-12-07', '2023-02-09', '2022-01-21'),
('2022-04-524021', 'Alaxan', 'Medicine', 'pain reliver', '500mg', 120, 15, '2022-01-13', '2025-01-15', '2022-01-21'),
('2022-04-772295', 'Calpol', 'Medicine', 'Gamot', '500ml', 150, 12, '2022-01-01', '2022-01-29', '2022-01-21'),
('2022-05-000004', 'MMR', 'Vaccine', 'child immunization', '100ml', 555, 500, '2021-11-02', '2023-01-11', '2021-11-30'),
('2022-05-086111', 'OPV', 'Vaccine', 'child immunization', '100ml', 498, 500, '2021-11-02', '2022-06-08', '2021-11-30'),
('2022-05-086254', 'IPV', 'Vaccine', 'child immunization', '120ml', 200, 50, '2021-11-01', '2022-02-16', '2021-11-20'),
('2022-05-086555', 'BCG', 'Vaccine', 'child immunization', '100ml', 496, 180, '2021-11-02', '2024-03-13', '2021-11-30'),
('2022-05-086884', 'Moderna', 'Vaccine', 'Covid', '12ml', 15, 12, '2021-11-17', '2022-01-27', '2022-01-21');

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
