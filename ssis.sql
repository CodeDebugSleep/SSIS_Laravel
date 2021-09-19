-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2021 at 07:12 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssis`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` double(8,2) NOT NULL,
  `perishable_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dry_wet_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kitchen_stock` int(11) DEFAULT NULL,
  `inventory_stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_type_id`, `user_id`, `item_name`, `item_price`, `perishable_state`, `dry_wet_state`, `deleted_at`, `created_at`, `updated_at`, `kitchen_stock`, `inventory_stock`) VALUES
(4001, 6001, 1003, 'Onion', 25.50, 'perishable', 'dry', NULL, '2021-01-03 10:12:21', '2021-01-14 22:12:46', 6, 2),
(4002, 6001, 1003, 'Green Chili', 12.50, 'perishable', 'dry', NULL, '2021-01-03 10:13:51', '2021-01-14 04:09:31', 2, 0),
(4005, 6002, 1002, 'Chicken Sisigs', 55.00, 'perishable', 'dry', NULL, '2021-01-03 10:24:43', '2021-01-21 05:41:38', 20, 0),
(4006, 6003, 1003, 'Spoons', 10.00, 'non-perishable', 'none', NULL, '2021-01-04 04:04:09', '2021-01-15 04:36:03', 32, 0),
(4007, 6003, 1002, 'Forks', 10.25, 'non-perishable', 'none', NULL, '2021-01-04 04:49:14', '2021-01-14 22:13:25', 0, 0),
(4009, 6002, 1003, 'Pork Sisig', 55.00, 'perishable', 'dry', NULL, '2021-01-04 06:28:49', '2021-01-04 06:28:49', 0, 0),
(4011, 6001, 1002, 'Liver', 45.25, 'perishable', 'wet', NULL, '2021-01-05 02:12:42', '2021-01-13 19:15:27', 0, 0),
(4016, 6002, 1002, 'Siomai', 25.00, 'perishable', 'wet', NULL, '2021-01-08 04:58:53', '2021-01-08 04:58:53', 0, 0),
(4020, 6001, 1003, '8oz Coke', 11.00, 'perishable', 'wet', NULL, '2021-01-13 20:14:53', '2021-01-13 20:14:53', NULL, 10);

-- --------------------------------------------------------

--
-- Table structure for table `itemtypes`
--

CREATE TABLE `itemtypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itemtypes`
--

INSERT INTO `itemtypes` (`id`, `item_type`, `created_at`, `updated_at`) VALUES
(6001, 'Items', NULL, NULL),
(6002, 'Products', NULL, NULL),
(6003, 'Utensils', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2020_11_23_124850_create_positions_table', 1),
(13, '2020_11_23_131735_create_users_table', 1),
(14, '2020_11_25_173849_create_itemtypes_table', 1),
(15, '2020_12_05_093125_create_suppliers_table', 1),
(16, '2020_12_07_160504_create_items_table', 1),
(17, '2020_12_07_160655_create_stocks_table', 1),
(18, '2021_01_06_050335_add_url_picture', 2),
(19, '2021_01_06_050758_add_url_picture', 3),
(20, '2021_01_08_124543_add_current_stock', 4),
(21, '2021_01_14_040236_rename_stock', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position`, `note`, `created_at`, `updated_at`) VALUES
(2001, 'Admin', 'Can generate report and monitor the in and out of Items from the kitchen and main branch of Sisig.', NULL, NULL),
(2002, 'Kitchen Personnel', 'Takes notes of the items that are in the Kitchen, and items that are delivered into the Main Branch.', NULL, NULL),
(2003, 'Inventory Personnel', 'Takes notes of the items that are in the Main Branch', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `add_stock` int(11) DEFAULT NULL,
  `subtract_stock` int(11) DEFAULT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `restock_out_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `item_id`, `user_id`, `supplier_id`, `add_stock`, `subtract_stock`, `unit`, `restock_out_date`, `created_at`, `updated_at`) VALUES
(7017, 4001, 1003, NULL, 2, NULL, 'Kilos', '2021-01-14 04:29:34', '2021-01-13 20:29:34', '2021-01-13 20:29:34'),
(7018, 4001, 1002, NULL, 3, NULL, 'Kilos', '2021-01-14 04:48:13', '2021-01-13 20:48:13', '2021-01-13 20:48:13'),
(7019, 4001, 1002, NULL, NULL, 1, 'Kilo', '2021-01-14 09:02:36', '2021-01-14 01:02:36', '2021-01-14 01:02:36'),
(7020, 4001, 1003, NULL, 3, NULL, 'Kilos', '2021-01-14 09:03:13', '2021-01-14 01:03:13', '2021-01-14 01:03:13'),
(7021, 4006, 1002, NULL, 50, NULL, 'Pieces', '2021-01-14 10:42:10', '2021-01-14 02:42:10', '2021-01-14 02:42:10'),
(7022, 4002, 1008, NULL, 2, NULL, 'Kilos', '2021-01-14 12:09:31', '2021-01-14 04:09:31', '2021-01-14 04:09:31'),
(7023, 4001, 1008, NULL, 2, NULL, 'Kilos', '2021-01-14 12:10:45', '2021-01-14 04:10:45', '2021-01-14 04:10:45'),
(7025, 4001, 1002, NULL, 2, NULL, 'Kilos', '2021-01-15 06:01:31', '2021-01-14 22:01:31', '2021-01-14 22:01:31'),
(7026, 4006, 1002, NULL, 2, NULL, 'Pieces', '2021-01-15 06:11:28', '2021-01-14 22:11:28', '2021-01-14 22:11:28'),
(7028, 4001, 1003, NULL, NULL, 3, 'Kilos', '2021-01-15 06:12:46', '2021-01-14 22:12:46', '2021-01-14 22:12:46'),
(7029, 4006, 1002, NULL, NULL, 20, 'Pieces', '2021-01-15 12:36:03', '2021-01-15 04:36:03', '2021-01-15 04:36:03'),
(7030, 4001, 1002, NULL, 4, NULL, 'Kilos', '2021-01-31 16:26:50', NULL, NULL),
(7031, 4001, 1002, NULL, 3, NULL, 'Kilos', '2021-02-03 16:26:50', NULL, NULL),
(7032, 4002, 1008, NULL, 5, NULL, 'Kilos', '2021-01-16 17:20:31', NULL, NULL),
(7033, 4002, 1002, NULL, 3, NULL, 'Kilos', '2021-06-08 17:19:25', NULL, NULL),
(7034, 4005, 1002, NULL, 50, NULL, 'Canisters', '2021-01-21 13:40:56', '2021-01-21 05:40:56', '2021-01-21 05:40:56'),
(7035, 4005, 1002, NULL, NULL, 30, 'Canisters', '2021-01-21 13:41:38', '2021-01-21 05:41:38', '2021-01-21 05:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_contactNo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` bigint(20) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `picture_url` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `position_id`, `name`, `email`, `email_verified_at`, `password`, `contact`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `picture_url`) VALUES
(1001, 2001, 'Judy Mae Mariano', 'jmae372@gmail.com', NULL, '$2y$10$idvF0TVlYdPE7dTYMZfaUuH4cwVuqhIHDGdkGx6cL5xTdNonfowjy', 9294993318, NULL, NULL, NULL, '2021-01-05 23:21:13', 'https://scontent.fcrk1-2.fna.fbcdn.net/v/t1.0-9/57588205_2297501343838346_5186795913321906176_o.jpg?_nc_cat=101&ccb=2&_nc_sid=cdbe9c&_nc_eui2=AeFTg2WmBhFwMMP26j4kwX7b-CXl8kDR5zj4JeXyQNHnOKX7ifRv4ZsnMm0nXWd2-YoRdoff3qBVbZVkmcSA2NFU&_nc_ohc=FlXEV2kgaLoAX-8Kfh_&_nc_ht=scontent.fcrk1-2.fna&oh=20bcf554ea468c485a77a692c0a23e45&oe=6019504D'),
(1002, 2002, 'Antonette Gavina', 'tonet@gmail.com', NULL, '$2y$10$klXqoFTW7QDlAwGXhT.eUul.u8vMPCtkVvL4RTS.MxcZ6R4h8tQhu', 9584123846, NULL, NULL, '2021-01-03 06:59:13', '2021-01-12 00:10:42', 'https://scontent.fcrk1-1.fna.fbcdn.net/v/t1.0-9/47578385_2200378710232754_7212544855120019456_o.jpg?_nc_cat=104&ccb=2&_nc_sid=a4a2d7&_nc_eui2=AeGR73TJcfUHNoBqmhXJDSWGI1KOxWbb-TQjUo7FZtv5NONU-IBE-OixE8zG24dOgYeFf_A-Q7rwU-FxlkswXMh5&_nc_ohc=KKLlGSXluNEAX-jsDst&_nc_ht=scontent.fcrk1-1.fna&oh=25e60763e10acc69b4bb92e18ff40399&oe=6019A02B'),
(1003, 2003, 'Ulyna Balacdao', 'ulyna@gmail.com', NULL, '$2y$10$okTeP4FcsMyERCy87CFQO.RBYw3UZgGM.5ptTLsruE7/Krn1Gqmp2', 9845138756, NULL, NULL, '2021-01-03 07:08:36', '2021-01-12 20:22:13', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'),
(1008, 2002, 'a', 'a@gmail.com', NULL, '$2y$10$aIvukF4bFWMUhLPu62rRmu7kOtnmEC96qTB/AJ/EjuE/Unpw0S72u', 9613581759, NULL, NULL, '2021-01-12 22:07:54', '2021-01-14 22:04:54', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'),
(1010, 2001, 'Deco', 'deco@gmail.com', NULL, '$2y$10$6miDUj2t7iNFe8soNVyrS.tPWzWD.1Vs8czTuyHDu0Ko3D/IleqEG', 9485136945, NULL, NULL, '2021-02-07 22:12:00', '2021-02-07 22:12:00', 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `item_name` (`item_name`),
  ADD KEY `items_item_type_id_foreign` (`item_type_id`),
  ADD KEY `items_user_id_foreign` (`user_id`);

--
-- Indexes for table `itemtypes`
--
ALTER TABLE `itemtypes`
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
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_item_id_foreign` (`item_id`),
  ADD KEY `stocks_user_id_foreign` (`user_id`),
  ADD KEY `stocks_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_position_id_foreign` (`position_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4021;

--
-- AUTO_INCREMENT for table `itemtypes`
--
ALTER TABLE `itemtypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6004;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2004;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7036;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_item_type_id_foreign` FOREIGN KEY (`item_type_id`) REFERENCES `itemtypes` (`id`),
  ADD CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `stocks_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  ADD CONSTRAINT `stocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
