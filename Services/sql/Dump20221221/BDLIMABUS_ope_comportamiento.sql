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
-- Table structure for table `ope_comportamiento`
--

DROP TABLE IF EXISTS `ope_comportamiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ope_comportamiento` (
  `ope_comportamientoid` int NOT NULL AUTO_INCREMENT,
  `comportamiento_id` varchar(15) NOT NULL,
  `comp_programacionid` int NOT NULL,
  `comp_controlfacilitadorid` int NOT NULL,
  `comp_openovedadid` int NOT NULL,
  `comp_novedadid` varchar(15) NOT NULL,
  `comp_novedad` varchar(50) NOT NULL,
  `comp_tiponovedad` varchar(50) NOT NULL,
  `comp_tipoorigen` varchar(50) NOT NULL,
  `comp_detallenovedad` varchar(50) NOT NULL,
  `comp_descripcion` varchar(1500) NOT NULL,
  `comp_operacion` varchar(45) NOT NULL,
  `comp_fechaoperacion` date NOT NULL,
  `comp_estadocomportamiento` varchar(45) NOT NULL,
  `comp_dni` varchar(8) NOT NULL,
  `comp_codigocolaborador` varchar(4) NOT NULL,
  `comp_nombrecolaborador` varchar(60) NOT NULL,
  `comp_codigocgo` varchar(8) DEFAULT NULL,
  `comp_nombrecgo` varchar(60) DEFAULT NULL,
  `comp_tabla` varchar(45) NOT NULL,
  `comp_servicio` varchar(45) NOT NULL,
  `comp_bus` varchar(45) NOT NULL,
  `comp_lugarexacto` varchar(250) NOT NULL,
  `comp_horainicio` time NOT NULL,
  `comp_horafin` time NOT NULL,
  `comp_linkvideo` varchar(50) DEFAULT NULL,
  `comp_codigofalta` varchar(15) DEFAULT NULL,
  `comp_faltacometida` varchar(250) DEFAULT NULL,
  `comp_monto` float DEFAULT NULL,
  `comp_reconoceresponsabilidad` varchar(2) DEFAULT NULL,
  `comp_reportegdh` varchar(2) DEFAULT NULL,
  `comp_fechareportegdh` date DEFAULT NULL,
  `comp_premio` varchar(2) DEFAULT NULL,
  `comp_cfargid` int NOT NULL,
  `comp_telemetriacargaid` int NOT NULL,
  `comp_usuarioid_generar` varchar(8) NOT NULL,
  `comp_fechagenerar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comp_usuarioid_edicion` varchar(8) NOT NULL,
  `comp_fechaedicion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comp_usuarioid_cerrar` varchar(8) DEFAULT NULL,
  `comp_fechacerrar` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ope_comportamientoid`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:32:49
