CREATE TABLE `BDLIMABUS`.`ope_accidentesmatriz` ( 
    `accidentesmatriz_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `acmt_campo` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `acmt_busqueda` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `acmt_respuesta` VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`accidentesmatriz_id`)) ENGINE = InnoDB;