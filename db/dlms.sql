-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 04:05 AM
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
('2021-hh2', 'jakarta', ' dfghjkl', 'iughvbmnm', 'yhbjnk', '2023-10-30'),
('2345678', 'jakarta', ' dfghjkl', 'iughvbmnm', 'fghjk', '2023-11-30'),
('345678', 'jakarta', ' dfghjkl', 'iughvbmnm', 'fghjk', '2023-11-30'),
('3456789p', 'rctvybhijopl', 'fcgvhbjnkk,;.', '\'tyuhikpl', 'fcgvbnimkl;.', '2024-10-29'),
('345eeee', 'rctvybhijopl', 'fcgvhbjnkk,;.', '\'tyuhikpl', 'fcgvbnimkl;.', '2024-10-29'),
('345eeeeeee', 'rctvybhijopl', 'fcgvhbjnkk,;.', '\'tyuhikpl', 'fcgvbnimkl;.', '2024-10-29'),
('345eeeees', 'rctvybhijopl', 'fcgvhbjnkk,;.', '\'tyuhikpl', 'fcgvbnimkl;.', '2024-10-29'),
('555050', 'jakarta', ' dfghjkl', 'iughvbmnm', 'fghjk', '2023-11-30'),
('5550505', 'jakarta', ' dfghjkl', 'iughvbmnm', 'fghjk', '2023-11-30'),
('555050s', 'jakarta', ' dfghjkl', 'iughvbmnm', 'fghjk', '2023-11-30'),
('6363622', 'sta barbara', 'rtyuio', 'fghjk', 'fghjk', '2024-12-31'),
('fried makar', '12345', '1432tr', '3424weytr', '3wresfdg', '2024-11-29'),
('fried shike', '12345', '1432tr', '3424weytr', '3wresfdg', '2024-11-29'),
('frind nugge', 'jakarta', ' dfghjkl', 'iughvbmnm', 'yhbjnk', '2023-10-30'),
('whahaha', '12345', '1432tr', '3424weytr', '3wresfdg', '2024-10-07'),
('yyyyaayy', 'jakarta', ' dfghjkl', 'iughvbmnm', 'fghjk', '2023-11-30');

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
(13, 'whahaha', '11:19:39', '00:00:00', '2024-10-07', 0),
(14, 'whahaha', '01:34:13', '02:13:11', '2024-10-09', 1),
(15, '2021-3085-A', '02:15:42', '02:15:47', '2024-10-09', 1),
(16, '2021-3085-A', '02:15:55', '02:40:18', '2024-10-09', 1),
(17, 'Username: D', '02:16:00', '00:00:00', '2024-10-09', 0),
(18, '2021-3085-A', '02:40:22', '02:40:25', '2024-10-09', 1),
(19, '2021-3085-A', '02:40:26', '02:40:33', '2024-10-09', 1),
(20, 'Username: D', '02:40:30', '00:00:00', '2024-10-09', 0),
(21, '2021-3085-A', '02:40:40', '02:40:45', '2024-10-09', 1),
(22, '2021-3085-A', '02:40:49', '02:40:52', '2024-10-09', 1),
(23, '', '02:40:49', '00:00:00', '2024-10-09', 0),
(24, '2021-3085-A', '02:40:56', '02:40:59', '2024-10-09', 1),
(25, '2021-3085-A', '02:41:01', '02:41:04', '2024-10-09', 1),
(26, '2021-3085-A', '02:41:05', '02:41:09', '2024-10-09', 1),
(27, '2021-3085-A', '02:41:15', '02:41:18', '2024-10-09', 1),
(28, '2021-3085-A', '02:41:19', '00:00:00', '2024-10-09', 0),
(29, 'fried shike', '01:22:30', '00:00:00', '2024-10-11', 0);

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
('2021-hh2', '333@gmail.coom', '', '5678', ''),
('6363622', '098765@xcvbjk', '', '1234567', ''),
('fried makar', '098765@xcvbjk', '', '098765432', ''),
('fried shike', '098765@xcvbjk', '', '098765432', ''),
('frind nugge', '333@gmail.coom', '', '5678', ''),
('whahaha', '333@gmail.coom', '', '333', '');

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
('2021-hh2', 'jay jay', 'brawl', 'silbrid', 'jr', 'm'),
('2345678', 'Dave Mclin', 'Bene', 'Taghap', 'iv', 'o'),
('345678', 'Dave Mclin', 'Bene', 'Taghap', 'iv', 'o'),
('3456789p', 'esrdtfyuhi', 'jtybuhniml,;.', 'fcgvhbjnk,l;..', 'iii', 'o'),
('345eeee', 'esrdtfyuhi', 'jtybuhniml,;.', 'fcgvhbjnk,l;..', 'iii', 'o'),
('345eeeeeee', 'esrdtfyuhi', 'jtybuhniml,;.', 'fcgvhbjnk,l;..', 'iii', 'o'),
('345eeeees', 'esrdtfyuhi', 'jtybuhniml,;.', 'fcgvhbjnk,l;..', 'iii', 'o'),
('555050', 'Dave Mclin', 'Bene', 'Taghap', 'iv', 'o'),
('5550505', 'Dave Mclin', 'Bene', 'Taghap', 'iv', 'o'),
('555050s', 'Dave Mclin', 'Bene', 'Taghap', 'iv', 'o'),
('6363622', 'niel', 'pako ', 'garcia', 'jr', 'm'),
('fried makar', 'darel', 'dark', 'clad', 'jr', 'o'),
('fried shike', 'darel', 'dark', 'clad', 'jr', 'o'),
('frind nugge', 'jay jay', 'brawl', 'silbrid', 'jr', 'm'),
('whahaha', 'jake', 'jar', 'fin', 'v', 'f'),
('yyyyaayy', 'Dave Mclin', 'Bene', 'Taghap', 'iv', 'o');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
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
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`IDno`, `college`, `course`, `GRAD_YR`, `section`, `GRAD_LVL`, `yrLVL`, `A_LVL`, `U_type`, `status`) VALUES
('2021-3085-A', 'cas', 'BS in Human Services', 2025, 'd', '8', '3', '1', 'admin', 'active'),
('2021-3085-b', 'coe', 'BSEd ', 2030, 'd', '3', '3', '2', 'student', 'inactive'),
('2021-3085-S', 'coe', 'BSEd ', 2030, 'd', '3', '3', '2', 'student', 'inactive'),
('2021-hh2', 'cas', 'BS in Info Systems', 0, 'd', '7', '4', NULL, 'student', 'active'),
('2345678', 'coe', 'BTVTEd', 1234, 'b', '4', '4', '0', 'visitor', 'active'),
('345678', 'coe', 'BTVTEd', 1234, 'b', '4', '4', '0', 'visitor', 'active'),
('3456789p', 'cit', 'BS in Elec Tech (BSELT) - Level III', 0, 'c', '4', '5', '0', 'student', 'restricted'),
('345eeee', 'cit', 'BS in Elec Tech (BSELT) - Level III', 0, 'c', '4', '5', '0', 'student', 'restricted'),
('345eeeeeee', 'cit', 'BS in Ind Tech (BIT) - Level III', 0, 'c', '4', '5', '0', 'student', 'restricted'),
('345eeeees', 'cit', 'BS in Hotel & Rest Tech (BSHRT) - Level II', 0, 'c', '4', '5', '0', 'student', 'restricted'),
('555050', 'coe', 'BTVTEd', 1234, 'b', '4', '4', '0', 'visitor', 'active'),
('5550505', 'coe', 'BTVTEd', 1234, 'b', '4', '4', '0', 'visitor', 'active'),
('555050s', 'coe', 'BTVTEd', 1234, 'b', '4', '4', '0', 'visitor', 'active'),
('6363622', 'cea', 'BS in Elec Eng', 2030, 'c', '3', '3', '2', 'student', 'inactive'),
('fried makar', 'coe', 'BS in Ind Ed', 2030, 'd', '3', '5', '4', 'student', 'inactive'),
('fried shike', 'coe', 'BS in Ind Ed', 2030, 'd', '3', '5', '4', 'student', 'inactive'),
('frind nugge', 'cas', 'BS in Info Systems', 0, 'd', '7', '4', '0', 'student', 'active'),
('whahaha', 'cea', 'BS in Mech Eng', 1234, 'd', '8', '5', '4', 'visitor', 'inactive'),
('yyyyaayy', 'coe', 'BTVTEd', 1234, 'b', '4', '4', '0', 'visitor', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `IDno` varchar(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `U_type` varchar(50) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`IDno`, `username`, `password`, `U_type`, `status`) VALUES
('2021-3085-A', 'vonjohn.suropia', 'vonjohn.suropia', 'admin', 'approved'),
('2021-3085-b', 'qwerty', 'qwerty', 'admin', 'pending'),
('2021-3085-S', 'qwerty', 'qwerty', 'student', 'rejected'),
('2021-hh2', 'tffyuhh', 'tffyuhh', 'student', 'pending'),
('6363622', 'user1', 'user1', 'student', 'approved'),
('fried shike', 'dariel112', 'dariel112', 'student', 'pending'),
('frind nugge', 'tffyuhh', 'tffyuhh', 'student', 'approved'),
('whahaha', 'jarhead', 'jarhead', 'visitor', 'pending');

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
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`IDno`),
  ADD KEY `IDno` (`IDno`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

--
-- Constraints for table `user_log`
--
ALTER TABLE `user_log`
  ADD CONSTRAINT `user_log_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
