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
(4, '20', 'diatabs', 'Medicine', 'antibiotics', '500mg', 7, '2021-11-07', '2022-01-31', '2022-01-18', 'Medicine'),
(2, '41', 'BCG', 'Vaccine', 'child immunization', '100ml', 1, '2021-11-02', '2024-03-13', '2022-01-18', 'Vaccine'),
(3, '41', 'BCG', 'Vaccine', 'child immunization', '100ml', 1, '2021-11-02', '2024-03-13', '2022-01-18', 'Vaccine'),
(3, '20', 'diatabs', 'Medicine', 'antibiotics', '500mg', 2, '2021-11-07', '2022-01-31', '2022-01-18', 'Medicine'),
(0, '7', 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2022-01-21', 'Delete'),
(0, '36', 'calpol', 'Medicine', 'pain reliver', '250mg', 36, '2021-12-01', '2021-12-31', '2022-01-21', 'Delete'),
(0, '7', 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2022-01-21', 'Delete'),
(0, '36', 'calpol', 'Medicine', 'pain reliver', '250mg', 36, '2021-12-01', '2021-12-31', '2022-01-21', 'Delete'),
(0, '36', 'calpol', 'Medicine', 'pain reliver', '250mg', 36, '2021-12-01', '2021-12-31', '2022-01-21', 'Delete'),
(0, '51', 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2022-01-21', 'Delete'),
(0, '49', 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2022-01-21', 'Delete'),
(0, '7', 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2022-01-21', 'Delete'),
(0, '50', 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2022-01-21', 'Delete'),
(0, '52', 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2022-01-21', 'Delete'),
(0, '7', 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2022-01-21', 'Delete'),
(0, '36', 'calpol', 'Medicine', 'pain reliver', '250mg', 36, '2021-12-01', '2021-12-31', '2022-01-21', 'Delete'),
(0, '20', 'diatabs', 'Medicine', 'antibiotics', '500mg', 115, '2021-11-07', '2022-01-31', '2022-01-21', 'Update'),
(0, '36', 'calpol', 'Medicine', 'pain reliver', '250mg', 36, '2021-12-01', '2021-12-31', '2022-01-21', 'Delete'),
(0, '7', 'paracetamol', 'Medicine', 'antibiotics', '250mg', 1520, '2021-10-31', '2022-01-08', '2022-01-21', 'Delete'),
(0, '8', 'calpol', 'Medicine', 'pain reliver', '500mg', 55, '2021-08-30', '2022-03-25', '2022-01-21', 'Update'),
(0, '37', 'paracetamol', 'Medicine', 'antibiotics', '500mg', 125, '2021-10-31', '2023-01-11', '2022-01-21', 'Update'),
(0, '8', 'calpo', 'Medicine', 'pain reliver', '500mg', 55, '2021-08-30', '2022-03-25', '2022-01-21', 'Update'),
(0, '8', 'calpol', 'Medicine', 'pain reliver', '500mg', 55, '2021-08-30', '2022-03-25', '2022-01-21', 'Update'),
(0, '15', 'IPV', 'Vaccine', 'child immunization', '122ml', 196, '2021-11-01', '2022-02-16', '2022-01-21', 'Update'),
(0, '15', 'IPV', 'Vaccine', 'child immunization', '120ml', 196, '2021-11-01', '2022-02-16', '2022-01-21', 'Update'),
(0, '32', 'OPV', 'Vaccine', 'child immunization', '100ml', 495, '2021-11-02', '2022-06-08', '2022-01-21', 'Update'),
(0, '32', 'OPV', 'Vaccine', 'child immunization', '100ml', 498, '2021-11-02', '2022-06-08', '2022-01-21', 'Update'),
(0, '0', 'Pfizer', 'Vaccine', 'Covid', '120ml', 150, '2022-01-21', '2022-01-21', '2022-01-21', 'Add'),
(0, '0', 'Pfizer', 'Vaccine', 'Covid', '120ml', 12, '2022-01-21', '2022-01-29', '2022-01-21', 'Add'),
(0, '8', 'calpol', 'Medicine', 'pain reliver', '50mg', 55, '2021-08-30', '2022-03-25', '2022-01-21', 'Update'),
(0, '8', 'calpol', 'Medicine', 'pain reliver', '500mg', 55, '2021-08-30', '2022-03-25', '2022-01-21', 'Update'),
(0, '0', 'Calpol', 'Medicine', 'Gamot', '120ml', 150, '2022-01-01', '2022-01-29', '2022-01-21', 'Add'),
(0, '0', 'Pfizer', 'Vaccine', 'COvid', '12ml', 120, '2022-01-01', '2022-01-29', '2022-01-21', 'Add'),
(0, '48', 'Calpol', 'Medicine', 'Gamot', '125', 150, '2022-01-07', '2022-01-29', '2022-01-21', 'Add'),
(0, '2022', 'Pfizer', 'Vaccine', 'Covid', '120ml', 150, '2022-01-07', '2022-01-29', '2022-01-21', 'Add'),
(0, '2022', 'Pfizer', 'Vaccine', 'Covid', '120ml', 150, '2022-01-07', '2022-01-21', '2022-01-21', 'Update'),
(0, '2022', 'Pfizer', 'Vaccine', 'Covid', '120ml', 150, '2022-01-07', '2022-01-21', '2022-01-21', 'Delete'),
(0, '2022', 'Calpol', 'Medicine', 'Gamot', '12ml', 150, '2022-01-07', '2022-01-29', '2022-01-21', 'Add'),
(0, '2022', 'Pfizer', 'Vaccine', 'Covid', '12ml', 150, '2022-01-01', '2022-01-29', '2022-01-21', 'Add'),
(0, '0', 'calpol', 'Medicine', 'Gamot', '12ml', 150, '2022-01-01', '2022-01-29', '2022-01-21', 'Add'),
(0, '0', 'Astra', 'Vaccine', 'Covid', '12ml', 15, '2022-01-01', '2022-01-29', '2022-01-21', 'Add'),
(0, '2022-05-086884', 'Moderna', 'Vaccine', 'Covid', '12ml', 15, '2022-01-01', '2022-01-29', '2022-01-21', 'Add'),
(0, '2022-04-772295', 'Calpol', 'Medicine', 'Gamot', '500ml', 150, '2022-01-01', '2022-01-29', '2022-01-21', 'Add'),
(0, '2022-04-250452', 'Calpol', 'Medicine', 'Gamot', '150', 150, '2022-01-01', '2022-01-29', '2022-01-21', 'Add');

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
