-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2019 at 07:10 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lucky_draw`
--

-- --------------------------------------------------------

--
-- Table structure for table `winner_result`
--

CREATE TABLE `winner_result` (
  `id` bigint(20) NOT NULL,
  `grand_winner` bigint(20) DEFAULT NULL,
  `second_first_winner` bigint(20) DEFAULT NULL,
  `second_second_winner` bigint(20) DEFAULT NULL,
  `third_first_winner` bigint(20) DEFAULT NULL,
  `third_second_winner` bigint(20) DEFAULT NULL,
  `third_third_winner` bigint(20) DEFAULT NULL,
  `round` int(10) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `winner_result`
--

INSERT INTO `winner_result` (`id`, `grand_winner`, `second_first_winner`, `second_second_winner`, `third_first_winner`, `third_second_winner`, `third_third_winner`, `round`, `created_date`, `updated_date`) VALUES
(1, 8888, 2354, NULL, NULL, NULL, NULL, NULL, '2019-10-06 14:14:07', '2019-10-06 15:30:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `winner_result`
--
ALTER TABLE `winner_result`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `winner_result`
--
ALTER TABLE `winner_result`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
