/* manto_cotizacionesesimagen - Registro de imagenes para cotizacioneses */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_cotizacionesimagen`;
CREATE TABLE `BDLIMABUS`.`manto_cotizacionesimagen` ( 
    `cotimag_id`  INT(11) NOT NULL AUTO_INCREMENT ,
    `cotimag_cotizacionid` INT(11) NOT NULL ,
    `cotimag_ruc` VARCHAR(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `cotimag_tipoimagen` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `cotimag_imagen` LONGBLOB NULL DEFAULT NULL , 
    `cotimag_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `cotimag_fecha` TIMESTAMP NOT NULL ,
    `cotimag_log` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`cotimag_id`)
) ENGINE = InnoDB;