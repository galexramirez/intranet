/* manto_ot - Registro de las ordenes de trabajo correctivas */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_ot`;
CREATE TABLE `BDLIMABUS`.`manto_ot` (
  `cod_ot` int NOT NULL AUTO_INCREMENT,
  `ot_origen` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_bus` varchar(11) NOT NULL,
  `ot_kilometraje` int DEFAULT NULL,
  `ot_date_crea` datetime DEFAULT NULL,
  `ot_date_ct` datetime DEFAULT NULL,
  `ot_asociado` varchar(50) NOT NULL,
  `ot_hmotor` varchar(11) NOT NULL,
  `ot_cgm_crea` varchar(8) DEFAULT NULL,
  `ot_cgm_ct` varchar(8) DEFAULT NULL,
  `ot_estado` varchar(50) NOT NULL,
  `ot_reg_rec` varchar(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ot_resp_asoc` varchar(50) NOT NULL,
  `ot_descrip` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_tecnico` varchar(50) NOT NULL,
  `ot_check` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_obs_cgm` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_recep_aom` int DEFAULT NULL,
  `ot_date_recep_aom` datetime DEFAULT NULL,
  `ot_sistema` varchar(200) NOT NULL,
  `ot_inicio` datetime DEFAULT NULL,
  `ot_fin` datetime DEFAULT NULL,
  `ot_codfalla` varchar(50) NOT NULL,
  `ot_at` varchar(5000) NOT NULL,
  `ot_obs_asoc` varchar(5000) NOT NULL,
  `ot_montado` varchar(50) NOT NULL,
  `ot_dmontado` varchar(50) NOT NULL,
  `ot_busmont` varchar(11) NOT NULL,
  `ot_busdmont` varchar(11) NOT NULL,
  `ot_motivo` varchar(200) NOT NULL,
  `ot_obs_aom` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ot_ca` varchar(8) DEFAULT NULL,
  `ot_date_ca` datetime DEFAULT NULL,
  `ot_obs_km` int DEFAULT NULL,
  `ot_date_rec_cgm` datetime DEFAULT NULL,
  `ot_pin` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ot_componente_raiz` varchar(500) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `ot_accidentes_id` varchar(15) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `ot_semana_cierre` varchar(45) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  PRIMARY KEY (`cod_ot`),
  KEY `ot_cgm_crea` (`ot_cgm_crea`),
  KEY `ot_cgm_ct` (`ot_cgm_ct`),
  KEY `ot_bus` (`ot_bus`),
  KEY `ot_recep` (`ot_recep_aom`),
  KEY `ot_ca` (`ot_ca`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;