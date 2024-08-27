-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL


-- Dumping structure for table sipeka.audit_insidentals
CREATE TABLE  `audit_insidentals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pelaporan_insidental_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `pendahuluan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cakupan_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tujuan_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metodologi_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasil_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rekomendasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kesimpulan_audit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Dumping structure for table sipeka.audit_rutins
CREATE TABLE  `audit_rutins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pelaporan_rutin_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `tanggal_audit` datetime NOT NULL,
  `nama_sistem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `versi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keamanan_sistem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bahasa_pemrograman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `framework` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `maksimum_penyimpanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maksimum_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengguna_sistem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'diedit',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `audit_rutins` (`id`, `pelaporan_rutin_id`, `user_id`, `tanggal_audit`, `nama_sistem`, `versi`, `keamanan_sistem`, `bahasa_pemrograman`, `framework`, `maksimum_penyimpanan`, `maksimum_pengguna`, `pengguna_sistem`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'AUDIT-A01', 1, '2024-06-15 00:00:00', 'Testingq', '3', '3', '3', '3', '3', '3', '3', 'terproses', '2024-06-14 20:40:08', '2024-06-15 10:52:27'),
	(15, 'AUDIT-A01', 1, '2024-06-16 00:00:00', 'Testingq', '31', '3', '3', '3', '3', '3', '3', 'diedit', '2024-06-15 10:38:24', '2024-06-15 10:54:39');

-- Dumping structure for table sipeka.dokumen_lapor_insidentals
CREATE TABLE  `dokumen_lapor_insidentals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pelaporan_insidental_id` bigint unsigned NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipeka.dokumen_lapor_insidentals: ~0 rows (approximately)


-- Dumping structure for table sipeka.dokumen_lapor_rutins
CREATE TABLE  `dokumen_lapor_rutins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pelaporan_rutin_id` bigint unsigned NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipeka.dokumen_lapor_rutins: ~0 rows (approximately)

-- Dumping structure for table sipeka.failed_jobs
CREATE TABLE  `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipeka.failed_jobs: ~0 rows (approximately)


-- Dumping structure for table sipeka.kode_audits
CREATE TABLE `kode_audits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_audit_rutin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Dumping structure for table sipeka.migrations
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipeka.migrations: ~14 rows (approximately)

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

-- Dumping structure for table sipeka.password_reset_tokens
CREATE TABLE  `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- Dumping structure for table sipeka.pelaporan_insidentals
CREATE TABLE  `pelaporan_insidentals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tanggal_lapor` datetime NOT NULL,
  `nama_sistem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kendala` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Dumping structure for table sipeka.pelaporan_rutins
CREATE TABLE  `pelaporan_rutins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tanggal_lapor` datetime NOT NULL,
  `nama_sistem` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `versi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- Dumping structure for table sipeka.personal_access_tokens
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



-- Dumping structure for table sipeka.sessions
CREATE TABLE  `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipeka.sessions: ~2 rows (approximately)

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`, `created_at`, `updated_at`) VALUES
	('InVqT6anieXU9XUjNnxIlfjzeq5bxm0gWOA8u98a', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMTJ2bHpXeXF0M05QUVJ6eVZyRXFvUzJwM2VZcFJTMGdvZG1OdkhFZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hdXRoL3BlbmluZGFrYW4tcnV0aW4vY3JlYXRlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1718474512, NULL, NULL),
	('RvY5BU4PmMgMDV9lffSehEPS0VSB4WrK3Jt2BCWi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlJiajlHcjFZT1l3RDBLOG16VzlWTnRqTGNHbmRjWTBwdFdqeVA1aSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1718547049, NULL, NULL);

-- Dumping structure for table sipeka.users
CREATE TABLE  `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table sipeka.users: ~1 rows (approximately)

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
	(1, 'keamananaudit', 'keamananaudit@gmail.com', 'audit', '$2y$12$sPWrQ93V6ad4HOgwvRSnye1mgNnqZJny9iUbBqeUkjeJhJNctGXBe', '2024-06-14 20:38:35', '2024-06-14 20:38:35');

