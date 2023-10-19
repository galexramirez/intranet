/* manto_mantocarga - Registro de cargas desde archivo excel con los kilometros por bus */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_kmcarga`;
CREATE TABLE `BDLIMABUS`.`manto_kmcarga` ( 
    `kmcarga_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `kmcarga_nroregistros` INT(11) NOT NULL ,
    `kmcarga_fecha` TIMESTAMP NOT NULL , 
    `kmcarga_fechacarga` TIMESTAMP NOT NULL, 
    `kmcarga_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`kmcarga_id`)
) ENGINE = InnoDB;