-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2021 at 10:48 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentable_id` bigint(20) UNSIGNED NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `hide` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `parent_id`, `comment`, `commentable_id`, `commentable_type`, `image`, `hide`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'sadasd\r\nasd\r\nasd\r\nasd', 1, 'App\\Models\\Post', '1_1612468748.jpeg', 0, '2021-01-04 16:29:08', '2021-02-05 16:19:19'),
(2, 1, NULL, 'wow', 1, 'App\\Models\\Post', '', 0, '2021-02-04 16:32:25', '2021-02-04 16:32:25'),
(3, 1, NULL, 'WTF Brooo', 1, 'App\\Models\\Post', '1_1612469061.jpeg', 0, '2021-02-04 16:34:21', '2021-02-05 04:30:09'),
(4, 1, NULL, 'aaa', 1, 'App\\Models\\Post', '', 1, '2021-02-04 16:39:41', '2021-02-05 16:04:45'),
(5, 1, 1, 'alo', 1, 'App\\Models\\Post', '', 0, '2021-02-04 16:42:24', '2021-02-04 16:42:24'),
(6, 1, 1, 'bale', 1, 'App\\Models\\Post', '', 0, '2021-02-04 16:47:38', '2021-02-05 04:20:31'),
(7, 1, 10, 'bale wow', 1, 'App\\Models\\Post', '', 0, '2021-02-04 16:50:57', '2021-02-04 16:50:57'),
(8, 1, 3, 'WTF????!!!', 1, 'App\\Models\\Post', '', 0, '2021-02-04 17:01:29', '2021-02-04 17:01:29'),
(9, 1, NULL, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 1, 'App\\Models\\Post', '', 0, '2021-02-04 17:23:45', '2021-02-04 17:23:45'),
(10, 1, 9, 'asasasasas', 1, 'App\\Models\\Post', '', 0, '2021-02-04 17:23:54', '2021-02-04 17:23:54'),
(11, 1, 8, 'asasasasas', 1, 'App\\Models\\Post', '', 0, '2021-02-04 17:38:30', '2021-02-04 17:38:30'),
(12, 1, 11, 'WTF?', 1, 'App\\Models\\Post', '', 0, '2021-02-04 17:38:37', '2021-02-04 17:38:37'),
(13, 2, 6, 'اسپم نکن', 1, 'App\\Models\\Post', '', 0, '2021-02-04 18:17:18', '2021-02-05 04:29:28'),
(14, 1, 11, 'چی میگیت تو؟', 1, 'App\\Models\\Post', '', 0, '2021-02-05 03:38:23', '2021-02-05 03:38:23'),
(15, 1, 8, 'باشه', 1, 'App\\Models\\Post', '', 0, '2021-02-05 03:38:35', '2021-02-05 03:38:35'),
(16, 2, NULL, 'بازی خوبیه آره حال کردم باهاش', 2, 'App\\Models\\Post', '_1612525140.png', 0, '2021-02-05 08:09:00', '2021-02-05 08:18:00'),
(17, 2, NULL, 'HAHAHAHAH', 2, 'App\\Models\\Post', '_1612534502.jpeg', 0, '2021-02-05 10:45:02', '2021-02-05 10:45:02'),
(18, 3, 1, 'har har har', 1, 'App\\Models\\Post', '', 0, '2021-02-05 17:28:04', '2021-02-05 17:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followables`
--

CREATE TABLE `followables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `followable_id` bigint(20) UNSIGNED NOT NULL,
  `followable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `followables`
--

INSERT INTO `followables` (`id`, `user_id`, `followable_id`, `followable_type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'App\\Models\\Post', NULL, NULL),
(6, 2, 2, 'App\\Models\\Post', NULL, NULL),
(8, 2, 3, 'App\\Models\\Post', NULL, NULL),
(10, 2, 1, 'App\\Models\\Post', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `game_studios`
--

CREATE TABLE `game_studios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `founded_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_img` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_29_153602_create_comments_table', 1),
(5, '2020_11_29_154503_create_posts_table', 1),
(6, '2020_12_07_124323_create_votes_table', 1),
(7, '2021_02_04_130202_create_game_studios_table', 1),
(8, '2021_02_04_135008_create_follow_table', 1),
(9, '2021_02_04_135855_create_report_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` enum('unreleased','uncracked','cracked','freeDRM') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unreleased',
  `release_date` date NOT NULL,
  `crack_date` date DEFAULT NULL,
  `game_studio_id` bigint(20) UNSIGNED DEFAULT NULL,
  `game_studio_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `back_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `screen_shots` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '[]',
  `system` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '{"min":{"os":"none","cpu":"none","ram":"none","gpu":"none","hdd":"none"},"rec":{"os":"none","cpu":"none","ram":"none","gpu":"none","hdd":"none"}}',
  `prices` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '{"epic":{"price":"0","url":""},"steam":{"price":"0","url":""}}',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `description`, `state`, `release_date`, `crack_date`, `game_studio_id`, `game_studio_name`, `image`, `header`, `back_image`, `video_link`, `screen_shots`, `system`, `prices`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Red Dead Redemption 2', 'RDR2', 'RDR2, as the game is affectionately known, was released for other platforms before the PC release, and this saw the game gaining the title of best-selling game of all time, before the PC game figures were included. The reason for the game’s popularity is not hard to see.\r\n\r\nUnlike games where mayhem and destruction are key, this game allows you to sink into the beauty of the Wild West scenery, and to form empathic and sympathetic bonds with other players and NPCs (non-playing characters) in the moments between the action driven sequences – of which there are also many.\r\n\r\nYou play as Arthur Morgan, a member of the Van der Linde Gang, and the linear storyline guides play through set story arcs, with Arthur completing missions and achieving objectives as he goes along, guided by the overall narrative.\r\n\r\nOnce each mission is complete, Arthur is free to wander the open world, exploring widely and uncovering new places and, occasionally, stumbling onto his next mission which he can play through before returning to his original point to continue from there.\r\n\r\nDespite the tightly plotted story arcs, the game is strongly player driven, with your decisions deciding where the game will take you next. You can linger along each journey, catching villains committing crimes, helping people in distress and helping them with side missions, or you can pass them by, ignoring all the NPCs in your determination to get to your next destination.', 'unreleased', '2020-11-10', NULL, NULL, 'Rocstar Game', 'RDR2_image_1612535066.png', 'RDR2_header_1612535066.png', 'RDR2_backimg_1612534835.png', 'https://www.youtube.com/embed/gmA6MrX81z4', '[\"RDR2_scr1_1612534835.jpeg\",\"RDR2_scr2_1612534835.jpeg\",\"RDR2_scr3_1612534835.jpeg\",\"RDR2_scr4_1612534835.jpeg\"]', '{\"min\":{\"os\":\"Windows 7\",\"cpu\":\"Intel Core i5-2500K \\/ AMD FX-6300\",\"ram\":\"8 GB\",\"gpu\":\"Nvidia GeForce GTX 770 2 Go \\/ AMD Radeon R9 280 3 Go\",\"hdd\":\"150 GB\"},\"rec\":{\"os\":\"Windows 10 (v1803)\",\"cpu\":\"Intel Core i7-4770K \\/ AMD Ryzen 5 1500X\",\"ram\":\"12 GB\",\"gpu\":\"Nvidia GeForce GTX 1060 6 Go \\/ AMD Radeon RX 480 4Go\",\"hdd\":\"150 GB\"}}', '{\"epic\":{\"price\":\"59.99$\",\"url\":\"https:\\/\\/epicgames.com\\/\"},\"steam\":{\"price\":\"59.99$\",\"url\":\"https:\\/\\/store.steampowered.com\\/\"}}', '2021-02-04 19:51:22', '2021-02-05 10:56:37'),
(2, 2, 'GTA VI', 'GTAVI', 'NO DESCRIPTION', 'unreleased', '2022-03-01', NULL, NULL, 'Rock Star games', '_image_1612522820.jpeg', '_header_1612522820.jpeg', '_backimg_1612522820.jpeg', 'none', '[\"_scr1_1612522820.jpeg\",\"_scr2_1612522820.jpeg\",\"_scr3_1612522820.jpeg\",\"_scr4_1612522820.jpeg\"]', '{\"min\":{\"os\":\"none\",\"cpu\":\"none\",\"ram\":\"none\",\"gpu\":\"none\",\"hdd\":\"none\"},\"rec\":{\"os\":\"none\",\"cpu\":\"none\",\"ram\":\"none\",\"gpu\":\"none\",\"hdd\":\"none\"}}', '{\"epic\":{\"price\":\"none\",\"url\":\"none\"},\"steam\":{\"price\":\"none\",\"url\":\"none\"}}', '2021-02-05 07:30:20', '2021-02-05 07:30:20'),
(3, 2, 'Red Dead Redemption 3', 'RDR3', 'NO DESCRIPTION', 'unreleased', '2019-11-10', '2020-11-10', NULL, 'Rock Star games', 'RDR3_image_1612540078.png', 'RDR3_header_1612540078.jpeg', 'RDR3_backimg_1612540078.jpeg', 'none', '[\"RDR3_scr1_1612540078.jpeg\",\"RDR3_scr2_1612540078.jpeg\",\"RDR3_scr3_1612540078.jpeg\",\"RDR3_scr4_1612540078.jpeg\"]', '{\"min\":{\"os\":\"none\",\"cpu\":\"none\",\"ram\":\"none\",\"gpu\":\"none\",\"hdd\":\"none\"},\"rec\":{\"os\":\"none\",\"cpu\":\"none\",\"ram\":\"none\",\"gpu\":\"none\",\"hdd\":\"none\"}}', '{\"epic\":{\"price\":\"none\",\"url\":\"20$\"},\"steam\":{\"price\":\"20$\",\"url\":\"none\"}}', '2021-02-05 12:17:58', '2021-02-05 12:17:58'),
(4, 2, 'CYBERPUNK 2077', 'CYBERPUNK-2077', '\"Seven years in the making, Cyberpunk 2077 looks to be living up to all the hype generated by its introduction at E3 in 2019.\r\n\r\nSet fifty-seven years after the table-top game upon which it is based, Cyberpunk 2020, the graphics are exquisitely rendered with characters, scenery and even actions and movements so realistic that they could be mistaken for movie footage.\r\n\r\nAs you play through the narrative driven game, it is possible to play without killing any other characters, using non-lethal weaponry and strategies that keep you out of serious confrontations of the sort that tend to become lethal.\r\n\r\nThe game features full nudity, as players are able to upgrade their bodies with modifications that give them extra powers and capabilities, and they need to strip down in order to fit their new limbs and attachments.\"', 'unreleased', '2020-12-10', '2020-12-10', NULL, 'Cd Red Project', 'CYBERPUNK-2077_image_1612604506.png', 'CYBERPUNK-2077_header_1612604506.png', 'CYBERPUNK-2077_backimg_1612604507.png', 'https://www.youtube.com/embed/BO8lX3hDU30', '[\"CYBERPUNK-2077_scr1_1612604507.jpg\",\"CYBERPUNK-2077_scr2_1612604507.jpg\",\"CYBERPUNK-2077_scr3_1612604507.jpg\",\"CYBERPUNK-2077_scr4_1612604507.jpg\"]', '{\"min\":{\"os\":\"Windows 7\",\"cpu\":\"Intel Core i5-2500K \\/ AMD FX-6300\",\"ram\":\"8 GB\",\"gpu\":\"Nvidia GeForce GTX 770 2 Go \\/ AMD Radeon R9 280 3 Go\",\"hdd\":\"150 GB\"},\"rec\":{\"os\":\"Windows 10 (v1803)\",\"cpu\":\"Intel Core i7-4770K \\/ AMD Ryzen 5 1500X\",\"ram\":\"12 GB\",\"gpu\":\"Nvidia GeForce GTX 1060 6 Go \\/ AMD Radeon RX 480 4Go\",\"hdd\":\"150 GB\"}}', '{\"epic\":{\"price\":\"https:\\/\\/store.steampowered.com\\/\",\"url\":\"56$\"},\"steam\":{\"price\":\"56$\",\"url\":\"https:\\/\\/epicgames.com\\/\"}}', '2021-02-06 06:11:47', '2021-02-06 06:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reportable_id` bigint(20) UNSIGNED NOT NULL,
  `reportable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.jpg',
  `header` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gamer_header.jpg',
  `karma` bigint(20) NOT NULL DEFAULT 0,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No description',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles`, `avatar`, `header`, `karma`, `description`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'JA303', 'a5213287@gmail.com', NULL, '$2y$10$tTsFGVKJOqg5jvHuCPUWgOnHfsqmrxj0Rpygu187kHYrdiDlKzEey', '[\"user\"]', 'user.jpg', 'gamer_header.jpg', 7, 'Hello World', NULL, '2021-02-04 16:21:48', '2021-02-06 06:13:43', NULL),
(2, 'alien', 'jefek785891234@um.ac.ir', NULL, '$2y$10$uy2YAxiLXKiUktVs6RaVzep9wL.qBEyBSqE/vUAPJDX49xoGOM89q', '[\"user\",\"admin\"]', '2_avatar_1612511454.png', 'gamer_header.jpg', 29, 'No description', NULL, '2021-02-04 17:58:46', '2021-02-06 06:11:47', NULL),
(3, 'TheBigSheikh', 'a5287@gmail.com', NULL, '$2y$10$bWld8Cni48xRC9h86dMqk.iWRof0XL4mDNYnNYnErBuSYA./WKgbG', '[\"user\"]', '3_avatar_1612558642.jpeg', 'gamer_header.jpg', 0, 'No description', NULL, '2021-02-05 17:27:00', '2021-02-05 18:32:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `up_vote` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `comment_id`, `up_vote`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '2021-02-04 18:02:55', '2021-02-04 18:09:18'),
(2, 2, 5, 1, '2021-02-04 18:09:46', '2021-02-05 10:15:50'),
(3, 2, 6, 1, '2021-02-04 18:09:48', '2021-02-04 18:09:48'),
(4, 2, 2, 1, '2021-02-04 18:16:55', '2021-02-06 06:13:43'),
(5, 3, 12, 1, '2021-02-05 17:41:08', '2021-02-05 17:41:08'),
(6, 3, 6, 1, '2021-02-05 17:41:54', '2021-02-05 17:54:45'),
(7, 3, 1, 1, '2021-02-05 17:42:09', '2021-02-05 17:42:09'),
(8, 3, 5, 1, '2021-02-05 17:42:11', '2021-02-05 17:54:42'),
(9, 3, 13, 0, '2021-02-05 17:54:48', '2021-02-05 17:54:49'),
(10, 2, 10, 0, '2021-02-06 06:13:36', '2021-02-06 06:13:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `followables`
--
ALTER TABLE `followables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followables_user_id_foreign` (`user_id`);

--
-- Indexes for table `game_studios`
--
ALTER TABLE `game_studios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `votes_user_id_foreign` (`user_id`),
  ADD KEY `votes_comment_id_foreign` (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followables`
--
ALTER TABLE `followables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `game_studios`
--
ALTER TABLE `game_studios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `followables`
--
ALTER TABLE `followables`
  ADD CONSTRAINT `followables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
