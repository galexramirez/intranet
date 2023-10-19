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
-- Table structure for table `OPE_Accidentes`
--

DROP TABLE IF EXISTS `OPE_Accidentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `OPE_Accidentes` (
  `OPE_AccidentesId` int NOT NULL AUTO_INCREMENT,
  `Accidentes_Id` varchar(15) NOT NULL,
  `Acci_ProgramacionId` int NOT NULL,
  `Acci_ControlFacilitadorId` int NOT NULL,
  `Acci_OPENovedadId` int NOT NULL,
  `Acci_NovedadId` varchar(15) NOT NULL,
  `Acci_Operacion` varchar(45) NOT NULL,
  `Acci_FechaOperacion` date NOT NULL,
  `Acci_EstadoAccidente` varchar(15) NOT NULL,
  `Acci_UsuarioId_Generar` varchar(8) NOT NULL,
  `Acci_FechaGenerar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Acci_CFaRgId` int NOT NULL,
  `Acci_UsuarioId_Cerrar` varchar(8) DEFAULT NULL,
  `Acci_FechaCerrar` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`OPE_AccidentesId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:33:14
