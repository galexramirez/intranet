/* manto_preciosproveedor - Registro de los precios por proveedor de materiales */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_preciosproveedor`;
CREATE TABLE `BDLIMABUS`.`manto_preciosproveedor` ( 
    `precioprov_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `precioprov_codproveedor` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_descripcion` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `precioprov_marca` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_procedencia` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_unidadmedida` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_garantia` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_moneda` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `precioprov_precio` FLOAT NULL ,
    `precioprov_preciosoles` FLOAT NULL ,
    `precioprov_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_materialid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_documentacion` VARCHAR(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `precioprov_fechavigencia` DATE NOT NULL ,
    `precioprov_cargaid` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_responsablecreacion` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `precioprov_fechacreacion` DATE NOT NULL ,
    `precioprov_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `precioprov_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `precioprov_tipo` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`precioprov_id`)
) ENGINE = InnoDB;