-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2017 at 03:41 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `role` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `username`, `password`, `email`, `details`, `role`, `date`) VALUES
(1, 'Mahbub Rahman', 'mahbub', '81dc9bdb52d04dc20036dbd8313ed055', 'mahbubrahman5676@gmail.com', 'I am a good person for web development. I can do lot premium think...', 0, '2017-06-01 06:19:25'),
(2, 'Admn Khan', 'Admin', '81dc9bdb52d04dc20036dbd8313ed055', 'mahbubrahman5676@gmail.com', 'very good', 1, '2017-06-01 06:19:25'),
(4, '', 'Editor1', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 2, '2017-06-01 09:47:39'),
(5, '', 'Author', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2017-06-01 09:47:53'),
(6, '', 'Editor2', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 2, '2017-06-01 09:48:06'),
(7, '', 'Khan', '81dc9bdb52d04dc20036dbd8313ed055', 'mahbubrahman5673@gmail.com', '', 2, '2017-06-01 11:40:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
