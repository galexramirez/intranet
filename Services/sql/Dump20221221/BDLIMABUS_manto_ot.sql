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
-- Table structure for table `manto_ot`
--

DROP TABLE IF EXISTS `manto_ot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manto_ot` (
  `cod_ot` int NOT NULL DEFAULT '0',
  `ot_origen` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_bus` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_kilometraje` int DEFAULT NULL,
  `ot_date_crea` datetime DEFAULT NULL,
  `ot_date_ct` datetime DEFAULT NULL,
  `ot_asociado` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_hmotor` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_cgm_crea` varchar(8) DEFAULT NULL,
  `ot_cgm_ct` varchar(8) DEFAULT NULL,
  `ot_estado` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_reg_rec` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ot_resp_asoc` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_descrip` varchar(13000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_tecnico` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_check` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_obs_cgm` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_recep_aom` int DEFAULT NULL,
  `ot_date_recep_aom` datetime DEFAULT NULL,
  `ot_sistema` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_inicio` datetime DEFAULT NULL,
  `ot_fin` datetime DEFAULT NULL,
  `ot_codfalla` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_at` varchar(1300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_obs_asoc` varchar(1300) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_montado` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_dmontado` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_busmont` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_busdmont` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_motivo` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_obs_aom` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_ca` varchar(8) DEFAULT NULL,
  `ot_date_ca` datetime DEFAULT NULL,
  `ot_obs_km` int DEFAULT NULL,
  `ot_date_rec_cgm` datetime DEFAULT NULL,
  `ot_pin` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ot_componente_raiz` varchar(500) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-21 10:32:50
