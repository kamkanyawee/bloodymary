-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2016 at 11:09 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodymary`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `CustomerID` int(11) NOT NULL,
  `Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `LastName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Username`, `Password`, `FirstName`, `LastName`, `Email`) VALUES
(1, 'miky', 'whatthecat', 'mike', 'hippy', 'mikekekehappy@gmail.com'),
(2, 'happylala', 'hello555', 'happy', 'lala', 'happy_lala@gmail.com'),
(3, 'user1', 'iamuser', 'user1', 'teaked', 'user1@gmail.com'),
(4, 'user2', 'user2', 'user2', 'user2', 'user2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `FlightID` int(11) NOT NULL,
  `Airline` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Source` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Destination` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Fare` decimal(7,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`FlightID`, `Airline`, `Source`, `Destination`, `Fare`) VALUES
(1, 'Airasia', 'Don Mueang International Airport', 'Krabi Airport', '950.00'),
(2, 'Nok Air', 'Suvarnabhumi Airport', 'Da Nang International Airport', '2300.00'),
(3, 'Thai Lion Air', 'Chiang Mai International Airport', 'Mandalay International Airport', '1300.00'),
(4, 'Thai Smile', 'Phuket International Airport', 'Singapore Changi Airport', '2150.00'),
(5, 'Bangkok Airways', 'Silay International Airport', 'Kuala Lumpur International Airport', '3510.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`FlightID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `FlightID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
