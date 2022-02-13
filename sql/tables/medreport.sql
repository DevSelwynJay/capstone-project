-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2022 at 03:47 AM
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
  `event_id` int(11) NOT NULL DEFAULT 0 COMMENT 'para lang sa med at vaccine released at ',
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gen_name` varchar(255) NOT NULL,
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

INSERT INTO `medreport` (`event_id`, `id`, `name`, `gen_name`, `category`, `subcategory`, `dosage`, `stock`, `mfgdate`, `expdate`, `dateadded`, `type`) VALUES
(1, '2022-05-086555', 'BCG', '', 'Vaccine', 'child immunization', '100ml', 1, '2021-11-02', '2024-03-13', '2022-01-22', 'Vaccine'),
(2, '2022-04-223587', 'Paracetamol', '', 'Medicine', 'antibiotics', '500mg', 3, '2021-10-31', '2028-01-13', '2022-01-22', 'Medicine'),
(0, '2022-05-086254', 'IPV', '', 'Vaccine', 'child immunization', '120ml', 100, '2021-11-01', '2022-02-17', '2022-01-22', 'Update'),
(0, '2022-04-772295', 'Calpol', '', 'Medicine', 'Gamot', '500mg', 150, '2022-01-01', '2022-02-10', '2022-01-22', 'Update'),
(0, '2022-04-942529', 'Neozep', '', 'Medicine', 'colds', '250mg', 40, '2021-08-18', '2024-04-18', '2022-01-22', 'Add'),
(0, '2022-04-942529', 'Neozep', '', 'Medicine', 'colds', '250mg', 42, '2021-08-18', '2024-04-18', '2022-01-23', 'Update'),
(0, '2022-04-519167', 'Paracetamol', '', 'Medicine', 'headache', '250mg', 120, '2021-10-06', '2030-01-09', '2022-01-23', 'Add'),
(3, '2022-04-772295', 'Calpol', '', 'Medicine', 'Gamot', '500mg', 5, '2022-01-01', '2022-02-10', '2022-01-23', 'Medicine'),
(0, '2022-05-000004', 'OPV', '', 'Vaccine', 'Child Immunization', '100ml', 555, '2021-11-02', '2022-06-08', '2022-02-02', 'Update'),
(0, '2022-04-223587', 'Paracetamol', '', 'Medicine', 'Antibiotics', '500mg', 497, '2021-10-31', '2028-01-13', '2022-02-02', 'Update'),
(0, '2022-04-223587', 'Paracetamol', '', 'Medicine', 'Antibiotics', '500mg', 497, '2021-10-31', '2028-01-13', '2022-02-02', 'Update'),
(0, '2022-04-223587', 'Paracetamol', '', 'Medicine', 'Antibiotics', '500mg', 497, '2021-10-31', '2028-01-13', '2022-02-02', 'Update'),
(0, '2022-04-223587', 'Paracetamol', '', 'Medicine', 'Antibiotics', '500mg', 497, '2021-10-31', '2028-01-13', '2022-02-02', 'Update'),
(0, '2022-04-519167', 'Paracetamol', '', 'Medicine', 'Headache', '250mg', 120, '2021-10-06', '2030-01-09', '2022-02-02', 'Update'),
(0, '2022-04-223587', 'Paracetamol', '', 'Medicine', 'Antibiotics', '500mg', 125, '2021-10-31', '2028-01-13', '2022-02-03', 'Update'),
(0, '2022-04-519167', 'Paracetamol', '', 'Medicine', 'Headache', '250mg', 120, '2021-10-06', '2030-01-09', '2022-02-03', 'Update'),
(0, '2022-04-534488', 'Paracetamol', '', 'Medicine', 'Antibiotics', '500mg', 150, '2022-02-01', '2022-02-24', '2022-02-04', 'Add'),
(0, '2022-05-029279', 'Moderna', '', 'Vaccine', 'Covid', '12ml', 150, '2022-02-01', '2022-02-26', '2022-02-04', 'Add'),
(0, '2022-04-524021', 'Alaxan', '', 'Medicine', 'Pain Reliver', '500mg', 120, '2022-01-13', '2025-01-15', '2022-02-04', 'Update'),
(0, '2022-04-524021', 'Alaxan', '', 'Medicine', 'Pain Reliver', '500mg', 121, '2022-01-13', '2025-01-15', '2022-02-04', 'Update'),
(0, '2022-04-223587', 'Paracetamol', '', 'Medicine', 'Antibiotics', '500mg', 125, '2021-10-31', '2028-01-13', '2022-02-04', 'Update'),
(0, '2022-04-223587', 'Paracetamol', '', 'Medicine', 'Antibiotics', '500mg', 125, '2021-10-31', '2028-01-13', '2022-02-04', 'Update'),
(0, '2022-04-524021', 'Alaxan', '', 'Medicine', 'Pain Reliver', '500mg', 120, '2022-01-13', '2025-01-15', '2022-02-05', 'Update'),
(0, '2022-04-524021', 'Alaxan', '', 'Medicine', 'Pain Reliver', '500mg', 120, '2022-01-13', '2025-01-15', '2022-02-06', 'Update'),
(0, '2022-05-086555', 'BCG', '', 'Vaccine', 'Child Immunization', '100ml', 4, '2021-11-02', '2024-03-13', '2022-02-09', 'Update'),
(0, '2022-05-086555', 'BCG', '', 'Vaccine', 'Child Immunization', '100ml', -5, '2021-11-02', '2024-03-13', '2022-02-09', 'Update'),
(0, '2022-05-086555', 'BCG', '', 'Vaccine', 'Child Immunization', '100ml', 5, '2021-11-02', '2024-03-13', '2022-02-09', 'Update'),
(27, '2022-04-492307', 'Diatabs', '', 'Medicine', 'antidiarrheal agents', '500mg', 1, '2021-12-07', '2023-02-09', '2022-02-09', 'Medicine'),
(0, '2022-04-300986', 'Calpol', 'Paracetamol', 'Medicine', 'Antibiotics', '500', 120, '2022-02-01', '2022-02-12', '2022-02-12', 'Add'),
(0, '2022-05-029279', 'Moderna', '', 'Vaccine', 'Covid', '12ml', 150, '2022-02-01', '2022-02-12', '2022-02-12', 'Update'),
(0, '2022-04-942529', 'Neozep', '', 'Medicine', 'Colds', '250mg', 1, '2021-08-18', '2024-04-18', '2022-02-13', 'Update');

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
