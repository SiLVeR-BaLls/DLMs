-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 08:54 PM
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
  `barangay` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`IDno`, `municipality`, `barangay`, `province`, `DOB`) VALUES
('', '', '', '', '0000-00-00'),
('2020-0876-A', 'Santa Barbara', 'Bolong Este', 'Iloilo', '2000-02-01'),
('2020-2941-A', 'Lapaz', 'Burgos st.', 'Iloilo', '2003-06-06'),
('2020-2981-A', 'Santa Barbara', 'Zone1', 'Iloilo', '2003-12-14'),
('2020-5643-A', 'San Miguel', 'Consolation', 'Iloilo', '2000-03-04'),
('2020-7656-A', 'Ivisan Capiz', 'Agcabugao,Cuartero', 'Iloilo', '2001-07-11'),
('2020-9452-A', 'Pavia', 'Cabugao Sur', 'Iloilo', '2008-02-28'),
('2021-0909-A', 'Jaro', 'San Jose', 'Iloilo', '2001-11-11'),
('2021-0994-A', 'Pavia', 'Zone1', 'Iloilo', '2001-08-09'),
('2021-1234-A', 'Santa Barbara', 'Burgos st.', 'Iloilo', '2001-06-12'),
('2021-1235-A', 'Lapaz', 'San Jose', 'Iloilo', '2014-08-14'),
('2021-3645-A', 'Cabatuan', 'Danao', 'Iloilo', '2002-08-02'),
('2021-3737-A', 'Mohon', 'Zone1', 'Iloilo', '2001-11-07'),
('2021-4375-A', 'Cabatuan', 'Cabugao Sur', 'Iloilo', '2001-08-25'),
('2021-4653-A', 'Cabatuan', 'Bolong Este', 'Iloilo', '2003-08-06'),
('2021-4785-A', 'Pavia', 'Sambag', 'Iloilo', '2002-04-21'),
('2021-5630-A', 'Jaro', 'Zone1', 'Iloilo', '2001-05-29'),
('2021-7432-A', 'Lapaz', 'Burgos st.', 'Iloilo', '2002-07-05'),
('2021-7654-A', 'Jaro', 'San Jose', 'Iloilo', '2001-11-30'),
('2021-8724-A', 'Santa Barbara', 'Bolong Este', 'Iloilo', '2001-05-07'),
('2021-8733-A', 'Lapaz', 'Burgos st.', 'Iloilo', '2002-03-31'),
('2021-8764-A', 'Jaro', 'Sambag', 'Iloilo', '2002-12-01'),
('2021-8764-D', 'Pavia', 'Cabugao Sur', 'Iloilo', '2003-09-24'),
('2022', 'Mohon', 'San Jose', 'Iloilo', '2002-08-08'),
('2022-6332-A', 'Santa Barbara', 'Sambag', 'Iloilo', '2003-04-04'),
('2022-6742-A', 'Lapaz', 'Burgos st.', 'Iloilo', '2004-04-02'),
('2022-9078-A', 'Janiuay', 'Anhawan', 'Iloilo', '2003-11-15'),
('2023', 'Pavia', 'Bolong Este', 'Iloilo', '2001-09-09'),
('2023-4678-A', 'Mohon', 'San Jose', 'Iloilo', '2004-06-23'),
('2023-5478-A', 'Guimbal', 'Cabubugan', 'Iloilo', '2004-12-06'),
('2024-2981-V', 'Jaro', 'Zone1', 'Iloilo', '2005-06-09'),
('2024-4536-A', 'Cabatuan', 'Linis Patag', 'Iloilo', '2006-09-07'),
('2024-7878-A', 'Roxas ', 'Paralan,Maayon', 'Iloilo', '2005-03-08'),
('a1-Asbart', 'a1-Asbart', 'a1-Asbart', 'a1-Asbart', '2024-12-31'),
('a1-Asbartq', 'a1-Asbart', 'a1-Asbart', 'a1-Asbart', '2024-12-31'),
('admin1', 'Madminss', 'Badminss', 'Padminss', '2024-11-25'),
('another', 'another', 'another', 'another', '2024-12-07'),
('A_sbertp', 'A_sbertp', 'A_sbertp', 'A_sbertp', '2024-12-08'),
('librarian1', 'Mlibrarian', 'Blibrarian', 'Plibrarian', '2024-12-01'),
('student1', 'Sstudent', 'Bstudent', 'Pstudent', '2024-12-01'),
('test me', 'test me', 'test metest me', 'test me', '2024-12-08');

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
(19, 'admin1', '12:35:29', '12:37:57', '2024-11-14', 1),
(20, 'admin1', '12:38:57', '01:35:08', '2024-11-14', 1),
(21, '2020-5643-A', '01:34:57', '01:35:28', '2024-11-14', 1),
(22, 'admin1', '07:49:58', '08:20:03', '2024-11-14', 1),
(23, 'admin1', '12:03:31', '12:38:46', '2024-11-15', 1),
(24, '2020-5643-A', '12:32:14', '12:37:16', '2024-11-15', 1),
(25, '2020-5643-A', '12:38:33', '02:13:24', '2024-11-15', 1),
(26, 'admin1', '12:39:08', '01:48:18', '2024-11-15', 1),
(27, '2020-0876-A', '08:04:29', '08:08:47', '2024-11-23', 1),
(28, '2020-7656-A', '08:05:11', NULL, '2024-11-23', 0),
(29, 'admin1', '08:36:14', NULL, '2024-11-23', 0),
(30, 'STUDENT1', '04:19:39', '04:19:49', '2024-12-08', 1),
(31, 'STUDENT1', '04:19:55', '04:19:56', '2024-12-08', 1),
(32, 'STUDENT1', '04:19:57', '04:19:58', '2024-12-08', 1),
(33, 'STUDENT1', '04:19:59', '04:20:00', '2024-12-08', 1),
(34, 'STUDENT1', '04:20:02', '04:20:03', '2024-12-08', 1),
(35, 'STUDENT1', '04:20:04', '04:20:05', '2024-12-08', 1),
(36, 'STUDENT1', '04:20:06', '04:20:19', '2024-12-08', 1),
(37, 'STUDENT1', '04:20:20', '04:20:20', '2024-12-08', 1),
(38, 'STUDENT1', '04:20:21', '04:20:22', '2024-12-08', 1),
(39, 'STUDENT1', '04:20:23', '04:20:24', '2024-12-08', 1),
(40, 'STUDENT1', '04:20:25', '04:20:27', '2024-12-08', 1),
(41, 'STUDENT1', '04:20:28', NULL, '2024-12-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
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
  `size` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `UTitle` varchar(255) DEFAULT NULL,
  `VForm` varchar(255) DEFAULT NULL,
  `SUTitle` varchar(255) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `note` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `B_title`, `subtitle`, `author`, `edition`, `LCCN`, `ISBN`, `ISSN`, `MT`, `ST`, `place`, `publisher`, `Pdate`, `copyright`, `extent`, `Odetail`, `size`, `url`, `Description`, `UTitle`, `VForm`, `SUTitle`, `volume`, `note`, `photo`) VALUES
(1, 'adarna ', 'the bird', 'JOSE', '1', '121212', '112112', '122122', 'book', 'LargePrint', 'dono', 'la ko maan', '2024-01-01', '2021', '1 page', 'bahu', '2mm', 'https://coolors.co/f0d3f7-b98ea7-a57982-302f4d-120d31', 'hallow', 'Utilte', 'Vform', 'Sutitle', 10, NULL, '6756c35a12551_windows.jpg'),
(2, 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Batayan sa pagpapakuhulugan ng wika', 'Louie Jane L. Camorahan', '', '', '', '', '', 'Hardcover', 'Iloilo City : Iloilo Science and Technology University, 2023.', '', '0000-00-00', '2023', ' 87 p', '', '27 cm.', NULL, NULL, '', '', '', 0, NULL, NULL),
(3, 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', '', 'Dayna C. Cabaya', '', '', '', '', '', 'not_assigned', 'Iloilo City : Iloilo Science and Technology University, 2023.', '', '2023-11-04', '2023', '71 p', '', '27 cm.', NULL, NULL, '', '', '', 0, NULL, NULL),
(4, 'Bobot', 'an interactive Filipino sign language app ', 'Enrico Augusto Alagao', '', '', '', '', '', 'not_assigned', '', '', '2023-11-04', '2023', '104 p', '', ' 27 cm', NULL, NULL, '', '', '', 0, NULL, '67397190a70cb_default.jpg'),
(5, 'Practical english usage', '', 'Radhika', '', '', '978-9-39233349-1', '', '', 'not_assigned', 'New Delhi, India', 'Paradise Press,', '2023-11-04', ' 2023', '317 pages', '', ' 23 cm', NULL, NULL, '', '', '', 0, NULL, NULL),
(6, 'Essential english grammar', '', 'Mathew Stephen.', '', '', '', '', '', 'not_assigned', 'New Delhi', 'Wisdom Press', '2023-11-04', '2023', '250 pages.', '', '', NULL, NULL, '', '', '', 0, NULL, NULL),
(7, 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', '', 'JV Demberly V. Gorantes', '', '', '', '', '', 'not_assigned', 'Iloilo City', 'Iloilo Science and Technology University', '2024-11-04', '2023', '75 p', '', '27 cm', NULL, NULL, '', '', '', 0, NULL, NULL),
(8, 'Iloilo sports division athletes performance monitoring system', '', 'Claredy G. Gelloani', '', '', '', '', '', 'not_assigned', 'Iloilo City', 'Iloilo Science and Technology University', '0000-00-00', '2024', '191 p', '', '27 cm.', NULL, NULL, '', '', '', 0, NULL, NULL),
(9, 'Human resource information system', '', 'Reneboy Moritcho Jr.', '', '', '', '', '', 'not_assigned', 'Iloilo City', 'Iloilo Science and Technology University', '2024-11-04', '2024', '151 p', '', '27 cm.', NULL, NULL, '', '', '', 0, NULL, NULL),
(10, 'Algorithms ', 'Design and Analysis', 'Bruce Collins', '', '', '', '', '', 'not_assigned', 'USA ', 'American Academic Publisher', '2024-12-07', '2024', '319p', 'llustrations; pic. (b&w)', '25 cm', NULL, NULL, '', '', '', 0, NULL, '6739710e7371f_ID-Card (10).png'),
(11, 'Computing essentials', 'making IT work for you: Introductory 2023', 'Timothy J. O\'Leary', '', '', '978-1-26526321-8', '', '', 'not_assigned', 'New York', 'The McGraw-Hill Companies', '0000-00-00', '2023', '27.5 cm', '', '390pages', NULL, NULL, '', '', '', 0, NULL, NULL),
(13, 'adan and eve', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, '', '', '', 0, NULL, NULL),
(56, 'test all', 'test all 1', 'test all 1', 'test all 1', 'test all 1', 'test all 1', 'test all 1', 'NonMusical Sound Recording 1', 'Paperback 1', 'test all 1', 'test all 1', '2024-11-19', 'test all 1', 'test all 1', 'test all 1', 'test all 1', NULL, NULL, 'test all 1', 'test all 1', 'test all1 1', 0, NULL, NULL),
(57, 'resouce test', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', 0, NULL, NULL),
(58, 'resouce testa', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, '', '', '', 0, NULL, NULL),
(59, 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'Video', 'Other', 'test', 'test', '0000-00-00', 'test', 'test', 'test', 'test', NULL, NULL, '', '', '', 0, NULL, NULL),
(60, 'ertyujik', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, '', '', '', 0, NULL, NULL),
(72, '11111111111', '11111111111', '11111111111', '11111111111', '11111111111', '11111111111', '11111111111', '', 'not_assigned', '11111111111', '11111111111', '0000-00-00', '11111111111', '11111111111', '11111111111', '11111111111', NULL, NULL, '11111111111', '11111111111', '11111111111', 2147483647, NULL, NULL),
(73, '112112', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, '112112aq', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, '112112aq11', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, '11111111111112', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, '11111111111112q', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, '11222111112q', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 'ano na ba ', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'aaaa', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, '11qq1', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, '11qq1aa', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, '11qq1aaqq', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'qq', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'adddaa', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'adddaaq1', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, '1111111', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'adawdw', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'adawdwqqq', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, '12aaa', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, '1233', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL),
(99, '3232', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, '44412', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'dwdw', '', 'ddd', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(104, 'wewe', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(105, '3124rwed', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(106, 'helllowww', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', 'hi', '', '', '', 0, NULL, NULL),
(107, 'test1', 'test1', 'test1', 'test1', 'test1', 'test1', 'test1', 'Computer File', 'Hardcover', 'test1', 'test1', '2024-12-31', 'test1', 'test1', 'test1', '1', '0', 'test1', 'test1', 'test1', 'test1', 0, NULL, NULL),
(108, 'test123', 'test12', 'test12', 'test12', 'test12', 'test12', 'test12', 'Map', 'Dictionary', 'test12', 'test12', '2024-12-31', 'test12', 'test12', 'test12', '123', '0', 'test12', 'test12u', 'test12v', 'test12s', 30, NULL, NULL),
(134, 'qwqwqw', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(135, 'wwqwqw', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(136, 'wwqwqwq', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(137, 'ertyujikwww', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(138, 'wqwqe', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(139, '111121111', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 121221, NULL, NULL),
(140, '111121111w', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 121221, NULL, NULL),
(141, '111121111www', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 121221, NULL, NULL),
(142, '21212', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(143, '111111', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(144, 'qsqs', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(145, 'qsqsss', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(146, 'ewdwdw', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(147, 'wwww', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(148, '1111', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(149, '1211', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(150, '12111', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(151, '111112212', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(152, '11111221212', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(153, '232eeqw', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(154, '232eeqwq', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(155, '121232re', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(156, 'qqsssqs', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(157, 'wqqwq', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(158, '1112112wsx1', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(159, '112121wsdx', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(160, 'qwqw111', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(161, '121211', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(162, '12121212121212', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(163, '1111ss33', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(164, 'aba ako pa natural', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL),
(165, 'qwqw', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', '0', '', '', '', '', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_copies`
--

CREATE TABLE `book_copies` (
  `ID` int(11) NOT NULL,
  `book_copy` varchar(50) NOT NULL,
  `copy_ID` varchar(50) NOT NULL,
  `B_title` varchar(255) NOT NULL,
  `status` enum('Available','Borrowed','Reserve') DEFAULT NULL,
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
  `fundingSource` varchar(100) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `note` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_copies`
--

INSERT INTO `book_copies` (`ID`, `book_copy`, `copy_ID`, `B_title`, `status`, `callNumber`, `circulationType`, `dateAcquired`, `description1`, `description2`, `description3`, `number1`, `number2`, `number3`, `Sublocation`, `vendor`, `fundingSource`, `rating`, `note`) VALUES
(681, 'BOOK0000006', '123121', 'adarna ', 'Available', '933813 CS32 2021', 'General Circulation', '2024-11-02', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 0, '0'),
(682, 'BOOK000007', '123121', 'adarna ', 'Available', '933813 CS32 2021', 'General Circulation', '2024-11-02', '', '', '', 0, 0, 0, 'kilid kilid', 'tatay mo', 'kinawat', 5, '0'),
(687, 'BOOK0000008', 'ISATU000031287', 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Borrowed', 'Fil-R 0803 C185 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Other', 0, '0'),
(688, 'BOOK0000009', 'ISATU000031287', 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Available', 'Fil-R 0803 C185 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Other', 0, '0'),
(689, 'BOOK0000010', 'ISATU000031287', 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Available', 'Fil-R 0803 C185 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Other', 0, '0'),
(690, 'BOOK0000011', 'ISATU000031292', 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', 'Available', 'Fil-R 0803 C113 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Purchased', 0, '0'),
(691, 'BOOK0000012', 'ISATU000031292', 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', 'Available', 'Fil-R 0803 C113 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Purchased', 0, '0'),
(692, 'BOOK0000013', 'ISATU000031292', 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', 'Available', 'Fil-R 0803 C113 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Purchased', 0, '0'),
(693, 'BOOK0000014', 'ISATU000031171', 'Bobot', 'Available', 'Fil-R 0702 A316 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, '0'),
(694, 'BOOK0000015', 'ISATU000031171', 'Bobot', 'Available', 'Fil-R 0702 A316 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 1, '0'),
(695, 'BOOK0000016', 'ISATU000031171', 'Bobot', 'Available', 'Fil-R 0702 A316 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, '0'),
(696, 'BOOK0000017', 'ISATU000031171', 'Bobot', 'Available', 'Fil-R 0702 A316 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 1, '0'),
(697, 'BOOK0000018', 'ISATUMC0013380', 'Practical english usage', 'Available', '428.24 R128 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Donated', 1, '0'),
(698, 'BOOK0000019', 'ISATUMC0013380', 'Practical english usage', 'Available', '428.24 R128 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Donated', 1, '0'),
(699, 'BOOK0000020', 'ISATUMC0013380', 'Practical english usage', 'Available', '428.24 R128 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Donated', 5, '0'),
(700, 'BOOK0000021', 'ISATUMC0013175', 'Essential english grammar', 'Available', '428.24 St435 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Donated', 0, '0'),
(701, 'BOOK0000022', 'ISATUMC0013175', 'Essential english grammar', 'Available', '428.24 St435 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Donated', 5, '0'),
(702, 'BOOK0000023', 'ISATUMC0013175', 'Essential english grammar', 'Available', '428.24 St435 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Donated', 3, '0'),
(703, 'BOOK0000024', 'ISATU000030886', 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', 'Available', 'Fil-R 0802 G661 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Purchased', 3, '0'),
(704, 'BOOK0000025', 'ISATU000030886', 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', 'Available', 'Fil-R 0802 G661 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Purchased', 3, '0'),
(705, 'BOOK0000026', 'ISATU000031934', 'Iloilo sports division athletes performance monitoring system', 'Available', 'Fil-R 0702 G319 2024	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Purchased', 3, '0'),
(706, 'BOOK0000027', 'ISATU000031934', 'Iloilo sports division athletes performance monitoring system', 'Available', 'Fil-R 0702 G319 2024	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Purchased', 3, '0'),
(707, 'BOOK0000028', 'ISATU000031931', 'Human resource information system', 'Available', 'Fil-R 0702 M862 2024', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Donated', 3, '0'),
(708, 'BOOK0000029', 'ISATUMC0013485', 'Algorithms ', 'Available', '004 C712 2024	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Reserve-MC	', 'DTFOS Bookstore', 'Purchased', 5, '0'),
(709, 'BOOK0000030', 'ISATUIC0000345	', 'Computing essentials', 'Available', '004 O999 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, '0'),
(710, 'BOOK0000031', 'ISATUIC0000345	', 'Computing essentials', 'Available', '004 O999 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, '0'),
(711, 'BOOK0000032', 'ISATUIC0000345	', 'Computing essentials', 'Available', '004 O999 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, '0'),
(712, 'BOOK0000033', '12345', 'adan and eve', 'Available', '23r4', 'Reserve', '2024-11-20', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, '0'),
(713, 'BOOK0000034', 'ISATU000031287', 'test all', 'Available', 'Fil-R 0803 C185 2023', 'Reference', '2024-11-20', 'fried', 'miguel', '', 12, 22, 0, '', '', '', 5, '0'),
(714, 'BOOK0000035', 'ISATU000031292', 'test all', 'Available', 'dwdww', 'General Circulation', '2024-11-20', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, '0'),
(715, 'BOOK0000036', 'ISATUMC0013380', 'test all', 'Available', 'Fil-R 0803 C113 2023', 'General Circulation', '2024-11-20', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 4, '    There are no notes for this copy.\r\n    '),
(716, 'BOOK0000037', '2345678', 'test all', 'Available', 'Fil-R 0803 C185 2023', 'General Circulation', '2024-11-21', '1', '1', '1', 1, 1, 1, 'Filipiniana', 'add', 'KINAWAT', 4, ''),
(717, 'BOOK0000038', 'q', 'test all', 'Available', 'q', 'Reserve', '2024-11-21', '1', '1', '1', 1, 1, 1, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, ''),
(718, 'BOOK0000039', 'q', 'test all', 'Available', 'q', 'Reserve', '2024-11-21', '1', '1', '1', 1, 1, 1, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 4, ''),
(719, 'BOOK0000040', 'test', 'test all', 'Available', 'test', 'General Circulation', '2024-11-21', 'testt', 'test', 't4es', 333, 33, 33, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, 'test'),
(720, 'BOOK0000041', 'ISATUMC0013175', 'Iloilo sports division athletes performance monitoring system', 'Available', '428.24 St435 2023', 'General Circulation', '2024-11-24', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 4, 'hello'),
(721, 'BOOK0000042', 'test', 'Computing essentials', 'Available', 'qqq', 'General Circulation', '2024-11-25', 'e', 'e', 'e', 1, 1, 1, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, 'nothing in particular'),
(722, 'BOOK0000043', 'test', 'Computing essentials', 'Available', 'qqq', 'General Circulation', '2024-11-25', 'e', 'e', 'e', 1, 1, 1, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 4, 'nothing in particular'),
(723, 'BOOK0000044', 'qq', 'adarna ', 'Available', 'qq', 'Reference', '2024-11-25', 'qq', 'qq', 'qq', 22, 22, 22, 'ssss', 'ss', 'qssq', 5, ''),
(724, 'BOOK0000045', 'qq', 'adarna ', 'Available', 'qq', 'Reference', '2024-11-25', 'qq', 'qq', 'qq', 22, 22, 22, 'ssss', 'ss', 'qssq', 5, ''),
(725, 'BOOK0000046', '123121', 'adarna ', 'Available', '933813 CS32 2021', 'General Circulation', '2024-11-30', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 4, 'hello'),
(726, 'BOOK0000047', '123121', 'adarna ', 'Available', '933813 CS32 2021', 'General Circulation', '2024-11-30', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, 'hello'),
(728, 'BOOK0000001', '1', 'test', 'Available', '1', 'General Circulation', '2024-12-06', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 2, 'https://www.facebook.com/share/r/14qpUKRk9N/'),
(729, 'BOOK0000002', 'a', 'test', 'Available', 'a', 'General Circulation', '2024-12-06', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 2, 'dapat 2'),
(730, 'BOOK0000003', '1', 'test', 'Available', '1', 'General Circulation', '2024-12-06', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 2, '2'),
(731, 'BOOK0000004', '1', 'test', 'Available', '1', 'General Circulation', '2024-12-06', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 2, '2');

--
-- Triggers `book_copies`
--
DELIMITER $$
CREATE TRIGGER `before_insert_book_copies` BEFORE INSERT ON `book_copies` FOR EACH ROW BEGIN
  -- Generate the next book_id by querying the maximum existing ID
  DECLARE next_id INT;

  -- Find the maximum current book_id number and increment it
  SELECT IFNULL(MAX(CAST(SUBSTRING(book_id, 5) AS UNSIGNED)), 0) + 1 INTO next_id
  FROM `book_copies`;

  -- Set the book_id value in the desired format
  SET NEW.book_id = CONCAT('BOOK', LPAD(next_id, 7, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_book`
--

CREATE TABLE `borrow_book` (
  `borrow_id` int(11) NOT NULL,
  `IDno` varchar(11) NOT NULL,
  `book_id` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL,
  `borrow_date` datetime NOT NULL DEFAULT current_timestamp(),
  `return_date` datetime DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_book`
--

INSERT INTO `borrow_book` (`borrow_id`, `IDno`, `book_id`, `ID`, `borrow_date`, `return_date`, `due_date`) VALUES
(175, '2021-3645-A', 'BOOK0000008', 0, '2024-12-06 17:01:36', '2024-12-08 20:55:45', '2025-09-25'),
(176, '2021-0909-A', 'BOOK0000018', 0, '2024-12-06 17:02:03', '2024-12-06 19:04:06', '2023-09-07'),
(177, 'admin1', 'BOOK0000017', 0, '2024-12-06 17:02:45', '2024-12-06 19:04:06', '2025-03-06'),
(178, 'admin1', 'BOOK0000009', 0, '2024-12-06 17:02:45', '2024-12-06 19:04:06', '2025-03-06'),
(179, '2022-9078-A', 'BOOK0000020', 0, '2024-12-06 17:03:05', '2024-12-06 20:21:07', '2025-03-06'),
(180, '2022-6742-A', 'BOOK0000010 ', 0, '2024-12-06 18:43:01', '2024-12-08 20:55:48', '2024-12-11'),
(181, '2022-6742-A', 'BOOK0000011 ', 0, '2024-12-06 18:43:01', '2024-12-08 20:46:17', '2024-12-11'),
(182, 'librarian1', 'BOOK0000006', 0, '2024-12-06 19:10:55', '2024-12-08 20:51:24', '2024-03-07'),
(183, '2020-9452-A', 'BOOK0000012 ', 0, '2024-12-06 19:13:31', '2024-12-06 20:18:21', '2025-08-06'),
(184, '2020-9452-A', 'BOOK0000013 ', 0, '2024-12-06 19:13:31', '2024-12-06 20:14:51', '2024-12-11'),
(185, '2020-9452-A', 'BOOK0000011 ', 0, '2024-12-06 19:13:31', '2024-12-08 20:46:17', '2024-12-11'),
(186, 'student1', 'BOOK0000010 ', 0, '2024-12-06 20:11:07', '2024-12-08 20:55:48', '2024-12-11'),
(187, 'student1', 'BOOK0000012 ', 0, '2024-12-06 20:11:07', '2024-12-06 20:18:21', '2024-12-11'),
(188, 'student1', 'BOOK0000013 ', 0, '2024-12-06 20:11:07', '2024-12-06 20:14:51', '2024-12-11'),
(189, 'student1', 'BOOK0000023 ', 0, '2024-12-06 20:11:07', '2024-12-08 20:55:51', '2024-12-11'),
(190, '2020-2941-A', 'BOOK0000010 ', 0, '2024-12-06 20:17:19', '2024-12-08 20:55:48', '2025-03-06'),
(191, '2020-2941-A', 'BOOK0000012 ', 0, '2024-12-06 20:17:19', '2024-12-06 20:18:21', '2025-03-06'),
(192, '2020-2941-A', 'BOOK0000020 ', 0, '2024-12-06 20:17:19', '2024-12-06 20:21:07', '2025-03-06'),
(193, '2020-0876-A', 'BOOK0000006 ', 0, '2024-12-06 22:18:05', '2024-12-08 20:51:24', '2024-03-07'),
(194, '2020-0876-A', 'BOOK0000008 ', 0, '2024-12-06 22:18:05', '2024-12-08 20:55:45', '2025-03-06'),
(195, '2023-5478-A', 'BOOK0000014 ', 0, '2024-12-06 22:19:04', '2024-12-08 20:53:50', '2025-03-06'),
(196, '2023-5478-A', 'BOOK0000011 ', 0, '2024-12-06 22:19:04', '2024-12-08 20:46:17', '2025-03-06'),
(197, '2023-5478-A', 'BOOK0000030', 0, '2024-12-06 22:19:04', '2024-12-08 20:56:28', '2025-03-06'),
(198, '2021-8764-A', 'BOOK0000016 ', 0, '2024-12-06 22:23:08', '2024-12-08 20:46:31', '2024-12-11'),
(199, '2021-8764-A', 'BOOK0000021 ', 0, '2024-12-06 22:23:08', '2024-12-08 20:51:14', '2024-12-11'),
(200, 'admin1', 'BOOK0000022', 0, '2024-12-06 22:39:56', '2024-12-08 20:55:53', '2025-03-06'),
(201, '2020-2941-A', 'BOOK0000008', 0, '2024-12-09 16:30:22', NULL, '2025-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `coauthor`
--

CREATE TABLE `coauthor` (
  `co_author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `Co_Name` varchar(255) DEFAULT NULL,
  `Co_Date` date DEFAULT NULL,
  `Co_Role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coauthor`
--

INSERT INTO `coauthor` (`co_author_id`, `book_id`, `Co_Name`, `Co_Date`, `Co_Role`) VALUES
(163, 158, '11', '2024-12-12', '11'),
(164, 159, '112121', '2024-12-12', '1122'),
(165, 160, 'eee', '0000-00-00', 'eewd'),
(166, 160, '11', '2024-12-12', '11'),
(167, 160, '11', '2024-12-12', '11'),
(168, 161, '212wes', '2024-12-12', 'e2ed'),
(169, 161, '21', '2024-12-12', '21'),
(170, 161, '1212', '2024-12-12', '212w'),
(171, 162, '1', '2024-12-12', '1'),
(172, 162, '1', '2024-12-12', '1'),
(173, 162, '1', '2024-12-12', '1'),
(174, 163, '111', '2024-12-12', '1111'),
(175, 163, 'q', '2024-12-12', 'q'),
(176, 163, 'wqwqwq', '2024-12-12', '2'),
(177, 163, '11', '1111-11-11', '11'),
(178, 163, '1111', '2024-12-12', '111'),
(179, 163, '1111', '2024-12-12', '11'),
(180, 164, '1', '2024-12-12', '1'),
(181, 164, '1', '2024-12-12', '1'),
(182, 164, '1', '2024-12-12', '1'),
(183, 165, '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `IDno` varchar(11) NOT NULL,
  `email1` varchar(100) DEFAULT NULL,
  `con1` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`IDno`, `email1`, `con1`) VALUES
('', '', ''),
('2020-0876-A', 'vonjohnsuropia116@gmail.com', '09786543219'),
('2020-2941-A', 'Madelyn12@gmail.com', '09098555642'),
('2020-2981-A', 'Hans@gmail.com', '09456789101'),
('2020-5643-A', 'kheena@gmail.com', '09786567219'),
('2020-7656-A', 'Jane@gmail.com', '09046789101'),
('2020-9452-A', 'Yano@gmail.com', '09956789101'),
('2021-0909-A', 'Kenley24@gmail.com', '09709543216'),
('2021-0994-A', 'William3@gmail.com', '09786543219'),
('2021-1234-A', 'allah1@gmail.com', '09956789101'),
('2021-1235-A', 'Brooke09@gmail.com', '09709543216'),
('2021-3645-A', 'Noah1234@gmail.com', '09456789101'),
('2021-3737-A', 'Elizabeth38@gmail.com', '09786543219'),
('2021-4375-A', 'JaneGirl@gmail.com', '09956789101'),
('2021-4653-A', 'Philip14@gmail.com', '09709543216'),
('2021-4785-A', 'Edgar146@gmail.com', '09709543216'),
('2021-5630-A', 'Anna74@gmail.com', '09456789101'),
('2021-7432-A', 'Jeremy74@gmail.com', '09786543219'),
('2021-7654-A', 'Benjamin1@gmail.com', '09709543216'),
('2021-8724-A', 'Taylor72@gmail.com', '09456789101'),
('2021-8733-A', 'Calvin4@gmail.com', '09786543219'),
('2021-8764-A', 'gina@gmail.com', '09709543216'),
('2021-8764-D', 'Claire65@gmail.com', '09098555642'),
('2022', 'vonjohn.suropia@students.isatu.edu.ph', '09709543216'),
('2022-6332-A', 'Layla4@gmail.com', '09098735642'),
('2022-6742-A', 'mikajane@gmail.com', '09098735642'),
('2022-9078-A', 'Damn@gmail.com', '09786673219'),
('2023', '\njohnwindricksucias@gmail.com ', '09098735642'),
('2023-4678-A', 'Grad@gmail.com', '09098555642'),
('2023-5478-A', 'UMami@gmail.com', '09128555642'),
('2024-2981-V', 'vonjohn.suropia@students.isatu.edu.ph', '09098735642'),
('2024-4536-A', 'Trans@gmail.com', '09736543219'),
('2024-7878-A', 'Cramps@gmail.com', '09788735642'),
('a1-Asbart', 'vonjohnsuropia116@gmail.com', '56783456789'),
('a1-Asbartq', 'vonjohnsuropia116@gmail.com', '56783456789'),
('admin1', 'vonjohnsuropia116@gmail.com', '0900000000011'),
('another', 'vonjohnsuropia116@gmail.com', '98765432222'),
('A_sbertp', 'vonjohnsuropia116@gmail.com', '09000000000'),
('librarian1', 'vonjohnsuropia116@gmail.com', '09000000000'),
('student1', 'vonjohnsuropia116@gmail.com', '09000000000'),
('test me', 'vonjohnsuropia116@gmail.com', '00000000000');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `from_user_id` varchar(11) NOT NULL,
  `to_user_id` varchar(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `from_user_id`, `to_user_id`, `message`, `timestamp`, `is_read`) VALUES
(2, 'admin1', '2020-2941-A', 'a', '2024-11-29 17:47:17', 0),
(3, 'admin1', '2022-9078-A', 'hello', '2024-11-29 17:47:54', 1),
(4, '2022-9078-A', 'admin1', 'whazap', '2024-11-29 17:48:09', 1),
(6, '2022', 'admin1', 'hey', '2024-11-29 17:59:32', 1),
(7, '2022', '2022', 'need some', '2024-11-29 17:59:47', 0),
(8, '2022', 'admin1', 'need to ask', '2024-11-29 17:59:54', 1),
(9, 'admin1', '2022', 'why', '2024-11-29 18:00:03', 1),
(10, 'admin1', '2020-2941-A', 'hey', '2024-11-29 18:02:19', 0),
(11, 'admin1', '2022', 'still think', '2024-11-29 18:02:31', 1),
(12, '2022-9078-A', 'admin1', 'yow', '2024-11-29 18:02:44', 1),
(13, 'admin1', '2022-9078-A', 'hey', '2024-11-29 18:03:33', 1),
(14, 'admin1', '2022', 'ss', '2024-11-29 18:08:03', 1),
(15, '2022', 'admin1', 'why', '2024-11-29 18:08:25', 1),
(16, '2024-7878-A', 'admin1', 'hello', '2024-11-29 18:13:53', 1),
(17, 'admin1', '2024-7878-A', 'yep', '2024-11-29 18:24:05', 1),
(18, '2022-9078-A', 'admin1', 'yow', '2024-11-29 18:32:23', 1),
(19, 'admin1', '2022-9078-A', 'what', '2024-11-29 18:32:30', 1),
(20, '2022-9078-A', 'admin1', 'yep', '2024-11-29 18:41:46', 1),
(21, 'admin1', '2022-9078-A', 'aa', '2024-11-29 18:42:35', 1),
(22, 'admin1', '2022-9078-A', 'aa', '2024-11-29 18:42:37', 1),
(23, 'admin1', '2024-7878-A', 'ss', '2024-11-29 18:42:42', 1),
(24, 'admin1', '2022', 'aa', '2024-11-29 19:29:54', 1),
(25, 'admin1', '2024-7878-A', 'a', '2024-11-29 19:30:36', 1),
(26, 'admin1', '2024-7878-A', 'a', '2024-11-29 19:30:39', 1),
(27, '2024-7878-A', 'admin1', 'heeeyu', '2024-11-29 19:31:17', 1),
(28, '2022', 'admin1', 'hello', '2024-11-29 19:57:29', 1),
(29, 'admin1', '2022', 'hey', '2024-11-29 20:04:01', 1),
(30, '2024-7878-A', '2022', 'hey friend', '2024-11-29 20:04:52', 1),
(31, '2022', '2024-7878-A', 'need you presence', '2024-11-30 01:53:41', 1),
(32, '2022', 'admin1', 'eyy', '2024-11-30 01:56:57', 1),
(33, '2020-0876-A', 'admin1', 'hello im nobody', '2024-11-30 10:11:58', 1),
(34, 'admin1', '2020-0876-A', 'finne', '2024-11-30 10:18:30', 1),
(35, 'student1', 'librarian1', 'hey need your funds', '2024-12-01 05:14:45', 1),
(36, 'librarian1', 'student1', 'yes yes', '2024-12-01 05:21:06', 1),
(37, 'librarian1', 'student1', 'appreciated', '2024-12-01 05:21:12', 1),
(38, 'student1', 'admin1', 'hello need new books', '2024-12-01 06:05:39', 1),
(39, 'admin1', 'student1', 'not my concern thought', '2024-12-01 06:06:04', 1),
(40, 'student1', 'admin1', 'nce', '2024-12-01 06:06:13', 1),
(41, 'librarian1', 'student1', 'and add some goods', '2024-12-01 06:59:21', 1),
(42, 'student1', 'librarian1', 'good', '2024-12-01 06:59:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `Sub_Head` varchar(255) DEFAULT NULL,
  `Sub_Head_input` varchar(255) DEFAULT NULL,
  `comment` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `book_id`, `Sub_Head`, `Sub_Head_input`, `comment`) VALUES
(180, 158, 'Tropical Heading', '', ''),
(181, 159, 'Tropical Heading', '', ''),
(182, 160, 'Tropical Heading', '', ''),
(183, 161, 'Tropical Heading', '', ''),
(184, 162, 'Local Heading', '2323', '222'),
(185, 162, 'Tropical Heading', '32', ''),
(186, 162, 'Personal Heading', '2323', ''),
(187, 163, 'Tropical Heading', '', 'wss'),
(188, 164, 'Tropical Heading', 'w1w', '1w1s'),
(189, 165, 'Tropical Heading', '', '');

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
('', '', '', '', 'N/A', '', 'default.jpg'),
('2020-0876-A', 'Jhos', 'Sim', 'Grad', 'N/A', 'Male', '6741c0a7dcda0_460944686_1177150106917642_4960290106544083410_n.png'),
('2020-2941-A', 'Madelyn', 'Grover', 'V', 'N/A', 'f', 'default.jpg'),
('2020-2981-A', 'Hans', 'Gard', 'Arms', 'N/A', 'm', 'default.jpg'),
('2020-5643-A', 'Kheena', 'Molt', 'Ako', 'N/A', 'Male', '6740735f6c067_54489f2f-f2f4-4bea-9455-149dbe7ff948.jfif'),
('2020-7656-A', 'Jane', 'Fanthear', 'Ban', 'N/A', 'Male', '6741c102ea0f0_61RPubboeNL._AC_UF894,1000_QL80_.jpg'),
('2020-9452-A', 'Yano', 'Tachibana', 'Yamamoshi', 'N/A', 'f', 'default.jpg'),
('2021-0909-A', 'Kenley', 'Tachibana', 'L', 'N/A', 'm', 'default.jpg'),
('2021-0994-A', 'William', 'Dickhead', 'T', 'N/A', 'm', 'default.jpg'),
('2021-1234-A', 'Allah', 'Muhhamad', 'D', 'N/A', 'm', 'default.jpg'),
('2021-1235-A', 'Brooke', 'Arbobro', 'L', 'N/A', 'm', 'default.jpg'),
('2021-3645-A', 'Noah', 'Muller', 'V', 'N/A', 'm', 'default.jpg'),
('2021-3737-A', 'Elizabeth', 'Claus', 'K', 'N/A', 'f', 'default.jpg'),
('2021-4375-A', 'Jane Girl', 'Rock', 'G', 'N/A', 'f', 'default.jpg'),
('2021-4653-A', 'Philip', 'Grey', 'F', 'N/A', 'm', 'default.jpg'),
('2021-4785-A', 'Edgar', 'Gomez', 'B', 'N/A', 'm', 'default.jpg'),
('2021-5630-A', 'Anna', 'Thomas', 'X', 'N/A', 'Male', '6741c188ca425_fea969c4-7d33-4371-8885-61f5e2577c73.jpg'),
('2021-7432-A', 'Jeremy', 'Grime', 'M', 'N/A', 'm', 'default.jpg'),
('2021-7654-A', 'Benjamin', 'Brown', 'S', 'N/A', 'm', 'default.jpg'),
('2021-8724-A', 'Taylor', 'Black', 'N', 'N/A', 'f', 'default.jpg'),
('2021-8733-A', 'Calvin', 'Palaaway', 'C', 'N/A', 'm', 'default.jpg'),
('2021-8764-A', 'Gina', 'Dickens', 'Cren', 'N/A', 'f', 'default.jpg'),
('2021-8764-D', 'Claire', 'Stewart', 'H', 'N/A', 'f', 'default.jpg'),
('2022', 'Scarlet', 'White', 'V', 'N/A', 'f', 'default.jpg'),
('2022-6332-A', 'Layla', 'Quin', 'B', 'N/A', 'f', 'default.jpg'),
('2022-6742-A', 'Mika Jane', 'Yato', 'Fen', 'N/A', 'f', 'default.jpg'),
('2022-9078-A', 'Damn', 'Stitch', 'Men', 'N/A', 'o', 'default.jpg'),
('2023', 'Makayla', 'Morgan', 'D', 'N/A', 'f', 'default.jpg'),
('2023-4678-A', 'Grad', 'Jam', 'Treek', 'N/A', 'm', 'default.jpg'),
('2023-5478-A', 'Umay', 'Gad', 'Ho', 'N/A', 'm', 'default.jpg'),
('2024-2981-V', 'Destiny', 'Kramel', 'J', 'N/A', 'f', 'default.jpg'),
('2024-4536-A', 'Trans', 'Gender', 'LGBT', 'N/A', 'o', 'default.jpg'),
('2024-7878-A', 'Crams', 'Cammy', 'Pie', 'N/A', 'm', 'default.jpg'),
('a1-Asbart', 'a1-Asbart', 'a1-Asbart', 'a1-Asbart', 'N/A', 'o', 'default.jpg'),
('a1-Asbartq', 'a1-Asbart', 'a1-Asbart', 'a1-Asbart', 'N/A', 'o', 'default.jpg'),
('admin1', 'adminss', 'adss', 'minss', 'N/Ass', 'Male', '6753241d44415_default.jpg'),
('another', 'another', 'another', 'another', 'N/A', 'm', 'default.jpg'),
('A_sbertp', 'A_sbertp', 'A_sbertp', 'A_sbertp', 'N/A', 'm', 'default.jpg'),
('librarian1', 'libr', 'librarian', 'arian', 'N/A', 'Male', '674bee2a4a95f_gintoki-appology.jpg'),
('student1', 'stu', 'student', 'dent', 'N/A', 'Male', '674bf52e6d826_fghjkl.png'),
('test me', 'test me', 'test me', 'test me', 'N/A', 'o', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `IDno` varchar(11) NOT NULL,
  `college` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `yrLVL` varchar(50) DEFAULT NULL,
  `A_LVL` varchar(11) DEFAULT NULL,
  `status` enum('active','inactive','restricted') DEFAULT NULL,
  `personnel_type` enum('Non-Teaching Personnel','Teaching Personnel','') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`IDno`, `college`, `course`, `yrLVL`, `A_LVL`, `status`, `personnel_type`) VALUES
('', '', '', '', '3', 'active', ''),
('2020-0876-A', 'cas', 'BS in English', '3 D', '3', 'active', NULL),
('2020-2941-A', 'coe', 'BEEd ', '4 A', '3', 'active', NULL),
('2020-2981-A', 'cea', 'BS in Civil Eng', '3 C', '3', 'active', NULL),
('2020-5643-A', 'cea', 'BS in Architecture', '2 A', '3', 'active', NULL),
('2020-7656-A', 'cit', 'BS in Auto Tech (BSAT) - Level III', '2 B', '3', 'active', NULL),
('2020-9452-A', 'coe', 'BEEd ', '5 C', '3', 'active', NULL),
('2021-0909-A', 'cit', 'BS in Elec Eng (BSELX) - Level III', '3 D', '3', 'active', NULL),
('2021-0994-A', 'cit', 'BS in Hotel & Rest Tech (BSHRT) - Level II', '4 B', '3', 'active', NULL),
('2021-1234-A', 'cas', 'BS in Comm Dev', '3 C', '3', 'active', NULL),
('2021-1235-A', 'cas', 'BS in Info Systems', '3 A', '3', 'active', NULL),
('2021-3645-A', 'cea', 'BS in Architecture', '4 A', '3', 'active', NULL),
('2021-3737-A', 'cas', 'BS in Info Tech', '4 B', '3', 'active', NULL),
('2021-4375-A', 'cea', 'BS in Elec Eng (ECE)', '4 D', '3', 'active', NULL),
('2021-4653-A', 'coe', 'BS in Ind Ed', '4 C', '3', 'active', NULL),
('2021-4785-A', 'cea', 'BS in Elec Eng', '4 B', '3', 'active', NULL),
('2021-5630-A', 'coe', 'BTVTEd', '4 D', '3', 'active', NULL),
('2021-7432-A', 'cea', 'BS in Mech Eng', '4 A', '3', 'active', NULL),
('2021-7654-A', 'cea', 'BS in Civil Eng', '4 D', '3', 'active', NULL),
('2021-8724-A', 'coe', 'BSEd ', '4 B', '3', 'active', NULL),
('2021-8733-A', 'cit', 'BS in Elec Tech (BSELT) - Level III', '4 D', '3', 'active', NULL),
('2021-8764-A', 'cas', 'BS in Info Tech', '1 C', '3', 'active', NULL),
('2021-8764-D', 'cas', 'BS in Comp Sci', '3 C', '3', 'active', NULL),
('2022', 'coe', 'BSEd ', '3 B', '3', 'active', NULL),
('2022-6332-A', 'cit', 'BS in Auto Tech (BSAT) - Level III', '3 A', '3', 'active', NULL),
('2022-6742-A', 'cas', 'BS in Comp Sci', '4 B', '3', 'active', NULL),
('2022-9078-A', 'cit', 'BS in Elec Tech (BSELT) - Level III', '3 A', '3', 'active', NULL),
('2023', 'cit', 'BS in Ind Tech (BIT) - Level III', '2 A', '3', 'active', NULL),
('2023-4678-A', 'cea', 'BS in Elec Eng', '3 A', '3', 'active', NULL),
('2023-5478-A', 'coe', 'BTVTEd', '2 C', '3', 'active', NULL),
('2024-2981-V', 'cas', 'BS in English', '1 C', '3', 'active', NULL),
('2024-4536-A', 'coe', 'BSEd ', '1 D', '3', 'active', NULL),
('2024-7878-A', 'cit', 'BS in Hotel & Rest Tech (BSHRT) - Level II', '1 B', '3', 'active', NULL),
('a1-Asbart', 'cas', 'BS in English', '4 B', '3', 'active', ''),
('a1-Asbartq', 'cas', 'BS in English', '4 B', '3', 'active', ''),
('admin1', 'casss', 'course1ss', '1 Ass', NULL, 'active', NULL),
('another', 'cea', '', '4 A', '3', 'active', ''),
('A_sbertp', 'cea', 'BS in Civil Eng', '4 A', '3', 'active', ''),
('librarian1', 'cas', 'BS in English', '5 A', '3', 'active', NULL),
('student1', 'cas', 'BS in English', '5 C', '3', 'active', NULL),
('test me', 'cas', '', '', '3', 'active', 'Teaching Personnel');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `IDno` varchar(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `U_type` enum('admin','student','professor','staff','librarian','faculty') DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`IDno`, `username`, `password`, `U_type`, `status`) VALUES
('', '', '', 'librarian', 'rejected'),
('2020-0876-A', 'jhos123', 'jhos123', 'professor', 'approved'),
('2020-2941-A', 'Madelyn64', 'Madelyn64', 'professor', 'approved'),
('2020-2981-A', 'Hans78', 'Hans78', 'professor', 'rejected'),
('2020-5643-A', 'kheena32', 'kheena32', 'admin', 'approved'),
('2020-7656-A', 'Jane34', 'Jane34', 'student', 'rejected'),
('2020-9452-A', 'Yano56', 'Yano56', 'student', 'approved'),
('2021-0909-A', 'Kenley753', 'Kenley753', 'student', 'approved'),
('2021-0994-A', 'William12', 'William12', 'student', 'rejected'),
('2021-1234-A', 'allah123', 'allah123', 'student', 'rejected'),
('2021-1235-A', 'Brooke098', 'Brooke098', 'student', 'approved'),
('2021-3645-A', 'Noah09133', 'Noah09133', 'student', 'approved'),
('2021-3737-A', 'Elizabeth87', 'Elizabeth87', 'student', 'rejected'),
('2021-4375-A', 'JaneGirl7', 'JaneGirl7', 'student', 'approved'),
('2021-4653-A', 'Philip88', 'Philip88', 'student', 'approved'),
('2021-4785-A', 'Edgar109', 'Edgar109', 'student', 'rejected'),
('2021-5630-A', 'Anna1265', 'Anna1265', 'student', 'rejected'),
('2021-7432-A', 'Jeremy744', 'Jeremy744', 'student', 'pending'),
('2021-7654-A', 'Benjamin12', 'Benjamin12', 'student', 'approved'),
('2021-8724-A', 'Taylor733', 'Taylor733', 'student', 'approved'),
('2021-8733-A', 'Calvin335', 'Calvin335', 'student', 'approved'),
('2021-8764-A', 'Mika23', 'Mika23', 'student', 'approved'),
('2021-8764-D', 'Claire545', 'Claire545', 'student', 'approved'),
('2022', 'Scarlet344', 'Scarlet344', 'admin', 'approved'),
('2022-6332-A', 'Layla1486', 'Layla1486', 'student', 'approved'),
('2022-6742-A', 'Mikajane@gmail', 'Mikajane@gmail', 'student', 'approved'),
('2022-9078-A', 'Damn7', 'Damn7', 'admin', 'approved'),
('2023', 'Makayla33', 'Makayla33', 'student', 'approved'),
('2023-4678-A', 'Grad41', 'Grad41', 'student', 'approved'),
('2023-5478-A', 'Umai11', 'Umai11', 'admin', 'approved'),
('2024-2981-V', 'Destiny00', 'Destiny00', 'student', 'rejected'),
('2024-4536-A', 'Trans7', 'Trans7', 'admin', 'rejected'),
('2024-7878-A', 'Crams56', 'Crams56', 'admin', 'approved'),
('a1-Asbart', 'a1-Asbart', 'a1-Asbart', 'student', 'pending'),
('a1-Asbartq', 'a1-Asbart', 'a1-Asbart', 'student', 'pending'),
('admin1', 'admin1', 'admin1', 'admin', 'approved'),
('another', 'another11@A', 'another11@A', 'student', 'pending'),
('A_sbertp', 'A_sbertp', 'A_sbertpA_sbertp', 'student', 'approved'),
('librarian1', 'librarian1', 'librarian1', 'librarian', 'approved'),
('student1', 'student1', 'student1', 'student', 'approved'),
('test me', 'teste11@A', 'teste11@A', 'faculty', 'approved');

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
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idx_idno_logdate` (`IDno`,`LOGDATE`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `B_title` (`B_title`);

--
-- Indexes for table `book_copies`
--
ALTER TABLE `book_copies`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `B_title` (`B_title`),
  ADD KEY `book_id` (`book_copy`);

--
-- Indexes for table `borrow_book`
--
ALTER TABLE `borrow_book`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `borrow_book_ibfk_1` (`IDno`),
  ADD KEY `borrow_book_ibfk_2` (`ID`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `coauthor`
--
ALTER TABLE `coauthor`
  ADD PRIMARY KEY (`co_author_id`),
  ADD KEY `B_title` (`book_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`IDno`),
  ADD KEY `IDno` (`IDno`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `B_title` (`book_id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD PRIMARY KEY (`IDno`);

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `book_copies`
--
ALTER TABLE `book_copies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=732;

--
-- AUTO_INCREMENT for table `borrow_book`
--
ALTER TABLE `borrow_book`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `coauthor`
--
ALTER TABLE `coauthor`
  MODIFY `co_author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_users_info` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `book_copies`
--
ALTER TABLE `book_copies`
  ADD CONSTRAINT `fk_book_title` FOREIGN KEY (`B_title`) REFERENCES `book` (`B_title`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `borrow_book`
--
ALTER TABLE `borrow_book`
  ADD CONSTRAINT `borrow_book_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `borrow_book_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `book_copies` (`book_copy`) ON UPDATE CASCADE;

--
-- Constraints for table `coauthor`
--
ALTER TABLE `coauthor`
  ADD CONSTRAINT `fk_coauthor` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON UPDATE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_subject` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON UPDATE CASCADE;

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
