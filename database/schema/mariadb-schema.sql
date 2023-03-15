-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-03-15 18:42:46
-- 伺服器版本： 10.4.27-MariaDB
-- PHP 版本： 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `laravel`
--
SET foreign_key_checks = 0;
DROP TABLE IF EXISTS `ag_joins`;
DROP TABLE IF EXISTS `ai_models`;
DROP TABLE IF EXISTS `alarms`;
DROP TABLE IF EXISTS `groups`;
DROP TABLE IF EXISTS `predictions`;
DROP TABLE IF EXISTS `notifys`;
DROP TABLE IF EXISTS `datas`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `pools`;
DROP TABLE IF EXISTS `failed_jobs`;
DROP TABLE IF EXISTS `password_reset_tokens`;
DROP TABLE IF EXISTS `personal_access_tokens`;
DROP TABLE IF EXISTS `migrations`;
SET foreign_key_checks = 1;
-- --------------------------------------------------------

--
-- 資料表結構 `ai_models`
--

CREATE TABLE `ai_models` (
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `model_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `alarms`
--

CREATE TABLE `alarms` (
  `alarm_id` bigint(20) UNSIGNED NOT NULL,
  `alarm_name` varchar(255) NOT NULL,
  `operator` char(1) NOT NULL,
  `fk_notify_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `datas`
--

CREATE TABLE `datas` (
  `data_id` bigint(20) UNSIGNED NOT NULL,
  `ph` int(11) NOT NULL,
  `temp` double(6,2) NOT NULL,
  `EC` double(6,2) NOT NULL,
  `COD` double(6,2) NOT NULL,
  `SS` double(6,2) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fk_pool_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `groups`
--

CREATE TABLE `groups` (
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `group_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, 'create_counter_table', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `notifys`
--

CREATE TABLE `notifys` (
  `notify_id` bigint(20) UNSIGNED NOT NULL,
  `method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `pools`
--

CREATE TABLE `pools` (
  `pool_id` bigint(20) UNSIGNED NOT NULL,
  `pool_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `predictions`
--

CREATE TABLE `predictions` (
  `predict_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `hashed_pwd` varchar(255) NOT NULL,
  `fk_group_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ai_models`
--
ALTER TABLE `ai_models`
  ADD PRIMARY KEY (`model_id`);

--
-- 資料表索引 `alarms`
--
ALTER TABLE `alarms`
  ADD PRIMARY KEY (`alarm_id`),
  ADD KEY `alarms_fk_notify_id_foreign` (`fk_notify_id`);

--
-- 資料表索引 `datas`
--
ALTER TABLE `datas`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `datas_fk_pool_id_foreign` (`fk_pool_id`);

--
-- 資料表索引 `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- 資料表索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `notifys`
--
ALTER TABLE `notifys`
  ADD PRIMARY KEY (`notify_id`);

--
-- 資料表索引 `pools`
--
ALTER TABLE `pools`
  ADD PRIMARY KEY (`pool_id`);

--
-- 資料表索引 `predictions`
--
ALTER TABLE `predictions`
  ADD PRIMARY KEY (`predict_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_fk_group_id_foreign` (`fk_group_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ai_models`
--
ALTER TABLE `ai_models`
  MODIFY `model_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `alarms`
--
ALTER TABLE `alarms`
  MODIFY `alarm_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `datas`
--
ALTER TABLE `datas`
  MODIFY `data_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `notifys`
--
ALTER TABLE `notifys`
  MODIFY `notify_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `pools`
--
ALTER TABLE `pools`
  MODIFY `pool_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `predictions`
--
ALTER TABLE `predictions`
  MODIFY `predict_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `alarms`
--
ALTER TABLE `alarms`
  ADD CONSTRAINT `alarms_fk_notify_id_foreign` FOREIGN KEY (`fk_notify_id`) REFERENCES `notifys` (`notify_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `datas`
--
ALTER TABLE `datas`
  ADD CONSTRAINT `datas_fk_pool_id_foreign` FOREIGN KEY (`fk_pool_id`) REFERENCES `pools` (`pool_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk_group_id_foreign` FOREIGN KEY (`fk_group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
