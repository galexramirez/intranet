CREATE TABLE `BDLIMABUS`.`OPE_Accidentes` ( 
`OPE_AccidentesId`  INT(11) NOT NULL AUTO_INCREMENT ,
`Accidentes_Id` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_ProgramacionId` INT(11) NOT NULL , 
`Acci_ControlFacilitadorId` INT(11) NOT NULL , 
`Acci_OPENovedadId` INT(11) NOT NULL , 
`Acci_NovedadId` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_Operacion` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_FechaOperacion` DATE NOT NULL , 
`Acci_EstadoAccidente` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_UsuarioId_Generar` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , 
`Acci_FechaGenerar` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
`Acci_CFaRgId` INT(11) NOT NULL , 
`Acci_UsuarioId_Cerrar` VARCHAR(8) CHARACTER SET utf8 COLLATE utf8_general_ci NULL , 
`Acci_FechaCerrar`  TIMESTAMP NULL DEFAULT NULL,
PRIMARY KEY (`OPE_AccidentesId`)) ENGINE = InnoDB;

