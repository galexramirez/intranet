/* manto_otprvcarga - Resgistro de carga desde archivo excel con las OT Preventivas */
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_otprv`;
CREATE TABLE `BDLIMABUS`.`manto_otprvcarga` ( 
    `otprvcarga_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `otprvcarga_semanaprogramada` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `otprvcarga_nroregistros` INT(11) NOT NULL ,
    `otprvcarga_fechacargada` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `otprvcarga_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`otprvcarga_id`)
) ENGINE = InnoDB;