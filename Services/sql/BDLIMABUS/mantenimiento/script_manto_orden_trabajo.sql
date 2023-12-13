CREATE TABLE `BDLIMABUS`.`manto_orden_trabajo` (
  `ot_id` int NOT NULL AUTO_INCREMENT,
  `cod_ot` int NOT NULL DEFAULT 0,
  `ot_tipo` varchar(45) NOT NULL,
  `ot_origen` varchar(100) NOT NULL,
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
  `ot_obs_cgm` varchar(2700) NOT NULL,
  `ot_recep_aom` int DEFAULT NULL,
  `ot_date_recep_aom` datetime DEFAULT NULL,
  `ot_sistema` varchar(200) NOT NULL,
  `ot_inicio` datetime DEFAULT NULL,
  `ot_fin` datetime DEFAULT NULL,
  `ot_codfalla` varchar(50) NOT NULL,
  `ot_at` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `ot_obs_asoc` varchar(5000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
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
  `ot_accidentes_id` varchar(15) DEFAULT NULL,
  `ot_semana_cierre` varchar(45) DEFAULT NULL,
  `ot_cod_vinculada` int DEFAULT NULL,
  `ot_semana` varchar(20) DEFAULT NULL,
  `ot_turno` varchar(10) DEFAULT NULL,
  `ot_frecuencia` varchar(50) DEFAULT NULL,
  `ot_date_genera`datetime DEFAULT NULL,
  `ot_carga_id` int DEFAULT NULL,
  PRIMARY KEY (`ot_id`),
  INDEX `cod_ot` (`cod_ot` ASC) VISIBLE
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `manto_orden_trabajo` 
CHANGE COLUMN `ot_origen` `ot_origen` VARCHAR(100) NULL ,
CHANGE COLUMN `ot_bus` `ot_bus` VARCHAR(11) NULL ,
CHANGE COLUMN `ot_asociado` `ot_asociado` VARCHAR(50) NULL ,
CHANGE COLUMN `ot_hmotor` `ot_hmotor` VARCHAR(11) NULL ,
CHANGE COLUMN `ot_estado` `ot_estado` VARCHAR(50) NULL ,
CHANGE COLUMN `ot_resp_asoc` `ot_resp_asoc` VARCHAR(50) NULL ,
CHANGE COLUMN `ot_descrip` `ot_descrip` VARCHAR(10000) CHARACTER SET 'utf8mb3' NULL ,
CHANGE COLUMN `ot_tecnico` `ot_tecnico` VARCHAR(50) NULL ,
CHANGE COLUMN `ot_check` `ot_check` VARCHAR(10) CHARACTER SET 'utf8mb3' NULL ,
CHANGE COLUMN `ot_obs_cgm` `ot_obs_cgm` VARCHAR(2700) NULL ,
CHANGE COLUMN `ot_sistema` `ot_sistema` VARCHAR(200) NULL ,
CHANGE COLUMN `ot_codfalla` `ot_codfalla` VARCHAR(50) NULL ,
CHANGE COLUMN `ot_at` `ot_at` VARCHAR(5000) CHARACTER SET 'utf8mb3' NULL ,
CHANGE COLUMN `ot_obs_asoc` `ot_obs_asoc` VARCHAR(5000) CHARACTER SET 'utf8mb3' NULL ,
CHANGE COLUMN `ot_montado` `ot_montado` VARCHAR(50) NULL ,
CHANGE COLUMN `ot_dmontado` `ot_dmontado` VARCHAR(50) NULL ,
CHANGE COLUMN `ot_busmont` `ot_busmont` VARCHAR(11) NULL ,
CHANGE COLUMN `ot_busdmont` `ot_busdmont` VARCHAR(11) NULL ,
CHANGE COLUMN `ot_motivo` `ot_motivo` VARCHAR(200) NULL ,
CHANGE COLUMN `ot_obs_aom` `ot_obs_aom` VARCHAR(1000) CHARACTER SET 'latin1' NULL ,
CHANGE COLUMN `ot_componente_raiz` `ot_componente_raiz` VARCHAR(500) CHARACTER SET 'ascii' NULL ;

INSERT INTO `BDLIMABUS`.`manto_orden_trabajo`
(`ot_tipo`,
`cod_ot`,
`ot_origen`,
`ot_bus`,
`ot_kilometraje`,
`ot_date_crea`,
`ot_date_ct`,
`ot_asociado`,
`ot_hmotor`,
`ot_cgm_crea`,
`ot_cgm_ct`,
`ot_estado`,
`ot_reg_rec`,
`ot_resp_asoc`,
`ot_descrip`,
`ot_tecnico`,
`ot_check`,
`ot_obs_cgm`,
`ot_recep_aom`,
`ot_date_recep_aom`,
`ot_sistema`,
`ot_inicio`,
`ot_fin`,
`ot_codfalla`,
`ot_at`,
`ot_obs_asoc`,
`ot_montado`,
`ot_dmontado`,
`ot_busmont`,
`ot_busdmont`,
`ot_motivo`,
`ot_obs_aom`,
`ot_ca`,
`ot_date_ca`,
`ot_obs_km`,
`ot_date_rec_cgm`,
`ot_pin`,
`ot_componente_raiz`,
`ot_accidentes_id`,
`ot_semana_cierre`,
`ot_cod_vinculada`,
`ot_semana`,
`ot_turno`,
`ot_frecuencia`,
`ot_date_genera`,
`ot_carga_id`)
SELECT
'CORRECTIVAS',
`cod_ot`,
`ot_origen`,
`ot_bus`,
`ot_kilometraje`,
`ot_date_crea`,
`ot_date_ct`,
`ot_asociado`,
`ot_hmotor`,
`ot_cgm_crea`,
`ot_cgm_ct`,
`ot_estado`,
`ot_reg_rec`,
`ot_resp_asoc`,
`ot_descrip`,
`ot_tecnico`,
`ot_check`,
`ot_obs_cgm`,
`ot_recep_aom`,
`ot_date_recep_aom`,
`ot_sistema`,
`ot_inicio`,
`ot_fin`,
`ot_codfalla`,
`ot_at`,
`ot_obs_asoc`,
`ot_montado`,
`ot_dmontado`,
`ot_busmont`,
`ot_busdmont`,
`ot_motivo`,
`ot_obs_aom`,
`ot_ca`,
`ot_date_ca`,
`ot_obs_km`,
`ot_date_rec_cgm`,
`ot_pin`,
`ot_componente_raiz`,
`ot_accidentes_id`,
`ot_semana_cierre`,
NULL,
NULL,
NULL,
NULL,
NULL,
NULL
FROM `BDLIMABUS`.`manto_ot`;

INSERT INTO `BDLIMABUS`.`manto_orden_trabajo`
(`ot_tipo`,
`cod_ot`,
`ot_origen`,
`ot_bus`,
`ot_kilometraje`,
`ot_date_crea`,
`ot_date_ct`,
`ot_asociado`,
`ot_hmotor`,
`ot_cgm_crea`,
`ot_cgm_ct`,
`ot_estado`,
`ot_reg_rec`,
`ot_resp_asoc`,
`ot_descrip`,
`ot_tecnico`,
`ot_check`,
`ot_obs_cgm`,
`ot_recep_aom`,
`ot_date_recep_aom`,
`ot_sistema`,
`ot_inicio`,
`ot_fin`,
`ot_codfalla`,
`ot_at`,
`ot_obs_asoc`,
`ot_montado`,
`ot_dmontado`,
`ot_busmont`,
`ot_busdmont`,
`ot_motivo`,
`ot_obs_aom`,
`ot_ca`,
`ot_date_ca`,
`ot_obs_km`,
`ot_date_rec_cgm`,
`ot_pin`,
`ot_componente_raiz`,
`ot_accidentes_id`,
`ot_semana_cierre`,
`ot_cod_vinculada`,
`ot_semana`,
`ot_turno`,
`ot_frecuencia`,
`ot_date_genera`,
`ot_carga_id`)
SELECT
"PREVENTIVAS",
`cod_otpv`,
NULL,
`otpv_bus`,
IF(`otpv_kmrealiza`='',NULL,CAST(`otpv_kmrealiza` AS SIGNED)),
`otpv_date_prog`,
NULL,
`otpv_asociado`,
`otpv_hmotor`,
`otpv_genera`,
`otpv_cgm_cierra`,
`otpv_estado`,
NULL,
NULL,
`otpv_descripcion`,
`otpv_tecnico`,
NULL,
`otpv_obs_cgm`,
NULL,
NULL,
NULL,
`otpv_inicio`,
`otpv_fin`,
NULL,
NULL,
`otpv_obs_as`,
NULL,
NULL,
NULL,
NULL,
NULL,
`otpv_obs_cierre_ad`,
`otpv_cierra_ad`,
`otpv_date_cierra_ad`,
`otpv_obs_km`,
NULL,
NULL,
`otpv_componente`,
NULL,
NULL,
NULL,
`otpv_semana`,
`otpv_turno`,
`otpv_fecuencia`,
`otpv_date_genera`,
`otpv_cargaid`
FROM `BDLIMABUS`.`manto_otprv`;

/*ERROR AL CARGAR OTPRV 303592 row(s) affected, 1 warning(s): 1265 Data truncated for column 'ot_obs_aom' at row 299294 Records: 303592  Duplicates: 0  Warnings: 1*/

ALTER TABLE `BDLIMABUS`.`manto_orden_trabajo` 
CHANGE COLUMN `ot_origen` `ot_origen` VARCHAR(100) NOT NULL ,
CHANGE COLUMN `ot_bus` `ot_bus` VARCHAR(11) NOT NULL ,
CHANGE COLUMN `ot_asociado` `ot_asociado` VARCHAR(50) NOT NULL ,
CHANGE COLUMN `ot_hmotor` `ot_hmotor` VARCHAR(11) NOT NULL ,
CHANGE COLUMN `ot_estado` `ot_estado` VARCHAR(50) NOT NULL ,
CHANGE COLUMN `ot_resp_asoc` `ot_resp_asoc` VARCHAR(50) NOT NULL ,
CHANGE COLUMN `ot_descrip` `ot_descrip` VARCHAR(10000) CHARACTER SET 'utf8mb3' NOT NULL ,
CHANGE COLUMN `ot_tecnico` `ot_tecnico` VARCHAR(50) NOT NULL ,
CHANGE COLUMN `ot_check` `ot_check` VARCHAR(10) CHARACTER SET 'utf8mb3' NOT NULL ,
CHANGE COLUMN `ot_obs_cgm` `ot_obs_cgm` VARCHAR(2700) NOT NULL ,
CHANGE COLUMN `ot_sistema` `ot_sistema` VARCHAR(200) NOT NULL ,
CHANGE COLUMN `ot_codfalla` `ot_codfalla` VARCHAR(50) NOT NULL ,
CHANGE COLUMN `ot_at` `ot_at` VARCHAR(5000) CHARACTER SET 'utf8mb3' NOT NULL ,
CHANGE COLUMN `ot_obs_asoc` `ot_obs_asoc` VARCHAR(5000) CHARACTER SET 'utf8mb3' NOT NULL ,
CHANGE COLUMN `ot_montado` `ot_montado` VARCHAR(50) NOT NULL ,
CHANGE COLUMN `ot_dmontado` `ot_dmontado` VARCHAR(50) NOT NULL ,
CHANGE COLUMN `ot_busmont` `ot_busmont` VARCHAR(11) NOT NULL ,
CHANGE COLUMN `ot_busdmont` `ot_busdmont` VARCHAR(11) NOT NULL ,
CHANGE COLUMN `ot_motivo` `ot_motivo` VARCHAR(200) NOT NULL ,
CHANGE COLUMN `ot_obs_aom` `ot_obs_aom` VARCHAR(1000) CHARACTER SET 'latin1' NOT NULL ,
CHANGE COLUMN `ot_componente_raiz` `ot_componente_raiz` VARCHAR(500) CHARACTER SET 'ascii' NOT NULL ;
