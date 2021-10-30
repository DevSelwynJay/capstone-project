-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 02:32 PM
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
  `stock` int(11) NOT NULL,
  `mfgdate` date NOT NULL,
  `expdate` date NOT NULL,
  `dateadded` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medinventory`
--

INSERT INTO `medinventory` (`id`, `name`, `category`, `stock`, `mfgdate`, `expdate`, `dateadded`) VALUES
(1, 'biogesic', 'gamot', 10, '2021-10-29', '2021-11-26', '2021-10-29'),
(2, 'diatabs', 'gamot', 10, '2021-10-29', '2021-11-24', '2021-10-29'),
(3, 'diatabs', 'gamot', 10, '2021-10-29', '2021-11-24', '2021-10-29'),
(4, 'asdsa', 'asda', 14, '2021-10-01', '2021-11-06', '2021-10-29'),
(5, 'asda', 'asda', 11, '2021-10-29', '2021-11-06', '2021-10-29'),
(6, 'profan', 'vitamins', 12, '2021-10-08', '2021-11-06', '2021-10-30');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
