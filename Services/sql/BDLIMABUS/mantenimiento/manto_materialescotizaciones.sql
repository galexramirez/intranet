/* manto_materialescotizaciones - Registro del detalle de las cotizaciones materiles y cantidades */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materialescotizaciones`;
CREATE TABLE `BDLIMABUS`.`manto_materialescotizaciones` (
    `mc_id` INT(11) NOT NULL AUTO_INCREMENT,
    `mc_cotizacionid` INT(11) NOT NULL,
    `mc_materialid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `mc_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `mc_cantidad` FLOAT NOT NULL,
    `mc_cantidad_cotizacion` FLOAT NULL ,
    `mc_cantidad_solicitada` FLOAT NULL ,
    `mc_observaciones` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `mc_precioprovid` INT(11) NULL , 
    `mc_codproveedor` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `mc_moneda` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `mc_preciocotizacion` FLOAT NULL ,
    `mc_precio` FLOAT NULL ,
    `mc_preciosoles` FLOAT NULL ,
    `mc_fechavigencia` DATE NULL ,
    `mc_seleccion` VARCHAR(2) NOT NULL ,
    PRIMARY KEY (`mc_id`)
) ENGINE=InnoDB;

ALTER TABLE `BDLIMABUS`.`manto_materialescotizaciones` 
ADD COLUMN `mc_cantidad_cotizacion` FLOAT NULL AFTER `mc_cantidad`,
ADD COLUMN `mc_cantidad_solicitada` FLOAT NULL AFTER `mc_cantidad_cotizacion`;