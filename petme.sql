-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2020 at 05:01 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petme`
--

-- --------------------------------------------------------

--
-- Table structure for table `petcomments`
--

CREATE TABLE `petcomments` (
  `id` int(11) NOT NULL,
  `userid` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `petid` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` enum('google','facebook','twitter','linkedin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'google',
  `oauth_uid` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture`, `created`, `modified`) VALUES
(3, 'google', '103475552762852955634', 'Joemar', 'GotThis', 'joemarpogi67@gmail.com', '', 'en-GB', 'https://lh3.googleusercontent.com/a-/AOh14GgS152dxAN54aDxciukBZGhZhh4YQriIbCyZKo=s96-c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'google', '111361352400308369988', 'SIERE', 'TV', 'bacleaanjoemar22@gmail.com', '', 'en', 'https://lh3.googleusercontent.com/a-/AOh14GhrbC4PQu_DHQynkPaHX4WdC_OWHXpv4z3AnZX5=s96-c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'google', '101786914044571118040', 'Joemar', 'Baclea-an', 'b.joemar123@gmail.com', '', 'en', 'https://lh3.googleusercontent.com/a-/AOh14GjvSD7CMYoX6pbZAgdjut_SBhOyfs_wR1fy2Wwj=s96-c', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `petcomments`
--
ALTER TABLE `petcomments`
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
-- AUTO_INCREMENT for table `petcomments`
--
ALTER TABLE `petcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
