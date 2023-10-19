/*
SE DEBE ACTUALIZAR LOS CAMPOS FECHAS CON LOS VALORES NULL, POR LO QUE TENEMOS QUE REEMPLAZAR LAS FECHAS '0000-00-00' POR '2001-01-01'
*/
UPDATE IGNORE `manto_ot` SET `ot_date_crea`='2001-01-01 01:01:01' WHERE `ot_date_crea`='0000-00-00 00:00:00';
UPDATE IGNORE `manto_ot` SET `ot_date_ct`='2001-01-01 01:01:01' WHERE `ot_date_ct`='0000-00-00 00:00:00';
UPDATE IGNORE `manto_ot` SET `ot_date_recep_aom`='2001-01-01 01:01:01' WHERE `ot_date_recep_aom`='0000-00-00 00:00:00';
UPDATE IGNORE `manto_ot` SET `ot_inicio`='2001-01-01 01:01:01' WHERE `ot_inicio`='0000-00-00 00:00:00' OR `ot_inicio`='1900-01-00 00:00:00';
UPDATE IGNORE `manto_ot` SET `ot_fin`='2001-01-01 01:01:01' WHERE `ot_fin`='0000-00-00 00:00:00' OR `ot_fin`='1900-01-00 00:00:00';
UPDATE IGNORE `manto_ot` SET `ot_date_ca`='2001-01-01 01:01:01' WHERE `ot_date_ca`='0000-00-00 00:00:00';
UPDATE IGNORE `manto_ot` SET `ot_date_rec_cgm`='2001-01-01 01:01:01' WHERE `ot_date_rec_cgm`='0000-00-00 00:00:00';

ALTER TABLE `manto_ot` CHANGE `ot_date_crea` `ot_date_crea` DATETIME NULL;
ALTER TABLE `manto_ot` CHANGE `ot_date_ct` `ot_date_ct` DATETIME NULL;
ALTER TABLE `manto_ot` CHANGE `ot_date_recep_aom` `ot_date_recep_aom` DATETIME NULL;
ALTER TABLE `manto_ot` CHANGE `ot_inicio` `ot_inicio` DATETIME NULL;
ALTER TABLE `manto_ot` CHANGE `ot_fin` `ot_fin` DATETIME NULL;
ALTER TABLE `manto_ot` CHANGE `ot_date_ca` `ot_date_ca` DATETIME NULL;
ALTER TABLE `manto_ot` CHANGE `ot_date_rec_cgm` `ot_date_rec_cgm` DATETIME NULL;

UPDATE IGNORE `manto_ot` SET `ot_date_crea`=NULL WHERE `ot_date_crea`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_ot` SET `ot_date_ct`=NULL WHERE `ot_date_ct`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_ot` SET `ot_date_recep_aom`=NULL WHERE `ot_date_recep_aom`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_ot` SET `ot_inicio`=NULL WHERE `ot_inicio`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_ot` SET `ot_fin`=NULL WHERE `ot_fin`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_ot` SET `ot_date_ca`=NULL WHERE `ot_date_ca`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_ot` SET `ot_date_rec_cgm`=NULL WHERE `ot_date_rec_cgm`='2001-01-01 01:01:01';

/*
ACTUALIZAR LOS CAMPOS con el número de DNI del colaborador
manto_ot.cgm_crea, manto_ot.cgm_ct, manto_ot.ot_ca, manto.ot_recep_aom
*/
ALTER TABLE `manto_ot` CHANGE `ot_cgm_crea` `ot_cgm_crea` VARCHAR(8) NULL;
ALTER TABLE `manto_ot` CHANGE `ot_cgm_ct` `ot_cgm_ct` VARCHAR(8) NULL;
ALTER TABLE `manto_ot` CHANGE `ot_ca` `ot_ca` VARCHAR(8) NULL;
UPDATE `manto_ot` SET `ot_cgm_crea`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`ot_cgm_crea`);
UPDATE `manto_ot` SET `ot_cgm_ct`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`ot_cgm_ct`);
UPDATE `manto_ot` SET `ot_ca`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`ot_ca`);

/*
ACTUALIZA LOS CAMPOS PARA QUE ACEPTEN NULL
*/
ALTER TABLE `manto_ot` CHANGE `ot_kilometraje` `ot_kilometraje` INT(11) NULL;
ALTER TABLE `manto_ot` CHANGE `ot_recep_aom` `ot_recep_aom` INT(11) NULL;
ALTER TABLE `manto_ot` CHANGE `ot_obs_km` `ot_obs_km` INT(11) NULL;
ALTER TABLE `manto_ot` CHANGE `ot_reg_rec` `ot_reg_rec` VARCHAR(12) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_ot` CHANGE `ot_pin` `ot_pin` VARCHAR(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
/*
SE ACTUALIZA EL CAMPO ot_obs_gcm POR ot_obs_cgm
*/
ALTER TABLE `manto_ot` CHANGE `ot_obs_gcm` `ot_obs_cgm` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
/*
SE ACTUALIZA EL CAMPO ot_descrip para aceptar 13000 caracteres
*/
ALTER TABLE `manto_ot` CHANGE `ot_descrip` `ot_descrip` VARCHAR(13000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `manto_ot` CHANGE `ot_obs_aom` `ot_obs_aom` VARCHAR(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;