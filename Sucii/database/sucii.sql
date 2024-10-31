-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 06:48 PM
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
-- Database: `sucii`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment_text`, `parent_id`, `created_at`) VALUES
(5, 8, 13, 'nice', NULL, '2024-08-25 16:01:55'),
(6, 8, 9, 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', NULL, '2024-09-13 13:17:47'),
(7, 9, 9, 'blah blah', NULL, '2024-10-07 14:47:06'),
(8, 10, 9, '#apply', NULL, '2024-10-07 14:49:21'),
(9, 10, 9, '#apply', NULL, '2024-10-07 15:11:35'),
(10, 6, 14, 'Nice design keep going buddy', NULL, '2024-10-07 15:55:25'),
(11, 10, 14, '#apply', NULL, '2024-10-07 16:03:50'),
(12, 11, 9, 'i\'m still depressed dude', NULL, '2024-10-07 16:05:01'),
(13, 11, 14, 'kiza ru kara kimi nayio kimi nen dayio ', NULL, '2024-10-07 17:53:17'),
(14, 11, 14, 'kouri piono queen', NULL, '2024-10-07 17:54:40'),
(15, 10, 14, 'kiya re bhangar si shakal ke', NULL, '2024-10-10 12:54:53'),
(16, 12, 14, 'bbg', NULL, '2024-10-28 15:25:47'),
(17, 12, 14, 'hghg', NULL, '2024-10-28 15:28:02'),
(18, 11, 14, 'nice', NULL, '2024-10-29 14:05:01');

-- --------------------------------------------------------

--
-- Table structure for table `follow_list`
--

CREATE TABLE `follow_list` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `follow_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow_list`
--

INSERT INTO `follow_list` (`id`, `user_id`, `follow_id`) VALUES
(22, 12, 11),
(23, 12, 9),
(26, 11, 9),
(27, 11, 12),
(28, 13, 9),
(29, 13, 12),
(33, 9, 13),
(34, 9, 12),
(41, 9, 14),
(45, 14, 13),
(46, 14, 12),
(47, 14, 9),
(48, 13, 14);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `post_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(19, 6, 11),
(20, 8, 12),
(22, 7, 11),
(23, 8, 11),
(24, 8, 13),
(25, 9, 9),
(26, 6, 9),
(27, 11, 14),
(28, 12, 14);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(255) NOT NULL,
  `from_msg_id` int(255) NOT NULL,
  `to_msg_id` int(255) NOT NULL,
  `msg` text NOT NULL,
  `msg_status` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `from_msg_id`, `to_msg_id`, `msg`, `msg_status`, `created_at`) VALUES
(28, 9, 14, 'hii', 0, '2024-10-29 12:53:13'),
(29, 9, 14, 'how are you ?', 0, '2024-10-29 13:01:19'),
(30, 14, 9, 'im good', 0, '2024-10-29 13:02:09'),
(31, 9, 14, 'ggggg', 0, '2024-10-29 13:09:55'),
(32, 14, 9, 'ok', 0, '2024-10-29 13:17:33'),
(33, 14, 9, 'idu', 0, '2024-10-29 13:17:53'),
(34, 9, 14, 'so what', 0, '2024-10-29 13:19:12'),
(35, 9, 14, 'try to undrstand', 0, '2024-10-29 13:20:28'),
(36, 14, 9, 'speling is wrong', 0, '2024-10-29 13:20:50'),
(37, 13, 14, 'hi', 0, '2024-10-29 13:26:27'),
(38, 14, 13, 'yo', 0, '2024-10-29 13:27:18'),
(39, 14, 9, 'bbg', 0, '2024-10-29 13:37:08'),
(40, 14, 9, 'hhh', 0, '2024-10-29 13:45:46'),
(41, 14, 9, 'ggg', 0, '2024-10-29 13:54:47'),
(42, 14, 13, 'hh', 0, '2024-10-29 14:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_image` text NOT NULL,
  `post_des` text NOT NULL,
  `posted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_image`, `post_des`, `posted_at`) VALUES
(5, 11, '1723468078download.jpeg', 'Another April has passed without you!', '2024-08-12 13:07:58'),
(6, 9, '17237316861723467792asset 9 (1).png', 'My first Ever Perfect design i have made', '2024-08-15 14:21:26'),
(7, 11, '1723731857post4.jpg', '', '2024-08-15 14:24:17'),
(8, 9, '1723731893post5.jpg', '', '2024-08-15 14:24:53'),
(9, 13, '1724601896post.jpg', 'Enjoying a party', '2024-08-25 16:04:56'),
(10, 13, '1725701486job.png', 'Hiring as company. Comment #apply for further details. ', '2024-09-07 09:31:26'),
(11, 14, '17283164561723468078download.jpeg', 'Another April is passed without you but still i\'m waiting for you kouri ', '2024-10-07 15:54:16'),
(12, 14, '1728565013post5.jpg', '', '2024-10-10 12:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `profile_pic` text NOT NULL DEFAULT 'default_profile_pic.jpg',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `acc_status` int(11) NOT NULL COMMENT '0=not varified,1=active,2=blocked'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `username`, `email`, `password`, `profile_pic`, `created_at`, `updated_at`, `acc_status`) VALUES
(9, 'Adil', 'Khan', 1, '@Adil_Khan', 'adilismail7654321@gmail.com', '$2y$10$H0/VS9K6hSGuK9R785EfaODGHm9d8yclqUCrS9M5d/Yg67eqtxI0.', '1723734059Myprofile.jpg', '2024-08-05 15:48:19', '2024-08-15 15:00:59', 1),
(12, 'Ajiro', 'Shiinpe', 1, 'Ajiro$$', 'shinpe@gmail.com', '123', 'default_profile_pic.jpg', '2024-08-17 16:47:45', '2024-10-07 15:46:22', 1),
(13, 'Adil', 'Ismail', 1, '@_Adil_Khan_.', 'adilismail54321@gmail.com', '$2y$10$mnYgxNxCUHuuw9eJAbPO6eCVcPmTtiHJlbiRaQ4723wsQavwHXLeC', '17246017671723731612profile2.jpg', '2024-08-25 15:54:44', '2024-08-25 16:02:47', 1),
(14, 'Kousei', 'Arima', 1, '@_Arima_Kousei', 'Arima_Kousei@gmail.com', '$2y$10$ZRqZVhE3o9LLJCY..sFDz.AGHIxjtvj0YES6OMvUTQ.T/Oi1CrROG', '17284003151723468078download.jpeg', '2024-10-07 15:48:28', '2024-10-29 12:45:35', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
