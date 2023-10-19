/*
SE DEBE ACTUALIZAR LOS CAMPOS FECHAS CON LOS VALORES NULL, POR LO QUE TENEMOS QUE REEMPLAZAR LAS FECHAS '0000-00-00' POR '2001-01-01'
*/
UPDATE IGNORE `manto_otprv` SET `otpv_date_prog`='2001-01-01' WHERE `otpv_date_prog`='0000-00-00';
UPDATE IGNORE `manto_otprv` SET `otpv_inicio`='2001-01-01 01:01:01' WHERE `otpv_inicio`='0000-00-00 00:00:00';
UPDATE IGNORE `manto_otprv` SET `otpv_fin`='2001-01-01 01:01:01' WHERE `otpv_fin`='0000-00-00 00:00:00' ;
UPDATE IGNORE `manto_otprv` SET `otpv_date_cierra_ad`='2001-01-01 01:01:01' WHERE `otpv_date_cierra_ad`='0000-00-00 00:00:00' ;

ALTER TABLE `manto_otprv` CHANGE `otpv_date_prog` `otpv_date_prog` DATE NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_inicio` `otpv_inicio` DATETIME NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_fin` `otpv_fin` DATETIME NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_date_cierra_ad` `otpv_date_cierra_ad` DATETIME NULL;

UPDATE IGNORE `manto_otprv` SET `otpv_date_prog`=NULL WHERE `otpv_date_prog`='2001-01-01';
UPDATE IGNORE `manto_otprv` SET `otpv_inicio`=NULL WHERE `otpv_inicio`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_otprv` SET `otpv_fin`=NULL WHERE `otpv_fin`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_otprv` SET `otpv_date_cierra_ad`=NULL WHERE `otpv_date_cierra_ad`='2001-01-01 01:01:01';

/*
SE ACTUALIZAN LOS CAMPOS QUE DEBEN CONTENER DATOS NULL
*/
ALTER TABLE `manto_otprv` CHANGE `otpv_tecnico` `otpv_tecnico` VARCHAR(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_kmrealiza` `otpv_kmrealiza` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_hmotor` `otpv_hmotor` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_componente` `otpv_componente` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_obs_as` `otpv_obs_as` VARCHAR(4000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_obs_cgm` `otpv_obs_cgm` VARCHAR(4000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_obs_cierre_ad` `otpv_obs_cierre_ad` VARCHAR(2000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;

/*
CREACION DEL CAMPO otpv_cargaid DONDE SE REGISTRA EL ID DEL REGISTRO CARGA
*/
ALTER TABLE `manto_otprv` ADD `otpv_cargaid` INT(11) NULL AFTER `otpv_obs_km`;

/*
ACTUALIZAR LOS CAMPOS con el número de DNI del colaborador
manto_otprv.otpv_genera, manto_otprv.otpv_cgm_cierra, manto_otprv.otpv_cierra_ad
*/
ALTER TABLE `manto_otprv` CHANGE `otpv_genera` `otpv_genera` VARCHAR(8) NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_cgm_cierra` `otpv_cgm_cierra` VARCHAR(8) NULL;
ALTER TABLE `manto_otprv` CHANGE `otpv_cierra_ad` `otpv_cierra_ad` VARCHAR(8) NULL;

UPDATE `manto_otprv` SET `otpv_genera`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`otpv_genera`);
UPDATE `manto_otprv` SET `otpv_cgm_cierra`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`otpv_cgm_cierra`);
UPDATE `manto_otprv` SET `otpv_cierra_ad`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`otpv_cierra_ad`);