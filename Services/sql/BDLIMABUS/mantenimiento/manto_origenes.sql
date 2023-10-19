/* manto_origenes - Registro de los tipos de origenes para las OT Correctivas */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_origenes`;
CREATE TABLE `BDLIMABUS`.`manto_origenes` (
  `cod_origen` int NOT NULL AUTO_INCREMENT,
  `or_nombre` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`cod_origen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;