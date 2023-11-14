-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para bdstoy
CREATE DATABASE IF NOT EXISTS `bdstoy` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bdstoy`;

-- Volcando estructura para tabla bdstoy.alumno
CREATE TABLE IF NOT EXISTS `alumno` (
  `dni` bigint NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellido` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  PRIMARY KEY (`dni`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdstoy.alumno: ~26 rows (aproximadamente)
INSERT INTO `alumno` (`dni`, `nombre`, `apellido`, `fecha_nac`) VALUES
	(38570361, 'Marcos', 'Reynoso', '1995-04-25'),
	(39255959, 'Franco Antonio', 'Robles', '1995-06-05'),
	(40018598, 'Kevin Gustavo', 'Quiroga', '1995-12-17'),
	(40790201, 'Esteban', 'Copello', '2000-03-15'),
	(40790545, 'Daian Exequiel', 'Fernandez', '1996-04-15'),
	(41872676, 'Facundo Ariel', 'Janusa', '1999-03-30'),
	(42069298, 'Marcos Damian', 'Godoy', '1998-05-14'),
	(42070085, 'Maria Pia', 'Melgarejo', '2000-12-12'),
	(42850626, 'Lucas Gabriel', 'Barreiro', '1999-06-15'),
	(43149316, 'Franco Agustin', 'Chape', '1996-09-12'),
	(43414566, 'Maximiliano', 'Weyler', '1995-03-08'),
	(43631710, 'Thiago Jeremias', 'Meseguer', '1999-04-25'),
	(43631803, 'Bruno', 'Godoy', '2000-05-06'),
	(43632750, 'Roman', 'Coletti', '2001-08-05'),
	(44282007, 'Bianca Ariana', 'Quiroga', '1999-05-06'),
	(44623314, 'Facundo Geronimo', 'Figun', '1996-03-12'),
	(44644523, 'Ignacio Agustin', 'Piter', '1999-05-24'),
	(44980999, 'Nicolas Osvaldo', 'Fernandez', '1998-12-09'),
	(44981059, 'Federico Jose', 'Martinolich', '2000-02-14'),
	(45048325, 'Felipe', 'Franco', '2000-11-01'),
	(45048950, 'Facundo Martin', 'Jara', '2000-04-15'),
	(45385675, 'Teo', 'Hildt', '2000-05-21'),
	(45387761, 'Santiago Nicolas ', 'Martinez', '2004-11-23'),
	(45389325, 'Lucas Jeremias', 'Fiorotto', '2004-12-01'),
	(45741185, 'Pablo Federico', 'Martinez', '2000-02-14'),
	(45847922, 'Franco', 'Cabrera', '2000-08-06');

-- Volcando estructura para tabla bdstoy.asistencia
CREATE TABLE IF NOT EXISTS `asistencia` (
  `dni` bigint NOT NULL,
  `fecha_asistencia` datetime DEFAULT NULL,
  `id` bigint NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `dni_asistencia` (`dni`) USING BTREE,
  CONSTRAINT `Alumno-asistencia` FOREIGN KEY (`dni`) REFERENCES `alumno` (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdstoy.asistencia: ~0 rows (aproximadamente)

-- Volcando estructura para tabla bdstoy.parametro
CREATE TABLE IF NOT EXISTS `parametro` (
  `total_clases` int DEFAULT NULL,
  `promocion` int DEFAULT NULL,
  `libre` int DEFAULT NULL,
  `regular` int DEFAULT NULL,
  `id` int DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `tolerancia` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla bdstoy.parametro: ~1 rows (aproximadamente)
INSERT INTO `parametro` (`total_clases`, `promocion`, `libre`, `regular`, `id`, `hora_inicio`, `hora_fin`, `tolerancia`) VALUES
	(1, 1, 1, 1, 1, '00:00:00', '00:00:00', '00:00:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
