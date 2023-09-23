-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: 23.09.2023 klo 22:44
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
CREATE DATABASE IF NOT EXISTS `php_docker` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `php_docker`;

-- --------------------------------------------------------

--
-- Rakenne taululle `drinks`
--

CREATE TABLE `drinks` (
  `id` int NOT NULL,
  `image_url` text NOT NULL,
  `drink_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `drinks`
--

INSERT INTO `drinks` (`id`, `image_url`, `drink_name`, `descr`, `approved`) VALUES
(1, 'http://localhost/src/public/images/ananas_pommi.jpeg', 'Ananaspommi', 'Ananasmehua 2dl<br>\r\nVokdaa 4cl<br>\r\nAnanasviipaleita 2kpl<br>\r\nJäitä', 1),
(2, 'https://www.thespruceeats.com/thmb/XQ45ofUp63kCySlKhpIAxtBp5gg=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/rum-and-coke-recipe-760560-hero-01-368ce9f7ec9d4f2e837026712b2e1582.jpg', 'Rommi kola', 'Rommia 4cl<br>\r\nKolaa 2dl<br>\r\nJääpaloja<br>\r\nSitruunaa', 1),
(3, 'https://cookathomemom.com/wp-content/uploads/2022/12/Pineapple-Ginger-Juice-in-glasses.jpg', 'Kolapommi', 'Kolaa 2dl<br>\r\nVokdaa 4cl<br>\r\nAnanasviipaleita 2kpl<br>\r\nJäitä', 1),
(4, 'test', 'ananasjuoma', 'asrasdad', 0),
(5, 'http://localhost/src/public/includes/uploads/drink_image_23_09_2023_09_19_28_9009924391272451630', 'vellu', 'juoma on maukas', 0),
(6, 'http://localhost/src/public/includes/uploads/drink_image_23_09_2023_10_18_54_1351100330052691216', 'vellu', 'hsahsahhsads', 0),
(7, 'http://localhost/src/public/includes/uploads/drink_image_23_09_2023_10_20_24_877111926229948332', 'testi juoma', 'maukas juoma', 1),
(8, 'http://localhost/src/public/includes/uploads/drink_image_23_09_2023_10_20_24_877111926229948332', 'testi juoma', 'testi juoma', 0),
(9, 'http://localhost/src/public/includes/uploads/drink_image_23_09_2023_11_43_08_6472326628348892652', 'rarara', 'test', 0),
(10, 'http://localhost/src/public/includes/uploads/drink_image_23_09_2023_11_51_22_63920213398357053', 'testaajan juoma', 'maukasta juomaa tarjolla', 1),
(11, 'http://localhost/src/public/includes/uploads/drink_image_24_09_2023_12_39_51_2997991153782610305', 'testi juoma hehe', 'maukas maku', 1),
(12, 'http://localhost/src/public/includes/uploads/drink_image_24_09_2023_12_54_10_4683261324393448344', 'testi juom', 'maukasta', 1),
(13, 'http://localhost/src/public/includes/uploads/drink_image_24_09_2023_01_42_52_8338103216932995599', 'ananas juoma', 'maukas ananas', 0);

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
(1, 1, 5, 'This is a great drink.', 'john_doe', 0),
(2, 0, 5, 'This is a great drink.', 'john_doe', 0),
(3, 0, 5, 'This is a great drink.', 'john_doe', 0),
(4, 1, 5, 'This is a great drink.', 'john_doe', 0),
(5, 2, 5, 'This is a great drink.', 'john_doe', 0),
(6, 1, 3, 'This is a great drink.', 'john_doe', 0),
(7, 1, 4, 'This is a great drink.', 'john_doe', 0),
(8, 1, 2, 'This is a great drink.', 'john_doe', 0),
(9, 1, 2, 'This is a great drink.', 'john_doe', 0),
(10, 1, 3, 'This is a great drink.', 'john_doe', 0),
(11, 1, 2, 'This is a great drink.', 'john_doe', 0),
(12, 1, 2, 'This is a great drink.', 'john_doe', 0),
(13, 1, 4, 'This is a great drink.', 'john_doe', 0),
(14, 1, 3, 'This is a great drink.', 'john_doe', 0),
(15, 1, 4, 'This is a great drink.', '4', 0),
(16, 1, 2, 'This is a great drink.', '', 0),
(17, 1, 2, 'This is a great drink.', '[object HTMLInputElement]', 0),
(18, 1, 3, 'This is a great drink.', 'rarara', 0),
(19, 1, 3, 'This is a great drink.', 'vellu', 0),
(20, 1, 1, 'Maistui kissan karvoille onkohan mauno ollut valmistamassa juomaa', 'Senkkinen', 1),
(26, 12, 3, 'joopa juu', 'testaaja32321', 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
