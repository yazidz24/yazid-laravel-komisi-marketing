-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_yazid_marketingpenjualan
CREATE DATABASE IF NOT EXISTS `db_yazid_marketingpenjualan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_yazid_marketingpenjualan`;

-- Dumping structure for table db_yazid_marketingpenjualan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
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

-- Dumping data for table db_yazid_marketingpenjualan.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table db_yazid_marketingpenjualan.komisi
CREATE TABLE IF NOT EXISTS `komisi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `marketing` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `omset` bigint NOT NULL,
  `komisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_nasional` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_yazid_marketingpenjualan.komisi: ~6 rows (approximately)
INSERT INTO `komisi` (`id`, `marketing`, `bulan`, `omset`, `komisi`, `komisi_nasional`, `created_at`, `updated_at`) VALUES
	(1, 'Alfandy', 'Mei', 138000000, '2.5%', 3450000, '2025-02-01 10:25:59', '2025-02-01 18:37:56'),
	(2, 'Danang', 'Mei', 44320000, '0%', 0, '2025-02-01 10:26:33', '2025-02-01 15:09:12'),
	(3, 'Mery', 'Mei', 80000000, '0%', 0, '2025-02-01 10:27:56', '2025-02-01 10:27:56'),
	(4, 'Alfandy', 'Juni', 75000000, '0%', 0, '2025-02-01 10:28:49', '2025-02-01 10:28:49'),
	(5, 'Mery', 'Juni', 1010020000, '10%', 101002000, '2025-02-01 10:29:10', '2025-02-01 10:30:06'),
	(6, 'Danang', 'Juni', 205000000, '5%', 10250000, '2025-02-01 10:29:51', '2025-02-01 10:30:20'),
	(13, 'Alfandy', 'Oktober', 4000000, '0%', 0, '2025-02-01 18:48:12', '2025-02-01 18:48:12'),
	(14, 'Alfandy', 'Agustus', 1000000, '0%', 0, '2025-02-01 19:45:42', '2025-02-01 19:45:42');

-- Dumping structure for table db_yazid_marketingpenjualan.kredit
CREATE TABLE IF NOT EXISTS `kredit` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `penjualan_id` bigint unsigned NOT NULL,
  `grand_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kredit_penjualan_id_foreign` (`penjualan_id`),
  CONSTRAINT `kredit_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_yazid_marketingpenjualan.kredit: ~1 rows (approximately)
INSERT INTO `kredit` (`id`, `penjualan_id`, `grand_total`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
	(1, 29, '1010000', '20000', 'Belum lunas', '2025-02-01 19:45:42', '2025-02-01 20:04:10');

-- Dumping structure for table db_yazid_marketingpenjualan.marketing
CREATE TABLE IF NOT EXISTS `marketing` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_yazid_marketingpenjualan.marketing: ~0 rows (approximately)
INSERT INTO `marketing` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Alfandy', '2025-01-31 10:34:22', '2025-01-31 10:34:22'),
	(2, 'Mery', '2025-02-01 08:19:58', '2025-02-01 08:19:58'),
	(3, 'Danang', '2025-02-01 08:20:06', '2025-02-01 08:20:06');

-- Dumping structure for table db_yazid_marketingpenjualan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_yazid_marketingpenjualan.migrations: ~0 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_01_31_133510_create_marketing_table', 1),
	(16, '2025_01_31_133633_create_penjualan_table', 9),
	(17, '2025_01_31_134309_create_komisi_table', 10),
	(18, '2025_02_02_020419_create_kredit_table', 11);

-- Dumping structure for table db_yazid_marketingpenjualan.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_yazid_marketingpenjualan.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table db_yazid_marketingpenjualan.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marketing_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `cargo_fee` int NOT NULL,
  `total_balance` bigint NOT NULL,
  `grand_total` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjualan_marketing_id_foreign` (`marketing_id`),
  CONSTRAINT `penjualan_marketing_id_foreign` FOREIGN KEY (`marketing_id`) REFERENCES `marketing` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_yazid_marketingpenjualan.penjualan: ~0 rows (approximately)
INSERT INTO `penjualan` (`id`, `transaction_number`, `marketing_id`, `date`, `cargo_fee`, `total_balance`, `grand_total`, `created_at`, `updated_at`) VALUES
	(1, 'TRX001', 1, '2023-05-22', 25000, 3000000, 3025000, '2025-02-01 10:25:59', '2025-02-01 18:48:12'),
	(2, 'TRX002', 3, '2023-05-22', 25000, 320000, 345000, '2025-02-01 10:26:33', '2025-02-01 10:26:33'),
	(3, 'TRX003', 1, '2023-05-22', 0, 65000000, 65000000, '2025-02-01 10:26:58', '2025-02-01 10:26:58'),
	(4, 'TRX004', 1, '2023-05-23', 10000, 70000000, 70010000, '2025-02-01 10:27:26', '2025-02-01 10:27:26'),
	(5, 'TRX005', 2, '2023-05-23', 10000, 80000000, 80010000, '2025-02-01 10:27:56', '2025-02-01 10:27:56'),
	(6, 'TRX006', 3, '2023-05-23', 12000, 44000000, 44012000, '2025-02-01 10:28:25', '2025-02-01 10:28:25'),
	(7, 'TRX007', 1, '2023-06-01', 0, 75000000, 75000000, '2025-02-01 10:28:49', '2025-02-01 10:28:49'),
	(8, 'TRX008', 2, '2023-06-02', 0, 85000000, 85000000, '2025-02-01 10:29:10', '2025-02-01 10:29:10'),
	(9, 'TRX009', 2, '2023-06-01', 0, 175000000, 175000000, '2025-02-01 10:29:31', '2025-02-01 10:29:31'),
	(10, 'TRX010', 3, '2023-06-01', 0, 75000000, 75000000, '2025-02-01 10:29:51', '2025-02-01 10:29:51'),
	(11, 'TRX011', 2, '2023-06-01', 0, 750020000, 750020000, '2025-02-01 10:30:06', '2025-02-01 10:30:06'),
	(12, 'TRX012', 3, '2023-06-01', 0, 130000000, 130000000, '2025-02-01 10:30:20', '2025-02-01 10:30:20'),
	(29, 'TRX013', 1, '2023-08-08', 10000, 1000000, 1010000, '2025-02-01 19:45:42', '2025-02-01 19:45:42');

-- Dumping structure for table db_yazid_marketingpenjualan.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
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

-- Dumping data for table db_yazid_marketingpenjualan.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table db_yazid_marketingpenjualan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_yazid_marketingpenjualan.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
