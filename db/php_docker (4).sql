-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: 01.10.2023 klo 13:01
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
(27, 17, 3, 'Oli ihan ok', 'testaaja4', 1),
(28, 17, 3, 'joopa joo', 'testaaja5', 0);

-- --------------------------------------------------------

--
-- Rakenne taululle `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `hashedpassword` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) DEFAULT NULL,
  `activation_expiry` datetime DEFAULT NULL,
  `activated_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `hashedpassword`, `active`, `activation_code`, `activation_expiry`, `activated_at`, `created_at`, `updated_at`) VALUES
(18, 'testaaja', 'heheheheheh@gmail.com', 'testi124!R', '$2y$10$jkd.lYODR0.aS3qL3XGnb.GDD2qsCN6.EQEC1D5YiZHtafd6PSKL2', 0, NULL, NULL, NULL, '2023-10-01 12:38:16', '2023-10-01 12:38:16'),
(19, 'testaaja2', 'testi@gmail.com', 'testtest123!A!', '$2y$10$qRC3ZZZw76opunBN8OburOF7fT2hNuBnQuVkVInNWXM5BTQWG3YD.', 0, NULL, NULL, NULL, '2023-10-01 12:38:16', '2023-10-01 12:38:16'),
(22, 'testaaja3', 'testi2@gmail.com', 'osososORORORO1!', '$2y$10$bccPRLeKvjSOBQ5SARFQ1.IdmKLg9hAsA2T6Ucx/eSnyt5MhfJT6C', 0, NULL, NULL, NULL, '2023-10-01 12:38:16', '2023-10-01 12:38:16'),
(24, 'testaaja4', 'testaaja4@gmail.com', 'moiMOI321!x', '$2y$10$lrZyeEfGeghBZLRQhy5d9uLumQdMTyFexuX27eu6uF2FNsdGu2/sq', 0, NULL, NULL, NULL, '2023-10-01 12:38:16', '2023-10-01 12:38:16'),
(25, 'testaaja5', 'testaaja5@gmail.com', 'moiMOI321!x', '$2y$10$fkKBExuWJjYDaElbjysfBOMYMkweJsM7e1n.wF6/wmMXaIXtbZnPa', 1, NULL, NULL, '2023-10-01 13:01:02', '2023-10-01 12:38:16', '2023-10-01 12:38:16'),
(30, 'testaaja323232', 'testaja424242@gmail.com', 'satsisutsi12!\\\"A', '$2y$10$AcsPaaiuw9v81tmK.kmFoOfKtzJqIAoOr6NmF4wtIiooLx6LfsyH.', 0, NULL, NULL, NULL, '2023-10-01 12:38:16', '2023-10-01 12:38:16'),
(31, 'testaaja4232', 'testaaj232a5@gmail.com', 'satsisutsi12!\\\"A', '$2y$10$SaDEvKlPDeFilk3hWRtfGeGWYPofAsWkyMWuJQxVtyqsMhMoqpKce', 0, 'asdasd', '2023-10-02 12:46:16', NULL, '2023-10-01 12:46:16', '2023-10-01 12:46:16'),
(32, 'testaaja43232', 'testaaja23232@gmail.com', 'satsisutsi12!\\\"A', '$2y$10$dMriWbVlCKB6X6xIy/XKvOKk7RVYzFFSc7EPc1kUnawrhY/bAgpm.', 0, 'asdasd', '2023-10-02 12:47:11', NULL, '2023-10-01 12:47:11', '2023-10-01 12:47:11');

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
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
