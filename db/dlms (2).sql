-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 05:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dlms`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `IDno` varchar(11) NOT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`IDno`, `municipality`, `city`, `barangay`, `province`, `DOB`) VALUES
('2021-3085-A', 'sta barbara', 'iloilo city', 'conaynay', 'iloilo', '2022-10-29'),
('2021-3085-b', 'rtyuiop', ' dfghjkl', 'kuala ', 'lumpo', '2023-11-28'),
('2021-3085-S', 'rtyuiop', ' dfghjkl', 'kuala ', 'lumpo', '2023-11-28'),
('whahaha', '12345', '1432tr', '3424weytr', '3wresfdg', '2024-10-07');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `IDno` varchar(11) NOT NULL,
  `TIMEIN` time NOT NULL,
  `TIMEOUT` time NOT NULL,
  `LOGDATE` date NOT NULL,
  `STATUS` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ID`, `IDno`, `TIMEIN`, `TIMEOUT`, `LOGDATE`, `STATUS`) VALUES
(1, '2021-3085-A', '03:35:52', '03:36:02', '2024-10-04', 1),
(2, '2021-3085-A', '11:14:15', '11:31:58', '2024-10-06', 1),
(3, '2021-3085-A', '02:51:12', '02:51:24', '2024-10-07', 1),
(4, '2021-3030-A', '02:51:49', '00:00:00', '2024-10-07', 0),
(5, '2021-2020-A', '02:51:58', '00:00:00', '2024-10-07', 0),
(6, '2021-3085-A', '02:52:15', '02:53:13', '2024-10-07', 1),
(7, '2021-3085-A', '02:53:26', '03:12:47', '2024-10-07', 1),
(8, '2021-3085-A', '03:13:25', '03:15:16', '2024-10-07', 1),
(9, '2021-3085-A', '03:24:46', '03:25:31', '2024-10-07', 1),
(10, '2021-3085-A', '10:41:21', '10:41:34', '2024-10-07', 1),
(11, '2021-3085-A', '10:41:49', '11:03:13', '2024-10-07', 1),
(12, '2021-3085-S', '11:02:32', '11:03:01', '2024-10-07', 1),
(13, 'whahaha', '11:19:39', '00:00:00', '2024-10-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `IDno` varchar(11) NOT NULL,
  `email1` varchar(100) DEFAULT NULL,
  `email2` varchar(100) DEFAULT NULL,
  `con1` varchar(20) DEFAULT NULL,
  `con2` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`IDno`, `email1`, `email2`, `con1`, `con2`) VALUES
('2021-3085-A', '45678@76', '', '5678', ''),
('2021-3085-b', '45678@76', '', '5678', ''),
('2021-3085-S', '45678@76', '', '5678', ''),
('whahaha', '333@gmail.coom', '', '333', '');

-- --------------------------------------------------------

--
-- Table structure for table `students_info`
--

CREATE TABLE `students_info` (
  `IDno` varchar(11) NOT NULL,
  `college` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `GRAD_YR` int(11) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `GRAD_LVL` varchar(50) DEFAULT NULL,
  `yrLVL` varchar(50) DEFAULT NULL,
  `A_LVL` varchar(11) DEFAULT NULL,
  `U_type` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_info`
--

INSERT INTO `students_info` (`IDno`, `college`, `course`, `GRAD_YR`, `section`, `GRAD_LVL`, `yrLVL`, `A_LVL`, `U_type`, `status`) VALUES
('2021-3085-A', 'cas', 'BS in Human Services', 2025, 'd', '8', '3', '1', 'admin', 'active'),
('2021-3085-b', 'coe', 'BSEd ', 2030, 'd', '3', '3', '2', 'student', 'inactive'),
('2021-3085-S', 'coe', 'BSEd ', 2030, 'd', '3', '3', '2', 'student', 'inactive'),
('whahaha', 'cea', 'BS in Mech Eng', 1234, 'd', '8', '5', '4', 'visitor', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `IDno` varchar(11) NOT NULL,
  `Fname` varchar(50) DEFAULT NULL,
  `Sname` varchar(50) DEFAULT NULL,
  `Mname` varchar(50) DEFAULT NULL,
  `Ename` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`IDno`, `Fname`, `Sname`, `Mname`, `Ename`, `gender`) VALUES
('2021-3085-A', 'von john', 'suropia', 'siodena', 'n/a', 'm'),
('2021-3085-b', 'john', 'jen', 'jacob', 'n/a', 'm'),
('2021-3085-S', 'john', 'jen', 'jacob', 'n/a', 'm'),
('whahaha', 'jake', 'jar', 'fin', 'v', 'f');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `IDno` varchar(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `U_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`IDno`, `username`, `password`, `U_type`) VALUES
('2021-3085-A', 'vonjohn.suropia', 'vonjohn.suropia', 'admin'),
('2021-3085-b', 'qwerty', 'qwerty', 'student'),
('2021-3085-S', 'qwerty', 'qwerty', 'student'),
('whahaha', 'jarhead', 'jarhead', 'visitor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`IDno`),
  ADD KEY `IDno` (`IDno`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`IDno`),
  ADD KEY `IDno` (`IDno`);

--
-- Indexes for table `students_info`
--
ALTER TABLE `students_info`
  ADD PRIMARY KEY (`IDno`),
  ADD KEY `IDno` (`IDno`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`IDno`),
  ADD KEY `IDno` (`IDno`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`IDno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

--
-- Constraints for table `students_info`
--
ALTER TABLE `students_info`
  ADD CONSTRAINT `students_info_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
