-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 10:04 AM
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
-- Database: `company-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ID` int(5) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `start_year` year(4) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adress` varchar(50) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ID`, `fname`, `lname`, `title`, `start_year`, `phone`, `email`, `adress`, `postal_code`, `city`) VALUES
(1, 'kalle', 'kehittäjä', 'Developer', '2008', '+358 123123', 'kalle@firma.com', 'devvägen 1', '00100', 'helsinki'),
(2, 'tepp', 'Testaaja', 'Test engineer', '2009', '+358 312321', 'teppo@firma.com', 'testtie 2', '00100', 'helsinki'),
(3, 'derek', 'dirka', 'CEO', '2002', '+358 312322', 'derek@firma.com', 'chiefstreet', '00100', 'helsinki'),
(4, 'sipe', 'sihteeri', 'secretary', '2008', '+358 020202', 'sipa@firma.com', 'gångvägen 1', '01510', 'vanda');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
