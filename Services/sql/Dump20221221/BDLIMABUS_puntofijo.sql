-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: 192.168.20.29    Database: BDLIMABUS
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `puntofijo`
--

DROP TABLE IF EXISTS `puntofijo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puntofijo` (
  `PuntoFijo_id` int NOT NULL AUTO_INCREMENT,
  `Puntofijo_Nro` varchar(6) DEFAULT NULL,
  `Puntofijo_Evaluador` varchar(20) DEFAULT NULL,
  `Puntofijo_FranjaHoraria` varchar(20) DEFAULT NULL,
  `Puntofijo_FechaDelEvento` date DEFAULT NULL,
  `Puntofijo_Estado` varchar(10) DEFAULT NULL,
  `Puntofijo_Dni` varchar(8) DEFAULT NULL,
  `Puntofijo_Codigo` varchar(4) DEFAULT NULL,
  `Puntofijo_NombreOperador` varchar(50) DEFAULT NULL,
  `Puntofijo_Tabla` varchar(4) DEFAULT NULL,
  `Puntofijo_HoraInspeccion` time DEFAULT NULL,
  `Puntofijo_Bus` varchar(5) DEFAULT NULL,
  `Puntofijo_LugarInspeccion` varchar(25) DEFAULT NULL,
  `Puntofijo_Sentido` varchar(5) DEFAULT NULL,
  `Puntofijo_TipologiaMulta` varchar(5) DEFAULT NULL,
  `Puntofijo_Infraccion` varchar(600) DEFAULT NULL,
  `Puntofijo_Calificacion` varchar(15) DEFAULT NULL,
  `Puntofijo_MontoDeMulta` decimal(6,2) DEFAULT NULL,
  `Puntofijo_PuntosLbi` int DEFAULT NULL,
  `Puntofijo_NroVideo` varchar(210) DEFAULT NULL,
  `Puntofijo_TipoDeEvaluacion` varchar(50) DEFAULT NULL,
  `Puntofijo_AccionCorrectiva` varchar(35) DEFAULT NULL,
  `Puntofijo_FechaAC` date DEFAULT NULL,
  `Puntofijo_Observaciones` varchar(350) DEFAULT NULL,
  `Puntofijo_Piloto` varchar(15) DEFAULT NULL,
  `PuntoFijo_FechaCarga` datetime DEFAULT NULL,
  PRIMARY KEY (`PuntoFijo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=791 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:32:53
