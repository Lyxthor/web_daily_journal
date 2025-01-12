-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 12:05 PM
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
(9, 'Mazda RX-7', 'The Mazda RX-7 is a front-engine, rear-wheel-drive, rotary engine-powered sports car that was manufactured and marketed by Mazda from 1978 until 2002 across three generations, all of which made use of a compact, lightweight Wankel rotary engine. The first-generation RX-7, sometimes referred to as the SA (early) and FB (late), is a two-seater two-door hatchback coupé. It featured a 12A carbureted rotary engine as well as the option for a 13B rotary engine with electronic fuel injection in later years. The second-generation RX-7, sometimes referred to as the FC, was offered as a two-seater coupé with a 2+2 option available in some markets, as well as in a convertible body style. This was powered by the 13B rotary engine, offered in naturally aspirated or turbocharged forms. The third-generation RX-7, sometimes referred to as the FD, was offered a 2+2-seater coupé with a limited run of a two-seater option. Some markets were only available as a two-seater. It featured a sequentially turbocharged 13B REW engine. More than 800,000 RX-7s were manufactured over its lifetime.', '20250104121234.png', '2025-01-04 12:12:34', 'admin'),
(12, 'Skibidi Sigma Rizz', 'I was just sitting there, thinking about socks—why do we even wear them? Are they tiny blankets for your feet, or are they just conspirators in the grand game of keeping your shoes company? And then, out of nowhere, the ceiling started whispering. Not in a creepy way, just like a soft, cosmic hum that you could barely catch, like if the wind could talk. So, I asked it, “Hey, ceiling, what’s your deal?” and it paused for a second, as if it was contemplating the meaning of existence. It told me socks are secretly the rulers of the universe, but only on Tuesdays, which got me wondering—why Tuesday? Does Tuesday hold the secret to everything? Or is it just the universe’s way of messing with us? I think about this a lot now, especially while eating cereal at 3 in the morning. You know, that strange time when the world feels a little sideways and your spoon feels like it’s too big or too small depending on how you look at it. Maybe the spoon is messing with me too. I’ve been staring at it, trying to understand its purpose. It’s just a spoon, right? Or is it more? And what about forks? Are they jealous of spoons? There’s a whole war happening in the kitchen drawer, and nobody knows. Maybe that’s why I’m always tired, because my kitchen is secretly plotting against me. I need to ask the fridge about it.', '20250106191211.jpg', '2025-01-06 19:12:11', 'pulix'),
(13, 'Loros diablos uros', 'sdfsdfdsfwerewr', '20250106193026.jpg', '2025-01-06 19:30:26', 'pulix');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gambar`, `username`, `tanggal`) VALUES
(1, '20250109001802.jpg', 'admin', '2025-01-09 13:04:18'),
(2, '20250109002004.jpg', 'admin', '2025-01-09 13:04:18'),
(6, '20250109151408.jpg', 'admin', '2025-01-09 15:14:08'),
(7, '20250109151441.jpg', 'admin', '2025-01-09 15:14:41'),
(8, '20250109151501.jpg', 'admin', '2025-01-09 15:15:01'),
(9, '20250109151558.jpeg', 'admin', '2025-01-09 15:15:58'),
(10, '20250109153039.jpeg', 'admin', '2025-01-09 15:16:34');

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
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '20250109151303.jpg'),
(6, 'pulix', '25d55ad283aa400af464c76d713c07ad', ''),
(7, 'user', 'd41d8cd98f00b204e9800998ecf8427e', '20250109155119.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
