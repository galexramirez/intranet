/* manto_ordencompra - Registro de los datos de la cabecera de la orden de compra */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_ordencompra`;
CREATE TABLE `BDLIMABUS`.`manto_ordencompra` (
    `ordencompra_id` INT(11) NOT NULL AUTO_INCREMENT,
    `orco_fecha` TIMESTAMP NOT NULL ,
    `orco_pedidoid` INT(11) NOT NULL,
    `orco_cotizacionid` INT(11) NOT NULL,
    `orco_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `orco_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `orco_subtotal` FLOAT NOT NULL, 
    `orco_igv` FLOAT NOT NULL, 
    `orco_total` FLOAT NOT NULL, 
    `orco_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `orco_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `orco_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`ordencompra_id`)
) ENGINE=InnoDB;