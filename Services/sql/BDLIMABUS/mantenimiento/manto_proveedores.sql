/* manto_proveedores - Registro de los datos de proveedores */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_proveedores`;
CREATE TABLE `BDLIMABUS`.`manto_proveedores` ( 
    `prov_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `prov_razonsocial` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `prov_contacto` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `prov_cta_banco_soles` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `prov_cta_banco_dolares` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `prov_cta_interbanco_soles` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `prov_cta_interbanco_dolares` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `prov_cta_detraccion_soles` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `prov_condicion_pago` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `prov_correo` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `prov_telefono` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
    `prov_estado` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `prov_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    PRIMARY KEY (`prov_ruc`)
) ENGINE = InnoDB;