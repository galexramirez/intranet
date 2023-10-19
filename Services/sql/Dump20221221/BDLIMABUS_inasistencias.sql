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
-- Table structure for table `inasistencias`
--

DROP TABLE IF EXISTS `inasistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inasistencias` (
  `Inasistencia_id` int NOT NULL AUTO_INCREMENT,
  `Inas_IdNovedad` varchar(20) DEFAULT NULL,
  `Inas_NombreCGO` varchar(25) DEFAULT NULL,
  `Inas_DNI` varchar(8) DEFAULT NULL,
  `Inas_CodPiloto` varchar(4) DEFAULT NULL,
  `Inas_NombrePiloto` varchar(60) DEFAULT NULL,
  `Inas_TipoPiloto` varchar(20) DEFAULT NULL,
  `Inas_FechaDeEvento` date DEFAULT NULL,
  `Inas_HoraInicio` time DEFAULT NULL,
  `Inas_HoraFinal` time DEFAULT NULL,
  `Inas_TotalHoras` time DEFAULT NULL,
  `Inas_Bus` varchar(10) DEFAULT NULL,
  `Inas_TipoBus` varchar(15) DEFAULT NULL,
  `Inas_Tabla` varchar(20) DEFAULT NULL,
  `Inas_Servicio` varchar(40) DEFAULT NULL,
  `Inas_TipoNovedad` varchar(35) DEFAULT NULL,
  `Inas_DetalleNovedad` varchar(40) DEFAULT NULL,
  `Inas_DescripNovedad` varchar(1300) DEFAULT NULL,
  `Inas_FechaCarga` datetime DEFAULT NULL,
  PRIMARY KEY (`Inasistencia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33080 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:32:40
