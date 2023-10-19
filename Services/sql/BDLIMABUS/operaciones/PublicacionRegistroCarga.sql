CREATE TABLE `BDLIMABUS2`.`PublicacionRegistroCarga` ( 
    `PubRg_Id` INT(11) NOT NULL AUTO_INCREMENT , 
    `PubRg_SemanaPublicada` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `PubRg_FechaCargada` TIMESTAMP NOT NULL , 
    `PubRg_UsuarioId` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `PubRg_Estado` VARCHAR(9) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`PubRg_Id`)) ENGINE = InnoDB;