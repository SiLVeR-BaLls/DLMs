-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 03:20 PM
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
('admin1', 'Madminss', 'Badminss', 'Padminss', '2024-11-25'),
('librarian1', 'Mlibrarian', 'Blibrarian', 'Plibrarian', '2024-12-01'),
('student1', 'Sstudent', 'Bstudent', 'Pstudent', '2024-12-01');

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
(44, 'adarna ', 'Utilte', 'Vform', 'Sutitle'),
(46, 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', '', '', ''),
(47, 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', '', '', ''),
(48, 'Bobot', '', '', ''),
(49, 'Practical english usage', '', '', ''),
(50, 'Essential english grammar', '', '', ''),
(51, 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', '', '', ''),
(52, 'Iloilo sports division athletes performance monitoring system', '', '', ''),
(53, 'Human resource information system', '', '', ''),
(54, 'Algorithms ', '', '', ''),
(55, 'Computing essentials', '', '', ''),
(57, 'adan and eve', '', '', ''),
(96, 'test all', 'test all 1', 'test all 1', 'test all1 1'),
(97, 'resouce test', '', '', ''),
(98, 'resouce testa', '', '', '');

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
(29, 'admin1', '08:36:14', NULL, '2024-11-23', 0);

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
  `size` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `B_title`, `subtitle`, `author`, `edition`, `LCCN`, `ISBN`, `ISSN`, `MT`, `ST`, `place`, `publisher`, `Pdate`, `copyright`, `extent`, `Odetail`, `size`, `photo`) VALUES
(1, 'adarna ', 'the bird', 'JOSE', '1', '121212', '112112', '122122', 'book', 'LargePrint', 'dono', 'la ko maan', '2024-01-01', '2021', '1 page', 'bahu', '2mm', '67340a3fc86c0_6237924425727065795.jpg'),
(2, 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Batayan sa pagpapakuhulugan ng wika', 'Louie Jane L. Camorahan', '', '', '', '', '', 'Hardcover', 'Iloilo City : Iloilo Science and Technology University, 2023.', '', '0000-00-00', '2023', ' 87 p', '', '27 cm.', NULL),
(3, 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', '', 'Dayna C. Cabaya', '', '', '', '', '', 'not_assigned', 'Iloilo City : Iloilo Science and Technology University, 2023.', '', '2023-11-04', '2023', '71 p', '', '27 cm.', NULL),
(4, 'Bobot', 'an interactive Filipino sign language app ', 'Enrico Augusto Alagao', '', '', '', '', '', 'not_assigned', '', '', '2023-11-04', '2023', '104 p', '', ' 27 cm', '67397190a70cb_default.jpg'),
(5, 'Practical english usage', '', 'Radhika', '', '', '978-9-39233349-1', '', '', 'not_assigned', 'New Delhi, India', 'Paradise Press,', '2023-11-04', ' 2023', '317 pages', '', ' 23 cm', NULL),
(6, 'Essential english grammar', '', 'Mathew Stephen.', '', '', '', '', '', 'not_assigned', 'New Delhi', 'Wisdom Press', '2023-11-04', '2023', '250 pages.', '', '', NULL),
(7, 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', '', 'JV Demberly V. Gorantes', '', '', '', '', '', 'not_assigned', 'Iloilo City', 'Iloilo Science and Technology University', '2024-11-04', '2023', '75 p', '', '27 cm', NULL),
(8, 'Iloilo sports division athletes performance monitoring system', '', 'Claredy G. Gelloani', '', '', '', '', '', 'not_assigned', 'Iloilo City', 'Iloilo Science and Technology University', '0000-00-00', '2024', '191 p', '', '27 cm.', NULL),
(9, 'Human resource information system', '', 'Reneboy Moritcho Jr.', '', '', '', '', '', 'not_assigned', 'Iloilo City', 'Iloilo Science and Technology University', '2024-11-04', '2024', '151 p', '', '27 cm.', NULL),
(10, 'Algorithms ', 'Design and Analysis', 'Bruce Collins', '', '', '', '', '', 'not_assigned', 'USA ', 'American Academic Publisher', '2024-12-07', '2024', '319p', 'llustrations; pic. (b&w)', '25 cm', '6739710e7371f_ID-Card (10).png'),
(11, 'Computing essentials', 'making IT work for you: Introductory 2023', 'Timothy J. O\'Leary', '', '', '978-1-26526321-8', '', '', 'not_assigned', 'New York', 'The McGraw-Hill Companies', '0000-00-00', '2023', '27.5 cm', '', '390pages', NULL),
(13, 'adan and eve', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL),
(56, 'test all', 'test all 1', 'test all 1', 'test all 1', 'test all 1', 'test all 1', 'test all 1', 'NonMusical Sound Recording 1', 'Paperback 1', 'test all 1', 'test all 1', '2024-11-19', 'test all 1', 'test all 1', 'test all 1', 'test all 1', NULL),
(57, 'resouce test', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL),
(58, 'resouce testa', '', '', '', '', '', '', '', 'not_assigned', '', '', '0000-00-00', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_copies`
--

CREATE TABLE `book_copies` (
  `ID` int(11) NOT NULL,
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

INSERT INTO `book_copies` (`ID`, `copy_ID`, `B_title`, `status`, `callNumber`, `circulationType`, `dateAcquired`, `description1`, `description2`, `description3`, `number1`, `number2`, `number3`, `Sublocation`, `vendor`, `fundingSource`, `rating`, `note`) VALUES
(681, '123121', 'adarna ', 'Borrowed', '933813 CS32 2021', 'General Circulation', '2024-11-02', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 0, '0'),
(682, '123121', 'adarna ', 'Borrowed', '933813 CS32 2021', 'General Circulation', '2024-11-02', '', '', '', 0, 0, 0, 'kilid kilid', 'tatay mo', 'kinawat', 1, '0'),
(687, 'ISATU000031287', 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Available', 'Fil-R 0803 C185 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Other', 2, '0'),
(688, 'ISATU000031287', 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Available', 'Fil-R 0803 C185 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Other', 2, '0'),
(689, 'ISATU000031287', 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Available', 'Fil-R 0803 C185 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Other', 2, '0'),
(690, 'ISATU000031292', 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', 'Available', 'Fil-R 0803 C113 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Purchased', 2, '0'),
(691, 'ISATU000031292', 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', 'Borrowed', 'Fil-R 0803 C113 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Purchased', 3, '0'),
(692, 'ISATU000031292', 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', 'Available', 'Fil-R 0803 C113 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Purchased', 0, '0'),
(693, 'ISATU000031171', 'Bobot', 'Available', 'Fil-R 0702 A316 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 0, '0'),
(694, 'ISATU000031171', 'Bobot', 'Available', 'Fil-R 0702 A316 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 1, '0'),
(695, 'ISATU000031171', 'Bobot', 'Borrowed', 'Fil-R 0702 A316 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 3, '0'),
(696, 'ISATU000031171', 'Bobot', 'Available', 'Fil-R 0702 A316 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 0, '0'),
(697, 'ISATUMC0013380', 'Practical english usage', 'Available', '428.24 R128 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Donated', 4, '0'),
(698, 'ISATUMC0013380', 'Practical english usage', 'Available', '428.24 R128 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Donated', 4, '0'),
(699, 'ISATUMC0013380', 'Practical english usage', 'Available', '428.24 R128 2023', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Donated', 2, '0'),
(700, 'ISATUMC0013175', 'Essential english grammar', 'Available', '428.24 St435 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, '', 'DTFOS Bookstore', 'Donated', 2, '0'),
(701, 'ISATUMC0013175', 'Essential english grammar', 'Borrowed', '428.24 St435 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Donated', 1, '0'),
(702, 'ISATUMC0013175', 'Essential english grammar', 'Available', '428.24 St435 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Donated', 2, '0'),
(703, 'ISATU000030886', 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', 'Borrowed', 'Fil-R 0802 G661 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Purchased', 0, '0'),
(704, 'ISATU000030886', 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', 'Available', 'Fil-R 0802 G661 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Purchased', 2, '0'),
(705, 'ISATU000031934', 'Iloilo sports division athletes performance monitoring system', 'Available', 'Fil-R 0702 G319 2024	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Purchased', 2, '0'),
(706, 'ISATU000031934', 'Iloilo sports division athletes performance monitoring system', 'Available', 'Fil-R 0702 G319 2024	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Purchased', 2, '0'),
(707, 'ISATU000031931', 'Human resource information system', 'Available', 'Fil-R 0702 M862 2024', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Filipiniana', 'DTFOS Bookstore', 'Donated', 2, '0'),
(708, 'ISATUMC0013485', 'Algorithms ', 'Available', '004 C712 2024	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Reserve-MC	', 'DTFOS Bookstore', 'Purchased', 2, '0'),
(709, 'ISATUIC0000345	', 'Computing essentials', 'Available', '004 O999 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 2, '0'),
(710, 'ISATUIC0000345	', 'Computing essentials', 'Available', '004 O999 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 2, '0'),
(711, 'ISATUIC0000345	', 'Computing essentials', 'Borrowed', '004 O999 2023	', 'General Circulation', '2024-11-04', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 2, '0'),
(712, '12345', 'adan and eve', 'Available', '23r4', 'Reserve', '2024-11-20', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 1, '0'),
(713, 'ISATU000031287', 'test all', 'Available', 'Fil-R 0803 C185 2023', 'Reference', '2024-11-20', 'fried', 'miguel', '', 12, 22, 0, '', '', '', 1, '0'),
(714, 'ISATU000031292', 'test all', 'Available', 'dwdww', 'General Circulation', '2024-11-20', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, '0'),
(715, 'ISATUMC0013380', 'test all', 'Available', 'Fil-R 0803 C113 2023', 'General Circulation', '2024-11-20', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, '    There are no notes for this copy.\r\n    '),
(716, '2345678', 'test all', 'Available', 'Fil-R 0803 C185 2023', 'General Circulation', '2024-11-21', '1', '1', '1', 1, 1, 1, 'Filipiniana', 'add', 'KINAWAT', 1, ''),
(717, 'q', 'test all', 'Available', 'q', 'Reserve', '2024-11-21', '1', '1', '1', 1, 1, 1, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 4, ''),
(718, 'q', 'test all', 'Borrowed', 'q', 'Reserve', '2024-11-21', '1', '1', '1', 1, 1, 1, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 4, ''),
(719, 'test', 'test all', 'Borrowed', 'test', 'General Circulation', '2024-11-21', 'testt', 'test', 't4es', 333, 33, 33, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, 'test'),
(720, 'ISATUMC0013175', 'Iloilo sports division athletes performance monitoring system', 'Available', '428.24 St435 2023', 'General Circulation', '2024-11-24', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, 'hello'),
(721, 'test', 'Computing essentials', 'Borrowed', 'qqq', 'General Circulation', '2024-11-25', 'e', 'e', 'e', 1, 1, 1, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, 'nothing in particular'),
(722, 'test', 'Computing essentials', 'Available', 'qqq', 'General Circulation', '2024-11-25', 'e', 'e', 'e', 1, 1, 1, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, 'nothing in particular'),
(723, 'qq', 'adarna ', 'Available', 'qq', 'Reference', '2024-11-25', 'qq', 'qq', 'qq', 22, 22, 22, 'ssss', 'ss', 'qssq', 2, ''),
(724, 'qq', 'adarna ', 'Available', 'qq', 'Reference', '2024-11-25', 'qq', 'qq', 'qq', 22, 22, 22, 'ssss', 'ss', 'qssq', 3, ''),
(725, '123121', 'adarna ', 'Available', '933813 CS32 2021', 'General Circulation', '2024-11-30', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 4, 'hello'),
(726, '123121', 'adarna ', 'Available', '933813 CS32 2021', 'General Circulation', '2024-11-30', '', '', '', 0, 0, 0, 'Technical Section', 'DTFOS Bookstore', 'Purchased', 5, 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_book`
--

CREATE TABLE `borrow_book` (
  `borrow_id` int(11) NOT NULL,
  `IDno` varchar(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `borrow_date` datetime NOT NULL DEFAULT current_timestamp(),
  `return_date` datetime DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_book`
--

INSERT INTO `borrow_book` (`borrow_id`, `IDno`, `ID`, `borrow_date`, `return_date`, `due_date`) VALUES
(34, 'admin1', 691, '2024-11-15 03:39:21', '2024-11-27 16:22:18', '2024-11-30'),
(35, 'admin1', 693, '2024-11-15 03:39:21', '2024-11-27 16:18:05', NULL),
(36, 'admin1', 692, '2024-11-15 03:39:21', '2024-11-27 16:22:27', NULL),
(37, 'admin1', 695, '2024-11-15 16:13:49', '2024-11-26 01:03:09', '2024-12-06'),
(38, 'admin1', 695, '2024-11-15 16:23:08', '2024-11-26 01:03:09', '2024-12-06'),
(39, '2020-2941-A', 691, '2024-11-15 16:40:34', '2024-11-27 16:22:18', NULL),
(40, '2020-2941-A', 696, '2024-11-15 16:40:34', '2024-11-27 17:35:18', NULL),
(41, '2020-2941-A', 693, '2024-11-15 16:40:34', '2024-11-27 16:18:05', NULL),
(42, '2020-2941-A', 692, '2024-11-15 16:40:34', '2024-11-27 16:22:27', NULL),
(43, 'admin1', 695, '2024-11-15 17:08:31', '2024-11-26 01:03:09', '2024-12-06'),
(44, 'admin1', 694, '2024-11-15 17:08:31', '2024-11-26 01:15:21', NULL),
(45, 'admin1', 693, '2024-11-15 17:08:31', '2024-11-27 16:18:05', NULL),
(46, 'admin1', 692, '2024-11-15 17:08:31', '2024-11-27 16:22:27', NULL),
(47, 'admin1', 691, '2024-11-15 17:08:31', '2024-11-27 16:22:18', NULL),
(48, 'admin1', 695, '2024-11-15 18:07:39', '2024-11-26 01:03:09', '2024-12-06'),
(49, 'admin1', 696, '2024-11-15 18:07:39', '2024-11-27 17:35:18', NULL),
(50, 'admin1', 697, '2024-11-15 18:07:39', '2024-11-19 21:02:28', NULL),
(51, 'admin1', 698, '2024-11-15 18:07:39', '2024-11-19 20:50:03', NULL),
(52, 'admin1', 690, '2024-11-15 18:07:39', '2024-11-15 22:35:15', NULL),
(53, 'admin1', 699, '2024-11-15 18:07:39', '2024-11-26 01:26:26', NULL),
(54, 'admin1', 698, '2024-11-15 18:21:23', '2024-11-19 20:50:03', NULL),
(55, 'admin1', 697, '2024-11-15 18:21:23', '2024-11-19 21:02:28', NULL),
(56, 'admin1', 696, '2024-11-15 18:21:23', '2024-11-27 17:35:18', NULL),
(57, 'admin1', 695, '2024-11-15 18:21:23', '2024-11-26 01:03:09', '2024-12-06'),
(58, 'admin1', 694, '2024-11-15 18:21:23', '2024-11-01 01:15:36', '2024-11-02'),
(59, 'admin1', 693, '2024-11-15 18:21:23', '2024-11-27 16:18:05', NULL),
(60, 'admin1', 692, '2024-11-15 18:21:23', '2024-11-27 16:22:27', NULL),
(61, 'admin1', 691, '2024-11-15 18:21:23', '2024-11-27 16:22:18', NULL),
(62, 'admin1', 695, '2024-11-15 19:13:54', '2024-11-26 01:03:09', '2024-12-06'),
(63, 'admin1', 695, '2024-11-15 19:42:25', '2024-11-26 01:03:09', '2024-12-06'),
(64, 'admin1', 696, '2024-11-15 19:42:25', '2024-11-27 17:35:18', NULL),
(65, 'admin1', 693, '2024-11-15 19:42:25', '2024-11-27 16:18:05', NULL),
(66, 'admin1', 694, '2024-11-15 19:42:25', '2024-11-26 01:15:21', NULL),
(67, 'admin1', 698, '2024-11-15 19:42:25', '2024-11-19 20:50:03', NULL),
(68, 'admin1', 695, '2024-11-15 20:32:01', '2024-11-26 01:03:09', '2024-12-06'),
(69, 'admin1', 696, '2024-11-15 20:32:01', '2024-11-27 17:35:18', NULL),
(70, 'admin1', 693, '2024-11-15 20:32:01', '2024-11-27 16:18:05', NULL),
(71, 'admin1', 703, '2024-11-15 20:32:01', '2024-11-19 21:23:06', NULL),
(72, '2020-9452-A', 699, '2024-11-15 20:50:14', '2024-11-26 01:26:26', NULL),
(73, '2020-9452-A', 690, '2024-11-15 20:50:14', '2024-11-15 22:35:15', NULL),
(74, '2020-9452-A', 691, '2024-11-15 20:50:14', '2024-11-27 16:22:18', NULL),
(75, '2020-9452-A', 692, '2024-11-15 20:50:14', '2024-11-27 16:22:27', NULL),
(76, '2020-9452-A', 693, '2024-11-15 20:50:14', '2024-11-27 16:18:05', NULL),
(77, '2020-9452-A', 694, '2024-11-15 20:50:14', '2024-11-26 01:15:21', NULL),
(78, '2020-9452-A', 695, '2024-11-15 20:50:14', '2024-11-26 01:03:09', '2024-12-06'),
(79, 'admin1', 691, '2024-11-15 21:54:06', '2024-11-27 16:22:18', NULL),
(80, 'admin1', 692, '2024-11-15 21:54:06', '2024-11-27 16:22:27', NULL),
(81, 'admin1', 693, '2024-11-15 21:54:06', '2024-11-27 16:18:05', NULL),
(82, 'admin1', 694, '2024-11-15 21:54:06', '2024-11-26 01:15:21', NULL),
(83, 'admin1', 695, '2024-11-15 21:54:06', '2024-11-26 01:03:09', '2024-12-06'),
(84, 'admin1', 696, '2024-11-15 21:54:06', '2024-11-27 17:35:18', NULL),
(85, 'admin1', 697, '2024-11-15 21:54:06', '2024-11-19 21:02:28', NULL),
(86, 'admin1', 698, '2024-11-15 21:54:06', '2024-11-19 20:50:03', NULL),
(87, 'admin1', 699, '2024-11-15 21:54:06', '2024-11-26 01:26:26', NULL),
(88, 'admin1', 690, '2024-11-15 21:54:06', '2024-11-15 22:35:15', NULL),
(89, 'admin1', 700, '2024-11-15 21:54:06', '2024-12-01 13:50:26', NULL),
(90, '2024-7878-A', 701, '2024-11-15 22:51:32', '2024-11-19 20:25:19', NULL),
(91, '2024-7878-A', 700, '2024-11-15 22:51:32', '2024-12-01 13:50:26', NULL),
(92, '2024-7878-A', 699, '2024-11-15 22:51:32', '2024-11-26 01:26:26', NULL),
(93, '2024-7878-A', 698, '2024-11-15 22:51:32', '2024-11-19 20:50:03', NULL),
(94, '2024-7878-A', 697, '2024-11-15 22:51:32', '2024-11-19 21:02:28', NULL),
(95, '2024-7878-A', 696, '2024-11-15 22:51:32', '2024-11-27 17:35:18', NULL),
(96, '2024-7878-A', 695, '2024-11-15 22:51:32', '2024-11-26 01:03:09', '2024-12-06'),
(97, '2024-7878-A', 694, '2024-11-15 22:51:32', '2024-11-26 01:15:21', NULL),
(98, '2024-7878-A', 693, '2024-11-15 22:51:32', '2024-11-27 16:18:05', NULL),
(99, '2024-7878-A', 692, '2024-11-15 22:51:32', '2024-11-27 16:22:27', NULL),
(100, '2024-7878-A', 691, '2024-11-15 22:51:32', '2024-11-27 16:22:18', NULL),
(101, '2021-4653-A', 691, '2024-11-15 23:36:51', '2024-11-27 16:22:18', NULL),
(102, '2021-4653-A', 692, '2024-11-15 23:36:51', '2024-11-27 16:22:27', NULL),
(103, '2021-4653-A', 693, '2024-11-15 23:36:51', '2024-11-27 16:18:05', NULL),
(104, '2021-4653-A', 694, '2024-11-15 23:36:51', '2024-11-26 01:15:21', NULL),
(105, '2021-4653-A', 695, '2024-11-15 23:36:51', '2024-11-26 01:03:09', '2024-12-06'),
(106, '2021-4653-A', 696, '2024-11-15 23:36:51', '2024-11-27 17:35:18', NULL),
(107, '2021-4653-A', 697, '2024-11-15 23:36:51', '2024-11-19 21:02:28', NULL),
(108, '2021-4653-A', 698, '2024-11-15 23:36:51', '2024-11-19 20:50:03', NULL),
(109, '2021-3645-A', 691, '2024-11-16 19:11:59', '2024-11-27 16:22:18', NULL),
(110, 'admin1', 692, '2024-11-17 01:59:33', '2024-11-27 16:22:27', NULL),
(111, '2021-4375-A', 695, '2024-11-18 09:15:43', '2024-11-26 01:03:09', '2024-12-06'),
(112, '2021-4375-A', 691, '2024-11-18 09:15:43', '2024-11-27 16:22:18', NULL),
(113, '2021-4375-A', 692, '2024-11-18 09:15:43', '2024-11-27 16:22:27', NULL),
(114, '2021-4375-A', 693, '2024-11-18 09:15:43', '2024-11-27 16:18:05', NULL),
(115, '2021-4375-A', 694, '2024-11-18 09:15:43', '2024-11-26 01:15:21', NULL),
(116, '2021-4375-A', 696, '2024-11-18 09:15:43', '2024-11-27 17:35:18', NULL),
(117, '2021-4375-A', 697, '2024-11-18 09:15:43', '2024-11-19 21:02:28', NULL),
(118, 'admin1', 698, '2024-11-18 09:22:03', '2024-11-19 20:50:03', NULL),
(119, '2021-1235-A', 701, '2024-11-18 09:22:27', '2024-11-19 20:25:19', NULL),
(120, '2021-1235-A', 702, '2024-11-18 09:22:27', '2024-11-18 09:50:20', NULL),
(121, 'admin1', 695, '2024-11-18 22:18:10', '2024-11-26 01:03:09', '2024-12-06'),
(122, '2020-0876-A', 696, '2024-11-18 22:18:25', '2024-11-27 17:35:18', NULL),
(123, '2020-5643-A', 693, '2024-11-18 22:18:37', '2024-11-27 16:18:05', NULL),
(124, '2020-5643-A', 701, '2024-11-18 22:18:37', '2024-11-19 20:25:19', NULL),
(125, '2022', 691, '2024-11-18 22:19:00', '2024-11-27 16:22:18', NULL),
(126, '2022', 692, '2024-11-18 22:19:00', '2024-11-27 16:22:27', NULL),
(127, '2021-3645-A', 694, '2024-11-18 23:00:22', '2024-11-26 01:15:21', NULL),
(128, '2021-3645-A', 697, '2024-11-18 23:00:22', '2024-11-19 21:02:28', NULL),
(129, '2021-3645-A', 698, '2024-11-18 23:00:22', '2024-11-19 20:50:03', NULL),
(130, '2021-3645-A', 699, '2024-11-18 23:00:22', '2024-11-26 01:26:26', NULL),
(131, '2021-3645-A', 700, '2024-11-18 23:00:22', '2024-12-01 13:50:26', NULL),
(132, 'admin1', 692, '2024-11-19 20:28:57', '2024-11-27 16:22:27', NULL),
(133, '2024-7878-A', 695, '2024-11-19 21:21:52', '2024-11-26 01:03:09', '2024-12-06'),
(134, '2024-7878-A', 703, '2024-11-19 21:21:52', '2024-11-19 21:23:06', NULL),
(135, '2024-7878-A', 696, '2024-11-19 21:21:52', '2024-11-27 17:35:18', '2024-11-30'),
(136, 'admin1', 695, '2024-11-24 13:13:41', '2024-11-26 01:03:09', '2024-12-06'),
(137, 'admin1', 691, '2024-11-24 13:13:41', '2024-11-27 16:22:18', '2024-11-03'),
(138, '2020-9452-A', 692, '2024-11-24 13:13:57', '2024-11-27 16:22:27', '2024-11-01'),
(139, '2020-9452-A', 693, '2024-11-24 13:13:57', '2024-11-27 16:18:05', '2024-11-15'),
(140, '2020-2941-A', 694, '2024-11-24 13:14:25', '2024-11-26 01:15:21', '2024-11-14'),
(141, '2020-5643-A', 696, '2024-11-26 00:27:44', '2024-11-27 17:35:18', '2025-02-25'),
(142, '2020-2941-A', 699, '2024-11-26 00:28:24', '2024-11-26 01:26:26', '2024-11-28'),
(143, '2020-5643-A', 699, '2024-11-26 01:16:24', '2024-11-26 01:26:26', '2025-02-25'),
(144, '2022', 696, '2024-11-26 01:24:26', '2024-11-27 17:35:18', '2025-02-25'),
(145, '2020-5643-A', 691, '2024-11-26 01:24:49', '2024-11-27 16:22:18', '2025-02-25'),
(146, 'admin1', 692, '2024-11-26 01:25:20', '2024-11-27 16:22:27', '2025-02-25'),
(147, '2020-5643-A', 693, '2024-11-26 01:25:55', '2024-11-27 16:18:05', '2025-02-25'),
(148, '2020-2941-A', 696, '2024-11-27 02:49:40', '2024-11-27 17:35:18', '2024-11-29'),
(149, '2020-2941-A', 691, '2024-11-27 02:49:40', '2024-11-27 16:22:18', '2024-11-29'),
(150, '2020-5643-A', 692, '2024-11-27 02:49:57', '2024-11-27 16:22:27', '2025-02-26'),
(151, '2020-5643-A', 693, '2024-11-27 02:49:57', '2024-11-27 16:18:05', '2025-02-26'),
(152, 'admin1', 695, '2024-11-27 02:50:11', NULL, '2024-12-06'),
(153, '2021-0909-A', 718, '2024-11-27 19:51:25', NULL, '2024-11-28'),
(154, '2021-4653-A', 719, '2024-11-27 19:53:20', NULL, '2024-12-02'),
(155, '2021-1235-A', 721, '2024-11-27 19:55:34', NULL, '2024-11-28'),
(156, '2021-1235-A', 701, '2024-11-27 19:55:34', NULL, '2024-12-02'),
(157, 'admin1', 681, '2024-11-27 20:07:52', NULL, '2015-12-31'),
(158, 'librarian1', 691, '2024-12-01 13:01:14', NULL, '2024-12-01'),
(159, 'student1', 682, '2024-12-01 13:34:21', NULL, '2024-12-04'),
(160, 'student1', 703, '2024-12-01 13:34:21', NULL, '2024-12-04'),
(161, 'student1', 700, '2024-12-01 13:34:21', '2024-12-01 13:50:26', '2024-12-04'),
(162, 'student1', 711, '2024-12-01 13:38:48', NULL, '2024-12-04'),
(163, 'librarian1', 710, '2024-12-01 13:39:36', '2024-12-01 13:48:18', '2024-12-01');

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
(42, 'adarna ', 'meey', '2024-01-01', 'wala'),
(43, 'adarna ', 'siban', '2024-01-01', 'taga luto pancit'),
(44, 'adarna ', 'meeyer', '2024-01-01', 'tambay'),
(46, 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Ivy Joy A. Cañamo', '2024-11-04', 'N/A'),
(47, 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Lyka Antoinette P. Tomulto', '2024-11-04', 'N/A'),
(48, 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', 'Jenissa C. Cañonaso', '2024-11-04', 'N/A'),
(49, 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', 'Nicole Anne Rhea G. Cañonaso', '2024-11-04', 'N/A'),
(50, 'Bobot', 'Anthony Kerr G. Dulla Jr.', '0000-00-00', ''),
(51, 'Bobot', 'Lance Gabriel V. Poblacion', '2024-11-04', 'N/A'),
(52, 'Bobot', 'Daniel A. Reysoma', '2024-11-04', 'N/A'),
(53, 'Bobot', 'Merique Q. Villaflor.', '2024-11-04', 'N/A'),
(54, 'Practical english usage', 'N/A', '2024-11-04', 'N/A'),
(55, 'Essential english grammar', 'N/A', '2024-11-04', 'N/A'),
(56, 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', 'Aiyah Ace D. Montelijao', '2024-11-04', 'N/A'),
(57, 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', 'Lyndsey Terry L. Villasis', '2024-11-04', 'N/A'),
(58, 'Iloilo sports division athletes performance monitoring system', 'Leriz Wane L. Illaga', '2024-11-04', 'N/A'),
(59, 'Iloilo sports division athletes performance monitoring system', 'Justin G. Magallanes', '2024-11-04', 'N/A'),
(60, 'Iloilo sports division athletes performance monitoring system', 'Queen Anne Poliapoy', '2024-11-04', 'N/A'),
(61, 'Iloilo sports division athletes performance monitoring system', 'Adrian C. Tesara', '2024-11-04', 'N/A'),
(62, 'Human resource information system', 'Bea Longino', '2024-11-04', 'N/A'),
(63, 'Human resource information system', 'April Joy Elevado', '2024-11-04', 'N/A'),
(64, 'Human resource information system', 'Eunice Jane Mueda', '2024-11-04', 'N/A'),
(65, 'Human resource information system', 'Mauriz Jade Discar', '2024-11-04', 'N/A'),
(66, 'Algorithms ', 'N/A', '2024-11-04', 'N/A'),
(67, 'Computing essentials', 'Daniel A. O\'Leary', '2024-11-04', 'N/A'),
(68, 'Computing essentials', 'Linda I. O\'Leary', '2024-11-04', 'N/A'),
(120, 'test all', 'test all', '2024-11-19', 'test all'),
(121, 'test all', 'test all', '2024-11-19', 'test all'),
(122, 'test all', 'test all', '2024-11-19', 'test all'),
(123, 'resouce test', '', '0000-00-00', ''),
(124, 'resouce testa', '', '0000-00-00', '');

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
('2020-0876-A', 'vonjohnsuropia116@gmail.com', '', '09786543219', ''),
('2020-2941-A', 'Madelyn12@gmail.com', '', '09098555642', ''),
('2020-2981-A', 'Hans@gmail.com', '', '09456789101', ''),
('2020-5643-A', 'kheena@gmail.com', '', '09786567219', ''),
('2020-7656-A', 'Jane@gmail.com', '', '09046789101', ''),
('2020-9452-A', 'Yano@gmail.com', '', '09956789101', ''),
('2021-0909-A', 'Kenley24@gmail.com', '', '09709543216', ''),
('2021-0994-A', 'William3@gmail.com', '', '09786543219', ''),
('2021-1234-A', 'allah1@gmail.com', '', '09956789101', ''),
('2021-1235-A', 'Brooke09@gmail.com', '', '09709543216', ''),
('2021-3645-A', 'Noah1234@gmail.com', '', '09456789101', ''),
('2021-3737-A', 'Elizabeth38@gmail.com', '', '09786543219', ''),
('2021-4375-A', 'JaneGirl@gmail.com', '', '09956789101', ''),
('2021-4653-A', 'Philip14@gmail.com', '', '09709543216', ''),
('2021-4785-A', 'Edgar146@gmail.com', '', '09709543216', ''),
('2021-5630-A', 'Anna74@gmail.com', '', '09456789101', ''),
('2021-7432-A', 'Jeremy74@gmail.com', '', '09786543219', ''),
('2021-7654-A', 'Benjamin1@gmail.com', '', '09709543216', ''),
('2021-8724-A', 'Taylor72@gmail.com', '', '09456789101', ''),
('2021-8733-A', 'Calvin4@gmail.com', '', '09786543219', ''),
('2021-8764-A', 'gina@gmail.com', '', '09709543216', ''),
('2021-8764-D', 'Claire65@gmail.com', '', '09098555642', ''),
('2022', 'vonjohn.suropia@students.isatu.edu.ph', '', '09709543216', ''),
('2022-6332-A', 'Layla4@gmail.com', '', '09098735642', ''),
('2022-6742-A', 'mikajane@gmail.com', '', '09098735642', ''),
('2022-9078-A', 'Damn@gmail.com', '', '09786673219', ''),
('2023', '\njohnwindricksucias@gmail.com ', '', '09098735642', ''),
('2023-4678-A', 'Grad@gmail.com', '', '09098555642', ''),
('2023-5478-A', 'UMami@gmail.com', '', '09128555642', ''),
('2024-2981-V', 'Destiny74@gmail.com', '', '09098735642', ''),
('2024-4536-A', 'Trans@gmail.com', '', '09736543219', ''),
('2024-7878-A', 'Cramps@gmail.com', '', '09788735642', ''),
('admin1', 'vonjohnsuropia116@gmail.com', 'admin@gmail.comss', '0900000000011', '0900000000011'),
('librarian1', 'vonjohnsuropia116@gmail.com', '', '09000000000', ''),
('student1', 'vonjohnsuropia116@gmail.com', '', '09000000000', '');

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
(44, 'adarna ', 'https://youtube.com', 'youtube'),
(46, 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', '', ''),
(47, 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', '', ''),
(48, 'Bobot', '', ''),
(49, 'Practical english usage', '', ''),
(50, 'Essential english grammar', '', ''),
(51, 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', '', ''),
(52, 'Iloilo sports division athletes performance monitoring system', '', ''),
(53, 'Human resource information system', '', ''),
(54, 'Algorithms ', '', ''),
(55, 'Computing essentials', '', ''),
(57, 'adan and eve', '', ''),
(96, 'test all', 'https://youtube.com', 'youtube'),
(97, 'resouce test', '', ''),
(98, 'resouce testa', 'https://tailwindcss.com/docs/list-style-type', 'youtube');

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
(51, 'adarna ', '', 10, 'dono', 'boo', '11', ''),
(53, 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', '', 0, '', '', '', ''),
(54, 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', '', 0, '', '', '', ''),
(55, 'Bobot', '', 0, '', '', '', ''),
(56, 'Practical english usage', '', 0, '', '', '', ''),
(57, 'Essential english grammar', '', 0, '', '', '', ''),
(58, 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', '', 0, '', '', '', ''),
(59, 'Iloilo sports division athletes performance monitoring system', '', 0, '', '', '', ''),
(60, 'Human resource information system', '', 0, '', '', '', ''),
(61, 'Algorithms ', '', 0, '', '', '', ''),
(62, 'Computing essentials', '', 0, '', '', '', ''),
(64, 'adan and eve', '', 0, '', '', '', ''),
(107, 'test all', '', 0, 'K-3 1', 'GN 1', 'Benchmark Assessment System 1', ''),
(108, 'resouce test', '', 0, '', '', '', ''),
(109, 'resouce testa', '', 0, '', '', '', '');

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
(44, 'adarna ', 'Tropical Heading', 'head', 'general', 'b1', 'Geographic', 'b2', 'Form', 'b3'),
(46, 'Pagsusuri ng gay lingo sa mga piling pelikulang Pilipino', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(47, 'Impluwensiya ng youtube sa pag-aaral ng panitikan ng mga BSED Filipino ng ISAT U', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(48, 'Bobot', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(49, 'Practical english usage', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(50, 'Essential english grammar', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(51, 'English reading proficiency in comprehension of grade VI pupils in Jalandoni Memorial Elementary School ', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(52, 'Iloilo sports division athletes performance monitoring system', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(53, 'Human resource information system', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(54, 'Algorithms ', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(55, 'Computing essentials', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(57, 'adan and eve', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(95, 'test all', 'Personal Heading', 'test all 1', 'Geographic', 'test all 1', 'Geographic', 'test all 1', 'Geographic', 'test all 1'),
(96, 'test all', 'Personal Heading', 'test all 1', 'Geographic', 'test all 1', 'Geographic', 'test all 1', 'Geographic', 'test all 1'),
(97, 'test all', 'Personal Heading', 'test all 1', 'Geographic', 'test all 1', 'Geographic', 'test all 1', 'Geographic', 'test all 1'),
(98, 'resouce test', 'Tropical Heading', '', 'General', '', 'General', '', 'General', ''),
(99, 'resouce testa', 'Tropical Heading', '', 'General', '', 'General', '', 'General', '');

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
('admin1', 'adminss', 'adss', 'minss', 'N/Ass', 'Male', '67436a95e57b9_Bamboo001A.png'),
('librarian1', 'libr', 'librarian', 'arian', 'N/A', 'Male', '674bee2a4a95f_gintoki-appology.jpg'),
('student1', 'stu', 'student', 'dent', 'N/A', 'Male', '674bf52e6d826_fghjkl.png');

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
  `status` enum('active','inactive','restricted') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`IDno`, `college`, `course`, `yrLVL`, `A_LVL`, `status`) VALUES
('2020-0876-A', 'cas', 'BS in English', '3 D', '3', 'active'),
('2020-2941-A', 'coe', 'BEEd ', '4 A', '3', 'active'),
('2020-2981-A', 'cea', 'BS in Civil Eng', '3 C', '3', 'active'),
('2020-5643-A', 'cea', 'BS in Architecture', '2 A', '3', 'active'),
('2020-7656-A', 'cit', 'BS in Auto Tech (BSAT) - Level III', '2 B', '3', 'active'),
('2020-9452-A', 'coe', 'BEEd ', '5 C', '3', 'active'),
('2021-0909-A', 'cit', 'BS in Elec Eng (BSELX) - Level III', '3 D', '3', 'active'),
('2021-0994-A', 'cit', 'BS in Hotel & Rest Tech (BSHRT) - Level II', '4 B', '3', 'active'),
('2021-1234-A', 'cas', 'BS in Comm Dev', '3 C', '3', 'active'),
('2021-1235-A', 'cas', 'BS in Info Systems', '3 A', '3', 'active'),
('2021-3645-A', 'cea', 'BS in Architecture', '4 A', '3', 'active'),
('2021-3737-A', 'cas', 'BS in Info Tech', '4 B', '3', 'active'),
('2021-4375-A', 'cea', 'BS in Elec Eng (ECE)', '4 D', '3', 'active'),
('2021-4653-A', 'coe', 'BS in Ind Ed', '4 C', '3', 'active'),
('2021-4785-A', 'cea', 'BS in Elec Eng', '4 B', '3', 'active'),
('2021-5630-A', 'coe', 'BTVTEd', '4 D', '3', 'active'),
('2021-7432-A', 'cea', 'BS in Mech Eng', '4 A', '3', 'active'),
('2021-7654-A', 'cea', 'BS in Civil Eng', '4 D', '3', 'active'),
('2021-8724-A', 'coe', 'BSEd ', '4 B', '3', 'active'),
('2021-8733-A', 'cit', 'BS in Elec Tech (BSELT) - Level III', '4 D', '3', 'active'),
('2021-8764-A', 'cas', 'BS in Info Tech', '1 C', '3', 'active'),
('2021-8764-D', 'cas', 'BS in Comp Sci', '3 C', '3', 'active'),
('2022', 'coe', 'BSEd ', '3 B', '3', 'active'),
('2022-6332-A', 'cit', 'BS in Auto Tech (BSAT) - Level III', '3 A', '3', 'active'),
('2022-6742-A', 'cas', 'BS in Comp Sci', '4 B', '3', 'active'),
('2022-9078-A', 'cit', 'BS in Elec Tech (BSELT) - Level III', '3 A', '3', 'active'),
('2023', 'cit', 'BS in Ind Tech (BIT) - Level III', '2 A', '3', 'active'),
('2023-4678-A', 'cea', 'BS in Elec Eng', '3 A', '3', 'active'),
('2023-5478-A', 'coe', 'BTVTEd', '2 C', '3', 'active'),
('2024-2981-V', 'cas', 'BS in English', '1 C', '3', 'active'),
('2024-4536-A', 'coe', 'BSEd ', '1 D', '3', 'active'),
('2024-7878-A', 'cit', 'BS in Hotel & Rest Tech (BSHRT) - Level II', '1 B', '3', 'active'),
('admin1', 'casss', 'course1ss', '1 Ass', NULL, 'active'),
('librarian1', 'cas', 'BS in English', '5 A', '3', 'active'),
('student1', 'cas', 'BS in English', '5 C', '3', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `IDno` varchar(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `U_type` enum('admin','student','professor','staff','librarian') DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`IDno`, `username`, `password`, `U_type`, `status`) VALUES
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
('2021-5630-A', 'Anna1265', 'Anna1265', 'student', 'pending'),
('2021-7432-A', 'Jeremy744', 'Jeremy744', 'student', 'pending'),
('2021-7654-A', 'Benjamin12', 'Benjamin12', 'student', 'pending'),
('2021-8724-A', 'Taylor733', 'Taylor733', 'student', 'pending'),
('2021-8733-A', 'Calvin335', 'Calvin335', 'student', 'pending'),
('2021-8764-A', 'Mika23', 'Mika23', 'student', 'rejected'),
('2021-8764-D', 'Claire545', 'Claire545', 'student', 'pending'),
('2022', 'Scarlet344', 'Scarlet344', 'admin', 'approved'),
('2022-6332-A', 'Layla1486', 'Layla1486', 'student', 'approved'),
('2022-6742-A', 'Mikajane@gmail', 'Mikajane@gmail', 'student', 'approved'),
('2022-9078-A', 'Damn7', 'Damn7', 'admin', 'approved'),
('2023', 'Makayla33', 'Makayla33', 'student', 'approved'),
('2023-4678-A', 'Grad41', 'Grad41', 'student', 'approved'),
('2023-5478-A', 'Umai11', 'Umai11', 'admin', 'approved'),
('2024-2981-V', 'Destiny00', 'Destiny00', 'student', 'pending'),
('2024-4536-A', 'Trans7', 'Trans7', 'admin', 'rejected'),
('2024-7878-A', 'Crams56', 'Crams56', 'admin', 'approved'),
('admin1', 'admin1', 'admin1', 'admin', 'approved'),
('librarian1', 'librarian1', 'librarian1', 'librarian', 'approved'),
('student1', 'student1', 'student1', 'student', 'approved');

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
-- Indexes for table `borrow_book`
--
ALTER TABLE `borrow_book`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `borrow_book_ibfk_1` (`IDno`),
  ADD KEY `borrow_book_ibfk_2` (`ID`);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`);

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
-- AUTO_INCREMENT for table `alternatetitle`
--
ALTER TABLE `alternatetitle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `book_copies`
--
ALTER TABLE `book_copies`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=727;

--
-- AUTO_INCREMENT for table `borrow_book`
--
ALTER TABLE `borrow_book`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `coauthor`
--
ALTER TABLE `coauthor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

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
  ADD CONSTRAINT `fk_book_title` FOREIGN KEY (`B_title`) REFERENCES `book` (`B_title`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `borrow_book`
--
ALTER TABLE `borrow_book`
  ADD CONSTRAINT `borrow_book_ibfk_1` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON UPDATE CASCADE,
  ADD CONSTRAINT `borrow_book_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `book_copies` (`ID`) ON UPDATE CASCADE;

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
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE;

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
