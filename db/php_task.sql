-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2026 at 09:32 AM
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
-- Database: `php_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `designation`, `dob`, `doj`, `blood_group`, `mobile`, `email`, `address`, `photo`) VALUES
(1, 'Employee 1', 'Laravel Developer', '1995-01-02', '2024-01-02', 'A-', '9000000001', 'employee1@gmail.com', 'Address 1', NULL),
(2, 'Employee 2', 'Frontend Developer', '1995-01-03', '2024-01-03', 'B+', '9000000002', 'employee2@gmail.com', 'Address 2', NULL),
(3, 'Employee 3', 'UI Designer', '1995-01-04', '2024-01-04', 'B-', '9000000003', 'employee3@gmail.com', 'Address 3', NULL),
(4, 'Employee 4', 'HR Executive', '1995-01-05', '2024-01-05', 'AB+', '9000000004', 'employee4@gmail.com', 'Address 4', NULL),
(5, 'Employee 5', 'PHP Developer', '1995-01-06', '2024-01-06', 'AB-', '9000000005', 'employee5@gmail.com', 'Address 5', NULL),
(6, 'Employee 6', 'Laravel Developer', '1995-01-07', '2024-01-07', 'O+', '9000000006', 'employee6@gmail.com', 'Address 6', NULL),
(7, 'Employee 7', 'Frontend Developer', '1995-01-08', '2024-01-08', 'O-', '9000000007', 'employee7@gmail.com', 'Address 7', NULL),
(8, 'Employee 8', 'UI Designer', '1995-01-09', '2024-01-09', 'A+', '9000000008', 'employee8@gmail.com', 'Address 8', NULL),
(9, 'Employee 9', 'HR Executive', '1995-01-10', '2024-01-10', 'A-', '9000000009', 'employee9@gmail.com', 'Address 9', NULL),
(10, 'Employee 10', 'PHP Developer', '1995-01-11', '2024-01-11', 'B+', '9000000010', 'employee10@gmail.com', 'Address 10', NULL),
(11, 'Employee 11', 'Laravel Developer', '1995-01-12', '2024-01-12', 'B-', '9000000011', 'employee11@gmail.com', 'Address 11', NULL),
(12, 'Employee 12', 'Frontend Developer', '1995-01-13', '2024-01-13', 'AB+', '9000000012', 'employee12@gmail.com', 'Address 12', NULL),
(13, 'Employee 13', 'UI Designer', '1995-01-14', '2024-01-14', 'AB-', '9000000013', 'employee13@gmail.com', 'Address 13', NULL),
(14, 'Employee 14', 'HR Executive', '1995-01-15', '2024-01-15', 'O+', '9000000014', 'employee14@gmail.com', 'Address 14', NULL),
(15, 'Employee 15', 'PHP Developer', '1995-01-16', '2024-01-16', 'O-', '9000000015', 'employee15@gmail.com', 'Address 15', NULL),
(16, 'Employee 16', 'Laravel Developer', '1995-01-17', '2024-01-17', 'A+', '9000000016', 'employee16@gmail.com', 'Address 16', NULL),
(17, 'Employee 17', 'Frontend Developer', '1995-01-18', '2024-01-18', 'A-', '9000000017', 'employee17@gmail.com', 'Address 17', NULL),
(18, 'Employee 18', 'UI Designer', '1995-01-19', '2024-01-19', 'B+', '9000000018', 'employee18@gmail.com', 'Address 18', NULL),
(19, 'Employee 19', 'HR Executive', '1995-01-20', '2024-01-20', 'B-', '9000000019', 'employee19@gmail.com', 'Address 19', NULL),
(20, 'Employee 20', 'PHP Developer', '1995-01-21', '2024-01-21', 'AB+', '9000000020', 'employee20@gmail.com', 'Address 20', NULL),
(21, 'Employee 21', 'Laravel Developer', '1995-01-22', '2024-01-22', 'AB-', '9000000021', 'employee21@gmail.com', 'Address 21', NULL),
(22, 'Employee 22', 'Frontend Developer', '1995-01-23', '2024-01-23', 'O+', '9000000022', 'employee22@gmail.com', 'Address 22', NULL),
(23, 'Employee 23', 'UI Designer', '1995-01-24', '2024-01-24', 'O-', '9000000023', 'employee23@gmail.com', 'Address 23', NULL),
(24, 'Employee 24', 'HR Executive', '1995-01-25', '2024-01-25', 'A+', '9000000024', 'employee24@gmail.com', 'Address 24', NULL),
(25, 'Employee 25', 'PHP Developer', '1995-01-26', '2024-01-26', 'A-', '9000000025', 'employee25@gmail.com', 'Address 25', NULL),
(26, 'Employee 26', 'Laravel Developer', '1995-01-27', '2024-01-27', 'B+', '9000000026', 'employee26@gmail.com', 'Address 26', NULL),
(27, 'Employee 27', 'Frontend Developer', '1995-01-28', '2024-01-28', 'B-', '9000000027', 'employee27@gmail.com', 'Address 27', NULL),
(28, 'Employee 28', 'UI Designer', '1995-01-29', '2024-01-29', 'AB+', '9000000028', 'employee28@gmail.com', 'Address 28', NULL),
(29, 'Employee 29', 'HR Executive', '1995-01-30', '2024-01-30', 'AB-', '9000000029', 'employee29@gmail.com', 'Address 29', NULL),
(30, 'Employee 30', 'PHP Developer', '1995-01-31', '2024-01-31', 'O+', '9000000030', 'employee30@gmail.com', 'Address 30', NULL),
(31, 'Employee 31', 'Laravel Developer', '1995-02-01', '2024-02-01', 'O-', '9000000031', 'employee31@gmail.com', 'Address 31', NULL),
(32, 'Employee 32', 'Frontend Developer', '1995-02-02', '2024-02-02', 'A+', '9000000032', 'employee32@gmail.com', 'Address 32', NULL),
(33, 'Employee 33', 'UI Designer', '1995-02-03', '2024-02-03', 'A-', '9000000033', 'employee33@gmail.com', 'Address 33', NULL),
(34, 'Employee 34', 'HR Executive', '1995-02-04', '2024-02-04', 'B+', '9000000034', 'employee34@gmail.com', 'Address 34', NULL),
(35, 'Employee 35', 'PHP Developer', '1995-02-05', '2024-02-05', 'B-', '9000000035', 'employee35@gmail.com', 'Address 35', NULL),
(36, 'Employee 36', 'Laravel Developer', '1995-02-06', '2024-02-06', 'AB+', '9000000036', 'employee36@gmail.com', 'Address 36', NULL),
(37, 'Employee 37', 'Frontend Developer', '1995-02-07', '2024-02-07', 'AB-', '9000000037', 'employee37@gmail.com', 'Address 37', NULL),
(38, 'Employee 38', 'UI Designer', '1995-02-08', '2024-02-08', 'O+', '9000000038', 'employee38@gmail.com', 'Address 38', NULL),
(39, 'Employee 39', 'HR Executive', '1995-02-09', '2024-02-09', 'O-', '9000000039', 'employee39@gmail.com', 'Address 39', NULL),
(40, 'Employee 40', 'PHP Developer', '1995-02-10', '2024-02-10', 'A+', '9000000040', 'employee40@gmail.com', 'Address 40', NULL),
(41, 'Employee 41', 'Laravel Developer', '1995-02-11', '2024-02-11', 'A-', '9000000041', 'employee41@gmail.com', 'Address 41', NULL),
(42, 'Employee 42', 'Frontend Developer', '1995-02-12', '2024-02-12', 'B+', '9000000042', 'employee42@gmail.com', 'Address 42', NULL),
(43, 'Employee 43', 'UI Designer', '1995-02-13', '2024-02-13', 'B-', '9000000043', 'employee43@gmail.com', 'Address 43', NULL),
(44, 'Employee 44', 'HR Executive', '1995-02-14', '2024-02-14', 'AB+', '9000000044', 'employee44@gmail.com', 'Address 44', NULL),
(45, 'Employee 45', 'PHP Developer', '1995-02-15', '2024-02-15', 'AB-', '9000000045', 'employee45@gmail.com', 'Address 45', NULL),
(46, 'Employee 46', 'Laravel Developer', '1995-02-16', '2024-02-16', 'O+', '9000000046', 'employee46@gmail.com', 'Address 46', NULL),
(47, 'Employee 47', 'Frontend Developer', '1995-02-17', '2024-02-17', 'O-', '9000000047', 'employee47@gmail.com', 'Address 47', NULL),
(48, 'Employee 48', 'UI Designer', '1995-02-18', '2024-02-18', 'A+', '9000000048', 'employee48@gmail.com', 'Address 48', NULL),
(49, 'Employee 49', 'HR Executive', '1995-02-19', '2024-02-19', 'A-', '9000000049', 'employee49@gmail.com', 'Address 49', NULL),
(50, 'Employee 50', 'PHP Developer', '1995-02-20', '2024-02-20', 'B+', '9000000050', 'employee50@gmail.com', 'Address 50', NULL),
(51, 'Employee 51', 'Laravel Developer', '1995-02-21', '2024-02-21', 'B-', '9000000051', 'employee51@gmail.com', 'Address 51', NULL),
(52, 'Employee 52', 'Frontend Developer', '1995-02-22', '2024-02-22', 'AB+', '9000000052', 'employee52@gmail.com', 'Address 52', NULL),
(53, 'Employee 53', 'UI Designer', '1995-02-23', '2024-02-23', 'AB-', '9000000053', 'employee53@gmail.com', 'Address 53', NULL),
(54, 'Employee 54', 'HR Executive', '1995-02-24', '2024-02-24', 'O+', '9000000054', 'employee54@gmail.com', 'Address 54', NULL),
(55, 'Employee 55', 'PHP Developer', '1995-02-25', '2024-02-25', 'O-', '9000000055', 'employee55@gmail.com', 'Address 55', NULL),
(56, 'Employee 56', 'Laravel Developer', '1995-02-26', '2024-02-26', 'A+', '9000000056', 'employee56@gmail.com', 'Address 56', NULL),
(57, 'Employee 57', 'Frontend Developer', '1995-02-27', '2024-02-27', 'A-', '9000000057', 'employee57@gmail.com', 'Address 57', NULL),
(58, 'Employee 58', 'UI Designer', '1995-02-28', '2024-02-28', 'B+', '9000000058', 'employee58@gmail.com', 'Address 58', NULL),
(59, 'Employee 59', 'HR Executive', '1995-03-01', '2024-02-29', 'B-', '9000000059', 'employee59@gmail.com', 'Address 59', NULL),
(60, 'Employee 60', 'PHP Developer', '1995-03-02', '2024-03-01', 'AB+', '9000000060', 'employee60@gmail.com', 'Address 60', NULL),
(61, 'Employee 61', 'Laravel Developer', '1995-03-03', '2024-03-02', 'AB-', '9000000061', 'employee61@gmail.com', 'Address 61', NULL),
(62, 'Employee 62', 'Frontend Developer', '1995-03-04', '2024-03-03', 'O+', '9000000062', 'employee62@gmail.com', 'Address 62', NULL),
(63, 'Employee 63', 'UI Designer', '1995-03-05', '2024-03-04', 'O-', '9000000063', 'employee63@gmail.com', 'Address 63', NULL),
(64, 'Employee 64', 'HR Executive', '1995-03-06', '2024-03-05', 'A+', '9000000064', 'employee64@gmail.com', 'Address 64', NULL),
(65, 'Employee 65', 'PHP Developer', '1995-03-07', '2024-03-06', 'A-', '9000000065', 'employee65@gmail.com', 'Address 65', NULL),
(66, 'Employee 66', 'Laravel Developer', '1995-03-08', '2024-03-07', 'B+', '9000000066', 'employee66@gmail.com', 'Address 66', NULL),
(67, 'Employee 67', 'Frontend Developer', '1995-03-09', '2024-03-08', 'B-', '9000000067', 'employee67@gmail.com', 'Address 67', NULL),
(68, 'Employee 68', 'UI Designer', '1995-03-10', '2024-03-09', 'AB+', '9000000068', 'employee68@gmail.com', 'Address 68', NULL),
(69, 'Employee 69', 'HR Executive', '1995-03-11', '2024-03-10', 'AB-', '9000000069', 'employee69@gmail.com', 'Address 69', NULL),
(70, 'Employee 70', 'PHP Developer', '1995-03-12', '2024-03-11', 'O+', '9000000070', 'employee70@gmail.com', 'Address 70', NULL),
(71, 'Employee 71', 'Laravel Developer', '1995-03-13', '2024-03-12', 'O-', '9000000071', 'employee71@gmail.com', 'Address 71', NULL),
(72, 'Employee 72', 'Frontend Developer', '1995-03-14', '2024-03-13', 'A+', '9000000072', 'employee72@gmail.com', 'Address 72', NULL),
(73, 'Employee 73', 'UI Designer', '1995-03-15', '2024-03-14', 'A-', '9000000073', 'employee73@gmail.com', 'Address 73', NULL),
(74, 'Employee 74', 'HR Executive', '1995-03-16', '2024-03-15', 'B+', '9000000074', 'employee74@gmail.com', 'Address 74', NULL),
(75, 'Employee 75', 'PHP Developer', '1995-03-17', '2024-03-16', 'B-', '9000000075', 'employee75@gmail.com', 'Address 75', NULL),
(76, 'Employee 76', 'Laravel Developer', '1995-03-18', '2024-03-17', 'AB+', '9000000076', 'employee76@gmail.com', 'Address 76', NULL),
(77, 'Employee 77', 'Frontend Developer', '1995-03-19', '2024-03-18', 'AB-', '9000000077', 'employee77@gmail.com', 'Address 77', NULL),
(78, 'Employee 78', 'UI Designer', '1995-03-20', '2024-03-19', 'O+', '9000000078', 'employee78@gmail.com', 'Address 78', NULL),
(79, 'Employee 79', 'HR Executive', '1995-03-21', '2024-03-20', 'O-', '9000000079', 'employee79@gmail.com', 'Address 79', NULL),
(80, 'Employee 80', 'PHP Developer', '1995-03-22', '2024-03-21', 'A+', '9000000080', 'employee80@gmail.com', 'Address 80', NULL),
(81, 'Employee 81', 'Laravel Developer', '1995-03-23', '2024-03-22', 'A-', '9000000081', 'employee81@gmail.com', 'Address 81', NULL),
(82, 'Employee 82', 'Frontend Developer', '1995-03-24', '2024-03-23', 'B+', '9000000082', 'employee82@gmail.com', 'Address 82', NULL),
(83, 'Employee 83', 'UI Designer', '1995-03-25', '2024-03-24', 'B-', '9000000083', 'employee83@gmail.com', 'Address 83', NULL),
(84, 'Employee 84', 'HR Executive', '1995-03-26', '2024-03-25', 'AB+', '9000000084', 'employee84@gmail.com', 'Address 84', NULL),
(85, 'Employee 85', 'PHP Developer', '1995-03-27', '2024-03-26', 'AB-', '9000000085', 'employee85@gmail.com', 'Address 85', NULL),
(86, 'Employee 86', 'Laravel Developer', '1995-03-28', '2024-03-27', 'O+', '9000000086', 'employee86@gmail.com', 'Address 86', NULL),
(87, 'Employee 87', 'Frontend Developer', '1995-03-29', '2024-03-28', 'O-', '9000000087', 'employee87@gmail.com', 'Address 87', NULL),
(88, 'Employee 88', 'UI Designer', '1995-03-30', '2024-03-29', 'A+', '9000000088', 'employee88@gmail.com', 'Address 88', NULL),
(89, 'Employee 89', 'HR Executive', '1995-03-31', '2024-03-30', 'A-', '9000000089', 'employee89@gmail.com', 'Address 89', NULL),
(90, 'Employee 90', 'PHP Developer', '1995-04-01', '2024-03-31', 'B+', '9000000090', 'employee90@gmail.com', 'Address 90', NULL),
(91, 'Employee 91', 'Laravel Developer', '1995-04-02', '2024-04-01', 'B-', '9000000091', 'employee91@gmail.com', 'Address 91', NULL),
(92, 'Employee 92', 'Frontend Developer', '1995-04-03', '2024-04-02', 'AB+', '9000000092', 'employee92@gmail.com', 'Address 92', NULL),
(93, 'Employee 93', 'UI Designer', '1995-04-04', '2024-04-03', 'AB-', '9000000093', 'employee93@gmail.com', 'Address 93', NULL),
(94, 'Employee 94', 'HR Executive', '1995-04-05', '2024-04-04', 'O+', '9000000094', 'employee94@gmail.com', 'Address 94', NULL),
(95, 'Employee 95', 'PHP Developer', '1995-04-06', '2024-04-05', 'O-', '9000000095', 'employee95@gmail.com', 'Address 95', NULL),
(96, 'Employee 96', 'Laravel Developer', '1995-04-07', '2024-04-06', 'A+', '9000000096', 'employee96@gmail.com', 'Address 96', NULL),
(97, 'Employee 97', 'Frontend Developer', '1995-04-08', '2024-04-07', 'A-', '9000000097', 'employee97@gmail.com', 'Address 97', NULL),
(98, 'Employee 98', 'UI Designer', '1995-04-09', '2024-04-08', 'B+', '9000000098', 'employee98@gmail.com', 'Address 98', NULL),
(99, 'Employee 99', 'HR Executive', '1995-04-10', '2024-04-09', 'B-', '9000000099', 'employee99@gmail.com', 'Address 99', NULL),
(100, 'Employee 100', 'PHP Developer', '1995-04-11', '2024-04-10', 'AB+', '9000000100', 'employee100@gmail.com', 'Address 100', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` enum('super_admin','admin','user') NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `mobile`, `email`, `password`, `address`, `gender`, `dob`, `profile_picture`, `signature`, `status`, `created_at`) VALUES
(1, 'Super Admin', 'super_admin', '9999999999', 'superadmin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Hyderabad', 'Male', '1998-01-01', NULL, NULL, 'Approved', '2026-07-01 06:42:09'),
(2, 'Admin', 'admin', '8888888888', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vizag', 'Male', '1999-02-15', NULL, NULL, 'Approved', '2026-07-01 06:42:09'),
(3, 'Kalavalapalli Mohan', 'user', '7981031675', 'mohankalavalapalli9@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'visakhapatanam', 'Male', '1997-09-28', '1782888247_mohan 45.jpg', '', 'Approved', '2026-07-01 06:44:07'),
(5, 'Kumar', 'user', '9985460049', 'kumar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'visakhapatanam', 'Male', '2003-09-28', '', '', 'Pending', '2026-07-01 07:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_files`
--

CREATE TABLE `user_files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_type` enum('Aadhaar Card','PAN Card','Passport','Driving License','Voter ID','Other') NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_size` bigint(20) DEFAULT NULL,
  `file_type_mime` varchar(100) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_files`
--

INSERT INTO `user_files` (`id`, `user_id`, `file_type`, `original_name`, `file_name`, `file_size`, `file_type_mime`, `uploaded_at`) VALUES
(2, 3, 'Aadhaar Card', 'adhar-f.pdf', '1782891090_6a44c25206192.pdf', 138124, 'application/pdf', '2026-07-01 07:31:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_files`
--
ALTER TABLE `user_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_files`
--
ALTER TABLE `user_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_files`
--
ALTER TABLE `user_files`
  ADD CONSTRAINT `user_files_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
