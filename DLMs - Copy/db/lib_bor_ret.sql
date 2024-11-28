-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 06:09 PM
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
-- Database: `lib_bor_ret`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('available','borrowed') DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `registered_at`, `status`) VALUES
(1, 'halolo', 'ako', '12112', '2024-11-03 04:09:58', 'borrowed'),
(2, 'aba', 'ak', '1223', '2024-11-03 04:28:03', 'borrowed'),
(3, 'ww', 'www', 'ww', '2024-11-03 04:36:45', 'borrowed'),
(4, 'ss', 'ss', 'q2e2', '2024-11-03 05:37:06', 'available'),
(5, 'dd', 'e', '33', '2024-11-03 05:38:23', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `return_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`id`, `user_id`, `book_id`, `borrow_date`, `return_date`) VALUES
(2, 1, 2, '2024-11-03 04:36:16', '2024-11-03 04:36:20'),
(3, 2, 3, '2024-11-03 04:37:09', '2024-11-03 04:52:51'),
(4, 2, 1, '2024-11-03 04:37:26', '2024-11-03 04:52:53'),
(5, 2, 2, '2024-11-03 04:37:33', '2024-11-03 04:52:56'),
(6, 1, 1, '2024-11-03 05:25:50', '2024-11-03 05:38:42'),
(7, 1, 2, '2024-11-03 05:25:55', '2024-11-03 05:38:45'),
(8, 2, 3, '2024-11-03 05:26:03', '2024-11-03 05:38:48'),
(9, 2, 4, '2024-11-03 05:38:01', '2024-11-03 05:38:51'),
(10, 3, 5, '2024-11-03 05:38:35', '2024-11-03 05:38:53'),
(11, 1, 1, '2024-11-03 05:40:00', '2024-11-03 05:46:14'),
(12, 1, 2, '2024-11-03 05:40:00', '2024-11-03 05:46:39'),
(13, 3, 4, '2024-11-03 05:40:13', '2024-11-03 05:47:43'),
(14, 3, 5, '2024-11-03 05:40:13', '2024-11-03 05:47:40'),
(15, 1, 1, '2024-11-03 10:04:40', '2024-11-03 11:10:31'),
(16, 1, 2, '2024-11-03 10:04:40', '2024-11-03 12:19:13'),
(17, 1, 1, '2024-11-03 12:30:26', NULL),
(18, 1, 2, '2024-11-03 12:30:26', NULL),
(19, 1, 3, '2024-11-03 12:30:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `registered_at`) VALUES
(1, 'vonjohn.suropia', 'imjay@gmail.com', '2024-11-03 04:10:07'),
(2, 'alma', 'ama@add', '2024-11-03 04:27:48'),
(3, 'vonjohn.suropia', 'vonjohn.suropia@students.isatu.edu.ph', '2024-11-03 05:25:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowed_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
