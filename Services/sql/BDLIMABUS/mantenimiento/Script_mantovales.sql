/*
SE DEBE ACTUALIZAR LOS CAMPOS FECHAS CON LOS VALORES NULL, POR LO QUE TENEMOS QUE REEMPLAZAR LAS FECHAS '0000-00-00' POR '2001-01-01'
*/
UPDATE IGNORE `manto_vales` SET `va_date_genera`='2001-01-01 01:01:01' WHERE `va_date_genera`='0000-00-00 00:00:00';
UPDATE IGNORE `manto_vales` SET `va_date_cierra`='2001-01-01 01:01:01' WHERE `va_date_cierra`='0000-00-00 00:00:00';
UPDATE IGNORE `manto_vales` SET `va_date_cierre_adm`='2001-01-01 01:01:01' WHERE `va_date_cierre_adm`='0000-00-00 00:00:00';
ALTER TABLE `manto_vales` CHANGE `va_date_genera` `va_date_genera` DATETIME NULL;
ALTER TABLE `manto_vales` CHANGE `va_date_cierra` `va_date_cierra` DATETIME NULL;
ALTER TABLE `manto_vales` CHANGE `va_date_cierre_adm` `va_date_cierre_adm` DATETIME NULL;
UPDATE IGNORE `manto_vales` SET `va_date_genera`=NULL WHERE `va_date_genera`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_vales` SET `va_date_cierra`=NULL WHERE `va_date_cierra`='2001-01-01 01:01:01';
UPDATE IGNORE `manto_vales` SET `va_date_cierre_adm`=NULL WHERE `va_date_cierre_adm`='2001-01-01 01:01:01';
/*
ACTUALIZAR LOS CAMPOS con el número de DNI del colaborador
manto_vales.va_genera, manto_vales.va_tecnico, manto_vales.va_cierra, manto_vales.va_cierre_adm, manto_vales.va_usurep
*/
ALTER TABLE `manto_vales` CHANGE `va_genera` `va_genera` VARCHAR(8) NULL;
ALTER TABLE `manto_vales` CHANGE `va_tecnico` `va_tecnico` VARCHAR(8) NULL;
ALTER TABLE `manto_vales` CHANGE `va_cierra` `va_cierra` VARCHAR(8) NULL;
ALTER TABLE `manto_vales` CHANGE `va_cierre_adm` `va_cierre_adm` VARCHAR(8) NULL;
ALTER TABLE `manto_vales` CHANGE `va_usurep` `va_usurep` VARCHAR(8) NULL;
UPDATE `manto_vales` SET `va_genera`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`va_genera`);
UPDATE `manto_vales` SET `va_tecnico`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`va_tecnico`);
UPDATE `manto_vales` SET `va_cierra`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`va_cierra`);
UPDATE `manto_vales` SET `va_cierre_adm`=(SELECT `dni_usuario` FROM `manto_usuario` WHERE `cod_usuario`=`va_cierre_adm`);
/*
SE ACTUALIZA EL CAMPO GARATIA EN LONGITUD A 45
*/
ALTER TABLE `manto_vales` CHANGE `va_garantia` `va_garantia` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `manto_vales` CHANGE `va_recepcion` `va_recepcion` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_vales` CHANGE `va_obs_cgm` `va_obs_cgm` VARCHAR(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_vales` CHANGE `va_obs_aom` `va_obs_aom` VARCHAR(500) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_vales` CHANGE `va_estado` `va_estado` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_vales` CHANGE `va_rep` `va_rep` VARCHAR(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_vales` CHANGE `va_modif` `va_modif` INT(11) NULL;
ALTER TABLE `manto_vales` CHANGE `va_ot` `va_ot` INT(11) NULL;
ALTER TABLE `manto_vales` CHANGE `va_asociado` `va_asociado` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_vales` CHANGE `va_responsable` `va_responsable` VARCHAR(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_vales` CHANGE `va_garantia` `va_garantia` VARCHAR(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `manto_vales` CHANGE `va_obs_aom` `va_obs_aom` VARCHAR(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;