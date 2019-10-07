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
-- Table structure for table `user_winning_number`
--

CREATE TABLE `user_winning_number` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `lucky_number` int(10) NOT NULL,
  `prize` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_winning_number`
--

INSERT INTO `user_winning_number` (`id`, `user_id`, `lucky_number`, `prize`, `created_date`) VALUES
(1, 1, 1111, '', '2019-10-05 00:00:00'),
(2, 2, 2222, '', '2019-10-05 00:00:00'),
(3, 3, 3333, '', '2019-10-05 00:00:00'),
(4, 4, 4444, '', '2019-10-05 00:00:00'),
(5, 2, 8888, 'grand_winner', '2019-10-06 00:00:00'),
(6, 4, 9999, '', '2019-10-06 00:00:00'),
(7, 7, 1234, '', '2019-10-06 00:00:00'),
(8, 6, 4321, '', '2019-10-06 00:00:00'),
(9, 5, 6785, '', '2019-10-06 00:00:00'),
(10, 8, 2354, 'second_first_winner', '2019-10-06 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_winning_number`
--
ALTER TABLE `user_winning_number`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_winning_number`
--
ALTER TABLE `user_winning_number`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
