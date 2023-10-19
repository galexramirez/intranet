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
-- Table structure for table `OPE_NovedadEDT`
--

DROP TABLE IF EXISTS `OPE_NovedadEDT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `OPE_NovedadEDT` (
  `EDT_Id` int NOT NULL AUTO_INCREMENT,
  `EDT_FechaEdicion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `EDT_UsuarioId_Edicion` varchar(8) NOT NULL,
  `OPE_NovedadId` int NOT NULL,
  `Novedad_Id` varchar(15) NOT NULL,
  `Nove_ProgramacionId` int NOT NULL,
  `Nove_Novedad` varchar(50) NOT NULL,
  `Nove_TipoNovedad` varchar(50) NOT NULL,
  `Nove_DetalleNovedad` varchar(50) NOT NULL,
  `Nove_Descripcion` varchar(1500) NOT NULL,
  `Nove_Operacion` varchar(45) NOT NULL,
  `Nove_FechaOperacion` date NOT NULL,
  `Nove_Dni` varchar(8) NOT NULL,
  `Nove_CodigoColaborador` varchar(4) NOT NULL,
  `Nove_NombreColaborador` varchar(60) NOT NULL,
  `Nove_Tabla` varchar(45) NOT NULL,
  `Nove_HoraOrigen` time NOT NULL,
  `Nove_HoraDestino` time NOT NULL,
  `Nove_Servicio` varchar(45) NOT NULL,
  `Nove_Bus` varchar(45) NOT NULL,
  `Nove_LugarOrigen` varchar(50) NOT NULL,
  `Nove_LugarDestino` varchar(50) NOT NULL,
  `Nove_LugarExacto` varchar(50) DEFAULT NULL,
  `Nove_HoraInicio` time DEFAULT NULL,
  `Nove_HoraFin` time DEFAULT NULL,
  `Nove_Estado` varchar(15) NOT NULL,
  `Nove_UsuarioId` varchar(8) NOT NULL,
  `Nove_ProcesoOrigen` varchar(15) NOT NULL,
  `Nove_Fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Nove_CFaRgId` int NOT NULL,
  `Nove_UsuarioId_Edicion` varchar(8) DEFAULT NULL,
  `Nove_FechaEdicion` timestamp NULL DEFAULT NULL,
  `Nove_UsuarioId_Eliminar` varchar(8) DEFAULT NULL,
  `Nove_FechaEliminar` timestamp NULL DEFAULT NULL,
  `Nove_UsuarioId_Cerrar` varchar(8) DEFAULT NULL,
  `Nove_FechaCerrar` timestamp NULL DEFAULT NULL,
  `Nove_Version` int NOT NULL,
  `Nove_TipoOrigen` varchar(50) NOT NULL,
  PRIMARY KEY (`EDT_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:32:44
