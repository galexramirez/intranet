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
-- Table structure for table `OPE_AccidentesInvestigacion`
--

DROP TABLE IF EXISTS `OPE_AccidentesInvestigacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `OPE_AccidentesInvestigacion` (
  `OPE_AcciInvestigacionId` int NOT NULL AUTO_INCREMENT,
  `Accidentes_Id` varchar(15) NOT NULL,
  `Acci_DatosRegistro` varchar(60) DEFAULT NULL,
  `Acci_Trafico` varchar(45) DEFAULT NULL,
  `Acci_LugarReferencia` varchar(60) DEFAULT NULL,
  `Acci_FactorDeterminante` varchar(60) DEFAULT NULL,
  `Acci_ResponsabilidadDeterminante` varchar(60) DEFAULT NULL,
  `Acci_FactorContributivo` varchar(60) DEFAULT NULL,
  `Acci_ResponsabilidadContributivo` varchar(60) DEFAULT NULL,
  `Acci_TipoExpediente` varchar(2) DEFAULT NULL,
  `Acci_EventoReportado` varchar(45) DEFAULT NULL,
  `Acci_Frecuencia` int DEFAULT NULL,
  `Acci_Probabilidad` int DEFAULT NULL,
  `Acci_Severidad` int DEFAULT NULL,
  `Acci_GravedadEvento` varchar(45) DEFAULT NULL,
  `Acci_ResponsabilidadAccidente` varchar(45) DEFAULT NULL,
  `Acci_GradoFalta` varchar(45) DEFAULT NULL,
  `Acci_Reincidencia` int DEFAULT NULL,
  `Acci_CodigoRIT` varchar(60) DEFAULT NULL,
  `Acci_DescripcionRIT` varchar(1000) DEFAULT NULL,
  `Acci_AccionDisciplinaria` varchar(250) DEFAULT NULL,
  `Acci_ReporteGDH` varchar(2) DEFAULT NULL,
  `Acci_FechaReporteGDH` date DEFAULT NULL,
  `Acci_Premio` varchar(2) DEFAULT NULL,
  `Acci_FechaCierreAccidente` date DEFAULT NULL,
  `Acci_TiempoInvestigacion` time DEFAULT NULL,
  `Acci_CumplimientoMeta` varchar(45) DEFAULT NULL,
  `Acci_DelayRegistro` varchar(45) DEFAULT NULL,
  `Acci_CumplimientoRegistro` varchar(45) DEFAULT NULL,
  `Acci_FechaRegistro` date DEFAULT NULL,
  `Acci_EstadoInvestigacion` varchar(15) NOT NULL,
  PRIMARY KEY (`OPE_AcciInvestigacionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:33:04
