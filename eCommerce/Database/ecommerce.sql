-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2020 at 06:24 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `parent` int(11) NOT NULL,
  `ordering` int(11) DEFAULT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(4) NOT NULL DEFAULT '0',
  `allow_ads` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`, `parent`, `ordering`, `visibility`, `allow_comment`, `allow_ads`) VALUES
(9, 'Computers', '', 0, 1, 0, 0, 0),
(10, 'Electronics', '', 0, 2, 0, 0, 0),
(11, 'Clothing', '', 0, 3, 0, 0, 0),
(12, 'Tools', '', 0, 4, 0, 0, 0),
(13, 'Hand Made', '', 0, 5, 0, 0, 0),
(14, 'sub clothing', '', 11, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment`, `status`, `date`, `item_id`, `user_id`) VALUES
(14, 'first comment', 1, '2019-09-07', 24, 33),
(15, 'second comment', 0, '2019-09-07', 23, 34),
(16, 'Third comment', 0, '2019-09-07', 23, 34),
(33, 'mohamed', 0, '2019-09-09', 23, 35),
(34, 'This fantastic', 0, '2019-11-15', 24, 35);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `country_made` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `approve` tinyint(4) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `description`, `price`, `date`, `country_made`, `image`, `status`, `rating`, `approve`, `category_id`, `member_id`) VALUES
(21, 'mouse', 'Wirless Mouse Very Fantastic', '$10', '2019-09-05', 'Egypt', '', '1', '', 1, 9, 34),
(22, 'keyboard', 'A Nice Keyboard', '$30', '2019-09-05', 'China', '', '2', '', 1, 9, 33),
(23, 'Microphone', 'Very Fantastic microphone', '$20', '2019-09-05', 'Europe', '', '3', '', 1, 9, 34),
(24, 'Headphone', 'Old HeadPhone ', '$5', '2019-09-05', 'China', '', '4', '', 1, 9, 34),
(25, 'T-shirt', 'A New T-shirt L-M-S', '$70', '2019-09-06', 'America', '', '2', '', 1, 11, 33),
(30, 'test', 'this is test', '$10', '2019-09-08', 'Egypt', '', '1', '', 0, 12, 35),
(32, 'test 3', 'this is test 3', '$66', '2019-09-09', 'Egypt', '', '1', '', 1, 12, 35);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `trust_status` int(11) NOT NULL DEFAULT '0',
  `reg_status` int(11) NOT NULL DEFAULT '0',
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `full_name`, `group_id`, `trust_status`, `reg_status`, `reg_date`) VALUES
(33, 'ahmed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'a@a.com', 'ahmed mohamed', 0, 0, 1, '2019-09-04'),
(34, 'mohamed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'm@m.com', 'Mohamed Ahmed', 1, 0, 1, '2019-09-04'),
(35, 'nada', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'n@n.com', '', 0, 0, 0, '2019-09-07'),
(36, 'ali', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'a@a.com', '', 0, 0, 0, '2019-09-07'),
(37, 'aya', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'a@a.com', '', 0, 0, 0, '2019-09-07'),
(38, 'karem', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'k@k.com', '', 0, 0, 0, '2019-09-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `Username` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_users` FOREIGN KEY (`member_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
