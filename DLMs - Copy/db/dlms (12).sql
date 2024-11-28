-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 06:31 PM
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
('admin1', 'admin1', 'admin1', 'admin1', 'admin1', '1111-01-01'),
('admin2', 'admin2', 'admin2', 'admin2', 'admin2', '1999-01-01');

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
(21, 'ssdd', '', '', ''),
(22, 'werty44', '', '', ''),
(23, 'werty44s', '', '', ''),
(24, 'sgdhvb', '', '', ''),
(25, 'ssswdwf', '', '', ''),
(26, 'ssswdwfww', '', '', ''),
(27, 'aba ako pa', 'unifor', 'varying', 'series'),
(28, 'wwww', '', '', ''),
(29, 'palayan', '', '', ''),
(31, 'ertyujik', '', '', ''),
(32, 'the firen', '', '', ''),
(33, 'hiiii', '', '', ''),
(34, 'water in the lake', 'layke', 'friied', 'nagets'),
(35, 'black magic', 'layke', 'friied', 'nagets'),
(36, 'black magic tyoe', 'layke', 'friied', 'nagets'),
(38, 'adan and eve', 'layke', 'friied', 'nagets');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `IDno` varchar(50) NOT NULL,
  `TIMEIN` time DEFAULT NULL,
  `TIMEOUT` time DEFAULT NULL,
  `LOGDATE` date NOT NULL,
  `STATUS` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ID`, `IDno`, `TIMEIN`, `TIMEOUT`, `LOGDATE`, `STATUS`) VALUES
(1, 'admin1', '07:25:39', '07:26:02', '2024-10-25', 1),
(8, 'admin1', '07:27:34', '07:27:38', '2024-10-25', 1),
(9, 'admin1', '07:27:40', '07:27:43', '2024-10-25', 1),
(10, 'admin1', '07:27:45', '07:27:50', '2024-10-25', 1),
(12, '2021-3085a', '07:29:19', '07:29:25', '2024-10-25', 1),
(13, 'admin1', '07:29:34', '07:29:39', '2024-10-25', 1),
(14, 'admin1', '07:37:39', '07:37:48', '2024-10-25', 1),
(16, '2021-3085a', '07:37:54', '07:37:59', '2024-10-25', 1),
(17, 'admin1', '07:38:36', '07:38:41', '2024-10-25', 1),
(18, '2021-3085a', '07:38:48', '07:38:54', '2024-10-25', 1);

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
(23, 'ssdd', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(24, 'werty44', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(29, 'werty44s', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(30, 'sgdhvb', 'dwfegrhtjgh', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(31, 'ssswdwf', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(32, 'ssswdwfww', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(33, 'aba ako pa', 'fly birww', 'ako eh syempre ', '3', '7999', '5666', '678-12112', 'computer_file', 'Hardcover', 'kilid balay', 'ako man eh', '2024-10-23', '2029', '199 pages', 'damo lao', '12inc '),
(34, 'wwww', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(35, 'palayan', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(37, 'ertyujik', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(38, 'the firen', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(39, 'hiiii', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(40, 'water in the lake', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(41, 'black magic', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(42, 'black magic tyoe', '', '', '', '', '', '', 'book', 'not_assigned', '', '', '0000-00-00', '', '', '', ''),
(44, 'adan and eve', 'temptation nof the snake', 'mozart', '12', '67789', '67890', 'y', 'ebook', 'LargePrint', 'kilid balay', 'tatay mo', '2024-12-31', '2029', '10 pages', 'wala to be specific', '1mm');

-- --------------------------------------------------------

--
-- Table structure for table `book_copies`
--

CREATE TABLE `book_copies` (
  `ID` int(11) NOT NULL,
  `copy_ID` varchar(50) NOT NULL,
  `B_title` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `callNumber` varchar(50) DEFAULT NULL,
  `circulationType` varchar(50) DEFAULT NULL,
  `dateAcquired` date DEFAULT NULL,
  `description1` text DEFAULT NULL,
  `description2` text DEFAULT NULL,
  `description3` text DEFAULT NULL,
  `number1` int(11) DEFAULT NULL,
  `number2` int(11) DEFAULT NULL,
  `number3` int(11) DEFAULT NULL,
  `Sublocation` varchar(100) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `fundingSource` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(21, 'ssdd', '', '0000-00-00', ''),
(22, 'werty44', '', '0000-00-00', ''),
(23, 'werty44s', '', '0000-00-00', ''),
(24, 'sgdhvb', '', '0000-00-00', ''),
(25, 'ssswdwf', '', '0000-00-00', ''),
(26, 'ssswdwfww', '', '0000-00-00', ''),
(27, 'aba ako pa', '', '0000-00-00', ''),
(28, 'wwww', '', '0000-00-00', ''),
(29, 'palayan', '', '0000-00-00', ''),
(31, 'ertyujik', 'ako', '0000-00-00', ''),
(32, 'the firen', 'ako', '2024-10-26', 'No'),
(33, 'hiiii', '', '0000-00-00', ''),
(34, 'water in the lake', 'Array', '0000-00-00', 'Array'),
(35, 'black magic', 'Array', '0000-00-00', 'Array'),
(36, 'black magic tyoe', '', '0000-00-00', ''),
(38, 'adan and eve', '', '0000-00-00', '');

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
('admin2', 'admin2@admin2', '', '12222222222', '');

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
(21, 'ssdd', '', ''),
(22, 'werty44', '', ''),
(23, 'werty44s', '', ''),
(24, 'sgdhvb', '', ''),
(25, 'ssswdwf', '', ''),
(26, 'ssswdwfww', '', ''),
(27, 'aba ako pa', 'https://getbootstrap.com/', 'bootstrap na sa '),
(28, 'wwww', '', ''),
(29, 'palayan', '', ''),
(31, 'ertyujik', '', ''),
(32, 'the firen', '', ''),
(33, 'hiiii', '', ''),
(34, 'water in the lake', '', ''),
(35, 'black magic', '', ''),
(36, 'black magic tyoe', '', ''),
(38, 'adan and eve', 'https://youtube.com', 'youtube');

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
(21, 'ssdd', '', 0, '', '', '', ''),
(22, 'werty44', '', 0, '', '', '', ''),
(25, 'werty44s', '', 0, '', '', '', ''),
(29, 'sgdhvb', '', 0, '', '', '', ''),
(31, 'ssswdwf', '', 0, '', '', '', ''),
(33, 'ssswdwfww', '', 0, '', '', '', ''),
(34, 'aba ako pa', '', 1, 'aduolt', 'no clue', 'fried', ''),
(35, 'wwww', '', 0, '', '', '', ''),
(36, 'palayan', '', 0, '', '', '', 'hello; '),
(38, 'ertyujik', '', 0, '', '', '', ''),
(39, 'the firen', '', 0, '', '', '', ''),
(40, 'hiiii', '', 0, '', '', '', ''),
(41, 'water in the lake', '', 0, '', '', '', ''),
(42, 'black magic', '', 0, '', '', '', ''),
(43, 'black magic tyoe', '', 0, '', '', '', ''),
(45, 'adan and eve', '', 3, '', '', '', '');

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
(21, 'ssdd', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(22, 'werty44', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(23, 'werty44s', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(24, 'sgdhvb', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(25, 'ssswdwf', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(26, 'ssswdwfww', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(27, 'aba ako pa', 'Personal Heading', 'para nami', 'Geographic', 'la man gd', 'Chronological', 'and ', 'Form', 'so'),
(28, 'wwww', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(29, 'palayan', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(31, 'ertyujik', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(32, 'the firen', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(33, 'hiiii', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(34, 'water in the lake', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(35, 'black magic', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(36, 'black magic tyoe', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(38, 'adan and eve', 'Tropical Heading', 'cuhik', 'Chronological', 'gvhbjnkl', 'General', 'xfcgvhbjk', 'Chronological', 'fcgvhjkm');

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
  `gender` varchar(10) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`IDno`, `Fname`, `Sname`, `Mname`, `Ename`, `gender`, `photo`) VALUES
('2021-3085a', 'q', 'q', 'qq', 'iii', '', 'qrcode (9).png'),
('admin1', 'admin2', 'admin', '1', 'n/a', 'o', '61RPubboeNL._AC_UF894,1000_QL80__1730050277.jpg'),
('admin2', 'admin2', 'admin', '2', 'n/a', 'f', '61RPubboeNL._AC_UF894,1000_QL80__1730050277.jpg');

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
('admin1', 'cas', 'BS in Info Tech', NULL, '1', NULL, '9', NULL, 'active'),
('admin2', 'cas', 'BS in Info Tech', NULL, 'd', NULL, '4', NULL, 'active');

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
('2021-3085a', 'hallow', 'hallow', 'student', 'approved'),
('admin1', 'admin1', 'admin1', 'admin', 'approved'),
('admin2', 'admin2', 'admin2', 'admin', 'approved');

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_idno_logdate` (`IDno`,`LOGDATE`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `B_title` (`B_title`);

--
-- Indexes for table `book_copies`
--
ALTER TABLE `book_copies`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `B_title` (`B_title`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `book_copies`
--
ALTER TABLE `book_copies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

--
-- AUTO_INCREMENT for table `coauthor`
--
ALTER TABLE `coauthor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_users_info` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `book_copies`
--
ALTER TABLE `book_copies`
  ADD CONSTRAINT `fk_book_title` FOREIGN KEY (`B_title`) REFERENCES `book` (`B_title`) ON DELETE CASCADE ON UPDATE CASCADE;

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
