-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 04:56 PM
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
-- Database: `user_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `status`, `created_at`, `first_name`, `last_name`, `profile_image`) VALUES
(1, 'admin', '$2y$10$YourHashedPasswordHere', 'admin@example.com', 'admin', 'approved', '2024-10-14 15:10:25', NULL, NULL, NULL),
(12, 'jackkieechin1', '$2y$10$oKqgB66lTu9Kn3ZK758S.ugRT9uV/TQQEvVND7pBlV2GU3f1mjYS6', 'jackkieechin@jackkieechin', 'admin', 'approved', '2024-10-14 15:30:11', NULL, NULL, NULL),
(13, 'fuck', '$2y$10$YAUC36csWx.8S8f1zthZY.sw//XYPeYFTxUmtHv7ItXgdjNHwzBoC', 'fuck@dd', 'user', '', '2024-10-14 15:33:14', NULL, NULL, NULL),
(15, 'fuck1', '$2y$10$PWmFPdSojJn1cef59nEkbebeoCV08Ht2g4kMQd6t3mqRphkHdQfta', 'fuck@fuck', 'user', 'approved', '2024-10-14 15:33:56', NULL, NULL, NULL),
(16, 'fuccck', '$2y$10$/wR/Rhefe9LXGVq.3aP/9.6MD1Bm35CSfUnlw3/mVmNmsDCWb0Vv6', 'approved', 'admin', 'approved', '2024-10-14 15:35:14', NULL, NULL, NULL),
(17, 'ghyhyhoo', '$2y$10$WFLSocrpDbREnNo3Y/EO/eYMNFDe3PxRRljMR8oORizBc.UAnkP0O', 'ghyhyhoo@ghyhyhoo', 'user', 'pending', '2024-10-14 23:16:31', NULL, NULL, NULL),
(18, 'SUROPIA', '$2y$10$cvJ08fvmffGT3VWcEcY4XeaxYgYmSg0uS3KOlsIi.EPETdwoZ8I6y', 'SUROPIA@SUROPIA', 'user', 'pending', '2024-10-14 23:30:04', NULL, NULL, NULL),
(19, 'hello', '$2y$10$gewm7ezGdKF/MK/RCH/Ty.BgGFOUjjwlN0wtx4l.OGzx.Bc9iLMim', 'hello@hello', 'user', 'pending', '2024-10-14 23:30:39', NULL, NULL, NULL),
(20, 'frienned', '$2y$10$JRX.LND.fz4EtgEIAS76Tucxhaf9kvr2.5tdvGgfusPv5CZDK1W9m', 'frienned@hh', 'user', 'pending', '2024-10-14 23:49:47', 'me', 'you', 'uploads/blob-scene-haikei.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
