-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 11:00 PM
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
(41, 'STUDENT1', '04:20:28', NULL, '2024-12-08', 0),
(42, '2020-0876-A', '12:07:15', '12:07:47', '2024-12-12', 1);

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
(224, 'test 11211', 'test 11211s', 'test 11211s', 'test 11211s', 'test 11211s', 'test 11211test 11211s', 'test 11211s', 'Serial', 'Dictionarys', 'test 11211s', 'test 11211s', '2024-12-16', 'test 11211s', 'test 11211s', 'test 11211s', 'test 11211s', '0e', 'test 11211s', 'test 11211s', 'test 11211s', 'test 11211s', 11211, 'test 11211ee', NULL),
(231, 'hayow', 'hayow', 'hayow', 'hayow', 'hayow', 'hayowhayow', 'hayow', 'Musical Sound Recording', 'Dictionary', 'hayow', 'hayow', '2024-12-16', 'hayow', '1231', 'hayow', '2e', '0', 'hayow', 'hayow', 'hayow', 'hayow', 11, 'hayow', NULL),
(316, '1test', '1test1', '1test1', '1test1', '1test1', '1test1', '1test1', 'Video1', 'Other1', '1test1', '1test3r1', '2024-12-01', '1test3r31', '1test1', '1teste1', '1test1', 'https://aniwatchtv.to/watch/is-it-wrong-to-try-to-pick-up-girls-in-a-dungeon-v-19323?ep=130589', '1test51', '1testu1', '1testv1', '1tests1', 1212, '1test,1test,1test', '676528dc047d0_6233470613360592179.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `book_copies`
--

CREATE TABLE `book_copies` (
  `ID` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
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
(250, 224, 'test 11211', '0000-00-00', 'test 11211'),
(263, 231, 'hayow', '2024-12-16', 'hayow'),
(264, 231, 'hayow', '2024-12-16', 'hayow'),
(277, 316, '1test1121113', '2024-12-03', '1test112113'),
(278, 316, '1test2121113', '2024-12-03', '1test212113'),
(279, 316, '1test3121113', '2024-12-03', '1test311113');

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
(42, 'student1', 'librarian1', 'good', '2024-12-01 06:59:41', 1),
(43, 'admin1', '2020-2941-A', 'Toe', '2024-12-12 04:01:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `Sub_Head` varchar(255) DEFAULT NULL,
  `Sub_Head_input` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `book_id`, `Sub_Head`, `Sub_Head_input`) VALUES
(682, 316, 'Local Heading11213', '1test11213'),
(683, 316, 'Local Heading21213', '1test21213'),
(684, 316, 'Local Heading31213', '1test31213'),
(685, 316, 'Local Heading41113', '1test41113');

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
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `municipality` varchar(100) DEFAULT NULL,
  `barangay` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `college` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `yrLVL` varchar(50) DEFAULT NULL,
  `A_LVL` varchar(11) DEFAULT NULL,
  `personnel_type` enum('Teaching Personnel','Non-Teaching Personnel') DEFAULT NULL,
  `status_details` enum('active','inactive','restricted') DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `U_Type` enum('admin','student','professor','staff','librarian','faculty') DEFAULT NULL,
  `status_log` enum('pending','approved','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`IDno`, `Fname`, `Sname`, `Mname`, `Ename`, `gender`, `photo`, `email`, `contact`, `municipality`, `barangay`, `province`, `DOB`, `college`, `course`, `yrLVL`, `A_LVL`, `personnel_type`, `status_details`, `username`, `password`, `U_Type`, `status_log`) VALUES
('', '', '', '', 'N/A', '', 'default.jpg', '', '', '', '', '', '0000-00-00', '', '', '', '3', '', 'active', '', '', 'librarian', 'rejected'),
('1test1', '1test', '1test', '1test', 'N/A', '', 'default.jpg', 'vonjohnsuropia116@gmail.com', '42534656733', '1testm', '1testb', '1testp', '2024-12-28', 'cas', 'BS in Math', '5 C', '3', '', 'active', '1test!AA', '1test!AA', 'student', 'pending'),
('1test112', '1test', '1test', '1test', 'N/A', '', 'default.jpg', 'vonjohnsuropia116@gmail.com', '42534656733', '1testm', '1testb', '1testp', '2024-12-28', 'cea', '', '5 C', '3', 'Non-Teaching Personnel', 'active', '1test!AA', '1test!AA', 'faculty', 'pending'),
('1test1121', '1test', '1test', '1test', 'N/A', '', 'default.jpg', 'vonjohnsuropia116@gmail.com', '42534656733', '1testm', '1testb', '1testp', '2024-12-28', 'cea', '', '5 C', '3', 'Teaching Personnel', 'active', '1test!AA', '1test!AA', 'faculty', 'pending'),
('2020-0876-A', 'Jhos', 'Sim', 'Grad', 'N/A', 'Male', '6741c0a7dcda0_460944686_1177150106917642_4960290106544083410_n.png', 'vonjohnsuropia116@gmail.com', '09786543219', 'Santa Barbara', 'Bolong Este', 'Iloilo', '2000-02-01', 'cas', 'BS in English', '3 D', '3', NULL, 'active', 'jhos123', 'jhos123', 'admin', 'approved'),
('2020-2941-A', 'Madelyn', 'Grover', 'V', 'N/A', 'f', 'default.jpg', 'Madelyn12@gmail.com', '09098555642', 'Lapaz', 'Burgos st.', 'Iloilo', '2003-06-06', 'coe', 'BEEd ', '4 A', '3', NULL, 'active', 'Madelyn64', 'Madelyn64', 'admin', 'approved'),
('2020-2981-A', 'Hans', 'Gard', 'Arms', 'N/A', 'm', 'default.jpg', 'Hans@gmail.com', '09456789101', 'Santa Barbara', 'Zone1', 'Iloilo', '2003-12-14', 'cea', 'BS in Civil Eng', '3 C', '3', NULL, 'active', 'Hans78', 'Hans78', 'professor', 'rejected'),
('2020-5643-A', 'Kheena', 'Molt', 'Ako', 'N/A', 'Male', '6740735f6c067_54489f2f-f2f4-4bea-9455-149dbe7ff948.jfif', 'kheena@gmail.com', '09786567219', 'San Miguel', 'Consolation', 'Iloilo', '2000-03-04', 'cea', 'BS in Architecture', '2 A', '3', NULL, 'active', 'kheena32', 'kheena32', 'admin', 'approved'),
('2020-7656-A', 'Jane', 'Fanthear', 'Ban', 'N/A', 'Male', '6741c102ea0f0_61RPubboeNL._AC_UF894,1000_QL80_.jpg', 'Jane@gmail.com', '09046789101', 'Ivisan Capiz', 'Agcabugao,Cuartero', 'Iloilo', '2001-07-11', 'cit', 'BS in Auto Tech (BSAT) - Level III', '2 B', '3', NULL, 'active', 'Jane34', 'Jane34', 'student', 'rejected'),
('2020-9452-A', 'Yano', 'Tachibana', 'Yamamoshi', 'N/A', 'f', 'default.jpg', 'Yano@gmail.com', '09956789101', 'Pavia', 'Cabugao Sur', 'Iloilo', '2008-02-28', 'coe', 'BEEd ', '5 C', '3', NULL, 'active', 'Yano56', 'Yano56', 'student', 'approved'),
('2021-0909-A', 'Kenley', 'Tachibana', 'L', 'N/A', 'm', 'default.jpg', 'Kenley24@gmail.com', '09709543216', 'Jaro', 'San Jose', 'Iloilo', '2001-11-11', 'cit', 'BS in Elec Eng (BSELX) - Level III', '3 D', '3', NULL, 'active', 'Kenley753', 'Kenley753', 'student', 'approved'),
('2021-0994-A', 'William', 'Dickhead', 'T', 'N/A', 'm', 'default.jpg', 'William3@gmail.com', '09786543219', 'Pavia', 'Zone1', 'Iloilo', '2001-08-09', 'cit', 'BS in Hotel & Rest Tech (BSHRT) - Level II', '4 B', '3', NULL, 'active', 'William12', 'William12', 'student', 'rejected'),
('2021-1234-A', 'Allah', 'Muhhamad', 'D', 'N/A', 'm', 'default.jpg', 'allah1@gmail.com', '09956789101', 'Santa Barbara', 'Burgos st.', 'Iloilo', '2001-06-12', 'cas', 'BS in Comm Dev', '3 C', '3', NULL, 'active', 'allah123', 'allah123', 'student', 'rejected'),
('2021-1235-A', 'Brooke', 'Arbobro', 'L', 'N/A', 'm', 'default.jpg', 'Brooke09@gmail.com', '09709543216', 'Lapaz', 'San Jose', 'Iloilo', '2014-08-14', 'cas', 'BS in Info Systems', '3 A', '3', NULL, 'active', 'Brooke098', 'Brooke098', 'student', 'approved'),
('2021-3645-A', 'Noah', 'Muller', 'V', 'N/A', 'm', 'default.jpg', 'Noah1234@gmail.com', '09456789101', 'Cabatuan', 'Danao', 'Iloilo', '2002-08-02', 'cea', 'BS in Architecture', '4 A', '3', NULL, 'active', 'Noah09133', 'Noah09133', 'student', 'approved'),
('2021-3737-A', 'Elizabeth', 'Claus', 'K', 'N/A', 'f', 'default.jpg', 'Elizabeth38@gmail.com', '09786543219', 'Mohon', 'Zone1', 'Iloilo', '2001-11-07', 'cas', 'BS in Info Tech', '4 B', '3', NULL, 'active', 'Elizabeth87', 'Elizabeth87', 'student', 'rejected'),
('2021-4375-A', 'Jane Girl', 'Rock', 'G', 'N/A', 'f', 'default.jpg', 'JaneGirl@gmail.com', '09956789101', 'Cabatuan', 'Cabugao Sur', 'Iloilo', '2001-08-25', 'cea', 'BS in Elec Eng (ECE)', '4 D', '3', NULL, 'active', 'JaneGirl7', 'JaneGirl7', 'student', 'approved'),
('2021-4653-A', 'Philip', 'Grey', 'F', 'N/A', 'm', 'default.jpg', 'Philip14@gmail.com', '09709543216', 'Cabatuan', 'Bolong Este', 'Iloilo', '2003-08-06', 'coe', 'BS in Ind Ed', '4 C', '3', NULL, 'active', 'Philip88', 'Philip88', 'student', 'approved'),
('2021-4785-A', 'Edgar', 'Gomez', 'B', 'N/A', 'm', 'default.jpg', 'Edgar146@gmail.com', '09709543216', 'Pavia', 'Sambag', 'Iloilo', '2002-04-21', 'cea', 'BS in Elec Eng', '4 B', '3', NULL, 'active', 'Edgar109', 'Edgar109', 'student', 'rejected'),
('2021-5630-A', 'Anna', 'Thomas', 'X', 'N/A', 'Male', '6741c188ca425_fea969c4-7d33-4371-8885-61f5e2577c73.jpg', 'Anna74@gmail.com', '09456789101', 'Jaro', 'Zone1', 'Iloilo', '2001-05-29', 'coe', 'BTVTEd', '4 D', '3', NULL, 'active', 'Anna1265', 'Anna1265', 'student', 'rejected'),
('2021-7432-A', 'Jeremy', 'Grime', 'M', 'N/A', 'm', 'default.jpg', 'Jeremy74@gmail.com', '09786543219', 'Lapaz', 'Burgos st.', 'Iloilo', '2002-07-05', 'cea', 'BS in Mech Eng', '4 A', '3', NULL, 'active', 'Jeremy744', 'Jeremy744', 'student', 'pending'),
('2021-7654-A', 'Benjamin', 'Brown', 'S', 'N/A', 'm', 'default.jpg', 'Benjamin1@gmail.com', '09709543216', 'Jaro', 'San Jose', 'Iloilo', '2001-11-30', 'cea', 'BS in Civil Eng', '4 D', '3', NULL, 'active', 'Benjamin12', 'Benjamin12', 'student', 'approved'),
('2021-8724-A', 'Taylor', 'Black', 'N', 'N/A', 'f', 'default.jpg', 'Taylor72@gmail.com', '09456789101', 'Santa Barbara', 'Bolong Este', 'Iloilo', '2001-05-07', 'coe', 'BSEd ', '4 B', '3', NULL, 'active', 'Taylor733', 'Taylor733', 'student', 'approved'),
('2021-8733-A', 'Calvin', 'Palaaway', 'C', 'N/A', 'm', 'default.jpg', 'Calvin4@gmail.com', '09786543219', 'Lapaz', 'Burgos st.', 'Iloilo', '2002-03-31', 'cit', 'BS in Elec Tech (BSELT) - Level III', '4 D', '3', NULL, 'active', 'Calvin335', 'Calvin335', 'student', 'approved'),
('2021-8764-A', 'Gina', 'Dickens', 'Cren', 'N/A', 'f', 'default.jpg', 'gina@gmail.com', '09709543216', 'Jaro', 'Sambag', 'Iloilo', '2002-12-01', 'cas', 'BS in Info Tech', '1 C', '3', NULL, 'active', 'Mika23', 'Mika23', 'student', 'approved'),
('2021-8764-D', 'Claire', 'Stewart', 'H', 'N/A', 'f', 'default.jpg', 'Claire65@gmail.com', '09098555642', 'Pavia', 'Cabugao Sur', 'Iloilo', '2003-09-24', 'cas', 'BS in Comp Sci', '3 C', '3', NULL, 'active', 'Claire545', 'Claire545', 'student', 'approved'),
('2022', 'Scarlet', 'White', 'V', 'N/A', 'f', 'default.jpg', 'vonjohn.suropia@students.isatu.edu.ph', '09709543216', 'Mohon', 'San Jose', 'Iloilo', '2002-08-08', 'coe', 'BSEd ', '3 B', '3', NULL, 'active', 'Scarlet344', 'Scarlet344', 'admin', 'approved'),
('2022-6332-A', 'Layla', 'Quin', 'B', 'N/A', 'f', 'default.jpg', 'Layla4@gmail.com', '09098735642', 'Santa Barbara', 'Sambag', 'Iloilo', '2003-04-04', 'cit', 'BS in Auto Tech (BSAT) - Level III', '3 A', '3', NULL, 'active', 'Layla1486', 'Layla1486', 'student', 'approved'),
('2022-6742-A', 'Mika Jane', 'Yato', 'Fen', 'N/A', 'f', 'default.jpg', 'mikajane@gmail.com', '09098735642', 'Lapaz', 'Burgos st.', 'Iloilo', '2004-04-02', 'cas', 'BS in Comp Sci', '4 B', '3', NULL, 'active', 'Mikajane@gmail', 'Mikajane@gmail', 'student', 'approved'),
('2022-9078-A', 'Damn', 'Stitch', 'Men', 'N/A', 'o', 'default.jpg', 'Damn@gmail.com', '09786673219', 'Janiuay', 'Anhawan', 'Iloilo', '2003-11-15', 'cit', 'BS in Elec Tech (BSELT) - Level III', '3 A', '3', NULL, 'active', 'Damn7', 'Damn7', 'admin', 'approved'),
('2023', 'Makayla', 'Morgan', 'D', 'N/A', 'f', 'default.jpg', '\njohnwindricksucias@gmail.com ', '09098735642', 'Pavia', 'Bolong Este', 'Iloilo', '2001-09-09', 'cit', 'BS in Ind Tech (BIT) - Level III', '2 A', '3', NULL, 'active', 'Makayla33', 'Makayla33', 'student', 'approved'),
('2023-4678-A', 'Grad', 'Jam', 'Treek', 'N/A', 'm', 'default.jpg', 'Grad@gmail.com', '09098555642', 'Mohon', 'San Jose', 'Iloilo', '2004-06-23', 'cea', 'BS in Elec Eng', '3 A', '3', NULL, 'active', 'Grad41', 'Grad41', 'student', 'approved'),
('2023-5478-A', 'Umay', 'Gad', 'Ho', 'N/A', 'm', 'default.jpg', 'UMami@gmail.com', '09128555642', 'Guimbal', 'Cabubugan', 'Iloilo', '2004-12-06', 'coe', 'BTVTEd', '2 C', '3', NULL, 'active', 'Umai11', 'Umai11', 'admin', 'approved'),
('2024-2981-V', 'Destiny', 'Kramel', 'J', 'N/A', 'f', 'default.jpg', 'vonjohn.suropia@students.isatu.edu.ph', '09098735642', 'Jaro', 'Zone1', 'Iloilo', '2005-06-09', 'cas', 'BS in English', '1 C', '3', NULL, 'active', 'Destiny00', 'Destiny00', 'student', 'rejected'),
('2024-4536-A', 'Trans', 'Gender', 'LGBT', 'N/A', 'o', 'default.jpg', 'Trans@gmail.com', '09736543219', 'Cabatuan', 'Linis Patag', 'Iloilo', '2006-09-07', 'coe', 'BSEd ', '1 D', '3', NULL, 'active', 'Trans7', 'Trans7', 'admin', 'rejected'),
('2024-7878-A', 'Crams', 'Cammy', 'Pie', 'N/A', 'm', 'default.jpg', 'Cramps@gmail.com', '09788735642', 'Roxas ', 'Paralan,Maayon', 'Iloilo', '2005-03-08', 'cit', 'BS in Hotel & Rest Tech (BSHRT) - Level II', '1 B', '3', NULL, 'active', 'Crams56', 'Crams56', 'admin', 'approved'),
('a1-Asbart', 'a1-Asbart', 'a1-Asbart', 'a1-Asbart', 'N/A', 'o', 'default.jpg', 'vonjohnsuropia116@gmail.com', '56783456789', 'a1-Asbart', 'a1-Asbart', 'a1-Asbart', '2024-12-31', 'cas', 'BS in English', '4 B', '3', '', 'active', 'a1-Asbart', 'a1-Asbart', 'student', 'pending'),
('a1-Asbartq', 'a1-Asbart', 'a1-Asbart', 'a1-Asbart', 'N/A', 'o', 'default.jpg', 'vonjohnsuropia116@gmail.com', '56783456789', 'a1-Asbart', 'a1-Asbart', 'a1-Asbart', '2024-12-31', 'cas', 'BS in English', '4 B', '3', '', 'active', 'a1-Asbart', 'a1-Asbart', 'student', 'pending'),
('admin1', 'adminss', 'adss', 'minss', 'N/Ass', 'Male', '6753241d44415_default.jpg', 'vonjohnsuropia116@gmail.com', '0900000000011', 'Madminss', 'Badminss', 'Padminss', '2024-11-25', 'casss', 'course1ss', '1 Ass', NULL, NULL, 'active', 'admin1', 'admin1', 'admin', 'approved'),
('another', 'another', 'another', 'another', 'N/A', 'm', 'default.jpg', 'vonjohnsuropia116@gmail.com', '98765432222', 'another', 'another', 'another', '2024-12-07', 'cea', '', '4 A', '3', '', 'active', 'another11@A', 'another11@A', 'student', 'pending'),
('A_sbertp', 'A_sbertp', 'A_sbertp', 'A_sbertp', 'N/A', 'm', 'default.jpg', 'vonjohnsuropia116@gmail.com', '09000000000', 'A_sbertp', 'A_sbertp', 'A_sbertp', '2024-12-08', 'cea', 'BS in Civil Eng', '4 A', '3', '', 'active', 'A_sbertp', 'A_sbertpA_sbertp', 'student', 'approved'),
('librarian1', 'libr', 'librarian', 'arian', 'N/A', 'Male', '674bee2a4a95f_gintoki-appology.jpg', 'vonjohnsuropia116@gmail.com', '09000000000', 'Mlibrarian', 'Blibrarian', 'Plibrarian', '2024-12-01', 'cas', 'BS in English', '5 A', '3', NULL, 'active', 'librarian1', 'librarian1', 'librarian', 'approved'),
('student1', 'stu', 'student', 'dent', 'N/A', 'Male', '674bf52e6d826_fghjkl.png', 'vonjohnsuropia116@gmail.com', '09000000000', 'Sstudent', 'Bstudent', 'Pstudent', '2024-12-01', 'cas', 'BS in English', '5 C', '3', NULL, 'active', 'student1', 'student1', 'student', 'approved'),
('test me', 'test me', 'test me', 'test me', 'N/A', 'o', 'default.jpg', 'vonjohnsuropia116@gmail.com', '00000000000', 'test me', 'test metest me', 'test me', '2024-12-08', 'cas', '', '', '3', '', 'active', 'teste11@A', 'teste11@A', 'faculty', 'approved');

--
-- Indexes for dumped tables
--

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
  ADD KEY `book_id` (`book_copy`),
  ADD KEY `book_id_2` (`book_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

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
  MODIFY `co_author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=686;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_users_info` FOREIGN KEY (`IDno`) REFERENCES `users_info` (`IDno`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `book_copies`
--
ALTER TABLE `book_copies`
  ADD CONSTRAINT `fk_book_copies` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_coauthor` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_subject` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
