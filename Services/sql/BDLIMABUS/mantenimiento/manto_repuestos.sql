/* manto_repuestos - Registro de los repuestos utilizados en los vales */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_repuestos`;
CREATE TABLE `BDLIMABUS`.`manto_repuestos` (
  `rep_desc` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `rep_unida` varchar(10) NOT NULL,
  `rep_precio` decimal(10,2) NOT NULL,
  `rep_ingreso` varchar(20) NOT NULL,
  `cod_rep` varchar(20) NOT NULL,
  `rep_asociado` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`cod_rep`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;