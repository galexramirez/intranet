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
-- Table structure for table `OPE_ControlFacilitadorEDT`
--

DROP TABLE IF EXISTS `OPE_ControlFacilitadorEDT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `OPE_ControlFacilitadorEDT` (
  `EDT_Id` int NOT NULL AUTO_INCREMENT,
  `EDT_FechaEdicion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EDT_UsuarioId_Edicion` varchar(8) NOT NULL,
  `ControlFacilitador_Id` int NOT NULL,
  `Programacion_Id` int NOT NULL,
  `Prog_Codigo` varchar(45) NOT NULL,
  `Prog_Operacion` varchar(45) NOT NULL,
  `Prog_Fecha` date NOT NULL,
  `Prog_Dni` varchar(8) NOT NULL,
  `Prog_CodigoColaborador` varchar(4) NOT NULL,
  `Prog_NombreColaborador` varchar(60) NOT NULL,
  `Prog_Tabla` varchar(45) NOT NULL,
  `Prog_HoraOrigen` time NOT NULL,
  `Prog_HoraDestino` time NOT NULL,
  `Prog_Servicio` varchar(45) NOT NULL,
  `Prog_ServBus` varchar(45) NOT NULL,
  `Prog_Bus` varchar(45) NOT NULL,
  `Prog_LugarOrigen` varchar(50) NOT NULL,
  `Prog_LugarDestino` varchar(50) NOT NULL,
  `Prog_TipoEvento` varchar(50) NOT NULL,
  `Prog_Observaciones` varchar(120) NOT NULL,
  `Prog_KmXPuntos` float NOT NULL,
  `Prog_TipoTabla` varchar(45) NOT NULL,
  `Prog_NPlaca` varchar(45) NOT NULL,
  `Prog_NVid` varchar(45) NOT NULL,
  `Prog_IdManto` varchar(45) NOT NULL,
  `Prog_Sentido` varchar(45) NOT NULL,
  `Prog_BusManto` varchar(45) NOT NULL,
  `Prog_Viajes` varchar(45) NOT NULL,
  `CFaRg_Id` int NOT NULL,
  `CFaci_Estado` varchar(15) NOT NULL,
  `CFaci_UsuarioId` varchar(8) NOT NULL,
  `CFaci_Novedad` varchar(2) DEFAULT NULL,
  `CFaci_ProcesoOrigen` varchar(15) NOT NULL,
  `CFaci_Version` int NOT NULL,
  `CFaci_Campo1` varchar(45) NOT NULL,
  `CFaci_Campo2` varchar(45) NOT NULL,
  `CFaci_Campo3` varchar(45) NOT NULL,
  PRIMARY KEY (`EDT_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=1746 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:33:00
