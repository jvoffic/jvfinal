-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 11:00 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jvfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `username`, `title`, `description`, `created_at`) VALUES
(50, 'jvoffic', 'BMW 5 Series (E34)', 'The BMW E34 is the third generation of the BMW 5 Series, which was produced from November 2, 1987 until 1996. Initially launched as a sedan in January 1988, the E34 also saw a \"Touring\" station wagon (estate) body style added in September 1992, a first for the 5 Series. BMW replaced the E34 with the E39 5 Series in December 1995, although E34 Touring models remained in production until June 1996.  The E34 generation marked the first time all-wheel drive was incorporated into the 5 Series with the 525iX, and the first V8 engine to be used in a 5 Series. The E34 also saw the introduction of stability control (ASC), traction control (ASC+T) a 6-speed manual transmission and adjustable damping (EDC) to the 5 Series range.  There was an unusually large range of engines fitted over its lifetime as nine different engine families were used. These consisted of straight-four, straight-six and V8 engines.  The E34 M5 is powered by the S38 straight-six engine and was produced in sedan and wagon body styles.', '2021-06-30 07:50:29'),
(52, 'Neo', 'Shortcuts', 'none', '2021-06-30 07:54:07'),
(53, 'Levits', 'Dzīves gudrība', 'Ja nav diena, tad ir nakts.', '2021-06-30 07:56:36'),
(54, 'RigaCoding', 'ATVĒRTO DURVJU DIENA', 'Vēlies pārkvalificēties par IT speciālistu un uzsākt mācības programmēšanā? Gaidīsim Tevi Riga Coding School atvērto durvju dienā! Mēs labprāt atbildēsim uz Taviem jautājumiem, palīdzēsim izvēleties piemērotākās apmācības, kā arī pastāstīsim par darba vai prakses iespējām pēc absolvēšanas.  Kad: 30.jūnijā no 10.00-17.00  Kur: Atvērto durvju diena norisināsies gan neklātienē, gan klātienē, iepriekš sazinoties ar mums un vienojoties par laiku.  Reģistrācija: Aizpildi anketu zemāk  Vairāk informācijas par apmācībām, atradīsi šeit  Raksti vai zvani mums, būsim priecīgi Tev palīdzēt!', '2021-06-30 07:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'jvoffic', '$2y$10$4es94ZmSfVONjZmCUtgQSOXy5Vn9tjPu3Aa5m/r1vCVVb7x5lM5SG', '2021-06-16 10:29:44'),
(11, '', '$2y$10$KDUD3LBb4Et4hQTPiNlJu.QmyO3LjD9zzie7o2fvoJBAr9kJxIPja', '2021-06-30 06:53:36'),
(12, 'Neo', '$2y$10$OkADOZ.Ghqvh65hd.uD0WORBEwhAF.rt.VDkAIsgHjG0u2iEN5uFO', '2021-06-30 07:51:06'),
(13, 'Levits', '$2y$10$Hdz1XgNB2wLSsM.2Dda2EuYpyex7iidwyq1B/YBmEBM7xWPaBdyDC', '2021-06-30 07:54:27'),
(14, 'RigaCoding', '$2y$10$DRZf0NDJC6CVxFUz2d193uE7M6hx91WOtKWepYcG1phJUlB3lwg96', '2021-06-30 07:57:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
