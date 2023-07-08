-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2023 at 03:16 AM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MyBank`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acc_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` bigint UNSIGNED NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buy_amount` bigint DEFAULT NULL,
  `sell_amount` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(97, '2023_06_05_165108_create_money_accounts_table', 1),
(107, '2014_10_12_000000_create_users_table', 2),
(108, '2014_10_12_100000_create_password_resets_table', 2),
(109, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(110, '2019_08_19_000000_create_failed_jobs_table', 2),
(111, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(112, '2023_06_16_142652_create_accounts_table', 2),
(126, '2023_06_18_192836_create_atm_table', 4),
(158, '2023_06_18_213450_create_atm_table', 10),
(160, '2023_06_25_125315_create_investment_table', 11),
(161, '2023_06_25_141639_create_investments_table', 12),
(163, '2023_06_17_111202_create_transactions_table', 13);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transfer_amount` bigint DEFAULT NULL,
  `converted_amount` bigint DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `personal_code`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`, `two_factor_confirmed_at`) VALUES
(1, 'Aļģis', 'Bernatovičs', '000000-00000', 'algis.bernatovics@gmail.com', NULL, '$2y$10$XIvNctDqL.5uIfUMYyl/K.xy6qs1pb/8QGRkqZDmKLUnpyTZCUiH6', 'eyJpdiI6IisweUhKblJaVEU3ZTJuSUpONGo0UFE9PSIsInZhbHVlIjoiSVFRRFJjMEpCODZtUEVpamFlQ2xFL0FWMUdZVFkxK0hqYVlqZVh1WGQ1bz0iLCJtYWMiOiI1NWRlY2U0YzRjZjhiODJlOWNhODgwMjRmZGYwMTNiMDMxZmRlMzc1YjUzZTEzMjU3NGJmMmUzY2U5ZTNkNjY2IiwidGFnIjoiIn0=', 'eyJpdiI6Ilc4SXVLOGVmNmlKdmwxMlZmQWtOTXc9PSIsInZhbHVlIjoiVS9QRFJ3YlNjYmF2cXVTNm9WVjlqdjZac2J3RitIdkNlVlJOL0JZbVk4WE1BTUxHQ1czMHM2Yk9yaGkrdHNpTHRsUnR2aVFxTzJQcGdadlVLb0VlZmM3V0xHR0MyT2lSYUdhN1luczl5aFk1SWhUVWltWG15bnBrQmRhcWZacW5pS1lIc00rRUtlZUFoaVZ0S0RDaW1MbUZaSXBmZlE3blFRY3ExTmp2bnJXdUEzVEcvQWRFQi9XenBqdU5CK1pkZ3RjYkF5Mk9NeFJ0amI4OVZLNUVjNGFwRFlBV0xCTU5pTWRIOTJ5WlhFbVZNcnVtODFsa0x2L0RESFVidE1NeHFoQW9QNWxNNVBBSGcwdSs0U0pyWmc9PSIsIm1hYyI6ImNhNTM1MjQ2ZWVhZmEwYjE5YmFkZjE5OWM0MDA3NzljZDdlMmNiYjBmMGI0M2MyNTI5ZWUwMzg4NjdmMjBhZTgiLCJ0YWciOiIifQ==', NULL, '2023-06-21 21:22:45', '2023-06-26 10:42:36', '2023-06-26 10:42:36'),
(2, 'Grieta', 'Bernatoviča', '000000-00001', 'grieta.bernatovica@gmail.com', NULL, '$2y$10$yBhNOSUC7/ZGkDrE7nAwRe13kVhb/4fDIbALmsawEshz4.jtsCCZ6', 'eyJpdiI6IjNJNktYWHA0VDhMOXFScjNDOFBkQVE9PSIsInZhbHVlIjoiQ3UyZjRLcmdGUE1nS1dKRkRMT1RZbHM0eTVXWEptRCtkaXViRFN2akJRbz0iLCJtYWMiOiI3MzlmZmE1MGU1ZTQ5ZjJiOTUwMmMyMjI0NWE1ZWEzY2YwNDdlNjU3ZGY3NTE4MWI1NWZhM2U5ZTU0OWY5YjY1IiwidGFnIjoiIn0=', 'eyJpdiI6IlJZRHhNR2ZrZjdudmRvNWVVcXFhWnc9PSIsInZhbHVlIjoiVXMvd2tZUmZvbFBpMjB0cGtvaU82L0s0d2tUMVBaTEtpelJvUVVwMVNnaUkyWUVTY214NXNBdEdYNS9DTFZSeERlZ1dYYXRVY010NFBsZlVJVHRJNHBTaUN5QlU3U1J3TTMyQjlNK2VqaENxUTd3S1dDYmdYbDFDd00rbk5RdzBBeUkrQ0dsV0tSc2xFTjJKbkRWWmI2TFQ2MXlrck9Rcm5HNk1SWUF4K2ZEVzk1WnhjdDMvMmRsM1ZGSm5jK3FyR3A1dmZlZWVtQW4vM2d4aW9CY003dDVjdDhIcGljM1JXOVZIMkprUmVwejNLbHREQ2kwSndRL1dlaFgwRit3cHl2MVdOQ0dQVEVhTkRQK055NExnN1E9PSIsIm1hYyI6Ijk3ZDkyODBkMjY4NjNhMjY0MjA4YTFiZTdmNGVmZDBhMWI0ZmJjMDJkZjMzZjVlOGUxODNiYjBjMzU2Mjk3ZDgiLCJ0YWciOiIifQ==', NULL, '2023-06-17 17:38:50', '2023-07-05 15:46:08', '2023-07-05 15:46:08'),
(3, 'Mulder', 'Fox', '000000-00002', 'mulder.fox@gmail.com', NULL, '$2y$10$j7qoaFsHvQVOSyw1/rfgZuZuabcGq3txVicZC6PBWCjTMXUSvlyAO', 'eyJpdiI6IkxZVGlZNEl1OFA2WEFxcmFLKzdTbEE9PSIsInZhbHVlIjoieGp2L3cwOFFwQjJFakxIRWxzV2lIM2hyOUd4cDF6QnE0SGh2a01XNUY1az0iLCJtYWMiOiI5ODQwNGU2NDk2YTYwZmJjNzRiMWE3ZDY1ZDMwZmVlZWY1YjI3YzIwMDcxMzJiNTlkODA5NjY5YThkNzk2NjY2IiwidGFnIjoiIn0=', 'eyJpdiI6Ilp4NjhHVTBMcm1qcXptWnkzMHdBWUE9PSIsInZhbHVlIjoiRTROZzVQdjFaN3IrVTBJRHNiSWdoTWpYU0w3Wks1ZXF0YUdFN2IvM1FSWnFkVlJjWlVWN1hPSFBwaHl4Vnh5aEZqbXd2c2JzeTJBSll3THhOT2ZFOGxWRVc4NXM5YTl5V1V1SHphdmE2VUN5Z1RKMjFPZC9zVzY3d0liUER2MForK3pVU0pQcFZnQ1REeHhnZWxZZUZKR2NKK1lNQklqN0xGOHNWYUhpTVV6aGZtdW03Z0hnSUxJRXp3MjBrOVBBbm5oY3pkQnN0MVp3ZExUdVRQYWxONVFaOFZPYmViR1RVTmtRbkNFU3JWNGZ3cGM0ckpHUm1XNUliVVByc2JVbFN6QnJPckYrenU0ZS9WYVA1Tk5jdUE9PSIsIm1hYyI6IjYzYzQwZGQ2MzIxYzE3NjJiOWY1MjhlNmU5ZjUwMTA5ODQ3NTY2ZWJlOWRhMDYyNjc2ZTRiYmNjMDk4YzE5ZDciLCJ0YWciOiIifQ==', NULL, '2023-06-17 21:09:06', '2023-06-24 10:57:07', '2023-06-24 10:57:07'),
(4, 'Rick', 'Sanchez', '000000-00003', 'rick@gmail.com', NULL, '$2y$10$Zo5M7yDLkOs9d1qahw.ObOx6Za3Mw2tqkydHIPUZtkv6ZGYYrwvBe', 'eyJpdiI6IlFEaGV2d28rT0xnSjdvN0o5dWtlTHc9PSIsInZhbHVlIjoiM0FqSzJkV0Z1MGJCVy9uRWI2V0svRHBVeXZGdlFxdjJ2OUY3em5YemU5cz0iLCJtYWMiOiJiYjlmMTFmNDY4NWIyMDc4N2Y4M2M2MzZhYTU2NTA3MWU4MDFlNDE2ZjEzZmE4ZjkyMTUxYjlhM2M4YTVlNjliIiwidGFnIjoiIn0=', 'eyJpdiI6IlpXd0xnaHNYS2YzRWduMU9Jcm5DeFE9PSIsInZhbHVlIjoibTN4SHFYYzZKU0h1TTNIYU5vMjR5YkVJNDN0b1V6WEI0S29KUCtsRFFEOVg2QU4rNjRQRlI3dEl1cmh5anpUVDlGYnlyUWpqbUNXa3V0Ymkyb3FiaURJeUlhcERYYXpOdFhsUWFOVUFmVVd5MzlKL0ZPdlJ2VmpUMmMwbS81UjZId00wZW91eHY4blNXZzQ4dkJEancvbzlpRFVocDBQVTZobWRRcWV2MWRlZVNqa3NmS2Y0Y3JLOGtqd0gyRjdXUmY0ejVBVzFPVnphQnVSYkRpZE16RWE5dDROKzM5NTE2ZE4yN3g2NkRHMlUxMXpyMTI0ZGxOVjdCWUtOZnVVeTRhRlN0d1ZVRE0yRlB4UURtRitySkE9PSIsIm1hYyI6ImUxYTJiZDI0OTIxYWNmNWMxODM0MGI1OThmN2U1NGU0MmRiY2IyOGU1MTViNmQ4OWRmYTYzNGRmOGZmMjhmYjkiLCJ0YWciOiIifQ==', NULL, '2023-06-29 18:47:09', '2023-07-05 15:49:47', '2023-07-05 15:49:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `accounts_acc_number_unique` (`acc_number`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_unique` (`id`),
  ADD UNIQUE KEY `users_personal_code_unique` (`personal_code`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=323;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
