/* manto_pedidos - Registro de los datos de cabecera de pedidos */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_pedidos`;
CREATE TABLE `BDLIMABUS`.`manto_pedidos` (
    `pedido_id` INT(11) NOT NULL AUTO_INCREMENT,
    `pedi_tipo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_fechacreacion` DATE NOT NULL ,
    `pedi_fecharequerimiento` DATE NULL ,
    `pedi_fechallegada` DATE NULL ,
    `pedi_prioridad` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_centrocosto` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `pedi_contacto_id` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `pedi_direccion_entrega` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `pedi_proceso` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `pedi_orden_compra_directa` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `pedi_responsable` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `pedi_cotizacionid` int(11) NULL ,
    `pedi_ordencompraid` int(11) NULL ,
    `pedi_estado` VARCHAR(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `pedi_estado_obs` VARCHAR(100) NULL ,
    `pedi_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NULL,    
    PRIMARY KEY (`pedido_id`)
) ENGINE=InnoDB;