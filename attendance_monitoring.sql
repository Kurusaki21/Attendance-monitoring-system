-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 11:03 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_monitoring`
--

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` int(11) NOT NULL,
  `school_id` varchar(25) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `school_id`, `first_name`, `last_name`, `address`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, '', 'wasdasd', 'wasdasd', 'admin@admin.com', 'asd', 'asd', '2023-08-17 17:41:41', '2023-08-17 09:41:41'),
(3, '', 'aha', 'aha', 'admin@admin.com', 'asdsd', '47bce5c74f589f4867dbd57e9ca9f808', '2023-08-17 22:38:51', '2023-08-17 14:38:51'),
(4, '', 'wwww', 'sdsd', 'sss@ee.com', 'www', '5fa72358f0b4fb4f2c5d7de8c9a41846', '2023-08-28 12:37:40', '2023-08-28 04:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `professor_student`
--

CREATE TABLE `professor_student` (
  `id` int(10) NOT NULL,
  `professor_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `school_id` varchar(25) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `parents_contact` varchar(45) NOT NULL,
  `student_year` int(10) NOT NULL,
  `student_course` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `school_id`, `first_name`, `last_name`, `email`, `address`, `parents_contact`, `student_year`, `student_course`, `created_at`, `updated_at`) VALUES
(3, '', 'erere', 'rerer', 'admin@admin.com', 'dasdasd', '09123456798', 1, 'CpE', '0000-00-00 00:00:00', '2023-08-17 09:03:18'),
(4, '', 'erwerwerwer', 'ssdasdassdasd', 'admin@admin.com', 'wsdsdsdsd', '13123123123123', 1, 'CpE', '2023-08-17 17:04:03', '2023-08-17 09:04:03'),
(5, '202300001', 'john', 'doe', 'johndoe@gmail.com', 'asdjhasdiuj', '09123456798', 1, 'CpE', '2023-08-17 22:12:52', '2023-08-28 08:18:21'),
(6, '202300002', 'sssd', 'dsdsd', 'asd@gasd.com', 'wsdsd', '0932156489', 1, 'CpE', '2023-08-17 22:12:52', '2023-08-28 08:29:34'),
(8, '202300003', 'tyrty', 'fghfghfg', 'sdasd@asdasd.com', 'wweasdasd', '0912345789', 1, 'CpE', '2023-08-28 16:57:39', '2023-08-28 08:57:39'),
(9, '202300004', 'eeee', 'eee', 'ee@ee.com', 'sadasdasd', '0912345789', 1, 'CpE', '2023-08-28 16:58:22', '2023-08-28 08:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(45) DEFAULT NULL,
  `subject_description` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subject_name`, `subject_description`, `created_at`, `updated_at`) VALUES
(1, 'asd', 'hehesssss', '2023-08-17 11:58:59', NULL),
(4, 'www', 'eee', '2023-08-24 15:42:34', NULL),
(5, 'asd', 'aaaaaa', '2023-08-24 15:49:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_professor`
--

CREATE TABLE `subject_professor` (
  `id` int(10) NOT NULL,
  `professor_id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_professor`
--

INSERT INTO `subject_professor` (`id`, `professor_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(7, 3, 5, '2023-08-28 15:53:12', '2023-08-28 07:53:12'),
(8, 1, 5, '2023-08-28 15:53:27', '2023-08-28 07:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `subject_schedule`
--

CREATE TABLE `subject_schedule` (
  `id` int(20) NOT NULL,
  `prof_id` int(10) NOT NULL,
  `student_id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `day` varchar(45) NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin Admin', 'admin@admin.com', 'admin', 1, '2023-08-15 09:26:49', '2023-08-15 03:24:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professor_student`
--
ALTER TABLE `professor_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_professor`
--
ALTER TABLE `subject_professor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subject_schedule`
--
ALTER TABLE `subject_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subject_professor`
--
ALTER TABLE `subject_professor`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subject_schedule`
--
ALTER TABLE `subject_schedule`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subject_professor`
--
ALTER TABLE `subject_professor`
  ADD CONSTRAINT `subject_professor_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
