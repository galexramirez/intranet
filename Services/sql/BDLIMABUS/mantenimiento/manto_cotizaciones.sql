/* manto_cotizaciones - Resgistro de los datos de la cabecera para la solicitud de cotizaciones */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_cotizaciones`;
CREATE TABLE `BDLIMABUS`.`manto_cotizaciones` (
    `cotizacion_id` INT(11) NOT NULL AUTO_INCREMENT,
    `coti_fecha` TIMESTAMP NOT NULL ,
    `coti_pedidoid` INT(11) NOT NULL,
    `coti_tipo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `coti_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `coti_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `coti_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `coti_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `coti_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`cotizacion_id`)
) ENGINE=InnoDB;