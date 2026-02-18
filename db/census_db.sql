-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 12:07 PM
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
-- Database: `census_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `census`
--

CREATE TABLE `census` (
  `census_id` int(11) NOT NULL,
  `household_id` varchar(50) NOT NULL,
  `ward` enum('Aigbaka','Ailegun','Fadu','Ifoshi','Ilamose','Oke-Afa') NOT NULL,
  `address` varchar(255) NOT NULL,
  `date_recorded` timestamp NOT NULL DEFAULT current_timestamp(),
  `operator_id` int(11) DEFAULT NULL,
  `surname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `othername` varchar(255) DEFAULT NULL,
  `current_age` int(11) NOT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `date_of_birth` date NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `disability_status` enum('Yes','No') NOT NULL,
  `state_of_birth` varchar(255) NOT NULL,
  `local_government_of_birth` varchar(255) NOT NULL,
  `state_of_origin` varchar(255) NOT NULL,
  `local_government_of_origin` varchar(255) NOT NULL,
  `national_identity_number` varchar(11) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `gps_accuracy` float DEFAULT NULL,
  `gps_address` varchar(255) DEFAULT NULL,
  `location_captured_at` datetime DEFAULT NULL,
  `location_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `census`
--

INSERT INTO `census` (`census_id`, `household_id`, `ward`, `address`, `date_recorded`, `operator_id`, `surname`, `firstname`, `othername`, `current_age`, `sex`, `date_of_birth`, `occupation`, `disability_status`, `state_of_birth`, `local_government_of_birth`, `state_of_origin`, `local_government_of_origin`, `national_identity_number`, `latitude`, `longitude`, `gps_accuracy`, `gps_address`, `location_captured_at`, `location_verified`) VALUES
(1, '123456', 'Ailegun', 'no 3 Ailegun street ejigbo lagos', '2024-08-21 10:01:31', 1, 'john', 'doe', 'hmmm', 30, 'Male', '1994-07-30', 'HEALTHCARE', 'No', '', '', 'edo', 'Benin', '12345678912', 7.6827418, 4.4570921, NULL, NULL, NULL, 0),
(2, '55959595', 'Aigbaka', '25 ladoke close ', '2024-08-21 13:55:09', 1, 'Emeka', 'bobo', 'star', 29, 'Female', '1995-02-15', 'FINANCE', 'No', 'ekiti', 'ekiti-west', 'delta', '4.4570921', '12345678913', 7.6827418, 4.4570921, NULL, NULL, NULL, 0),
(3, '58585858', 'Fadu', 'nothing', '2024-08-21 14:11:27', 1, 'man', 'woman', 'other', 28, 'Female', '1996-12-03', 'RETAIL', 'Yes', 'kaduna', 'kaura', 'edo', 'igueben', '12345789122', NULL, NULL, NULL, NULL, NULL, 0),
(4, '5555555', 'Ailegun', '27 bode Thomas', '2024-08-21 14:19:31', 1, 'kemi', 'tobi', 'timi', 30, 'Male', '1994-07-26', 'STUDENT', 'No', 'anambra', 'awka-south', 'delta', 'Ndokwa-East', '09876543211', 7.6827418, 4.4570921, NULL, NULL, NULL, 0),
(5, '338383838', 'Aigbaka', 'son', '2024-08-21 14:22:09', 1, 'john', 'doe', '', 29, 'Male', '1994-08-14', 'STUDENT', 'No', 'cross_river', 'ikom', 'ekiti', 'irepodun/ifelodun', '12345123456', 7.6827120, 4.4570180, NULL, NULL, NULL, 0),
(6, '5555555555', 'Oke-Afa', 'AFOLABI OJO STREET, IKIRE', '2024-08-24 16:46:40', 1, 'ALAO', 'AJAO', 'SAILAS', 15, 'Male', '2014-10-13', 'INFORMATION TECHNOLOGY', 'Yes', 'EBONYI', 'AFIKPO-NORTH', 'EDO', 'ORHIONMWON', NULL, 7.6827418, 4.4570921, NULL, NULL, NULL, 0),
(7, '9876655443', 'Ailegun', 'ORI OKE', '2024-08-24 16:55:36', 1, 'KIKI', 'MARK', 'FRED', 1, 'Female', '2024-08-13', 'INFORMATION TECHNOLOGY', 'No', 'BAYELSA', 'EKEREMOR', 'DELTA', 'NDOKWA-WEST', NULL, 7.6827418, 4.4570921, NULL, NULL, NULL, 0),
(8, '27364553', 'Ifoshi', '2, ALABI OYO STREET OFF AILEGUN, EJIGBO LAGOS', '2024-08-24 18:11:01', 1, 'MARK', 'IME', 'CANOE', 30, 'Male', '1994-07-27', 'MANUFACTURING', 'No', 'AKWA_IBOM', 'IKOT-EKPENE', 'JIGAWA', 'JAHUN', '12345678901', 7.6827418, 4.4570921, NULL, NULL, NULL, 0),
(9, '122344444', 'Ailegun', '67, ALABI STREET OFF AILEGUN, EJIGBO', '2024-08-25 01:57:51', 7, 'FATIM', 'OGHENE', 'CAROL', 28, 'Female', '1996-05-31', 'CONSTRUCTION', 'No', 'CROSS_RIVER', 'OBUBRA', 'EBONYI', 'IVO', '44444444444', 6.5243793, 3.3792057, NULL, NULL, NULL, 0),
(10, '67774321', 'Oke-Afa', '17 FALOMO CRESENT, JAKANDE ESTATE OKE-AFA EJIGBO', '2024-08-25 14:08:01', 3, 'OGUNDIPE', 'TOBA', 'MOSES', 31, 'Male', '1993-07-25', 'SELF-EMPLOYED', 'No', 'ADAMAWA', 'YOLA-NORTH', 'OGUN', 'IJEBU-ODE', '88888765432', 6.5243793, 3.3792057, NULL, NULL, NULL, 0),
(11, '45666788', 'Ailegun', '15 BOFAG CLOSE EJIGBO', '2026-02-17 07:40:59', 1, 'CAMSI', 'BROFAG', 'LAMBE', 41, 'Male', '1985-01-22', 'SELF-EMPLOYED', 'No', 'IMO', 'AHIAZU-MBAISE', 'LAGOS', 'OSHODI-ISOLO', '12345567783', 6.6400000, 3.4900000, NULL, NULL, NULL, 0),
(12, '77777777', 'Aigbaka', '43, bbbbbbb', '2026-02-17 13:43:14', 1, 'mmmmmm', 'nnnnnnn', 'oooooooo', 37, 'Male', '1988-08-14', 'Information Technology', 'No', 'anambra', 'awka-north', 'edo', 'ikpoba-okha', '12345678901', 6.0000000, 3.4900000, NULL, NULL, '2026-02-17 14:43:14', 1),
(13, '123456', 'Ailegun', '43 vvvvgttt', '2026-02-17 22:10:04', 1, 'llflflflf', 'snssnsnsn', 'wwjwjwjj', 37, 'Male', '1988-08-14', 'Other', 'No', 'jigawa', 'gwiwa', 'benue', 'ohimini', '11234567890', 6.5308789, 3.2916184, 209, NULL, '2026-02-17 23:10:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` enum('admin','field_operator') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `surname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `othername` varchar(50) DEFAULT NULL,
  `sex` enum('Male','Female') NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `state_of_origin` varchar(50) NOT NULL,
  `local_government_of_origin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `role`, `created_at`, `surname`, `firstname`, `othername`, `sex`, `date_of_birth`, `address`, `state_of_origin`, `local_government_of_origin`) VALUES
(1, 'admin', '$2y$10$kt0bPvos2cuoJNdQncCIsOCWdwb9ohgAhuXiFFZusPtx5H6tADNBy', 'young@ngr.com', 'admin', '2024-08-21 08:04:48', 'Ekundayo', 'Joseph', NULL, 'Male', '2002-08-04', '', '', ''),
(3, 'Major', '$2y$10$VArN.dsGRJcDtinOJL8O4eilFOhOXfZwjAp1elIZhKXpaGKL6YRg.', 'major@you.com', 'field_operator', '2024-08-21 08:22:42', '', 'Mayorkun', NULL, 'Male', NULL, '', '', ''),
(4, 'TJAY', '$2y$10$Ju5m.TTT0K0ekd3fGg/ry.FeG9jlsZvqj0V19PGzs.KrnMrVS4KQK', 'ALAO@RN.COM', 'field_operator', '2024-08-24 15:06:23', 'ALAO', 'AJAO', 'CANOE', 'Male', '2024-08-04', '50B ADENIJI JONES, LAGOS ISLAND LAGOS STATE', 'ABIA', 'UMUAHIA-SOUTH'),
(6, 'BOBO', '$2y$10$5LAhYFr6PkOLcPPm6gxg4uXu9tWFJIByW5a./TTnoNHRJVqqYyXa.', 'SAILAS@RN.COM', 'field_operator', '2024-08-24 15:31:14', 'KIKI', 'IME', 'SAILAS', 'Male', '2024-07-31', '50B ADENIYI JONES, IKEJA LAGOS', 'ADAMAWA', 'MAYO-BELWA'),
(7, 'SAMMY', '$2y$10$cVeJniZmOztyTjogb8bVhORVVM020bmS8644MINyMXdwok7yC93/.', 'SAMMY@RN.COM', 'field_operator', '2024-08-25 01:16:55', 'SAMUEL', 'FESTUS', 'CAIN', 'Male', '1994-12-14', '27 BABATUDE ALLEN, EJIGBO', 'LAGOS', 'OSHODI-ISOLO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `census`
--
ALTER TABLE `census`
  ADD PRIMARY KEY (`census_id`),
  ADD KEY `operator_id` (`operator_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `census`
--
ALTER TABLE `census`
  MODIFY `census_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `census`
--
ALTER TABLE `census`
  ADD CONSTRAINT `census_ibfk_1` FOREIGN KEY (`operator_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
