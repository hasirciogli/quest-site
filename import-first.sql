-- --------------------------------------------------------
-- Sunucu:                       localhost
-- Sunucu sürümü:                8.0.32 - MySQL Community Server - GPL
-- Sunucu İşletim Sistemi:       Win64
-- HeidiSQL Sürüm:               12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- anonimol.com için veritabanı yapısı dökülüyor
CREATE DATABASE IF NOT EXISTS `anonimol.com` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `anonimol.com`;

-- tablo yapısı dökülüyor anonimol.com.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `category_code` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_code` (`category_code`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- anonimol.com.categories: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `category_name`, `category_code`) VALUES
	(1, 'Var Mı Bilen ?', 'var-mi-bilen'),
	(3, 'Ekonomi', 'ekonomi'),
	(39, '', '');

-- tablo yapısı dökülüyor anonimol.com.likes
CREATE TABLE IF NOT EXISTS `likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `liked_to` bigint DEFAULT NULL,
  `liked_by` bigint DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- anonimol.com.likes: ~3 rows (yaklaşık) tablosu için veriler indiriliyor
DELETE FROM `likes`;
INSERT INTO `likes` (`id`, `liked_to`, `liked_by`, `created_at`, `updated_at`) VALUES
	(1, 89, 1, '2023-03-03 00:59:02', '2023-03-03 03:07:56'),
	(2, 89, 2, '2023-03-03 03:30:47', '2023-03-03 03:30:47'),
	(3, 90, 2, '2023-03-03 03:30:51', '2023-03-03 03:30:52');

-- tablo yapısı dökülüyor anonimol.com.quests
CREATE TABLE IF NOT EXISTS `quests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `owner_id` bigint DEFAULT NULL,
  `category` text COLLATE utf8mb4_turkish_ci,
  `header` text COLLATE utf8mb4_turkish_ci,
  `content` text COLLATE utf8mb4_turkish_ci,
  `secret_mode` int DEFAULT '0',
  `image_url` longtext COLLATE utf8mb4_turkish_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- anonimol.com.quests: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
DELETE FROM `quests`;
INSERT INTO `quests` (`id`, `owner_id`, `category`, `header`, `content`, `secret_mode`, `image_url`, `created_at`, `updated_at`) VALUES
	(87, 2, 'var-mi-bilen,', 'Kocam aptal mı', 'Gece altına işiyor sizce kocamdan ayrılmalı mıyım, Her gece bez bağlamaktan bıktı aq ya', 1, '', '2023-02-27 05:06:22', '2023-03-02 11:21:46'),
	(88, 3, 'var-mi-bilen,', 'Horlama problemi', 'Her gece fazlasıyla horluyorum ve kocam bundan gerçekten rahatsız. Kocamı tatmin de edemiyorum ne yapmaml azım ?', 1, NULL, '2023-02-27 06:19:23', '2023-02-27 06:24:12'),
	(89, 1, 'var-mi-bilen,', 'Ucuz steam oyunları', 'Dolar olmuş 20 lira, Ucuz oyun kalmadı. Bildiğiniz varsa iletilirmisiniz. Böyle giderse türkiye elden gidecek...', 0, NULL, '2023-02-27 06:21:05', '2023-02-27 06:24:02'),
	(90, 4, 'var-mi-bilen,', 'Hamburger çok yiyorum', 'Fazla tok tutuyor ama çok şişmanım ne yapmam lazım ?', 0, NULL, '2023-02-27 06:25:31', '2023-03-03 00:52:46');

-- tablo yapısı dökülüyor anonimol.com.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(32) COLLATE utf8mb4_turkish_ci NOT NULL,
  `access` int unsigned DEFAULT NULL,
  `data` text COLLATE utf8mb4_turkish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- anonimol.com.sessions: ~1 rows (yaklaşık) tablosu için veriler indiriliyor
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `access`, `data`) VALUES
	('o1fv14b287dcbknc0md352cboo', 1677814537, 'is_logged|i:1;logged_user_id|i:1;');

-- tablo yapısı dökülüyor anonimol.com.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `gender` int DEFAULT '0',
  `second_badge` enum('none','confirmed','banned','admin','special') CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  `status` int DEFAULT '1',
  `level` decimal(26,2) NOT NULL DEFAULT '0.00',
  `ban_text` longtext COLLATE utf8mb4_turkish_ci,
  `need_confirmation` int DEFAULT '0',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- anonimol.com.users: ~4 rows (yaklaşık) tablosu için veriler indiriliyor
DELETE FROM `users`;
INSERT INTO `users` (`id`, `id_number`, `name`, `surname`, `username`, `password`, `gender`, `second_badge`, `status`, `level`, `ban_text`, `need_confirmation`, `created_date`, `updated_date`) VALUES
	(1, NULL, 'Mustafa', 'Hasırcıoğlu', 'hasirciogli', '123', 1, NULL, 10, 12.00, NULL, 0, '2023-02-27 00:31:35', '2023-03-03 03:24:07'),
	(2, NULL, 'Merve', 'Şen', 'mervos_6', '123', 0, NULL, 2, 0.00, NULL, 0, '2023-02-27 02:38:00', '2023-03-03 03:24:10'),
	(3, NULL, 'Halil', 'Yüksel', 'hlil_1965', '123', 1, NULL, 3, 0.00, NULL, 0, '2023-02-27 06:24:41', '2023-03-03 03:24:16'),
	(4, NULL, 'Melih', 'Özcan', 'm_ozcan_1965', '123', 1, NULL, 0, 0.00, NULL, 0, '2023-02-27 06:25:00', '2023-03-03 03:24:22');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
