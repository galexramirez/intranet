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
-- Table structure for table `ope_inasistencias`
--

DROP TABLE IF EXISTS `ope_inasistencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ope_inasistencias` (
  `ope_inasistenciasid` int NOT NULL AUTO_INCREMENT,
  `inasistencias_id` varchar(15) NOT NULL,
  `inas_programacionid` int NOT NULL,
  `inas_controlfacilitadorid` int NOT NULL,
  `inas_openovedadid` int NOT NULL,
  `inas_novedadid` varchar(15) NOT NULL,
  `inas_novedad` varchar(50) NOT NULL,
  `inas_tiponovedad` varchar(50) NOT NULL,
  `inas_detallenovedad` varchar(50) NOT NULL,
  `inas_descripcion` varchar(1500) NOT NULL,
  `inas_operacion` varchar(45) NOT NULL,
  `inas_fechaoperacion` date NOT NULL,
  `inas_estadoinasistencias` varchar(15) NOT NULL,
  `inas_dni` varchar(8) NOT NULL,
  `inas_codigocolaborador` varchar(4) NOT NULL,
  `inas_nombrecolaborador` varchar(60) NOT NULL,
  `inas_codigocgo` varchar(8) NOT NULL,
  `inas_nombrecgo` varchar(60) NOT NULL,
  `inas_tabla` varchar(45) NOT NULL,
  `inas_servicio` varchar(45) NOT NULL,
  `inas_bus` varchar(45) NOT NULL,
  `inas_lugarexacto` varchar(50) NOT NULL,
  `inas_horainicio` time NOT NULL,
  `inas_horafin` time NOT NULL,
  `inas_totalhoras` time DEFAULT NULL,
  `inas_reportegdh` varchar(2) DEFAULT NULL,
  `inas_fechareportegdh` date DEFAULT NULL,
  `inas_cfargid` int NOT NULL,
  `inas_usuarioid_generar` varchar(8) NOT NULL,
  `inas_fechagenerar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inas_usuarioid_edicion` varchar(8) NOT NULL,
  `inas_fechaedicion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `inas_usuarioid_cerrar` varchar(8) DEFAULT NULL,
  `inas_fechacerrar` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ope_inasistenciasid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:33:13
