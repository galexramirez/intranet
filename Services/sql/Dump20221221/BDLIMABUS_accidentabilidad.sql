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
-- Table structure for table `accidentabilidad`
--

DROP TABLE IF EXISTS `accidentabilidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accidentabilidad` (
  `Accidentabilidad_id` int NOT NULL AUTO_INCREMENT,
  `Acci_CodApl` int DEFAULT NULL,
  `Acci_FechaAccidente` date DEFAULT NULL,
  `Acci_HoraDeAccidente` time DEFAULT NULL,
  `Acci_NombreDeCgo` varchar(45) DEFAULT NULL,
  `Acci_DniPiloto` varchar(8) DEFAULT NULL,
  `Acci_CodigoPiloto` varchar(6) DEFAULT NULL,
  `Acci_NombreDePiloto` varchar(60) DEFAULT NULL,
  `Acci_FechaDeIngreso` date DEFAULT NULL,
  `Acci_AntiguedadDePiloto` varchar(100) DEFAULT NULL,
  `Acci_Tabla` varchar(45) DEFAULT NULL,
  `Acci_NumBus` varchar(45) DEFAULT NULL,
  `Acci_Servicio` varchar(45) DEFAULT NULL,
  `Acci_DireccionAccidente` varchar(80) DEFAULT NULL,
  `Acci_SentidoAccidente` varchar(45) DEFAULT NULL,
  `Acci_ClaseDeAccidente` varchar(45) DEFAULT NULL,
  `Acci_Evento` varchar(70) DEFAULT NULL,
  `Acci_OcurrenciaAccidente` varchar(2450) DEFAULT NULL,
  `Acci_PilotoReconoceResponsabilidad` varchar(20) DEFAULT NULL,
  `Acci_DañosVehiculoLbi` varchar(800) DEFAULT NULL,
  `Acci_Conciliado` varchar(20) DEFAULT NULL,
  `Acci_Moneda` varchar(45) DEFAULT NULL,
  `Acci_Monto` decimal(6,2) DEFAULT NULL,
  `Acci_TramitePolicial` varchar(45) DEFAULT NULL,
  `Acci_AsistioAccidente` varchar(45) DEFAULT NULL,
  `Acci_FaltaCometidaPorElPiloto` varchar(80) DEFAULT NULL,
  `Acci_FaltaCometida2` varchar(80) DEFAULT NULL,
  `Acci_ResponsabilidadDeFalta2` varchar(20) DEFAULT NULL,
  `Acci_GravedadDeEvento` varchar(45) DEFAULT NULL,
  `Acci_CostoTotalDeAccidente` decimal(9,2) DEFAULT NULL,
  `Acci_Responsabilidad` varchar(45) DEFAULT NULL,
  `Acci_FechaCarga` datetime DEFAULT NULL,
  PRIMARY KEY (`Accidentabilidad_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5422 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:33:02
