CREATE TABLE `BDLIMABUS`.`ControlFacilitadorRegistroCarga` ( 
    `CFaRg_Id` INT(11) NOT NULL AUTO_INCREMENT , 
    `CFaRg_FechaCargada` DATE NOT NULL , 
    `CFaRg_TipoOperacionCargada` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `CFaRg_FechaGenerar`  TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `CFaRg_UsuarioId_Generar` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    `CFaRg_FechaCerrar` TIMESTAMP NULL , 
    `CFaRg_UsuarioId_Cerrar` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `CFaRg_FechaEliminar` TIMESTAMP NULL , 
    `CFaRg_UsuarioId_Eliminar` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
    `CFaRg_Estado` VARCHAR(9) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
    PRIMARY KEY (`CFaRg_Id`)) ENGINE = InnoDB;