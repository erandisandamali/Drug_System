-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2025 at 05:41 PM
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
-- Database: `dms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `created_list`
--

CREATE TABLE `created_list` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `drug_id` int(11) DEFAULT NULL,
  `strength` varchar(100) NOT NULL,
  `solution_id` int(11) DEFAULT NULL,
  `volume` varchar(100) NOT NULL,
  `location` varchar(20) NOT NULL,
  `duration_id` int(11) DEFAULT NULL,
  `dosage` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `created_list`
--

INSERT INTO `created_list` (`id`, `patient_id`, `route_id`, `drug_id`, `strength`, `solution_id`, `volume`, `location`, `duration_id`, `dosage`, `created_at`, `updated_at`, `deleted_at`) VALUES
(958, NULL, 6, NULL, '500 mg', 2, '7', 'Inside', 1, 'bd', '2025-08-02 12:27:24', NULL, NULL),
(959, NULL, 8, NULL, '200 mg', 3, '1', 'Inside', 2, 'bd', '2025-08-02 12:27:49', NULL, NULL),
(961, NULL, 5, NULL, '200 mg', 1, '1', 'Inside', 2, 'bd', '2025-08-02 12:31:05', NULL, NULL),
(962, NULL, 8, NULL, '500 mg', 2, '7', 'Outside', 2, 'tds', '2025-08-02 12:31:05', NULL, NULL),
(963, NULL, 7, NULL, '100 mg', 3, '21', 'Inside', 2, 'bd', '2025-08-02 12:31:05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL,
  `drug_type_id` int(11) NOT NULL,
  `srs_number` varchar(50) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `drug_type_id`, `srs_number`, `drug_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(224, 1, 'SRS123456', 'Paracetamol', '2025-08-19 14:28:51', NULL, NULL),
(225, 2, 'SRS678901', 'Domperidone', '2025-08-19 15:15:33', NULL, NULL),
(226, 3, 'SRS789012', 'Prochlorperazine', '2025-08-19 15:16:16', NULL, NULL),
(227, 1, 'SRS2345678', 'Scopolamine', '2025-08-19 15:16:52', NULL, NULL),
(228, 2, 'SRS345678', 'Hyoscyamine', '2025-08-19 15:17:48', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drug_types`
--

CREATE TABLE `drug_types` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drug_types`
--

INSERT INTO `drug_types` (`id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Normal', '2025-08-02 12:53:16', NULL, NULL),
(2, 'Name patient', '2025-08-02 12:53:16', NULL, NULL),
(3, 'Special', '2025-08-02 12:53:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `durations`
--

CREATE TABLE `durations` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `durations`
--

INSERT INTO `durations` (`id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'D1-D2', '2025-04-03 15:44:25', NULL, NULL),
(2, 'D1-D3', '2025-04-03 15:44:25', NULL, NULL),
(3, 'D1-D4', '2025-04-03 15:44:25', NULL, NULL),
(4, 'D1-D5', '2025-04-03 15:44:25', NULL, NULL),
(5, 'D1-D6', '2025-04-03 15:44:25', NULL, NULL),
(6, 'D1-D7', '2025-04-03 15:44:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oncologists`
--

CREATE TABLE `oncologists` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oncologists`
--

INSERT INTO `oncologists` (`id`, `first_name`, `last_name`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(60, 'chamara', 'perera', 'Dr.', '2025-08-19 14:27:02', NULL, NULL),
(61, 'Nimal', 'Silva', 'Prof.', '2025-08-19 15:20:44', NULL, NULL),
(62, 'Kamal', 'Fernando', 'Asst. Prof.', '2025-08-19 15:21:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` tinyint(11) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `bht_number` varchar(50) NOT NULL,
  `clinic_number` varchar(20) DEFAULT NULL,
  `phn` varchar(50) DEFAULT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `oncologist_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `first_name`, `last_name`, `age`, `gender`, `title`, `bht_number`, `clinic_number`, `phn`, `ward_id`, `section_id`, `oncologist_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(688, 'Erandi', 'sandamali', 26, 'Female', 'Ms.', '', '001', '', 13, 32, 60, '2025-08-19 20:08:33', NULL, NULL),
(689, 'Chandani', 'Karunarathne', 36, 'Female', 'Mrs.', '', '', '071525458564', 13, 32, 60, '2025-08-19 20:53:18', NULL, NULL),
(690, 'Kamal', 'Wijewardhana', 53, 'Male', 'Dr.', 'BHT56789', '', '1', 13, 32, 62, '2025-08-19 20:54:46', NULL, NULL),
(691, 'Yasodara', 'Rathnayake', 41, 'Female', 'Mrs.', 'BHT23456', '', '', 14, 35, 60, '2025-08-19 20:56:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'IV', '2025-08-02 11:55:10', NULL, NULL),
(6, 'IM', '2025-08-02 11:55:11', NULL, NULL),
(7, 'IT', '2025-08-02 11:55:11', NULL, NULL),
(8, 'SC', '2025-08-02 11:55:11', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `ward_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `ward_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(32, 'SECTION A', 13, '2025-08-19 15:18:42', NULL, '2025-08-19 15:18:42'),
(33, 'SECTION A', 13, '2025-08-19 15:18:36', NULL, NULL),
(34, 'SECTION A', 13, '2025-08-19 15:18:59', NULL, NULL),
(35, 'SECTION B', 14, '2025-08-19 15:25:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE `solutions` (
  `id` int(11) NOT NULL,
  `solution` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `solutions`
--

INSERT INTO `solutions` (`id`, `solution`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'N/S', '2025-04-03 15:45:07', '2025-07-10 19:10:52', NULL),
(2, '5/D', '2025-04-03 15:45:07', '2025-07-10 19:10:59', NULL),
(3, 'N/I', '2025-04-03 15:45:07', '2025-07-10 19:11:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `last_login`, `role`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '123', '2025-08-02 13:00:45', 'admin', 'active', '2025-08-02 12:54:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `id` int(11) NOT NULL,
  `ward_name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`id`, `ward_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 'WARD 01', '2025-08-19 14:31:26', NULL, NULL),
(14, 'WARD 02', '2025-08-19 15:18:11', NULL, NULL),
(15, 'WARD 03', '2025-08-19 15:18:22', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `created_list`
--
ALTER TABLE `created_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `drug_id` (`drug_id`),
  ADD KEY `solution_id` (`solution_id`),
  ADD KEY `days_type_id` (`duration_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`drug_type_id`);

--
-- Indexes for table `drug_types`
--
ALTER TABLE `drug_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `durations`
--
ALTER TABLE `durations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oncologists`
--
ALTER TABLE `oncologists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ward_id` (`ward_id`),
  ADD KEY `oncologist_id` (`oncologist_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ward_id` (`ward_id`);

--
-- Indexes for table `solutions`
--
ALTER TABLE `solutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `created_list`
--
ALTER TABLE `created_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=964;

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT for table `drug_types`
--
ALTER TABLE `drug_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `durations`
--
ALTER TABLE `durations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `oncologists`
--
ALTER TABLE `oncologists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=692;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `solutions`
--
ALTER TABLE `solutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `created_list`
--
ALTER TABLE `created_list`
  ADD CONSTRAINT `created_list_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `created_list_ibfk_2` FOREIGN KEY (`drug_id`) REFERENCES `drugs` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `created_list_ibfk_3` FOREIGN KEY (`solution_id`) REFERENCES `solutions` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `created_list_ibfk_4` FOREIGN KEY (`duration_id`) REFERENCES `durations` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `created_list_ibfk_5` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `drugs`
--
ALTER TABLE `drugs`
  ADD CONSTRAINT `drugs_ibfk_1` FOREIGN KEY (`drug_type_id`) REFERENCES `drug_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `patients_ibfk_2` FOREIGN KEY (`oncologist_id`) REFERENCES `oncologists` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `patients_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
