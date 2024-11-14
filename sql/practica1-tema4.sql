# ************************************************************
# Antares - SQL Client
# Version 0.7.25
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: localhost (mariadb.org binary distribution 11.4.3)
# Database: salas_coworking_gabriel
# Generation time: 2024-11-14T17:05:28+01:00
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP DATABASE IF EXISTS salas_coworking_gabriel;
CREATE DATABASE IF NOT EXISTS salas_coworking_gabriel;

USE salas_coworking_gabriel;

GRANT ALL PRIVILEGES ON salas_coworking_gabriel.* TO 'gabriel'@'%';
FLUSH PRIVILEGES;

# Dump of table reservations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('confirmada','pendiente','cancelada') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK user_id` (`user_id`),
  KEY `FK room_id` (`room_id`),
  CONSTRAINT `FK room_id` FOREIGN KEY (`room_id`) REFERENCES `work_rooms` (`id`),
  CONSTRAINT `FK user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;

INSERT INTO `reservations` (`id`, `user_id`, `room_id`, `reservation_date`, `start_time`, `end_time`, `status`) VALUES
	(1, 1, 1, "2025-01-02", "08:00:00", "09:00:00", "confirmada"),
	(2, 2, 2, "2025-01-03", "09:00:00", "10:00:00", "confirmada"),
	(3, 3, 3, "2025-01-04", "10:00:00", "11:00:00", "confirmada"),
	(4, 1, 4, "2025-01-05", "11:00:00", "12:00:00", "confirmada"),
	(5, 2, 5, "2025-01-06", "12:00:00", "13:00:00", "confirmada"),
	(6, 3, 6, "2025-01-07", "13:00:00", "14:00:00", "confirmada"),
	(7, 1, 7, "2025-01-08", "14:00:00", "15:00:00", "confirmada"),
	(8, 2, 1, "2025-01-09", "15:00:00", "16:00:00", "confirmada"),
	(9, 3, 2, "2025-01-10", "16:00:00", "17:00:00", "confirmada"),
	(10, 1, 3, "2025-01-11", "17:00:00", "18:00:00", "confirmada"),
	(11, 2, 4, "2025-01-12", "18:00:00", "19:00:00", "confirmada"),
	(12, 3, 5, "2025-01-13", "19:00:00", "20:00:00", "confirmada"),
	(13, 1, 6, "2025-01-14", "20:00:00", "21:00:00", "confirmada"),
	(14, 2, 7, "2025-01-15", "21:00:00", "22:00:00", "confirmada"),
	(15, 3, 1, "2025-01-16", "08:00:00", "09:00:00", "confirmada"),
	(16, 1, 2, "2025-01-17", "09:00:00", "10:00:00", "confirmada"),
	(17, 2, 3, "2025-01-18", "10:00:00", "11:00:00", "confirmada"),
	(18, 3, 4, "2025-01-19", "11:00:00", "12:00:00", "confirmada"),
	(19, 1, 5, "2025-01-20", "12:00:00", "13:00:00", "confirmada"),
	(20, 2, 6, "2025-01-21", "13:00:00", "14:00:00", "confirmada"),
	(21, 3, 7, "2025-01-22", "14:00:00", "15:00:00", "confirmada"),
	(22, 1, 1, "2025-01-23", "15:00:00", "16:00:00", "confirmada"),
	(23, 2, 2, "2025-01-24", "16:00:00", "17:00:00", "confirmada"),
	(24, 3, 3, "2025-01-25", "17:00:00", "18:00:00", "confirmada"),
	(25, 1, 4, "2025-01-26", "18:00:00", "19:00:00", "confirmada"),
	(26, 2, 5, "2025-01-27", "19:00:00", "20:00:00", "confirmada"),
	(27, 3, 6, "2025-01-28", "20:00:00", "21:00:00", "confirmada"),
	(28, 1, 7, "2025-01-29", "21:00:00", "22:00:00", "confirmada"),
	(29, 2, 1, "2025-01-30", "08:00:00", "09:00:00", "confirmada"),
	(30, 3, 2, "2025-01-31", "09:00:00", "10:00:00", "confirmada"),
	(31, 1, 3, "2025-02-01", "10:00:00", "11:00:00", "confirmada"),
	(32, 2, 4, "2025-02-02", "11:00:00", "12:00:00", "confirmada"),
	(33, 3, 5, "2025-02-03", "12:00:00", "13:00:00", "confirmada"),
	(34, 1, 6, "2025-02-04", "13:00:00", "14:00:00", "confirmada"),
	(35, 2, 7, "2025-02-05", "14:00:00", "15:00:00", "confirmada"),
	(36, 3, 1, "2025-02-06", "15:00:00", "16:00:00", "confirmada"),
	(37, 1, 2, "2025-02-07", "16:00:00", "17:00:00", "confirmada"),
	(38, 2, 3, "2025-02-08", "17:00:00", "18:00:00", "confirmada"),
	(39, 3, 4, "2025-02-09", "18:00:00", "19:00:00", "confirmada"),
	(40, 1, 5, "2025-02-10", "19:00:00", "20:00:00", "confirmada"),
	(41, 2, 6, "2025-02-11", "20:00:00", "21:00:00", "confirmada"),
	(42, 3, 7, "2025-02-12", "21:00:00", "22:00:00", "confirmada"),
	(43, 1, 1, "2025-02-13", "08:00:00", "09:00:00", "confirmada"),
	(44, 2, 2, "2025-02-14", "09:00:00", "10:00:00", "confirmada"),
	(45, 3, 3, "2025-02-15", "10:00:00", "11:00:00", "confirmada"),
	(46, 1, 4, "2025-02-16", "11:00:00", "12:00:00", "confirmada"),
	(47, 2, 5, "2025-02-17", "12:00:00", "13:00:00", "confirmada"),
	(48, 3, 6, "2025-02-18", "13:00:00", "14:00:00", "confirmada"),
	(49, 1, 7, "2025-02-19", "14:00:00", "15:00:00", "confirmada");

/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(9) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `created_at`) VALUES
	(1, "Gabriel", "gabriel@gmail.com", "$2y$10$jwx50cK6rgCg0tXYiUlqQ.1kIzpMZEpNKkuQACXsBtdPv/FNSgWgm", "123456789", "2024-11-11"),
	(2, "Manolo", "manolo@gmail.com", "$2y$10$32x0mYd41.FQc.HmcFTxmewcnvwlOdWW5jmJ8uCN/3OnKeABlbyBW", "666222111", "2024-11-11"),
	(3, "Maria", "maria@gmail.com", "$2y$10$hO9GRclIo1/CmOuABXbdxON0lsykiyX3hcRisLtFLpmNbSEbRFTxC", "999888777", "2024-11-14");

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table work_rooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `work_rooms`;

CREATE TABLE `work_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `capacity` tinyint(2) NOT NULL,
  `location` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `work_rooms` WRITE;
/*!40000 ALTER TABLE `work_rooms` DISABLE KEYS */;

INSERT INTO `work_rooms` (`id`, `name`, `capacity`, `location`) VALUES
	(1, "Emmerich - Effertz", 8, "Paradigm"),
	(2, "Gerhold - McClure", 7, "Quality"),
	(3, "Runolfsdottir, Reilly and Dare", 3, "Integration"),
	(4, "Sanford - Weissnat", 7, "Creative"),
	(5, "Leffler Group", 10, "Intranet"),
	(6, "Koepp - Stracke", 10, "Brand"),
	(7, "Hoppe, Reynolds and Senger", 7, "Solutions");

/*!40000 ALTER TABLE `work_rooms` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of views
# ------------------------------------------------------------

# Creating temporary tables to overcome VIEW dependency errors


/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# Dump completed on 2024-11-14T17:05:28+01:00
