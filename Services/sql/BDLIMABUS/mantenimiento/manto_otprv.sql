/* manto_otprv - Registro de las ordenes de trabajo preventivas */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_otprv`;
CREATE TABLE `BDLIMABUS`.`manto_otprv` (
  `cod_otpv` int NOT NULL,
  `otpv_semana` varchar(20) NOT NULL,
  `otpv_turno` varchar(10) NOT NULL,
  `otpv_date_prog` date DEFAULT NULL,
  `otpv_bus` varchar(10) NOT NULL COMMENT 'Orden de Trabajo Preventiva Numero Externo Bus',
  `otpv_fecuencia` varchar(20) NOT NULL,
  `otpv_descripcion` varchar(200) NOT NULL,
  `otpv_asociado` varchar(15) NOT NULL,
  `otpv_genera` varchar(8) DEFAULT NULL,
  `otpv_date_genera` datetime NOT NULL,
  `otpv_estado` varchar(15) NOT NULL,
  `otpv_cgm_cierra` varchar(8) DEFAULT NULL,
  `otpv_tecnico` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_inicio` datetime DEFAULT NULL,
  `otpv_fin` datetime DEFAULT NULL,
  `otpv_kmrealiza` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_hmotor` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_componente` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_obs_as` varchar(12000) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_obs_cgm` varchar(4000) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_cierra_ad` varchar(8) DEFAULT NULL,
  `otpv_date_cierra_ad` datetime DEFAULT NULL,
  `otpv_obs_cierre_ad` varchar(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `otpv_obs_km` int DEFAULT NULL,
  `otpv_cargaid` int DEFAULT NULL,
  PRIMARY KEY (`cod_otpv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;