/* manto_resp_asociado - Registro del personal responsable por asociado*/
DROP TABLE IF EXISTS 
CREATE TABLE `BDLIMABUS`.`manto_resp_asociado` (
  `cod_resasoc` int NOT NULL AUTO_INCREMENT,
  `ra_nombres` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ra_asociado` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`cod_resasoc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;