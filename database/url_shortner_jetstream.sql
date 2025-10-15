-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: url_shortner_jetstream
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `owner_user_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_name_unique` (`name`),
  UNIQUE KEY `companies_email_unique` (`email`),
  KEY `companies_owner_user_id_foreign` (`owner_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Mante Ltd','vgrady@conroy.biz','2025-10-15 06:17:32','2025-10-15 06:17:32',1),(2,'Ratke, Spencer and Pfeffer','dillan74@borer.biz','2025-10-15 06:17:32','2025-10-15 06:17:32',1),(3,'Macejkovic-Cassin','rogahn.maryam@rau.com','2025-10-15 06:17:32','2025-10-15 06:17:32',4),(4,'Ankunding-Doyle','chaim.roberts@bruen.biz','2025-10-15 06:17:32','2025-10-15 06:17:32',7),(5,'Orn-Hartmann','maxine.jerde@waters.com','2025-10-15 06:17:32','2025-10-15 06:17:32',8),(6,'Moen LLC','freddie49@harber.biz','2025-10-15 06:17:32','2025-10-15 06:17:32',3),(7,'McDermott-Kessler','demario.metz@rutherford.com','2025-10-15 06:17:32','2025-10-15 06:17:32',1),(8,'O\'Conner LLC','elva41@anderson.com','2025-10-15 06:17:32','2025-10-15 06:17:32',2),(9,'Ferry-Skiles','whamill@raynor.biz','2025-10-15 06:17:32','2025-10-15 06:17:32',9),(10,'Cartwright Ltd','mckenzie.kirstin@halvorson.net','2025-10-15 06:17:32','2025-10-15 06:17:32',10);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2025_10_14_142416_create_sessions_table',1),(7,'2025_10_14_150000_add_role_and_company_id_to_users_table',1),(8,'2025_10_14_151000_create_companies_table',1),(9,'2025_10_14_152000_create_short_urls_table',1),(10,'2025_10_15_113853_add_client_id_to_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('t8KeMXJnixPOkK8fTGfinxyiWFrUZO4jVNj6T9bZ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzBDTzVib3ZuVFo0TDZ6SkJpUTNjWGpEcjdNdXZWREZWTWIwd2xkeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=',1760538354);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `short_urls`
--

DROP TABLE IF EXISTS `short_urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `short_urls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `original_url` varchar(2048) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_code` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `access_count` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `short_urls_short_code_unique` (`short_code`),
  KEY `short_urls_company_id_foreign` (`company_id`),
  KEY `short_urls_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `short_urls`
--

LOCK TABLES `short_urls` WRITE;
/*!40000 ALTER TABLE `short_urls` DISABLE KEYS */;
INSERT INTO `short_urls` VALUES (1,7,1,'http://walter.org/ut-delectus-rem-molestias-aut-accusamus-earum-repellendus','z6XRltEb',1,'2025-09-04 16:27:29','2025-04-17 13:15:03',2256),(2,5,1,'https://www.turner.com/quaerat-corporis-nihil-et-hic-pariatur-itaque-praesentium','7upa6jBN',1,'2025-05-01 23:57:06','2025-06-15 11:21:39',2032),(3,5,1,'http://www.sawayn.com/temporibus-voluptatem-similique-sed','N3uqgg1l',1,'2025-05-07 09:08:56','2025-09-28 04:21:50',2852),(4,5,1,'http://lakin.com/ab-dolor-et-saepe-distinctio-molestiae-eos','D5bcfr8A',1,'2025-08-08 22:19:29','2025-07-20 16:32:41',4577),(5,1,1,'https://www.tromp.info/molestias-sint-occaecati-fuga-voluptas-accusamus-iste','pVwXZnvR',1,'2025-04-10 14:12:59','2025-07-23 12:18:58',470),(6,1,1,'https://www.kiehn.info/beatae-id-distinctio-pariatur-cupiditate-non-eum-quas','AS1th8Jv',1,'2025-06-01 04:15:11','2025-06-07 08:27:25',1547),(7,1,1,'https://www.schroeder.com/totam-delectus-nobis-voluptas-dignissimos-sed','uKARJDO4',0,'2025-05-24 12:52:35','2025-05-30 17:22:40',120),(8,2,1,'http://heathcote.com/saepe-vero-est-autem-sed-quia-dolor-non-quas','naeKyHEu',1,'2025-08-04 23:22:52','2025-08-27 09:54:42',3),(9,2,1,'http://tillman.com/ipsam-ratione-et-facere.html','soD6cQ5C',1,'2025-03-21 09:53:12','2025-10-10 03:48:23',3569),(10,6,1,'http://hauck.com/ex-voluptatem-doloribus-laborum-ut-perspiciatis-alias-quibusdam.html','ZeMufAt9',1,'2025-03-28 17:23:30','2025-08-04 19:40:41',2793),(11,10,1,'http://heaney.com/repudiandae-velit-sunt-eaque-sed-aut-autem-cum','lAcxvV8Z',1,'2024-10-29 01:27:02','2025-08-18 13:26:48',1739),(12,7,1,'https://lehner.com/voluptatem-dolor-cum-debitis-pariatur-voluptate-alias-nesciunt-at.html','kaFwaG36',1,'2025-01-09 12:23:12','2025-07-28 11:57:12',610),(13,3,1,'http://www.ebert.info/facere-necessitatibus-id-aut-repellendus-eos-sint-non','TmVGDJ1A',1,'2025-04-18 21:41:41','2025-07-23 07:24:43',3779),(14,5,1,'https://cruickshank.com/ullam-dicta-ut-fuga-sunt.html','DPVeq33L',1,'2025-07-06 14:12:47','2025-08-09 14:32:54',2440),(15,7,1,'http://www.hoeger.com/error-odit-modi-praesentium-est.html','p29esOf0',1,'2024-12-20 10:14:50','2025-06-01 04:15:27',4741),(16,3,1,'http://www.kuhic.com/earum-nostrum-deleniti-qui-voluptate-quibusdam.html','asP31jNy',1,'2025-09-01 23:57:15','2025-04-24 05:15:23',2025),(17,3,1,'http://www.veum.com/nostrum-nam-ipsam-hic-maxime-officia-magnam-ad','OdBLh0L1',1,'2025-06-13 18:03:23','2025-05-20 21:28:49',1796),(18,10,1,'https://prohaska.com/eos-non-velit-cum-minus-ut.html','KQks8AR3',1,'2025-03-11 22:26:54','2025-08-23 02:57:09',4612),(19,4,10,'https://www.kunde.org/odio-modi-commodi-aut-dolorem','GCIMM4fi',0,'2025-06-24 07:06:37','2025-08-03 12:13:04',3392),(20,1,1,'http://west.net/asperiores-qui-quia-eum-reprehenderit-sed','ACwwcqi3',1,'2025-08-19 23:52:28','2025-05-10 08:21:11',1505),(21,9,1,'http://www.kassulke.com/voluptates-est-reiciendis-voluptatem-delectus-iure.html','qtmQSvbX',1,'2025-01-02 16:53:44','2025-07-21 17:27:53',2698),(22,3,1,'http://howell.com/','2bBxkrTT',1,'2025-07-09 10:53:27','2025-07-08 21:40:23',3651),(23,5,1,'http://www.roberts.com/culpa-qui-beatae-animi-veniam-aut-ullam.html','tJVdPxxD',1,'2025-02-04 02:03:22','2025-06-11 02:22:29',1447),(24,7,1,'https://www.west.com/omnis-eum-consequatur-qui-optio-fugit','bemtPpPi',1,'2025-06-20 13:32:50','2025-09-14 17:26:19',2602),(25,6,1,'http://romaguera.com/est-recusandae-consequatur-laudantium-maxime-nihil.html','3FznMJD2',1,'2025-07-06 03:03:25','2025-05-31 05:45:25',3162),(26,2,1,'http://www.crooks.org/occaecati-consequatur-molestias-aliquid-velit-omnis-voluptas-non','eeWuStxB',1,'2025-06-23 09:21:26','2025-10-01 23:47:11',918),(27,8,1,'http://www.swaniawski.com/','vPuvbyT4',0,'2025-09-03 15:50:21','2025-04-25 03:10:36',2438),(28,2,1,'http://www.herman.com/quia-sunt-vitae-quia','yzcjKUIJ',1,'2025-03-30 18:51:52','2025-05-11 21:09:37',3809),(29,5,1,'http://www.bayer.com/','W2cGLnUz',1,'2024-12-30 23:23:44','2025-06-21 16:28:49',378),(30,8,1,'https://von.com/maxime-quis-aliquam-ipsam-voluptatem-accusamus-doloremque-neque-nobis.html','G1lahKth',1,'2025-07-13 04:34:20','2025-04-20 05:59:15',2833),(31,7,1,'http://waelchi.net/quas-consequuntur-at-illo-similique-quo-voluptas','dxzRJjoQ',1,'2025-07-08 22:46:43','2025-07-16 22:23:38',4570),(32,10,1,'http://www.anderson.com/','7EzhXfB7',1,'2025-09-08 09:37:27','2025-05-12 17:47:42',4057),(33,4,7,'https://fay.com/labore-non-repellat-vero-in-et-dolore-blanditiis.html','t2ZdC2ka',1,'2025-04-01 17:00:01','2025-04-27 19:10:01',1199),(34,6,1,'http://www.lemke.com/','GZgtbuXS',1,'2024-12-09 15:13:07','2025-10-05 03:15:22',2942),(35,4,11,'http://kertzmann.com/nesciunt-repellendus-id-harum-eius-magni-velit-quis.html','FEgjtkUk',1,'2025-05-21 03:58:11','2025-06-05 00:42:27',4524),(36,10,1,'http://bode.com/dolorem-laudantium-voluptatem-est.html','cPBghrhu',0,'2025-05-02 06:50:23','2025-07-18 14:20:26',4304),(37,1,1,'http://www.legros.com/et-nulla-eum-nesciunt-harum-incidunt','v1VJMI97',1,'2024-10-22 03:08:00','2025-09-22 02:48:50',435),(38,4,10,'http://rowe.net/eligendi-autem-nisi-rerum-porro-atque','jeBTdH7V',1,'2025-05-24 11:14:21','2025-07-30 06:16:13',3343),(39,10,1,'http://ondricka.info/','6Tz5lg8H',1,'2024-11-02 15:47:45','2025-05-23 17:06:21',1923),(40,9,1,'http://wolff.org/','iEFEDSES',0,'2025-06-26 14:54:22','2025-09-04 11:58:20',3056),(41,5,1,'https://becker.com/quia-vitae-minima-est.html','lXu4s64Q',1,'2024-10-15 15:53:17','2025-06-10 00:38:47',1679),(42,8,1,'http://www.murazik.com/itaque-quisquam-exercitationem-est-ex','ky0J6ixn',1,'2025-08-20 19:28:15','2025-07-05 08:47:23',1307),(43,10,1,'http://www.mertz.com/sit-ea-quos-provident-ex-iure-in-ut-deserunt','RrBEyW5S',1,'2025-09-07 15:45:39','2025-10-06 15:43:46',782),(44,2,1,'http://prohaska.net/odit-rerum-fugiat-et-velit','3vzRbzSo',1,'2025-09-07 03:55:26','2025-07-06 00:41:03',2145),(45,7,1,'https://www.abbott.biz/provident-nostrum-expedita-voluptate-molestiae','3xH2spEe',1,'2024-10-27 19:13:31','2025-08-28 21:10:26',4064),(46,10,1,'http://lynch.info/minus-totam-tempore-at-voluptatem-nostrum-commodi-molestiae','gX4BHaTK',0,'2024-12-30 14:40:42','2025-06-30 00:58:24',1642),(47,1,1,'http://bednar.com/ducimus-blanditiis-perferendis-accusamus.html','2ekXDGoM',1,'2025-03-13 15:02:54','2025-05-09 11:30:32',1177),(48,8,1,'http://www.morissette.com/sint-quis-veniam-sunt-qui-sed-rem-consequatur-excepturi','xHqMtIAz',0,'2025-06-04 23:39:16','2025-07-11 09:22:10',251),(49,3,1,'http://considine.biz/doloribus-omnis-ea-esse-voluptas-sit-veniam-ullam','Yvnrv52W',1,'2025-05-12 01:34:37','2025-10-13 20:50:51',3632),(50,10,1,'http://www.gleichner.com/quibusdam-inventore-excepturi-aspernatur-alias-dolorem','rAPAso6p',1,'2025-03-24 00:34:56','2025-07-09 11:41:37',1296),(51,6,4,'https://www.google.com/','6Yt73f',1,'2025-10-15 07:50:46','2025-10-15 07:50:46',0),(52,4,9,'https://github.com/aadhar41/','gVIzeE',1,'2025-10-15 07:52:26','2025-10-15 07:52:26',0);
/*!40000 ALTER TABLE `short_urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company_id` bigint unsigned DEFAULT NULL,
  `role` enum('SuperAdmin','Admin','Member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Member',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_client_id_foreign` (`client_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,2,'Member','Abigail Leannon','brandyn67@example.org','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'Sds0ZA8ReW',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',NULL),(2,2,'SuperAdmin','Super Admin','superadmin@example.com','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'2ovzpr9FTTSSSNocFTUdYTTZAQb2EQj9cMu3rJpfcpcOMtMTAJzBcqcg9RRV',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',4),(3,7,'Member','Lydia Strosin DVM','mia.osinski@example.org','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'ENbrOKPvUM',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',9),(4,6,'Member','Jewell Ferry','amoore@example.net','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'fKhayR04UQAq4nxHC7MlPOctOiS3O7Y1dwp9TGhvL6iAjVKTNGF8TrT5f1hn',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',3),(5,2,'Member','Korbin Weimann','rosenbaum.wellington@example.org','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'m9bYdUE1v8',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',2),(6,1,'Member','Dr. Brain Hoppe','cartwright.rhea@example.org','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'XTH6GHxEHv',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',9),(7,4,'Member','Jacky Lueilwitz V','ronny08@example.org','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'yrtG5CwvyM',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',10),(8,3,'Member','Lou Keebler II','hheathcote@example.org','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'Rp71L85I89',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',2),(9,4,'Admin','Miss Emie Padberg DVM','wkuvalis@example.com','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'BGkJ2bvFZoCXfuAQEors8CrFNBd7QyxwIx98vlOislrDPX3AzgTSE5Bla7qM',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',10),(10,4,'Member','Isai Altenwerth','malinda84@example.net','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'KZDlp3hDmW',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',3),(11,4,'Admin','Ms. Olga Roberts I','eokuneva@example.com','2025-10-15 06:17:32','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',NULL,NULL,NULL,'RjSiTQrlI6',NULL,NULL,'2025-10-15 06:17:32','2025-10-15 06:17:32',2),(12,NULL,'Member','Alea Shaw','hotizegyz@mailinator.com',NULL,'$2y$12$Lbc6SNfica57Vz9xiVBKxeJE5iXQscZd9tfjZk5WtQXK8iJj1r/ci',NULL,NULL,NULL,NULL,NULL,NULL,'2025-10-15 06:55:08','2025-10-15 06:55:08',NULL),(13,NULL,'Member','Linda Walter','byte@mailinator.com',NULL,'$2y$12$3aiW9Wjrk.2n5wy1zdIcAeszBY7GbIodHQ9cBVQNYXIg.gYeako2C',NULL,NULL,NULL,NULL,NULL,NULL,'2025-10-15 08:15:52','2025-10-15 08:15:52',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-15 20:13:43
