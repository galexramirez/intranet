/* manto_rep_vale - Registro del detalle de repuestos por vale */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_rep_vale`;
CREATE TABLE `BDLIMABUS`.`manto_rep_vale` (
  `cod_rv` int NOT NULL AUTO_INCREMENT,
  `rv_id` INT NOT NULL,
  `rv_vale` int NOT NULL,
  `rv_repuesto` varchar(20) NOT NULL,
  `rv_nroserie` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `rv_cantidad` decimal(10,2) NOT NULL,
  `rv_precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cod_rv`),
  KEY `rv_vale` (`rv_vale`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;