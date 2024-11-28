-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 07:01 PM
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
('2021-3085a', 'q', 'q', 'q', 'q', '2024-10-19'),
('admin1', 'admin1', 'admin1', 'admin1', 'admin1', '1111-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `alternatetitle`
--

CREATE TABLE `alternatetitle` (
  `id` int(11) NOT NULL,
  `B_title` varchar(255) NOT NULL,
  `UTitle` varchar(255) DEFAULT NULL,
  `VForm` varchar(255) DEFAULT NULL,
  `SUTitle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alternatetitle`
--

INSERT INTO `alternatetitle` (`id`, `B_title`, `UTitle`, `VForm`, `SUTitle`) VALUES
(3, 'look', NULL, NULL, NULL),
(4, 'clostropobic', '', '', ''),
(5, 'nima', '', '', ''),
(6, 'shish', '', '', ''),
(7, 'doctor', '', '', ''),
(8, 'doctor dddd', '', '', ''),
(9, 'doctor ddwdd', '', '', ''),
(10, 'so what ', '', '', ''),
(11, 'sss', '', '', ''),
(12, 'sssxx', '', '', ''),
(13, 'sssxxwww', '', '', ''),
(14, 'sssxxwwwdd', '', '', ''),
(15, 'fried', '', '', ''),
(16, 'friedresvdxre', '', '', ''),
(17, 'ddddd', '', '', ''),
(18, 'ok pre', '', '', ''),
(19, 'dwwdwd', '', '', ''),
(20, 'sssww', '', '', ''),
(21, 'ssdd', '', '', ''),
(22, 'werty44', '', '', ''),
(23, 'werty44s', '', '', ''),
(24, 'sgdhvb', '', '', ''),
(25, 'ssswdwf', '', '', ''),
(26, 'ssswdwfww', '', '', ''),
(27, 'aba ako pa', 'unifor', 'varying', 'series');

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

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `B_title` varchar(255) NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `LCCN` varchar(255) DEFAULT NULL,
  `ISBN` varchar(255) DEFAULT NULL,
  `ISSN` varchar(255) DEFAULT NULL,
  `MT` varchar(255) DEFAULT NULL,
  `ST` varchar(255) DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `Pdate` date DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `extent` varchar(255) DEFAULT NULL,
  `Odetail` text DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `B_title`, `subtitle`, `author`, `edition`, `LCCN`, `ISBN`, `ISSN`, `MT`, `ST`, `place`, `publisher`, `Pdate`, `copyright`, `extent`, `Odetail`, `size`) VALUES
(4, 'look', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(5, 'clostropobic', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(6, 'nima', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(7, 'shish', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(9, 'doctor', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(10, 'doctor dddd', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(11, 'doctor ddwdd', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(12, 'so what ', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(13, 'sss', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(14, 'sssxx', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(15, 'sssxxwww', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(16, 'sssxxwwwdd', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(17, 'fried', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(18, 'friedresvdxre', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(19, 'ddddd', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(20, 'ok pre', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(21, 'dwwdwd', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(22, 'sssww', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(23, 'ssdd', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(24, 'werty44', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(29, 'werty44s', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(30, 'sgdhvb', 'dwfegrhtjgh', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(31, 'ssswdwf', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(32, 'ssswdwfww', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(33, 'aba ako pa', 'fly bird', 'ako eh', '1', '7999', '5666', '678-12112', 'computer_file', 'Hardcover', 'kilid balay', 'ako man eh', '2024-10-23', '2029', '199 pages', 'damo lao', '7inc');

-- --------------------------------------------------------

--
-- Table structure for table `coauthor`
--

CREATE TABLE `coauthor` (
  `id` int(11) NOT NULL,
  `B_title` varchar(255) NOT NULL,
  `Co_Name` varchar(255) DEFAULT NULL,
  `Co_Date` date DEFAULT NULL,
  `Co_Role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coauthor`
--

INSERT INTO `coauthor` (`id`, `B_title`, `Co_Name`, `Co_Date`, `Co_Role`) VALUES
(3, 'look', NULL, NULL, NULL),
(4, 'clostropobic', '', '0000-00-00', ''),
(5, 'nima', '', '0000-00-00', ''),
(6, 'shish', '', '0000-00-00', ''),
(7, 'doctor', '', '0000-00-00', ''),
(8, 'doctor dddd', '', '0000-00-00', ''),
(9, 'doctor ddwdd', '', '0000-00-00', ''),
(10, 'so what ', '', '0000-00-00', ''),
(11, 'sss', '', '0000-00-00', ''),
(12, 'sssxx', '', '0000-00-00', ''),
(13, 'sssxxwww', '', '0000-00-00', ''),
(14, 'sssxxwwwdd', '', '0000-00-00', ''),
(15, 'fried', '', '0000-00-00', ''),
(16, 'friedresvdxre', '', '0000-00-00', ''),
(17, 'ddddd', '', '0000-00-00', ''),
(18, 'ok pre', '', '0000-00-00', ''),
(19, 'dwwdwd', '', '0000-00-00', ''),
(20, 'sssww', '', '0000-00-00', ''),
(21, 'ssdd', '', '0000-00-00', ''),
(22, 'werty44', '', '0000-00-00', ''),
(23, 'werty44s', '', '0000-00-00', ''),
(24, 'sgdhvb', '', '0000-00-00', ''),
(25, 'ssswdwf', '', '0000-00-00', ''),
(26, 'ssswdwfww', '', '0000-00-00', ''),
(27, 'aba ako pa', '', '0000-00-00', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `id` int(11) NOT NULL,
  `B_title` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resource`
--

INSERT INTO `resource` (`id`, `B_title`, `url`, `Description`) VALUES
(3, 'look', NULL, NULL),
(4, 'clostropobic', '', ''),
(5, 'nima', '', ''),
(6, 'shish', '', ''),
(7, 'doctor', '', ''),
(8, 'doctor dddd', '', ''),
(9, 'doctor ddwdd', '', ''),
(10, 'so what ', '', ''),
(11, 'sss', '', ''),
(12, 'sssxx', '', ''),
(13, 'sssxxwww', '', ''),
(14, 'sssxxwwwdd', '', ''),
(15, 'fried', '', ''),
(16, 'friedresvdxre', '', ''),
(17, 'ddddd', '', ''),
(18, 'ok pre', '', ''),
(19, 'dwwdwd', '', ''),
(20, 'sssww', '', ''),
(21, 'ssdd', '', ''),
(22, 'werty44', '', ''),
(23, 'werty44s', '', ''),
(24, 'sgdhvb', '', ''),
(25, 'ssswdwf', '', ''),
(26, 'ssswdwfww', '', ''),
(27, 'aba ako pa', 'https://getbootstrap.com/', 'bootstrap na sa ');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` int(11) NOT NULL,
  `B_title` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `IL` varchar(255) DEFAULT NULL,
  `lexille` varchar(255) DEFAULT NULL,
  `F_and_P` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `B_title`, `title`, `volume`, `IL`, `lexille`, `F_and_P`, `comments`) VALUES
(3, 'look', '', 0, '', '', '', ''),
(4, 'clostropobic', '', 0, '', '', '', ''),
(5, 'nima', '', 0, '', '', '', ''),
(6, 'shish', '', 0, '', '', '', ''),
(7, 'doctor', '', 0, '', '', '', ''),
(8, 'doctor dddd', '', 0, '', '', '', ''),
(9, 'doctor ddwdd', '', 0, '', '', '', ''),
(10, 'so what ', '', 0, '', '', '', ''),
(11, 'sss', '', 0, '', '', '', ''),
(12, 'sssxx', '', 0, '', '', '', ''),
(13, 'sssxxwww', '', 0, '', '', '', ''),
(14, 'sssxxwwwdd', '', 0, '', '', '', ''),
(15, 'fried', '', 0, '', '', '', ''),
(16, 'friedresvdxre', '', 0, '', '', '', '2ee2ee2e2e'),
(17, 'ddddd', '', 0, '', '', '', 'dddd'),
(18, 'ok pre', '', 0, '', '', '', ''),
(19, 'dwwdwd', '', 0, '', '', '', ''),
(20, 'sssww', '', 0, '', '', '', ''),
(21, 'ssdd', '', 0, '', '', '', ''),
(22, 'werty44', '', 0, '', '', '', ''),
(25, 'werty44s', '', 0, '', '', '', ''),
(29, 'sgdhvb', '', 0, '', '', '', ''),
(31, 'ssswdwf', '', 0, '', '', '', ''),
(33, 'ssswdwfww', '', 0, '', '', '', ''),
(34, 'aba ako pa', '', 1, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `B_title` varchar(255) NOT NULL,
  `Sub_Head` varchar(255) DEFAULT NULL,
  `Sub_Head_input` varchar(255) DEFAULT NULL,
  `Sub_Body_1` text DEFAULT NULL,
  `Sub_input_1` text DEFAULT NULL,
  `Sub_Body_2` text DEFAULT NULL,
  `Sub_input_2` text DEFAULT NULL,
  `Sub_Body_3` text DEFAULT NULL,
  `Sub_input_3` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `B_title`, `Sub_Head`, `Sub_Head_input`, `Sub_Body_1`, `Sub_input_1`, `Sub_Body_2`, `Sub_input_2`, `Sub_Body_3`, `Sub_input_3`) VALUES
(3, 'look', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(4, 'clostropobic', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(5, 'nima', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(6, 'shish', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(7, 'doctor', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(8, 'doctor dddd', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(9, 'doctor ddwdd', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(10, 'so what ', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(11, 'sss', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(12, 'sssxx', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(13, 'sssxxwww', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(14, 'sssxxwwwdd', 'Tropical Heading', '', 'General ', '', 'General ', '', 'General ', ''),
(15, 'fried', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(16, 'friedresvdxre', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(17, 'ddddd', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(18, 'ok pre', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(19, 'dwwdwd', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(20, 'sssww', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(21, 'ssdd', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(22, 'werty44', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(23, 'werty44s', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(24, 'sgdhvb', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(25, 'ssswdwf', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(26, 'ssswdwfww', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(27, 'aba ako pa', 'Personal Heading', 'para nami', 'Geographic', 'la man gd', 'Chronological', 'and ', 'Form', 'so');

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
('2021-3085a', 'q', 'q', 'qq', 'iii', ''),
('admin1', 'admin1', 'admin', '1', 'n/a', 'o');

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
  `status` enum('active','inactive','restricted') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`IDno`, `college`, `course`, `GRAD_YR`, `section`, `GRAD_LVL`, `yrLVL`, `A_LVL`, `status`) VALUES
('2021-3085a', 'cas', 'course1', NULL, 'a', NULL, '1', NULL, 'active'),
('admin1', 'cas', 'BS in Info Tech', NULL, 'a', NULL, '1', NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `IDno` varchar(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `U_type` enum('admin','student','professor','staff','visitor') DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`IDno`, `username`, `password`, `U_type`, `status`) VALUES
('2021-3085a', 'vonjohn.suropia', '<!-- Table displaying users --> <div class=\"tableofuser\">     <table id=\"usersTable\" class=\"table table-striped table-bordered dt-responsive\">         <thead>             <tr>                 <th>IDno</th>                 <th>First Name</th>              ', 'student', 'pending'),
('admin1', 'admin1', 'admin1', 'admin', 'approved');

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
-- Indexes for table `alternatetitle`
--
ALTER TABLE `alternatetitle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `B_title` (`B_title`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`IDno`),
  ADD UNIQUE KEY `ID_2` (`ID`),
  ADD KEY `ID` (`ID`),
  ADD KEY `IDno` (`IDno`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `B_title` (`B_title`);

--
-- Indexes for table `coauthor`
--
ALTER TABLE `coauthor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `B_title` (`B_title`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`IDno`),
  ADD KEY `IDno` (`IDno`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id`),
  ADD KEY `B_title` (`B_title`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `B_title` (`B_title`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `B_title` (`B_title`);

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
-- AUTO_INCREMENT for table `alternatetitle`
--
ALTER TABLE `alternatetitle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `coauthor`
--
ALTER TABLE `coauthor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

--
-- Constraints for table `alternatetitle`
--
ALTER TABLE `alternatetitle`
  ADD CONSTRAINT `alternatetitle_ibfk_1` FOREIGN KEY (`B_title`) REFERENCES `book` (`B_title`) ON DELETE CASCADE;

--
-- Constraints for table `coauthor`
--
ALTER TABLE `coauthor`
  ADD CONSTRAINT `coauthor_ibfk_1` FOREIGN KEY (`B_title`) REFERENCES `book` (`B_title`) ON DELETE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

--
-- Constraints for table `resource`
--
ALTER TABLE `resource`
  ADD CONSTRAINT `resource_ibfk_1` FOREIGN KEY (`B_title`) REFERENCES `book` (`B_title`) ON DELETE CASCADE;

--
-- Constraints for table `series`
--
ALTER TABLE `series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`B_title`) REFERENCES `book` (`B_title`) ON DELETE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`B_title`) REFERENCES `book` (`B_title`) ON DELETE CASCADE;

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
