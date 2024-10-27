-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2024 at 10:39 AM
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
-- Database: `sipekalast`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_insidentals`
--

CREATE TABLE `audit_insidentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_audit` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `unitkerja_id` bigint(20) NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `versi` varchar(255) NOT NULL,
  `pendahuluan` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `cakupan_audit` varchar(255) NOT NULL,
  `tujuan_audit` varchar(255) NOT NULL,
  `rekomendasi` varchar(255) NOT NULL,
  `metodologi_audit` varchar(255) NOT NULL,
  `kesimpulan_audit` varchar(255) NOT NULL,
  `hasil_audit` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `audit_rutins`
--

CREATE TABLE `audit_rutins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_audit` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `unitkerja_id` bigint(20) NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `versi` varchar(255) NOT NULL,
  `pendahuluan` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `cakupan_audit` varchar(255) NOT NULL,
  `tujuan_audit` varchar(255) NOT NULL,
  `rekomendasi` varchar(255) NOT NULL,
  `metodologi_audit` varchar(255) NOT NULL,
  `kesimpulan_audit` varchar(255) NOT NULL,
  `hasil_audit` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_rutins`
--

INSERT INTO `audit_rutins` (`id`, `kode_audit`, `user_id`, `unitkerja_id`, `tanggal_mulai`, `tanggal_selesai`, `versi`, `pendahuluan`, `judul`, `cakupan_audit`, `tujuan_audit`, `rekomendasi`, `metodologi_audit`, `kesimpulan_audit`, `hasil_audit`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A0001', 1, 2, '2022-01-01 00:00:00', '2022-01-01 00:00:00', '1.0.0', 'Pendahuluan', 'Judul', 'Cakupan Audit', 'Tujuan Audit', 'Rekomendasi', 'Metodologi Audit', 'Kesimpulan Audit', 'Fakta Audit', 'Draft', NULL, NULL);

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
(6, '2024_05_17_085459_create_pengajuan_rutins_table', 1),
(7, '2024_05_17_085541_create_pengajuan_insidentals_table', 1),
(8, '2024_05_17_085557_create_audit_insidentals_table', 1),
(9, '2024_05_17_085607_create_audit_rutins_table', 1),
(10, '2024_05_18_062212_create_dokumen_lapor_rutins_table', 1),
(11, '2024_05_18_062354_create_dokumen_lapor_insidentals_table', 1),
(12, '2024_06_07_153222_add_role_to_users_table', 1),
(13, '2024_06_15_011227_kode_audit_rutin', 1),
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
  `tanggal_pengajuan` datetime NOT NULL,
  `nama_sistem` varchar(255) NOT NULL,
  `kendala` varchar(255) NOT NULL,
  `keterangan` longtext NOT NULL,
  `foto` text NOT NULL,
  `status_approved` int(11) NOT NULL,
  `is_ditolak` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_rutins`
--

CREATE TABLE `pengajuan_rutins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pengajuan` datetime NOT NULL,
  `nama_sistem` varchar(255) NOT NULL,
  `versi` varchar(255) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `dokumen` text NOT NULL,
  `status_approved` int(11) NOT NULL,
  `is_ditolak` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('vCePYlD7VjdbJRyT2FPXb9VJlttCxhblzeIkaibQ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36 Edg/129.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUm0xMnU2OUluZlVoUlR5aTI1T09xV0QwMEQ2RmoyV1ZBNHZMbWdUOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRoL2F1dGgvZGFzaGJvYXJkLWF1ZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1728275382, NULL, NULL);

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
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_ditolak` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unitkerja_id`, `username`, `email`, `role`, `password`, `is_active`, `is_ditolak`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Tim Keamanan dan Audit Sistem Informasi', 'timkeamananaudit@gmail.com', 'audit', '$2y$12$7kMDQ6j37y4joI1IC680BemY8dCmw7IRn8OepPfj.SVdIQ1YG00ra', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_insidentals`
--
ALTER TABLE `audit_insidentals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_rutins`
--
ALTER TABLE `audit_rutins`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_rutins`
--
ALTER TABLE `audit_rutins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengajuan_insidentals`
--
ALTER TABLE `pengajuan_insidentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengajuan_rutins`
--
ALTER TABLE `pengajuan_rutins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
