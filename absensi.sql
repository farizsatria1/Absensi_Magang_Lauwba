-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 04:23 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'farizsatria4@gmail.com', '$2y$10$L1ui2tvZBXMOn/ryAKStNOCeWKgVDTCvF6Jd02mhsO4m1WNGfsI16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `keterangan`
--

CREATE TABLE `keterangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keterangan`
--

INSERT INTO `keterangan` (`id`, `id_peserta`, `keterangan`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Izin', 'Sakit Demam', '2024-01-02 03:26:57', '2024-01-02 03:26:57');

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
(10, '2023_10_30_132458_create_progress_table', 1),
(11, '2023_11_06_104516_create_keterangan_table', 1),
(12, '2023_11_15_104824_create_admin_table', 1),
(13, '2023_11_28_101158_create_piket_table', 1),
(14, '2023_11_29_082908_create_carousel_table', 1);

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
(6, 1, 'Membuat web kasir', '2023-12-29 03:56:09', '2023-12-29 03:56:09'),
(7, 3, 'Membuat web sekolah', '2023-12-29 04:22:25', '2023-12-29 04:22:25'),
(8, 2, 'Mambuat web personal', '2023-12-29 06:57:49', '2023-12-29 06:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ttd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id`, `nip`, `nama`, `password`, `ttd`, `created_at`, `updated_at`) VALUES
(1, '2101082034', 'Mas Agus', '$2y$10$hYF4NnH2jtb3X9CWG8gjXOfRtClnUUo24UZr7nqQ3wW472KvW7V9y', '1703820561.png', '2023-12-29 03:29:21', '2024-01-01 14:17:48'),
(2, '2101082033', 'Mas Wildan', '$2y$10$tNvI6GXMcaeZfn47phZR7OeFowaGPbCPjQLppVscnI40igvtH3TxS', '1703820834.png', '2023-12-29 03:33:55', '2023-12-29 03:33:55');

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

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_mulai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pgl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_pembimbing` bigint(20) UNSIGNED DEFAULT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','non-aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id`, `nama`, `asal`, `tgl_mulai`, `nama_pgl`, `id_pembimbing`, `asal_sekolah`, `ttd`, `status`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Fariz Satria Refandino', 'Padang', '2023-12-29', 'Fariz', 1, 'PNP', '1703820621.jpg', 'aktif', 'fariz', '$2y$10$NIESmtchC9JzkgJE7t2uCeXFnVIZS2zAArMMExmPEUU460cdxPQFS', '2023-12-29 03:30:21', '2023-12-29 03:30:21'),
(2, 'Satria Dino', 'Padang', '2023-12-29', 'Satria', 1, 'PNP', '1703820692.png', 'non-aktif', 'satria', '$2y$10$9ntFAL6gMwU7uqbBfUGjVuMcfN9XQtpkHwlL8u5txYF1R.SH5v4ti', '2023-12-29 03:31:33', '2023-12-29 03:31:33'),
(3, 'Satria Refandino', 'Padang', '2023-12-29', 'Refandino', 1, 'PNP', '1703820736.jpg', 'aktif', 'refandino', '$2y$10$vr1VdMGmmRB.ShFXGdJoPepFiCvgLB27RPnVN.XAuE23SZl1AhoOy', '2023-12-29 03:32:16', '2023-12-29 03:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `piket`
--

CREATE TABLE `piket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_pembimbing` bigint(20) UNSIGNED DEFAULT NULL,
  `id_peserta` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `piket`
--

INSERT INTO `piket` (`id`, `hari`, `id_pembimbing`, `id_peserta`, `created_at`, `updated_at`) VALUES
(1, 'Senin', NULL, 1, '2024-01-02 04:17:03', '2024-01-02 04:17:03');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_masuk`
--

CREATE TABLE `presensi_masuk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `tgl_masuk` date NOT NULL,
  `jam_masuk` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `coordinat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presensi_masuk`
--

INSERT INTO `presensi_masuk` (`id`, `id_peserta`, `tgl_masuk`, `jam_masuk`, `coordinat`, `alamat`, `created_at`, `updated_at`) VALUES
(4, 1, '2024-01-02', '2024-01-02 14:30:53', '-7.768582, 110.4064696', 'Gg. Durian No.92, Caturtunggal, Kecamatan Depok, 55281, Indonesia', '2024-01-02 14:30:56', '2024-01-02 14:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_pulang`
--

CREATE TABLE `presensi_pulang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_peserta` bigint(20) UNSIGNED NOT NULL,
  `tgl_pulang` date NOT NULL,
  `jam_pulang` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `coordinat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presensi_pulang`
--

INSERT INTO `presensi_pulang` (`id`, `id_peserta`, `tgl_pulang`, `jam_pulang`, `coordinat`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-01-02', '2024-01-02 14:31:38', '-7.7686143, 110.4065937', 'Gg. Durian No.92, Caturtunggal, Kecamatan Depok, 55281, Indonesia', '2024-01-02 14:31:41', '2024-01-02 14:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pekerjaan` bigint(20) UNSIGNED DEFAULT NULL,
  `trainer_pembimbing` bigint(20) UNSIGNED DEFAULT NULL,
  `trainer_peserta` bigint(20) UNSIGNED DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_dokumentasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peserta_approve` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `id_pekerjaan`, `trainer_pembimbing`, `trainer_peserta`, `catatan`, `foto_dokumentasi`, `peserta_approve`, `status`, `created_at`, `updated_at`) VALUES
(19, 6, 1, NULL, 'Hai', '1704205742_1000068671.jpg_compressed.jpg', '0', '1', '2024-01-02 14:28:01', '2024-01-02 14:29:28'),
(20, 6, 1, NULL, 'Yuhah', '1704205812_1000073922.jpg_compressed.jpg', '0', '1', '2024-01-02 14:29:44', '2024-01-02 14:30:43');

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `keterangan`
--
ALTER TABLE `keterangan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keterangan_id_peserta_foreign` (`id_peserta`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembimbing_nip_unique` (`nip`);

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
  ADD UNIQUE KEY `peserta_username_unique` (`username`),
  ADD KEY `peserta_id_pembimbing_foreign` (`id_pembimbing`);

--
-- Indexes for table `piket`
--
ALTER TABLE `piket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `piket_id_pembimbing_foreign` (`id_pembimbing`),
  ADD KEY `piket_id_peserta_foreign` (`id_peserta`);

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
  ADD KEY `progress_id_pekerjaan_foreign` (`id_pekerjaan`),
  ADD KEY `progress_trainer_pembimbing_foreign` (`trainer_pembimbing`),
  ADD KEY `progress_trainer_peserta_foreign` (`trainer_peserta`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keterangan`
--
ALTER TABLE `keterangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `piket`
--
ALTER TABLE `piket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `presensi_masuk`
--
ALTER TABLE `presensi_masuk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `keterangan`
--
ALTER TABLE `keterangan`
  ADD CONSTRAINT `keterangan_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD CONSTRAINT `pekerjaan_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_id_pembimbing_foreign` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `piket`
--
ALTER TABLE `piket`
  ADD CONSTRAINT `piket_id_pembimbing_foreign` FOREIGN KEY (`id_pembimbing`) REFERENCES `pembimbing` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `piket_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `presensi_masuk`
--
ALTER TABLE `presensi_masuk`
  ADD CONSTRAINT `presensi_masuk_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  ADD CONSTRAINT `presensi_pulang_id_peserta_foreign` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_id_pekerjaan_foreign` FOREIGN KEY (`id_pekerjaan`) REFERENCES `pekerjaan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `progress_trainer_pembimbing_foreign` FOREIGN KEY (`trainer_pembimbing`) REFERENCES `pembimbing` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `progress_trainer_peserta_foreign` FOREIGN KEY (`trainer_peserta`) REFERENCES `peserta` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
