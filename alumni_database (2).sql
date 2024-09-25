-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 06:14 PM
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
-- Database: `alumni_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `2024-2025`
--

CREATE TABLE `2024-2025` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `section` varchar(20) NOT NULL,
  `year_graduated` year(4) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `personal_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `2024-2025`
--

INSERT INTO `2024-2025` (`id`, `student_id`, `last_name`, `first_name`, `college`, `department`, `section`, `year_graduated`, `contact_number`, `personal_email`) VALUES
(12, '54586321', 'Pimentel', 'Jerome', 'CITCS', 'ACT', 'ACT4F', '2025', '09521789463', 'pimentel@je.com'),
(14, '25289745', 'Go', 'Troy', 'CITCS', 'Co', 'CS4G', '2025', '09123456789', 'Go.troy@123.com'),
(15, '987453', 'Mamador', 'Christian', 'CITCS', 'Computer Science', 'CS4G', '2025', '987456321', 'mama@tian.com'),
(16, '78945612', 'Argame', 'Cyril Anne ', 'CITCS', 'Computer Science', 'CS4G', '2025', '987456321', 'anne@argame.com');

-- --------------------------------------------------------

--
-- Table structure for table `2024-2025-ws`
--

CREATE TABLE `2024-2025-ws` (
  `alumni_id` varchar(11) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `year_graduated` year(4) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `personal_email` varchar(100) NOT NULL,
  `working_status` enum('Employed','Unemployed','Self-Employed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `2024-2025-ws`
--

INSERT INTO `2024-2025-ws` (`alumni_id`, `last_name`, `first_name`, `department`, `year_graduated`, `contact_no`, `personal_email`, `working_status`) VALUES
('10', 'Mamador', 'Christian', 'Computer Science', '2025', '987456321', 'mama@tian.com', 'Employed'),
('CS867', 'Argame', 'Cyril Anne ', 'Computer Science', '2025', '987456321', 'anne@argame.com', 'Employed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `2024-2025`
--
ALTER TABLE `2024-2025`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `2024-2025-ws`
--
ALTER TABLE `2024-2025-ws`
  ADD PRIMARY KEY (`alumni_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `2024-2025`
--
ALTER TABLE `2024-2025`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
