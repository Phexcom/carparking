-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2017 at 02:37 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carparking`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `reg_id` varchar(11) NOT NULL,
  `color` varchar(20) NOT NULL,
  `make` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `code`, `name`, `price`, `vat`) VALUES
(1, 'SHJ', 'Sharjah', '50.00', '2.00'),
(2, 'RAK', 'Ras Al Khaimah', '20.00', '4.00'),
(3, 'DUB', 'Dubai', '70.00', '10.00'),
(4, 'AJM', 'Ajman', '60.00', '4.00'),
(5, 'ABD', 'Abu Dhabi', '120.00', '15.00'),
(6, 'UAQ', 'Umm Al Quim', '30.00', '2.00'),
(7, 'FUJ', 'Fujairah', '40.00', '5.00'),
(8, 'ALA', 'Al Ain', '20.00', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `reg_num` varchar(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `location_id` int(11) NOT NULL,
  `is_parked` tinyint(1) NOT NULL DEFAULT '1',
  `no_hour` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `checkout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `parking_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `billing_address` varchar(250) DEFAULT NULL,
  `card_no` int(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`reg_id`),
  ADD KEY `owner` (`owner`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reg_num` (`reg_num`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parking_id` (`parking_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`);

--
-- Constraints for table `parking`
--
ALTER TABLE `parking`
  ADD CONSTRAINT `parking_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `parking_ibfk_2` FOREIGN KEY (`reg_num`) REFERENCES `car` (`reg_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`parking_id`) REFERENCES `parking` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
