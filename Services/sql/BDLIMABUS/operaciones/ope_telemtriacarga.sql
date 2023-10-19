CREATE TABLE `BDLIMABUS`.`ope_telemetriacarga` ( 
    `telemetriacarga_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `tlmtcarga_fechaoperacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `tlmtcarga_nroregistros` INT(11) NOT NULL ,
    `tlmtcarga_fechacarga` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `tlmtcarga_usuarioid` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`telemetriacarga_id`)) ENGINE = InnoDB;