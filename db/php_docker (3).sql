-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: 28.09.2023 klo 19:09
-- Palvelimen versio: 8.1.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_docker`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `drinks`
--

CREATE TABLE `drinks` (
  `id` int NOT NULL,
  `image_url` text NOT NULL,
  `drink_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_added` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `drinks`
--

INSERT INTO `drinks` (`id`, `image_url`, `drink_name`, `descr`, `user_added`, `date`, `approved`) VALUES
(17, 'http://localhost/src/public/includes/uploads/drink_image_28_09_2023_21_39_55_4904205739534211322', 'Maukas ananasjuoma', 'Anannas viipaleita\r\nAnanas mehua\r\nJääpaloja', 'testaaja4', '2023-09-28 21:39:55', 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int NOT NULL,
  `drink_id` int NOT NULL,
  `review_rating` float NOT NULL,
  `review_comment` text NOT NULL,
  `review_user` varchar(25) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `reviews`
--

INSERT INTO `reviews` (`review_id`, `drink_id`, `review_rating`, `review_comment`, `review_user`, `approved`) VALUES
(27, 17, 3, 'Oli ihan ok', 'testaaja4', 1);

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hashedpassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `hashedpassword`) VALUES
(18, 'testaaja', 'heheheheheh@gmail.com', 'testi124!R', '$2y$10$jkd.lYODR0.aS3qL3XGnb.GDD2qsCN6.EQEC1D5YiZHtafd6PSKL2'),
(19, 'testaaja2', 'testi@gmail.com', 'testtest123!A!', '$2y$10$qRC3ZZZw76opunBN8OburOF7fT2hNuBnQuVkVInNWXM5BTQWG3YD.'),
(22, 'testaaja3', 'testi2@gmail.com', 'osososORORORO1!', '$2y$10$bccPRLeKvjSOBQ5SARFQ1.IdmKLg9hAsA2T6Ucx/eSnyt5MhfJT6C'),
(24, 'testaaja4', 'testaaja4@gmail.com', 'moiMOI321!x', '$2y$10$lrZyeEfGeghBZLRQhy5d9uLumQdMTyFexuX27eu6uF2FNsdGu2/sq'),
(25, 'testaaja5', 'testaaja5@gmail.com', 'moiMOI321!x', '$2y$10$fkKBExuWJjYDaElbjysfBOMYMkweJsM7e1n.wF6/wmMXaIXtbZnPa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
