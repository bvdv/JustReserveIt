-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2018 at 07:02 PM
-- Server version: 5.7.19-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `justreserve`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `room_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `accepted` varchar(255) NOT NULL DEFAULT '0',
  `room_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `room_id`, `user_id`, `check_in`, `check_out`, `accepted`, `room_name`) VALUES
(86, '7', '4', '2018-06-04', '2018-06-07', '0', '1 bedroom');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `bed_num` varchar(255) NOT NULL,
  `overview` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `bed_num`, `overview`) VALUES
(7, '1 bedroom', '1', 'The apartment is bright and spacious with many original features and is fully furnished and has ample storage space for a single. :) '),
(8, '2 bedroom', '2', 'A very nicely presented two bedroom first floor flat.:)'),
(13, '3 bedroom', '3', 'A beautifully presented three double bedroom first floor new build apartment. :)');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `contacts` varchar(255) NOT NULL,
  `document_id` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT '0',
  `staff_status` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `name`, `surname`, `email`, `hashed_password`, `contacts`, `document_id`, `role`, `staff_status`) VALUES
(5, 'BroniusL', 'Bronius', 'Lav', 'bronius@bronius.com', '$2y$10$EH2BCt8fPnMTeGJFPMOCiOGfneun35FDHofH3mHYWcREuOl8CYBw6', 'Alytus', '3452345', '1', '0'),
(6, 'JozasP', 'Jozas', 'Pas', 'jozas@jozas.com', '$2y$10$WA.0p9OrVf8DkJD2BrPkK.CB2TrC8n6myf8ntsf5pdbysf3Fs8Vl2', 'Varena', '3452345', '2', '0'),
(7, 'Vitas', 'Vitas', 'Pukas', 'vitasp@vitasp.lt', '$2y$10$0sk2WWBcaR4357RgbE/c8eTP6MviN4TiYcNDhj39p1LN4XuL71Aru', 'Kaunas', '234123', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL DEFAULT '0',
  `contacts` text NOT NULL,
  `document_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `username`, `name`, `surname`, `email`, `hashed_password`, `user_status`, `contacts`, `document_id`) VALUES
(4, 'PovilasD', 'Povilas', 'Dapkus', 'povilas@povilas.com', '$2y$10$aIF1fjDnVXbBgedLgutlPey9vFbI0n7J1N/xG/tDvdey5Lq1gySn6', '0', 'Varena', '3452345');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
