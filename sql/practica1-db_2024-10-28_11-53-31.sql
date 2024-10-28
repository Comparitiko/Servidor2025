# ************************************************************
# Antares - SQL Client
# Version 0.7.25
# 
# https://antares-sql.app/
# https://github.com/antares-sql/antares
# 
# Host: localhost (mariadb.org binary distribution 11.4.3)
# Database: practica1-db
# Generation time: 2024-10-28T11:53:57+01:00
# ************************************************************

DROP DATABASE IF EXISTS `practica1-db-gabriel`;

CREATE DATABASE IF NOT EXISTS `practica1-db-gabriel`;

USE `practica1-db-gabriel`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table proyectos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `proyectos`;

CREATE TABLE `proyectos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin_prevista` date NOT NULL,
  `porcentaje_completado` tinyint(3) NOT NULL,
  `importancia` tinyint(1) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `proyectos` WRITE;
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;

INSERT INTO `proyectos` (`id`, `nombre`, `fecha_inicio`, `fecha_fin_prevista`, `porcentaje_completado`, `importancia`, `id_usuario`) VALUES
	(2, "Reunion Distributed Steel", "2024-10-27", "2025-07-19", 62, 1, 2),
	(3, "purple Regional editado", "2024-10-27", "2025-03-25", 80, 3, 1),
	(4, "Road", "2024-10-27", "2025-09-18", 36, 3, 2),
	(6, "Rican", "2024-10-27", "2025-01-02", 11, 1, 1),
	(7, "harness facilitate", "2024-10-28", "2025-10-09", 85, 5, 3),
	(8, "Dollar Plastic composite", "2024-10-27", "2024-12-06", 24, 1, 1),
	(9, "Optimization Lebanese", "2024-10-27", "2025-02-19", 25, 2, 2),
	(10, "Research Account withdrawal", "2024-10-27", "2025-10-22", 47, 4, 2),
	(11, "navigating Shoes", "2024-10-28", "2025-08-26", 34, 4, 1),
	(12, "Manager GB", "2024-10-28", "2024-11-09", 23, 5, 3),
	(13, "Shirt", "2024-10-27", "2025-04-07", 89, 5, 2),
	(14, "Plastic Indonesia Interactions", "2024-10-28", "2025-04-18", 83, 5, 3),
	(15, "Soap Chips", "2024-10-27", "2025-09-26", 77, 4, 1),
	(16, "Configurable disintermediate", "2024-10-27", "2025-07-16", 60, 5, 2),
	(17, "Brand withdrawal", "2024-10-28", "2025-07-25", 85, 4, 3),
	(18, "Checking Concrete", "2024-10-28", "2025-09-04", 15, 5, 1),
	(19, "Home microchip", "2024-10-27", "2025-01-02", 96, 3, 3),
	(20, "withdrawal RAM array", "2024-10-27", "2025-05-20", 22, 1, 2),
	(21, "mint iterate application", "2024-10-27", "2025-05-27", 4, 1, 1),
	(22, "Implementation generate", "2024-10-27", "2025-04-27", 60, 4, 1),
	(23, "Interactions", "2024-10-27", "2024-11-12", 39, 5, 3),
	(24, "neural forecast Diverse", "2024-10-28", "2025-10-14", 60, 2, 3),
	(25, "York", "2024-10-27", "2025-04-23", 40, 4, 2),
	(26, "paradigms Creative", "2024-10-27", "2024-11-20", 21, 3, 1),
	(27, "Leu Nebraska programming", "2024-10-28", "2024-12-03", 36, 2, 2),
	(28, "Cambridgeshire protocol", "2024-10-28", "2025-04-20", 18, 4, 3),
	(29, "violet Lock", "2024-10-27", "2025-10-15", 9, 4, 1),
	(30, "Shirt Montana relationships", "2024-10-27", "2024-12-01", 4, 1, 3),
	(31, "Implementation", "2024-10-27", "2025-06-20", 79, 5, 1),
	(32, "port maximize Qatar", "2024-10-27", "2025-05-16", 30, 4, 1),
	(33, "applications monitor", "2024-10-28", "2025-03-16", 54, 5, 3),
	(34, "seamless", "2024-10-28", "2025-01-23", 32, 5, 2),
	(35, "alarm Regional Kids", "2024-10-27", "2025-10-26", 53, 5, 1),
	(36, "Supervisor Botswana", "2024-10-28", "2025-06-25", 23, 5, 2),
	(37, "Common Account Loan", "2024-10-27", "2025-06-13", 81, 4, 3),
	(38, "interface harness", "2024-10-27", "2025-06-04", 64, 3, 1),
	(39, "application pixel", "2024-10-27", "2025-04-11", 99, 5, 2),
	(40, "transmitter Compatible Isle", "2024-10-27", "2025-04-28", 9, 1, 1),
	(41, "up Wooden Mouse", "2024-10-28", "2025-05-19", 47, 1, 2),
	(42, "models", "2024-10-27", "2025-06-07", 28, 3, 1),
	(43, "overriding Dollar", "2024-10-27", "2025-05-17", 28, 4, 3),
	(44, "transmit", "2024-10-27", "2025-02-25", 22, 2, 3),
	(45, "synthesizing bluetooth online", "2024-10-28", "2025-04-03", 22, 2, 3),
	(46, "Metal 24/7", "2024-10-27", "2025-01-02", 4, 3, 2),
	(47, "program maximize Arkansas", "2024-10-27", "2025-05-14", 80, 3, 3),
	(48, "Track", "2024-10-28", "2025-04-05", 58, 3, 3),
	(49, "Soap copy Avon", "2024-10-28", "2024-12-05", 22, 5, 3),
	(50, "Music Islands", "2024-10-27", "2025-07-04", 18, 4, 2),
	(51, "turquoise", "2024-10-28", "2025-02-16", 10, 1, 2),
	(52, "invoice", "2024-10-27", "2025-09-25", 93, 3, 2),
	(53, "monitor parsing Fundamental", "2024-10-28", "2025-04-09", 84, 3, 3),
	(54, "Mission hacking Outdoors", "2024-10-27", "2025-07-05", 98, 4, 2),
	(55, "withdrawal olive Upgradable", "2024-10-27", "2024-11-18", 13, 5, 1),
	(56, "Table", "2024-10-28", "2025-03-24", 83, 5, 2),
	(57, "Designer Shoes Operations", "2024-10-28", "2024-11-25", 21, 5, 2),
	(58, "Rubber Towels", "2024-10-27", "2025-03-09", 26, 4, 2),
	(59, "Loan", "2024-10-27", "2024-12-20", 40, 2, 2),
	(60, "Car Indiana", "2024-10-28", "2025-09-28", 29, 4, 1),
	(61, "dedicated markets", "2024-10-28", "2025-06-13", 43, 3, 3),
	(62, "Producer payment Specialist", "2024-10-28", "2024-11-22", 16, 5, 3),
	(63, "Sausages", "2024-10-28", "2025-10-05", 64, 1, 2),
	(64, "applications Sausages", "2024-10-28", "2025-04-11", 25, 1, 1),
	(65, "Ireland Solutions", "2024-10-28", "2025-05-04", 27, 2, 2),
	(66, "District", "2024-10-28", "2025-02-19", 13, 5, 2),
	(67, "Texas frame sky", "2024-10-27", "2025-06-14", 32, 5, 3),
	(68, "Federation Checking transmitting", "2024-10-27", "2025-04-13", 5, 5, 3),
	(69, "Usability", "2024-10-27", "2025-07-14", 37, 2, 2),
	(70, "sensor fuchsia", "2024-10-27", "2025-02-26", 73, 1, 1),
	(71, "Representative", "2024-10-27", "2024-12-24", 31, 2, 2),
	(72, "optimizing compress deliver", "2024-10-28", "2025-03-01", 14, 2, 1),
	(73, "calculating empower", "2024-10-28", "2025-09-19", 82, 1, 3),
	(74, "generate", "2024-10-28", "2025-06-12", 15, 5, 2),
	(75, "overriding", "2024-10-27", "2024-10-30", 13, 4, 1),
	(76, "neural", "2024-10-27", "2025-09-28", 68, 3, 3),
	(77, "Savings facilitate Intelligent", "2024-10-27", "2025-02-24", 91, 2, 3),
	(78, "Fundamental", "2024-10-27", "2025-04-13", 67, 3, 3),
	(79, "Unbranded", "2024-10-28", "2025-06-29", 69, 4, 2),
	(80, "moderator Granite Intelligent", "2024-10-27", "2024-11-13", 77, 1, 1),
	(81, "Music Internal Savings", "2024-10-27", "2025-03-04", 65, 1, 2),
	(82, "groupware", "2024-10-27", "2025-10-11", 100, 4, 1),
	(83, "Ethiopian", "2024-10-27", "2024-12-14", 75, 2, 2),
	(84, "partnerships Health Liberian", "2024-10-27", "2025-02-24", 88, 2, 1),
	(85, "black Wooden Route", "2024-10-28", "2024-11-08", 79, 1, 2),
	(86, "Agent Unbranded", "2024-10-27", "2025-07-28", 0, 5, 2),
	(87, "transmitting compressing", "2024-10-28", "2024-12-31", 63, 2, 3),
	(88, "homogeneous transmit", "2024-10-28", "2025-10-14", 80, 3, 1),
	(89, "mindshare", "2024-10-28", "2025-10-01", 57, 5, 3),
	(90, "Keyboard", "2024-10-27", "2024-11-07", 3, 2, 1),
	(91, "Intelligent Loan Mountains", "2024-10-28", "2025-10-06", 22, 5, 2),
	(92, "Sleek generating Associate", "2024-10-27", "2024-11-26", 18, 2, 2),
	(93, "compress lime connecting", "2024-10-28", "2024-11-09", 8, 4, 2),
	(94, "payment Fresh", "2024-10-28", "2025-03-26", 31, 5, 3),
	(95, "Chips Shirt", "2024-10-28", "2025-03-10", 18, 4, 3),
	(96, "hacking", "2024-10-28", "2025-04-26", 46, 2, 2),
	(97, "Architect", "2024-10-27", "2024-10-29", 72, 3, 2),
	(98, "Program", "2024-10-27", "2025-06-14", 25, 3, 1),
	(99, "AI Philippines Refined", "2024-10-28", "2025-06-11", 50, 4, 3),
	(100, "Senior Borders Sleek", "2024-10-27", "2025-06-15", 85, 5, 3),
	(101, "Loan bandwidth", "2024-10-27", "2025-09-23", 2, 1, 1),
	(102, "Gloves Forward backing", "2024-10-27", "2025-05-27", 46, 3, 3),
	(103, "synthesize Concrete", "2024-10-27", "2025-07-28", 57, 2, 1),
	(104, "ubiquitous Frozen sexy", "2024-10-28", "2025-07-06", 26, 1, 3),
	(105, "grey synergy Fish", "2024-10-27", "2024-12-12", 28, 3, 2),
	(106, "Human", "2024-10-27", "2025-04-09", 76, 2, 1),
	(107, "Connecticut", "2024-10-27", "2024-11-12", 40, 5, 1),
	(108, "copy Rustic", "2024-10-28", "2024-11-03", 5, 5, 2),
	(109, "New SMS navigate", "2024-10-27", "2025-07-30", 26, 1, 1),
	(110, "Unbranded", "2024-10-27", "2025-07-08", 13, 3, 1),
	(112, "Functionality", "2024-10-27", "2024-11-14", 37, 4, 1),
	(113, "Total Soap blue", "2024-10-27", "2025-07-30", 29, 2, 3),
	(114, "parse", "2024-10-27", "2025-01-03", 95, 2, 3),
	(115, "Salad Tasty the", "2024-10-28", "2025-05-13", 97, 4, 2),
	(116, "Via capability Engineer", "2024-10-27", "2025-08-26", 28, 2, 2),
	(117, "withdrawal Beauty", "2024-10-27", "2025-10-17", 98, 5, 3),
	(118, "Soap", "2024-10-27", "2025-10-26", 78, 5, 3),
	(119, "redundant", "2024-10-27", "2025-06-15", 85, 2, 3),
	(120, "New", "2024-10-27", "2025-04-26", 2, 1, 3),
	(121, "primary Soap Realigned", "2024-10-27", "2025-08-09", 71, 3, 1),
	(122, "Granite", "2024-10-28", "2025-05-18", 77, 1, 1),
	(123, "capacitor Glen", "2024-10-28", "2024-10-28", 9, 3, 3),
	(124, "Estonia", "2024-10-27", "2025-02-01", 60, 1, 2),
	(125, "Congolese plum unleash", "2024-10-27", "2024-11-15", 56, 5, 1),
	(126, "Chicken stable", "2024-10-27", "2024-11-03", 95, 3, 1),
	(127, "Market Garden", "2024-10-27", "2025-02-20", 69, 2, 3),
	(128, "Movies Soft", "2024-10-27", "2025-10-14", 36, 4, 2),
	(129, "cohesive Home XML", "2024-10-28", "2025-01-04", 14, 2, 3),
	(130, "orange Applications Internal", "2024-10-27", "2024-11-29", 69, 2, 3),
	(131, "networks Tuna transmit", "2024-10-27", "2025-04-16", 83, 5, 1),
	(132, "Customer", "2024-10-28", "2025-04-22", 36, 4, 2),
	(133, "interactive Greenland bandwidth", "2024-10-27", "2025-04-30", 41, 1, 3),
	(134, "Games Streamlined Mississippi", "2024-10-27", "2025-06-28", 41, 4, 3),
	(135, "Angola Towels XML", "2024-10-28", "2025-08-03", 57, 2, 2),
	(136, "AI", "2024-10-27", "2025-04-07", 7, 4, 3),
	(137, "Trail", "2024-10-28", "2025-09-26", 57, 5, 3),
	(138, "invoice overriding", "2024-10-28", "2024-12-10", 11, 5, 1),
	(139, "Loan Chicken", "2024-10-27", "2025-09-22", 11, 5, 3),
	(140, "withdrawal", "2024-10-28", "2025-09-02", 81, 4, 3),
	(141, "Chips 24/7 Tuna", "2024-10-28", "2024-11-03", 84, 5, 2),
	(142, "generating 1080p", "2024-10-27", "2025-02-23", 41, 4, 2),
	(143, "next Washington", "2024-10-27", "2025-02-03", 84, 5, 2),
	(144, "Toys", "2024-10-27", "2025-01-29", 67, 4, 1),
	(145, "Virginia Cambridgeshire Human", "2024-10-27", "2025-08-24", 33, 5, 1),
	(146, "RAM connecting", "2024-10-28", "2025-08-12", 67, 3, 1),
	(147, "hacking Walks", "2024-10-28", "2025-09-29", 50, 2, 3),
	(148, "Mouse Club Web", "2024-10-27", "2024-11-28", 25, 1, 1),
	(149, "National navigating system", "2024-10-27", "2025-01-13", 39, 4, 1),
	(150, "Legacy", "2024-10-27", "2025-07-23", 67, 1, 1),
	(151, "Motorway parsing SQL", "2024-10-27", "2025-06-05", 24, 1, 3),
	(152, "orchid Ergonomic Views", "2024-10-28", "2025-01-23", 79, 1, 3),
	(153, "Licensed", "2024-10-28", "2025-03-01", 90, 1, 3),
	(154, "Viaduct interface alarm", "2024-10-27", "2024-12-21", 35, 5, 1),
	(155, "Associate", "2024-10-28", "2024-11-11", 69, 2, 2),
	(156, "optical", "2024-10-28", "2025-09-02", 14, 4, 3),
	(157, "copying local", "2024-10-28", "2025-08-02", 51, 4, 3),
	(158, "methodologies Minnesota SDD", "2024-10-27", "2024-11-05", 67, 2, 3),
	(159, "PNG Investment", "2024-10-27", "2025-04-29", 75, 1, 1),
	(160, "Ergonomic mobile Outdoors", "2024-10-28", "2025-08-02", 6, 5, 2),
	(161, "Iceland Alaska", "2024-10-28", "2025-04-04", 92, 3, 1),
	(162, "Ruble Gorgeous", "2024-10-27", "2025-01-10", 45, 4, 2),
	(163, "Dobra Buckinghamshire", "2024-10-28", "2025-09-07", 43, 2, 1),
	(164, "payment input Cambridgeshire", "2024-10-27", "2025-02-12", 29, 2, 1),
	(165, "synthesize Metal tangible", "2024-10-27", "2024-12-02", 53, 1, 1),
	(166, "Practical transmitting", "2024-10-27", "2024-12-01", 24, 5, 2),
	(167, "transition loyalty platforms", "2024-10-27", "2025-04-28", 43, 2, 1),
	(168, "Circles", "2024-10-27", "2025-09-30", 1, 4, 2),
	(169, "Guernsey", "2024-10-28", "2025-06-22", 96, 5, 2),
	(170, "online Brand Sleek", "2024-10-27", "2024-12-17", 37, 5, 1),
	(171, "Frozen Checking", "2024-10-28", "2025-10-23", 37, 4, 2),
	(172, "Movies", "2024-10-28", "2024-12-10", 52, 5, 2),
	(173, "bypass", "2024-10-28", "2025-06-28", 83, 2, 1),
	(174, "Manager", "2024-10-27", "2025-07-16", 47, 4, 1),
	(175, "Handcrafted intuitive contingency", "2024-10-27", "2025-02-26", 62, 1, 2),
	(176, "Bike", "2024-10-28", "2025-01-02", 0, 3, 1),
	(177, "Savings", "2024-10-28", "2025-02-14", 64, 2, 1),
	(178, "responsive", "2024-10-27", "2025-10-21", 22, 2, 3),
	(179, "Bike deposit Colorado", "2024-10-27", "2025-07-30", 82, 2, 1),
	(180, "Bahamas deposit", "2024-10-27", "2025-01-14", 22, 5, 1),
	(181, "French Investor", "2024-10-27", "2025-06-04", 16, 4, 2),
	(182, "Infrastructure synthesize", "2024-10-27", "2025-03-28", 33, 4, 1),
	(183, "quantifying", "2024-10-27", "2025-02-26", 57, 5, 2),
	(184, "Tasty system efficient", "2024-10-28", "2025-03-11", 91, 3, 1),
	(185, "Buckinghamshire Engineer", "2024-10-27", "2025-09-13", 43, 2, 2),
	(186, "Lead", "2024-10-27", "2025-01-19", 30, 3, 1),
	(187, "deposit Rubber navigate", "2024-10-28", "2025-07-20", 16, 2, 2),
	(188, "Cambridgeshire", "2024-10-27", "2025-07-20", 7, 4, 3),
	(189, "Rubber Lari redundant", "2024-10-28", "2025-01-09", 23, 3, 1),
	(190, "Director 1080p input", "2024-10-27", "2025-01-10", 16, 1, 3),
	(191, "Hampshire rich Synchronised", "2024-10-28", "2025-04-03", 91, 3, 3),
	(192, "deposit deposit", "2024-10-28", "2025-07-27", 27, 4, 3),
	(193, "Manager Brand", "2024-10-27", "2025-08-25", 78, 2, 2),
	(194, "Granite Home", "2024-10-27", "2025-09-11", 47, 2, 3),
	(195, "payment recontextualize", "2024-10-27", "2024-12-09", 55, 3, 2),
	(196, "port whiteboard South", "2024-10-28", "2025-06-25", 61, 3, 1),
	(197, "override Handmade", "2024-10-28", "2025-07-03", 90, 3, 2),
	(198, "vortals Moldovan", "2024-10-27", "2024-11-01", 34, 3, 2),
	(199, "up Centers", "2024-10-28", "2025-05-29", 46, 1, 1),
	(200, "Account gold", "2024-10-27", "2024-12-05", 97, 5, 2),
	(201, "bandwidth Circle COM", "2024-10-27", "2025-05-23", 18, 1, 1),
	(202, "Creative", "2024-10-27", "2025-03-03", 78, 5, 1),
	(203, "Small", "2024-10-28", "2025-03-04", 91, 1, 1),
	(204, "Tasty Point index", "2024-10-28", "2024-12-27", 4, 3, 2),
	(205, "framework Frozen migration", "2024-10-27", "2025-10-20", 30, 2, 2),
	(206, "pink Investment", "2024-10-27", "2024-12-06", 89, 4, 2),
	(207, "transmitting", "2024-10-27", "2025-06-19", 54, 4, 1),
	(208, "South blue haptic", "2024-10-28", "2025-07-09", 47, 1, 3),
	(209, "Turkey granular microchip", "2024-10-28", "2024-12-22", 85, 2, 2),
	(210, "payment Wooden", "2024-10-27", "2025-08-12", 24, 1, 2);

/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

INSERT INTO `usuarios` (`id`, `username`, `email`, `password`) VALUES
	(1, "Gabriel", "gabriel@gmail.com", "$2y$10$cK15UNKsc58kagnyKVcE5.RD5roXratvBknXK9vuZTc4UAVb.9fpm"),
	(2, "Manolo", "manolo@gmail.com", "$2y$10$gn6poyczOdrnfTxpOeXCvuFFgUiSboSC87qduZa/rzFVyFUXz/fzK"),
	(3, "Maria", "maria@gmail.com", "$2y$10$jqdnsI2NZLfEou5fTy1oNOU6liGHVu5VKaf4xbidtoUDKckiglYXC");

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
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

# Dump completed on 2024-10-28T11:53:57+01:00
