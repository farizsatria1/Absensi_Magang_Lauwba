-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 08:30 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi`
--

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_20_033749_create_pembimbing_table', 1),
(6, '2023_10_20_034012_create_peserta_table', 1),
(7, '2023_10_20_034506_create_presensi_masuk_table', 1),
(8, '2023_10_20_034653_create_presensi_pulang_table', 1),
(9, '2023_10_20_035306_create_pekerjaan_table', 1),
(10, '2023_10_30_132458_create_progress_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `id_peserta`, `judul`, `created_at`, `updated_at`) VALUES
(14, 1, 'Membuat FrontEnd', '2023-10-31 01:40:12', '2023-10-31 01:40:12'),
(15, 2, 'Buat aplikasi', '2023-10-31 15:16:09', '2023-10-31 15:16:09');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id`, `nip`, `nama`, `password`, `created_at`, `updated_at`) VALUES
(1, '2101082034', 'Mas Agus', '12345678', NULL, NULL),
(2, '2101082033', 'Mas Wildan', '12345678', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Peserta', 1, 'pesertaToken', 'e77604697d41b537f826c824c810685f57ea0a8f93479b0a9d4bdd47b574b561', '[\"*\"]', NULL, NULL, '2023-10-30 06:28:39', '2023-10-30 06:28:39'),
(2, 'App\\Models\\Peserta', 1, 'pesertaToken', 'bd8e6849dd7db25ad8ebbf9cd351821dde6638f2f71cf8aa1c9e514ccb6c11c8', '[\"*\"]', NULL, NULL, '2023-10-30 06:28:50', '2023-10-30 06:28:50'),
(4, 'App\\Models\\Peserta', 2, 'pesertaToken', '78381ec20ebc040d91af10785938e65b2677d602e612bc81a722fd385059d553', '[\"*\"]', NULL, NULL, '2023-10-30 14:33:04', '2023-10-30 14:33:04'),
(6, 'App\\Models\\Peserta', 1, 'pesertaToken', 'acb90f67a84b56e39ea90aa62ab14f33e154c9df4994a887016846d48f8409e4', '[\"*\"]', NULL, NULL, '2023-10-30 15:46:03', '2023-10-30 15:46:03'),
(7, 'App\\Models\\Peserta', 1, 'pesertaToken', '9fe9f34018ba8472934cfce3ef810e1e739ef52dcaebfdfe61b82e76730a7048', '[\"*\"]', NULL, NULL, '2023-10-31 01:20:02', '2023-10-31 01:20:02'),
(9, 'App\\Models\\Peserta', 1, 'pesertaToken', '52dd92c62d2fa6adc29fbf3063de0926d8833c03ac73894d972a148bb1a8186e', '[\"*\"]', NULL, NULL, '2023-10-31 04:03:46', '2023-10-31 04:03:46'),
(10, 'App\\Models\\Peserta', 1, 'pesertaToken', '6e3610885e7ffbd1644989238bf8760ae751866f055829cf9ac67d3022528c3a', '[\"*\"]', NULL, NULL, '2023-10-31 08:17:01', '2023-10-31 08:17:01'),
(11, 'App\\Models\\Peserta', 1, 'pesertaToken', 'ae6b4da8b4b875c84690e93abafcfdd39c5b63f0b5ad7eb74c518677259b31d8', '[\"*\"]', NULL, NULL, '2023-10-31 13:33:42', '2023-10-31 13:33:42'),
(24, 'App\\Models\\Peserta', 2, 'pesertaToken', '079f2a96e13dff156181a99d3e5b1dabfe392d1390de582ba34fab7a9cb7a17c', '[\"*\"]', NULL, NULL, '2023-10-31 15:28:20', '2023-10-31 15:28:20'),
(27, 'App\\Models\\Peserta', 1, 'pesertaToken', '4bc3dba18ff09c4317e8a10e9de801632ef8953dbd169b63308c9fe2d4568571', '[\"*\"]', NULL, NULL, '2023-11-01 01:50:09', '2023-11-01 01:50:09'),
(28, 'App\\Models\\Peserta', 1, 'pesertaToken', 'c4194de424e2fab14c6fb7740465a4329f0d57fb2d7a0a7151b20d8ad45fd259', '[\"*\"]', NULL, NULL, '2023-11-01 02:41:51', '2023-11-01 02:41:51'),
(31, 'App\\Models\\Peserta', 1, 'pesertaToken', '271436a93dbbef43ed66bdbe17e59115f0b25982a090bd9f89e8e249897410f0', '[\"*\"]', NULL, NULL, '2023-11-01 04:10:52', '2023-11-01 04:10:52'),
(33, 'App\\Models\\Peserta', 1, 'pesertaToken', 'e7b5d1b115a4d21fb3a5c657fe7190721d06a639b6b9eb9cd9e4ec6d6128c539', '[\"*\"]', NULL, NULL, '2023-11-01 06:43:47', '2023-11-01 06:43:47'),
(34, 'App\\Models\\Peserta', 1, 'pesertaToken', '9793fe2e5e5b78efdaa9ac10ee412c85a05e6e4aa0cc8400488c99b7f5e2d2ee', '[\"*\"]', NULL, NULL, '2023-11-01 08:17:10', '2023-11-01 08:17:10'),
(37, 'App\\Models\\Peserta', 2, 'pesertaToken', '76dfd65be6f302d3ba008c2862812e652ef2654d7cdc1b4fa4866f40a2e231cb', '[\"*\"]', NULL, NULL, '2023-11-02 03:02:25', '2023-11-02 03:02:25'),
(38, 'App\\Models\\Peserta', 2, 'pesertaToken', 'f8c3757243a49e67897a55b9987faf66433dc14609495e6cf30673b438fc7653', '[\"*\"]', NULL, NULL, '2023-11-02 03:41:16', '2023-11-02 03:41:16'),
(42, 'App\\Models\\Peserta', 1, 'pesertaToken', 'cc1f7e61e6b1322a1b831b839428f1b67d8d0c5e1b5a038435330cda87026894', '[\"*\"]', NULL, NULL, '2023-11-02 06:22:02', '2023-11-02 06:22:02');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pembimbing` bigint(20) UNSIGNED DEFAULT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id`, `nama`, `asal`, `tgl_mulai`, `id_pembimbing`, `asal_sekolah`, `no_hp`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Fariz Satria Refandino', 'Padang', '30-10-2023', 1, 'Politeknik Negeri Padang', '083187376636', 'fariz', '$2y$10$9iaLgeaeQTV7eJHBPdpPhuAcA/kYluJyontey0zV9K/IlcSBfm6mu', '2023-10-30 06:28:39', '2023-10-30 06:28:39'),
(2, 'Refandino', 'Agam', '30-10-2023', 1, 'SMA N 1 Bantul', '083187276636', 'satria', '$2y$10$4p7m2XDKhJlo4nrG.Z1X..6U9YDvSN86jOj21Nn7ukVb/s36j9TGa', '2023-10-30 14:33:04', '2023-10-30 14:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_masuk`
--

CREATE TABLE `presensi_masuk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jam_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presensi_masuk`
--

INSERT INTO `presensi_masuk` (`id`, `id_peserta`, `tgl_masuk`, `jam_masuk`, `created_at`, `updated_at`) VALUES
(61, 1, '2023-11-02', '2023-11-02 07:17:46', '2023-11-02 07:17:46', '2023-11-02 07:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_pulang`
--

CREATE TABLE `presensi_pulang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `tgl_pulang` date NOT NULL,
  `jam_pulang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pekerjaan` bigint(20) UNSIGNED DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_dokumentasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `id_pekerjaan`, `catatan`, `foto_dokumentasi`, `created_at`, `updated_at`) VALUES
(41, 14, 'Saat ini saya sedang membuat sebuah aplikasi yang mencatat progress peserta Magang\n\nDan Progress dapat dilihat oleh pembimbing dari peserta tersebut', NULL, '2023-10-30 01:47:32', '2023-11-01 01:47:32'),
(42, 14, 'Halo', NULL, '2023-11-01 01:48:40', '2023-11-01 01:48:40'),
(43, 14, 'Hai', NULL, '2023-11-01 01:48:55', '2023-11-01 01:48:55'),
(44, 15, 'Halo', NULL, '2023-11-01 01:49:32', '2023-11-01 01:49:32'),
(45, 15, 'Hai hadudsnds dsk', NULL, '2023-11-01 01:49:46', '2023-11-01 01:49:46'),
(46, 14, 'svdvsdsvdhsdvks', NULL, '2023-11-01 01:53:42', '2023-11-01 01:53:42'),
(58, 14, 'siuu', 'http://192.168.247.146/storage/images/1698810788_png', '2023-11-01 03:53:08', '2023-11-01 03:53:08'),
(59, 14, 'yuhu', 'http://192.168.247.146/storage/images/1698810805_png', '2023-11-01 03:53:25', '2023-11-01 03:53:25'),
(60, 14, 'hfhfghfhgfghfg', NULL, '2023-11-02 07:15:04', '2023-11-02 07:15:04');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pekerjaan_id_peserta_foreign` (`id_peserta`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peserta_id_pembimbing_foreign` (`id_pembimbing`);

--
-- Indexes for table `presensi_masuk`
--
ALTER TABLE `presensi_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presensi_masuk_id_peserta_foreign` (`id_peserta`);

--
-- Indexes for table `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presensi_pulang_id_peserta_foreign` (`id_peserta`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `progress_id_pekerjaan_foreign` (`id_pekerjaan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `presensi_masuk`
--
ALTER TABLE `presensi_masuk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD CONSTRAINT `pekerjaan_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`);

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_id_pembimbing_foreign` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id`);

--
-- Constraints for table `presensi_masuk`
--
ALTER TABLE `presensi_masuk`
  ADD CONSTRAINT `presensi_masuk_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`);

--
-- Constraints for table `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  ADD CONSTRAINT `presensi_pulang_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`);

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_id_pekerjaan_foreign` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
