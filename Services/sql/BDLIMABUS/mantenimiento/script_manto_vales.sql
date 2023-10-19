ALTER TABLE `BDLIMABUS`.`manto_vales` 
ADD COLUMN `va_tipo` VARCHAR(45) NULL AFTER `va_modif`,
ADD COLUMN `va_ruc` VARCHAR(11) NULL AFTER `va_tipo`,
ADD COLUMN `va_ot_id` INT NULL AFTER `va_ruc`,
ADD COLUMN `va_almacen_ok` VARCHAR(2) NULL AFTER `va_ot_id`,
ADD COLUMN `va_coordinador_ok` VARCHAR(2) NULL AFTER `va_almacen_ok`;

/* YA ESTA ACTUALIZADA EN LA BASE DE DATOS DE PRODUCCION
ALTER TABLE `BDLIMABUS`.`manto_vales` 
CHANGE COLUMN `va_asociado` `va_asociado` VARCHAR(100) CHARACTER SET 'latin1' NULL DEFAULT NULL ;
*/

ALTER TABLE `BDLIMABUS`.`manto_rep_vale` 
ADD COLUMN `rv_unidad_medida` VARCHAR(15) NULL AFTER `rv_precio`,
ADD COLUMN `rv_material_id` VARCHAR(45) NULL AFTER `rv_unidad_medida`,
ADD COLUMN `rv_precio_proveedor_id` INT NULL AFTER `rv_material_id`,
ADD COLUMN `rv_moneda` VARCHAR(15) NULL AFTER `rv_precio_proveedor_id`,
ADD COLUMN `rv_precio_soles` FLOAT NULL AFTER `rv_moneda`,
ADD COLUMN `rv_fecha_vigencia` DATE NULL AFTER `rv_precio_soles`,
ADD COLUMN `rv_tipo` VARCHAR(45) NULL AFTER `rv_fecha_vigencia`,
ADD COLUMN `rv_descripcion` VARCHAR(200) NULL AFTER `rv_tipo`,
ADD COLUMN `rv_cantidad_real` DECIMAL(10,2) NULL AFTER `rv_descripcion`,
ADD COLUMN `rv_cod_patrimonial_despacho` VARCHAR(9) NULL AFTER `rv_cantidad_real`,
ADD COLUMN `rv_cod_patrimonial_recepcion` VARCHAR(9) NULL AFTER `rv_cod_patrimonial_despacho`;

UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20999999991' WHERE `va_asociado`='ANDINA';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20537110491' WHERE `va_asociado`='TELLANTAS';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20521834642' WHERE `va_asociado`='ACS';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20417926632' WHERE `va_asociado`='MODASA';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20537427427' WHERE `va_asociado`='PURADYN';
/*UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='' WHERE `va_asociado`='SERLOP';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='' WHERE `va_asociado`='MTU';*/
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20492418952' WHERE `va_asociado`='LBI';
/*UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='' WHERE `va_asociado`='TRANSVIAL';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='' WHERE `va_asociado`='MATESA';*/
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20566384826' WHERE `va_asociado`='GPEM';
/*UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='' WHERE `va_asociado`='HIMALAYA';*/
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20543725821' WHERE `va_asociado`='CUMMINS';
/*UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='' WHERE `va_asociado`='ITALNORT';*/
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20379559141' WHERE `va_asociado`='HIPERFAST';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='10295908217' WHERE `va_asociado`='Multiservicios EFAS';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20101087566' WHERE `va_asociado`='BUREAU VER';
/*UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='' WHERE `va_asociado`='EXANCO';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='' WHERE `va_asociado`='MATESA-INACTIVO';*/
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20603541171' WHERE `va_asociado`='FMS';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20101087566' WHERE `va_asociado`='BUREAU VERITAS';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20537427427' WHERE `va_asociado`='TILSAC';
/*UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='' WHERE `va_asociado`='PERU MASIVO';*/
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20555986654' WHERE `va_asociado`='PEARLITIC';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20492318656' WHERE `va_asociado`='QELLPU';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20407810300' WHERE `va_asociado`='CASCAPAMPA';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20511342571' WHERE `va_asociado`='ASTETE';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='15879658741' WHERE `va_asociado`='SOLREGSA';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20550417767' WHERE `va_asociado`='TECIGAS';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20493086716' WHERE `va_asociado`='RADIADORES ROJAS';
UPDATE `BDLIMABUS`.`manto_vales` SET `va_ruc`='20553865795' WHERE `va_asociado`='TURBO DE LOS ANDES SAC';

/* ACTUALIZA NUEVO CODIGO DE OT EN VALES */
UPDATE `manto_vales` 
JOIN `manto_orden_trabajo` ON `manto_orden_trabajo`.`cod_ot` = `manto_vales`.`va_ot`
SET `manto_vales`.`va_ot_id` = `manto_orden_trabajo`.`ot_id`
WHERE `manto_orden_trabajo`.`ot_tipo` = 'CORRECTIVAS';



ALTER TABLE `BDLIMABUS`.`manto_resp_asociado` 
ADD COLUMN `ra_ruc_asociado` VARCHAR(11) NULL AFTER `ra_asociado`;

UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20999999991' WHERE `ra_asociado`='ANDINA';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20537110491' WHERE `ra_asociado`='TELLANTAS';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20521834642' WHERE `ra_asociado`='ACS';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20417926632' WHERE `ra_asociado`='MODASA';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20537427427' WHERE `ra_asociado`='PURADYN';
/*UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='' WHERE `ra_asociado`='SERLOP';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='' WHERE `ra_asociado`='MTU';*/
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20492418952' WHERE `ra_asociado`='LBI';
/*UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='' WHERE `ra_asociado`='TRANSVIAL';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='' WHERE `ra_asociado`='MATESA';*/
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20566384826' WHERE `ra_asociado`='GPEM';
/*UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='' WHERE `ra_asociado`='HIMALAYA';*/
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20543725821' WHERE `ra_asociado`='CUMMINS';
/*UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='' WHERE `ra_asociado`='ITALNORT';*/
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20379559141' WHERE `ra_asociado`='HIPERFAST';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='10295908217' WHERE `ra_asociado`='Multiservicios EFAS';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20101087566' WHERE `ra_asociado`='BUREAU VER';
/*UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='' WHERE `ra_asociado`='EXANCO';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='' WHERE `ra_asociado`='MATESA-INACTIVO';*/
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20603541171' WHERE `ra_asociado`='FMS';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20101087566' WHERE `ra_asociado`='BUREAU VERITAS';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20537427427' WHERE `ra_asociado`='TILSAC';
/*UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='' WHERE `ra_asociado`='PERU MASIVO';*/
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20555986654' WHERE `ra_asociado`='PEARLITIC';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20492318656' WHERE `ra_asociado`='QELLPU';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20407810300' WHERE `ra_asociado`='CASCAPAMPA';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20511342571' WHERE `ra_asociado`='ASTETE';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='15879658741' WHERE `ra_asociado`='SOLREGSA';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20550417767' WHERE `ra_asociado`='TECIGAS';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20493086716' WHERE `ra_asociado`='RADIADORES ROJAS';
UPDATE `BDLIMABUS`.`manto_resp_asociado` SET `ra_ruc_asociado`='20553865795' WHERE `ra_asociado`='TURBO DE LOS ANDES SAC';
