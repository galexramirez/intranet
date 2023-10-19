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
-- Table structure for table `OPE_AccidentesInformePreliminar`
--

DROP TABLE IF EXISTS `OPE_AccidentesInformePreliminar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `OPE_AccidentesInformePreliminar` (
  `OPE_AcciInformePreliminarId` int NOT NULL AUTO_INCREMENT,
  `Accidentes_Id` varchar(15) NOT NULL,
  `Acci_TipoAccidente` varchar(50) NOT NULL,
  `Acci_ClaseAccidente` varchar(50) NOT NULL,
  `Acci_DanosMateriales` varchar(2) DEFAULT NULL,
  `Acci_Lesiones` varchar(2) DEFAULT NULL,
  `Acci_Fatalidad` varchar(2) DEFAULT NULL,
  `Acci_Otro` varchar(2) DEFAULT NULL,
  `Acci_OtroDescripcion` varchar(50) DEFAULT NULL,
  `Acci_TipoEvento` varchar(50) DEFAULT NULL,
  `Acci_Fecha` date NOT NULL,
  `Acci_Hora` time NOT NULL,
  `Acci_Dni` varchar(8) NOT NULL,
  `Acci_CodigoColaborador` varchar(4) NOT NULL,
  `Acci_NombreColaborador` varchar(60) NOT NULL,
  `Acci_Tabla` varchar(45) NOT NULL,
  `Acci_Servicio` varchar(45) NOT NULL,
  `Acci_Bus` varchar(45) NOT NULL,
  `Acci_Lugar` varchar(50) DEFAULT NULL,
  `Acci_Sentido` varchar(45) DEFAULT NULL,
  `Acci_CodigoCGO` varchar(8) DEFAULT NULL,
  `Acci_NombreCGO` varchar(60) DEFAULT NULL,
  `Acci_CodigoPersonalApoyo` varchar(8) DEFAULT NULL,
  `Acci_NombrePersonalApoyo` varchar(60) DEFAULT NULL,
  `Acci_ViajesPerdidos` int DEFAULT NULL,
  `Acci_Conciliacion` varchar(2) DEFAULT NULL,
  `Acci_MontoConciliado` float DEFAULT NULL,
  `Acci_Hospital` varchar(50) DEFAULT NULL,
  `Acci_ReconoceResponsabilidad` varchar(2) DEFAULT NULL,
  `Acci_Comisaria` varchar(50) DEFAULT NULL,
  `Acci_DocReporte` varchar(2) DEFAULT NULL,
  `Acci_DocConciliacion` varchar(2) DEFAULT NULL,
  `Acci_DocPartePolicial` varchar(2) DEFAULT NULL,
  `Acci_DocOficioPeritaje` varchar(2) DEFAULT NULL,
  `Acci_DocReporteAtencion` varchar(2) DEFAULT NULL,
  `Acci_DocDenunciaPolicial` varchar(2) DEFAULT NULL,
  `Acci_DocCitacionManifestacion` varchar(2) DEFAULT NULL,
  `Acci_DocOtro` varchar(2) DEFAULT NULL,
  `Acci_DocOtroDescripcion` varchar(50) DEFAULT NULL,
  `Acci_HoraFinAtencion` time NOT NULL,
  `Acci_HorasTrabajadas` time DEFAULT NULL,
  `Acci_Descripcion` varchar(1500) NOT NULL,
  `Acci_CodigoSuscribeInformacion` varchar(8) DEFAULT NULL,
  `Acci_NombreSuscribeInformacion` varchar(60) DEFAULT NULL,
  `Acci_FechaElaboracionInforme` timestamp NULL DEFAULT NULL,
  `Acci_Objeto` varchar(50) DEFAULT NULL,
  `Acci_HoraLlegadaProcurador` time DEFAULT NULL,
  `Acci_CodigoCGM` varchar(8) DEFAULT NULL,
  `Acci_NombreCGM` varchar(60) DEFAULT NULL,
  `Acci_CodigoPersonalApoyoManto` varchar(8) DEFAULT NULL,
  `Acci_NombrePersonalApoyoManto` varchar(60) DEFAULT NULL,
  `Acci_NumeroOT` varchar(45) DEFAULT NULL,
  `Acci_EstadoInformePreliminar` varchar(15) NOT NULL,
  `Acci_UsuarioId_Generar` varchar(8) NOT NULL,
  `Acci_FechaGenerar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Acci_UsuarioId_Edicion` varchar(8) DEFAULT NULL,
  `Acci_FechaEdicion` timestamp NULL DEFAULT NULL,
  `Acci_UsuarioId_Cerrar` varchar(8) DEFAULT NULL,
  `Acci_FechaCerrar` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`OPE_AcciInformePreliminarId`)
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

-- Dump completed on 2022-12-21 10:33:10
