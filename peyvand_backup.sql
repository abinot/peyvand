-- MySQL dump 10.13  Distrib 8.4.11, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: laravel_db
-- ------------------------------------------------------
-- Server version	8.4.11-0ubuntu0.26.04.1

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_categories`
--

DROP TABLE IF EXISTS `link_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `link_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_categories_team_id_slug_unique` (`team_id`,`slug`),
  CONSTRAINT `link_categories_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_categories`
--

LOCK TABLES `link_categories` WRITE;
/*!40000 ALTER TABLE `link_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_clicks`
--

DROP TABLE IF EXISTS `link_clicks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `link_clicks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link_id` bigint unsigned NOT NULL,
  `ip_hash` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `utm_parameters` json DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `device_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `link_clicks_link_id_created_at_index` (`link_id`,`created_at`),
  CONSTRAINT `link_clicks_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_clicks`
--

LOCK TABLES `link_clicks` WRITE;
/*!40000 ALTER TABLE `link_clicks` DISABLE KEYS */;
INSERT INTO `link_clicks` VALUES (1,2,'a08b243d7f0534b8b72bb5f056b578f4212f0a59d2e62667e4f110578fb2e795','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:154.0) Gecko/20100101 Firefox/154.0',NULL,NULL,NULL,'2026-10-30 19:12:58','desktop','Firefox','Linux'),(2,2,'a08b243d7f0534b8b72bb5f056b578f4212f0a59d2e62667e4f110578fb2e795','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:154.0) Gecko/20100101 Firefox/154.0',NULL,'{\"utm_source\": \"peyvand\", \"utm_content\": \"hello world\", \"utm_campaign\": \"1\"}',NULL,'2026-10-30 19:14:16','desktop','Firefox','Linux'),(3,4,'a08b243d7f0534b8b72bb5f056b578f4212f0a59d2e62667e4f110578fb2e795','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:154.0) Gecko/20100101 Firefox/154.0',NULL,'{\"utm_term\": \"appliances\", \"utm_medium\": \"social\", \"utm_source\": \"telegram\", \"utm_content\": \"post_02\", \"utm_campaign\": \"autumn_sale\"}',NULL,'2026-10-30 19:17:46','desktop','Firefox','Linux'),(4,3,'a08b243d7f0534b8b72bb5f056b578f4212f0a59d2e62667e4f110578fb2e795','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:154.0) Gecko/20100101 Firefox/154.0',NULL,'{\"utm_term\": \"home_appliances\", \"utm_medium\": \"social\", \"utm_source\": \"bale\", \"utm_content\": \"banner_blue\", \"utm_campaign\": \"autumn_sale\"}',NULL,'2026-10-30 19:18:06','desktop','Firefox','Linux');
/*!40000 ALTER TABLE `link_clicks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_folders`
--

DROP TABLE IF EXISTS `link_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `link_folders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'zinc',
  `position` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_folders_team_id_name_unique` (`team_id`,`name`),
  KEY `link_folders_team_id_position_index` (`team_id`,`position`),
  CONSTRAINT `link_folders_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_folders`
--

LOCK TABLES `link_folders` WRITE;
/*!40000 ALTER TABLE `link_folders` DISABLE KEYS */;
INSERT INTO `link_folders` VALUES (1,1,'سلام','zinc',0,'2026-10-30 18:43:48','2026-10-30 18:43:48'),(2,1,'کمپین تبلیغاتی شماره ۱','zinc',0,'2026-10-30 19:16:49','2026-10-30 19:16:49');
/*!40000 ALTER TABLE `link_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_tag_link`
--

DROP TABLE IF EXISTS `link_tag_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `link_tag_link` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `link_id` bigint unsigned NOT NULL,
  `link_tag_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_tag_link_link_id_link_tag_id_unique` (`link_id`,`link_tag_id`),
  KEY `link_tag_link_link_tag_id_index` (`link_tag_id`),
  CONSTRAINT `link_tag_link_link_id_foreign` FOREIGN KEY (`link_id`) REFERENCES `links` (`id`) ON DELETE CASCADE,
  CONSTRAINT `link_tag_link_link_tag_id_foreign` FOREIGN KEY (`link_tag_id`) REFERENCES `link_tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_tag_link`
--

LOCK TABLES `link_tag_link` WRITE;
/*!40000 ALTER TABLE `link_tag_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_tag_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `link_tags`
--

DROP TABLE IF EXISTS `link_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `link_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_tags_team_id_slug_unique` (`team_id`,`slug`),
  CONSTRAINT `link_tags_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_tags`
--

LOCK TABLES `link_tags` WRITE;
/*!40000 ALTER TABLE `link_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `link_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `links` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint unsigned NOT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clicks` bigint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `expires_at` timestamp NULL DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `tracking_rules` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `folder_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `links_code_unique` (`code`),
  KEY `links_created_by_foreign` (`created_by`),
  KEY `links_team_id_created_at_index` (`team_id`,`created_at`),
  KEY `links_folder_id_foreign` (`folder_id`),
  KEY `links_category_id_foreign` (`category_id`),
  KEY `links_team_id_folder_id_index` (`team_id`,`folder_id`),
  KEY `links_team_id_category_id_index` (`team_id`,`category_id`),
  CONSTRAINT `links_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `link_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `links_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `links_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `link_folders` (`id`) ON DELETE SET NULL,
  CONSTRAINT `links_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (2,1,1,'ab1','https://abinot.ir','اَبینوت',2,1,NULL,'{\"page\": \"1\", \"utm_defaults\": {\"utm_source\": \"peyvand\", \"utm_campaign\": \"1\"}, \"utm_test_value\": \"hello world\"}','{\"utm\": {\"utm_content\": \"{{utm_test_value}}\"}, \"query\": {\"page\": \"{{page}}\"}}','2026-10-30 19:12:55','2026-10-30 19:14:16',NULL,NULL),(3,1,1,'autumn01','https://example.com/product','کمپین بله',1,1,NULL,'{\"os\": \"Android\", \"city\": \"بوشهر\", \"note\": \"داده آزمایشی\", \"device\": \"mobile\", \"status\": \"active\", \"browser\": \"Chrome\", \"contact\": {\"name\": \"علی رضایی\", \"email\": \"ali@example.com\", \"phone\": \"enc:eyJpdiI6IjJxK1VPSlgrZ0JyR0RtenhtU2xBOGc9PSIsInZhbHVlIjoiMGZTMlBoL2JTeWl6RTR0NjNxRUNFZz09IiwibWFjIjoiYzRhZDNhYzc3ZTU1MmY2NDQ3MmFlYTJjZTUyZTNlMmE4YjQ4ZDVmMjVlYTFjOTk4YjE0OWFmY2UyYTQ3M2M0MSIsInRhZyI6IiJ9\"}, \"country\": \"IR\", \"province\": \"بوشهر\", \"utm_defaults\": {\"utm_term\": \"home_appliances\", \"utm_medium\": \"social\", \"utm_source\": \"bale\", \"utm_content\": \"banner_blue\", \"utm_campaign\": \"autumn_sale\"}}',NULL,'2026-10-30 19:16:49','2026-10-30 19:18:06',2,NULL),(4,1,1,'autumn02','https://example.com/category','کمپین تلگرام',1,1,NULL,'{\"os\": \"Linux\", \"city\": \"اهرم\", \"note\": \"داده آزمایشی دوم\", \"device\": \"desktop\", \"status\": \"active\", \"browser\": \"Firefox\", \"contact\": {\"name\": \"مریم احمدی\", \"email\": \"maryam@example.com\", \"phone\": \"enc:eyJpdiI6IklXd0s0SlBDVGMrSndUdmZXYmJ3VXc9PSIsInZhbHVlIjoiUDRDenVlTjdMRUZ5NFhlZGF4SmNqZz09IiwibWFjIjoiMWU2OGU0YzlhODEzZDA1NzFkOGQ1NTg2NzM2MTY2NjI5MzhmY2I1YTRkYmViYmZlMTAwZmUyYTRmZjI3ODQ2ZSIsInRhZyI6IiJ9\"}, \"country\": \"IR\", \"province\": \"بوشهر\", \"utm_defaults\": {\"utm_term\": \"appliances\", \"utm_medium\": \"social\", \"utm_source\": \"telegram\", \"utm_content\": \"post_02\", \"utm_campaign\": \"autumn_sale\"}}',NULL,'2026-10-30 19:16:49','2026-10-30 19:17:46',2,NULL);
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_01_01_000000_create_passkeys_table',1),(5,'2025_08_14_170933_add_two_factor_columns_to_users_table',1),(6,'2026_01_27_000001_create_teams_table',1),(7,'2026_01_27_000002_add_current_team_id_to_users_table',1),(8,'2026_10_19_155059_create_links_table',1),(9,'2026_10_19_155100_create_link_clicks_table',1),(10,'2026_10_30_000001_add_team_link_management_features',1),(11,'2026_10_31_000001_simplify_link_group_imports',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passkeys`
--

DROP TABLE IF EXISTS `passkeys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `passkeys` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credential_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credential` json NOT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `passkeys_credential_id_unique` (`credential_id`),
  KEY `passkeys_user_id_index` (`user_id`),
  CONSTRAINT `passkeys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passkeys`
--

LOCK TABLES `passkeys` WRITE;
/*!40000 ALTER TABLE `passkeys` DISABLE KEYS */;
/*!40000 ALTER TABLE `passkeys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('029QbvMzgQErMPJTduRAkL4IAUUtMuSjVmKTLl2I',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJzY2VKVXpyUkhvMUNzSThZcE5rckx5cXd4Q3hwa2dzZTFyQjlYQlpsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399442),('09x1pn4epkYwy6eJ8krmSL1oRWJrlocUSvhbNHO6',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ0Q0s0cE4yNHZsNGpMeDJ4eUxOMXZyZDdrSFB5cFIxbnJReFRlZ3NDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395777),('0JYepMG5zF3PgRS3GqdmnntuW8C54BNdnSzRzUZ3',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJaejFaZjBZWjhCcG8yN3J4MzRYbEIwVGNnWFJLbnY2WFhyQjV0VmI0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396047),('0MmhSOZz9bYPVzIlY251uT4TgckAN3SxmO0ZVidn',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJoRWpaMWpnck9KVFZ2a2RURjR0aFh3eWdTUWo5bW56VERxNlQxUDRHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395055),('0pgjCYC0RV4uFV1RdIGZd1hSHbFvfeaBFHr7dFpW',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ6UXA4MFJVNERHWTNrN0Jmenh1Y1BrOTRXYXl3WFRac09zS29OQUU1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396709),('0uFFFwpnuGIW8Et0iOBMaMopsS8cWyd8B6DbKDlz',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJIekhZU28yMXBaQkR4UE9DcFJYalVmdGF4bFoyS2pDSXVOdkpwV3FjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395296),('1c8wtg7H537X8aIdcNBLt2edmg4KMOwNhgsOHwWg',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI1SWlmOXVOd2d6RDJORUxIU3BWRkpwSUhXQnVUUG5mOGh5UEZzWk5aIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397581),('1cLKIWMZlZBoj7kQIZfdV7lhIJhwne4dzdAzqFIV',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJJa3h2aTR4OTRkaXRyY0pQWGI2d3hlc1Iya05lWGhzcHhKOVdRSm0zIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397611),('1ELBbY9II1fe8dLV934phBHhx88VJ62bP3IyEoFH',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJrUklUY0xrUjQ3TGg5ZzVxV0FIQ0piN2xUemxLMFZheVVodFFGRDZsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399262),('1MKkFmYnjcXIGrVpQB1I8M11ndyjK4mlR8rkLcCG',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ3MXg0TmxxNWx6aHdpRllqaXBGNTN6R29OMERKTnUzMXZ6YmxodTNkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396498),('235O6Q85vhhEGZgnXZrw0FujYjZBqcGF0fa4SkRJ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJueTdJQlhDUW53ZHJqNkFHSjhWbmhlM2x4QUtoMUdtaW02QzQ5VDlFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398962),('274ZvOMdC3utfiBPiYTzngLB3H8xBZGtlKRh9rue',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJQS1BhRHhkOWxKRVNqMFdwZHpGaEljckVQUTlYNXc0c09aMk9GSmFkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398001),('2qwpyCG0mJPb2Vf8b8nDdQ1lrdnGrP1nISlA1Asf',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJqbDJtcnl0UnRHclhWNHJlNXFJM2c4TU0yNkZnQnZuVGk1M2tLZXpwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400559),('49YAoBcsuHRlSpDxj4khLDgzSNROoX9lNb4mlOKh',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI4UmxHQ21tWjIybVNpNWJvQXVmaFRoOHpqYTRSY3laN3F4SDNtWHZnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400379),('4QW8FuI5GMgmuYmM85GGkW6wPCOxMvuCrQQz5BHZ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJndmN0UHNzZmZubnp3S0JMQk5HeXpHUFFzZzFvQWlRUjBNR2hUYm1lIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397100),('5DaNNQVc3c6XYHU0vDyowWkDKRINWLHIN90O8z9H',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJRc2U3ODNrMnpuUzVldlFMM0VaTUdjVWhoWnkwak9aQ3dhZTJMT0FDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397250),('5ehRbiVbJvFpaoIPA9N2RhWj4JXHQlLhYdAenttD',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJaTWFUM3M3cm9WTWtBQnNkT3gxTUxFSnM5amNkWDJwS1NuZFlINzlTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394784),('5u1kDTQu0YWk5rG9nj9GzSUWL3El9PsNc9KLzMke',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJyYlRYcXE4bnNzUEprNTdGTlRMWEhyY1VuWGk1b1JYc05rb0RkWklqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396649),('5vXXxA3EhulcwEBBqLDC3nx6hixIxtFkuObsUGOj',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJqMVNDM1NuSEtzUUEwRm4xcXdnTGFtdFBMcWlWRVFRM294bk9WWGJEIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398872),('6hKUxApE1HMhh1fOODcghFjl2mCCEqxxzF3WgErr',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI1NGI4dGtXYUNob1I5N2NZeU55UDJJS3RWUXVQbldNQjI4Qld3UjkyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396438),('6pHD4LpPLZTi8rpoYtRFtpWprYlRUxJMss4VMmbc',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJlanp3R1hURDdmR1BtcEVERE1NVUs4Wkp4cm9QcFVVVGdYQ2tVWllnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401430),('7l4y1nJimQhQnDhVROdQCRe7pVbX5FCUBo2BrsCm',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJSNFI0QXVHNzQ4YVdGWnJsRWloNGw5eVBjQmEzMW15cUI3WjJxZnZsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401340),('7u5Is5GYzpldIXtRme5H1FtKEItzHYfAGz2Ni4wv',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJqYWUyMmtIeFJqTGNWV25EYWRocngyRkpGTnZxU2tSajJjaUZkWjduIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400199),('7vezvVhieQxc1jrlP04JxB52lt7UPbrVSgCS3RPD',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJUSjJGdFZTZVlVUHNYRW01U1h0aG9IeUhvRVNwR0k2YzRiSkZMTVVlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397941),('83oAVGd6nqQAvXJqIuNJWBHDfeZoPb80esnCYPyJ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI4dnF6OFVraDZ5UXVuUUhpWWZRdFB4bGJzTEd1aDZIWHpEbW54cG1vIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396769),('880pGK1EcdGfSJsOnbNdtLfJS8wH6KtMSVrHMexC',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJiMzJZdHNSbXZsU0FKSmdwdnJaeERsQVRJNVM2Y3dGaWl3eXhQd3dXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401160),('881dQhxQzXmnRrg234H4K1hgBXEVdHPN7rs4BevV',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIyYXRmcFhHNmtYSEJQd0pFR3JJRmNsbGY1a2htRDVvS3NJYXNJTmdtIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401190),('8frhDsWDnSEQQwPJ2tUMsKxKicGIbBqOh5SqFprs',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJwT2pqY2dSY21acU1uYmpDUTdoamlHMFJwYnFZbHdCOHFjT2Zhek9NIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399052),('8ILLQ1OGm5aF51SYp8UE2XZBKhDUu4tPKTcOInF8',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIxbTJFSHZjWURWUENFRlVvREtZM1BRb3ZSWGlWQzBhaE5lWVpUY1NHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394754),('8KUFEFDOm3Jlirgvk4qpXlzFOTKAhYax3OqyLOAB',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJEQkdZdVRUQ21odXAxRDc4MFJPVEtVU3N3Y3MxeXdVVzJTSXdUZ05FIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401220),('8TFrW4G3kABRxjAEkIvbsEmNefilJhPV5sa3FDnt',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJsNUxJQk00QXhvQjlJOXhrSkI1SDJJZzA5UzNsd0RyczV4WFJtbThpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396258),('8tJPMV6rDBA2gMtDcPcAX6k8qSuRnVDwB2EK9p4s',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJLZ1NjQ2dNVGttMDVTaUdobW03ak44SlZZTnhqVFpqTGs3WXNDOHJJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398302),('9dK8wR48PyyZcy7jaQBWNU2OCeIOjB4chxsyHctm',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJYUXZWNDF0TEpMTXdVMkJmeWR3OGttSUNIRGdCOUZlOTBGTjU1VktCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396137),('9hKXtZ9PEf0wNaGVB4qIYurEczDAYFZn3PGc5vOZ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJUbWVSZmxvVjdvbUNvU0xib01GQ2VFRDh3Vmtwa0JHbFhaNWVoS3d0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400073),('9iRfgUdpCAhxYDWtUiSLiFB9W2kIHppIYO5ngHsh',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJZYVZXdVJibHBhMjhnWXcwSUNqTFlkZGZkd3o3U1VnYmllcFBGdk82IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395085),('9ohi3ik8ZebQv0iw35WPm1ShnpQHEQ07PY5uyibn',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ6TUtyemhVd3AxbDVVQWJLcnVTT2VydEVEb1pnMVlOVHIwMXVPY2JzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401010),('A1IU5thtJL1SPenihUlhC2pB3ai13HbtOMuUnzIS',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJnWnp3Vm83RllXNlFiTnB3MVBsVTNUQUFBRVh5TmVqNHZQbXJFUDROIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396588),('a2DscfK5P7xpcUEIPZubjcVnbEmNVc4PtNcNh8Yc',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI0b0lrZTg0aTY3alYyaHY2YnNiR2NZNXV2N0tudVdqbEFMaWZmM2MyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398151),('aDo5V1yhxFLMLODKXWg06pBfd5pTL45UsAFNgWyq',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJiSmFIenlTQnk5aW52VTZkQ2dVZmZPeFhFaDBmTTBBSDZJRlRLYzNVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400950),('aDQUpWtz1DCAgj5UKqJs7rjzBFqDwPkbwg9JGp4S',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJEOTNNa01ScW9CWUtUQW92RG14d3pGOFVoRHFucnhxUGkxeXBRRjRmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400013),('asM6dZQRyJg4blv9G1tFxUo4DLHTInVPRVC9iHYZ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI0dm56czNJTnNNc0ZlbnkzUU1GMVRQVkczTVljc3dtWXlqOXZFaE9WIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397431),('AT6NM79hTYtIJV7ZhsdGaamjUCOC7PzEYmXU3eCA',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJxOU01cWN0TjlKUFh4UW84a2lhUDFnNGY5ckpucmkxYXF4bnVvQ0xQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397821),('ATfB84LN0PrvPXtiSbsFWzzMmO5dwMgUJGy1MNqO',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ2SVN2WW1Ld0xoRkUzQkc5VlZlZU9CcmRMcmJUYnVweGZuVUlqTm9FIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400590),('AU3dtXkwPFq7NHF3YjnSweYE7CuyqFtIBCETDGiB',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJTVWYySDFDV3pKSU1UUnVobkNqN3NFeUtYQU5Vc2JpWkRPa2Y4Q1RxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401070),('auxteodr60VQimwU8lBOsy3rPOxUG7hJNvCYcmaA',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIwcWZNWGFOODRrWFprSU1QY042SEd3NnBCa0ozUnAzb3hlMUZUT2h0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399502),('AZ8ZT1u61ssqD3r6x7ORMQ8aM4HcvytPDauzrKe5',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJDNG9GQ1VadmpON1d1Z05iSVJueGdUMnBrRzN3OVJ0Nm1SbjJlVGJXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399322),('B22TCLDm1rx7ONls7EEu3bLLanPcCbrTzGyIsM2k',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJtR281ZWQxbWptVklTbzVBZ0dvdE9neDVwZnBINkRid0V1dlNXVGl3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394664),('BAHJisecRvbLP4vfB3UTn3UNfwzPjhLu3tzf1N3h',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJWTXc5ZkpBWlMzUVFNckZ0Vkw1VThoTWYxeEhBRTFZbkNLOUU4Vmh2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398362),('BCNJbXRgprEK3KCXYyK0KokZqxjsqKy484B1DYP8',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI1aXZjNDNqZ1djaU4zU0tJQWZHQnZoWXZkTjA3aHUyRkc1b2RvWDdpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400409),('bcr6jWaLe6b8CWjqXYwTV0Mn56gJIIAfJwHbcRda',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJIZmJHRHZNenZ3MUVheDBxWjNFWlA1Q09veFVLVjI2VkFLYVVJYTlhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395266),('Bj9kIiX1hXEpIve14O57VkXmimicSIxsZ8KlLZA1',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ1T2VhSWlsbUQ3RUdocnZUeldRS3R6TWZES09EbjBOR0FBcjM3VzA0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395717),('BJfNCwk4OwVNQj5lRRivKal1UhL9q2eMGjTg89ei',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJzWkdGbXBQWTVETEthemNibloxeU95TTZzR2l5dFJDMVJyaHhVMnFsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399172),('BmUbyPguHNMDhfJd4EZlZtKzRolaxKxdwmGFZYkB',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJVRXp3eUR6ZWdWWnJ1Y1YzbG0ySkRWUFlTSEtZdGdzdEt1bFdGMFlCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398031),('Bnaix1ZNjiMpSfFMRVhD3cvnuzrnYeykAGIafnCN',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ4ZlFzMkVndG9EQUNqb2F0OFBYR1hGS01uSGRtcWRhUmtFdU5jS1phIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400169),('C5DqauDGsXS6K4NjuCLJGKavEIYIB3stJrfqm4Xj',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJxS2hqNGE3Q0IwRWY3MkxTeXlRTEhJZDJ3QjZrN2hqZHBmaVRRS0ZMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400499),('Cbltt0VOw9vNPUKpFI1ZDxZpklSk4toEjVqo2jFv',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJZUEFqUWlndENvNmlwWlZQTjVxbmxMdnFIY2pvcE9oWHNSOFJjSDliIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399803),('cCS4U0vO8ge2gGnfKZDSAKH0kbmC71VMhHgMcErt',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJBV0xIcEI5M1ZLUFoyNTBNNEZ0UzdhWjNKSGpkck5LRElwd2o5QWFmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400890),('CGtgKm8ODjYIlLw9V6jG7anT7KpMqnIMBSjxSmFt',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIza3lZZFAyc2FOa2I1WEdMQU9QRG52djdJWHlUVFFYeTVuNkVVS1FOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399743),('chF36n9rlGprxy2McFN99WznbZRS9s64cnvd3DHI',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ4ZzZGblMybVJXWG1aQ3p3VVRZYnl0cURNVktpSjBwZzZ4azlieUZ5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398782),('CQcjctKjwUV1MlvsuYIiZENiZNSltW205AdeFkYg',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJUREVKWmpLNlJZQkROU1N1Z2h3VHFTelR6emx4MHdTNWtOQkVqN3laIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397130),('cqK2GTLJckkvUpn2guFvImh9ZfvCB6HBQPlTZG3t',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJTSHdDdVRuT3pYdnNPQUVnZ0o2WGNxenZoNTdwZlhNQU51eFFvOWxLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396799),('CtEA7gOrW9BSYnR7tM7KjJyR85XrDyi8jCKNsRd2',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI3ZEZCWEhnNDFxT3hnQjllbkhWM2JoeDFlNnQzYkdJaFBPcUNNc1F0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394965),('cX06bptLuyWbm6Jgonn8bh1wfmXvnZjtAzKiIpR6',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJVeld6YkZVTmNXc0FpanhXaVA0Q2ZGdEU1bHhPRjNib1k2UDJIQW5zIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394935),('dfUr4VKsn9RyLA0Uxe12qbJcOxRLhcSx3p1KLC4C',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJIOEM1Q3pEZ2xmY3EyTEhEMFNFaW56VXBQTzlDeUMwemE1OHlzVzdmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396288),('DFYI123OPfiMTeR6Ycwo08iEHBe0sizQSluRYQBf',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJOUktvRjVxZ3FZZ1Bva3BmM3JFQm00aGJEOHNUNk15ZnRnTkxLbHZNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400680),('DLcazzd5dUvpqWXZZ7MOvkMvq3X0zZdrTD5TmV8D',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJTVzRPNzBpeVBscXphYndaYW43Q0ZRcE5jUk8weXNYZVh5TExDSUE4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396198),('dQ5GKkPnK0kTMZdjDnyeEzfm3P5ihDWDTptzlkJ2',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI0WUlacmR5bzh2ZlRFWEpUODFpT3lJbng0S2swWVZXaXpOWnNRRHhVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399112),('dukySN888hhPccLcatk5FpMIK1kVLQZqwy7dLarQ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJDYlkxdGFSeTRyQkRKeUgzRnVkak5OVkc1bUt4Zzl0TmR5a2VBbWJ5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399142),('Dz20JszlG3megJqZVR2PFdWs1vBaon79kI2nOcMM',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJTSmRNZWp0NG9aeEl5UW9BUUo1VTZ1RmFFc1M5a3pyVlN6Q0NmaVM1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396528),('E7aGzyx1gsY1KD34qEvpulw3HpgMoOIHyye6ThAI',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJxYnlwT3dqVXZ1STQyNG5sUGJEZkRGRUVXdFU1WXVyQjlmVWdSTUI5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395326),('e9WRH5gBfS1ciBQBf072Ols6rtKWqFhDknCny2qc',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI0blRPcDJ0MW1GSmZTUlN4c0pEZVNOTmtKZTVENUlpN3JOOHJidGgyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399652),('ebV0tGr94ViyCtTl2AuLrMXuBiuGryxC8LWIsgTg',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJRRUFJZWVOMHl5ajJJTml2TUFKOXNRVEhPbVY3aWoxQlFEczk5YkIyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398182),('EehjuJ6p5YnvLpnZydcOxzPYRxJeZKlNycxNgQ5k',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJINnpOMzNVRTNDWG80NllTODdJREptSURBZTB0RUtYd3JRdkg5NjlhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398842),('EiDod6hvsx6KpPd1m4TU4q9HyBVddmdXnx78jlf4',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIzMzNFeVBlcGlmRGQ5eDlHa0RXNTk0bG9pcmJqZmNoWkhudG5JeDc3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399202),('ekGcBFXyp8Ds1MBBjFfJvotNUftk43WuEMNwALF4',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJvVGZWenkxNE1rQ095MkdzZ2R0SEZrSGhrcTNweVpaTmo0T2toR3dNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397971),('eLhgx6rDNB8j8XKkMhoCxtr9QLxkm2jWBrREZEbL',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJXNGFjVFBZTllMU2pNYUc3bTVnVmhqSTdibmdWNjdJaUxCRFR1ZjZnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398572),('Emt6Vp0LVHEuffXma61dolayT3tvexOddOXQl1ar',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJhbXE1M1F1YTdwSklQOVA2THJ2QWd0dERoZjJrcUlWWEtCTE0zdmVaIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395145),('eSCq1oKEKEhP54KuKLs2RiAamQRNQJPgfUwKr82J',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJMejFQblB5Z280V3J3ODZJQktVdU5GWUlVVFdaNFdSMnNRWEdRUmxhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397911),('eXPbLRKsSX4iislKalpaerWAjHpOfOS2GWEwnHFC',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJYdldTUkFSMnc5RHdpSVVkbUhaa2p0SkVUSHFCc1gxRmZhU3BPQ1dRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400043),('eyXpM9SOtVCB9qieeqKQ0sw4FswPdBMuZL4QnN67',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJkYk93VHJxOTlKc3ViOXJIZ1NxYkRaM05TR25Yc2tVbkJUUmNHR0FKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400229),('F5Hf8U4IZUga41sOWbWk1T8c6SxPjOFTSmDqlSn3',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJwM0pPNmNIQ1piaW91Q0ZTcW01VllUVmdZTVA0VXpjU1JaejlvbEFlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400830),('fCbuokrFznoZBnGF6OLektJIgBLpvajWxwJwymZv',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ5V2l0UWJHTjJCRlJBaTBBbVVPSWo1djUzdmhYRTE1cXg2TEpWNHdsIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395025),('fF3a3EEeAAaUhASKcZt6DjBgtCGQhUTjiXzU2fdq',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJPRUpZQXlwOVdFZ3IycDRtamNEUVd1QjQ5bHpJc1ZRd1dlR29rRE9oIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395446),('fNZRgaWQYuOvtBo5gILbQQ1HuuY5Zg6L9HGHFuU3',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJKVFd0MGlobk9Fd3Q1b1ZqVjU3QkFFWWl4VTk1RzIzckVjZXRsa3ptIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401370),('fRmLCEa7U1n5pBwRGOVVag8U7d7y5qdbRImKZCYy',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ5cVBtTkxkSllxWXFpdzBGSzBlNXNLUENUbnFlZ2o1SVJGbm5VQU5hIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398902),('FtOeP4M0Er8l7VBBwco72T0zBPJ5IomXO1pQWINi',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJjVnFVUWRsbm44MnhQNVduZU9PMnc3eUJXZ0tvTklobHpVTG1oMndYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399683),('fxUMVUrUkCg3semPmVI9cbyyHadT8hNoWSN6qjj6',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ5SG82Mkp6UWdXeVBhR01XdlhreE5mMEVybkdqdlB3MzE0TkkxdDk1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394634),('G01tMbdx7PAbKxN1HiMKD5CgvIs7gX7lISfnfTww',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJFVWNlWmxmSEUxcVg0ekJ0TlFSMGMyQnZsb0lsdE54Q1o3cDRwQkRUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397491),('gaT6H9G1TMMyiGfGDb782hUgjOF91a5GTpfE2uQh',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJqVDBNV2oyclB1a1VpUE5xdzhDVG5YR0hCSjJ1R3N5NFRncHo0cldFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396739),('GBdxoEsoBVefwEjBgOKu1xhdhRUMUzZVpO6R3LTY',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJRZ2g0T2s2WjBpbDF4b3lRNDd2Wkp0UWlEUnJzaEhWTDA4SW0wVDJDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395656),('GcfQ7iiBFwUFiSrfvQPjwWF3YrbupC7sQNA5nGQn',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJJMXlKUTBjMmV5ZWlNUXdYV2pqeXBkMVBFREdZaG1uZVJ1WEYwaGdJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396889),('GCihLVMpPhd1cjESPFI4XXESRbu3LTfrsKXjs5ST',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJqSmM5cEFQcmZ4YXZqNkZCSDFUc0xGV3MyOXFJdFVGUDJsS2pUV3EwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396919),('gcT4DbYqGAWGT6EdRufANGG4mDEVMt3u8e3m50sE',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI4UUt5SW5WVWRhQTBrQ2dRaWpxZndoZ0VSY1NYWGhtSWJ0dWhPZGN1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397040),('gduTCLU94RtoVpRaWcBlLEEQP3zQDhbnJKlIhMd8',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJyWHZoaEdIRUlXYVJCS3p3YjdEUXNLQzZ4bzNmaEtDblhIMm45bjV5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397731),('GEGRUTMmc8qIiSkDUbU4Pp619yxQTwbgruklTOsx',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI4UWMweDE5U0EwbnBlNnhDQncyYlVGM0VvRUI3RXhGbzdWcHREMWZqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400770),('ghELj4hYZnaOQ8rsbHWSxztq4DOlq1lm0w5Q7ME3',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJaU1VyQXVUNDNMNnZ2WEhGbGdIemMxODcwd2hyUjd6cU5ONDZJV0c5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398242),('gkJz986PZlbSu8bnHgWYsXGm2bTq925IlWFlxHV8',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJlbXc1Y1ZQQmpqc1RJNXdSTjBMWUdNR3ZtYkNFbFJNSWU2U21vRTNUIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401490),('GNgMT1UruJgkL17sB9JA9Fxt4sqxUSKXsuyNJQ8F',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIzS0VGakJydEhUNEh4aWdFdm9XNGt3cmxaRXc3Nmdpd3ZEa1Q2bEVFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398752),('gohZidGSk7yhXEzg5Se6gXimWJlr5ycBmHUEzGBy',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIwNHo0dXVwY3ZNN2R3a29qekdjNkEwR3ZNcFIyNUJNa0NsUDJpNndXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395205),('gOTWg9sR26wxU6aGkfa9GIIQBB8qwJT9wDqayTWy',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIxSlI5cXlrcWdrdTl1TUdMVThPY3lhQVE2TW0ycVNmVXNaWDg4TzZPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396980),('GQSqFiYTMeKnP9UJMM6wdjd4q2Fa1TovedK0fK6q',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJpcnZWYzRPcURNN3hxbjBENjJWU3VuT2VCUjBVVWlFb1U1NkxJVUQ3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400860),('GtKhzB9vsLS1guIvkXPQt53Xn4eZkPuhjtS3QxwK',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJjVWZPN2Y5TXdJQkRBNExSeGxjRTVnM1pURVppQVUzaEkycTdERTloIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395747),('GZpkwoWeldIIu0pxzfsomkAKNtiDvYddXDREOCER',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIxZHBnUzB2cEQzUFZpQUpYTDhvSjlKT3BCNkhFNmZkbk5sc3lYVUNNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401310),('H9tpsZxQjoBoxao20i1JRH9QI7oZ80k3AqhjmcjF',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJvbkxxd3JMMWtpaklWSjAySjdIbGFZZVFJcWZ3Q2VkYzVtc2xLOU5UIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400469),('HJ34RTX9LQ91ya1bQlJlD1KT2S851vysQmofxqBX',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI4bmxkNXRFaUFudHo4dzFTaHZJbGd2VjZITG1XN0N5V1l5NUpnQ3ZGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395626),('HOxSRpnAaS5ciVH2SxQE3hpf5NpfFEaDmTzE1Eis',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJvb3E2QzZGd1ZSdDVPZEJqa0h0eHByd0NvVWg4aFVuYjNacktWWE1QIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397280),('Hshd6LNiYaPCtyb5sRcsCCMhnQHgIvR6vmhSZFnX',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ2Rm0zWW9UUXRMaWRtRGY5dFJ3U0FjUkg4Zllld3VvZEs2Q2lMSkJHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400349),('HVY4DjqD24BCw35auMtndVBCTNUSAeEp5QCEMAV3',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJvWHhYMk8yNktCOGxGaTJLaHNIUVJLT05vU0ExSmk3d1hyM20zdFlVIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396949),('hWNzTuDzM24rqOp4kqjARhwoTtgUo7GJgjxpIW6a',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI3U1ExajMwNG5wZzBVbTRuZzJYbGJvc3hYdHF2cjVqcktMcE9QaXhWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394724),('hyljfjFM2QBsSXa9djxhVSOZZFaFRIcLnE3p7cN9',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJsaVkxTnJZTXVKZE1wUEIyWnZZMGtTc3ZQaXdWWjVaZVRkTXhkSFcxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395506),('hYpeLaqmZK02Yk4URbLEkp6Q8XUoPIrtGXdK3kOX',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJrdkRkRWo2VFdLMDJIOXZwMjVwT294bk4yalBIbUxuaWF6MG1leUdzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398452),('hYSlS6hTtYiG1o4AgxricIVyaKmsNf9Pz07mx7VA',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJTNk9IaVZsWnVSQ0lQZlBDQTJFRzMyM1kyOUdxY3YwTk1ic0l6RjVqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397340),('ig8u1xcd3sHIWXsH0Wqdl4ugiu8UMzVQlmT3grQj',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJQSDhYRlJ4T09LaEVxQVJ1MDRMTGdIQ2RKUFZhb3FtUDRRUUtabzFxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397461),('iSiTfGNawSeelSDPcPxRuVjzGagRA1ip9SPZRvgI',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ0NU9DNGxkaFJuc3MzQm0zRG5HVEt0Z1M0WXhHamdiQjlVU0NpYVVOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397641),('iwGkiWohfTnEoQv1wuRoT3nb4tFlxcQPo35QHj8p',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJrdkJHaVhjd3IyUTB5YVJmMEdZc0l5VEhlZExwVkJReEIxRUk0d21HIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396348),('iwNOgISXg15S5IcvszK8CGASDuQ1Ymx7Kqab9l8q',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJLQ3VxQ0J3dDVIeFNKckc5QVpkcXhFY3Ezakl3ODBSbGhwWFpzRkV5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399713),('jViRXQjVQcQ73bjH98eOjFxPezfllXNt48qfJDGh',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJxTnlwNFZrWWo1TEJtNHRyT3JOSndxZmFhRFI4NVQwYnFxSkd0S2hBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395897),('k0HI2a00nHbGiG9ycN7DbxiSGQ4QGpjcxDm2M6hi',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJXUzNEcU9xOWVCMklmTkJ5Ym5rYzhVdXdCOURhajFScXdrUWNKaVdvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399352),('k8t1kArGkdJ75UoHaUbp4OXACkk0j5llSgu2N3yE',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJRTFBQdW1LUUtHek1VZzkxV09sbGk3N2FNbjh2M2piQWdRalk1SGhmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394604),('kPNPAL36946y25fj5bpdqVyXjyv3c7Zq0I61gxlo',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJFZ3BPZ0VyejAyQUhad3NaRXBCdDYxcmNUUnhIVlhYUnhFcWxFejdQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395416),('KqxKgtzk7Fxtb3smi40FzAnPZDNavmZEI1f5ZOxM',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJUR3AwTjRtd2tXUXd3YktreGR2WnZSOGhzZ0RwbHFrcHQ0MnpYWXZLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397401),('KTAPHqZeNn55N6DNLu8Kej54L7Vc2o8OAfQs9wgY',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJmTTFhVFppQTlJRGJZWG1DeWNzOWxNaTdGdDI3WVBmUkJzVVptSHpFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396679),('L1pdEFulQplHToroFbjQB8wGnU2BbiSziAuKLCDE',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI1S3B4dEhYUm5kYUp2NzJKSnZZYkx5a0pRRzhYRTNSZW84UUMzNEltIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395927),('l57O82rwFqVKbjQ3ykMPjjFoArS09v976Yr6HuZU',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJJWDRPeUhZYUxlWkhXMkZ1SU9yQWw4UFBOVkJ1M2dtcmdubkhtWnloIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399923),('l820QrI2bNmrBmY4lOfNQ3zqvVEPwfCi9WTfOSFC',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJvWnY2MGFtcUd0TklHVlB1ZHp4TUswalgwWFJWNkRraU1mREFoeEFEIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398422),('lDDEJ6QiEE97Ug1WhSluR5b2rWt1K5fvdf2bkM2S',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJKdm11UjZEdktVb2x3NHJzODdqVmw5d2R5OU5idG5QdTdiUFZDTmg2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398061),('lNp2QdkxP8i0f8vPk7VDSCoRxBJ5qWfYpmWnyfsp',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ0T1JrSUU5cWFoWmhDSzdVb09BaE90S1pyeXhZTUNIdFREanEyNlFhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395837),('loMQVyyKcIhNkLl41rxks9Snu8qeJQ2HG7oQPCtL',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI1d3E0V0JSekJwQzR2THNFZ0h6ZGRtNmNHdEJ4Q0tKbE9wZFZRNFZTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396318),('LQKXBn8rAkUSYDgRXf4E3s1xpTbE4JGpOH62EK95',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ6ZWZXck5hcTNPVnBvWllPZ0J5MjM2WVlRd0hURnBOY3pIVVJTcEIzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400650),('lS0gE2s5qpgohkIeVju2QWvmuZeKNBxvL1GUypgK',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJsMzM5Q3l6UGk4YkQ5WVNGMFB1THJQWFpzVGl5ZUZ4YU5DZDU2Wm1HIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396378),('lsZuQIM6oQcYT8TNZaSvbImb91gzCEFuXsH5UvMZ',NULL,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:154.0) Gecko/20100101 Firefox/154.0','eyJfdG9rZW4iOiJ0bXZzTGpwTUVjR2F5RUZYVWE4MFh4RnpvZ0g2dkhzeXcwSDZ0NzlrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1793467796),('LuyZYudPe3Qh18ZRw1Kuu4QbUBvAbBl0CQufzYEf',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJJOHl2R1hFdGl4TjlUQzBSRUpSdzN6RXRRcmJDM25lSnpLRzhUaWhMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399562),('LXiCLRuNFqGahWNIOT3dWnN38ie35aDISpxvRGXJ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJONHp5d1BPd3hOU3FwNGxwSkIwR2p3dFkwQnlsQjV1bzM5YmR5M1RHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396167),('LzFTiItwBODGzsPabUDZEOyjgN2tnlaCAuzPyBbd',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJYWGhmVmtqRW9iWU1lMEd4cGk0dnFwM0h1dGFCQmZhZUxKc1hHN0pRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395987),('M0JicuCjd5bhqfZ65KzP25wg3647pJn9Z9p0CTRL',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJkb3lwcnVZWEFLSEFWWHRoa2lxOHd5NG9OOGU5ZTRqWVB1Q01Md2UyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400319),('m3uWYveVUoAeduM21iy1qFEzpnC4PmwwTE1QjbJ6',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI5a2hWeVdBbTZsVjBObDZxNFdvRzc3bnVXcWQ3OWJLZGZjd3diVVJNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396077),('m7kYDIVAcUATO4eq1gsS2Uks3Av5JD8U0HlP4kRK',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJxclVSTGxKQzlCSmgyZk1YQTUzNnZiU1NTOTBKcG84Z0dpSlpvR0s2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396408),('maGzZEGRBQbnXSuMefwDXneTWEFlcfvSwdRAWrAH',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJJWE1HUzVkcmg4dWFydFBRSXhSM3ZvbnRyQXlBQTBwUmVETG0xSVZPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400710),('mH08d27h7MfGFBgrgyGdwSiBSjpaVwpFgpdwUcGX',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ0WXRFdHdGQ0RPRjI1TTRFcDZPdnl6alEyeEpkbjkzZ2lCeU1scUtRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398812),('mJQkP9PjTKxAW7Rdmbh7v6CyoS3ZmPKQI3chxjhh',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJPUHF6Z094dWgxdGhZU1YzbHFsbWxCajNKdUtORFQxTDFkRXFXdUpXIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397761),('MkJkOvIRmlrzxU9b4ReSYHCtNGpbOEUs2KNG0OwW',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJvNTlrS2lVbFAyQ3M4c1BuZXN6cmViU0d4THJ2akE3SjRYYW5saW1uIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396829),('MRrwhy8VlPUeGYuKoU0WNGbyiL01yULJWpFZkion',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJPbkU4NWVXTngwWW44ZDMxQ0Vjb0RPZkROYk5CYmtzbzcwOVppT2QyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398482),('MyZS4ZfS7dAFAKr7uBord20yYEh7OgZwTpsO2G9f',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJCeGNXVjlLRllmZ0hKaGRrTmpWOHV1dldZUTFZRnJFVU9DYWJWRkR2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395867),('NeHwg7vakUimxmtLS5s1QTcIG70BKfM0UcyvG0OJ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ6WE5pM3diUDdocVY0MkFhSmU2SGFkZ1pkdkdSQzg5VXdSWkI5bHpHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395957),('NfUa1xT73NVAvlGLjrTrWfKY9ydnWJaMZ4yNVcmU',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJEQkNLRkZjcnp0VW81OW5Qc04ybldzNFBuS1I5cjQ5RUFtcHowME5BIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399773),('NIuOKI459mFEkgmygo7GkWT41zeBXHt2QcDxS0Ic',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJyUFhNWjJITklIbzBDTHhYSkQ5QVRhMUZWbVN0VFNYQzh5TEhUdk1tIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401280),('nLCryIgKjoFheiOV9k3omJCZqpuqu2KGHFe9YIj4',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJSVWtSMVlrOURMNFBSUFhkWEhvUTFpeUpZQ0RrUjlGT29rM0N6dTJFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397701),('nN29e0A37xBKfSowupUrQdxClGQ05rHyhH50CX85',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIxR1F5aGVpVlFIUTAzMlBMWlFCZjFHcUVud3pIZEtWYlVIMTYwZlhGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395386),('nNQmxypSYnKCZEAWKoMbg03vUIAJ8kyWs8eyOYbS',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJwOTBINm1XbUNuZnh4RmdEMW9TQnV3YUhRbmVkVEtld05xRkw0Q0NSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398392),('ocO0oYYsngmvWJgTFDsJslq9XIzRGUGJz1UKz6Dk',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJxR09qSXNzSTY1SmlaS3Fmek1sb3F5REkxa3pBM1hTZUYwZWM0ZDVTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394875),('oFflqGfYqpAfHxVZCEWQoAqImWH8f72soZwVgQT1',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJDalZmM3BXSnVLQzExRlVRMmtSVWZqako4aDk1NGJGQXBkd0pMV01XIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400740),('OmSqlKhEMhgeX4TNlv0yobLOPOsgngTQ8wuynXZQ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ1RlU3VFRYNFZLRnVuNnNsTFdkeGE3S3BGQlZ6emQzWVVmVzFrV3dDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396228),('OnRp6QMO9fMqEwZey6jNQHT4CRgwgZnqnRtwMGEM',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI2SFlCQU9MYWRyaVU5amdhb1FBeUZBZ0JuUWg3WHhiUjVPOWFoRHpnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398212),('OofHfbOp56a8c8Nnyun3t7FSdW16YIs7BI1Ss2nN',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJwRmRaQzNrd2MwTVZMMG44cnh4aHc4bFBQQ3NnVUNUWmRSRXI0THB0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397220),('orW0aW6kjmQb13VCvfbTGXU1DYOt2066yHnEE5OF',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJFV0ZCSnB2b3RFTnZpTEhtQlIzdTFDVEpwUnlhT0IydzZMdGVSTm5WIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394844),('osaSrLwqLnam4c48OwaV7PWhN2PCLkwqCXFmy9Qm',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ1REtIUVYyQUgwNEVXMGQwYUJJTFFibGpPa2VlekNrbWVHTEU1SDh4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397791),('otQRipffryCKk9rlQizmK9ON29DtUcz2dVSdJgwY',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJLVXYzc3RGaXNuaHhLUHhtVUxMSHJWbnZhUjhBWVdmVXllTGVYaGFJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401460),('Ov8vh5aZD1Ky83giqamWOxM6MvcfAQPIAFlcEloQ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJkNWtkMHdYejNZVDN3VW1VSXdreWFWbU1SUWlucTZlSDUwSXFzWVBFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400620),('P330sJF9RQhOUBvTPSzcnNzkoKfehztDZ9H024Hq',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI5dkVqUjZBdUxPQng1YTBjd1JwcnRlRWZ1dlQwM3FUbm8xYjA0dE4zIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396017),('P8EASce2P4NeCGzUKLPeDdp9wSfBu3LWT3SeA2q7',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI1YzQwZ2c0NldoanBnNHJ5dDBNU2U3akZmcUN3RnMxdG4xd0ZtSHdtIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394814),('pK5dZTwF3PFpuwJtUEg23kTYdVw6sR6gRXTnMas8',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJjY3lqaWFXaU5aMlNIbUNsVENjcG93bGk4alJFNk5QZm5lVGhRYlFlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399292),('PtovF00LeCU48zCHmJSOPbMkPdKspXj1NpRPNX6W',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJVMVd5MEpUVzZ0a0w3ZjFnVGpUYjFqb0xHQmtvZmpmcUhXSEFTZXRxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394905),('pyA7WIFwPYdqykI0axgdNgiEUE10ApeKP4iGeSyQ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJXUGtxeEtFYVMzUndiTmVYTHoxSDRhdXp3bjQ1WGR2bGJGUXRVeGltIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397010),('Q7SS5V9sP8JSwiGwTwKBFXFjgfkPqK0HdrdSVbLr',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJUN0dMdElhTklVTlpua2pHUXQ1RXBiM0l3SWZkcU9ZTEp5RGgyVWIyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401100),('Q9IBXphy2BlcQZgFpbenzrTMImmsso6ArznGweQk',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJpa20zS2lXbm56Mkg0dFhVMmR6TkloTHBjYU11dDlBTzlTSHVoNHQyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395476),('QatMoDe3bQMopHw6u5uSKAdEZ85BAVnn6UisLiaW',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIwV0w0N01UUmN3aVhoYkI0MGhES1FVaGN3V2tkUko4bkJkMEFoVzF6IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398512),('qbWYQphPnHgtGoxFt9pl2awCz7DoLj5xaYISVEX6',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJOVU85Z3p5MDlweVdxbUkwUFZUeGJFbVJ4d2FWQzBOeDBmOTQ5ajZ4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394995),('qHl7HjrW3sqMZrhEg5rWphdNcyOyBAc6GfO9GuEX',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJoNmtpbWllTzQxNTQ5bk1qU2todzhLR1hBek1zZmE2MXNRbnBtdTFFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401040),('QNR5CFBZTrdzP1ChZvBEVGMwVMyRNy9jAqR0m14Q',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJuN2o3ak9FMGQ5NWtUSkVsaGtiSnUxUWI2Y3JveTlTNUJpeG5DSHBDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398722),('Qpc5ovf603ShpSQgco1QeMqyQfDdizQ3ufPJwfD9',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ4U1J4ZFRqYVRraXJaa3RvVTdOcHJwZE44Y2xWMjE0MEVQb2ZxT3o2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399472),('QvUfyMmu98AToYIYeQYP2lp2WAlLtCEORg32BwTf',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJxNmtwWm54YWVaanFmZFlOc3RBRmVqTFJuR2Z0bm44QmJCMG5jd2ZnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398332),('qwxGopg5F1fIjj27GKPzZIP9371fwjJDalxEK1Gi',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJqdzVYeU5LWEtGb0dMMG1Deld5M1M4Y3paQjd2VXhnQmpnblNFN2hQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399082),('r9OJxMzkSwJkY1hgSjBVyIE3uzGZaIF64ysTHGAL',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJPUDVIUjJTQmR6bTJXd2J1dzVjZTFYaFB2dGUzbUZGaXhkdmJBQXhLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400800),('rFBsov81WI9r2Pokwl5BCStFrhSpWRvKaPc8m20a',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJyUldkZ1p4N3d1YXZEbGZuRlFYR3BuUXFUSnlYSmxPamY2cEx5UEhqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397310),('rHCFP2Sg6NMUlVfgMvmrIAcRljuiplOOt20PDGZI',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJqd3NIOE94NUJRUFFCSXl0RVVTUldWeGpuaG5GNUttRXhIQTZYYkVCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398992),('rIHzw2p1bTVJXLUrgX7TNzIGZ0wy4h81PTuUj8Ua',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIyOVlvN2lHSkVSdm1aTXJPdFpsa21ocU9jSGtNN2JnUDZ3UTNPZjRQIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397160),('rJcd52RfFE8ANbtSz8xENhZwIh4A0lvfdMyaUWzo',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJWTHlJblJQS0Y3a2NvZlJIdGJGSjNESkVVcENoUGJyYzNEWjVOcld2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395566),('RjglncF3HuXwWqv6wUAFO6hs8IlCRHsiXAP8a9dG',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJJZmNvcEtaZ25aVERHbk5XU3FEbXc2UVdGaHVoTm1RVU1pUkw2T21IIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399622),('rQYMXU3FdGi43PRfeGg5c15K6cn2JcU1tN4pecoR',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJleFdBcllOVXJOMzdRZXBpaVFKTWlMSDJ2TUZKcU1aYzF1dDEwaTAxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400980),('rrjeqoiDTe0oYpAnHB1RRhlExtwG6YEljVLDyuUD',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJid0RUa1htRkxQYnU3d0M1ZFpCbXNza0d4TklhODFOTUlLckVQd3FGIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395235),('rWgy8CsadIgWgnc1vPvGpRADQRmydndKZkOgRkn5',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJWVVNueVF6aUdrVnh0OEM0SWdtdk1IOG9DSjFWckpKbGN1UmlONnp0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399592),('rYEI7vtES1gS1FeBdekY4UgoMPWOhnP7eHDcyMxA',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIzeEc0VG0yaVNGemE2YlRQSUYwZ0poUktiVGVINVUzeVFPbkpDTkE3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398091),('rZFovZLij85wtHIh666VMXf1Lna8rzj19yttQKv4',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIyblZvVnpIWXllaGlOeWdVbE45eHNWSklLYjVHTm5LbDNXUGcxSjFlIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398602),('SGpe5n0hUEPPQpCyxY6P5SWDPegSsXR7g5GKYFw9',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJObzNTRmZBVnBSTWR0b3MzQjZDNzYzQWx0UmxsUXNuZEJ6STJFdDgxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396859),('SqPCnNZqHhQBUQq5uhQevWWYwrXruVAjyDS4GyJ8',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ3QUd4NXJHUTNKY1BBeVRnYXhaeVpvWTVpdVRDTGd1VFAzcmR3eTlBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400529),('SVXRGnJCmPmjkYKFparYbmS4nwc5GuRlk3kwWWJW',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJxM3BFQ2VkMkZMT28yRDd1YWFZMnNzNkMwR1hpdDd3STNnRUhCMGJjIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399893),('SwmQ3ZtJ7aWUBx9pN9VthemAOeIwnVlmJCALCPu7',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJEb09FTXc5dThnWmRkN1lDdEpLOVllM2pJMFp5MWJsYkF2ajd5bXBzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395807),('SXCgtZFaZ4vKcjgNiaRTvjFhCrqflBJyKhrXMjH2',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJHVktYeTZ6ZW02MXZCbUFWRDNVQ0JmY2pOdEpxZXZyUGg0VGlwRjJHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400289),('SzUBfjiwS4I6dE7Jck0rMyI0Qq6GxvNHiuGyO0Jp',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJSODlDc0FSZ0JSbjZXZzJ3ZG01ZWpzczlncnY1enZhQ3JabmdEeHNYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400259),('t3UVHV0kaEqQ7hldQf9ikqDSnj3D4McVdDD5mX5k',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJsWW5rTlJ2MnBhY2l5cTltVjJxM2ExWG9MWFdxdWFtTnNNNzRUcVlFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396619),('TDfsHaKnAz2KEMZ9XCuzPvEn5USp95mE6zlnqR2g',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJiejZqYmpiMmpDdUhQbFI4cTFVZXpZc0FkTEFYOWhyaUFzZ0V1V0M1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400439),('TdKWZwXapIcKnv1RYMqkgKu3knwG9Oxqnwm5eXI9',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI4WVNaUnk0SnNSSjBtUGhRREl5SkdVMU1VSFp3RkFJT0ozbUlMZWVTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397190),('tkkQUshVdZ4izI1a1ZwNt85AWgA9yxbqwNViZAgf',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJtQjFyY1NVaEJ6cjJoQ1R5bTdlVXBzTlBHS1RzdGwxc2o1TjlsekxMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395686),('tlg7UJcSi0Z7ggjhr4CSJVTyljS3Fq8AiEPenx0j',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ5STdQN0xVcFF0M0NvT2VqSmRtVUJNWEowTUtocTV1SUNjMU9nd29YIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395115),('tNu7eZ6aaC8tP2Aa2y6oBlzGMmwUMftsHaaitiKT',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI1NEo2OGhIRm5tYjJDSmgxNU1xdzl0c1dhQ1NRNzFDeGpYRk9zS0k2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401250),('Tro4RXmwMpfAJH76ex03XvZc4dDS6EeTST26MoHD',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJtaXp0Z3JDN1JRUEc1U0Fsam1kUXQ1QUdNWjd2dUFHcW54U05sOXltIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399022),('u3GksdbAalXnKYBS0eGeOKthucJHHdTTsKa7AxEd',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ4bE9zbmE0ZUpSdnVxYlprUWN5Y3VjQnlBd1pnWHdmZFRCakh2cFFEIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399532),('uF2iCXavY62fCgYRuZlgArNJPQyLXUJs1cFMJcwV',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJqOVR6V3IzR2N2WENIcnJSbTdNNU5ydWZBY0N5d2lnbWEybHJ4Y09TIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397671),('uVuE3b5OzEhPiBWybwg6xaIVb1alC6aSNCESheiy',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJIb1VtNGQ2cnBDNkN4VjdOZURmdkRENDgyT0EyMU11dlR3aWVLZWNuIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398121),('uXmU68EdMoxB3KRAxLtgbWV0FBQdCT8pqtGNqtld',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ3WU1hR2FNZjc0V1BJU3ROb245T0w4amhaQ2FHdHRteTlGOFF5Z1ptIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399412),('vFbwFFkXTrvvUC35IANiPzdjETJEGngfLrnQi4LW',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIxOTI2dk96amhndm9kSVlmTWZZek9ESVBYcmlZakM1bGhpQXBoTU9jIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398662),('VHlfS7FXQaeQiMQugV9HGhjjdzpBkPQChcBOFwoh',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJxVkdQS0lESk1hTXlWNVc5ell1ak02d0FqMThMTkdRcDRocUJ1VDZhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399833),('VmyJfPB3TzCtDRCaz8XJ7wV6tV8tcf40vwJNENVa',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI5U1EyUkZsT09zWlYzZ3hJem1FUnY2SVVFdGV6YlA5a0NqQjYzQU54IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793394694),('vOTT2cELsfPb2KWJA6O9z8SBUi9ZAk3OTVBXsaQN',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJJZzl2SXFBWXNoS2ZIU1NPbkdZd1U2TGpPWWFrNmh6R05jc0VOQ3FHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401130),('VPC5SsGFGLyBKeLvxxGynMGBmOId3RXdhMbku1Yb',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiI4QmFLTDJROVdlZHlKcURuMzQ5RHJweEtjWXNVWXgzZTZpdnJ4S1ZyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400139),('VPZmK50UtPqX9fh3NF0uPEhsi3Ltr3aTUIci2vRp',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJJWWFVWGQyMjRNMW05a2hXS3hxZkEydHpCVmRHZHU2czFhMW9WYzFnIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399983),('VQl6Cyw2KriOk9LkQkYo5PisZIjiPvLGqbv3tErs',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJtT3MzZkNrc256dzUzSGpBaUo5ejVYTmJZek5WdENLenFkSHV2UEZ4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399863),('WaE0z7gwVBrMRctwziQDY40gVowCgJ3JX8jlzQWf',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJVaGxpRTRWSmI4S3U5TlZJQXF2Yml1UkFNb1lFTkVTeVZ0VVhxRldIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395536),('WAJWKfeziwRjbTm23pD5fAPRJzg2V3siiUN13oij',1,'127.0.0.1','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:154.0) Gecko/20100101 Firefox/154.0','eyJfdG9rZW4iOiJJSVp2aU1jSFU4bFl3WVM1Q2xFeWFPQTI1d1lwZWc5bWkwaE9qY0UxIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hdXR1bW4wMSIsInJvdXRlIjoibGlua3MucmVkaXJlY3QifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwicGFzc3dvcmRfaGFzaF93ZWIiOiJiN2E0Zjg4NDhmNTBhOTE1YTQ2MWQ1YzIwMjgzODExNjEzNDJmM2I5NDBjNDk5ZTVmNjhlYTQwN2VhZTZjNjBkIn0=',1793400490),('wbCMtZJaQJC4Z0WDWqh93xMoPhXl4HZItwoiyjWy',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJFT1VMV013b3NOdDhENEhxRGFPSWN4ZDcwTE05WklsVG5mSTZVV092IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400103),('wbgLKg6ZiukRK4EkbKr8Zlxds5A5TlJwsQYaa8zM',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIzOVYwalV2MmRXYXlQdG5UeXEwVFRNczFoSnJJMTBlSDRlVzR5QnV2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395175),('WbgqkzQJdYNIwiUGitCE9LMpf7IDFWOzdWhy0fNY',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ4Mm03amdoVU9BeGo2Q0NZYmlyenJDVjVqb0x5UFI3bU5hWWFhZWlZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397551),('wPb7QEGiL5Xrdcg9Ctm8gUwhQH4FL3UIeS6UAFkl',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJQdXEzNXloQUZsYTA5QXBPNE1BREdFNGlGbU9paEFVS3oyZng3cjJTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793400920),('wTUOcikGhoEstsySm8EA5jLfGJU3etib6Rb23tfG',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJuODJZNEtsajZSQ1pMcGlocjZ4VVJaSlV2MzV2QXdkUjRxak0yclhkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398632),('Xb7HyzyKDiZQevaX15HWjOjZB6t0z7Uhm8g07Tqs',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJPVUFUNnFKa3Rpd3RVYjZiMUdQZjc2WUIxOXVHUkQ4aHpNdWt2SG43IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397370),('xCo34TO1PJWBLwKZH0TghxftNQJzRnv7NscPp1WK',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJKcllCN3c0MTBtbndvUDJEbWZxZWF4RTRKZTl6bGtPT2djcTc2eFpDIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395596),('XeR2E2lGtKQ29aW8JfE13Ulusx5rsc0nzXZbdcZq',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJrUk56aTRobkVwbFdoMGlWYW5oZ1U3a2c3bG1WS2RZRHB5OEJQaUY1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399953),('xXFtDRG8UBgSzh01EDSNxBxkOituwL1NK4nV9iGO',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJDbnV4RzB2R2hvMnBMWXVuWEVSTWRoaXJ1TXdWNHFwUG95MGZwN1RTIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398542),('YbaSBUiAUGrAN8ZUWkF5MdwYaJ6rdOrvhhLdpWyb',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJUYzJpVDU4eWhuaUpBWDVmYmdJUVlFUnF1cE41WXVOR2xCQjVWdXZMIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398272),('yeNBDaacsUsfux3bNlUrlFNfdHjdtmKBBKHpaQTi',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ4eEZ4Z3d6RjcxbGFZWlJod0w3Z0ZHYUJiN3FsN211N0VuWHFickN5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399232),('YlaSqjuaHOQ8yFMWjNJiTf0rW43Zurb152mGOhdZ',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJ4UkY0N2hza25WV0IzSnY3SXQ0cE5NNUw0R2hrbmVhRlA5dmxFcHdPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397521),('yNvbiavtzKrsbKaZdf0Ss8lxeNyW91OUt6fUuW8Q',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJYanV5djA0TTFOM1lEZzJad0FOcWtMWjVFSlBWTnBmRnkxMFd3ZjZOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397851),('yQqkSg81Oa5V6tImyvSvp7aIecUB7BM6IqeUeVfh',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJmSXNQYXI5Ym1Bcml6R2FSRTNJUGt3dWtxWlVqNkhpR0ZERDhsanZuIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396558),('YscbVINoKNhHWQPlOa0ZLsDBQYNa4W7pCHC4KIVm',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJkeElhZnBqVEZwQUlBd0VaS2hxdVROc0R3eTBaNUJocm9ocjVybFZZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396468),('yvKHyqUmbKP5g7iATuVMKs09c6SqTcGZAtUcyuKS',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJOTTFDMWk1UDVwb3dobzNzZHhWT0hJQ3VKSmxKTm1jaGFzM1M2YW1wIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793396107),('YX4YDQE3mlQnitsocOPYYxSvn9AM6JH7v8Xu3ZQY',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJwVElyV1V3ZVVPUFFWdlhwSnhRT0FJalB5TGx3ZkhCeWRxdHpOcUc0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793399382),('z8zY5xu1amiPRto0MD0r8Bhi80aE3Pvoj6eT00y0',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJQNms0MWlyeElQYWFrUFJ3YnlidEFqQllnb0hQRUFlMk5CNEl3endKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398692),('Z9477Etz6DhHs42erEqdaaGFGwfaJeHQsyw9BYTA',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiIyMXVQdjRlS0FwSVBQZXNZVTBZWjNjckIwdzFzM1V0OTA4Wjl0cHJOIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793398932),('ZHHttFcchz3lLpV9CAvSvbiB4POiktke7I2A9gh8',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJCaWd4YmVVSmhqMlhia1UxbERQSHBFcDg2TFMyQ3c5M1BHNmhVM2NJIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397881),('Zj9N3hZToAA8jloGttdkk5F8cvEqDat6UV5SzNPK',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJrZTVDdlFXMlR6TG5SVFV5bVZjN0dGb2V1c2xBemREYldOcFZFUW0xIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793397070),('ZovMEPAiq71FbqxuEeHHUlGUyFO08AqzMeFFBMZH',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJlbXM2UTl1TG05Z09EM0h5MTlCU0FwamVwQ2VnU1BFRndad3VMMWwyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793395356),('zQa2s9hB82FlUEBNI1himVaQ3Q8KRWxsjCU4oBFU',NULL,'127.0.0.1','opencode/latest/2.2.4/cli','eyJfdG9rZW4iOiJkdnN4ZzBhNFlqbEJ5eW80S1h5V09GU0xCRndOcFpWYjZGUmMzd0V2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9oZWFsdGgiLCJyb3V0ZSI6ImxpbmtzLnJlZGlyZWN0In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1793401400);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_invitations`
--

DROP TABLE IF EXISTS `team_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_invitations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_id` bigint unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invited_by` bigint unsigned NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `accepted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_invitations_code_unique` (`code`),
  KEY `team_invitations_team_id_foreign` (`team_id`),
  KEY `team_invitations_invited_by_foreign` (`invited_by`),
  CONSTRAINT `team_invitations_invited_by_foreign` FOREIGN KEY (`invited_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `team_invitations_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_invitations`
--

LOCK TABLES `team_invitations` WRITE;
/*!40000 ALTER TABLE `team_invitations` DISABLE KEYS */;
/*!40000 ALTER TABLE `team_invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `team_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `team_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `team_members_team_id_user_id_unique` (`team_id`,`user_id`),
  KEY `team_members_user_id_foreign` (`user_id`),
  CONSTRAINT `team_members_team_id_foreign` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE,
  CONSTRAINT `team_members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team_members`
--

LOCK TABLES `team_members` WRITE;
/*!40000 ALTER TABLE `team_members` DISABLE KEYS */;
INSERT INTO `team_members` VALUES (1,1,1,'owner','2026-10-30 17:19:50','2026-10-30 17:19:50'),(2,2,1,'owner','2026-10-30 17:22:39','2026-10-30 17:22:39');
/*!40000 ALTER TABLE `team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_personal` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teams_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'ابوالفضل خواجه زاده\'s Team','aboalfdl-khoagh-zadhs-team',1,'2026-10-30 17:19:50','2026-10-30 17:19:50',NULL),(2,'گروه ۱','groh',0,'2026-10-30 17:22:39','2026-10-30 17:22:39',NULL);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_team_id` bigint unsigned DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_current_team_id_foreign` (`current_team_id`),
  CONSTRAINT `users_current_team_id_foreign` FOREIGN KEY (`current_team_id`) REFERENCES `teams` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ابوالفضل خواجه زاده','ab@abinot.ir','2026-10-30 17:19:58','$2y$12$WRrSUq3jwZnzUHPgauYIyuO7w/gcWS/MBlCDYXNRmmuwmVF8DvmAW',1,NULL,NULL,NULL,NULL,'2026-10-30 17:19:50','2026-10-30 17:22:47');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-31 21:37:27
