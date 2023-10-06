-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 09:46 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contoh`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_superuser` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `is_superuser`) VALUES
(1, 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID_NO` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `Place_of_Birth` varchar(30) NOT NULL,
  `Date_of_Birth` varchar(30) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Phone_Number` varchar(10) NOT NULL,
  `Position` varchar(15) NOT NULL,
  `status` varchar(200) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `Tasks` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID_NO`, `name`, `Place_of_Birth`, `Date_of_Birth`, `Address`, `Phone_Number`, `Position`, `status`, `username`, `password`, `Tasks`) VALUES
('1234', 'Jake', 'Kenya', '2023-07-02', 'Nairobi', '0789789777', 'Operator', '', 'jake', 'jake1234', 'Upgrade Server RAM'),
('12345', 'Kate', 'Kenya ', '2023-07-01', 'Nairobi', '078919919', 'Operator', '', 'kate', 'kate123', 'Troubleshoot Network Connectivity Issue');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_title` varchar(100) NOT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_title`, `due_date`) VALUES
(1, 'Install Operating System on New Workstation', '2023-07-20'),
(2, 'Configure Network Switches', '2023-07-25'),
(3, 'Troubleshoot Network Connectivity Issue', '2023-07-22'),
(4, 'Upgrade Server RAM', '2023-07-26'),
(5, 'Install Software Updates', '2023-07-24'),
(6, 'Set Up New Employee Account', '2023-07-21'),
(7, 'Backup Database', '2023-07-23'),
(8, 'Monitor Server Health', '2023-07-28'),
(9, 'Configure Firewall Rules', '2023-07-27'),
(10, 'Implement Data Security Policy', '2023-07-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ID_NO`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
