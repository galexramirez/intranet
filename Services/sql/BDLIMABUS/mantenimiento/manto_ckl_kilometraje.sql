/* manto_ckl_kilometraje - Registro de kilometraje diario por bus */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_ckl_kilometraje`;
CREATE TABLE `BDLIMABUS`.`manto_ckl_kilometraje` (
  `CKL_KM_FECHA` date NOT NULL,
  `CKL_KM_BUS` varchar(11) NOT NULL,
  `CKL_KM_KILOMETRAJE` int(11) NOT NULL,
  `CKL_KM_USU_CARGA` varchar(8) NOT NULL,
  `CKL_KM_FECHA_CARGA` datetime NOT NULL,
  `CKL_KM_HISTORIAL` varchar(500) DEFAULT NULL,
  `CKL_KM_MOTIVO` varchar(45) DEFAULT NULL,
  `CKL_KILOMETRAJEcol` varchar(45) DEFAULT NULL,
  `ckl_km_kmcargaid` int(11) NOT NULL,
  PRIMARY KEY (`CKL_KM_FECHA`,`CKL_KM_BUS`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
