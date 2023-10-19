/* manto_materialesimagen - Registro de imagenes para materiales */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_materialesimagen`;
CREATE TABLE `BDLIMABUS`.`manto_materialesimagen` ( 
    `matimag_id`  INT(11) NOT NULL AUTO_INCREMENT ,
    `matimag_codproveedor` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `matimag_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `matimag_tipoimagen` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `matimag_imagen` LONGBLOB NULL DEFAULT NULL , 
    `matimag_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `matimag_fecha` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `matimag_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`matimag_id`)
) ENGINE = InnoDB;