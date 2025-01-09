-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2025 at 07:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdailyjurnal`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text NOT NULL,
  `isi` text NOT NULL,
  `gambar` text NOT NULL,
  `tanggal` datetime NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Mazda RX-7', 'The Mazda RX-7 is a front-engine, rear-wheel-drive, rotary engine-powered sports car that was manufactured and marketed by Mazda from 1978 until 2002 across three generations, all of which made use of a compact, lightweight Wankel rotary engine.\r\n\r\nThe first-generation RX-7, sometimes referred to as the SA (early) and FB (late), is a two-seater two-door hatchback coupé. It featured a 12A carbureted rotary engine as well as the option for a 13B rotary engine with electronic fuel injection in later years.\r\n\r\nThe second-generation RX-7, sometimes referred to as the FC, was offered as a two-seater coupé with a 2+2 option available in some markets, as well as in a convertible body style. This was powered by the 13B rotary engine, offered in naturally aspirated or turbocharged forms.\r\n\r\nThe third-generation RX-7, sometimes referred to as the FD, was offered a 2+2-seater coupé with a limited run of a two-seater option. Some markets were only available as a two-seater. It featured a sequentially turbocharged 13B REW engine.\r\n\r\nMore than 800,000 RX-7s were manufactured over its lifetime.', 'mazdarx7.jpg', '2025-01-04 04:26:34', 'admin'),
(9, 'Mazda RX-7', 'The Mazda RX-7 is a front-engine, rear-wheel-drive, rotary engine-powered sports car that was manufactured and marketed by Mazda from 1978 until 2002 across three generations, all of which made use of a compact, lightweight Wankel rotary engine. The first-generation RX-7, sometimes referred to as the SA (early) and FB (late), is a two-seater two-door hatchback coupé. It featured a 12A carbureted rotary engine as well as the option for a 13B rotary engine with electronic fuel injection in later years. The second-generation RX-7, sometimes referred to as the FC, was offered as a two-seater coupé with a 2+2 option available in some markets, as well as in a convertible body style. This was powered by the 13B rotary engine, offered in naturally aspirated or turbocharged forms. The third-generation RX-7, sometimes referred to as the FD, was offered a 2+2-seater coupé with a limited run of a two-seater option. Some markets were only available as a two-seater. It featured a sequentially turbocharged 13B REW engine. More than 800,000 RX-7s were manufactured over its lifetime.', '20250104121234.png', '2025-01-04 12:12:34', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
