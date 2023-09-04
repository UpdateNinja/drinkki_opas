-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: 03.09.2023 klo 19:01
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
-- Rakenne taululle `php_docker_table`
--

CREATE TABLE `php_docker_table` (
  `id` int NOT NULL,
  `image_url` text NOT NULL,
  `drink_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rating` float NOT NULL,
  `rating_qty` int NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Vedos taulusta `php_docker_table`
--

INSERT INTO `php_docker_table` (`id`, `image_url`, `drink_name`, `descr`, `rating`, `rating_qty`, `approved`) VALUES
(1, 'http://localhost/src/public/images/ananas_pommi.jpeg', 'Ananaspommi', 'Ananasmehua 2dl<br>\r\nVokdaa 4cl<br>\r\nAnanasviipaleita 2kpl<br>\r\nJäitä', 3.67948, 39, 1),
(2, 'https://www.thespruceeats.com/thmb/XQ45ofUp63kCySlKhpIAxtBp5gg=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/rum-and-coke-recipe-760560-hero-01-368ce9f7ec9d4f2e837026712b2e1582.jpg', 'Rommi kola', 'Rommia 4cl<br>\r\nKolaa 2dl<br>\r\nJääpaloja<br>\r\nSitruunaa', 3.69642, 28, 1),
(3, 'https://cookathomemom.com/wp-content/uploads/2022/12/Pineapple-Ginger-Juice-in-glasses.jpg', 'Kolapommi', 'Kolaa 2dl<br>\r\nVokdaa 4cl<br>\r\nAnanasviipaleita 2kpl<br>\r\nJäitä', 3.33333, 12, 1);

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
(20, 1, 1, 'Maistui kissan karvoille onkohan mauno ollut valmistamassa juomaa', 'Senkkinen', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `php_docker_table`
--
ALTER TABLE `php_docker_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `php_docker_table`
--
ALTER TABLE `php_docker_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
