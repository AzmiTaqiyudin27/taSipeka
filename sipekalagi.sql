-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2024 at 03:27 PM
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
-- Database: `sipekalagi`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_insidentals`
--

CREATE TABLE `audit_insidentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_audit` varchar(20) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `unitkerja_id` bigint(20) UNSIGNED NOT NULL,
  `pendahuluan` longtext DEFAULT NULL,
  `judul` longtext DEFAULT NULL,
  `cakupan_audit` longtext DEFAULT NULL,
  `tujuan_audit` longtext DEFAULT NULL,
  `tanggal_audit` date NOT NULL,
  `versi` varchar(10) DEFAULT NULL,
  `metodologi_audit` varchar(255) DEFAULT NULL,
  `hasil_audit` longtext DEFAULT NULL,
  `rekomendasi` longtext DEFAULT NULL,
  `kesimpulan_audit` longtext DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'diedit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_insidentals`
--

INSERT INTO `audit_insidentals` (`id`, `kode_audit`, `user_id`, `unitkerja_id`, `pendahuluan`, `judul`, `cakupan_audit`, `tujuan_audit`, `tanggal_audit`, `versi`, `metodologi_audit`, `hasil_audit`, `rekomendasi`, `kesimpulan_audit`, `status`, `created_at`, `updated_at`) VALUES
(25, 'A001', 2, 6, '<p>tes</p>', 'tes', '<p>tes</p>', '<p>tes</p>', '2024-08-26', '1', '<p>tes</p>', '<p>tes</p>', '<p>tes</p><figure class=\"image\"><img src=\"/storage/uploads/1724631647_tes foto.png\"></figure>', '<p>tes</p>', 'draft', '2024-08-25 17:20:30', '2024-08-25 17:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `audit_rutins`
--

CREATE TABLE `audit_rutins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_audit` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `unitkerja_id` int(10) NOT NULL,
  `tanggal_audit` date DEFAULT NULL,
  `versi` varchar(255) DEFAULT NULL,
  `pendahuluan` longtext DEFAULT NULL,
  `judul` longtext DEFAULT NULL,
  `cakupan_audit` longtext DEFAULT NULL,
  `tujuan_audit` longtext DEFAULT NULL,
  `rekomendasi` longtext DEFAULT NULL,
  `metodologi_audit` longtext DEFAULT NULL,
  `kesimpulan_audit` longtext DEFAULT NULL,
  `hasil_audit` longtext DEFAULT NULL,
  `status` varchar(20) DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_rutins`
--

INSERT INTO `audit_rutins` (`id`, `kode_audit`, `user_id`, `unitkerja_id`, `tanggal_audit`, `versi`, `pendahuluan`, `judul`, `cakupan_audit`, `tujuan_audit`, `rekomendasi`, `metodologi_audit`, `kesimpulan_audit`, `hasil_audit`, `status`, `created_at`, `updated_at`) VALUES
(34, 'A001', 2, 6, '2024-08-26', '1', '<p>tes</p><figure class=\"image\"><img src=\"/storage/uploads/1724988078_tes foto.png\"></figure><figure class=\"image\"><img src=\"/storage/uploads/1724631192_tes foto.png\"></figure>', 'tes', '<p>tes</p>', '<p><strong>tes</strong></p>', '<p>tes</p>', '<p>tes</p>', '<p>tes</p>', '<p>tes</p>', 'proses', '2024-08-25 17:13:24', '2024-08-29 20:21:26'),
(35, 'A002', 2, 12, '2024-08-26', '1', '<p>tes</p>', 'tes', '<p>tes</p><figure class=\"image\"><img src=\"/storage/uploads/1724988099_tes foto.png\"></figure><figure class=\"image\"><img src=\"/storage/uploads/1724631232_tes foto.png\"></figure>', '<p>tes</p>', '<p>tes</p>', '<p>tes</p>', '<p>tes</p>', '<p>tes</p>', 'proses', '2024-08-25 17:14:00', '2024-08-29 20:21:43');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_lapor_insidentals`
--

CREATE TABLE `dokumen_lapor_insidentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelaporan_insidental_id` bigint(20) UNSIGNED NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_lapor_rutins`
--

CREATE TABLE `dokumen_lapor_rutins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelaporan_rutin_id` bigint(20) UNSIGNED NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `kode_audits`
--

CREATE TABLE `kode_audits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_audit` varchar(255) NOT NULL,
  `nama_sistem` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kode_audits`
--

INSERT INTO `kode_audits` (`id`, `kode_audit`, `nama_sistem`, `created_at`, `updated_at`) VALUES
(9, 'A001', 'tes untuk sistem kedokteran 1', '2024-08-24 22:24:45', '2024-08-24 22:24:45'),
(10, 'A002', 'tes sistem teknik 1', '2024-08-24 23:10:18', '2024-08-24 23:10:18');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_25_031026_create_sessions_table', 1),
(6, '2024_05_17_085459_create_pelaporan_rutins_table', 1),
(7, '2024_05_17_085541_create_pelaporan_insidentals_table', 1),
(8, '2024_05_17_085557_create_audit_insidentals_table', 1),
(9, '2024_05_17_085607_create_audit_rutins_table', 1),
(10, '2024_05_18_062212_create_dokumen_lapor_rutins_table', 1),
(11, '2024_05_18_062354_create_dokumen_lapor_insidentals_table', 1),
(12, '2024_06_07_153222_add_role_to_users_table', 1),
(13, '2024_06_15_011227_tb_kode_audit_rutin', 1),
(14, '2024_06_15_012244_add_foreign_keys_to_audit_rutins_table', 1);

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
-- Table structure for table `pengajuan_insidentals`
--

CREATE TABLE `pengajuan_insidentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_lapor` datetime NOT NULL,
  `nama_sistem` varchar(255) NOT NULL,
  `kendala` varchar(255) NOT NULL,
  `keterangan` longtext NOT NULL,
  `foto` text NOT NULL,
  `status_approved` enum('1','2','3','') NOT NULL DEFAULT '1',
  `is_ditolak` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_insidentals`
--

INSERT INTO `pengajuan_insidentals` (`id`, `user_id`, `tanggal_lapor`, `nama_sistem`, `kendala`, `keterangan`, `foto`, `status_approved`, `is_ditolak`, `created_at`, `updated_at`) VALUES
(14, 6, '2024-08-25 00:00:00', 'tes buat sistem fakultas kedokteran 1', 'tes', 'tes', '[\"image (1).png\"]', '1', NULL, '2024-08-25 07:56:55', '2024-08-29 20:18:07'),
(16, 6, '2024-08-26 00:00:00', 'tes buat sistem fakultas kedokteran 2', 'tes', 'tes', '[\"image (1).png\"]', '1', NULL, '2024-08-25 19:23:46', '2024-08-29 20:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_rutins`
--

CREATE TABLE `pengajuan_rutins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_lapor` datetime NOT NULL,
  `nama_sistem` varchar(255) NOT NULL,
  `versi` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `dokumen` text NOT NULL,
  `status_approved` enum('1','2','3','') NOT NULL DEFAULT '1',
  `is_ditolak` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengajuan_rutins`
--

INSERT INTO `pengajuan_rutins` (`id`, `user_id`, `tanggal_lapor`, `nama_sistem`, `versi`, `deskripsi`, `dokumen`, `status_approved`, `is_ditolak`, `created_at`, `updated_at`) VALUES
(47, 6, '2024-08-25 00:00:00', 'tes bulan agustus sistem fakultas kedokteran 1', '1', 'tesss', '[\"1724987928-image (1).png\"]', '2', NULL, '2024-08-25 07:55:44', '2024-09-10 20:30:23'),
(51, 6, '2024-08-25 00:00:00', 'tes bulan agustus sistem fakultas kedokteran 2', '1', 'tes', '[\"1724987918-logo unsoed.png\"]', '3', 'tes', '2024-08-29 20:17:34', '2024-09-10 20:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `last_activity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `created_at`, `updated_at`) VALUES
('YhN0W5YujU3kjV2vlqJqg4ADxXHHClTp7MUOE5Ga', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmZldlkxNFdrMGpncG9Zc2gzT2twblJtOHU5MkFIS3d5dmlnTUFmTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1726026332, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unitkerja_id` bigint(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `is_ditolak` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unitkerja_id`, `username`, `email`, `role`, `password`, `is_active`, `is_ditolak`, `created_at`, `updated_at`) VALUES
(2, NULL, 'Tim Keamanan dan Audit Sistem Informasi LPTSI', 'timkeamananaudit@gmail.com', 'audit', '$2y$12$ASD9y8Yg/KMyHqYvZ1/ZAuPI.EP1IqvWwMPTd4CbDjdhqAMImTIg6', 1, NULL, '2024-06-22 23:25:33', '2024-07-12 17:31:59'),
(3, NULL, 'Administrator', 'admin@gmail.com', 'admin', '$2y$12$ASD9y8Yg/KMyHqYvZ1/ZAuPI.EP1IqvWwMPTd4CbDjdhqAMImTIg6', 1, NULL, '2024-06-30 23:57:52', '2024-06-30 23:57:52'),
(6, NULL, 'Fakultas Kedokteran', 'fakultas.kedokteran@gmail.com', 'unitkerja', '$2y$12$R8TWlf5te5wX14Qbn/8e6.O8Y/vtrivRi7QAqNt4rCsRm0Yur7aMq', 1, NULL, '2024-07-02 15:22:39', '2024-07-02 15:22:39'),
(8, NULL, 'Fakultas Hukum', 'fakultas.hukum@gmail.com', 'unitkerja', '$2y$12$R8TWlf5te5wX14Qbn/8e6.O8Y/vtrivRi7QAqNt4rCsRm0Yur7aMq', 1, NULL, '2024-07-02 15:22:39', '2024-08-14 06:18:47'),
(12, NULL, 'Fakultas Teknik', 'fakultas.teknik@gmail.com', 'unitkerja', '$2y$12$ASD9y8Yg/KMyHqYvZ1/ZAuPI.EP1IqvWwMPTd4CbDjdhqAMImTIg6', 1, 'gokil', '2024-07-22 03:33:19', '2024-08-12 18:28:17'),
(14, NULL, 'Tim Keamanan dan Audit Sistem Informasi', 'timkeamananaudit1@gmail.com', 'audit', '$2y$12$losf75jALMglHqM95mIAo.v4e4faErGN9g2Pjh3r03bSO9.p.xEzm', 2, 'Lu Kocak Bet dah', '2024-07-22 03:34:44', '2024-08-12 18:24:46'),
(15, NULL, 'Administrator', 'administrator@gmail.com', 'admin', '$2y$12$vz80oWuZZQ0tJvNlspke2Oskg97y8T1BhoW3b06t2gh.A8qS8xL6y', 1, NULL, '2024-07-22 03:35:05', '2024-08-15 19:27:19'),
(21, NULL, 'rektor', 'rektor@gmail.com', 'rektor', '$2y$12$jgD/YVo8IUjoP2m9cgU6C.J0Z3DNfcu4Saum9ZrvOLHrdWZc1sAci', 1, NULL, '2024-08-03 06:11:51', '2024-08-03 06:13:22'),
(22, 6, 'Pimpinan Kedokteran', 'pimpinan.kedokteran@gmail.com', 'pimpinan', '$2y$12$PUV.PpHrVuU30en8eYp24OL6F87S0Ycf.CHSl6Fp4CLcwAhlGmsWy', 1, NULL, '2024-08-18 09:19:44', '2024-08-18 09:21:26'),
(23, 12, 'Pimpinan Teknik', 'pimpinan.teknik@gmail.com', 'pimpinan', '$2y$12$aNbFb3Nwid3jvT5bQ68ZZuzBdEZ9G6Jdu2ZzVgrmmlXi.UaO.f5oO', 1, NULL, '2024-08-18 09:22:12', '2024-08-18 09:22:23'),
(27, NULL, 'LPPM', 'lppm@gmail.com', 'unitkerja', '$2y$12$puXnAUtKoPDbiowc93eLq.9QvxQUk8ml80z3U/.q61zbzZ6Nem7d2', 2, 'tes', '2024-08-24 21:45:58', '2024-08-25 21:27:27'),
(28, NULL, 'tes', 'fakultas.tes@gmail.com', 'unitkerja', '$2y$12$R6xeJwNPJQmXJuF8qqOT4eILnv.bhQagTmk2oPqXCp.ab64fU7sha', 2, 'tes', '2024-09-10 20:22:15', '2024-09-10 20:24:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_insidentals`
--
ALTER TABLE `audit_insidentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unitkerja_id` (`unitkerja_id`);

--
-- Indexes for table `audit_rutins`
--
ALTER TABLE `audit_rutins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Baru` (`kode_audit`);

--
-- Indexes for table `dokumen_lapor_insidentals`
--
ALTER TABLE `dokumen_lapor_insidentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen_lapor_rutins`
--
ALTER TABLE `dokumen_lapor_rutins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kode_audits`
--
ALTER TABLE `kode_audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_audit_rutin` (`kode_audit`);

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
-- Indexes for table `pengajuan_insidentals`
--
ALTER TABLE `pengajuan_insidentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan_rutins`
--
ALTER TABLE `pengajuan_rutins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_insidentals`
--
ALTER TABLE `audit_insidentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `audit_rutins`
--
ALTER TABLE `audit_rutins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `dokumen_lapor_insidentals`
--
ALTER TABLE `dokumen_lapor_insidentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumen_lapor_rutins`
--
ALTER TABLE `dokumen_lapor_rutins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kode_audits`
--
ALTER TABLE `kode_audits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengajuan_insidentals`
--
ALTER TABLE `pengajuan_insidentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pengajuan_rutins`
--
ALTER TABLE `pengajuan_rutins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_rutins`
--
ALTER TABLE `audit_rutins`
  ADD CONSTRAINT `Baru` FOREIGN KEY (`kode_audit`) REFERENCES `kode_audits` (`kode_audit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
