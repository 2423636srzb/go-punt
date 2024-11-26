-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2024 at 07:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `betdalal`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `game_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_assigned` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `game_id`, `username`, `password`, `is_assigned`, `created_at`, `updated_at`) VALUES
(18, 6, '123', '123456', 1, '2024-11-13 09:30:42', '2024-11-13 09:30:42'),
(19, 4, '234', '33', 1, '2024-11-13 09:30:42', '2024-11-13 09:30:42'),
(20, 6, 'ats@uah.com', '2323', 1, '2024-11-13 09:30:42', '2024-11-13 09:30:42'),
(21, 6, 'hello@yahoo.com', '2323', 1, '2024-11-13 09:30:42', '2024-11-13 09:30:42'),
(22, 6, 'hameed@yahoo.com', '6846237', 0, '2024-11-13 09:52:13', '2024-11-13 09:52:13'),
(23, 4, 'asdsad@yaho.com', 'sasd88', 1, '2024-11-13 09:57:51', '2024-11-13 09:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `iban_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `user_id`, `bank_name`, `account_number`, `account_holder_name`, `iban_number`, `created_at`, `updated_at`) VALUES
(1, 7, 'Mezaan Bank Pvt Ltd', '00998986055978', 'Hameed', '897654568', '2024-11-14 12:37:51', '2024-11-14 12:37:51'),
(2, 7, 'asdasd', 'asdasd', 'asdad', 'adasdasd', '2024-11-14 12:47:10', '2024-11-14 12:47:10'),
(3, 7, 'asdasd', 'asdasd', 'asdad', 'adasdasd', '2024-11-14 12:47:22', '2024-11-14 12:47:22'),
(4, 7, 'asdasd', 'asdads', 'asdsad', 'asd', '2024-11-14 12:47:41', '2024-11-14 12:47:41'),
(5, 7, 'asdad', 'asad', 'asdad', 'asdasd', '2024-11-14 12:49:46', '2024-11-14 12:49:46'),
(6, 7, 'asdad', 'asdasd', 'asdad', 'asdasd', '2024-11-14 12:49:57', '2024-11-14 12:49:57'),
(9, 1, 'asdasd', '2423423', 'asds', 'asdasd', '2024-11-14 13:46:32', '2024-11-14 13:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `login_link` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Platforms';

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `logo`, `login_link`, `status`, `created_at`, `updated_at`) VALUES
(4, 'asd asdas das', 'logos/vNy5Blf2xkMGorJespEdYKDuE2Gi7vNFGzVpb5UT.png', 'https://aasd.com', 'active', '2024-11-10 01:23:26', '2024-11-13 12:14:33'),
(6, 'asdad', 'logos/F9BfTccc0AoZG6TQcU6ni5Nynp6QuArU2Hlgwryn.png', 'https://asda.com', 'active', '2024-11-10 03:18:18', '2024-11-13 08:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_09_202947_create_games_table', 2),
(5, '2024_11_10_132404_create_user_games_table', 3),
(6, '2024_11_14_172133_create_bank_accounts_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ATpiMafOBbqaxr3IQj9vguSGe6SpPFA9fbIbpnWQ', NULL, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVXZnbTk3ZTU5OFZYamg4SHVIRVZSbGpXU1NvNGZ1dFVleEZCRWlrZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3QvYmV0ZGFsYWwvcHVibGljIjt9fQ==', 1731673643),
('BVphkyGpRmqjREaHHLpNqvjcJTDzkgKvlUmaNYbe', 3, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSWtPVVV2aTF2ZTQwa0lxZE1ZMmdiWjI3YmNDTHdXakZPWkdTNFhLUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9sb2NhbGhvc3QvYmV0ZGFsYWwvcHVibGljL2Rvd25sb2FkLXNhbXBsZSI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1731689865),
('e903dGzUsWXEbwozRIT73a0xYowwnW30a5teeJm4', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRFY1cWJ5cVVCRHRMYmc2dVRGSFlTZnVtZm85YXJsV09LV2taSGg5TCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9sb2NhbGhvc3QvYmV0ZGFsYWwvcHVibGljL3BheW1lbnQvcmVxdWVzdCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1731613674);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `profile_image` varchar(250) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `phone_number`, `remember_token`, `is_admin`, `profile_image`, `language`, `description`, `user_status`, `created_at`, `updated_at`) VALUES
(1, 'HAmeed', 'hameed', 'hameed@yahoo.com', NULL, '$2y$12$PGc3xB13b8lApRBNkJzxJ.kdS7ZKa4fBAq9ZO8J5BvBfS.l2kyypO', '030090909092', 'wKQ8PUErZbE5dbeQP9TdRWYY90iby6AyXUTblHzPV4EwlxAyiAZ19XPCexCw', 0, 'profile_1.jpg', 'English', 'Hello this is test', 'active', '2024-11-09 08:50:57', '2024-11-14 13:48:32'),
(2, 'hameed', 'hameed', 'hameed2222@yaho.com', NULL, '$2y$12$3TMFXcv.6BnKLFzYX1FQKejmEKv1prTg9sZ1r47dZq8J9ayaizYHq', NULL, NULL, 0, NULL, NULL, NULL, 'active', '2024-11-09 08:56:25', '2024-11-13 12:11:26'),
(3, 'admin', 'hameed', 'admin@betdalal.com', NULL, '$2y$12$PGc3xB13b8lApRBNkJzxJ.kdS7ZKa4fBAq9ZO8J5BvBfS.l2kyypO', '03009090900', 'xUL0oalb7v3ui9NRSMQnwMbfrqWVXam8sQLOOS1wlNv4IYMPa6OZsqHGa162', 1, 'profile_3.jpg', NULL, NULL, 'active', '2024-11-09 15:03:50', '2024-11-10 05:36:55'),
(4, NULL, 'hell', 'hae@yaho.c', NULL, '$2y$12$I.foB/YfTIsFc5Q79scEPeOSo5Zf5mHfHn9MKsdxuoC8VGw.QIzmu', '030303003030', NULL, 0, NULL, NULL, NULL, 'active', '2024-11-14 11:41:03', '2024-11-14 11:41:03'),
(5, NULL, 'Hello', 'hello@uu.cm', NULL, '$2y$12$PXM4JxRHwHF5zFfGKMjH7u2tNnJUln2MWUHMjwRb//LgGLSlJLcIK', '09009090900', NULL, 0, NULL, NULL, NULL, 'active', '2024-11-14 11:51:05', '2024-11-14 11:51:05'),
(6, NULL, 'hameedasdasd', 'hameedasd@yahoo.com', NULL, '$2y$12$46WCEN0YZ1EGefZQmq5/EuMLlKToKq9m6yjFw7q5pYuxheB0G/TWG', '02030303030', NULL, 0, NULL, NULL, NULL, 'active', '2024-11-14 11:53:43', '2024-11-14 11:53:43'),
(7, 'Helllo MR', 'asdaasd', 'asasd@asda.com', NULL, '$2y$12$JlqekBu55Od2qLCmBhip4uJG1asF3Gft7AGWREO9KlfMFqKQbKxYK', '03009099999', NULL, 0, 'profile_7.png', 'English', NULL, 'active', '2024-11-14 12:07:48', '2024-11-15 11:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id`, `user_id`, `account_id`, `assigned_at`, `created_at`, `updated_at`) VALUES
(9, 1, 18, '2024-11-13 09:30:42', '2024-11-13 09:30:42', '2024-11-13 09:30:42'),
(10, 1, 19, '2024-11-13 09:30:42', '2024-11-13 09:30:42', '2024-11-13 09:30:42'),
(11, 2, 20, '2024-11-13 09:30:42', '2024-11-13 09:30:42', '2024-11-13 09:30:42'),
(12, 3, 21, '2024-11-13 09:30:42', '2024-11-13 09:30:42', '2024-11-13 09:30:42'),
(13, 2, 23, '2024-11-13 09:57:51', '2024-11-13 09:57:51', '2024-11-13 09:57:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_platform_transactions`
--

CREATE TABLE `user_platform_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `platform_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `approved_at` datetime DEFAULT NULL,
  `rejected_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_accounts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_platform_transactions`
--
ALTER TABLE `user_platform_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_platform_transactions`
--
ALTER TABLE `user_platform_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
