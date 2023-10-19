/* manto_cargapreciomateriales - Registro de cargas desde archivo excel con los precios de materiales por proveedor*/
DROP TABLE IF EXISTS `BDLIMABUS`.`manto_cargapreciomateriales`;
CREATE TABLE `BDLIMABUS`.`manto_cargapreciomateriales` ( 
    `cpm_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `cpm_nroregistros` INT(11) NOT NULL ,
    `cpm_fechacarga` TIMESTAMP NOT NULL , 
    `cpm_responsablecarga` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `cpm_fechaeliminacion` TIMESTAMP NULL DEFAULT NULL, 
    `cpm_responsableeliminacion` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `cpm_estado` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
PRIMARY KEY (`cpm_id`)) ENGINE = InnoDB;